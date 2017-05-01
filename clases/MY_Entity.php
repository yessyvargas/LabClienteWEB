<?php

/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 30-abr-2017
 * @time 18:21:32
 * @link http://luis-rodriguez-ec.herokuapp.com/site/index
 */


/* 
 * clase: MY_Entity
 * Descripción, permite implementar entidades
 */
class MY_Entity
{
    public $id; /*campo [id] default de cada tabla*/
    
    /* 
     * función: __contruct
     * @param $useDefault Boolean 
     * Descripción, permite construir por defecto poniendo a todos los atributos de una
     * clase instancia en FALSE
     */
    public function __construct( $useDefault = TRUE )
    {
        if( !$useDefault )
        {
            $arr = get_class_vars( get_class($this) );
            foreach( $arr as $attr => $value )
            {
                $this->$attr = FALSE;
            }
            return;
        }
        
        $this->id = NULL;
    }
    
    /* 
     * función: genId
     * Descripción, retonar un id unico
     * return uniqid
     */
    public function genId()
    {
        return uniqid();
    }
    
    /* 
     * función: isEmpty
     * Descripción, permite validar si una entidas esta vacia
     * return Boolean
     */
    public function isEmpty()
    {
        return isset($this->id) ? empty($this->id) : TRUE;
    }
    
    /* 
     * función: toData
     * @param $withPK Boolean 
     * Descripción, permite implementar un arreglo asociativo con index, value
     * return array
     */
    public function toData( $withPK=TRUE )
    {
        $arr = get_class_vars( get_class($this) );
        
        $data = array();
        foreach( $arr as $attr => $value )
        {
            if( !( $this->$attr === FALSE && $attr != 'id' ) )
            {
                $data[ $attr ] = $this->$attr;
            }
        }
        
        if( !$withPK )
        {
            unset( $data['id'] );
        }
        
        return $data;
    }
    
    /* 
     * función: parseRow
     * @param $row
     * @param $prefix STRING 
     * @param $isFieldToLower Boolean
     * Descripción, permite parsear una entidad a traves de su index
     */
    public function parseRow( $row, $prefix='', $isFieldToLower = FALSE )
    {
        if( !empty($row) )
        {
            foreach( $row as $field => $value )
            {
                if($isFieldToLower)
                {
                    $field = strtolower($field);
                }

                $field = preg_replace("/^$prefix/", "", $field);
                
                if( property_exists($this, $field) )
                {
                    $this->$field = $value;
                }
            }
        }
    }
}

/* 
 * clase: MY_Entity_Filter
 * Descripción, permite implementar filtros de busqueda
 */
class MY_Entity_Filter
{
    public $text;
    public $limit;
    public $offset;
    
    /* 
     * función: __construct
     * Descripción, permite setear valores por defecto
     */
    public function __construct()
    {
        $this->text = '';
        $this->limit = NULL;
        $this->offset = NULL;
    }
}