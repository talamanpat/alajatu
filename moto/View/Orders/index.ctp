<div class="orders ">
	<h2><?php echo __('Ordenes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('proveedor_id'); ?></th>
			<th><?php echo $this->Paginator->sort('dtime_confirmation'); ?></th>
                	<th><?php echo $this->Paginator->sort('comments'); ?></th>
                	<th><?php echo $this->Paginator->sort('comments_int'); ?></th>
                        <th><?php echo $this->Paginator->sort('total'); ?></th>
                        
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['code']); ?>&nbsp;</td>
		<td><?php echo h($states[$order['Order']['state']]); ?>&nbsp;</td>
		<td><?php echo h($order['Proveedor']['name_company']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['dtime_confirmation']); ?>&nbsp;</td>
            	<td><?php echo h($order['Order']['comments']); ?>&nbsp;</td>
            	<td><?php echo h($order['Order']['comments_int']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['total']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('ver'), array('action' => 'view', $order['Order']['id']),array('target'=>'_blank')); ?>
			<?php $statesF = array_flip($states);
                        echo $order['Order']['state']== $statesF['MAKING']||$order['Order']['state']== $statesF['READY']? $this->Html->link(__('salió a despacho?'), array('action' => 'deliveryOrder', $order['Order']['id'])):""; 
		        echo $order['Order']['state']== $statesF['DELIVERY']? $this->Html->link(__('Ya se ha entregado?'), array('action' => 'orderDispatched', $order['Order']['id'])):""; ?>
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

<script type="text/javascript">
setTimeout(function(){
   window.location.reload(1);
}, 30000);
</script>