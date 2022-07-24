<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/403-error.php');
  exit();
};
?>
<!-- jQuery -->
<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Select 2 -->
<!-- <script src="../../assets/plugins/select2/js/select2.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<!-- DataTables  & Plugins -->
<script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../../assets/plugins/overlayScrollbars/js/OverlayScrollbars.min.js"></script>

<!-- BS Stepper -->
<!-- <script src="../../assets/plugins/bs-stepper/js/bs-stepper.min.js"></script> -->

<!-- AdminLTE App -->
<script src="../../assets/dist/js/adminlte.js"></script>

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": [""]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true
    });
  });
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  });
</script>

<script>
  $(function() {
    $('.select2').select2()
  })
</script>
<!-- <script>
  // BS-Stepper Init
  $(document).ready(function () {
    var stepper = new Stepper($('.bs-stepper')[0])
  });
</script> -->