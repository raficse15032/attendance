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

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'attendence_student']) !!}

                        <!-- Department Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('department_id', 'Department Id:') !!}
                            {!! Form::select('department_id',$department, null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Session Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('session_id', 'Session Id:') !!}
                            {!! Form::select('session_id',$session, null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Course Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('course_id', 'Course Id:') !!}
                            {!! Form::select('course_id',$course, null, ['class' => 'form-control']) !!}
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Lets Go', ['class' => 'btn btn-success']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
