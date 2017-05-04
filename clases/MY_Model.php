<?php

/*
 * @autor Carlos Luis Rodriguez Nieto (taylorluis93@gmail.com)
 * @date 30-abr-2017
 * @time 18:31:57
 * @link http://luis-rodriguez-ec.herokuapp.com/site/index
 */
include_once("conexion.php");

/* 
 * clase: MY_Model
 * extends: Conexion
 * Descripción, permite simular un modelo
 */
class MY_Model extends Conexion
{
    protected $table = '';
    static $con;
    
    /* 
     * función: __contruct
     * Descripción, permite realizar la conexión a la BASE DE DATOS
     */
    function __construct( )
    {
        parent::__construct();
        self::$con = $this->conectar();
    }
    
    /* 
     * función: getTableName
     * Descripción, permite obtener el nombre de la tabla instanciada
     * return string
     */
    function getTableName()
    {
        return $this->table;
    }
    
    /* 
     * función: buildSelectFields
     * @param $prefix String 
     * @param $alias String 
     * @param $table String 
     * Descripción, permite implementar alias a los campos de una tabla
     * return String
     */
    function buildSelectFields( $prefix, $alias='', $table='' )
    {
        $str = '';
        
        if( empty($table) ){ $table = $this->table; }
        if( empty($table) ){ return $str; }
        
        $fields = $this->list_fields( $table );
        
        foreach( $fields as $field )
        {
            $str .= ( empty($str)?'':',' ) . ( empty($alias) ? '' : ''.$alias.'.' ) . ''.$field.' AS '.( $prefix . $field ).'';
        }
        
        return $str;
    }
    
    /* 
     * función: list_fields
     * @param $table String 
     * Descripción, permite obtener los campos de una tabla
     * return Array
     */
    function list_fields($table)
    {
        $field_names = array();
        $resultado = mysql_query("select * from $table");
        while ($field = mysql_fetch_field($resultado))
        {
                $field_names[] = $field->name;
        }

        return $field_names;
    }
    
    
    /* 
     * función: lastId
     * Descripción, permite obtener el ultimo id
     * return Integer
     */
    function lastId()
    {
        $id = mysqli_insert_id($this->conect);
        
        return $id;
    }
    
    /* 
     * función: genId
     * Descripción, permite obtener el maximo id mas uno
     * return Integer
     */
    function genId()
    {
        return $this->genMax('id') + 1;
    }
    
    /* 
     * función: genMax
     * @param $key String 
     * Descripción, permite obtener el maximo id
     * return String
     */
    function genMax( $key )
    {
        $sql = "SELECT MAX(id) AS id FROM $this->table";
        $query = mysql_query($sql); 
        $row = mysql_fetch_assoc($query);
        return $row[$key];
    }
    
    /* 
     * función: load
     * @param $value String 
     * @param $by String 
     * @param $except_value String 
     * @param $except_by String 
     * Descripción, permite obtener un registro de una tabla
     * return Object
     */
    function load($value, $by='id', $except_value='', $except_by='id')
    {
        //var_dump($value);
        
        $sql = "SELECT * FROM $this->table WHERE 1=1 AND $by = $value ";
        if( !empty($except_value) )
        {
            $sql .=" AND $except_by <> $except_value";
        }
        
        $query = mysql_query($sql);
        $row =  mysql_fetch_assoc($query); 
        return $row;
    }
    
    /* 
     * función: query
     * @param $value String 
     * @param $return_object Boolean 
     * Descripción, permite ejecutar un query a la base de datos
     * return Object
     */
    function query($sql, $return_object = TRUE)
    {
        $queryR = mysql_query($sql);
        if($return_object)
        {
            $rows = mysql_fetch_assoc($queryR); 
        }
        else
        {
            $rows = mysql_fetch_array($queryR);
        }
        
        return $rows;
        
    }
    
    /* 
     * función: save
     * @param $sql String 
     * Descripción, permite insertar un registro a la base de datos
     */
    function _save( $sql )
    {
        if(mysql_query($sql) === FALSE)
        {
            throw new Exception( $this->messageError(__FUNCTION__, TRUE) );
        }
    }
    
    
    /* 
     * función: begin
     * Descripción, permite iniciar una transacción a la base de datos
     */
    function begin()
    {
        parent::begin();
    }
    
    /* 
     * función: commit
     * Descripción, permite realizar una transacción a la base de datos
     */
    function commit()
    {
        parent::commit();
    }
    
    /* 
     * función: rollback
     * Descripción, permite desacer una transacción a la base de datos
     */
    function rollback()
    {
        parent::rollback();
    }
    
    function messageError( $function, $isHTML = TRUE )
    {
        $msg = "".
            "CLASS: ".( __CLASS__ ).( $isHTML?'<br/>':"\n" ).
            "FUNCTION: $function".( $isHTML?'<br/>':"\n" ).
            "ERROR MESSAGE: ".mysql_error($this->conect).( $isHTML?'<br/>':"\n" );
        
        return $msg;
    }
    
}
