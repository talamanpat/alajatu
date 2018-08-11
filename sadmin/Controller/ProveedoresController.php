<?php

App::uses('AppController', 'Controller');

/**
 * Proveedores Controller
 *
 * @property Proveedor $Proveedor
 * @property PaginatorComponent $Paginator
 */
class ProveedoresController extends AppController {

    public $components = array('Paginator');
    public $uses = array("Bs.Proveedor");

    public function index() {
        $this->Proveedor->recursive = 0;
        $this->set('proveedores', $this->Paginator->paginate());
    }

    public function view($id = null) {
        if (!$this->Proveedor->exists($id)) {
            throw new NotFoundException(__('Invalid proveedor'));
        }
        $options = array('conditions' => array('Proveedor.' . $this->Proveedor->primaryKey => $id));
        $this->set('proveedor', $this->Proveedor->find('first', $options));
    }

    public function add($idUser) {
        if ($this->request->is('post')) {
            $this->Proveedor->create();
            if ($this->Proveedor->save($this->request->data)) {
                $this->Session->setFlash(__('The proveedor has been saved.'));
                return $this->redirect(array('controller'=>'users','action' => 'view',$this->request->data['Proveedor']['user_id']));
            } else {
                $this->Session->setFlash(__('The proveedor could not be saved. Please, try again.'));
            }
        }
        $comunas = $this->Proveedor->Comuna->find('list');
        //$users = $this->Proveedor->User->find('list');
        $user = $idUser;
        
        $this->set(compact('comunas', 'user'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Proveedor->exists($id)) {
            throw new NotFoundException(__('Invalid proveedor'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Proveedor->save($this->request->data)) {
                $this->Session->setFlash(__('The proveedor has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The proveedor could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Proveedor.' . $this->Proveedor->primaryKey => $id));
            $this->request->data = $this->Proveedor->find('first', $options);
        }
        $comunas = $this->Proveedor->Comuna->find('list');
        $users = $this->Proveedor->User->find('list');
        $this->set(compact('comunas', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Proveedor->id = $id;
        if (!$this->Proveedor->exists()) {
            throw new NotFoundException(__('Invalid proveedor'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Proveedor->delete()) {
            $this->Session->setFlash(__('The proveedor has been deleted.'));
        } else {
            $this->Session->setFlash(__('The proveedor could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
