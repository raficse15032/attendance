@if(Sentinel::getUser()->type == 1)
<li class="{{ Request::is('departments*') ? 'active' : '' }}">
    <a href="{!! route('departments.index') !!}"><i class="fa fa-edit"></i><span>Departments</span></a>
</li>

<li class="{{ Request::is('sessions*') ? 'active' : '' }}">
    <a href="{!! route('sessions.index') !!}"><i class="fa fa-edit"></i><span>Sessions</span></a>
</li>

<li class="{{ Request::is('semesters*') ? 'active' : '' }}">
    <a href="{!! route('semesters.index') !!}"><i class="fa fa-edit"></i><span>Semesters</span></a>
</li>
@endif
@if(Sentinel::getUser()->type == 1 || Sentinel::getUser()->type == 2)
<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>Courses</span></a>
</li>

<li class="{{ Request::is('students*') ? 'active' : '' }} {{ Request::is('import/stuedent') ? 'active' : '' }} {{ Request::is('import/stuedent/parse') ? 'active' : '' }} {{ Request::is('find/students') ? 'active' : '' }}">
    <a href="{!! route('students.index') !!}"><i class="fa fa-edit"></i><span>Students</span></a>
</li>
<li class="{{ Request::is('teachers*') ? 'active' : '' }}">
    <a href="{!! route('teachers.index') !!}"><i class="fa fa-edit"></i><span>Teachers</span></a>
</li>
<li class="{{ Request::is('courseAssigns*') ? 'active' : '' }}">
    <a href="{!! route('courseAssigns.index') !!}"><i class="fa fa-edit"></i><span>Course Assigns</span></a>
</li>
@endif
<li class="{{ Request::is('attendences*') ? 'active' : '' }} {{ Request::is('attendence/first') ? 'active' : '' }} {{ Request::is('attendence/list') ? 'active' : '' }} {{ Request::is('attendence/add/{d_id}/{s_id}/{c_id}') ? 'active' : '' }}">
    <a href="{!! route('attendence_first_step') !!}"><i class="fa fa-edit"></i><span>Attendences</span></a>
</li>





