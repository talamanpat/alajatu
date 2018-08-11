<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session');

    public function login() {
        if ($this->request->is('post')) {
            $u = $this->User->find('first', array(
                'conditions' => array('User.username' => $this->request->data['User']['username'])
            ));
            if ($u != null) {
                if ($u['User']['password'] == $this->data['User']['password']) {
                    
                    if ($this->Auth->login($u)) {     
                    $this->Session->setFlash(__('logueado.'));           
                    return $this->redirect($this->Auth->redirect());
                    } else {
                        $this->Session->setFlash(__('no se pudo loguear.')); 
                    }
                } else {
                        $this->Session->setFlash(__('usuario o contraseña incorrecta...')); 
                }
            }else{
                $this->Session->setFlash(__('usuario no existe...')); 
            }
//            if ($this->Auth->login()) {     
//                $this->Session->setFlash(__('logueado.'));           
//                return $this->redirect($this->Auth->redirect());
//            } else {
//                $this->Session->setFlash(__('no logueado.'));
//                $this->Session->setFlash(
//                        __('Username or password is incorrect'), 'default', array(), 'auth'
//                );
//            }
        }
    }
    
    function create(){
        
        
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }

}
