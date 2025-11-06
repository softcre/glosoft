<?php $this->load->view('admin/components/_head', ['log' => false]); ?>

<body class="login-page bg-body-secondary">
  <div class="login-box">
    <div class="card card-outline card-success">
      <div class="card-header py-1">
        <img src="<?= base_url(APP_IMG . '/logo-glosoft.png') ?>" alt="Logo" class="d-block mx-auto brand-image img-fluid" style="max-width: 75px">
        <h3 class="link-dark text-center link-offset-2 link-opacity-50"><strong><?= APP_NAME; ?></strong></h3>
      </div>

      <div class="card-body pt-1 login-card-body">
        <p class="login-box-msg py-2">Inicie sesión</p>
        <form id="form_login" action="<?= base_url(ADMIN_PATH . '/login') ?>" method="post" onsubmit="login(event)">
          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="loginEmail" name="email" type="email" class="form-control" value="" placeholder="" />
              <label for="loginEmail">Email</label>
            </div>
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
          </div>
          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="loginPassword" name="pass" type="password" class="form-control" placeholder="" />
              <label for="loginPassword">Contraseña</label>
            </div>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>

          <div class="mt-3 text-center d-grid gap-2">
          <!--   <a href="#" class="btn btn-success">
              <i class="bi bi-box-arrow-in-right me-2"></i> Acceder
            </a> -->
            <button type="submit" id="btnFormLogin" class="btn btn-success" name="button">
              <div class="d-none">
                <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
                Accediendo...
              </div>
              <span><i class="bi bi-box-arrow-in-right me-2"></i>Acceder</span>
            </button>
          </div>
        </form>
        <!-- /.social-auth-links -->
        <!-- <p class="mb-1"><a href="forgot-password.html">I forgot my password</a></p> -->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>

  <?php $this->load->view('admin/components/_scripts', ['log' => false]) ?>
  <script src="<?= base_url(ADMIN_JS . '/login.js'); ?>"></script>