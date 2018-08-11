<?php

App::uses('AppController', 'Controller');

class OrdersController extends AppController {

    public $uses = array('Bs.Order', 'Bs.Item', 'Bs.Motorista', 'Bs.Proveedor', 'Bs.Category');

    public function index() {

        $hora = time();
        echo "Hora actual del servidor es: " . date("H:i, l j F Y", $hora);
        $this->Order->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' =>
            array('Order.state' =>
                array(
                    $this->OrderState->states['CONFIRMATION'],
                    $this->OrderState->states['ASSIGNING'],
                    $this->OrderState->states['MAKING'],
                    $this->OrderState->states['READY'],
                    $this->OrderState->states['DELIVERY'],
                )),
            'order' => array(
                'Order.state' => 'asc',
                'Order.dtime_solicited' => 'asc'
            ),
        );

        $this->set('orders', $this->Paginator->paginate());
        $this->Motorista->bindModel(array('belongsTo' => array('User')));
        $this->set('motoristas', $this->Motorista->find('list', array('fields' => array('Motorista.id', 'User.username'), 'recursive' => 1)));
        $this->set('states', array_flip($this->OrderState->states));
    }

    public function view($id = null) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        $this->Order->recursive = 2;
        $this->Order->Item->bindModel(array('belongsTo' => array('Product')));
        $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
        $order = $this->Order->find('first', $options);
        $order['Order']['canEditItems'] = $order['Order']['state'] == $this->OrderState->states['CONFIRMATION'];
        //proveedores
        $this->Proveedor->bindModel(array('belongsTo' => array('User')));
        $proveedores = $this->Proveedor->find('list', array('fields' => array('Proveedor.id', 'User.username'), 'recursive' => 1)
        );

        //motoristas
        $this->Motorista->bindModel(array('belongsTo' => array('User')));
        $motoristas = $this->Motorista->find('list', array('fields' => array('Motorista.id', 'User.username'), 'recursive' => 1)
        );
        $statesCheckbox = $this->OrderState->states;
        unset($statesCheckbox['NO_VALID']);
        unset($statesCheckbox['SOLICITED']);
        unset($statesCheckbox['CANCELED']);
        unset($statesCheckbox['ERROR']);


        $this->set('order', $order);
        $this->set('statesCheckbox', array_flip($statesCheckbox));
        $this->set('states', array_flip($this->OrderState->states));
        $this->set('proveedores', $proveedores);
        $this->set('motoristas', $motoristas);
    }

    public function edit($id = null) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->request->data;
            //$this->Order->validator()->remove('terms_conditions');
            if ($this->Order->save($data)) {
                $this->Session->setFlash(__('The order has been saved.'));
                $ue = $this->Auth->user();
                $order = $this->Order->find("first", array('conditions' => array('Order.id' => $data['Order']['id'])));

                $this->Recording->save(array(
                    'customer_id' => $order['Order']['customer_id'],
                    'order_id' => $order['Order']['id'],
                    'user_executor_id' => $ue['User']['id'],
                    'category' => $this->Recording->categories['EDIT_ORDER'],
                    'subject' => "Se han editado los datos de la order " . $order['Order']['code'] . " por " . $ue['User']['username'] . ".",
                ));
                return $this->redirect(array('action' => 'view', $order['Order']['id']));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
            $this->request->data = $this->Order->find('first', $options);
        }
    }

    public function cancelOrder($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        //variables a utilizar
        $u = $this->Auth->user();
        $this->Order->recursive = -1;
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $id)));


        //validaciones
        if ($order['Order']['state'] == $this->OrderState->states['CANCELED']) {
            $this->Session->setFlash(__('ya se ha puesto como orden cancelada'));
            $this->redirectToIndex();
        }

        //ejecuta
        $order['Order']['state'] = $this->OrderState->states['CANCELED'];
        // $order['Order']['dtime_ready'] = date("Y-m-d H:i:s");
        $this->Order->validator()->remove('motorista_id');
        $this->Order->validator()->remove('ejecutivo_id');
        $this->Order->validator()->remove('proveedor_id');

        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['CANCEL_ORDER'],
                'subject' =>
                'Se ha puesto el pedido ' . $order['Order']['code'] . ' en cancelada por ' . $u['User']['username'],
            ));

            //TODO:mails


            $this->Session->setFlash(__('Se ha puesto la orden en cancelada'));
        } else {
            $this->Session->setFlash(__('No se ha podido realizar la acción...'));
            debug($this->Order->invalidFields());
        }
        $this->redirect(array('action' => 'index'));
    }

    public function orderNoValid($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        //variables a utilizar
        $u = $this->Auth->user();
        $this->Order->recursive = -1;
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $id)));


        //validaciones
        if ($order['Order']['state'] == $this->OrderState->states['NO_VALID']) {
            $this->Session->setFlash(__('ya se ha puesto como orden no valida'));
            $this->redirectToIndex();
        }

        if ($order['Order']['state'] != $this->OrderState->states['CONFIRMATION']) {
            $this->Session->setFlash(__('Entrada inválida'));
            $this->redirectToIndex();
        }


        //ejecuta
        $this->Order->validator()->remove('motorista_id');
        $this->Order->validator()->remove('ejecutivo_id');
        $this->Order->validator()->remove('proveedor_id');
        $order['Order']['state'] = $this->OrderState->states['NO_VALID'];

        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['NO_VALID_ORDER'],
                'subject' =>
                'Se ha puesto el pedido ' . $order['Order']['code'] . ' en no valida por ' . $u['User']['username'],
            ));

            //TODO:mails

            $this->Session->setFlash(__('Se ha puesto la orden en no valida'));
        } else {
            $this->Session->setFlash(__('No se ha podido realizar la acción...'));
            debug($this->Order->invalidFields());
        }
        $this->redirect(array('action' => 'index'));
    }

    public function orderError($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        //variables a utilizar
        $u = $this->Auth->user();
        $this->Order->recursive = -1;
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $id)));


        //validaciones
        if ($order['Order']['state'] == $this->OrderState->states['ERROR']) {
            $this->Session->setFlash(__('ya se ha puesto como orden error'));
            $this->redirectToIndex();
        }


        //ejecuta
        $this->Order->validator()->remove('motorista_id');
        $this->Order->validator()->remove('ejecutivo_id');
        $this->Order->validator()->remove('proveedor_id');
        $order['Order']['state'] = $this->OrderState->states['ERROR'];

        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['NO_VALID_ORDER'],
                'subject' =>
                'Se ha puesto el pedido ' . $order['Order']['code'] . ' en error por ' . $u['User']['username'],
            ));

            //TODO:mails

            $this->Session->setFlash(__('Se ha puesto la orden en error'));
        } else {
            $this->Session->setFlash(__('No se ha podido realizar la acción...'));
            debug($this->Order->invalidFields());
        }
        $this->redirect(array('action' => 'index'));
    }

    public function assignations() {

        //variables a utilizar
        $u = $this->Auth->user();
        $data = $this->request->data;
        $data['Order']['ejecutivo_id'] = $u['Ejecutivo']['id'];
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $data['Order']['id'])));
        $this->Proveedor->bindModel(array('belongsTo' => array('User')));
        $proveedores = $this->Proveedor->find('list', array('fields' => array('Proveedor.id', 'User.username'), 'recursive' => 1)
        );


        //validaciones
        $right = true;
        switch ($data['Order']['state']) {
            case $this->OrderState->states['CONFIRMATION']:

                break;
            case $this->OrderState->states['ASSIGNING']:
                break;
            case $this->OrderState->states['MAKING']:

                break;
            case $this->OrderState->states['READY']:

                break;
            case $this->OrderState->states['DELIVERY']:

                if ($order['Order']['state'] == $data['Order']['state']) {
                    $this->Session->setFlash(__('Este registro ya se ha marcado como en despacho'));
                    $right = FALSE;
                }
                break;
            case $this->OrderState->states['DISPATCHED']:
                if ($order['Order']['state'] == $data['Order']['state']) {
                    $this->Session->setFlash(__('Este registro ya se ha marcado como entregado'));
                    $right = FALSE;
                }
                break;
            default:
                break;
        }

        if ($right) {
            //casos antes de grabar
            $recordSubject = "";
            switch ($data['Order']['state']) {
                case $this->OrderState->states['CONFIRMATION']:
                    $data['Order']['dtime_confirmation'] = date("Y-m-d H:i:s");
                    $recordSubject = 'Se ha puesto el pedido :code en confirmación por :user';
                    break;
                case $this->OrderState->states['ASSIGNING']:
                    $data['Order']['dtime_assigning'] = date("Y-m-d H:i:s");
                    $recordSubject = 'Se ha puesto asignado el pedido :code a la cocina :kitchen por :user';
                    break;
                case $this->OrderState->states['MAKING']:
                    $data['Order']['dtime_making'] = date("Y-m-d H:i:s");
                    $recordSubject = 'Se ha marcado el pedido :code como en cocina :kitchen por :user';
                    break;
                case $this->OrderState->states['DELIVERY']:
                    $data['Order']['dtime_delivery'] = date("Y-m-d H:i:s");
                    break;
                case $this->OrderState->states['DISPATCHED']:
                    $data['Order']['dtime_dispatched'] = date("Y-m-d H:i:s");
                    break;
                default:
                    break;
            }
            $recordSubjectFinal = String::insert($recordSubject, array(
                        'code' => $order['Order']['code'],
                        'user' => $u['User']['username'],
                        'kitchen' => $proveedores[$data['Order']['proveedor_id']]
            ));


            //grabajamos
            //$this->Order->validator()->remove('terms_conditions');
            if ($this->Order->save($data)) {
                $this->Recording->save(array(
                    'customer_id' => $order['Order']['customer_id'],
                    'order_id' => $order['Order']['id'],
                    'user_executor_id' => $u['User']['id'],
                    'category' => $this->Recording->categories['ASSIGN_ORDER'],
                    'subject' => $recordSubjectFinal,
                ));

                //TODO:mails
                switch ($data['Order']['state']) {
                    case $this->OrderState->states['MAKING']:
                        $this->Emailing->sendMaikingCustomer("daniel.talaman@gmail.com","nombre cocina",$order['Order']['code']);
                        break;
                    case $this->OrderState->states['DISPATCHED']:
                        break;
                    default:
                        break;
                }

                $this->Session->setFlash(__('Se ha asignado con éxito'));
            } else {
                $this->Session->setFlash(__('No se ha podido asignar...'));
                debug($this->Order->invalidFields());
            }
        }
        $this->redirect(array('action' => 'view', $this->request->data['Order']['id']));
    }

    public function addItem($id) {
        if (!$this->Item->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $item = $this->request->data;
            $p = $this->Item->Product->find('first', array('conditions' => array('Product.id' => $item['Item']['product_id'])));
            $item['Item']['price'] = $p['Product']['price'];
            $item['Item']['total'] = $item['Item']['volume'] * $item['Item']['price'];


            if ($this->Item->save($item)) {



                $this->Session->setFlash(__('The item has been saved.'));


                if ($this->recalculateTotal($item['Item']['order_id'])) {
                    $o = $this->Order->find('first', array('conditions' => array('Order.id' => $item['Item']['order_id'])));
                    $ue = $this->Auth->user();

                    $this->Recording->save(array(
                        'customer_id' => $o['Order']['customer_id'],
                        'order_id' => $o['Order']['id'],
                        'user_executor_id' => $ue['User']['id'],
                        'category' => $this->Recording->categories['EDIT_ORDER'],
                        'subject' => "Se ha editado la order " . $o['Order']['code'] .
                        " agregando el ítem " . $p['Product']['name'] .
                        " con la cantidad de " . $item['Item']['volume'] . " por " . $ue['User']['username'] . ".",
                    ));
                } else {
                    $this->autoRender = false;
                    echo 'error al recalcular el precio final';
                }



                return $this->redirect(array('action' => 'view', $item['Item']['order_id']));
            } else {
                $this->Session->setFlash(__('The item could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data['Item']['order_id'] = $id;
        }
        $this->Item->Product->bindModel(array('belongsTo' => array('Category')));
        $products = $this->listCategoryProducts();
        $this->set('products', $products);
    }

    public function updateItem() {
        $this->layout = "ajax";
        $this->autoRender = false;

        if ($this->request->is('post') &&
                (array_key_exists("item", $this->request->data) && array_key_exists("order", $this->request->data) && array_key_exists("volume", $this->request->data))
        ) {


            $idItem = $this->request->data['item'];
            $idOrder = $this->request->data['order'];
            $volume = $this->request->data['volume'];


            $item = $this->Item->find('first', array(
                'conditions' => array(
                    'Item.id' => $idItem,
                    'Item.order_id' => $idOrder,
                )
            ));
            $item['Item']['volume'] = $volume;
            $item['Item']['total'] = $volume * $item['Item']['price'];
            if ($this->Item->save($item)) {
                if ($this->recalculateTotal($idOrder)) {
                    $o = $this->Order->find('first', array('conditions' => array('Order.id' => $idOrder)));
                    $ue = $this->Auth->user();

                    $this->Recording->save(array(
                        'customer_id' => $o['Order']['customer_id'],
                        'order_id' => $o['Order']['id'],
                        'user_executor_id' => $ue['User']['id'],
                        'category' => $this->Recording->categories['EDIT_ORDER'],
                        'subject' => "Se ha editado la order " . $o['Order']['code'] .
                        " modificando el ítem " . $item['Product']['name'] .
                        " a la cantidad de " . $item['Item']['volume'] . " por " . $ue['User']['username'] . ".",
                    ));


                    $this->redirect(array('action' => 'cart', $idOrder));
                } else {
                    $this->autoRender = false;
                    echo 'error al recalcular el precio final';
                }
            }
        } else {
            echo 'entrada no valida';
        }
    }

    public function removeItem() {
        $this->layout = "ajax";
        $this->autoRender = false;


        if ($this->request->is('post') &&
                (array_key_exists("item", $this->request->data) && array_key_exists("order", $this->request->data) )
        ) {
            $idItem = $this->request->data['item'];
            $idOrder = $this->request->data['order'];
            $item = $this->Item->find('first', array(
                'conditions' => array(
                    'Item.id' => $idItem,
                    'Item.order_id' => $idOrder,
                )
            ));

            if ($this->Item->delete($idItem)) {
                if ($this->recalculateTotal($idOrder)) {
                    $o = $this->Order->find('first', array('conditions' => array('Order.id' => $idOrder)));
                    $ue = $this->Auth->user();

                    $this->Recording->save(array(
                        'customer_id' => $o['Order']['customer_id'],
                        'order_id' => $o['Order']['id'],
                        'user_executor_id' => $ue['User']['id'],
                        'category' => $this->Recording->categories['EDIT_ORDER'],
                        'subject' => "Se ha editado la order " . $o['Order']['code'] .
                        " eliminando el ítem " . $item['Product']['name'] .
                        " por " . $ue['User']['username'] . ".",
                    ));


                    $this->redirect(array('action' => 'cart', $idOrder));
                } else {
                    $this->autoRender = false;
                    echo 'error al recalcular el precio final';
                }
            }
        } else {
            echo 'entrada no valida';
        }
    }

    public function cart($idOrder) {
        $this->layout = "ajax";
        $this->Order->recursive = 2;
        $this->Order->Item->bindModel(array('belongsTo' => array('Product')));
        $options = array('conditions' => array('Order.id' => $idOrder),
        );
        $order = $this->Order->find('first', $options);
        $order['Order']['canEditItems'] = $order['Order']['state'] == $this->OrderState->states['CONFIRMATION'];

        $this->set('order', $order);
        $this->render(`/Elements/Orders/Cart`);
    }

    private function recalculateTotal($idOrder) {
        $this->Item->virtualFields['order_total'] = 'SUM(Item.total)';
        $orderTotal = $this->Item->find('first', array(
            'fields' => array('order_id', 'order_total'),
            'recursive' => 1,
            'group' => array('Item.order_id'),
            'conditions' => array('Item.order_id' => $idOrder)));

        $o = array('Order' => array(
                'id' => $idOrder,
                'total' => $orderTotal['Item']['order_total'],
                'dtime_total' => date("Y-m-d H:i:s")));

        return $this->Order->save($o);
    }

    private function listCategoryProducts() {
        $cs = $this->Category->find('all');
        $products = array();
        foreach ($cs as $c) {
            foreach ($c['Product'] as $p) {
                $k = $p['id'];
                $v = $c['Category']['name'] . " " . $p['name'];
                $products[$k] = $v;
            }
        }
        return $products;
    }

}
