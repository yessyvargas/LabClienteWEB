<?php

/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 30-abr-2017
 * @time 21:22:23
 */

include_once("MY_Model.php");
include_once("MY_Entity.php");

class mCatalogo extends MY_Model
{
    protected $table = 'catalog';
    
    function __construct() 
    {
        parent::__construct();
        
    }
    
    public function load($value, $by = 'id', $except_value = '', $except_by = 'id')
    {
        $row = parent::load($value, $by, $except_value, $except_by);
        
        $eCatalogo = new eCatalogo();
        $eCatalogo->parseRow($row);
        
        return $eCatalogo;
    }
    
    public function filter(filterCatalogo $filter, &$eCatalogos )
    {
        $eCatalogos = array();
        $select = $this->buildSelectFields('c_', 'c', $this->table);
        $sql = "SELECT
                    ".($select)."
                FROM ".( $this->table )." AS c
                    INNER JOIN catalog_type AS ct ON ct.id = c.id_catalog_type
                WHERE
                    1=1
                " .( is_null($filter->id_catalog_type) ? "":" AND c.id_catalog_type = $filter->id_catalog_type "). "
                " .( is_null($filter->limit) || is_null($filter->offset) ? '' : " LIMIT ".( $filter->limit )." OFFSET ".( $filter->offset )." " ) . "
                ";
        
        $queryR = mysql_query($sql);
        
        while ($row = mysql_fetch_assoc($queryR))  
        {
            $eProductoTipo = new eProductoTipo();

            $eProductoTipo->parseRow($row,'c_');

            $eCatalogos[] = $eProductoTipo;
        }
        mysql_free_result($queryR);
    }
    
    
    public function desconectar() 
    {
        parent::desconectar();
    }
    
}

class eCatalogo extends MY_Entity
{
    public $id_catalog_type;
    public $name;
    public $code;


    function __construct($useDefault = TRUE)
    {
        parent::__construct($useDefault);
        
        if( $useDefault )
        {
            $this->id_catalog_type  = 0;
            $this->name             = '';
            $this->code             = '';
        }
    }
}

class filterCatalogo extends MY_Entity_Filter
{
    public $id_catalog_type;
    
    public function __construct()
    {
        parent::__construct();
        $this->id_catalog_type = NULL;
    }
    
}