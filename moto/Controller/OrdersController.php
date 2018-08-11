<?php

App::uses('AppController', 'Controller');

class OrdersController extends AppController {

    public $uses = array('Bs.Order', 'Bs.Item', 'Bs.Motorista', 'Bs.Proveedor', 'Bs.Category');

    public function index() {
        $ue = $this->Auth->user();
        $this->Order->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' =>
            array('Order.state' =>
                array(
                    $this->OrderState->states['MAKING'],
                    $this->OrderState->states['READY'],
                    $this->OrderState->states['DELIVERY'],
                ),
                'Order.motorista_id' => $ue['Motorista']['id']
            ),
            'order' => array(
                'Order.state' => 'asc',
                'Order.dtime_confirmation' => 'asc'
            ),
            'contain' => array('Item','Proveedor')
        );
        $this->set('orders', $this->Paginator->paginate());
        $this->set('products', $this->listCategoryProducts());
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

        $this->set('order', $order);
        $this->set('states', array_flip($this->OrderState->states));
    }

    public function deliveryOrder($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        //variables a utilizar
        $u = $this->Auth->user();
        $this->Order->recursive = -1;
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $id)));
        
         //validaciones
        if ($order['Order']['motorista_id'] != $u['Motorista']['id']) {
            $this->Session->setFlash(__('la orden ya se ha asignado a otra moto...'));
            $this->redirectToIndex();
        }
        if ($order['Order']['state'] == $this->OrderState->states['DELIVERY']) {
            $this->Session->setFlash(__('ya se ha marcado esta orden en entrega anteriormente'));
            $this->redirectToIndex();
        }


        if (!($order['Order']['state'] == $this->OrderState->states['READY']
                || $order['Order']['state'] == $this->OrderState->states['MAKING'])) {
            $this->Session->setFlash(__('Entrada inválida'));
            $this->redirectToIndex();
        }
        
        
        $order['Order']['state'] = $this->OrderState->states['DELIVERY'];
        $order['Order']['dtime_delivery'] = date("Y-m-d H:i:s");
        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['DELIVER_ORDER'],
                'subject' =>
                'Se ha puesto el pedido ' . $order['Order']['code'] . ' en estado despachado por el motorista ' . $u['User']['username'],
            ));

            //TODO:mails

            $this->Session->setFlash(__('Se ha puesto la orden en despacho'));
        } else {
            $this->Session->setFlash(__('No se ha podido realizar la acción...'));
            debug($this->Order->invalidFields());
        }
        $this->redirect(array('action' => 'index'));
    }

    public function orderDispatched($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        //variables a utilizar
        $u = $this->Auth->user();
        $this->Order->recursive = -1;
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $id)));
        
        
         //validaciones
        if ($order['Order']['motorista_id'] != $u['Motorista']['id']) {
            $this->Session->setFlash(__('la orden ya se ha asignado a otra moto...'));
            $this->redirectToIndex();
        }
        if ($order['Order']['state'] == $this->OrderState->states['DISPATCHED']) {
            $this->Session->setFlash(__('ya se ha marcado esta orden en entregado anteriormente'));
            $this->redirectToIndex();
        }


        if ($order['Order']['state'] != $this->OrderState->states['DELIVERY']) {
            $this->Session->setFlash(__('Entrada inválida'));
            $this->redirectToIndex();
        }
        
        
        
        $order['Order']['state'] = $this->OrderState->states['DISPATCHED'];
        $order['Order']['dtime_dispatched'] = date("Y-m-d H:i:s");
        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['DELIVER_ORDER'],
                'subject' =>
                'Se ha puesto el pedido ' . $order['Order']['code'] . ' en estado despachado por el motorista ' . $u['User']['username'],
            ));

            //TODO:mails

            $this->Session->setFlash(__('Se ha puesto la orden en entregado'));
        } else {
            $this->Session->setFlash(__('No se ha podido realizar la acción...'));
            debug($this->Order->invalidFields());
        }
        $this->redirect(array('action' => 'index'));
    }

    private function listCategoryProducts() {
        $cs = $this->Category->find('all');
        $products = array();
        foreach ($cs as $c) {
            foreach ($c['Product'] as $p) {
                $k = $p['id'];
                $v = $c['Category']['name'] . " " . $p['name'] . " (" . $p['description'] . ")";
                $products[$k] = $v;
            }
        }
        return $products;
    }

    private function redirectToIndex() {
        $this->redirect(array('action' => 'index'));
    }

}
