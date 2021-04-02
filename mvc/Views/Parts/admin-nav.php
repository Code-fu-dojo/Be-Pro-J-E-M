<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->



    <div class="container-fluid">
      <div class="collapse navbar-collapse m-auto">

        <ul class="navbar-nav align-items-end ml-md-auto ">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="d-xl-none close-navbar">
              <i class="fas fa-times"></i>
            </div>
          </li>
        </ul>
      </div>
    </div>


    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="" class="navbar-brand-img" alt="Logo">
      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="<?= WEBROOT ?>admin">
              <i class="fas fa-home text-info"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= WEBROOT ?>admin/create">
              <i class="fas fa-plus-square text-success"></i>
              <span class="nav-link-text">Create</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= WEBROOT ?>admin/liste-update">
              <i class="fas fa-edit text-primary"></i>
              <span class="nav-link-text">Update</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= WEBROOT ?>admin/liste-delete">
              <i class="far fa-trash-alt text-danger"></i>
              <span class="nav-link-text">Delete</span>
            </a>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
      </div>
    </div>
  </div>
</nav>