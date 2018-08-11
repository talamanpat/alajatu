<div class="products view">
<h2><?php echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id Product'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($product['Product']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description Long'); ?></dt>
		<dd>
			<?php echo h($product['Product']['description_long']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($product['Product']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($product['Product']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stock'); ?></dt>
		<dd>
			<?php echo h($product['Product']['stock']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Outsourcing'); ?></dt>
		<dd>
			<?php echo h($product['Product']['outsourcing']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Records'), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Record'), array('controller' => 'records', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Records'); ?></h3>
	<?php if (!empty($product['Record'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id Record'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Detail'); ?></th>
		<th><?php echo __('Category'); ?></th>
		<th><?php echo __('Datetime'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['Record'] as $record): ?>
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
<div class="related">
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($product['Order'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id Order'); ?></th>
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
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['Order'] as $order): ?>
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
