<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" id="bootstrap-css" rel="stylesheet">
</head>
<body>
	<section class="testimonial py-5" id="testimonial">
		<div class="container">
			<div class="row">
				<div class="col-md-4 py-5 bg-primary text-white text-center">
					<div class="">
						<div class="card-body">
							<img src="{{url('img/logo.png')}}" style="width:30%">
							<h2 class="py-3">Registration</h2>
							<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
						</div>
					</div>
				</div>
				<div class="col-md-8 py-5 border">
					@if(Session::has('flash_message'))
                    <div class="alert alert-{{session('flash_notification')}} alert-dismissible fade show" role="alert">
                       {{session('flash_message')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
					<h4 class="pb-4">Please fill with your details</h4>
					<form method="post" action="/register">
                        {{csrf_field()}}
						<div class="form-row">
							<div class="form-group col-md-6">
								<input class="form-control" id="Full Name" name="name" placeholder="Full Name" type="text">
								@if($errors->has('name'))
                                <p style="color: red !important" >* {{ $errors->first('name') }}</p>
                                @endif
							</div>
							<div class="form-group col-md-6">
								<input class="form-control" name="email" id="inputEmail4" placeholder="Email" type="email">
								@if($errors->has('email'))
                                <p style="color: red !important">* {{ $errors->first('email') }}</p>
                                @endif
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<select name="dep_id" class="form-control" id="inputState">
									@foreach($department as $data)
									<option value="{{$data->id}}">{{$data->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<input class="form-control" id="inputEmail4" name="password" placeholder="Password" type="password">
								@if($errors->has('password'))
                                <p style="color: red !important" >* {{ $errors->first('password') }}</p>
                                @endif
							</div>
							<div class="form-group col-md-6">
								<input class="form-control" id="inputEmail4" placeholder="Confirm Password" name="password_confirmation" type="password">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<button class="btn btn-primary pull-right" type="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>