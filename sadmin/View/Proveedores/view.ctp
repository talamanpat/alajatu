<div class="proveedores view">
<h2><?php echo __('Proveedor'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($proveedor['Proveedor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Company'); ?></dt>
		<dd>
			<?php echo h($proveedor['Proveedor']['name_company']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($proveedor['Proveedor']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($proveedor['Proveedor']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comuna Id'); ?></dt>
		<dd>
			<?php echo h($proveedor['Proveedor']['comuna_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($proveedor['Proveedor']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Info'); ?></dt>
		<dd>
			<?php echo h($proveedor['Proveedor']['info']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Proveedor'), array('action' => 'edit', $proveedor['Proveedor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Proveedor'), array('action' => 'delete', $proveedor['Proveedor']['id']), null, __('Are you sure you want to delete # %s?', $proveedor['Proveedor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Proveedores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proveedor'), array('action' => 'add')); ?> </li>
	</ul>
</div>
