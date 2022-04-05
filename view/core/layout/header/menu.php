<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
<!-- Left navbar links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="index3.html" class="nav-link">Home</a>
  </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
  <!-- Navbar Search -->
  <li class="nav-item">
    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
      <i class="fas fa-search"></i>
    </a>
    <div class="navbar-search-block">
      <form class="form-inline">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>

  <!-- Messages Dropdown Menu -->
  
  <!-- Notifications Dropdown Menu -->
  
</ul>
</nav>
<!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="index3.html" class="brand-link">
  <img src="skin/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light">Admin Panel</span>
</a>
  <!-- SidebarSearch Form -->
  <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','admin')?>" class="nav-link">
                <p>Admin</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('grid','cart')?>" class="nav-link">
                <p>Order</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('grid','category')?>" class="nav-link">
                <p>Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','config')?>" class="nav-link">
                <p>Config</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','customer')?>" class="nav-link">
                <p>Customer</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','page')?>" class="nav-link">
                <p>Page</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('grid','product')?>" class="nav-link">
                <p>Product</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','salesman')?>" class="nav-link">
                <p>Salesman</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','vendor')?>" class="nav-link">
                <p>Vendor</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $this->getUrl('logout','admin_login')?>" class="nav-link">
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
</div>
</aside>