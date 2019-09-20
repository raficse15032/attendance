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
            <!-- Sports Videos -->
            <div id="app3" class="sports-videos-area ">
                <div class="row">
                    @if(Session::has('flash_message'))
                      <div class="col-12 col-lg-12">
                        <div class="alert alert-{{session('flash_notification')}} alert-dismissible fade show" role="alert">
                           {{session('flash_message')}}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      </div>
                    @endif
                    <div v-if="step4" class="col-12 col-lg-12">

                        <div class="post-content">
                          <div class="section-heading ">
                            <h5>@{{sendElemnet.name}} <i class="fas fa-exchange-alt"></i> @{{receiveElemnet.name}}</h5>
                          </div>
                          <table class="table">
                            <tbody>
                              <tr v-if="sendElemnet.email">
                                <th>@{{sendElemnet.name}} Email</th>
                                <td>@{{sendElemnet.email}}</td>
                              </tr>
                              <tr v-if="sendElemnet.account_no">
                                <th>@{{sendElemnet.name}} Number</th>
                                <td>@{{sendElemnet.account_no}}</td>
                              </tr>
                                <th>Total for payment</th>
                                <td>@{{send}} @{{sendElemnet.unit}}</td>
                              </tr>
                            </tbody>
                          </table>
                          <form  method="post" action="/pending-order">
                            {{csrf_field()}}
                            <p>Enter Transaction Number</p>
                            <input name="transaction_number" @keyup="step4StatusSet" type="text" class="form-control " id="transaction_number" >
                            <input name="email" type="hidden" :value="email"  class="form-control">
                            <input name="send_currency" type="hidden" :value="sendElemnet.name"  class="form-control">
                            <input name="send" type="hidden" :value="send"  class="form-control">
                            <input  v-if="receiveElemnet.account_no" name="receive_number_email" type="hidden" :value="accountNumber"  class="form-control">
                            <input  v-if="receiveElemnet.email" name="receive_number_email" type="hidden" :value="accountEmail"  class="form-control">
                            <input name="receive_currency" type="hidden" :value="receiveElemnet.name"  class="form-control">
                            <input name="receive" type="hidden" :value="receive"  class="form-control">
                            <input name="send_photo_path" type="hidden" :value="sendElemnet.photo_path"  class="form-control">
                            <input name="receive_photo_path" type="hidden" :value="receiveElemnet.photo_path"  class="form-control">
                            <input name="send_unit" type="hidden" :value="sendElemnet.unit"  class="form-control">
                            <input name="receive_unit" type="hidden" :value="receiveElemnet.unit"  class="form-control">

                            <input name="status" type="hidden" value="0" class="form-control">
                            <button v-if="step4Status" style="background-color:#17a2b8" type="submit" class="btn ex-btn mag-btn w-100"><i class="fa fa-refresh"></i> PROCESS EXCHANGE</button>
                            <button v-if="!step4Status" disabled style="background-color:#17a2b8" type="submit" class="btn ex-btn mag-btn w-100"><i class="fa fa-refresh"></i> PROCESS EXCHANGE</button>
                          </form>
                        </div>
                    </div>
                    <div v-if="step3" class="col-12 col-lg-12">
                        <div class="post-content">
                          <div class="section-heading ">
                            <h5>@{{sendElemnet.name}} <i class="fas fa-exchange-alt"></i> @{{receiveElemnet.name}}</h5>
                          </div>
                          <table class="table">
                            <tbody>
                              <tr>
                                <th>Amount Send</th>
                                <td>@{{send}} @{{sendElemnet.unit}} </td>
                              </tr>
                              <tr>
                                <th>Amount Receive</th>
                                <td>@{{receive}}  @{{receiveElemnet.unit}} </td>
                              </tr>
                              <tr>
                                <th>Your Email</th>
                                <td>@{{email}}</td>
                              </tr>
                              <tr v-if="receiveElemnet.email">
                                <th>@{{receiveElemnet.name}} Email</th>
                                <td>@{{accountEmail}}</td>
                              </tr>
                              <tr v-if="receiveElemnet.account_no">
                                <th>@{{receiveElemnet.name}} Number</th>
                                <td>@{{accountNumber}}</td>
                              </tr>
                              <tr>
                                <th>Total for payment</th>
                                <td>@{{send}} @{{sendElemnet.unit}}</td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="row">
                              <div class="col-md-5"><button @click="thirdStep"  style="background-color:#17a2b8" type="submit" class="btn ex-btn mag-btn w-100"><i class="fa fa-refresh"></i> PROCESS EXCHANGE</button></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5 pull-right"><button @click="cancelStep" style="background-color:red;opacity: 0.7" type="submit" class="btn ex-btn mag-btn w-100"><i class="fas fa-times"></i> CANCEL EXCHANGE</button></div>
                          </div>
                          
                          
                        </div>
                    </div>
                    <div v-if="step2" class="col-12 col-lg-12">
                        <div class="post-content">
                          <div class="section-heading ">
                            <h5>Additonal Info</h5>
                          </div>
                          <p>Your Email</p>
                          @if($user)
                          <input type="email" value="{{$user->email}}" class="form-control " id="email" >
                          <p v-if="step2Status1" style="color:red;">* Email field is required </p> 
                          @endif
                           <p v-if="receiveElemnet.email">@{{receiveElemnet.name}} Email</p>
                           <p v-if="receiveElemnet.account_no">@{{receiveElemnet.name}} Number</p>
                          <input v-if="receiveElemnet.account_no" type="text" class="form-control " id="accountNumber" >
                          <input v-if="receiveElemnet.email" type="text" class="form-control " id="accountEmail" >
                          <p v-if="step2Status2" style="color:red;">* This field is required </p> 
                          <button @click="secondStep" style="background-color:#17a2b8" type="submit" class="btn ex-btn mag-btn w-100"><i class="fa fa-refresh"></i> PROCESS EXCHANGE</button>
                        </div>
                    </div>
                    <!-- Single Blog Post -->
                    <div v-if="step1" class="col-12 col-lg-6">
                        <div class="post-content">
                          <div class="section-heading ex">
                            <h5><i class="fas fa-arrow-alt-circle-down"></i>  Send (আমাদের পাঠান)</h5>
                          </div>
                          <select @change="selectCurrency1(select1)" v-model="select1" class="form-control ex-s" >
                            <option  :value="currency.id" v-for="(currency,index) in currencies" :key="index" >@{{currency.name}}</option>
                          </select>
                          <div class="row">
                              <div col-sm-2>
                                  <img class="ex-img" :src="select1Img"  alt="">
                              </div>
                              <div col-sm-8>
                                  <input @keyup="calculation" v-model="send" type="number" class="form-control ex-input" id="exampleInputEmail1" >
                              </div>
                              <p v-if="minStatus" style="color:red;margin-left: 10px;">* Minimum exchange: @{{sendElemnet.minimum}} @{{sendElemnet.unit}}</p>
                          </div>
                            <!-- <div class="post-meta d-flex">
                                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 1034</a>
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 834</a>
                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 234</a>
                            </div> -->
                        </div>
                    </div>

                    <!-- Single Blog Post -->
                    <div v-if="step1" class="col-12 col-lg-6">
                        <div class="post-content">
                          <div class="section-heading ex">
                            <h5><i class="fas fa-arrow-alt-circle-up"></i> Receive (আপনি পাবেন)</h5>
                          </div>
                          <select @change="selectCurrency2(select2)" v-model="select2" class="form-control ex-s" >
                            <option  :value="currency.id" v-for="(currency,index) in currencies" :key="index" >@{{currency.name}}</option>
                          </select>
                          <div class="row">
                              <div col-sm-2>
                                  <img class="ex-img" :src="select2Img"  alt="">
                              </div>
                              <div col-sm-8>
                                  <input v-model="receive" type="number"  disabled class="form-control ex-input" id="exampleInputEmail1" >
                              </div>
                              <p v-if="reserveStatus" style="color:red;margin-left: 10px;">* Sorry our reserve only @{{receiveElemnet.reserve}} @{{receiveElemnet.unit}}</p>
                          </div><!-- 
                            <div class="post-meta d-flex">
                                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 1034</a>
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 834</a>
                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 234</a>
                            </div> -->
                        </div>
                    </div>
                    <div v-if="step1" class="col-12 col-lg-12">
                        <div class="post-content">
                          <button v-if="sendElemnet.unit == receiveElemnet.unit || reserveStatus" disabled style="background-color:#17a2b8" type="submit" class="btn ex-btn mag-btn w-100"><i class="fa fa-refresh"></i> EXCHANGE</button>
                          <button @click="firstStep" v-if="sendElemnet.unit != receiveElemnet.unit && !reserveStatus"  style="background-color:#17a2b8"  class="btn ex-btn mag-btn w-100"><i class="fa fa-refresh"></i> EXCHANGE</button>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Feature Video Posts Area -->
            <div style="margin-top: 50px;" class="feature-video-posts mb-30">
                <!-- Section Title -->
                <div class="section-heading">     
                    <h5>Pending Exchange</h5>
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
                                    <td><img class="td-img" src="{{url('assets/img/user.jpg')}}" > {{$pending->name}}</td>
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
                    <h5>Complete Exchange</h5>
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
            <!-- Trending Now Posts Area -->
            <div class="trending-now-posts mb-30">
                <!-- Section Title -->
                <div class="section-heading">
                    <h5>Avaiable NOW</h5>
                </div>
                
                <div class="trending-post-slides owl-carousel">
                    <!-- Single Trending Post -->
                    @foreach($currencies as $currency)
                    <div class="single-trending-post">
                        <img src="{{$currency->photo_path}}"  alt="">
                        <div class="post-content">
                            <a href="#" class="post-title">{{$currency->name}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- >>>>>>>>>>>>>>>>>>>>
         Post Right Sidebar Area
        <<<<<<<<<<<<<<<<<<<<< -->
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

            
            <!-- <div class="single-sidebar-widget p-30">
                <div class="section-heading">
                    <h5>Newsletter</h5>
                </div>

                <div class="newsletter-form">
                    <p>Subscribe our newsletter gor get notification about new updates, information discount, etc.</p>
                    <form action="#" method="get">
                        <input type="search" name="widget-search" placeholder="Enter your email">
                        <button type="submit" class="btn mag-btn w-100">Subscribe</button>
                    </form>
                </div>

            </div> -->
        </div>
    </section>
@endsection
    