<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    public $uses = array("Bs.User", "Bs.Admin", "Bs.Ejecutivo", "Bs.Motorista");

    /**
     * Components
     *
     * @var array
     */

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['id'] = String::uuid();
            
            if ($this->User->save($this->request->data)) {

                $this->Session->setFlash(__('Se ha creado el usuario.'));

                $u = $this->User->read();
                $ue = $this->Auth->user();

                $this->Recording->save(array(
                    'user_id' => $u['User']['id'],
                    'user_executor_id' => $ue['User']['id'],
                    'category' => $this->Recording->CREATE_USER,
                    'subject' => "se ha creado el usuario " . $u['User']['username'] . " por " . $ue['User']['username'] . ".",
                ));


                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('No se pudo crear el usaurio...'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->Auth->loggedIn()) {
            return $this->redirect("/");
        }

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
            } else {
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

    function logout() {
        $this->redirect($this->Auth->logout());
    }

    function setAdminRole($id) {
        $this->Admin->create();
        $this->Admin->set(array(
            'id' => String::uuid(),
            'user_id' => $id
        ));
        if ($this->Admin->save()) {
            $this->Session->setFlash(__('Se ha asignado el rol de administrador.'));


            $u = $this->Admin->read();
            $ue = $this->Auth->user();
            $this->Recording->save(array(
                'user_id' => $u['Admin']['user_id'],
                'user_executor_id' => $ue['User']['id'],
                'category' => $this->Recording->ADD_ADMIN_ROLE,
                'subject' => "se ha agregado el rol de administrador a " . $u['User']['username'] . " por " . $ue['User']['username'] . ".",
            ));
            return $this->redirect(array('action' => 'view', $id));
        } else {
            $this->Session->setFlash(__('No se pudo agregar el rol de administrador.'));
        }
    }

    function unsetAdminRole($id) {
        $this->Admin->id = $id;
        if (!$this->Admin->exists()) {
            throw new NotFoundException(__('Invalid admin'));
        }


        $u = $this->Admin->read();
        $ue = $this->Auth->user();
        if ($this->Admin->delete()) {
            $this->Session->setFlash(__('Se ha desasignado el rol de administrador.'));


            $this->Recording->save(array(
                'user_id' => $u['Admin']['user_id'],
                'user_executor_id' => $ue['User']['id'],
                'category' => $this->Recording->REVOKE_ADMIN_ROLE,
                'subject' => "se ha revocado el rol de administrador a " . $u['User']['username'] . " por " . $ue['User']['username'] . ".",
            ));
        } else {
            $this->Session->setFlash(__('The admin could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'view', $u['User']['id']));
    }

    function setEjecutivoRole($id) {
        $this->Ejecutivo->create();
        $this->Ejecutivo->set(array(
            'id' => String::uuid(),
            'user_id' => $id
        ));
        if ($this->Ejecutivo->save()) {
            $this->Session->setFlash(__('Se ha asignado el rol de ejecutivo.'));

            $u = $this->Ejecutivo->read();
            $ue = $this->Auth->user();
            $this->Recording->save(array(
                'user_id' => $u['Ejecutivo']['user_id'],
                'user_executor_id' => $ue['User']['id'],
                'category' => $this->Recording->ADD_EJECUTIVO_ROLE,
                'subject' => "se ha agregado el rol de ejecutivo a " . $u['User']['username'] . " por " . $ue['User']['username'] . ".",
            ));
            return $this->redirect(array('action' => 'view', $id));
        } else {
            $this->Session->setFlash(__('The Ejecutivo could not be saved. Please, try again.'));
        }
    }

    function unsetEjecutivoRole($id) {
        $this->Ejecutivo->id = $id;
        if (!$this->Ejecutivo->exists()) {
            throw new NotFoundException(__('Invalid ejecutivo'));
        }
        $u = $this->Ejecutivo->read();
        $ue = $this->Auth->user();

        if ($this->Ejecutivo->delete()) {
            $this->Session->setFlash(__('Se ha desasignado el rol de ejecutivo.'));


            $this->Recording->save(array(
                'user_id' => $u['Ejecutivo']['user_id'],
                'user_executor_id' => $ue['User']['id'],
                'category' => $this->Recording->REVOKE_EJECUTIVO_ROLE,
                'subject' => "se ha revocado el rol de ejecutivo a " . $u['User']['username'] . " por " . $ue['User']['username'] . ".",
            ));
        } else {
            $this->Session->setFlash(__('The Ejecutivo could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'view', $u['User']['id']));
    }

    function setMotoristaRole($id) {
        $this->Motorista->create();
        $this->Motorista->set(array(
            'id' => String::uuid(),
            'user_id' => $id
        ));
        if ($this->Motorista->save()) {
            $this->Session->setFlash(__('Se ha asignado el rol de motorista.'));


            $u = $this->Motorista->read();
            $ue = $this->Auth->user();
            $this->Recording->save(array(
                'user_id' => $u['Motorista']['user_id'],
                'user_executor_id' => $ue['User']['id'],
                'category' => $this->Recording->ADD_MOTORISTA_ROLE,
                'subject' => "se ha agregado el rol de motorista a " . $u['User']['username'] . " por " . $ue['User']['username'] . ".",
            ));
            return $this->redirect(array('action' => 'view', $id));
        } else {
            $this->Session->setFlash(__('The Motorista could not be saved. Please, try again.'));
        }
    }

    function unsetMotoristaRole($id) {
        $this->Motorista->id = $id;
        if (!$this->Motorista->exists()) {
            throw new NotFoundException(__('Invalid motorista'));
        }

        $u = $this->Motorista->read();
        $ue = $this->Auth->user();

        if ($this->Motorista->delete()) {
            $this->Session->setFlash(__('Se ha desasignado el rol de motorista.'));


            $this->Recording->save(array(
                'user_id' => $u['Motorista']['user_id'],
                'user_executor_id' => $ue['User']['id'],
                'category' => $this->Recording->REVOKE_MOTORISTA_ROLE,
                'subject' => "se ha revocado el rol de motorista a " . $u['User']['username'] . " por " . $ue['User']['username'] . ".",
            ));
        } else {
            $this->Session->setFlash(__('The Motorista could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'view', $u['User']['id']));
    }

}
