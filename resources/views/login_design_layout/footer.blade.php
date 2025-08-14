<script>var hostUrl = "assets/";</script>
		<script src="{{asset('src/js/jquery/jquery-3.7.1.min.js')}}"></script>
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<script src="{{asset('assets/js/custom/authentication/sign-up/free-trial.js')}}"></script>
		@include('notify::components.notify')
		@notifyJs

		
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