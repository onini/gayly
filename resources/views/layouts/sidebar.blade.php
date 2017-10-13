<div class="page-sidebar " id="main-menu">
	<!-- BEGIN MINI-PROFILE -->
	<div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
		<div class="user-info-wrapper sm">
			<div class="profile-wrapper sm">
				<img src="{{ Gayly::user()->avatar }}" alt="" data-src="{{ Gayly::user()->avatar }}" data-src-retina="{{ Gayly::user()->avatar }}" width="69"
				 height="69" />
				<div class="availability-bubble online"></div>
			</div>
			<div class="user-info sm">
				<div class="username"> <span class="semi-bold">{{ Gayly::user()->name }}</span></div>
				<div class="status">{{ Gayly::user()->email }}</div>
			</div>
		</div>
		<!-- END MINI-PROFILE -->
		<style media="screen">
			.page-sidebar .page-sidebar-wrapper > ul > li > a i {
				top:auto;
			}

			.sidebar-icon {
				font-size: 11px !important;
			}
		</style>
		<!-- BEGIN SIDEBAR MENU -->
		<p class="menu-title sm">控制面板 <span class="pull-right"><a href="javascript:;"><i class="material-icons">refresh</i></a></span></p>
		<ul>
			@each('gayly::layouts.menu', Gayly::menu(), 'item')
		</ul>
		<div class="side-bar-widgets">
			<p class="menu-title sm">任务 <span class="pull-right"><a href="#" class="create-folder"> <i class="material-icons">add</i></a></span></p>
			<ul class="folders">
				<li>
					<a href="#">
						<div class="status-icon green"></div>
						我的任务 </a>
				</li>
				<li>
					<a href="#">
						<div class="status-icon red"></div>
						任务中 </a>
				</li>
				<li>
					<a href="#">
						<div class="status-icon blue"></div>
						已完成 </a>
				</li>
				<li class="folder-input" style="display:none">
					<input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="">
				</li>
			</ul>
			{{-- <p class="menu-title">项目 </p>
			<div class="status-widget">
				<div class="status-widget-wrapper">
					<div class="title">Freelancer<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>
					<p>Redesign home page</p>
				</div>
			</div>
			<div class="status-widget">
				<div class="status-widget-wrapper">
					<div class="title">envato<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>
					<p>Statistical report</p>
				</div>
			</div> --}}
		</div>
		<div class="clearfix"></div>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
<a href="#" class="scrollup">Scroll</a>
<div class="footer-widget">
	<div class="progress transparent progress-small no-radius no-margin">
		<div class="progress-bar progress-bar-success animate-progress-bar" data-percentage="79%" style="width: 79%;"></div>
	</div>
	<div class="pull-right">
		<div class="details-status"> <span class="animate-number" data-value="86" data-animation-duration="560">86</span>% </div>
		<a href="{{ gayly_base_path('auth/logout') }}"><i class="material-icons">power_settings_new</i></a></div>
</div>
