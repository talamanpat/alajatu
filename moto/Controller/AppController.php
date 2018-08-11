<?php

App::uses('BsAppController', 'Bs.Controller');

class AppController extends BsAppController {
	public $helpers = array('Html', 'Form','Session');
    
        
        public function beforeFilter() {         
            if($this->Auth->loggedIn()){
                $u = $this->Auth->user();
                if($u['Motorista']['id']==null){
                   $this->Session->setFlash(__('usted no es motorista...')); 
                    return $this->redirect($this->Auth->logout());
                }
            }
            

            
        }
        
}
