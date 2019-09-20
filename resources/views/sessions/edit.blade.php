@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Session
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($session, ['route' => ['sessions.update', $session->id], 'method' => 'patch']) !!}

                        @include('sessions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection