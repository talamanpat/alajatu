<header>
        <?php  echo $this->Session->flash();
    echo $this->Session->flash('auth');
    ?>
    <h2>Éxito! Redirigiendo a seguimiento</h2>
    <p>Si no eres redirido en 5 segundos has click 
<?php
echo $this->Html->link(
    'aquí',
    array('controller' => 'order', 'action' => 'follow', $id),
        array('id' => 'redirectToOrder')
);
?></p>
</header>


<script type="text/javascript">
    $(function() {
        $("#cart").hide();
        setTimeout(function()
        {
           window.location.href = $('a#redirectToOrder').attr('href');
        }, 4500);
    });
</script>