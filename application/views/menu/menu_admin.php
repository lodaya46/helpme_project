<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
			<a href="<?php echo site_url('rekap/tiket_open/new');?>" class="site_title"><img src="<?php echo base_url();?>asset/image/icon.png" alt="..."  style="height:50px;width:50px"> <span>Helpme</span></a>
        </div>

        <div class="clearfix"></div>

       

        <br />

            <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
           <h3>Welcome <?php echo $this->session->userdata('USERNAME') ?></h3>
			<ul class="nav side-menu">
				<li><a><i class="fa fa-bar-chart-o"></i>Master Data<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					<li><a href="<?php echo site_url('master/department/new');?>">Departemen</a></li>
					   <li><a href="<?php echo site_url('master/topic/new');?>">Topik Permasalahan</a></li>
                      <li><a href="<?php echo site_url('master/user/new');?>">Pengguna</a></li>
					</ul>
                </li>
				<li><a><i class="fa fa-bar-chart-o"></i>Rekap<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					<li><a href="<?php echo site_url('rekap/tiket/new');?>">Tiket</a></li>
					<li><a href="<?php echo site_url('rekap/tiket_open/new');?>">Tiket Open</a></li>
					<li><a href="<?php echo site_url('rekap/tiket_progress/new');?>">Tiket Progress</a></li>
					<li><a href="<?php echo site_url('rekap/tiket_close/new');?>">Tiket Close</a></li>
					<li><a href="<?php echo site_url('rekap/time_tiket/new');?>">Recovery Time</a></li>
					</ul>
                </li>
            </ul>
			</div>
		</div>
            <!-- /sidebar menu -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
		<nav>
		<div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

		<ul class="nav navbar-nav navbar-right">
            <li class="">
               <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo $this->session->userdata('nama');?>
                    <span class=" fa fa-angle-down"></span>
                </a>
				<ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo site_url('auth/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
            </li>
		</ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->