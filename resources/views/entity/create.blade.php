@extends('admin.layout')


@section('breadcrumbs')
    
    
    @if($entityType->isMultiple())
        <li class="breadcrumb-item"><a href="{{route('admin.entity.index', [$entityType->getKey()])}}">{{$entityType->getNamePlural()}}</a>
        </li>
    @endif
    
    <li class="breadcrumb-item active">{{$entityType->getName()}}</li>
@endsection


@section('content')
    
    {!! Form::open(['files' => true, 'route' => [ 'admin.entity.store'], 'method' => 'POST' ]) !!}
    
    <input type="hidden" name="type" value="{{$entityType->getKey()}}">
    
    <span class="h3 d-block mb-3">{{$entityType->getName()}}: создание</span>
    
    
    <div class="row">
        
        <div class="col-8">
            
            <div class="card">
                
                <div class="card-body">
                    @foreach($entityType->getFields() as $entityTypeField)
        
                        <div class="row">
                            <div class="col-12">
                                @include('admin.entity.fields.'.$entityTypeField->getType(), ['key' => $entityTypeField->getKey(), 'name' => $entityTypeField->getName(), 'value' => ''])
                            </div>
                        </div>
    
                    @endforeach
    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-lg" name="state" value="published">Опубликовать</button>
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
        
        </div>
    
    </div>
    
    
    {!! Form::close() !!}

    @include('admin.entity.scripts')

@endsection

