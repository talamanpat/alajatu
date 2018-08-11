<div class="proveedores form">
<?php echo $this->Form->create('Proveedor'); ?>
	<fieldset>
		<legend><?php echo __('Add Proveedor'); ?></legend>
	<?php
		echo $this->Form->input('name_company');
		echo $this->Form->input('address');
		echo $this->Form->input('active');
		echo $this->Form->input('comuna_id');
		echo $this->Form->input('user_id', array('type'=>'hidden','value' => $user));
		echo $this->Form->input('info');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Proveedores'), array('action' => 'index')); ?></li>
	</ul>
</div>
