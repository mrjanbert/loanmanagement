<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/403-error.php');
  exit();
};
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs4/1.12.1/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-responsive/2.3.0/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.3.0/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.2.3/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.3.4/bs-custom-file-input.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

<script src="../../assets/js/scripts.js"></script>
<script src="custom.js"></script>


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
    $("#example3").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": [""],
      "ordering": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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