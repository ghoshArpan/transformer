<!DOCTYPE html>

<html lang="en">
	<head><base href="../../">
		<title>LOGIN|Karmakar And Company</title>
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="#" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="#" />
		<link rel="shortcut icon" href="{{asset('logo2.png')}}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}"  rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}"  rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="bg-body">



<!--begin::Main-->
<div class="d-flex flex-column flex-root login-page">

	<div class="d-flex flex-column flex-xl-row flex-column-fluid">
		<!--begin::Aside-->
		<div class="d-flex flex-column flex-lg-row-fluid login-banner-section">

			<div class="d-flex flex-row-fluid flex-center p-10">
				<!--begin::Content-->
				<div class="d-flex flex-column login-banner logban">
					<!--begin::Logo-->
					<a href="#" class="mb-15">
						<img alt="Logo" src="{{asset('logo3.png')}}" class="" width="60%" />
					</a>
					<!--end::Logo-->
					<!--begin::Title-->
					<h1 class="text-dark fs-2x mb-3">Karmakar And Company!</h1>
					<!--end::Title-->
					<!--begin::Description-->
					<div class="fs-4 text-gray-400">Access your account securely and get started.



					</div>
					<!--begin::Description-->
				</div>
				<!--end::Content-->

			</div>

			<div>
				<div class="shape-login">
					<div class="shapes shape1"></div>
					<div class="shapes shape2"></div>
					<div class="shapes shape3"></div>
					<div class="shapes shape4"></div>
					<div class="shapes shape5"></div>
					<div class="shapes shape6"></div>
					<div class="shapes shape7"></div>
					<div class="shapes shape8"></div>
					<div class="shapes shape9"></div>
					<div class="shapes shape10"></div>
				</div>
			</div>
			
		</div>
		<!--begin::Aside-->
		<!--begin::Content-->
		<div class="flex-row-fluid d-flex flex-center justfiy-content-xl-first p-10">
			<!--begin::Wrapper-->
			<div class="d-flex flex-center p-15 shadow bg-body rounded w-100 w-md-550px mx-auto ms-xl-20 loginwrap">
				<!--begin::Form-->
				<form class="form w-100" action="{{ route('login') }}" method="POST"  id="kt_free_trial_form">
					@csrf
					<!--begin::Heading-->
					<div class="text-center mb-10 txtcen">
						<!--begin::Title-->
						<h1 class="text-dark mb-3 txtdrk">Log In</h1>
						<!--end::Title-->
						<!--begin::Link-->
						
						<!--end::Link-->
					</div>
					<!--begin::Heading-->
					<!--begin::Input group-->
					<div class="fv-row  txtcen">
						<label class="form-label fw-bolder text-dark fs-6">Username</label>
						<input class="form-control form-control-solid" required type="text" placeholder="" name="username" id="username" autocomplete="off"  autofocus />
					</div>
					<!--end::Input group-->
					<!--begin::Input group-->
					<div class="mb-7 fv-row" data-kt-password-meter="true">
						<!--begin::Wrapper-->
						<div class="mb-1">
							<!--begin::Label-->
							<label class="form-label fw-bolder text-dark fs-6">Password</label>
							<!--end::Label-->
							<!--begin::Input wrapper-->
							<div class="password-toggle position-relative mb-3">
								<input class="form-control form-control-solid" required type="password" placeholder="Password" id="password" type="password" name="password" required autocomplete="current-password" />
								<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
									<i class="bi bi-eye-slash fs-2"></i>
								</span>
							</div>
							<!--end::Input wrapper-->

						</div>
						<!--end::Wrapper-->

					</div>
					<!--end::Input group=-->

					<!--begin::Row-->
					<div class="text-center pb-lg-0 pb-8">
						<button class="btn btn-lg btn-primary w-100 mb-5 log-in">
							<span class="indicator-label">Log In</span>
							
						</button>
						<!--end::Separator-->
						<!--begin::Google link-->


						<!-- <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
						<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
							<img alt="Logo" src="{{asset('assets/media/svg/brand-logos/google-icon.svg')}}" class="h-20px me-3" />Continue with Google</a> -->



						<!--end::Google link-->
					</div>
					<!--end::Row-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Right Content-->
	</div>
	<!--end::Authentication - Signup Free Trial-->
</div>
<!--end::Main-->
<script>var hostUrl = "assets/";</script>
		<script src="{{asset('src/js/jquery/jquery-3.7.1.min.js')}}"></script>
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<script src="{{asset('assets/js/custom/authentication/sign-up/free-trial.js')}}"></script>
		

		
		<script>
			$(document).on("click",".password-toggle i", function(){


				var element = $(this);
				var input_type = element.parents(".password-toggle").find("input");
				console.log(input_type.val());

				if(input_type.attr("type") == 'text') {
					input_type.attr("type","password");
					element.attr("class","bi bi-eye-slash");
				} else {
					input_type.attr("type","text");
					element.attr("class","bi bi-eye");
				}
			})
		</script>
	</body>
</html>