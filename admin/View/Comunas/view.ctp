<div class="comunas view">
<h2><?php echo __('Comuna'); ?></h2>
	<dl>
		<dt><?php echo __('Id Comuna'); ?></dt>
		<dd>
			<?php echo h($comuna['Comuna']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($comuna['Comuna']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($comuna['Comuna']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Comuna'), array('action' => 'edit', $comuna['Comuna']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Comuna'), array('action' => 'delete', $comuna['Comuna']['id']), null, __('Are you sure you want to delete # %s?', $comuna['Comuna']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Comunas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comuna'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Proveedores'), array('controller' => 'proveedores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proveedor'), array('controller' => 'proveedores', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Customers'); ?></h3>
	<?php if (!empty($comuna['Customer'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id Customer'); ?></th>
		<th><?php echo __('Full Name'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Address Info'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Comuna Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($comuna['Customer'] as $customer): ?>
		<tr>
			<td><?php echo $customer['id']; ?></td>
			<td><?php echo $customer['full_name']; ?></td>
			<td><?php echo $customer['address']; ?></td>
			<td><?php echo $customer['email']; ?></td>
			<td><?php echo $customer['phone']; ?></td>
			<td><?php echo $customer['address_info']; ?></td>
			<td><?php echo $customer['active']; ?></td>
			<td><?php echo $customer['comuna_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'customers', 'action' => 'view', $customer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'customers', 'action' => 'edit', $customer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'customers', 'action' => 'delete', $customer['id']), null, __('Are you sure you want to delete # %s?', $customer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Proveedores'); ?></h3>
	<?php if (!empty($comuna['Proveedor'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id Proveedor'); ?></th>
		<th><?php echo __('Name Company'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Comuna Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($comuna['Proveedor'] as $proveedor): ?>
		<tr>
			<td><?php echo $proveedor['id']; ?></td>
			<td><?php echo $proveedor['name_company']; ?></td>
			<td><?php echo $proveedor['address']; ?></td>
			<td><?php echo $proveedor['active']; ?></td>
			<td><?php echo $proveedor['comuna_id']; ?></td>
			<td><?php echo $proveedor['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'proveedores', 'action' => 'view', $proveedor['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'proveedores', 'action' => 'edit', $proveedor['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'proveedores', 'action' => 'delete', $proveedor['id']), null, __('Are you sure you want to delete # %s?', $proveedor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Proveedor'), array('controller' => 'proveedores', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
