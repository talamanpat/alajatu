<div class="orders view">
<h2><?php echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id Order'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Correlative'); ?></dt>
		<dd>
			<?php echo h($order['Order']['correlative']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($order['Order']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($order['Order']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($order['Order']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dtime Solicitud'); ?></dt>
		<dd>
			<?php echo h($order['Order']['dtime_solicitud']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dtime Confirmacion'); ?></dt>
		<dd>
			<?php echo h($order['Order']['dtime_confirmacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dtime Cocina'); ?></dt>
		<dd>
			<?php echo h($order['Order']['dtime_cocina']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dtime Despacho'); ?></dt>
		<dd>
			<?php echo h($order['Order']['dtime_despacho']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dtime Entrega'); ?></dt>
		<dd>
			<?php echo h($order['Order']['dtime_entrega']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pay Mode'); ?></dt>
		<dd>
			<?php echo h($order['Order']['pay_mode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($order['Order']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Terms Conditions'); ?></dt>
		<dd>
			<?php echo h($order['Order']['terms_conditions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Customer']['full_name'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Motorista'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Motorista']['id'], array('controller' => 'motoristas', 'action' => 'view', $order['Motorista']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Proveedor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Proveedor']['name_company'], array('controller' => 'proveedores', 'action' => 'view', $order['Proveedor']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ejecutivo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Ejecutivo']['id'], array('controller' => 'ejecutivos', 'action' => 'view', $order['Ejecutivo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create Time'); ?></dt>
		<dd>
			<?php echo h($order['Order']['create_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Records'); ?></h3>
	<?php if (!empty($order['Record'])): ?>
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
	<?php foreach ($order['Record'] as $record): ?>
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
	<h3><?php echo __('Related Products'); ?></h3>
	<?php if (!empty($order['Product'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id Product'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Description Long'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Stock'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Outsourcing'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($order['Product'] as $product): ?>
		<tr>
			<td><?php echo $product['id']; ?></td>
			<td><?php echo $product['name']; ?></td>
			<td><?php echo $product['description']; ?></td>
			<td><?php echo $product['description_long']; ?></td>
			<td><?php echo $product['price']; ?></td>
			<td><?php echo $product['active']; ?></td>
			<td><?php echo $product['stock']; ?></td>
			<td><?php echo $product['category_id']; ?></td>
			<td><?php echo $product['outsourcing']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'products', 'action' => 'delete', $product['id']), null, __('Are you sure you want to delete # %s?', $product['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
