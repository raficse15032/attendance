<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_id', 'Department :') !!}
    <select  @change="getDepTeacher()" id="dep2" class="form-control">
        <option>Select Department</option>
        @foreach($department as $data)
        <option value="{{$data->id}}">{{$data->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Teacher:') !!}
    <select name="user_id" class="form-control">
        <option :value="user.id" v-for="(user,index) in users" :key="index">@{{user.name}}</option>
    </select>
</div>

<div  class="form-group col-sm-12">
	<div style="border-bottom: 1px solid #999">
		
	</div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('department_id', 'Department :') !!}
    <select  @change="getDepCourse()" id="dep" class="form-control">
        <option>Select Department</option>
        @foreach($department2 as $data)
        <option value="{{$data->id}}">{{$data->name}}</option>
        @endforeach
    </select>
</div>
<!-- Session Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('session_id', 'Session Id:') !!}
    {!! Form::select('session_id',$session, null, ['class' => 'form-control']) !!}
</div>


<!-- Course Id Field -->
<div v-if="courses.length>0" class="form-group col-sm-6">
    {!! Form::label('course_id', 'Semster:') !!}
    <select id="sem" @change="getDepSemCourse" class="form-control">
        <option>Select Semester</option>
        @foreach($semester as $data)
        <option value="{{$data->id}}">{{$data->semester}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Id:') !!}
    <select name="course_id" class="form-control">
        <option :value="course.id" v-for="(course,index) in courses" :key="index">@{{course.course}}</option>
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('courseAssigns.index') !!}" class="btn btn-default">Cancel</a>
</div>
