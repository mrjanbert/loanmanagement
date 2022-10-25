<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../error/404-error.php');
  exit();
};
?>

<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) != ('Unknown User'))) : ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Monthly Due Date</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Borrowers</li>
            <li class="breadcrumb-item">Loans</li>
            <li class="breadcrumb-item">View Payments</li>
            <li class="breadcrumb-item active">Due Date Reminders</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of Due Dates (every month)</h3>
              <div class="d-flex justify-content-end">
                <button onclick="history.back()" class="btn btn-warning btn-sm">
                  <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                  Back
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <p>Reminders are set automatically three(3) days before the due date.</p>
              <?php include_once 'base/data-monthly-reminders.php' ?>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->


  <script>
    $(".delete_monthly_notify").click(function() {
      var del_month_notif = $(this).data('del_month_notif');
      console.log({
        del_month_notif
      });
      Swal.fire({
        title: 'Confirm Delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "../../config/delete-monthly-reminder.php?notif_id=" + del_month_notif;
        }
      })
    });
  </script>
<?php endif; ?>