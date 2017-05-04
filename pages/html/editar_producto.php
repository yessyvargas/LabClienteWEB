<?php
/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 01-may-2017
 * @time 22:26:12
 * Objetivo: Página que permite editar un producto seleccionado
 */

require_once '../../system.php';
require_once BASECLASS . 'catalogo.php';
require_once BASECLASS . 'catalogo_tipo.php';
require_once BASECLASS . 'producto.php';
require_once BASECLASS . 'producto_tipo.php';

if(!isset($_GET['id']))//si no existe el id no haga nada
{
	echo 'ninguna acción';
	exit(0);//permite detener la ejecución de la app
}

$id = $_GET['id'];

$mCatalogo = new mCatalogo();
$filterCatalogo = new filterCatalogo();
$filterCatalogo->id_catalog_type = 1;
$mCatalogo->filter($filterCatalogo, $eCatalogos/* REF */);

$mProducto_Tipo = new mProducto_Tipo();
$mProducto_Tipo->filter($eProductoTipos);

$mProducto = new mProducto();
/* @var $eProducto eProducto */  //aqui esto referenciando la entidad
$eProducto = $mProducto->load($id);
//echo phpversion();
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <title>LABFARVE::Editar Producto</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Yessenia Vargas Matute">
        <meta name="description" content="CV">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <link rel="stylesheet" type="text/css" href="../../resources/css/style.css">

        <script type="text/javascript" src="../../resources/js/jquery-3.2.1.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script type="text/javascript" src="../../resources/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="../js/agregar_producto.js"></script>

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
                        <li><a href="administrar_productos.php">Administrar Productos</a></li>
                        <li><a href="editar_producto.php">Editar Producto</a></li>
                    </ul>
                </div>

            </div>
        </nav>
        <div class="container">
            <div class="container-producto">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Administación de productos</h1>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Editar Producto</h4>
                            </div>
                            <div class="panel-body">
                                <form enctype="multipart/form-data" class="form-horizontal" name="frmProducto">
                                    <input type="hidden" name="accion" value="editar">
									<input type="hidden" name="id" value="<?php echo $eProducto->id ?>">
                                    <div class="form-group">
                                        <label for="comboTipoProducto" class="col-sm-2 control-label">Tipo de Producto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="cboTipoProducto">
												<?php
													//$id = @$_GET["id"]; 
													?>
                                                <option value="0" selected='selected'> <?php echo $id ?></option>
                                                <?php
                                                /* @var $eProductoTipo eProductoTipo */
                                                foreach ($eProductoTipos as $eProductoTipo) {
                                                    ?>
                                                    <option <?php echo ($eProducto->id_product_type == $eProductoTipo->id) ? "selected='selected'":""?> value="<?php echo $eProductoTipo->id ?>"><?php echo $eProductoTipo->name ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comboCategoria" class="col-sm-2 control-label">Categoria</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="cboCategoria">
                                                <option value="0" selected="selected">S/N Categoria</option>
                                                <?php
                                                /* @var $eCatalogo eCatalogo */
                                                foreach ($eCatalogos as $eCatalogo) {
                                                    ?>
                                                    <option <?php echo ($eProducto->id_catalog == $eCatalogo->id) ? "selected='selected'":""?> value="<?php echo $eCatalogo->id ?>"><?php echo $eCatalogo->name ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="txtNombre" value="<?php echo $eProducto->name ?>" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescripcion" class="col-sm-2 control-label">Descripción</label>
                                        <div class="col-sm-10">
                                            <textarea name="txtDescripcion" class="form-control" ><?php echo $eProducto->description ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPresentación" class="col-sm-2 control-label">Presentación</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="txtPresentacion" value="<?php echo $eProducto->presentation ?>" placeholder="Presentación">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCodigo" class="col-sm-2 control-label">Codigo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="txtCodigo" value="<?php echo $eProducto->code ?>" placeholder="Codigo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputImagen" class="col-sm-2 control-label">Imagen</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="fileImagem">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="button" class="btn btn-success" name="btnGuardar">Guardar</button>
                                            <button type="button" class="btn btn-danger" name="btnCancelar">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <footer class="pie">
                    © 2015 - 2018 . Developer by Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto. All rights reserved.
                </footer>
            </div>
        </div>
    </body>
</html>

