@extends('user.layout')

@section('content')
<section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(assets/img/bg-img/40.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Register</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <div class="mag-login-area py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="login-content bg-white p-30 box-shadow">
                        <!-- Section Title -->
                        <!-- <div class="section-heading">
                            <h5>Great to have you back!</h5>
                        </div> -->
                        
                        @if(Session::has('flash_message'))
                        <div class="alert alert-{{session('flash_notification')}} alert-dismissible fade show" role="alert">
                           {{session('flash_message')}}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        @endif
                        <form  method="post" action="/register">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Name">
                                @if($errors->has('name'))
                                <p style="color: red !important" >* {{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email">
                                @if($errors->has('email'))
                                <p style="color: red !important">* {{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" id="exampleInputEmail1" placeholder="phone">
                                @if($errors->has('phone'))
                                <p style="color: red !important" >* {{ $errors->first('phone') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                                @if($errors->has('password'))
                                <p style="color: red !important" >* {{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Re-type Password">
                            </div>
                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                                </div>
                            </div> -->
                            <button type="submit" class="btn mag-btn mt-30">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection