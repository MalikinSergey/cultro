<?php

namespace Cultro;

class EntityTypeService
{
    public function make($key)
    {
        $entityType = new EntityType($key, config('entity.types.' . $key));
        
        return $entityType;
    }
}