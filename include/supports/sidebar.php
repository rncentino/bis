<div
  class="main-menu menu-fixed menu-light menu-accordion menu-shadow"
  data-scroll-to-active="true"
  data-img="assets/images/backgrounds/02.jpg"
>
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
        <a class="navbar-brand" href="index.php"
          ><img
            class="brand-logo"
            alt=""
            src="assets/logofiles/png/logoblack.png"
          />
          <h3 class="brand-text text-uppercase">BRGY. <?php echo $_SESSION['barangay']; ?></h3></a
        >
      </li>
      <li class="nav-item d-md-none">
        <a class="nav-link close-navbar"><i class="ft-x"></i></a>
      </li>
    </ul>
  </div>
  <div class="main-menu-content">
    <ul
      class="navigation navigation-main"
      id="main-menu-navigation"
      data-menu="menu-navigation"
    >
      <li class="nav-item">
        <a href="index.php"
          ><i class="la la-home"></i
          ><span class="menu-title" data-i18n="">Dashboard</span></a
        >
      </li>
      <li class="nav-item">
        <a href="residents.php"
          ><i class="la la-users"></i
          ><span class="menu-title" data-i18n="">Residents</span></a
        >
      </li>
      <li class="nav-item">
        <a href="households.php"
          ><i class="la la-map-signs"></i
          ><span class="menu-title" data-i18n="">Households</span></a
        >
      </li>
      <li class="nav-item">
        <a href="registry.php"
          ><i class="la la-folder"></i
          ><span class="menu-title" data-i18n="">Civil Registry</span></a
        >
      </li>
      <li class="nav-item">
        <a href="officials.php"
          ><i class="la la-user-secret"></i
          ><span class="menu-title" data-i18n="">Brgy. Officials</span></a
        >
      </li>
      <li class="nav-item">
        <a href="case.php"
          ><i class="la la-balance-scale"></i
          ><span class="menu-title" data-i18n="">Case Mgmt.</span></a
        >
      </li>
      <li class="nav-item">
        <a href="events.php"
          ><i class="la la-calendar-check-o"></i
          ><span class="menu-title" data-i18n="">Projects & Events</span></a
        >
      </li>
      <li class="nav-item">
        <a href="permits.php"
          ><i class="la la-legal"></i
          ><span class="menu-title" data-i18n="">Permits</span></a
        >
      </li>
      <li class="active">
        <a href="supports.php"
          ><i class="la la-info"></i
          ><span class="menu-title" data-i18n="">Helps & Support</span></a
        >
      </li>
    </ul>
  </div>
  <div class="navigation-background"></div>
</div>