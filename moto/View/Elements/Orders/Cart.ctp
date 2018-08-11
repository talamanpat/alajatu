
<h2><?php echo __('Items'); ?></h2>

<?php if (!empty($order['Item'])): ?>
<h3>Total: <?php echo $order['Order']['total'] ?></h3>
 
<table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php echo __('Producto'); ?></th>
            <th><?php echo __('Cantidad'); ?></th>
            <th><?php echo __('Precio'); ?></th>
            <th><?php echo __('Total'); ?></th>
        </tr>
        <?php foreach ($order['Item'] as $item): ?>
            <tr>
                <td><?php echo $item['Product']['category_id'] . " " . $item['Product']['name']; ?></td>
                <td><?php echo $item['volume']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['total']; ?></td>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
