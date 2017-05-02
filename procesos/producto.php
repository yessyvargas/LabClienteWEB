<?php

/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 01-may-2017
 * @time 23:21:46
 */

require_once '../clases/producto.php';


$accion = $_POST['accion'];
if($accion=='agregar')
{
    agregar();
}

function agregar()
{
    $mProducto = new mProducto();
    $isSuccess = NULL;
    $message = NULL;
    $path = NULL;
    $mProducto->begin();
    try 
    {
        $cboTipoProducto = $_POST['cboTipoProducto'];
        $cboCategoria = $_POST['cboCategoria'];
        $txtNombre = $_POST['txtNombre'];
        $txtDescripcion = $_POST['txtDescripcion'];
        $txtPresentacion = $_POST['txtPresentacion'];
        $txtCodigo = $_POST['txtCodigo'];
        //$file = $_FILES['fileImagem']['name'];
        $valid = isValid($cboCategoria, $txtNombre, $txtDescripcion, $txtPresentacion);
        if( !$valid['isSuccess'] )
        {
            throw new Exception( $valid['message'] );
        }
        
        $path_system = getcwd()."/..";
        $resources = "resources/thumbs/productos/";
        
        $id = $mProducto->genId();
        
        $img_file = $_FILES['fileImagem']['name'];
        $x = explode('.', $img_file);
        $url = $resources.$id.'/picture.'.end($x);
        
        $path = "$path_system/$resources"."$id/";
        
        if( !file_exists($path) )
        {
            if( !mkdir($path, 0777, TRUE) )
            {
                throw new Exception("Error al subir el archivo");
            }
        }
        
        if (!subir_fichero($path, 'fileImagem', 'picture.'.end($x)))
        {
            throw new Exception("Error al subir el archivo");
        }
        
        
        $eProducto = new eProducto(FALSE);
        $eProducto->id_product_type = empty($cboTipoProducto) ? NULL : $cboTipoProducto;
        $eProducto->id_catalog = $cboCategoria;
        $eProducto->name = $txtNombre;
        $eProducto->description = $txtDescripcion;
        $eProducto->presentation = $txtPresentacion;
        $eProducto->code = empty($txtCodigo) ? NULL : $txtCodigo;
        $eProducto->url_picture = $url;
        
        $mProducto->save($eProducto);
        
        
        
        $isSuccess = TRUE;
        $message = "Guardado exitosamente";
        $mProducto->commit();
    } 
    catch (Exception $ex) 
    {
        $isSuccess = FALSE;
        $message = $ex->getMessage();
        $mProducto->rollback();
        if( file_exists("$path_system/$url") )
        {
            unlink("$path_system/$url");
        }
        
        
    }


   echo json_encode(array('isSuccess' => $isSuccess, 'message' => $message));
    
}

function isValid( $cboCategoria, $txtNombre, $txtDescripcion, $txtPresentacion )
{
    $isSuccess = NULL;
    $message = NULL;
    try
    {
        if(empty($cboCategoria))
        {
            throw new Exception( "Error: Seleccione la categoria del producto" );
        }
        if(empty($txtNombre))
        {
            throw new Exception( "Error: Ingrese el nombre del product" );
        }
        if(empty($txtDescripcion))
        {
            throw new Exception( "Error: Ingrese la descripción del producto" );
        }
        if(empty($txtPresentacion))
        {
            throw new Exception( "Error: Ingrese la presentación del producto" );
        }
        $isSuccess = TRUE;
    } 
    catch (Exception $ex)
    {
        $isSuccess = FALSE;
        $message = $ex->getMessage();
    }
    
    return array('isSuccess' => $isSuccess, 'message' => $message);
}


function subir_fichero($directorio_destino, $nombre_fichero, $nombre_imagen)
{
    
    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
    
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
    {
        $img_file = $_FILES[$nombre_fichero]['name'];
        $img_type = $_FILES[$nombre_fichero]['type'];
        // Si se trata de una imagen   
        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //¿Tenemos permisos para subir la imágen?
            if (move_uploaded_file($tmp_name, $directorio_destino.$nombre_imagen))
            {
                return true;
            }
        }
    }
    //Si llegamos hasta aquí es que algo ha fallado
    return false;
}