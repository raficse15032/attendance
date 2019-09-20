<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Fast Paid</title>

    <!-- Favicon -->
    <!-- <link rel="icon" href="img/core-img/favicon.ico"> -->

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{url('assets/style.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css">
        .td-img{
            height: 20px;
        }
        .status{
            padding: 0px 5px;
        }
        .ex{
            margin-bottom:0px;
            border-left:0px;
            border-radius:5px 5px 0px 0px;
        }
        .ex-btn{
            border-radius:5px;
        }
        .ex-s{
            border-radius:0px 0px 5px 5px !important;
        }
        .ex-input{
            padding-right:110px;border-radius: 0 5px 5px 0px; 
        }
        .ex-img{
            margin-left: 15px;height:48px;width:50px;border: 4px solid #ebebeb;border-radius: 5px 0px 0px 5px; 
        }
        @media only screen and (max-width: 600px) {
            .td-text tr td{
                font-size: 10px;
                padding: 5px;
            }
            .status{
                 padding: 0px 2px;
                 font-size: 10px;
            }
          .td-img{
                height: 10px;
           }
          .ex-input{
            padding-right:10px;
          }
          .l-text{
            display: none
          }
        }
    </style>

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Navbar Area -->
        <div class="mag-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="magNav">

                    <!-- Nav brand -->
                    <a href="index.html" class="nav-brand"><img style="height: 60px;" src="{{url('assets/img/logo1.png')}}" alt=""> <span class="l-text">Quick Paid</span></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Nav Content -->
                    <div class="nav-content d-flex align-items-center">
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li class="active"><a href="index.html">Home</a></li>
                                    <li><a href="archive.html">Buy and Sell</a></li>
                                    <li><a href="archive.html">Notice</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="contact.html">My Transaction</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <div class="top-meta-data d-flex align-items-center">
                            @if($user)
                            <a href="{{url('/logout')}}" class="login-btn"><i class="fa fa-user" aria-hidden="true"></i> Logout</a>
                            @endif
                            @if(! $user)
                            <a href="{{url('/register')}}" class="login-btn"><i class="fa fa-user" aria-hidden="true"></i> Register</a>
                            @endif
                            @if(! $user)
                            <a href="{{url('/login')}}" class="login-btn"><i class="fa fa-user" aria-hidden="true"></i> Login</a>
                            @endif
                        </div>

                    </div>
                </nav>
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <!-- Footer Widget Area -->
                <div style="margin: 0 auto"  class="col-12 col-sm-6 col-lg-3">
                    <div class="footer-widget">
                        <div class="footer-social-info">
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="google-plus"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#" class="instagram"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <!-- Copywrite Text -->
                    <div class="col-12 col-sm-6">
                        <p class="copywrite-text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">Quick Paid</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                    <div class="col-12 col-sm-6">
                        <nav class="footer-nav">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li><a href="#">Advertisement</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{url('assets/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{url('assets/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{url('assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{url('assets/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{url('assets/js/active.js')}}"></script>
    <script src="{{url('assets/js/vue.js')}}"></script>
    <script src="{{url('assets/js/axios.js')}}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vee-validate/2.1.1/vee-validate.js"></script>
    <script >
        
        // currencies = document.getElementById('curr').value;
            
        
        var app = new Vue({
          el: '#app3',
          data: {
            url:"http://localhost:8000",
            currencies:[],
            select1:4,
            select1Img:'',
            select2:2,
            select2Img:'',
            send:0,
            receive:0,
            sendElemnet:'',
            receiveElemnet:'',
            step1:1,
            step2:0,
            step3:0,
            step4:0,
            email:'',
            accountEmail:'',
            accountNumber:'',
            user:'',
            minStatus:false,
            reserveStatus:false,
            step2Status1:false,
            step2Status2:false,
            step4Status:false,
          },
          methods: {
            getCurrencies(){
                var self = this

                axios
                .get(this.url+'/api/get/currency')
                .then(response => {
                    this.currencies = response.data
                    
                     this.currencies.forEach(element=>{

                        if(element.id == self.select1){
                            self.select1Img = element.photo_path 
                            self.sendElemnet = element
                        }
                        else if(element.id == self.select2){
                            self.select2Img = element.photo_path
                            self.receiveElemnet = element
                        }
                    })
                })
            },
            selectCurrency1(select1){
                this.receive = 0
                this.send = 0
                var self = this
                this.currencies.forEach(element=>{

                    if(element.id == select1){
                        self.select1Img = element.photo_path
                        self.sendElemnet = element
                    }
                })

            },
            selectCurrency2(select2){
                this.receive = 0
                this.send = 0
                var self = this
                this.currencies.forEach(element=>{

                    if(element.id == select2){
                        self.select2Img = element.photo_path
                        self.receiveElemnet = element
                    }
                })
            },
            calculation(){
                // this.receive = this.send
                // console.log(this.sendElemnet)

                if(this.sendElemnet.unit == "BDT" && this.receiveElemnet.unit == "USD"){
                    this.receive = ((this.send)/(this.receiveElemnet.sell)).toFixed(2)
                }

                if(this.receiveElemnet.unit == "BDT" && this.sendElemnet.unit == "USD"){
                    this.receive = ((this.send)*(this.sendElemnet.buy)).toFixed(2)
                }
                if(this.receiveElemnet.unit == "BDT" && this.sendElemnet.unit == "BDT"){
                    this.receive = this.send
                }
                if(this.receiveElemnet.unit == "USD" && this.sendElemnet.unit == "USD"){
                    this.receive = this.send
                }

                if(this.receiveElemnet.reserve < this.receive){
                    this.reserveStatus = true
                }
                else if(this.receiveElemnet.reserve >= this.receive){
                    this.reserveStatus = false
                }
            },
            firstStep(){
                var user =  document.getElementById('user').value;
                if(this.sendElemnet.minimum > this.send){
                    this.minStatus = true
                }
                else if(!user){
                    location.replace(this.url+"/login")
                }
                else if(user){
                    this.step1 = 0
                    this.step2 = 1
                }


            },
            secondStep(){
                var temp1 = 0
                var temp2 = 0
                this.email = document.getElementById('email').value;
                if(this.receiveElemnet.email){
                    this.accountEmail = document.getElementById('accountEmail').value;
                    this.accountNumber = ''
                }

                if(this.receiveElemnet.account_no){
                    this.accountNumber = document.getElementById('accountNumber').value;
                    this.accountEmail =  ''
                }

                if( this.accountNumber.length > 8 || this.accountEmail.length > 8)
                {
                    temp1++

                }
                else{
                    this.step2Status2=true
                }

                if(this.email.length > 8 ){
                    temp2++
                }
                else{
                    this.step2Status1=true
                }

                if(temp1 !=0 && temp2 !=0){
                   this.step2 = 0
                   this.step3 = 1 
                }

                
            },
            thirdStep(){
                this.step3 = 0
                this.step4 = 1
            },
            cancelStep(){
                this.minStatus = false
                this.step2Status1=false
                this.step2Status2=false
                this.step4Status=false
                this.reserveStatus = false
                this.step3 = 0
                this.step1 = 1
            },
            step4StatusSet(){
                var temp = document.getElementById('transaction_number').value
                if(temp.length > 3){
                    this.step4Status=true
                }
                else{
                   this.step4Status=false 
                }
                
            },
            testty(){
                console.log("ok")
            }

          },
          mounted: function () {
            this.getCurrencies()
          },
          computed:{
          }
        })
    </script>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5cc1ecf7ee912b07bec4dd1c/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>

</html>