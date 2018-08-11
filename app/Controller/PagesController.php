<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {
    public $uses = array('Bs.Category', 'Bs.Product', 'Bs.Comuna');

    public function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingViewException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    public function home() {
//        $ps = $this->Category->Product->find('all', array(
//            'conditions' => array('Product.active' => true)
//        ));
        //  $this->Category->contain('Product');
        $cs = $this->Category->find('all', array(
            'conditions' => array(
                'Category.active' => true,
            ),
            'order' => array('Category.order'),
                )
        );
        //$this->set('cs', $cs);
        $comunas = $this->Comuna->getActivesList() ;//find('list'); 
        $OPEN = $this->Configuration->getOPEN();
        $this->set(compact('comunas', 'cs','OPEN'));
        $this->set('title_for_layout', 'Home');
    }

    public function termsConditions(){
        
    }
    public function updateBrowser(){
        
    }
    
    public function storeClosed() {
        $this->layout = "ajax";
    }

}