@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('assets/img/media/r.jpg')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto rounded" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"> </a></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>تسجيل دخول</h2>

												<form action="{{url('login')}}" method="POST">
                                                    @csrf
													<div class="form-group">
														<label>الايميل</label> <input class="form-control" placeholder="Enter your email" name="email" type="email">
													</div>
													<div class="form-group">
														<label>كلمه السر</label> <input class="form-control" placeholder="Enter your password" name="password" type="password">
                                                        <input type="checkbox" name="remember" id=""> تذكرني
                                                        <br>
													</div><button class="btn btn-main-primary btn-block" type="submit">دخول</button>

												</form>
												<div class="main-signin-footer mt-5">

													<p> <a href="{{ url('/register') }}">تسجيل حساب</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
@endsection
