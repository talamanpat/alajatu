
<h2><?php echo __('Items'); ?></h2>
<?php if (!empty($order['Item'])): ?>
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php echo __('Producto'); ?></th>
            <th><?php echo __('Cantidad'); ?></th>
        </tr>
        <?php foreach ($order['Item'] as $item): ?>
            <tr>
                <td><?php echo $item['Product']['category_id'] . " " . $item['Product']['name']; ?></td>
                <td><?php echo $item['volume']; ?></td>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
