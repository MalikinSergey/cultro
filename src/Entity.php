<?php

namespace Cultro;

/**
 * Class Entity
 *
 * @package Cultro
 *
 * @property array $data
 */
class Entity extends \Eloquent
{
    /**
     * @type string
     */
    protected $table = "entities";
    
    /**
     * @type array
     */
    protected $guarded = ['id', 'type'];
    
    /**
     * @type array
     */
    protected $casts = ['data' => 'array'];
    
    /**
     * @type bool
     */
    public $timestamps = true;
    
    /**
     * @type EntityType
     */
    protected $entityType;
    
    public function getEntityType()
    {
        if (!$this->entityType) {
            $this->entityType = new EntityType($this->type, config('entity.types.' . $this->type));
        }
        
        return $this->entityType;
    }
    
    public function getHeading()
    {
        if ($this->getEntityType()->isMultiple()) {
            return $this->data($this->getEntityType()->getHeadingFieldKey());
        } else {
            return $this->getEntityType()->getName();
        }
    }
    
    public function data($field)
    {
        return data_get($this->data, $field);
    }
    
    public function idOrNullIfSingle()
    {
        return $this->getEntityType()->isMultiple() ? $this->id : null;
    }
    
    public function scopePublished($query)
    {
        return $query->where('state', 'published');
    }
    
    public function scopeOrder($query, $key)
    {
        $entityType = new EntityType($key, config('entity.types.' . $key));
        if ($entityType->getListOrderKey()) {
            $query->orderBy('data->' . $entityType->getListOrderKey(), $entityType->getListOrderDirection());
        }
        
        return $query;
    }
    
    public function getImageUrl($key)
    {
        return data_get($this->data, $key . ".url");
    }
    
    public function makeAssetName(EntityTypeField $field)
    {
        return $this->type . "_" . $this->id . "_" . $field->getKey() . "." . $field->getFormat();
    }
    
    public static function showcaseQuery($key)
    {
        $entityType = app(EntityTypeService::class)->make($key);
        
        $entities = Entity::where('type', $key);
        
        if ($entityType->isSortable()) {
            $entities->orderBy('position', 'asc');
        }
        
        if ($entityType->getListOrderKey()) {
            $entities->orderBy('data->' . $entityType->getListOrderKey(), $entityType->getListOrderDirection());
        } else {
            $entities->orderBy('id', 'desc');
        }
        
        return $entities;
    }
    
    public static function single($key)
    {
        $entity = Entity::where('type', $key)->first();
        
        return $entity;
    }
    
}