<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $session->id !!}</p>
</div>

<!-- Session Field -->
<div class="form-group">
    {!! Form::label('session', 'Session:') !!}
    <p>{!! $session->session !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $session->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $session->updated_at !!}</p>
</div>

