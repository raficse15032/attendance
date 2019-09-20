<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $semester->id !!}</p>
</div>

<!-- Semester Field -->
<div class="form-group">
    {!! Form::label('semester', 'Semester:') !!}
    <p>{!! $semester->semester !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $semester->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $semester->updated_at !!}</p>
</div>

