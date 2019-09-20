@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Attendences: </h1>
        @if(Sentinel::getUser()->id == $user_id)
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{route('attendence_add',[$department_id,$session_id,$course_id])}}">Add New</a>
        </h1>

        @endif
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{route('attendence_show_all',[$department_id,$session_id,$course_id])}}">Show All</a>
        </h1>
        <h1 class="pull-left">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-left:5px;" href="{{route('ct_add',[$department_id,$session_id,$course_id,1])}}">CT1</a>
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-left:5px;" href="{{route('ct_add',[$department_id,$session_id,$course_id,2])}}">CT2</a>
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-left:5px;" href="{{route('ct_add',[$department_id,$session_id,$course_id,3])}}">CT3</a>
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-left:5px;" href="{{route('ct_add',[$department_id,$session_id,$course_id,4])}}">CT4</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('attendences.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

