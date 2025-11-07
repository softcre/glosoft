<!--begin::Footer-->
<footer class="app-footer">
  <!--begin::To the end-->
  <div class="float-end d-none d-sm-inline">Anything you want</div>
  <!--end::To the end-->
  <!--begin::Copyright-->
  <strong>
    Copyright &copy; 2014-2025&nbsp;
    <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
  </strong>
  All rights reserved.
  <!--end::Copyright-->
</footer>
<!--end::Footer-->
</div>
<!--end::App Wrapper-->

<!--begin::Modal Small-->
<div class="modal fade" id="small" tabindex="-1" aria-labelledby="smallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-small">
      <!-- Content will be loaded here dynamically -->
    </div>
  </div>
</div>
<!--end::Modal Small-->

<!--begin::Modal Large-->
<div class="modal fade" id="large" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modal-large">
      <!-- Content will be loaded here dynamically -->
    </div>
  </div>
</div>
<!--end::Modal Large-->

<!--begin::Modal Extra Large-->
<div class="modal fade" id="extra-large" tabindex="-1" aria-labelledby="extraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" id="modal-extra-large">
      <!-- Content will be loaded here dynamically -->
    </div>
  </div>
</div>
<!--end::Modal Extra Large-->

<?php $this->load->view('admin/components/_scripts', ['log' => true]); ?>