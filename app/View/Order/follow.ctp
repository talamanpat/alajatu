<article class="follow">

    <header>
        <h2>Seguimiento del pedido!</h2>
        <p>Aquí podrás seguir el estado de tu pedido.</p>
    </header>
    <br>
    <section>
        <?php
        echo $this->element('state', array(
            "order" => $order,
            "states" => $states,
        ));
        ?>
    </section>

</article>


<aside id="cart" class="follow">
    <h2>Pedido</h2>
    <table>
        <?php
        foreach ($order['Item'] as $i):
            ?>
            <tr>
                <td><?php
                    echo $categories[$i['Product']['category_id']] . " " . $i['Product']['name'];
                    echo $i['volume'] > 1 ? " x" . $i['volume'] : ""
                    ?>  </td>
                <td class="pPrice">$<?php echo $i['total'] ?></td>
            </tr>

            <?php
        endforeach;
        ?>
        <tr>
            <th>Total:</th> 
            <th>$<?php echo $order['Order']['total'] ?></th>
        </tr>

    </table>
</aside>
