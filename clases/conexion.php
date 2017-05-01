<?php 

/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 30-abr-2017
 * @time 17:38:31
 */

/* 
 * clase: Conexion
 * Descripción, permite implementar la conexión a la BD
 */
class Conexion
{
    protected $conect;
    protected $BaseDatos;
    protected $Servidor;
    protected $Usuario;
    protected $Clave;
    
    /* 
     * función: __contruct
     * Descripción, permite setear valores de la BD
     */
    function __construct()
    {
        $this->BaseDatos = "productosnaturales";
        $this->Servidor = "localhost";
        $this->Usuario = "root";
        $this->Clave = "";
    }
    
    /* 
     * función: conectar
     * Descripción, permite realizar la conexión a la BD
     * return Boolean
     */
    function conectar()
    {
        $isSuccess = NULL;
        try
        {
            if(!($con=@mysql_connect($this->Servidor,$this->Usuario,$this->Clave)))
            {
                throw new Exception('<h1> [:(] Error al conectar a la base de datos</h1>');
            }
            mysql_query("SET NAMES 'utf8'",$con);
            if (!@mysql_select_db($this->BaseDatos,$con))
            {
                throw new Exception('<h1> [:(] Error al seleccionar la base de datos</h1>');
            }
            $this->conect=$con;
            $isSuccess =  TRUE;
            
        } 
        catch (Exception $ex)
        {
            $isSuccess = FALSE;
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
            exit(0);
        }
        
        return $isSuccess;
    }
    
    /* 
     * función: desconectar
     * Descripción, permite desconectar a la BD
     */
    function desconectar()
    {
        try 
        {
            mysql_close($this->conect);
        } 
        catch (Exception $ex) 
        {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
    }
    
    function begin()
    {
        mysql_query("START TRANSACTION");
    }
    
    function commit()
    {
        mysql_query("COMMIT");
    }

    function rollback()
    {
        mysql_query("ROLLBACK");
    }
    
}
