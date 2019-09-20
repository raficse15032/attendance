<table class="table table-responsive" id="attendences-table">
    <thead>
        <tr>
            <th>Course</th>
            <th>Presnt</th>
            <th>Absent</th>
            <th>Date</th>
            <th>Day</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($attendences as $attendence)
        <tr>
            <td>{!! $attendence->course->course !!}</td>
            <td>
                <?php

                    $presents = json_decode($attendence->attendence);
                    $count = 0;
                    foreach ($presents as $key => $present) {
                          if($present->attendence == 1){
                            $count++;
                          }
                      }  
                    echo $count;

                ?>
            </td>
            <td>
                <?php

                    $presents = json_decode($attendence->attendence);
                    $count = 0;
                    foreach ($presents as $key => $present) {
                          if($present->attendence != 1){
                            $count++;
                          }
                      }  
                    echo $count;

                ?>
            </td>
            <td>{!! $attendence->date !!}</td>
            <td>
                <?php 
                    $unixTimestamp = strtotime($attendence->date);
                    echo date("l", $unixTimestamp);
                 ?>     
            </td>
            <td>
                {!! Form::open(['route' => ['attendences.destroy', $attendence->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('attendences.show', [$attendence->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @if(Sentinel::getUser()->id == $user_id)
                    <a href="{!! route('attendences.edit', [$attendence->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endif
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>