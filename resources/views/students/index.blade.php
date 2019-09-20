@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Students</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('students.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    <div class="row">
                        <div class="">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="{{ route('find_student') }}">
                                    {{ csrf_field() }}
                                    <!-- Department Id Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('department_id', 'Department:') !!}
                                        {!! Form::select('department_id', $department, null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Session Id Field -->
                                    <div class="form-group col-sm-6 pull-right">
                                        {!! Form::label('session_id', 'Session:') !!}
                                        {!! Form::select('session_id', $session, null, ['class' => 'form-control']) !!}
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        Let's Go
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

