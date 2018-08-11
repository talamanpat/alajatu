<div class="configs view">
<h2><?php echo __('Config'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($config['Config']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value Int'); ?></dt>
		<dd>
			<?php echo h($config['Config']['value_int']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value Date'); ?></dt>
		<dd>
			<?php echo h($config['Config']['value_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value String'); ?></dt>
		<dd>
			<?php echo h($config['Config']['value_string']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value Bool'); ?></dt>
		<dd>
			<?php echo h($config['Config']['value_bool']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descrition'); ?></dt>
		<dd>
			<?php echo h($config['Config']['descrition']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Other'); ?></dt>
		<dd>
			<?php echo h($config['Config']['other']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Config'), array('action' => 'edit', $config['Config']['name'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Config'), array('action' => 'delete', $config['Config']['name']), null, __('Are you sure you want to delete # %s?', $config['Config']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Configs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Config'), array('action' => 'add')); ?> </li>
	</ul>
</div>
