<div class="configs index">
	<h2><?php echo __('Configs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('value_int'); ?></th>
			<th><?php echo $this->Paginator->sort('value_date'); ?></th>
			<th><?php echo $this->Paginator->sort('value_string'); ?></th>
			<th><?php echo $this->Paginator->sort('value_bool'); ?></th>
			<th><?php echo $this->Paginator->sort('descrition'); ?></th>
			<th><?php echo $this->Paginator->sort('other'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($configs as $config): ?>
	<tr>
		<td><?php echo h($config['Config']['name']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['value_int']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['value_date']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['value_string']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['value_bool']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['descrition']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['other']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $config['Config']['name'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $config['Config']['name'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $config['Config']['name']), null, __('Are you sure you want to delete # %s?', $config['Config']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('New Config'), array('action' => 'add')); ?></li>
	</ul>
</div>
