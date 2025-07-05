<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="<?= base_url() ?>NiceAdmin/assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">Toko</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <!-- ✅ Notifikasi Diskon -->
  <?php if (session()->has('diskon_nominal')) : ?>
    <div class="w-100 text-center mt-2 px-4">
      <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert" style="max-width: 700px;">
        🎉 Hari ini ada diskon sebesar <?= number_to_currency(session('diskon_nominal'), 'IDR') ?> per item!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
      </div>
    </div>
  <?php endif; ?>
  <!-- ⛳ Akhir Notifikasi Diskon -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle" href="#">
          <i class="bi bi-search"></i>
        </a>
      </li>

      <!-- Notification -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">4</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have 4 new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <!-- Contoh notifikasi bisa kamu sesuaikan sendiri -->
        </ul>
      </li>

      <!-- Messages -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text"></i>
          <span class="badge bg-success badge-number">3</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
          <li class="dropdown-header">
            You have 3 new messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <!-- Contoh pesan bisa kamu sesuaikan sendiri -->
        </ul>
      </li>

      <!-- Profile -->
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?= base_url() ?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">
            <?= session()->get('username'); ?> (<?= session()->get('role'); ?>)
          </span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?= esc(session()->get('username')) ?></h6>
            <span><?= esc(session()->get('role')) ?></span>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('profile') ?>">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout') ?>">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>
        </ul>
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->