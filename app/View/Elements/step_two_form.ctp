<header>
    <a href="#step2" class="hidden"></a>
    <h2>Paso 2: Datos de entrega</h2>
</header>
<section>
    <?php echo $this->Session->flash();
    echo $this->Session->flash('auth');
    ?>
    <?php
    echo $this->Form->create('Customer', array(
        'url' => array('controller' => 'order', 'action' => 'generate')));
    ?>
    <fieldset>

        <?php
        echo $this->Form->hidden('ps');
        echo $this->Form->input('full_name', array(
            'label' => "Tu nombre",
        ));
        echo $this->Form->input('email', array(
            'label' => "Tu email",
        ));
        echo $this->Form->input('phone', array(
            'label' => "Tu teléfono (antepone código ej. 9)",
            'default'=>'9'
        ));
        echo $this->Form->radio('comuna_id', $comunas, array('legend' => "Selecciona la comuna"));
        echo $this->Form->error('comuna_id');
        ?>
        <span id="avisoComuna99" class="hidden">No te aseguramos que lleguemos hasta tu domicilio, pero dejanos ver... Te mandaremos un email en caso negativo.</span>
        <?php
        echo $this->Form->input('address', array(
            'label' => "La dirección",
        ));
        ?>
        <label>¿Quieres agregar información extra?</label>
        <button class="moreInfo" value="infoMsj" class="infoMsj">+ mensaje</button>

        <button class="moreInfo" value="infoDir">+ info de dirección</button>
        <?php
        echo $this->Form->input('Order.comments', array(
            'label' => "Mensaje",
            'div' => array(
                'class' => 'moreInfo infoMsj hidden',
            )
        ));
        echo $this->Form->input('address_info', array(
            'label' => "Información extra de dirección",
            'div' => array(
                'class' => 'moreInfo infoDir hidden',
            )
        ));
        
        
        
        ?>
        
        <label>Lo útimo, debe aceptar los <?php 
        echo $this->Html->link(
    'Términos y Condiciones',
    array(
        'controller' => 'pages',
        'action' => 'termsConditions'
    ),
            array('target'=>'_blank')
);
        ?></label>
        <?php
         echo $this->Form->input('Customer.terms_conditions', array(
            'label' => "Acepto los términos y condiciones",
             'type'=>'checkbox'
        ));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Pedir')); ?>
</section>
<script type="text/javascript">
    $(function() {



//------------events----------------------
        $(".submit").bind("click", function(event) {
            event.preventDefault();
            //  $(".submit").html('Sending...');
            $('input#CustomerPs').val(products);
            $(":submit").val("Generando pedido...");
         //   $(":submit").attr('disabled','disabled');
            $.ajax({
                data: $(".submit").closest("form").serialize(),
                dataType: "html",
                success: function(data, textStatus) {
                    $("#step2").html(data);
                    
                    document.location.href = "#step2";

                },
                type: "post",
                url: $(".submit").closest("form").attr('action'),
            });
        });




        $("input[type=radio]").click(function() {
            if ($(this).prop('value') == 99) {
                $("span#avisoComuna99").show();
            } else {
                $("span#avisoComuna99").hide();
            }
        });

        $("button.moreInfo").click(function() {
            $(this).hide();
            $('div.' + $(this).prop('value')).show();
        });



        $("button").click(function(event) {
            event.preventDefault();
        });
//------------functions----------------------



//------------executing----------------------
        if ($('input[type=radio]:checked').val() == 99) {
            $("span#avisoComuna99").show();
        }
        
        //TODO: dinamizar
        if ($.trim($('textarea#OrderComments').val())!="") {

            $('button[value=infoMsj]').hide();
            $('div.infoMsj').show();
        }
        if ($.trim($('textarea#CustomerAddressInfo').val())!="") {
            $('button[value=infoDir]').hide();
            $('div.infoDir').show();
        }
    });
</script>
