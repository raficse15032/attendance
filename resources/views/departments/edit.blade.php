@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Department
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($department, ['route' => ['departments.update', $department->id], 'method' => 'patch']) !!}

                        @include('departments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection