@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Course Assign
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($courseAssign, ['route' => ['courseAssigns.update', $courseAssign->id], 'method' => 'patch']) !!}

                        @include('course_assigns.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection