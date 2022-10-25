<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../error/404-error.php');
  exit();
};
?>

<?php if ($_SESSION['membership'] == '1') { ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Total Share Capital</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Borrowers</li>
            <li class="breadcrumb-item active">View Share Capital</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- <div class="col-lg-4 col-md-12 col-sm-12">
          <?php
          $uid = $_SESSION['user_id'];
          $query = "SELECT share_capital FROM tbl_totalshares WHERE borrower_id = " . $uid . " ORDER BY id DESC";
          $results = mysqli_query($conn, $query);
          $data = $results->fetch_assoc();
          $share_capital = $data['share_capital'];
          ?>
          <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-coins"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Share Capital <em>(for members only)</em></span>
              <div class="d-flex justify-content-between">
                <span class="info-box-number">
                  <?= number_format($share_capital, 2) ?>
                </span>
                <?php
                $user = "SELECT membership FROM tbl_borrowers WHERE user_id = " . $uid;
                $result = mysqli_query($conn, $user);
                $data = $result->fetch_assoc();
                $membership = $data['membership'];
                ?>
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Share Capital Transactions</h2>
              <div class="d-flex justify-content-end">
                <button onclick="history.back()" class="btn btn-warning btn-sm">
                  <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                  Back
                </button>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <?php include_once 'base/data-view-share-capital.php' ?>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
<?php } ?>