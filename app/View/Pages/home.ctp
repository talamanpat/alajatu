<article id="step1" class="step">

        <a href="#step1" class="hidden"></a>
    <header>
        <h2>Por fin es fácil pedir!</h2>

        <p>Paso 1: Selecciona tus sushis con un simple click <br>

            Paso 2: Ingresa solo los datos necesarios<br>
            Y listo! A tu domicilio</p>

    </header>

    <?php
    echo $this->element('step_one_products', array(
        "cs" => $cs
    ));
    ?>
</article>
<article id="step2" class="step hidden">  

    <?php
    echo $this->element('step_two_form', array(
        "comunas" => $comunas
    ));
    ?>
</article>

<aside id="cart">
    <h2>Carro</h2>
    <p>Seleccione sus roles</p>
</aside>
<?php if (!$OPEN) { ?>
    <script type="text/javascript">
        $(function() {
            alert("La tienda se encuetra cerrada, pero puede probar la funcionalidad sin problemas. \n\
El Horario de atención es de 18 a 23 hrs de martes a domingo. ");
        });</script>
<?php } ?>
