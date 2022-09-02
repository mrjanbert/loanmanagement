<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
  exit();
};
?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-4 col-12 col-sm-12 col-md-4">
    <?php
    $query = "SELECT * FROM tbl_transaction";
    $results = mysqli_query($conn, $query);
    $total_loans = mysqli_num_rows($results);
    ?>
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?= $total_loans; ?></h3>
        <p>Total Loans</p>
      </div>
      <div class="icon">
        <i class="fas fa-list-ul"></i>
      </div>
      <a href="index.php?page=view-dashboard-total-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-12 col-sm-12 col-md-4">

    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <?php
        $sql = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s on s.ref_no = t.ref_no WHERE s.status_cashier = '2'";
        $results = mysqli_query($conn, $sql);
        $total_releasedloans = mysqli_num_rows($results);
        ?>
        <h3><?= $total_releasedloans; ?></h3>
        <p>Payments</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill-wave"></i>
      </div>
      <a href="index.php?page=view-dashboard-payments-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-12 col-sm-12 col-md-4">

    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <?php
        $sql = "SELECT * FROM tbl_borrowers";
        $results = mysqli_query($conn, $sql);
        $total_borrowers = mysqli_num_rows($results);
        ?>
        <h3><?= $total_borrowers; ?></h3>
        <p>Registered Borrowers</p>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
      <a href="index.php?page=borrower-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->

<?php if ($_SESSION['role_name'] == "Admin") { ?>

  <div class="col-lg-6 col-12 col-sm-12 col-md-6">
    <!-- small box -->
    <div class="small-box bg-lightblue">
      <div class="inner">
        <?php
        $sql = "SELECT * FROM tbl_comakers";
        $results = mysqli_query($conn, $sql);
        $comakers = mysqli_num_rows($results);
        ?>
        <h3><?= $comakers; ?></h3>
        <p>Comakers</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-friends"></i>
      </div>
      <a href="index.php?page=comakers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-6 col-12 col-sm-12 col-md-6">

    <!-- small box -->
    <div class="small-box bg-olive">
      <div class="inner">
        <?php
        $sql = "SELECT * FROM tbl_users";
        $results = mysqli_query($conn, $sql);
        $users = mysqli_num_rows($results);
        ?>
        <h3><?= $users; ?></h3>
        <p>Users</p>
      </div>
      <div class="icon">
        <i class="fas fa-users-cog"></i>
      </div>
      <a href="index.php?page=user-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <?php } ?>
</div>
<!-- /.row -->

<?php if ($_SESSION['role_name'] == "Admin") { ?>
  <!-- Main row (comaker status) -->
  <div class="row mt-3 mb-2">
    <?php if ($_SESSION['role_name'] == "Admin") { ?>
      <div class="col-sm-12 mb-3">
        <h2>Comaker's List</h2>
      </div>
    <?php } ?>
    <div class="col-lg-4 col-12 col-sm-12 col-md-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <?php
        $sql = "SELECT * FROM tbl_status WHERE status_comaker = '0'";
        $results = mysqli_query($conn, $sql);
        $pending_comaker = mysqli_num_rows($results);
        ?>
        <div class="inner">
          <h3><?= $pending_comaker ?></h3>
          <p>Pending Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <a href="index.php?page=view-comaker-pending-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-12 col-sm-12 col-md-4">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_comaker = '1'";
          $results = mysqli_query($conn, $sql);
          $approved_comaker = mysqli_num_rows($results);
          ?>
          <h3><?= $approved_comaker ?></h3>
          <p>Approved Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-thumbs-up"></i>
        </div>
        <a href="index.php?page=view-comaker-approved-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-12 col-sm-12 col-md-4">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_comaker = '2'";
          $results = mysqli_query($conn, $sql);
          $disapproved_comaker = mysqli_num_rows($results);
          ?>
          <h3><?= $disapproved_comaker ?></h3>
          <p>Disapproved Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-thumbs-down"></i>
        </div>
        <a href="index.php?page=view-comaker-disapproved-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

  </div>
<?php } ?>

<?php if ($_SESSION['role_name'] == "Processor" || ($_SESSION['role_name'] == "Admin")) { ?>
  <!-- Main row (cc member status) -->
  <div class="row mt-3 mb-2">
    <?php if ($_SESSION['role_name'] == "Admin") { ?>
      <div class="col-sm-12 mb-3">
        <h2>CC Member's List</h2>
      </div>
    <?php } ?>
    <div class="col-lg-6 col-12 col-sm-12 col-md-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_processor = '0' AND status_comaker = '1'";
          $results = mysqli_query($conn, $sql);
          $pending_processor = mysqli_num_rows($results);
          ?>
          <h3><?= $pending_processor ?></h3>
          <p>Pending Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <a href="index.php?page=view-processor-pending-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-6 col-12 col-sm-12 col-md-6">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_processor = '1' AND status_comaker = '1'";
          $results = mysqli_query($conn, $sql);
          $approved_processor = mysqli_num_rows($results);
          ?>
          <h3><?= $approved_processor ?></h3>
          <p>Checked and Verified Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-thumbs-up"></i>
        </div>
        <a href="index.php?page=view-processor-approved-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->


  </div>
<?php } ?>

<?php if ($_SESSION['role_name'] == "Manager" || ($_SESSION['role_name'] == "Admin")) { ?>
  <!-- Main row (manager status) -->
  <div class="row mt-3 mb-2">
    <?php if ($_SESSION['role_name'] == "Admin") { ?>
      <div class="col-sm-12 mb-3">
        <h2>Manager's List</h2>
      </div>
    <?php } ?>
    <div class="col-lg-4 col-12 col-sm-12 col-md-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_manager = '0' AND status_processor = '1'";
          $results = mysqli_query($conn, $sql);
          $pending_manager = mysqli_num_rows($results);
          ?>
          <h3><?= $pending_manager ?></h3>
          <p>Pending Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <a href="index.php?page=view-manager-pending-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-12 col-sm-12 col-md-4">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_manager = '1' AND status_processor = '1'";
          $results = mysqli_query($conn, $sql);
          $approved_manager = mysqli_num_rows($results);
          ?>
          <h3><?= $approved_manager ?></h3>
          <p>Approved Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-thumbs-up"></i>
        </div>
        <a href="index.php?page=view-manager-approved-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-12 col-sm-12 col-md-4">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_manager = '3' AND status_processor = '1'";
          $results = mysqli_query($conn, $sql);
          $disapproved_manager = mysqli_num_rows($results);
          ?>
          <h3><?= $disapproved_manager ?></h3>
          <p>Disapproved Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-thumbs-down"></i>
        </div>
        <a href="index.php?page=view-manager-disapproved-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

  </div>
<?php } ?>

<?php if ($_SESSION['role_name'] == "Cashier" || ($_SESSION['role_name'] == "Admin")) { ?>
  <!-- Main row (cashier status) -->
  <div class="row mt-3 mb-2">
    <?php if ($_SESSION['role_name'] == "Admin") { ?>
      <div class="col-sm-12 mb-3">
        <h2>Cashier's List</h2>
      </div>
    <?php } ?>
    <div class="col-lg-3 col-12 col-sm-12 col-md-3">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_cashier = '0' AND status_manager = '1'";
          $results = mysqli_query($conn, $sql);
          $pending_cashier = mysqli_num_rows($results);
          ?>
          <h3><?= $pending_cashier ?></h3>
          <p>Pending Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <a href="index.php?page=view-cashier-pending-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-12 col-sm-12 col-md-3">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_cashier = '1' AND status_manager = '1'";
          $results = mysqli_query($conn, $sql);
          $approved_cashier = mysqli_num_rows($results);
          ?>
          <h3><?= $approved_cashier ?></h3>
          <p>Approved Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-thumbs-up"></i>
        </div>
        <a href="index.php?page=view-cashier-approved-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-12 col-sm-12 col-md-3">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_cashier = '3' AND status_manager = '1'";
          $results = mysqli_query($conn, $sql);
          $disapproved_cashier = mysqli_num_rows($results);
          ?>
          <h3><?= $disapproved_cashier ?></h3>
          <p>Disapproved Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-thumbs-down"></i>
        </div>
        <a href="index.php?page=view-cashier-disapproved-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-12 col-sm-12 col-md-3">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <?php
          $sql = "SELECT * FROM tbl_status WHERE status_cashier = '2' AND status_manager = '1'";
          $results = mysqli_query($conn, $sql);
          $released_cashier = mysqli_num_rows($results);
          ?>
          <h3><?= $released_cashier ?></h3>
          <p>Payments</p>
        </div>
        <div class="icon">
          <i class="fas fa-money-check-alt"></i>
        </div>
        <a href="index.php?page=view-dashboard-payments-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

  </div>
<?php } ?>