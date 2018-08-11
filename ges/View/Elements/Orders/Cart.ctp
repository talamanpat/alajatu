
<h2><?php echo __('Items'); ?></h2>
<h3>Total: <?php echo $order['Order']['total'] ?></h3>
<?php if (!empty($order['Item'])): ?>
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php echo __('Producto'); ?></th>
            <th><?php echo __('Cantidad'); ?></th>
            <th><?php echo __('Precio'); ?></th>
            <th><?php echo __('Total'); ?></th>
            <th><?php echo __('acciones'); ?></th>
        </tr>
        <?php foreach ($order['Item'] as $item): ?>
            <tr>
                <td><?php echo $item['Product']['category_id'] . " " . $item['Product']['name']; ?></td>
                <td><?php echo $item['volume']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['total']; ?></td>
                <td class="actions" style="width: 200px">
                    <?php 
                    if($order['Order']['canEditItems']){
                    ?>
                    <input type="text" id="item-<?php echo $item['id'] ?>" class="updateItem numeric" style="width: 30px; font-size: 100%;  ">
                    <?php
                    echo $this->Html->link(__('update'), array('controller' => 'orders',
                        'action' => 'updateItem'), array('class' => 'updateItem',
                        'name' => "item-" . $item['id'],
                        'item' => $item['id'],
                        'order' => $item['order_id']
                    ));
                    ?>
                    <?php
                    echo $this->Html->link(__('delete'), 
                            array('controller' => 'orders', 'action' => 'removeItem'), array('class' => 'removeItem',
                        'name' => "item-" . $item['id'],
                        'item' => $item['id'],
                        'order' => $item['order_id']
                            )
                    );
                    ?>
                </td>
                    <?php } ?>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
               <?php if($order['Order']['canEditItems']){
                   echo $this->Html->link(__('Agregar ítem'), array('action' => 'addItem', $order['Order']['id'])); 
               }?>
	
<script type="text/javascript">
    $(function() {
        $("a.removeItem").click(function(event) {
            event.preventDefault();
            link = $(this);
            item = link.attr("item");
            order = link.attr("order");
            $.ajax({
                type: "POST",
                url: link.attr("href"),
                data: {item: item, order: order}
            })
                    .done(function(msg) {
                        $("section.cart").html(msg);
            });

        });
        $("a.updateItem").click(function(event) {
            event.preventDefault();
            link = $(this);
            item = link.attr("item");
            order = link.attr("order");
            input = $("#" + $(this).attr("name"));
            val = input.val();
            if (val.length === 0 || val == 0) {
                alert("no se ha ingresado numero");
                return;
            }
            if (val.length === 3) {
                alert("numero demaciado alto, reviselo e intente denuevo");
                return;
            }
            $.ajax({
                type: "POST",
                url: link.attr("href"),
                data: {item: item, order: order, volume: val}
            })
                    .done(function(msg) {
                $("section.cart").html(msg);
            });

        });
        $("input.numeric").keydown(function(event) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                            (event.keyCode == 65 && event.ctrlKey === true) ||
                            // Allow: home, end, left, right
                                    (event.keyCode >= 35 && event.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    else {
                        // Ensure that it is a number and stop the keypress
                        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                            event.preventDefault();
                        }
                    }
                });
    });
</script>