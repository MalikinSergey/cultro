@extends('admin.layout')


@section('breadcrumbs')
    
    
    @if($entityType->isMultiple())
        <li class="breadcrumb-item"><a href="{{route('admin.entity.index', [$entityType->getKey()])}}">{{$entityType->getNamePlural()}}</a>
        </li>
    
    
    @endif
    
    <li class="breadcrumb-item active">{{$entity->getHeading()}}</li>
@endsection


@section('content')
    
    @include('admin.entity.scripts')
    
    {!! Form::open(['files' => true, 'route' => [ 'admin.entity.update', $entity->id], 'method' => 'POST', 'class' => '' ]) !!}
    
    <div class="row">
        
        <div class="col-12">
            
            <span class="h3 d-block mb-3">{{$entity->getHeading()}}</span>
            
            <div class="row">
                
                <div class="col-8">
                    
                    <div class="card">
                        
                        <div class="card-body">
                            
                            @foreach($entityType->getFields() as $entityTypeField)
                                
                                
                                @include('admin.entity.fields.'.$entityTypeField->getType(), ['key' => $entityTypeField->getKey(), 'name' => $entityTypeField->getName(), 'value' => $entity->data($entityTypeField->getKey())])
                            
                            
                            @endforeach
                            
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-lg" name="state" value="published">Сохранить и опубликовать</button>
                                @if($entityType->isMultiple())
                                    <button type="submit" class="btn btn-outline-primary btn-lg" name="state" value="draft">Сохранить как черновик</button>
                                @endif
                            </div>
                        
                        </div>
                    </div>
                
                </div>
                
                <div class="col-4">
                    
                    @if($entityType->hasHelpImage())
                        
                        @include('admin.entity.components.help')
                    
                    @endif
                    
                    <div class="card">
                        <div class="card-header">
                            Информация
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">Состояние: {{$entity->state === 'draft' ? 'черновик' : 'опубликовано'}}</h5>
                            
                            <p class="card-text">
                                Создано: {{$entity->created_at}}
                            </p>
                            
                            <p class="card-text">
                                Последнее обновление: {{$entity->updated_at}}
                            </p>
                        
                        </div>
                    
                    </div>
                
                </div>
            </div>
        
        </div>
    
    </div>
    
    
    {!! Form::close() !!}

    @include('admin.entity.scripts')

@endsection

