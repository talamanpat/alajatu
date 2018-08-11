<div class="records index">
	<h2><?php echo __('Records'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('detail'); ?></th>
			<th><?php echo $this->Paginator->sort('category'); ?></th>
			<th><?php echo $this->Paginator->sort('datetime'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($records as $record): ?>
	<tr>
		<td><?php echo h($record['Record']['id']); ?>&nbsp;</td>
		<td><?php echo h($record['Record']['subject']); ?>&nbsp;</td>
		<td><?php echo h($record['Record']['detail']); ?>&nbsp;</td>
		<td><?php echo h($record['Record']['category']); ?>&nbsp;</td>
		<td><?php echo h($record['Record']['datetime']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($record['Customer']['full_name'], array('controller' => 'customers', 'action' => 'view', $record['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($record['Order']['code'], array('controller' => 'orders', 'action' => 'view', $record['Order']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($record['Product']['name'], array('controller' => 'products', 'action' => 'view', $record['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($record['User']['username'], array('controller' => 'users', 'action' => 'view', $record['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $record['Record']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $record['Record']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $record['Record']['id']), null, __('Are you sure you want to delete # %s?', $record['Record']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Record'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
