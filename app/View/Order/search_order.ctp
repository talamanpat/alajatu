<h2>Buscar pedido</h2>
<?php

if (empty( $orders)) {

    echo $this->Form->create('Customer', array('type' => 'get'));
    echo $this->Form->input('email');
    echo $this->Form->end('Buscar');
} else {
    foreach ($orders as $o) {
        echo '<h3>' . $this->Html->link("Orden nº" . $o['Order']['code'], array('controller' => 'order', 'action' => 'follow', $o['Order']['id'])) . '</h3>';
    }
}
?>
