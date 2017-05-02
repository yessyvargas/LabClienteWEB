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
    
    public function load($value, $by = 'id', $except_value = '', $except_by = 'id')
    {
        $row = parent::load($value, $by, $except_value, $except_by);
        
        $eProducto = new eProducto();
        $eProducto->parseRow($row);
        
        return $eProducto;
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
            $this->description      = '';
            $this->presentation     = '';
            $this->code             = '';
            $this->url_picture      = '';
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
