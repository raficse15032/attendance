
<!-- Type Field -->
@if(Sentinel::getUser()->type == 1)
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    <select name="type" class="form-control">
        <option value="3">Teacher</option>
        <option value="2">Chairman</option>
    </select>
</div>
@endif
<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <select name="status" class="form-control">
        <option value="1">Active</option>
        <option value="0">Pending</option>
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('teachers.index') !!}" class="btn btn-default">Cancel</a>
</div>
