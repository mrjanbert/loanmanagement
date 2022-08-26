<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) != ('Unknown User'))) : ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Disapproved Loans</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Manager</li>
            <li class="breadcrumb-item">Disapproved Loans</li>
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
              <h2 class="card-title">Disapproved Loans</h2>
              <div class="d-flex justify-content-end">
                <button onclick="history.back()" class="btn btn-warning btn-sm">
                  <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                  Back
                </button>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <?php include_once 'base/data-manager-disapproved-loans.php' ?>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
<?php endif; ?>