<div class="customers view">
<h2><?php echo __('Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address Info'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['address_info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comuna'); ?></dt>
		<dd>
			<?php echo $this->Html->link($customer['Comuna']['name'], array('controller' => 'comunas', 'action' => 'view', $customer['Comuna']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $customer['Customer']['id']), null, __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comunas'), array('controller' => 'comunas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comuna'), array('controller' => 'comunas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Records'), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Record'), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($customer['Order'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Correlative'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Dtime Solicitud'); ?></th>
		<th><?php echo __('Dtime Confirmacion'); ?></th>
		<th><?php echo __('Dtime Cocina'); ?></th>
		<th><?php echo __('Dtime Despacho'); ?></th>
		<th><?php echo __('Dtime Entrega'); ?></th>
		<th><?php echo __('Pay Mode'); ?></th>
		<th><?php echo __('Comments'); ?></th>
		<th><?php echo __('Terms Conditions'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Motorista Id'); ?></th>
		<th><?php echo __('Proveedor Id'); ?></th>
		<th><?php echo __('Ejecutivo Id'); ?></th>
		<th><?php echo __('Create Time'); ?></th>
		<th><?php echo __('Comments Int'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($customer['Order'] as $order): ?>
		<tr>
			<td><?php echo $order['id']; ?></td>
			<td><?php echo $order['correlative']; ?></td>
			<td><?php echo $order['code']; ?></td>
			<td><?php echo $order['state']; ?></td>
			<td><?php echo $order['active']; ?></td>
			<td><?php echo $order['dtime_solicitud']; ?></td>
			<td><?php echo $order['dtime_confirmacion']; ?></td>
			<td><?php echo $order['dtime_cocina']; ?></td>
			<td><?php echo $order['dtime_despacho']; ?></td>
			<td><?php echo $order['dtime_entrega']; ?></td>
			<td><?php echo $order['pay_mode']; ?></td>
			<td><?php echo $order['comments']; ?></td>
			<td><?php echo $order['terms_conditions']; ?></td>
			<td><?php echo $order['customer_id']; ?></td>
			<td><?php echo $order['motorista_id']; ?></td>
			<td><?php echo $order['proveedor_id']; ?></td>
			<td><?php echo $order['ejecutivo_id']; ?></td>
			<td><?php echo $order['create_time']; ?></td>
			<td><?php echo $order['comments_int']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), null, __('Are you sure you want to delete # %s?', $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Records'); ?></h3>
	<?php if (!empty($customer['Record'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Detail'); ?></th>
		<th><?php echo __('Category'); ?></th>
		<th><?php echo __('Datetime'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('User Executor Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($customer['Record'] as $record): ?>
		<tr>
			<td><?php echo $record['id']; ?></td>
			<td><?php echo $record['subject']; ?></td>
			<td><?php echo $record['detail']; ?></td>
			<td><?php echo $record['category']; ?></td>
			<td><?php echo $record['datetime']; ?></td>
			<td><?php echo $record['customer_id']; ?></td>
			<td><?php echo $record['order_id']; ?></td>
			<td><?php echo $record['product_id']; ?></td>
			<td><?php echo $record['user_id']; ?></td>
			<td><?php echo $record['user_executor_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'records', 'action' => 'view', $record['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'records', 'action' => 'edit', $record['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'records', 'action' => 'delete', $record['id']), null, __('Are you sure you want to delete # %s?', $record['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Record'), array('controller' => 'records', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
