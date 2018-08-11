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
                    $this->OrderState->states['ASSIGNING'],
                    $this->OrderState->states['MAKING'],
                    $this->OrderState->states['READY'],
                ),
                'Order.proveedor_id' => $ue['Proveedor']['id']),
            'order' => array(
                'Order.state' => 'asc',
                'Order.dtime_confirmation' => 'asc'
            ),
            'contain' => array('Item')
        );
        $this->set('orders', $this->Paginator->paginate());
        $this->set('products', $this->listCategoryProducts());
        $this->set('states', array_flip($this->OrderState->states));
    }
    public function dispatched() {
        $ue = $this->Auth->user();
        $this->Order->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' =>
            array('Order.state' =>
                array(
                    $this->OrderState->states['DISPATCHED'],
                ),
                'Order.proveedor_id' => $ue['Proveedor']['id']),
            'order' => array(
                'Order.state' => 'asc',
                'Order.dtime_confirmation' => 'asc'
            ),
            'contain' => array('Item')
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
        $u = $this->Auth->user();

        //validaciones
        if ($order['Order']['proveedor_id'] != $u['Proveedor']['id']) {
            $this->Session->setFlash(__('Esta orden no le pertenece.'));
            $this->redirectToIndex();
        }

        $this->set('order', $order);
        $this->set('states', array_flip($this->OrderState->states));
    }

    public function aceptOrder($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }

        //variables a utilizar
        $u = $this->Auth->user();
        $this->Order->recursive = -1;
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $id)));


        //validaciones
        if ($order['Order']['proveedor_id'] != $u['Proveedor']['id']) {
            $this->Session->setFlash(__('la orden ya se ha asignado a otra cocina...'));
            $this->redirectToIndex();
        }
        if ($order['Order']['state'] == $this->OrderState->states['MAKING']) {
            $this->Session->setFlash(__('ya se ha aceptado esta orden anteriormente'));
            $this->redirectToIndex();
        }

        if ($order['Order']['state'] != $this->OrderState->states['ASSIGNING']) {
            $this->Session->setFlash(__('Entrada inválida'));
            $this->redirectToIndex();
        }


        //ejecutar
        $order['Order']['state'] = $this->OrderState->states['MAKING'];
        $order['Order']['dtime_making'] = date("Y-m-d H:i:s");
        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['ASSIGN_ORDER'],
                'subject' =>
                'Se ha aceptado el pedido ' . $order['Order']['code'] . ' por la cocina ' . $u['User']['username'],
            ));

            //TODO:mails

            $this->Session->setFlash(__('Se ha aceptado la orden!'));
        } else {
            $this->Session->setFlash(__('No se ha podido aceptar...'));
            debug($this->Order->invalidFields());
        }
        $this->redirect(array('action' => 'index'));
    }

    public function declineOrder($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }


        //variables a utilizar
        $u = $this->Auth->user();
        $this->Order->recursive = -1;
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $id)));


        //validaciones
        if ($order['Order']['proveedor_id'] != $u['Proveedor']['id']) {
            $this->Session->setFlash(__('la orden ya se ha asignado a otra cocina...'));
            $this->redirectToIndex();
        }
        if ($order['Order']['state'] == $this->OrderState->states['MAKING']) {
            $this->Session->setFlash(__('ya se ha aceptado esta orden anteriormente'));
            $this->redirectToIndex();
        }


        if ($order['Order']['state'] != $this->OrderState->states['ASSIGNING']) {
            $this->Session->setFlash(__('Entrada inválida'));
            $this->redirectToIndex();
        }



        //ejecuta
//$order['Order']['state'] = $this->OrderState->states['ASSIGNING'];
        $this->Order->validator()->remove('proveedor_id');
        $order['Order']['proveedor_id'] = null;
        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['ASSIGN_ORDER'],
                'subject' =>
                'Se ha rechazado el pedido ' . $order['Order']['code'] . ' por la cocina ' . $u['User']['username'],
            ));

            //TODO:mails

            $this->Session->setFlash(__('Se ha declinado la orden!'));
        } else {
            $this->Session->setFlash(__('No se ha podido declinar...'));
            debug($this->Order->invalidFields());
        }
        $this->redirect(array('action' => 'index'));
    }

    public function orderReady($id) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        //variables a utilizar
        $u = $this->Auth->user();
        $this->Order->recursive = -1;
        $order = $this->Order->find("first", array('conditions' => array('Order.id' => $id)));


        //validaciones

        if ($order['Order']['proveedor_id'] != $u['Proveedor']['id']) {
            $this->Session->setFlash(__('la orden ya se ha asignado a otra cocina...'));
            $this->redirectToIndex();
        }
        if ($order['Order']['state'] == $this->OrderState->states['READY']) {
            $this->Session->setFlash(__('ya se ha puesto en estado preparado anteriormente'));
            $this->redirectToIndex();
        }

        if ($order['Order']['state'] != $this->OrderState->states['MAKING']) {
            $this->Session->setFlash(__('Entrada inválida'));
            $this->redirectToIndex();
        }





        //ejecuta
        $order['Order']['state'] = $this->OrderState->states['READY'];
        $order['Order']['dtime_ready'] = date("Y-m-d H:i:s");

        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['DELIVER_ORDER'],
                'subject' =>
                'Se ha puesto el pedido ' . $order['Order']['code'] . ' en estado preparado por la cocina ' . $u['User']['username'],
            ));

            //TODO:mails

            $this->Session->setFlash(__('Se ha puesto la orden en estado preparado'));
        } else {
            $this->Session->setFlash(__('No se ha podido realizar la acción...'));
            debug($this->Order->invalidFields());
        }
        $this->redirect(array('action' => 'index'));
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

        if ($order['Order']['proveedor_id'] != $u['Proveedor']['id']) {
            $this->Session->setFlash(__('la orden ya se ha asignado a otra cocina...'));
            $this->redirectToIndex();
        }
        if ($order['Order']['state'] == $this->OrderState->states['DELIVERY']) {
            $this->Session->setFlash(__('ya se ha puesto la orden en despacho anteriormente'));
            $this->redirectToIndex();
        }


        if (!($order['Order']['state'] == $this->OrderState->states['MAKING'] || $order['Order']['state'] == $this->OrderState->states['READY'])) {
            $this->Session->setFlash(__('Entrada inválida'));
            $this->redirectToIndex();
        }



        //ejecuta

        $order['Order']['state'] = $this->OrderState->states['DELIVERY'];
        $order['Order']['dtime_delivery'] = date("Y-m-d H:i:s");
        if ($this->Order->save($order)) {
            $this->Recording->save(array(
                'customer_id' => $order['Order']['customer_id'],
                'order_id' => $order['Order']['id'],
                'user_executor_id' => $u['User']['id'],
                'category' => $this->Recording->categories['DELIVER_ORDER'],
                'subject' =>
                'Se ha puesto el pedido ' . $order['Order']['code'] . ' en estado despachado por la cocina ' . $u['User']['username'],
            ));

            //TODO:mails

            $this->Session->setFlash(__('Se ha puesto la orden en despacho'));
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
