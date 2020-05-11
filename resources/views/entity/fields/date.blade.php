<div class="row">
    <div class="col-3">
        <div class="form-group">
            {!! Form::label($key, $name) !!}
            {!! Form::text($key, old($key, $value ?? ''), ['class' => 'form-control datepicker-here', 'autocomplete' => 'off', "data-date-format"=>"yyyy-mm-dd", "data-position"=>"right top"]) !!}
        </div>
    </div>
</div>