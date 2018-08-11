<div class="proveedores form">
<?php echo $this->Form->create('Proveedor'); ?>
	<fieldset>
		<legend><?php echo __('Edit Proveedor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name_company');
		echo $this->Form->input('address');
		echo $this->Form->input('active');
		echo $this->Form->input('comuna_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('info');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Proveedor.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Proveedor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Proveedores'), array('action' => 'index')); ?></li>
	</ul>
</div>
