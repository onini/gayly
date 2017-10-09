<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN PLUGIN CSS -->
	@stack('link')
	{!! Gayly::css() !!}
	<!-- END PLUGIN CSS -->
	<!-- BEGIN PLUGIN CSS -->
	<link href="{{ gayly_asset('vendor/gayly/assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
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
	<script type="text/javascript">
		class Gayly {};
		Gayly.token = '{{ csrf_token() }}';
	</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="">
	<!-- BEGIN HEADER -->
	@include('gayly::layouts.header')
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		@include('gayly::layouts.sidebar')
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE CONTAINER-->
		<div class="page-content {{ $page_content_class or '' }}">
		@section('page-content')
			@include('gayly::partials.error')
			@include('gayly::partials.success')
			@include('gayly::partials.toastr')
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body"> Widget settings form goes here </div>
			</div>
			<div class="clearfix"></div>
			@section('content')
			<div class="content {{ $content_class or '' }}">
				@yield('container')
			</div>
			@show
		@show
		</div>
		<!-- BEGIN CHAT -->
		@include('gayly::layouts.chat')
		<!-- END CHAT -->
	</div>
	<!-- END CONTAINER -->
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- END CORE JS DEPENDECENCIES-->
	<!-- BEGIN CORE TEMPLATE JS -->
	<script src="{{ gayly_asset('vendor/gayly/webarch/js/webarch.js') }}" type="text/javascript"></script>
	<script src="{{ gayly_asset('vendor/gayly/assets/js/chat.js') }}" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL JS -->
	@stack('js')
{!! Gayly::js() !!}
	<!-- END PAGE LEVEL PLUGINS -->
	@stack('script')
{!! Gayly::script() !!}
	<!-- END CORE TEMPLATE JS -->
</body>

</html>
