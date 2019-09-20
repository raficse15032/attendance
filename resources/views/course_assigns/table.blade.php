<table class="table table-responsive" id="courseAssigns-table">
    <thead>
        <tr>
            <th>Teacher</th>
            <th>Session</th>
            <th>Course</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($courseAssigns as $courseAssign)
        <tr>
            <td>{!! $courseAssign->user->name !!}</td>
            <td>{!! $courseAssign->session->session !!}</td>
            <td>{!! $courseAssign->course->course !!}</td>
            <td>
                {!! Form::open(['route' => ['courseAssigns.destroy', $courseAssign->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!-- <a href="{!! route('courseAssigns.show', [$courseAssign->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('courseAssigns.edit', [$courseAssign->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> -->
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>