<!--begin::App Content Header-->
<div class="app-content-header">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-0"><?= $title; ?></h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <?php if ($act == "edi_insp") : ?>
						<li class="breadcrumb-item"><a href="<?= base_url(INSPECCIONES_PATH); ?>"><?= $title; ?></a></li>
						<li class="breadcrumb-item active">Edición</li>
					<?php else : ?>
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
					<?php endif; ?>
        </ol>
      </div>
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::App Content Header-->