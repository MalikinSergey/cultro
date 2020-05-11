@if($entityType->hasHelpImage())
    
    <div class="card mb-3">
        <div class="card-header">
            Как располагается на сайте?
        </div>
        
        <div class="card-body text-center">
            <img class="img-fluid" alt="Расположение на сайте" src="{{$entityType->getHelpImageUrl()}}">
        
        </div>
    
    </div>

@endif
