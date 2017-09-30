<div class="page-sidebar " id="main-menu">
	<!-- BEGIN MINI-PROFILE -->
	<div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
		<div class="user-info-wrapper sm">
			<div class="profile-wrapper sm">
				<img src="{{ gayly_asset('vendor/gayly/assets/img/profiles/avatar.jpg') }}" alt="" data-src="{{ gayly_asset('vendor/gayly/assets/img/profiles/avatar.jpg') }}" data-src-retina="{{ gayly_asset('vendor/gayly/assets/img/profiles/avatar2x.jpg') }}" width="69"
				 height="69" />
				<div class="availability-bubble online"></div>
			</div>
			<div class="user-info sm">
				<div class="username">Fred <span class="semi-bold">Smith</span></div>
				<div class="status">Life goes on...</div>
			</div>
		</div>
		<!-- END MINI-PROFILE -->
		<!-- BEGIN SIDEBAR MENU -->
		<p class="menu-title sm">BROWSE <span class="pull-right"><a href="javascript:;"><i class="material-icons">refresh</i></a></span></p>
		<ul>
			@each('gayly::layouts.menu', Gayly::menu(), 'item')
		</ul>
		<div class="side-bar-widgets">
			<p class="menu-title sm">FOLDER <span class="pull-right"><a href="#" class="create-folder"> <i class="material-icons">add</i></a></span></p>
			<ul class="folders">
				<li>
					<a href="#">
						<div class="status-icon green"></div>
						My quick tasks </a>
				</li>
				<li>
					<a href="#">
						<div class="status-icon red"></div>
						To do list </a>
				</li>
				<li>
					<a href="#">
						<div class="status-icon blue"></div>
						Projects </a>
				</li>
				<li class="folder-input" style="display:none">
					<input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="">
				</li>
			</ul>
			<p class="menu-title">PROJECTS </p>
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
			</div>
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
		<a href="lockscreen.html"><i class="material-icons">power_settings_new</i></a></div>
</div>
