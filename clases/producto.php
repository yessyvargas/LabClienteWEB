<?php

/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 30-abr-2017
 * @time 17:44:20
 */

include_once("MY_Model.php");
include_once("MY_Entity.php");

class mProducto extends MY_Model
{
    protected $table = 'product';

    function __construct() 
    {
        parent::__construct();
        
    }
    
    function load($value, $by = 'id', $except_value = '', $except_by = 'id')
    {
        $row = parent::load($value, $by, $except_value, $except_by);
        
        $eProducto = new eProducto();
        $eProducto->parseRow($row);
        
        return $eProducto;
    }
    
    function genId() 
    {
        return parent::genId();
    }
            
    function save(eProducto &$eProducto)
    {
        try
        {
            if (empty($eProducto->id)) 
            {
                $eProducto->id = $this->genId();
                $this->_save($this->_insert($eProducto->toData()));
            }
            else
            {
                $this->_save($this->_update($eProducto->toData(TRUE), array('id'=>$eProducto->id)));
            }
        }
        catch (Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    
    /* 
     * función: _insert
     * @param $table String 
     * @param $keys Array 
     * @param $values Array 
     * Descripción, permite insertar un registro a la base de datos
     */
    function _insert($arrData)
    {
        $keys = array_keys($arrData);
        $values = array_values($arrData);
        
        foreach ($keys as $num => $key)
        {
            
            if($key == 'name' || $key == 'description' || $key == 'presentation' || $key == 'code' || $key == 'url_picture')
            {
                $values[$num] = "\"".($values[$num])."\"";
            }
        }
       
        return "INSERT INTO ".$this->table." (".implode(", ", $keys).") VALUES (".implode(', ', $values).")";
    }
    
    /* 
     * función: _update
     * @param $arrData Array 
     * @param $value String 
     * @param $by String 
     * Descripción, permite actualizar un registro a la base de datos
     */
    function _update( $values, $where)
    {
        foreach ($values as $key => $val)
        {
            if($key == 'name' || $key == 'description' || $key == 'presentation' || $key == 'code' || $key == 'url_picture')
            {
                $val = "\"".($val)."\"";
            }
            
            $valstr[] = sprintf('"%s" = %s', $key, $val);
        }

        $sql = "UPDATE ".$this->table." SET ".implode(', ', $valstr);

        $sql .= ($where != '' AND count($where) >=1) ? " WHERE ".implode(" ", $where) : '';

        return $sql;
    }

    public function filter(filterProducto $filter, &$eProductos, &$eProductoTipos )
    {
        $eProductos = array();
        $eProductoTipos = array();
        
        $select_producto = $this->buildSelectFields('p_', 'p', $this->table);
        $select_producto_type = (is_null($filter->id_product_type)) ? NULL :$this->buildSelectFields('pt_', 'pt', 'product_type');
        if (is_null($filter->id_product_type))
        {
            $select = $select_producto;
        }
        else
        {
            $select = ($select_producto.','.$select_producto_type);
        }
        
        $sql = "SELECT
                    ".($select)."
                FROM ".( $this->table )." AS p
                    ".(is_null($filter->id_product_type) ? "":" INNER JOIN product_type AS pt ON pt.id = p.id_product_type ")."
                    ".(is_null($filter->id_catalog) ? "":" INNER JOIN catalog AS c ON c.id = p.id_catalog ")."
                WHERE
                    1=1
                " .( is_null($filter->id_product_type) ? "":" AND p.id_product_type = $filter->id_product_type "). "
                " .( is_null($filter->id_catalog) ? "":" AND p.id_catalog = $filter->id_catalog "). "
                " .( is_null($filter->limit) || is_null($filter->offset) ? '' : " LIMIT ".( $filter->limit )." OFFSET ".( $filter->offset )." " ) . "
                ";
        // print_r($sql);
        $queryR = mysql_query($sql);
        
        while ($row = mysql_fetch_assoc($queryR))  
        {

            $eProducto = new eProducto();

            $eProducto->parseRow($row,'p_');

            $eProductos[] = $eProducto;

            $eProductoTipo = new eProductoTipo();

            $eProductoTipo->parseRow($row,'pt_');

            $eProductoTipos[] = $eProductoTipo;

        }
           
        mysql_free_result($queryR);
    }
    
    public function desconectar() 
    {
        parent::desconectar();
    }
}

class eProducto extends MY_Entity
{
    public $id_product_type;
    public $id_catalog;
    public $name;
    public $description;
    public $presentation;
    public $code;
    public $url_picture;


    function __construct($useDefault = TRUE)
    {
        parent::__construct($useDefault);
        
        if( $useDefault )
        {
            $this->id_product_type  = 0;
            $this->id_catalog       = 0;
            $this->name             = '';
            $this->description      = NULL;
            $this->presentation     = NULL;
            $this->code             = NULL;
            $this->url_picture      = NULL;
        }
    }
}

class filterProducto extends MY_Entity_Filter
{
    public $id_product_type;
    public $id_catalog;
    
    public function __construct()
    {
        parent::__construct();
        $this->id_product_type  = NULL;
        $this->id_catalog       = NULL;
    }
    
}
