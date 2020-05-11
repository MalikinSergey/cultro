<div class="row mb-3">
    
    <div class="col-12">
        
        <div class="card">
            
            <div class="card-body">
    
                <div class="card-title mb-2">
                    {{$name}}
                </div>
                
                <p>
                    <small class="text-muted">Обрезается и приводится к размеру автоматически</small>
                </p>
                
                @if(isset($entity) && $entity->getImageUrl($key))
        
                    <img src="{{$entity->getImageUrl($key)}}" alt="" class="img-fluid">
                
                @endif
                

                
                <div class="form-group mt-2">
                    <input type="file" name="{{$key}}">
                
                </div>
            
            </div>
        </div>
    
    </div>

</div>

{{--<div id="{{$key}}">111</div>--}}

{{--<script type="text/javascript">--}}
{{--    $(function(){--}}

{{--      new Dropzone("div#{{$key}}", { url: "/file/post"});--}}
{{--      --}}
{{--    });--}}
{{--</script>--}}

{{--    <script type="text/javascript">--}}
{{--      $(function () {--}}

{{--        $('[name={{$key}}]').fileinput(--}}
{{--          {--}}
{{--            language: 'ru',--}}
{{--            showUpload: false,--}}
{{--            allowedFileExtensions: ["png"]--}}
{{--          }--}}
{{--        )--}}

{{--      })--}}
{{--    </script>--}}

