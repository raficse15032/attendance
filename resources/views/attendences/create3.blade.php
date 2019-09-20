@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Attendence
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-header with-border text-center">
              <h3 class="box-title">{{$course->course}}</h3><p></p>
              <h3 class="box-title">{{$course->course_code}}</h3><p></p>
              <h4 class="box-title"><?php echo date("Y-m-d").' '.date("l"); ?></h4>
              <!-- <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div> -->
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            {!! Form::open(['route' => 'attendences.store']) !!}
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <!-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button> -->
                
                <div class="btn-group">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Data</i></button>
                </div>
              </div>
              <input value="{{$department_id}}" name="department_id" type="hidden">
              <input value="{{$session_id}}" name="session_id" type="hidden">
              <input value="{{$course->id}}" name="course_id" type="hidden">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr>
                    <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i> </button></th>
                    <th >Serial</th>
                    <th >Student Id</th>
                    <th >Name</th>
                    <th >Remarks</th>
                  </tr>
                  @foreach($students as $key => $student) 
                  <tr>
                    <td><input value="1" name="attend[{{$student->identity}}]" type="checkbox"></td>
                    <input value="{{$student->name}}" name="student[{{$student->identity}}]" type="hidden">
                    <td>{{$key+1}}</td>
                    <td>{{$student->identity}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->remarks}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            {!! Form::close() !!}
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
    </div>
@endsection
@section('scripts')
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('plugins/iCheck/flat/blue.css') }}">
@endsection
