<div class="orders view">
    <h2><?php echo __('Order'); ?></h2>
    <dl>
        <dt><?php echo __('Id Order'); ?></dt>
        <dd>
            <?php echo h($order['Order']['id']); ?>
            &nbsp;
        </dd>
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
        <dt><?php echo __('Dtime asignando'); ?></dt>
        <dd>
            <?php echo h($order['Order']['dtime_assigning']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Dtime Cocina'); ?></dt>
        <dd>
            <?php echo h($order['Order']['dtime_making']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Dtime listo'); ?></dt>
        <dd>
            <?php echo h($order['Order']['dtime_ready']); ?>
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
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Lista de pedidos'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $order['Order']['id'])); ?>
	</li>
        <li>	<?php $statesF = array_flip($states);
        echo $order['Order']['state']== $statesF['CONFIRMATION']? $this->Html->link(__('NO VALIDA'), array('action' => 'orderNoValid', $order['Order']['id']),array(),"Estás seguro que desea poner la orden como no valida?"):""; ?>
	</li>
        <li>	<?php 
        echo $this->Html->link(__('Cancelar'), array('action' => 'cancelOrder', $order['Order']['id']),array(),"Estás seguro que desea poner la orden como cancelada?"); ?>
	</li>
        <li>	<?php 
        echo $this->Html->link(__('Error'), array('action' => 'orderError', $order['Order']['id']),array(),"Estás seguro que desea poner la orden como error?"); ?>
	</li>
</ul>
</div>
<div class="related">

    <h2>Datos</h2>

    <table>
        <tr>
            <th><?php echo __('Cliente'); ?>:</th>
            <td><?php echo $this->Html->link($order['Customer']['full_name'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?></td>
        </tr>
        <tr>
            <th><?php echo __('Email'); ?>:</th>
            <td><?php echo $this->Html->link($order['Customer']['email'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?></td>
        </tr>
        <tr>
            <th><?php echo __('Teléfono'); ?>:</th>
            <td><?php echo $order['Customer']['phone'] ?></td>
        </tr>
        <tr>
        <tr>
            <th><?php echo __('Dirección'); ?></th>
            <td>
                <?php echo h($order['Order']['address']); ?>
            </td>
        </tr>
        <tr>  
            <th><?php echo __('Info Dirección'); ?></th>
            <td>
                <?php echo h($order['Order']['address_info']); ?>
            </td>
        </tr>
        <tr>  
            <th><?php echo __('Comentarios internos'); ?></th>
            <td>
                <?php echo h($order['Order']['comments_int']); ?>
            </td>
        </tr>
    </table>

    <h2>Asignaciones</h2>
    <?php
    echo $this->Form->create(null, array('controller' => 'orders', 'action' => 'assignations'));
    echo $this->Form->input("id",array('type'=>'hidden','value'=>$order['Order']['id']));
    echo $this->Form->input(
            'proveedor_id', array('options' => $proveedores
        , 'default' => $order['Order']['proveedor_id'],
        'empty' => '(asignar uno)'
            )
    );
    echo $this->Form->input(
            'motorista_id', array('options' => $motoristas
        , 'default' => $order['Order']['motorista_id'],
        'empty' => '(asignar uno)'
            )
    );
    echo $this->Form->input(
            'state', array('options' => $statesCheckbox
        , 'default' => $order['Order']['state']
            )
    );
    echo $this->Form->end('Asignar');
    ?>

    <section class="cart">
        <?php
        echo $this->element('Orders/Cart', array(
            "order" => $order,
            
        ));
        ?>
    </section>





    <h3><?php echo __('Comments'); ?></h3>
    <p><?php echo h($order['Order']['comments']); ?></p>



    <h3><?php echo __('Historiales'); ?></h3>
<?php if (!empty($order['Record'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Subject'); ?></th>
                <th><?php echo __('Detail'); ?></th>
                <!--<th><?php echo __('Category'); ?></th>-->
                <th><?php echo __('Datetime'); ?></th>
            </tr>
    <?php foreach ($order['Record'] as $record): ?>
                <tr>
                    <td><?php echo $record['subject']; ?></td>
                    <td><?php echo $record['detail']; ?></td>
                    <!--<td><?php echo $record['category']; ?></td>-->
                    <td><?php echo $record['datetime']; ?></td>
                </tr>
        <?php endforeach; ?>
        </table>
<?php endif; ?>


</div>
<?php
//debug($order); ?>