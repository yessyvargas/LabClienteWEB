<?php
/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 30-abr-2017
 * @time 22:20:54
 */

$system_path = "../../";
$clases = $system_path."clases/";

if (realpath($clases) !== FALSE) {
    $clases = realpath($clases) . '/';
}

// ensure there's a trailing slash
$clases = rtrim($clases, '/') . '/';

// Is the system path correct?
if (!is_dir($clases)) {
    exit("Tu carpeta de sistema no esta correcta. Por favor abrir el archivo y verifique este: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}
define('BASECLASS', str_replace("\\", "/", $clases));

if (realpath($system_path) !== FALSE) {
    $system_path = realpath($system_path) . '/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/') . '/';

// Is the system path correct?
if (!is_dir($system_path)) {
    exit("Tu carpeta de sistema no esta correcta. Por favor abrir el archivo y verifique este: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}
define('BASEPATH', str_replace("\\", "/", $system_path));

require_once BASECLASS . 'catalogo.php';
require_once BASECLASS . 'catalogo_tipo.php';
require_once BASECLASS . 'producto.php';
require_once BASECLASS . 'producto_tipo.php';

$mCatalogo = new mCatalogo();
$mProducto = new mProducto();
$filterCatalogo = new filterCatalogo();
$filterCatalogo->id_catalog_type = 1;
$mCatalogo->filter($filterCatalogo, $eCatalogos/* REF */);
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <title>LABFARVE::Guía</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Carlos Rodriguez">
        <meta name="description" content="CV">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../../resources/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="../../resources/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <link rel="stylesheet" type="text/css" href="../../resources/css/style.css">

        <script type="text/javascript" src="../../resources/js/jquery-3.2.1.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script type="text/javascript" src="../../resources/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="../js/guia.js"></script>

    </head>
    <body>
        <header class="cabecera">
            <div class="container">
                <div class="row header">
                    <div class="col-sm-4" id="headerlogo">
                        <!--logo-->
                        <a href="javascript:void(0);"><img src="../../resources/img/logo.png"></a>
                        <!--//fin logo--> 
                    </div>

                    <div class="col-sm-8" id="headertopmenu">
                        <nav class="menu">
                            <ul>
                                <li><a href="productos.php">Productos</a></li>
                                <li><a href="guia.php">Guía</a></li>
                                <li><a href="administrar_productos.php">Administrar Productos</a></li>
                                <li><a href="http://luis-rodriguez-ec.herokuapp.com/site/index" target="_blank">Contacto</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <nav class="text-left">
            <div class="container ">
                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li><a href="guia.php">Guía</a></li>
                    </ul>
                </div>

            </div>
        </nav>
        <div class="container">
            <div class="container-producto">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Guía de productos por sistema corporal humano</h1>
                    </div>
                    <?php
                    /* @var $eCatalogo eCatalogo  */
                    foreach ($eCatalogos as $eCatalogo) {
                        ?>
                        <div class="col-sm-12">
                            <div class="panel panel-primary">
                                <div class="pull-right"> 
                                    <button class="btn btn-default eye-close" _id="<?php echo $eCatalogo->id ?>"><span class="glyphicon glyphicon-eye-close"></span></button>&nbsp;
                                    <button class="btn btn-default eye-open" _id="<?php echo $eCatalogo->id ?>"><span class="glyphicon glyphicon-eye-open"></span></button>
                                    <span class="clear"></span>
                                </div>
                                <div class="panel-heading">
                                    <h4><?php echo $eCatalogo->name ?></h4>
                                </div>
                                <div class="panel-body pnl-prodcuto" id="<?php echo $eCatalogo->id ?>">
                                    <?php
                                    $filterProducto = new filterProducto();
                                    $filterProducto->id_catalog = $eCatalogo->id;
                                    $mProducto->filter($filterProducto, $eProductos, $eProductoTipos);
                                    /* @var $eProducto eProducto  */
                                    foreach ($eProductos as $eProducto) {
                                        ?>
                                        <div class="view-product col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            <?php
                                            $img = "../../resources/img/nologo.png";
                                            //print_r($img);
                                            //print_r((!is_null($eProducto->url_picture) && file_exists("../../".$eProducto->url_picture)));
                                            if (!is_null($eProducto->url_picture) && file_exists("../../" . $eProducto->url_picture)) {
                                                $img = "../../" . $eProducto->url_picture;
                                            }
                                            ?>
                                            <img src="<?php echo $img; ?>" border="0">
                                            <h4 class="name"><?php echo $eProducto->name ?></h4>
                                            <p class="description"><?php echo $eProducto->description ?></p>
                                            <p class="presentation"><?php echo $eProducto->presentation ?></p>
                                            <p class="code">INVIMA: <span><?php echo $eProducto->code ?></span></p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="container">
            <footer class="pie">
                © 2015 - 2018 . Developer by Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto. All rights reserved.
            </footer>
        </div>

    </body>
</html>

