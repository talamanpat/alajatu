<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('correlative'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('dtime_solicitud'); ?></th>
			<th><?php echo $this->Paginator->sort('dtime_confirmacion'); ?></th>
			<th><?php echo $this->Paginator->sort('dtime_cocina'); ?></th>
			<th><?php echo $this->Paginator->sort('dtime_despacho'); ?></th>
			<th><?php echo $this->Paginator->sort('dtime_entrega'); ?></th>
			<th><?php echo $this->Paginator->sort('pay_mode'); ?></th>
			<th><?php echo $this->Paginator->sort('comments'); ?></th>
			<th><?php echo $this->Paginator->sort('terms_conditions'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('motorista_id'); ?></th>
			<th><?php echo $this->Paginator->sort('proveedor_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ejecutivo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('create_time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['correlative']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['code']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['state']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['active']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['dtime_solicitud']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['dtime_confirmacion']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['dtime_cocina']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['dtime_despacho']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['dtime_entrega']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['pay_mode']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['comments']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['terms_conditions']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Customer']['full_name'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($order['Motorista']['id'], array('controller' => 'motoristas', 'action' => 'view', $order['Motorista']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($order['Proveedor']['name_company'], array('controller' => 'proveedores', 'action' => 'view', $order['Proveedor']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($order['Ejecutivo']['id'], array('controller' => 'ejecutivos', 'action' => 'view', $order['Ejecutivo']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['create_time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Motoristas'), array('controller' => 'motoristas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Motorista'), array('controller' => 'motoristas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Proveedores'), array('controller' => 'proveedores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proveedor'), array('controller' => 'proveedores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ejecutivos'), array('controller' => 'ejecutivos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ejecutivo'), array('controller' => 'ejecutivos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Records'), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Record'), array('controller' => 'records', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
