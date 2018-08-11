<div class="users view">
    <h2><?php echo __('User'); ?></h2>
    <dl>
        <dt><?php echo __('Id User'); ?></dt>
        <dd>
            <?php echo h($user['User']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Username'); ?></dt>
        <dd>
            <?php echo h($user['User']['username']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Password'); ?></dt>
        <dd>
            <?php echo h($user['User']['password']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Email'); ?></dt>
        <dd>
            <?php echo h($user['User']['email']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('First Name'); ?></dt>
        <dd>
            <?php echo h($user['User']['first_name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Last Name'); ?></dt>
        <dd>
            <?php echo h($user['User']['last_name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Phone'); ?></dt>
        <dd>
            <?php echo h($user['User']['phone']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Active'); ?></dt>
        <dd>
            <?php echo h($user['User']['active']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
    </ul>
</div>

<div class="related">
    <?php if (empty($user['Admin']['id'])): ?>
        <?php echo $this->Html->link(__('+ admin'), array('controller' => 'users', 'action' => 'setAdminRole', $user['User']['id'])); ?></li>
<?php else : ?>
        <?php echo $this->Html->link(__('- admin'), array('controller' => 'users', 'action' => 'unsetAdminRole', $user['Admin']['id'])); ?></li>
<?php endif; ?>
</div> 


<div class="related">
    <?php if (empty($user['Motorista']['id'])): ?>
        <?php echo $this->Html->link(__('+ Motorista'), array('controller' => 'users', 'action' => 'setMotoristaRole', $user['User']['id'])); ?></li>
<?php else : ?>
        <?php echo $this->Html->link(__('- Motorista'), array('controller' => 'users', 'action' => 'unsetMotoristaRole', $user['Motorista']['id'])); ?></li>
<?php endif; ?>
</div> 


<div class="related">
    <?php if (empty($user['Ejecutivo']['id'])): ?>
        <?php echo $this->Html->link(__('+ Ejecutivo'), array('controller' => 'users', 'action' => 'setEjecutivoRole', $user['User']['id'])); ?></li>
<?php else : ?>
        <?php echo $this->Html->link(__('- Ejecutivo'), array('controller' => 'users', 'action' => 'unsetEjecutivoRole', $user['Ejecutivo']['id'])); ?></li>
<?php endif; ?>
</div> 



<div class="related">
    <h3><?php echo __('Related Proveedores'); ?></h3>

    <?php if (empty($user['Proveedor']['id'])): ?>
        <?php echo $this->Html->link(__('+ Proveedor'), array('controller' => 'proveedores', 'action' => 'add', $user['User']['id'])); ?></li>


<?php else : ?>
    <dl>
        <dt><?php echo __('Id Proveedor'); ?></dt>
        <dd>
            <?php echo $user['Proveedor']['id']; ?>
            &nbsp;</dd>
        <dt><?php echo __('Name Company'); ?></dt>
        <dd>
            <?php echo $user['Proveedor']['name_company']; ?>
            &nbsp;</dd>
        <dt><?php echo __('Address'); ?></dt>
        <dd>
            <?php echo $user['Proveedor']['address']; ?>
            &nbsp;</dd>
        <dt><?php echo __('Active'); ?></dt>
        <dd>
            <?php echo $user['Proveedor']['active']; ?>
            &nbsp;</dd>
        <dt><?php echo __('Comuna Id'); ?></dt>
        <dd>
            <?php echo $user['Proveedor']['comuna_id']; ?>
            &nbsp;</dd>
        <dt><?php echo __('User Id'); ?></dt>
        <dd>
            <?php echo $user['Proveedor']['user_id']; ?>
            &nbsp;</dd>
    </dl>
<?php endif; ?>

<div class="related">
    <h3><?php echo __('Related Records'); ?></h3>
    <?php if (!empty($user['Record'])): ?>
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
            </tr>
            <?php foreach ($user['Record'] as $record): ?>
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

                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
