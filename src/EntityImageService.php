<?php

namespace Cultro;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Spatie\Image\Exceptions\InvalidImageDriver;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Storage;

/**
 * Class EntityImageService
 *
 * @package Cultro
 */
class EntityImageService
{
    /**
     * @param Request $request
     * @param EntityTypeField $field
     * @param Entity $entity
     *
     * @throws InvalidImageDriver
     * @throws InvalidManipulation
     */
    public function attachFromRequest(Request $request, EntityTypeField $field, Entity $entity)
    {
        $file = $this->getFileFromRequest($request, $field->getKey());
        
        if (!$file) {
            throw new \Exception('No file by key ' . $field->getKey() . ' in request');
        }
        
        $image = $this->prepareImage($file->getRealPath(), $field);
        
        $path = $this->save($image, $entity->makeAssetName($field));
        
        $url = $this->createUrl($path, config('entity.unique_asset_urls'));
        
        $this->attachUrl($entity, $url, $field->getKey());
    }
    
    /**
     * @param Request $request
     * @param $key
     *
     * @return array|UploadedFile|null
     */
    protected function getFileFromRequest(Request $request, $key)
    {
        $file = $request->file($key);
        
        return $file;
    }
    
    /**
     * @param $path
     * @param EntityTypeField $field
     *
     * @return Image
     * @throws InvalidImageDriver
     * @throws InvalidManipulation
     */
    protected function prepareImage($path, EntityTypeField $field)
    {
        $image = Image::load($path)->useImageDriver('gd');
        
        $image->fit(Manipulations::FIT_CROP, $field->getWidth(), $field->getHeight())
              ->format($field->getFormat());
        
        return $image;
    }
    
    /**
     * @param Image $image
     * @param $name
     *
     * @return false|string
     */
    protected function save(Image $image, $name)
    {
        $tempfile = tempnam(sys_get_temp_dir(), 'eis');
        
        $image->save($tempfile);
        
        $path = Storage::putFileAs(config('entity.path', 'content-images'), new File($tempfile), $name, ['visibility' => 'private']);
        
        try{
            unlink($tempfile);
        } catch (\Exception $e){
            //
        }
        
        return $path;
    }
    
    /**
     * @param $path
     *
     * @param bool $unique
     *
     * @return string
     */
    protected function createUrl($path, $unique = true)
    {
        $url = Storage::url($path);
        
        if ($unique) {
            $url = $url . "?" . Str::random(6);
        }
        
        return $url;
    }
    
    /**
     * @param $entity
     *
     * @param $url
     * @param $key
     *
     */
    protected function attachUrl(Entity $entity, $url, $key)
    {
        $data = $entity->data;
        
        $data[$key] = ['url' => $url];
        
        $entity->data = $data;
    }
}