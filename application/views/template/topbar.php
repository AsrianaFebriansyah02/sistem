  <!-- Topbar Start -->
  <div class="navbar-custom">
      <ul class="list-unstyled topnav-menu float-right mb-0">

          <li class="d-none d-sm-block">
              <form class="app-search">
                  <div class="app-search-box">
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search...">
                          <div class="input-group-append">
                              <button class="btn" type="submit">
                                  <i class="fe-search"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </form>
          </li>


          <li class="dropdown notification-list">
              <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <img src="<?php echo base_url('public/assets/'); ?>images\users\avatar-1.jpg" alt="user-image" class="rounded-circle">
                  <span class="pro-user-name ml-1">
                      Nik Patel <i class="mdi mdi-chevron-down"></i>
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                  <!-- item-->
                  <div class="dropdown-header noti-title">
                      <h6 class="text-overflow m-0">Welcome !</h6>
                  </div>

                  <!-- item-->
                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                      <i class="remixicon-account-circle-line"></i>
                      <span>My Account</span>
                  </a>

                  <!-- item-->
                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                      <i class="remixicon-settings-3-line"></i>
                      <span>Settings</span>
                  </a>

                  <!-- item-->
                  <a href="<?php echo base_url('views/index'); ?>" class="dropdown-item notify-item">
                      <i class="remixicon-logout-box-line"></i>
                      <span>Logout</span>
                  </a>

              </div>
          </li>

      </ul>

      <!-- LOGO -->
      <div class="logo-box">
          <a href="index.html" class="logo text-center">
              <span class="logo-lg">
                  <img src="<?php echo base_url('public/assets/'); ?>images\logo.png" alt="" height="50">
                  <!-- <span class="logo-lg-text-light">Xeria</span> -->
              </span>
              <span class="logo-sm">
                  <!-- <span class="logo-sm-text-dark">X</span> -->
                  <img src="<?php echo base_url('public/assets/'); ?>images\logo-sm.png" alt="" height="24">
              </span>
          </a>
      </div>

      <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
          <li>
              <button class="button-menu-mobile waves-effect waves-light">
                  <i class="fe-menu"></i>
              </button>
          </li>


      </ul>
  </div>
  <!-- end Topbar -->