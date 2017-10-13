@extends('gayly::layouts.app') @section('container')
<div class="page-title">
</div>
<!-- BEGIN DASHBOARD TILES -->
<div class="row">

	<div class="col-md-4 col-vlg-3 col-sm-6">
		<div class="col-md-12 m-b-10">
			<div class="widget-item ">
				<div class="controller overlay right">
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a>
				</div>
				<div class="tiles green  overflow-hidden full-height" style="max-height:214px">
					<div class="overlayer bottom-right fullwidth">
						<div class="overlayer-wrapper">
							<div class="tiles gradient-black p-l-20 p-r-20 p-b-20 p-t-20">
								<div class="pull-right"> <a href="#" class="hashtags transparent"> #Onini </a> </div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<img src="{{ gayly_asset('vendor/gayly/assets/img/others/10.png') }}" alt="" class="lazy hover-effect-img"> </div>
				<div class="tiles white ">
					<div class="tiles-body">
						<div class="row">
							<div class="user-profile-pic text-left">
								<img width="69" height="69" data-src-retina="{{ Gayly::user()->avatar }}" data-src="{{ Gayly::user()->avatar }}" src="{{ Gayly::user()->avatar }}" alt="">
								{{-- <div class="pull-right m-r-20 m-t-35"> <span class="bold text-black small-text">24m</span> </div> --}}
							</div>
							<div class="col-md-5 no-padding">
								<div class="user-comment-wrapper">
									<div class="comment">
										<div class="user-name text-black bold"> {{ Gayly::user()->name }} <span class="semi-bold"></span> </div>
										<div class="preview-wrapper">@ Onini </div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="col-md-7 no-padding">
								<div class="clearfix"></div>
								<div class="m-r-20 m-t-20 m-b-10  m-l-10">
									<p class="p-b-10"> 好好学习, 天天向上</p>
									<a href="#" class="hashtags m-b-5"> #年轻 </a>  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END DASHBOARD TILES -->

@endsection
