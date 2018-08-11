<?php
$alajatuDescription = __d('alajatu_dev', 'Alajatu, La nueva forma de pedir online!');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            <?php echo $title_for_layout; ?> -
            <?php echo $alajatuDescription ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('normalize');
        echo $this->Html->css('main');
        //echo $this->fetch('meta');
        //echo $this->fetch('css');
        ?>
        <?php echo $this->Html->script('vendor/modernizr-2.6.2-respond-1.1.0.min'); ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo $this->webroot; ?>js/vendor/jquery-1.10.1.js"><\/script>')</script>
        <?php echo $this->Html->script('main'); ?>


        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link href='http://fonts.googleapis.com/css?family=Ubuntu|Coustard|Chau+Philomene+One|Oswald:700' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">
                    <?php
                    echo $this->Html->image("alajatu_beta.png", array(
                        "alt" => "Alajatu.cl",
                        'url' => "/"
                    ));
                    ?>
                </h1>
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">


                <script type="text/javascript">
                    var $buoop = {};
                    $buoop.ol = window.onload;
                    window.onload = function() {
                        try {
                            if ($buoop.ol)
                                $buoop.ol();
                        } catch (e) {
                        }
                        var e = document.createElement("script");
                        e.setAttribute("type", "text/javascript");
                        e.setAttribute("src", "//browser-update.org/update.js");
                        document.body.appendChild(e);
                    }
                </script> 

                <?php
                echo $this->Session->flash();
                echo $this->Session->flash('auth');
                ?>
                <?php echo $this->fetch('content'); ?>
            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
<!--
                                 <nav>
                                     <ul>
                                         <li><a href="#">Seguimiento</a></li>
                                         <li><a href="#">Ayuda</a></li>
                                     </ul>
                                 </nav> -->

                <h2><?php echo $this->Html->link("Seguimiento de un pedido",array('controller'=>'order','action'=>'searchOrder'));?></a></h2>

                </p>
                <h3>©2014 Alajatu Ltda. Todos los derechos reservados.</h3>
                <p>Telefono: (09)82274208<br>
                    Email: Hola@alajatu.cl
                </p>
                
                <p><a class="infoGeneral">Horarios, formas de pago y despacho</a>
            </footer>
        </div>

    </body>
</html>
