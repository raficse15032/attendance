@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Teacher
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($teacher, ['route' => ['teachers.update', $teacher->id], 'method' => 'patch']) !!}

                        @include('teachers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection