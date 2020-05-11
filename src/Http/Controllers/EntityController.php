<?php

namespace Cultro\Http\Controllers;

use Illuminate\Http\Request;
use Cultro\Entity;
use Cultro\EntityImageService;
use Cultro\EntityType;
use Cultro\Http\Controllers\Controller;

class EntityController extends Controller
{

    /**
     * @var EntityImageService
     */
    private $imageService;

    /**
     * @type array
     */
    protected $errors = [];

    public function __construct(EntityImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index($key)
    {
        $entityType = new EntityType($key, config('entity.types.' . $key));

        $entities = Entity::where('type', $key);

        //dd($entityType->getListOrderKey());

        if($entityType->isSortable()){
            $entities->orderBy('position', 'asc');
        }

        if ($entityType->getListOrderKey()) {
            $entities->orderBy('data->' . $entityType->getListOrderKey(), $entityType->getListOrderDirection());
        }
        else {
            $entities->orderBy('id', 'desc');
        }

        $entities = $entities->get();

        return view('admin.entity.index', ['entities' => $entities, 'entityType' => $entityType]);
    }

    public function touch($type)
    {
        $entityType = new EntityType($type, config('entity.types.' . $type));

        $entity = new Entity(['type' => $entityType->getKey()]);

        $entity->save();

        return redirect()->route('admin.entity.edit', $entityType->getKey())->withMessage('common.success');
    }

    public function create($type)
    {
        $entityType = new EntityType($type, config('entity.types.' . $type));

        return view('admin.entity.create', ['entityType' => $entityType]);
    }

    public function edit($type, $id = null)
    {
        $entityType = new EntityType($type, config('entity.types.' . $type));

        if ($entityType->isMultiple()) {
            if (!$id) {
                abort(404);
            }

            $entity = Entity::findOrFail($id);
        } else {
            $entity = Entity::where('type', $type)->firstOrFail();
        }

        return view('admin.entity.edit', ['entity' => $entity, 'entityType' => $entityType]);
    }

    public function store(Request $request)
    {
        $entity = new Entity();

        $entity->type = $request->type;

        $data = $request->only($entity->getEntityType()->getAssignableFieldsKeys());

        $entity->data = $data;

        $entity->state = $request->input('state', 'published');

        $this->attachImages($request, $entity);

        $entity->save();

        return redirect()->route("admin.entity.edit", [$entity->type, $entity->idOrNullIfSingle()])->withErrors($this->errors)->withMessage('common.created');
    }

    public function update(Request $request, $id)
    {
        $entity = Entity::find($id);

        $data = array_merge($entity->data, $request->only($entity->getEntityType()->getAssignableFieldsKeys()));

        $entity->data = $data;

        $entity->state = $request->input('state', 'published');

        $this->attachImages($request, $entity);

        $entity->save();

        return redirect()->route("admin.entity.edit", [$entity->type, $entity->idOrNullIfSingle()])->withErrors($this->errors)->withMessage('common.edited');
    }

    public function destroy($id)
    {
        $entity = Entity::find($id);

        $entity->delete();

        return redirect()->route("admin.entity.index");
    }

    public function setPositions(Request $request)
    {
        foreach ($request->entity_ids as $position => $id) {
            Entity::where('id', $id)->update(['position' => $position]);
        }

        return ['success' => true];
    }

    protected function attachImages(Request $request, Entity $entity)
    {
        $this->errors = [];

        foreach ($entity->getEntityType()->getImageFields() as $field) {
            if (!$request->hasFile($field->getKey())) {
                continue;
            }

            try{
                $this->imageService->attachFromRequest($request, $field, $entity);
            } catch (\Throwable $e){
                $this->errors[] = $e->getMessage();
            }
        }
    }

    //public function uploadImage($key, $name, $ext, $width, $height)
    //{
    //    $file = request()->file($key);
    //
    //    $image = Image::load($file->getRealPath());
    //
    //    //@unlink(storage_path('image_tmp'));
    //
    //    $image->fit(Manipulations::FIT_CROP, $width, $height)
    //          ->format($ext)
    //          ->save(storage_path('image_tmp'));
    //
    //    if (\Storage::exists('content/' . $name)) {
    //        \Storage::delete('content/' . $name);
    //    }
    //
    //    //dd(\Storage::files('content'));
    //
    //    //dd(2);
    //    $result = \Storage::putFileAs('content', new File(storage_path('image_tmp')), $name, ['visibility' => 'private']);
    //
    //    //$result = $file->storeAs('content', $name, ['visibility' => 'private']);
    //
    //    $url = \Storage::url($result);
    //
    //    $url = $url . "?t=" . time();
    //
    //    return $url;
    //}

}
