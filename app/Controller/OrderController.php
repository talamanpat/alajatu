<?php

App::uses('AppController', 'Controller');

class OrderController extends AppController {

    public $uses = array('Bs.Customer', 'Bs.Order', 'Bs.Category', 'Bs.Product', 'Bs.Comuna', 'Bs.Item');

    public function getCart() {
        $cart = $this->generateCart(
                array_key_exists('p', $this->request->data) ?
                        $this->request->data['p'] :
                        array()
        );

        $this->set('cart', $cart);
        //$this->set('total', $ctotal ); 
        $this->layout = 'ajax';
    }

    private function generateCart($dataAr) {
        $keys = array_count_values($dataAr);
        $cart = array();
        $ctotal = 0;
        $categories = $this->Category->find('list');
        foreach ($keys as $key => $value) {
            $p = $this->Product->find('first', array( 
                'conditions' => array(
        'Product.' . $this->Product->primaryKey => $key))
            );
            $ptotal = $p['Product']['price'] * $value;
            $cp = array(
                'id' => $key,
                'name' => $categories[$p['Product']['category_id']] . " " . $p['Product']['name'],
                'volume' => $value,
                'price' => $p['Product']['price'],
                'total' => $ptotal
            );
            array_push($cart, $cp);
            $ctotal += $ptotal;
        }
        return $cart;
    }

    public function generate() {
        $this->layout = "ajax";


        if (!empty($this->data)) {

            if (!$this->Configuration->getOPEN()) {
                $this->redirect(array('controller' => 'Pages', 'action' => 'storeClosed'));
            }

            if ($this->createAll($this->request->data)) {
                $this->redirect(array('controller' => 'Order', 'action' => 'redirectingToOrder', $this->request->data['Order']['id']));
            }
        } else {
            $this->Session->setFlash(__('no data', true));
        }
                //TODO: usar metodo de modelo
        $this->set('comunas', $this->Comuna->find('list', array('order' => 'id', 'conditions'=>array('Comuna.active'=>1))));
    }

    private function createAll(&$data) {
        //crea usuario
        $this->Customer->create();

        $customerExist = $this->Customer->find('first', array(
            'conditions' => array(
                'Customer.email' => $data['Customer']['email']
            )
        ));

        $data['Customer']['id'] = empty($customerExist) ? String::uuid() : $customerExist['Customer']['id'];
        if (!$this->Customer->save($data)) {
            $this->Session->setFlash(__('Por favor revisa los campos e intenta de nuevo.', true));
            return false;
        } else {
            $this->Recording->save(array(
                'customer_id' => $data['Customer']['id'],
                'category' => $this->Recording->CREATE_CUSTOMER,
                'subject' => "Se ha creado o actualizado el registro del cliente " . $data['Customer']['full_name'] . " correo " . $data['Customer']['email'] . ".",
            ));
            //$this->Session->setFlash(__('El cliente ha sido creado', true));
        }

        //crea orden
        $this->Order->create();
        $data['Order']['id'] = String::uuid();
        $data['Order']['customer_id'] = $data['Customer']['id'];
        $data['Order']['address'] = $data['Customer']['address'];
        $data['Order']['address_info'] = $data['Customer']['address_info'];
        $data['Order']['terms_conditions'] = $data['Customer']['terms_conditions'];
        $data['Order']['dtime_solicited'] = date("Y-m-d H:i:s");
        $data['Order']['dtime_confirmation'] = date("Y-m-d H:i:s");
        $data['Order']['create_time'] = date("Y-m-d H:i:s");
        $data['Order']['state'] = $this->OrderState->states["CONFIRMATION"];

        $last = $this->Order->find('first', array(
            'order' => array('Order.correlative' => 'desc')));
        $data['Order']['code'] = $data['Order']['correlative'] = $last != null ? $last['Order']['correlative'] + 1 : 1;


        if (!$this->Customer->Order->save($data)) {
            $this->Session->setFlash(__('Por favor revisa los campos e intenta de nuevo.', true));
            return false;
        } else {
            //$this->Session->setFlash(__('La orden ha sido creada', true));
            //carro en orden
            $cart = $this->generateCart(explode(",", $data['Customer']['ps']));

            $items = array();
            $i = 0;
            $orderTotal = 0;
            foreach ($cart as $p) {
                $itemExist = $this->Item->find('first', array(
                    'conditions' => array(
                        'Item.product_id' => $p['id'],
                        'Item.order_id' => $data['Order']['id']
                    )
                ));

                $idItem = empty($itemExist) ? null : $itemExist['Item']['id'];
                $items[$i] = array(
                    'id' => $idItem,
                    'order_id' => $data['Order']['id'],
                    'product_id' => $p['id'],
                    'volume' => $p['volume'],
                    'price' => $p['price'],
                    'total' => $p['total'],
                );
                $i++;
                $orderTotal += $p['total'];
            }
            if (!$this->Item->saveMany($items)) {
                $this->Session->setFlash(__('Los productos no fueron creados', true));
                return false;
            } else {

                //guarda total en orden
                $o = array('Order' => array(
                        'id' => $data['Order']['id'],
                        'total' => $orderTotal,
                        'dtime_total' => date("Y-m-d H:i:s")));
                if (!$this->Order->save($o)) {
                    $this->Session->setFlash(__('No se pudo guardar el total de la orden', true));
                    return false;
                }
            }

            $this->Recording->save(array(
                'customer_id' => $data['Customer']['id'],
                'order_id' => $data['Order']['id'],
                'category' => $this->Recording->CREATE_ORDER,
                'subject' => "Se ha creado la orden " . $data['Order']['code'] . " del cliente correo " . $data['Customer']['email'] . ".",
            ));
        }



        $this->Session->setFlash(__('El pedido ha sido realizado :)', true));
        return TRUE;
    }

    public function redirectingToOrder($id) {
        $this->layout = "ajax";
        $this->set('id', $id);
    }

    public function follow($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id), 'recursive' => 2);
        $this->Order->Item->bindModel(array('belongsTo' => array('Product')));
        $order = $this->Order->find('first', $options);
        $this->set('order', $order);
        $this->set('categories', $this->Category->find('list'));
        $this->set('states', $this->OrderState->states);
        $this->set('title_for_layout', 'Seguimiento');
    }

    public function state($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        $this->layout = 'ajax';
        $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id), 'recursive' => -1);
        $order = $this->Order->find('first', $options);
        $this->set('order', $order);
        $this->set('states', $this->OrderState->states);
    }

    public function searchOrder() {
        if ($this->request->query('email')) {
            $email = $this->request->query('email');
            $options = array('conditions' => array(
                    'Customer.email' => $email,
                    'Order.state' => array(
                        $this->OrderState->states['CONFIRMATION'],
                        $this->OrderState->states['ASSIGNING'],
                        $this->OrderState->states['MAKING'],
                        $this->OrderState->states['READY'],
                        $this->OrderState->states['DELIVERY'],
                    )
            ));
            $this->Order->recursive = 0;
            $orders = $this->Order->find('all', $options);
            if (count($orders) === 1) {
                $this->redirect(array('controller' => 'Order', 'action' => 'follow', $orders[0]['Order']['id']));
            }
            $this->set('orders', $orders);
        }else
        $this->set('orders', array());
    }

}