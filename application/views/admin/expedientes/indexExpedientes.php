<?php $this->load->view('admin/components/header'); ?>

<!--begin::App Main-->
<main class="app-main">
  <?php $this->load->view('admin/expedientes/_headerExpedientes'); ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <button
        class="btn btn-success mb-3"
        data-bs-toggle="modal"
        data-bs-target="#small"
        data-url="<?= base_url(EXPEDIENTES_PATH . '/frmNuevo') ?>"
        title="Nuevo expediente">
        <i class="bi bi-folder me-1"></i> Crear Expediente
      </button>

      <div class="card card-success border-success">
        <div class="card-header">
          <h3 class="card-title">Listado de Expedientes</h3>
        </div>
        <!-- /.card-header -->
        <div id="expedientes-main" class="card-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs mb-3" id="expedientesTabs" role="tablist" style="border-bottom: 2px solid #dee2e6;">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="en-progreso-tab" data-bs-toggle="tab" data-bs-target="#en-progreso" type="button" role="tab" aria-controls="en-progreso" aria-selected="true" style="background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; border-bottom: none; font-weight: 500;">
                Expedientes en Progreso
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="cerrados-tab" data-bs-toggle="tab" data-bs-target="#cerrados" type="button" role="tab" aria-controls="cerrados" aria-selected="false" style="background-color: #f8f9fa; color: #495057; border: 1px solid #dee2e6; border-bottom: none;">
                Expedientes Cerrados
              </button>
            </li>
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content" id="expedientesTabContent">
            <div class="tab-pane fade show active" id="en-progreso" role="tabpanel" aria-labelledby="en-progreso-tab">
              <?php 
                $data['expedientes'] = $expedientes_en_progreso;
                $data['table_id'] = 'tblExpedientesEnProgreso';
                $this->load->view('admin/expedientes/_tblExpedientes', $data); 
              ?>
            </div>
            <div class="tab-pane fade" id="cerrados" role="tabpanel" aria-labelledby="cerrados-tab">
              <?php 
                $data['expedientes'] = $expedientes_cerrados;
                $data['table_id'] = 'tblExpedientesCerrados';
                $this->load->view('admin/expedientes/_tblExpedientes', $data); 
              ?>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</main>
<!--end::App Main-->

<?php $this->load->view('admin/components/footer'); ?>
<style>
  /* Tab styling for better visibility */
  #expedientesTabs .nav-link {
    transition: all 0.2s ease;
    margin-right: 2px;
  }
  
  #expedientesTabs .nav-link:hover:not(.active) {
    background-color: #e9ecef !important;
    color: #212529 !important;
    border-color: #adb5bd !important;
  }
  
  #expedientesTabs .nav-link.active {
    background-color: #d1e7dd !important;
    color: #0f5132 !important;
    border-color: #badbcc !important;
    border-bottom-color: #fff !important;
    position: relative;
    z-index: 1;
  }
  
  #expedientesTabs .nav-link:not(.active) {
    background-color: #f8f9fa !important;
    color: #6c757d !important;
  }
</style>
<script src="<?= base_url(ADMIN_JS . '/expedientes.js'); ?>"></script>
