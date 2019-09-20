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
                <div class="section-heading">     
                    <h5> Notices</h5>
                </div>
                @foreach($notices as $notice)
                <div class="blog-content">       
                    <h4 class="post-title">{{$notice->title}}</h4>
                    <div class="post-meta">
                        <a href="#">{{date_format($notice->updated_at,"d-M-Y")}}</a>
                    </div>
                    <?php 
                        echo $notice->description;
                     ?>
                </div>
                @endforeach
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
    