@extends('user.layout')

@section('content')
    <section  class="mag-posts-area d-flex flex-wrap">
        <div  class="post-sidebar-area left-sidebar mt-30 mb-30 bg-white box-shadow">
            <!-- Sidebar Widget -->
            <div class="single-sidebar-widget p-30">
                <!-- Section Title -->
                <div class="section-heading">
                    <h5>Buy Sell Price </h5>
                </div>
                <div class="featured-video-posts">
                    <div class="row">
                        <div class="">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>We Accept</th>
                                    <th>Buy</th>
                                    <th>Sell</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($currencies as $currency)
                                  @if($currency->account_no == null)
                                  <tr>
                                    <td><img style="height:20px;" src="{{$currency->photo_path}}"> {{$currency->name}}</td>
                                    <td>{{$currency->buy}}</td>
                                    <td>{{$currency->sell}}</td>
                                  </tr>
                                  @endif
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-sidebar-widget p-30">
                <!-- Section Title -->
                <div class="section-heading">
                    <h5>Latest News</h5>
                </div>

                <!-- Catagory Widget -->
                <ul class="catagory-widgets">
                    @foreach($latest_news as $latest_new)
                    <li><a href="#"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i>{{$latest_new->news}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- >>>>>>>>>>>>>>>>>>>>
             Main Posts Area
        <<<<<<<<<<<<<<<<<<<<< -->
        <div  class="mag-posts-content mt-30 mb-30 p-30 box-shadow">
            <!-- Feature Video Posts Area -->
            <div style="margin-top: 50px;" class="feature-video-posts mb-30">
                <p style="color:red">{{$note}}</p>
                <div class="section-heading">     
                    <h5> My Pending Exchange</h5>
                </div>

                <div class="featured-video-posts">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <table class="table td-text">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Send</th>
                                    <th>Receive</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($pendings as $pending)
                                  <tr >
                                    <td><img class="td-img" src="{{url('assets/img/user.jpg')}}" > Michel</td>
                                    <td><img class="td-img" src="{{$pending->send_photo_path}}" > {{$pending->send}} {{$pending->send_unit}}</td>
                                    <td><img class="td-img" src="{{$pending->receive_photo_path}}" > {{$pending->receive}} {{$pending->receive_unit}}</td>
                                    <td>{{$pending->send_currency}} <img class="td-img" src="{{url('assets/img/pending.gif')}}" > {{$pending->receive_currency}}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feature Video Posts Area -->
            <div class="feature-video-posts mb-30">
                <!-- Section Title -->
                <div class="section-heading">
                    <h5>My Complete Exchange</h5>
                </div>

                <div class="featured-video-posts">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <table class="table td-text ">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Send</th>
                                    <th>Receive</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($completes as $complete)
                                  <tr >
                                    <td><img class="td-img" src="{{url('assets/img/user.jpg')}}" > {{$complete->name}}</td>
                                    <td><img class="td-img" src="{{$pending->send_photo_path}}" >  {{$pending->send}} {{$pending->send_unit}}</td>
                                    <td><img class="td-img" src="{{$pending->receive_photo_path}}" >  {{$pending->receive}} {{$pending->receive_unit}}</td>
                                    <td>{{$pending->send_currency}} <img class="td-img" src="{{url('assets/img/tik.png')}}" > {{$pending->receive_currency}}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-sidebar-area right-sidebar mt-30 mb-30 box-shadow">
            <!-- Sidebar Widget -->
            <div class="single-sidebar-widget p-30">
                <!-- Section Title -->
                <div class="section-heading">
                    <h5>Reserve Now</h5>
                </div>

                <!-- Single YouTube Channel -->
                @foreach($currencies as $currency)
                <div class="single-youtube-channel d-flex">
                    <div class="youtube-channel-thumbnail">
                        <img src="{{$currency->photo_path}}" alt="">
                    </div>
                    <div class="youtube-channel-content">
                        <a href="single-post.html" class="channel-title">{{$currency->name}}</a>
                        <a href="#" class="btn subscribe-btn"></i> {{$currency->reserve}} {{$currency->unit}}</a>
                    </div>
                </div>
                @endforeach
                <input id="user" type="hidden" value="{{$user}}">
            </div>
        </div>
    </section>
@endsection
    