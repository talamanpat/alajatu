<div class="orders form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Edit Order'); ?></legend>
	<?php
        
		echo $this->Form->input('order_id',array('type'=>'hidden'));
		echo $this->Form->input('product_id');
		echo $this->Form->input('volume');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?></li>
</div>
