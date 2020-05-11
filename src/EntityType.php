<?php

namespace Cultro;

class EntityType
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
     * EntityType constructor.
     *
     * @param $key
     * @param array $schema
     */
    public function __construct($key, array $schema)
    {
        $this->key = $key;
        $this->schema = $schema;
    }
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function getName()
    {
        return data_get($this->schema, 'name');
    }
    
    public function getListTemplate()
    {
        return data_get($this->schema, 'list.template', config('entity.default_list_preset'));
    }
    
    public function getNamePlural()
    {
        return data_get($this->schema, 'name_plural');
    }
    
    public function getAssignableFieldsKeys()
    {
        $restricted = ['image', 'images'];
        
        $keys = [];
        
        foreach (data_get($this->schema, 'fields', []) as $key => $field) {
            if (!in_array(data_get($field, 'type'), $restricted)) {
                $keys[] = $key;
            }
        }
        
        return $keys;
    }
    
    public function getImageFieldsKeys()
    {
        $keys = [];
        
        foreach (data_get($this->schema, 'fields', []) as $key => $field) {
            if (data_get($field, 'type') === 'image') {
                $keys[] = $key;
            }
        }
        
        return $keys;
    }
    
    /**
     * @return array|EntityTypeField[]
     */
    public function getImageFields()
    {
        $fields = [];
        
        foreach (data_get($this->schema, 'fields', []) as $key => $field) {
            if (data_get($field, 'type') === 'image') {
                $fields[] = $this->getField($key);
            }
        }
        
        return $fields;
    }
    
    public function getField($key)
    {
        return new EntityTypeField($key, data_get($this->schema, 'fields.' . $key));
    }
    
    public function getFields()
    {
        $fields = [];
        
        foreach (data_get($this->schema, 'fields', []) as $key => $schema) {
            $fields[] = new EntityTypeField($key, $schema);
        }
        
        return $fields;
    }
    
    public function isMultiple()
    {
        return data_get($this->schema, 'multiple', false);
    }
    
    public function isSortable()
    {
        return data_get($this->schema, 'sortable', false);
    }
    
    public function getHeadingFieldKey()
    {
        return data_get($this->schema, 'heading_field', 'title');
    }
    
    public function getListFields()
    {
        return data_get($this->schema, 'list.fields');
    }
    
    public function getListOrderKey()
    {
        return data_get($this->schema, 'list.order.key');
    }
    
    public function getListOrderDirection()
    {
        return data_get($this->schema, 'list.order.direction', 'asc');
    }
    
    public function hasHelpImage()
    {
        return file_exists(public_path('entity/help/' . $this->getKey() . '.png'));
    }
    
    public function getHelpImageUrl()
    {
        return '/entity/help/' . $this->getKey() . '.png';
    }
    
    public function getImageFormat($key)
    {
        return data_get($this->schema, 'fields.' . $key . '.format');
    }
    
    public function getImageWidth($key)
    {
        return data_get($this->schema, 'fields.' . $key . '.width');
    }
    
    public function getImageHeight($key)
    {
        return data_get($this->schema, 'fields.' . $key . '.height');
    }
    
}