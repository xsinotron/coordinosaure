<?php
    require 'app/init.php';
    if (isset($_REQUEST['go'])) $_SESSION['currentPage'] = $_REQUEST['go']; else $_SESSION['currentPage'] = 'index';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html>
    <?php include 'app/Views/head.html'; ?>
    <body data-page="<?php echo $_SESSION['currentPage'] ?>">
        <?php include "app/Views/header.html"; ?>
        <div role="main" id="main" class="clearfix">
            <aside>
                <ul>
                    <li></li>
                </ul>
            </aside>
            <section class="data clearfix">
                <h2>Interface de gestion : <?php echo $_SESSION['currentPage'] ?></h2>
                <?php echo $_SESSION['core']->getList($_SESSION['currentPage']); ?>
            </section>
        </div>
        <?php include "app/Views/footer.html"; ?>
        <div class="popin-shadow"></div>
        <script type="text/javascript">
            var amapiensList = 
            <?php
                if (isset($_SESSION['modele'])) {
                    //$_SESSION['modele']->install();
                    echo json_encode( $_SESSION['modele']->getAmapiens() );
                } else echo '"", token=' . json_encode($_SESSION);
            ?>;
        </script>
        <?php include 'app/Views/scripts.html'; ?>
    </body>
</html>