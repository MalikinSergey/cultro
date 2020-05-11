<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label($key, $name) !!}
            {!! Form::text($key, old($key, $value ?? ''), ['class' => 'form-control', 'placeholder' => $name]) !!}
        </div>
    </div>
</div>