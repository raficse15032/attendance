<div class="box-header with-border text-center">
  <h3 class="box-title">{{$attendence->course->course}}</h3><p></p>
  <h3 class="box-title">{{$attendence->course->course_code}}</h3><p></p>
  <h4 class="box-title">{{$attendence->date}} 
    <?php 
        $unixTimestamp = strtotime($attendence->date);
        echo date("l", $unixTimestamp);
     ?> 
   </h4>
</div>

<table class="table table-responsive" id="sessions-table">
    <thead>
        <tr>
            <th>Identity</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $attend_students = json_decode($attendence->attendence);
            foreach ($attend_students as $key => $attend_student) {
                if($attend_student->attendence == 1){
                    $identity =  "<button class='btn btn-sm btn-success'>".$attend_student->identity."</button>";
                    $status   = "Present";
                }
                else{
                   $identity =  "<button class='btn btn-sm btn-danger'>".$attend_student->identity."</button>";
                   $status  = "Absent"; 
                }
                
                echo "<tr>"."<td>".$identity."</td>"."<td>".$attend_student->name."</td>"."<td>".$status."</td>"."</tr>";
            }
         ?>
    </tbody>
</table>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $attendence->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $attendence->updated_at !!}</p>
</div>

