<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>登录 - {{ config('gayly.name', 'Onini') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN PLUGIN CSS -->
	<link href="{{ gayly_asset('vendor/gayly/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
	<link href="{{ gayly_asset('vendor/gayly/assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ gayly_asset('vendor/gayly/assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ gayly_asset('vendor/gayly/assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ gayly_asset('vendor/gayly/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" />
	<!-- END PLUGIN CSS -->
	<!-- BEGIN CORE CSS FRAMEWORK -->
	<link href="{{ gayly_asset('vendor/gayly/webarch/css/webarch.css') }}" rel="stylesheet" type="text/css" />
	<!-- END CORE CSS FRAMEWORK -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="error-body no-top">
	<div class="container">
		<div class="row login-container column-seperation">
			<div class="col-md-5 col-md-offset-1">
				<h2>
        后台管理面板登录
      </h2>
				{{-- <p>
					Use Facebook, Twitter or your email to sign in.
					<br>
					<a href="#">Sign up Now!</a> for a webarch account,It's free and always will be..
				</p> --}}
				<br>
				<button class="btn btn-block btn-info col-md-8" type="button"><span class="pull-left icon-facebook" style="font-style: italic"></span> <span class="bold">QQ</span></button>
				<button class="btn btn-block btn-success col-md-8" type="button"><span class="pull-left icon-twitter" style="font-style: italic"></span>
            <span class="bold">Wechat</span></button>
			</div>
			<div class="col-md-5">
				<br>
				<form action="{{ gayly_base_path('auth/login') }}" class="login-form validate" id="login-form" method="post" name="login-form">
					{{ csrf_field() }}
					<div class="row">
						<div class="form-group col-md-10">
							<label class="form-label">用户名</label>
							<input class="form-control" id="email" name="email" type="email" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-10">
							<label class="form-label">密码</label> <span class="help"></span>
							<input class="form-control" id="password" name="password" type="password" required>
						</div>
					</div>
					<div class="row">
						<div class="control-group col-md-10">
							<div class="checkbox checkbox check-success">
								<a href="#">忘记密码?</a>&nbsp;&nbsp;
								<input id="checkbox1" type="checkbox" value="1" name="remember">
								<label for="checkbox1">保持登录状态</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10">
							<button class="btn btn-primary btn-cons pull-right" type="submit">登录</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END CONTAINER -->
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
	<!-- BEGIN JS DEPENDECENCIES-->
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/jquery/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/bootstrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/jquery-block-ui/jqueryblockui.min.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
	<!-- END CORE JS DEPENDECENCIES-->
	<!-- BEGIN CORE TEMPLATE JS -->
	<script src="{{ gayly_asset('vendor/gayly/webarch/js/webarch.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/js/chat.js') }}" type="text/javascript"></script>
	<!-- END CORE TEMPLATE JS -->
</body>

</html>
