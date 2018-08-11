<div class="orders view">
    <h2><?php echo __('Pedidos'); ?></h2>
    <dl>
        <dt><?php echo __('Code'); ?></dt>
        <dd>
            <?php echo h($order['Order']['code']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('State'); ?></dt>
        <dd>
            <?php echo h($states[$order['Order']['state']]); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Dtime Solicitud'); ?></dt>
        <dd>
            <?php echo h($order['Order']['dtime_solicited']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Dtime Confirmacion'); ?></dt>
        <dd>
            <?php echo h($order['Order']['dtime_confirmation']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Dtime Cocina'); ?></dt>
        <dd>
            <?php echo h($order['Order']['dtime_making']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Dtime Despacho'); ?></dt>
        <dd>
            <?php echo h($order['Order']['dtime_delivery']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Dtime Entrega'); ?></dt>
        <dd>
            <?php echo h($order['Order']['dtime_dispatched']); ?>
            &nbsp;
        </dd>

    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Lista de pedidos'), array('action' => 'index')); ?> </li>	
            <li><?php $statesF = array_flip($states);
                        echo $order['Order']['state']== $statesF['ASSIGNING']? $this->Html->link(__('aceptar'), array('action' => 'aceptOrder', $order['Order']['id'])):""; ?>
            </li>
            <li> <?php         echo $order['Order']['state']== $statesF['MAKING']? $this->Html->link(__('está preparado?'), array('action' => 'orderReady', $order['Order']['id'])):""; ?>
            </li>
            <li><?php	echo $order['Order']['state']== $statesF['MAKING']||$order['Order']['state']== $statesF['READY']? $this->Html->link(__('salió a despacho?'), array('action' => 'deliveryOrder', $order['Order']['id'])):""; ?>
		</li>
    </ul>
</div>
<div class="related">



    <section class="cart">
        <?php
        echo $this->element('Orders/Cart', array(
            "order" => $order
        ));
        ?>
    </section>





    <h3><?php echo __('Comments'); ?></h3>
    <p><?php echo h($order['Order']['comments']); ?></p>

</div>
