@extends('admin.layout')


@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('admin.entity.index', [$entityType->getKey()])}}">{{$entityType->getNamePlural()}}</a></li>
@endsection


@section('content')
    
    
    {{--верх--}}
    
    <div class="h4 mb-3">{{$entityType->getNamePlural()}}</div>
    
    <div class=" mb-3">
        <a href="{{route('admin.entity.create', $entityType->getKey())}}" class="btn btn-success">Добавить</a>
    </div>
    
    {{--/верх--}}
    
    @include('admin.entity.list.'.$entityType->getListTemplate())

@endsection


@section('scripts')



@endsection