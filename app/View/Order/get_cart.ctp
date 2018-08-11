<h2>Carro</h2>
<?php if (!empty($cart)) { ?>
<div class="limitTable">
    <table>
        <?php
        $total = 0;
        foreach ($cart as $p):
            ?>
            <tr>
                <td><?php echo $p['name']; ?></td>
                <td class="pPrice">$<?php echo $p['price'] ?><?php echo $p['volume'] > 1 ? "x" . $p['volume'] : "" ?></td>
            </tr>

            <?php
            $total +=$p['total'];
        endforeach;
        ?>
        

    </table>
</div>
<table><tr>
            <th>Total:</th> 
            <th>$<?php echo $total ?></th>
        </tr></table>
    <button class="previous1">Anterior</button>
    <button class="next2">Siguiente</button>
<?php }else { ?>
    <p>Seleccione sus roles.</p>
<?php } ?>

