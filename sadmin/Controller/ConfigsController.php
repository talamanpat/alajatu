<?php

App::uses('AppController', 'Controller');

/**
 * Configs Controller
 *
 * @property Config $Config
 * @property PaginatorComponent $Paginator
 */
class ConfigsController extends AppController {

    public $components = array('Paginator');

    public function index() {
        $this->Config->recursive = 0;
        $this->set('configs', $this->Paginator->paginate());
    }

    public function view($id = null) {
        if (!$this->Config->exists($id)) {
            throw new NotFoundException(__('Invalid config'));
        }
        $options = array('conditions' => array('Config.' . $this->Config->primaryKey => $id));
        $this->set('config', $this->Config->find('first', $options));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Config->create();
            if ($this->Config->save($this->request->data)) {
                $this->Session->setFlash(__('The config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The config could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        if (!$this->Config->exists($id)) {
            throw new NotFoundException(__('Invalid config'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Config->save($this->request->data)) {
                $this->Session->setFlash(__('The config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The config could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Config.' . $this->Config->primaryKey => $id));
            $this->request->data = $this->Config->find('first', $options);
        }
    }

    public function delete($id = null) {
        $this->Config->id = $id;
        if (!$this->Config->exists()) {
            throw new NotFoundException(__('Invalid config'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Config->delete()) {
            $this->Session->setFlash(__('The config has been deleted.'));
        } else {
            $this->Session->setFlash(__('The config could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function openStore() {
        $OPEN = $this->Config->find('first',array('conditions'=>array('name'=>'OPEN')));
        $OPEN['Config']['value_bool']=1;
        
            if ($this->Config->save($OPEN)) {
                $this->Session->setFlash(__('The config has been saved.'));
                return $this->redirect("/");
            } else {
                $this->Session->setFlash(__('The config could not be saved. Please, try again.'));
                return $this->redirect("/");
            }
    }

    public function closeStore() {
        $OPEN = $this->Config->find('first',array('conditions'=>array('name'=>'OPEN')));
        $OPEN['Config']['value_bool']=0;
        
            if ($this->Config->save($OPEN)) {
                $this->Session->setFlash(__('The config has been saved.'));
                return $this->redirect("/");
            } else {
                $this->Session->setFlash(__('The config could not be saved. Please, try again.'));
                return $this->redirect("/");
            }
    }
}