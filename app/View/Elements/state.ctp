<?php
$state = $order['Order']['state'];

function box($code, $orderCode, $name, $msg = "", $last = false) {
    $is = $code == $orderCode;
    $class = ($is ? " box_actual_state" : "") . (!$last ? " box_arrow" : " box_last");

    $str = "<tr>";
    $str .= '<th><h3 class="box' . $class . '">' . $name . '</h3></th>';
    if ($is) {
        $str .='<td>' . $msg . '</td>';
    } else {
        $str .='<td></td>';
    }
    $str .= '</tr>';
    return $str;
}
?>   
    <table>
        <?php echo box($states["SOLICITED"], $state, "Solicitud") ?>
        <?php echo box($states["CONFIRMATION"], $state, "Confirmación", "Lo llamaremos en un momento para confirmar el pedido.") ?>
        <?php echo box($states["ASSIGNING"], $state, "Procesando") ?>
        <?php
        if ($states["READY"] == $state) {
            echo box($states["READY"], $state, "En cocina");
        } else {
            echo box($states["MAKING"], $state, "En cocina");
        }
        ?>
        <?php echo box($states["DELIVERY"], $state, "En despacho") ?>
        <?php echo box($states["DISPATCHED"], $state, "Entregado", "", true) ?>
    </table>
<br>

    <span>Si el estado no avanza precione <a class="reload">actualizar</a> para recargar la página</span>

<script type="text/javascript">
    $(function() {

        setTimeout(function()
        {
            $.ajax({
                type: "GET",
                url: "<?php echo $this->webroot;?>order/state/<?php echo $order['Order']['id'];?>",
                beforeSend: function() {
                    console.log("Requesting state");
                }

            }).done(function(m) {
                console.log("Got state");
                $("article.follow section").html(m);
            }).fail(function(m) {
                console.log("ERROR: " + m);
            });
        }, 20000);

        $('.reload').click(function() {
            location.reload();
        });

    });
</script>
