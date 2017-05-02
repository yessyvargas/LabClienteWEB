<?php
/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 01-may-2017
 * @time 22:26:12
 */

require_once '../../system.php';
require_once BASECLASS . 'catalogo.php';
require_once BASECLASS . 'catalogo_tipo.php';
require_once BASECLASS . 'producto.php';
require_once BASECLASS . 'producto_tipo.php';

?>

<!DOCTYPE html>
<!--
Pagina de contacto de la empresa de productos naturales
Se agrega un mapa bajo el API de google con la ubicación en Quito-Ecuador
-->
<html lang="es">
    <head>
        <title>100% Natural y Saludable::Bienvenidos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Katherine Gallegos">
        <meta name="description" content="CV">

        <!-- Versión 3.3.7 de bootstrap -->
        <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Tema plantilla de bootstrap -->
        <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
		<!-- Hoja de estilos personalizada -->
        <link rel="stylesheet" type="text/css" href="../../resources/css/style.css">
		<!-- Librería de JavaScript jQuery-->
        <script type="text/javascript" src="../../resources/js/jquery-3.2.1.min.js"></script>

        <!-- Javascript de bootstrap -->
        <script type="text/javascript" src="../../resources/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- JavaScript para agregar el mapa usando API de Google -->
        <script type="text/javascript" src="../js/mapa.js"></script>
		
		
        
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
					<!-- menu principal -->
                    <div class="col-sm-8" id="headertopmenu">
                        <nav class="menu">
                            <ul>
                                <li><a href="index.php">Inicio</a></li>
                                <li><a href="productos.php">Productos</a></li>
                                <li><a href="guia.php">Guía</a></li>
                                <li><a href="administrar_productos.php">Administrar Productos</a></li>
                            </ul>
                        </nav>
                    </div>
					<!-- fin menu principal -->
                </div>
            </div>
        </header>
        <nav class="text-left">
            <div class="container ">
                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Inicio</a></li>
                    </ul>
                </div>

            </div>
        </nav>
        <div class="container">
            <div class="container-bienvenida">
                <div class="row">
                    <div class="col-sm-12">
						<!-- Título de la página -->
                        <h1>Productos 100% Naturales y Saludables</h1>
						<!-- Fin Título de la página -->
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
							<!-- Título de sección -->
                            <div class="panel-heading">
                                <p>Encuéntrenos en las principales ciudades del país<p>
                            </div>
							<!-- Fin Título de sección -->
							<!-- Contenido de la sección -->
                            <div class="panel-body">
								<!-- Contenedor del mapa -->
								<div id="googleMap" style="width:100%;height:400px"></div>
								<!-- Uso del API de Google -->
								<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8UCb_qmHMoUah1lMMG5aadgo2_z5BoCw&callback=myMap"></script>
                            </div>
							<!-- Fin Contenido de la sección -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
				<!-- pie de página -->
                <footer class="pie">
                    © 2015 - 2018 . Developer by Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto. All rights reserved.
                </footer>
				<!-- fin pie de página -->
            </div>
        </div>
    </body>
</html>

