<?php
$gesDescription = __d('ges_dev', 'Alajatu Ejecutivos');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $gesDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.js"><\/script>')</script>
        <?php
        echo $this->Html->script('main');


        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <span style="float: right;">
                    <?php
                    if ($this->Session->read('Auth.User')) {
                    echo $this->Session->read('Auth.User.User.username')." ";
                    echo $this->Html->link("Logout", array('plugin' => 'bs', 'controller' => 'users', 'action' => 'logout'));
                    }?></span>
                <h1><?php echo $this->Html->link($gesDescription, "/"); ?></h1>
            </div>
            <div id="content">
<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">
            </div>
        </div>
<?php //echo $this->element('sql_dump');   ?>
    </body>
</html>
