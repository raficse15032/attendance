<table class="table table-responsive" id="semesters-table">
    <thead>
        <tr>
            <th>Semester</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($semesters as $semester)
        <tr>
            <td>{!! $semester->semester !!}</td>
            <td>
                {!! Form::open(['route' => ['semesters.destroy', $semester->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!-- <a href="{!! route('semesters.show', [$semester->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('semesters.edit', [$semester->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>