<table class="table table-responsive" id="teachers-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Type</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($teachers as $teacher)
        @if($teacher->type !=1)
        <tr>
            <td>{!! $teacher->name !!}</td>
            <td>{!! $teacher->email !!}</td>
            <td>{!! $teacher->department->name !!}</td>
            <td> @if($teacher->type == 3)
                    Techer
                 @endif
                 @if($teacher->type == 2)
                    <img height="20px;" src="{{url('img/s.png')}}"> Chairman
                 @endif
            </td>
            <td> @if($teacher->status == 0)
                    <button class="btn-xs btn-danger">pending</button>
                 @endif
                 @if($teacher->status == 1)
                    <button class="btn-xs btn-success">Active</button>
                 @endif
            </td>
            <td>
                {!! Form::open(['route' => ['teachers.destroy', $teacher->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('teachers.show', [$teacher->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @if(Sentinel::getUser()->type != $teacher->type)
                    <a href="{!! route('teachers.edit', [$teacher->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endif
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>