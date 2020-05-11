<?php

namespace Cultro;

class EntityTypeField
{
    
    /**
     * @type string
     */
    protected $key;
    /**
     * @type array
     */
    protected $schema;
    
    /**
     * EntityTypeField constructor.
     *
     * @param $key
     * @param array $schema
     */
    public function __construct($key, array $schema)
    {
        $this->key = $key;
        $this->schema = $schema;
    }
    
    public function getSchema()
    {
        return $this->schema;
    }
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function getName()
    {
        return data_get($this->schema, 'name');
    }
    
    public function getType()
    {
        return data_get($this->schema, 'type', 'string');
    }
    
    public function getFormat()
    {
        return data_get($this->schema, 'format');
    }
    
    public function getWidth()
    {
        return data_get($this->schema, 'width');
    }
    
    public function getHeight()
    {
        return data_get($this->schema, 'height');
    }
}