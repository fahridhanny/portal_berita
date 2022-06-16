<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CMS Berita</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/admin/home" class="nav-link">
              <i class="nav-icon far fa-solid fa-home"></i>
                <p>
                  Dashboard
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/content" class="nav-link">
              <i class="nav-icon far fa-solid fa-newspaper"></i>
              <p>
                Berita
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/kategori" class="nav-link">
              <i class="nav-icon far fa-solid fa-clipboard-check"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/tag" class="nav-link">
              <i class="nav-icon far fa-solid fa-tags"></i>
              <p>
                Tag
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/banner" class="nav-link">
              <i class="nav-icon far fa-solid fa-image"></i>
              <p>
                Banner
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/tentang-kami" class="nav-link">
              <i class="nav-icon far fa-solid fa-address-book"></i>
              <p>
                Contact
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/user" class="nav-link">
              <i class="nav-icon fas fa-solid fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>