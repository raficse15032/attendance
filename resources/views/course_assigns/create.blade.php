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

            <div id="app3" class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'courseAssigns.store']) !!}

                        @include('course_assigns.fields')

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
            users:[]
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
            getDepTeacher(){
                var dep_id = document.getElementById('dep2').value
                var self = this

                axios
                .get(this.url+'/api/department/teacher/'+dep_id)
                .then(response => {
                    self.users = response.data
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
