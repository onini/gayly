@extends('gayly::layouts.app') @section('container')
<div class="row">
	<div class="col-md-12" style="max-width: 1270px">
		<div class=" tiles white col-md-12 no-padding">
			<div class="tiles green cover-pic-wrapper">
				<div class="overlayer bottom-right">
					<div class="overlayer-wrapper">
						<div class="padding-10 hidden-xs">
							<a href="{{ gayly_base_path('auth/user/profile/edit') }}" type="button" class="btn btn-primary btn-small">{{ trans('gayly.edit') }}</a>
						</div>
					</div>
				</div>
				<img src="{{ gayly_asset('vendor/gayly/assets/img/cover_pic.png') }}" alt="">
			</div>
			<div class="tiles white">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="user-profile-pic">
							<img width="69" height="69" data-src-retina="{{ Gayly::user()->avatar }}" data-src="{{ Gayly::user()->avatar }}" src="{{ Gayly::user()->avatar }}" alt="">
						</div>
					</div>
					{{--
					<div class="col-md-8 user-description-box  col-sm-8">
						<h4 class="semi-bold no-margin">John Smith</h4>
						<h6 class="no-margin">CEO of web-arch.co.uk</h6>
						<br>
						<p><i class="fa fa-briefcase"></i>UI & Graphic Design</p>
						<p><i class="fa fa-globe"></i>www.google.com</p>
						<p><i class="fa fa-file-o"></i>Download Resume</p>
						<p><i class="fa fa-envelope"></i>Send Message</p>
					</div> --}}

				</div>
				<div class="tiles-body">
					<div class="row-fluid">
						<blockquote class="margin-top-20">
							<p>{{ Gayly::user()->name }}</p>
							{{-- <small>{{ Gayly::user()->email }} </small> --}}
						</blockquote>

						<div class="clearfix"></div>

						@if (isset($form))
							{!! $form !!}
						@else
							<div class="form-group col-md-8 col-md-offset-2">
								<div class="col-md-2">
									<label class="form-label">用户名</label>
								</div>
								<div class="col-md-8">
									{{ Gayly::user()->name }}
								</div>
							</div>
							<div class="form-group col-md-8 col-md-offset-2">
								<div class="col-md-2">
									<label class="form-label">邮箱</label>
								</div>
								<div class="col-md-8">
									{{ Gayly::user()->email }}
								</div>
							</div>
							<div class="form-group col-md-8 col-md-offset-2">
								<div class="col-md-2">
									<label class="form-label">Wechat</label>
								</div>
								<div class="col-md-8">
									{{ Gayly::user()->wechat }}
								</div>
							</div>
							<div class="form-group col-md-8 col-md-offset-2">
								<div class="col-md-2">
									<label class="form-label">QQ</label>
								</div>
								<div class="col-md-8">
									{{ Gayly::user()->qq }}
								</div>
							</div>
							<div class="form-group col-md-8 col-md-offset-2">
								<div class="col-md-2">
									<label class="form-label">注册时间</label>
								</div>
								<div class="col-md-8">
									{{ Gayly::user()->created_at }}
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		{{--
		<div class="row">
			<div class="tiles white col-md-12  no-padding">
				<div class="tiles-body">
					<h5><span class="semi-bold">You many also know</span>&nbsp;&nbsp; <a href="#" class="text-info normal-text">view more</a></h5>
					<div class="row">
						<div class="col-md-6">
							<div class="friend-list">
								<div class="friend-profile-pic">
									<div class="user-profile-pic-normal">
										<img width="35" height="35" src="{{ gayly_asset('vendor/gayly/assets/img/profiles/d.jpg') }}" data-src="{{ gayly_asset('vendor/gayly/assets/img/profiles/d.jpg') }}" data-src-retina="{{ gayly_asset('vendor/gayly/assets/img/profiles/d2x.jpg') }}" alt="">
									</div>
								</div>
								<div class="friend-details-wrapper">
									<div class="friend-name">
										Johne Drake
									</div>
									<div class="friend-description">
										James Smith in commman
									</div>
								</div>
								<div class="action-bar pull-right">
									<button class="btn btn-primary" type="button">Add</button>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="friend-list">
								<div class="friend-profile-pic">
									<div class="user-profile-pic-normal">
										<img width="35" height="35" src="{{ gayly_asset('vendor/gayly/assets/img/profiles/b.jpg') }}" data-src="{{ gayly_asset('vendor/gayly/assets/img/profiles/b.jpg') }}" data-src-retina="{{ gayly_asset('vendor/gayly/assets/img/profiles/b2x.jpg') }}" alt="">
									</div>
								</div>
								<div class="friend-details-wrapper">
									<div class="friend-name">
										Johne Drake
									</div>
									<div class="friend-description">
										James Smith in commman
									</div>
								</div>
								<div class="action-bar pull-right">
									<button class="btn btn-primary" type="button">Add</button>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12 no-padding">
				<div class="tiles white">
					<textarea rows="3" class="form-control user-status-box post-input" placeholder="Whats on your mind?"></textarea>
				</div>
				<div class="tiles grey padding-10">
					<div class="pull-left">
						<button class="btn btn-default btn-sm btn-small" type="button"><i class="fa fa-camera"></i></button>
						<button class="btn btn-default btn-sm btn-small" type="button"><i class="fa fa-map-marker"></i></button>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary btn-sm btn-small" type="button">POST</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="post col-md-12">
				<div class="user-profile-pic-wrapper">
					<div class="user-profile-pic-normal">
						<img width="35" height="35" src="{{ gayly_asset('vendor/gayly/assets/img/profiles/c.jpg') }}" data-src="{{ gayly_asset('vendor/gayly/assets/img/profiles/c.jpg') }}" data-src-retina="{{ gayly_asset('vendor/gayly/assets/img/profiles/c2x.jpg') }}" alt="">
					</div>
				</div>
				<div class="info-wrapper">
					<div class="username">
						<span class="dark-text">John Drake</span> in <span class="dark-text">nervada hotspot</span>
					</div>
					<div class="info">
						Great design concepts by <span class="dark-text">John Smith</span> and his crew! Totally owned the WCG!, Best of luck for your future endeavours, Special thanks for <span class="dark-text">Jane smith</span> for her motivation ;)
					</div>
					<div class="more-details">
						<ul class="post-links">
							<li><a href="#" class="muted">2 Minutes ago</a></li>
							<li><a href="#" class="text-info">Collapse</a></li>
							<li><a href="#" class="text-info"><i class="fa fa-reply"></i> Reply</a></li>
							<li><a href="#" class="text-warning"><i class="fa fa-star"></i> Favourited</a></li>
							<li><a href="#" class="muted">More</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
					<ul class="action-bar">
						<li><a href="#" class="muted"><i class="fa fa-comment"></i> 1584</a> Comments</li>
						<li><a href="#" class="text-error"><i class="fa fa-heart"></i> 47k</a> likes</li>
					</ul>
					<div class="clearfix"></div>
					<div class="post comments-section">
						<div class="user-profile-pic-wrapper">
							<div class="user-profile-pic-normal">
								<img width="35" height="35" data-src-retina="{{ gayly_asset('vendor/gayly/assets/img/profiles/e2x.jpg') }}" data-src="{{ gayly_asset('vendor/gayly/assets/img/profiles/e.jpg') }}" src="{{ gayly_asset('vendor/gayly/assets/img/profiles/e.jpg') }}" alt="">
							</div>
						</div>
						<div class="info-wrapper">
							<div class="username">
								<span class="dark-text">Thunderbolt</span>
							</div>
							<div class="info">
								Congrats, <span class="dark-text">John Smith</span> & <span class="dark-text">Jane Smith</span>
							</div>
							<div class="more-details">
								<ul class="post-links">
									<li><a href="#" class="muted">2 Minutes ago</a></li>
									<li><a href="#" class="text-error"><i class="fa fa-heart"></i> Like</a></li>
									<li><a href="#" class="muted">Details</a></li>
								</ul>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="post comments-section">
						<div class="user-profile-pic-wrapper">
							<div class="user-profile-pic-normal">
								<img width="35" height="35" data-src-retina="{{ gayly_asset('vendor/gayly/assets/img/profiles/b2x.jpg') }}" data-src="{{ gayly_asset('vendor/gayly/assets/img/profiles/b.jpg') }}" src="{{ gayly_asset('vendor/gayly/assets/img/profiles/b.jpg') }}" alt="">
							</div>
						</div>
						<div class="info-wrapper">
							<div class="username">
								<span class="dark-text">Thunderbolt</span>
							</div>
							<div class="info">
								Congrats, <span class="dark-text">John Smith</span> & <span class="dark-text">Jane Smith</span>
							</div>
							<div class="more-details">
								<ul class="post-links">
									<li><a href="#" class="muted">2 Minutes ago</a></li>
									<li><a href="#" class="text-error"><i class="fa fa-heart"></i> Like</a></li>
									<li><a href="#" class="muted">Details</a></li>
								</ul>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="post comments-section">
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div> --}}
	</div>
</div>
@endsection
