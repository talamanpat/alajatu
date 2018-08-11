<?php

App::uses('Controller', 'Controller');
date_default_timezone_set("America/Santiago");

class AppController extends Controller {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array(
        'Session',
        'Bs.OrderState',
        'Bs.Recording',
        'Bs.Configuration'
    );

    public function beforeFilter() {
        
    }

}
