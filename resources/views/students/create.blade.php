@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Student
        </h1>
        <a class="btn btn-primary pull-right" style="margin-top: -30px;margin-bottom: 5px" href="{!! route('import_student') !!}">Import CSV</a>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'students.store']) !!}

                        @include('students.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
