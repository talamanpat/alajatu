<div class="orders ">
	<h2><?php echo __('Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
<!--			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('correlative'); ?></th>-->
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<!--<th><?php echo $this->Paginator->sort('active'); ?></th>-->
			<th><?php echo $this->Paginator->sort('dtime_solicited'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('motorista_id'); ?></th>
			<th><?php echo $this->Paginator->sort('proveedor_id'); ?></th>
			<!--<th><?php echo $this->Paginator->sort('ejecutivo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('create_time'); ?></th>-->
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($orders as $order): ?>
	<tr>
<!--		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['correlative']); ?>&nbsp;</td>-->
		<td><?php echo h($order['Order']['code']); ?>&nbsp;</td>
		<td><?php echo h($states[$order['Order']['state']]); ?>&nbsp;</td>
		<!--<td><?php echo h($order['Order']['active']); ?>&nbsp;</td>-->
		<td><?php echo h($order['Order']['dtime_solicited']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Customer']['email'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $order['Motorista']['id']!=null? $this->Html->link($motoristas[$order['Motorista']['id']], array('controller' => 'motoristas', 'action' => 'view', $order['Motorista']['id'])):""; ?>
		</td>
		<td>
			<?php echo $this->Html->link($order['Proveedor']['name_company'], array('controller' => 'proveedores', 'action' => 'view', $order['Proveedor']['id'])); ?>
		</td>
<!--		<td>
			<?php echo $this->Html->link($order['Ejecutivo']['id'], array('controller' => 'ejecutivos', 'action' => 'view', $order['Ejecutivo']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['create_time']); ?>&nbsp;</td>-->
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?>
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