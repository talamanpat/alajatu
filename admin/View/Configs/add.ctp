<div class="configs form">
<?php echo $this->Form->create('Config'); ?>
	<fieldset>
		<legend><?php echo __('Add Config'); ?></legend>
	<?php
		echo $this->Form->input('value_int');
		echo $this->Form->input('value_date');
		echo $this->Form->input('value_string');
		echo $this->Form->input('value_bool');
		echo $this->Form->input('descrition');
		echo $this->Form->input('other');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Configs'), array('action' => 'index')); ?></li>
	</ul>
</div>
