<div class="orders">
	<h2><?php echo __('Órdenes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('dtime_confirmation'); ?></th>
                        <th>Items</th>
			<th><?php echo $this->Paginator->sort('comments'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['code']); ?>&nbsp;</td>
		<td><?php echo h($states[$order['Order']['state']]); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['dtime_confirmation']); ?>&nbsp;</td>
                <td>
                    <table>
                        
                    <?php
                    foreach ($order['Item'] as $p) {
                        echo '<tr><td>'.$products[$p['product_id']].'</td><td>x'.$p['volume']. '</td> </tr>';
                    }
                    ?>
                           
                    </table>
                    
                </td>
		<td><?php echo h($order['Order']['comments']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('ver'), array('action' => 'view', $order['Order']['id']),array('target'=>'_blank')); ?>
			<?php $statesF = array_flip($states);
                        echo $order['Order']['state']== $statesF['ASSIGNING']? 
                                $this->Html->link(__('aceptar'), array('action' => 'aceptOrder', $order['Order']['id'])).
                                $this->Html->link(__('declinar'), array('action' => 'declineOrder', $order['Order']['id']))
                                :""; 
                        echo $order['Order']['state']== $statesF['MAKING']? $this->Html->link(__('está preparado?'), array('action' => 'orderReady', $order['Order']['id'])):""; 
			echo $order['Order']['state']== $statesF['MAKING']||$order['Order']['state']== $statesF['READY']? $this->Html->link(__('salió a despacho?'), array('action' => 'deliveryOrder', $order['Order']['id'])):""; ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<br><br><br>
<div class="related">
    <?php echo $this->Html->link(__('Ordenes completadas'), array('action' => 'dispatched'));
                                ?>
    
</div>
<script type="text/javascript">
setTimeout(function(){
   window.location.reload(1);
}, 30000);
</script>