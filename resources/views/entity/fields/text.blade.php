<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label($key, $name) !!}
            {!! Form::textarea($key, old($key, $value ?? ''), ['class' => 'form-control', 'placeholder' => $name, 'rows' => 5]) !!}
        </div>
    </div>
</div>