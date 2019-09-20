@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Attendence
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">

            <div id="app3" class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'attendence_list']) !!}

                        <!-- Department Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('department_id', 'Department :') !!}
                            <select name="department_id" @change="getDepCourse()" id="dep" class="form-control">
                                <option>Select Department</option>
                                @foreach($department as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Session Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('session_id', 'Session:') !!}
                            {!! Form::select('session_id',$session, null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Course Id Field -->
                        <div v-if="courses.length>0" class="form-group col-sm-6">
                            {!! Form::label('course_id', 'Semster:') !!}
                            <select id="sem" @change="getDepSemCourse" class="form-control">
                                <option>Select Semester</option>
                                @foreach($semester as $data)
                                <option value="{{$data->id}}">{{$data->semester}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Course Id Field -->

                         <div class="form-group col-sm-6">
                            {!! Form::label('course_id', 'Course:') !!}
                            <select name="course_id" class="form-control">
                                <option :value="course.id" v-for="(course,index) in courses" :key="index">@{{course.course}}</option>
                            </select>
                        </div>
                       
                        <!-- Submit Field -->
                        <div v-if="courses.length>0" class="form-group col-sm-12">
                            {!! Form::submit('Lets Go', ['class' => 'btn btn-success']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{url('assets/js/vue.js')}}"></script>
    <script src="{{url('assets/js/axios.js')}}"></script>
    <script >  
        
        var app = new Vue({
          el: '#app3',
          data: {
            url:"http://localhost:8000",
            courses:[],
            
          },
          methods: {
            getDepCourse(){
                var dep_id = document.getElementById('dep').value
                var self = this

                axios
                .get(this.url+'/api/department/course/'+dep_id)
                .then(response => {
                    self.courses = response.data
                })
            },
            getDepSemCourse(){
                var dep_id = document.getElementById('dep').value
                var sem_id = document.getElementById('sem').value
                var self = this

                axios
                .get(this.url+'/api/department/semester/course/'+dep_id+'/'+sem_id)
                .then(response => {
                    self.courses = response.data
                    console.log(self.courses)
                })
            },
            searchUser(){
                var data = document.getElementById('search').value;
                location.replace(this.url+"/search/user/"+data)
            }

          },
          mounted: function () {
          },
          computed:{
          }
        })
    </script>
@endsection

