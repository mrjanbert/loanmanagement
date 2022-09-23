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
        <div class="col-lg-4 col-md-12 col-sm-12">
          <?php
          $uid = $_GET['uid'];
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
                <?php if (($_SESSION['role_name'] == 'Admin') && ($membership == 1)) { ?>
                  <span class="info-box-number">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#updatecapital">Update</a>
                  </span>
                <?php } ?>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
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


  <div class="modal fade" id="updatecapital">
    <div class="modal-dialog modal-md">
      <form action="../../config/update-sharecapital.php" onsubmit="submitbtn.disabled = true; return true;" method="POST" autocomplete="off">
        <div class="modal-content card-outline card-primary">
          <div class="modal-header">
            <h4 class="modal-title">Update Share Capital</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <input type="hidden" value="<?= $uid ?>" name="uid">
              <div class="col-12">
                <div class="form-group">
                  <label>Name</label>
                  <?php
                  $getname = $conn->query("SELECT concat(firstName,' ',lastName) as borrower_name FROM tbl_borrowers WHERE user_id = '$uid'");
                  $name = $getname->fetch_assoc();
                  $borrower_name = $name['borrower_name'];
                  ?>
                  <input type="text" class="form-control form-control-border" value="<?= $borrower_name ?>" disabled>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Operation <small class="text-red">*</small></label>
                  <select name="operator" data-placeholder="Select Operation" style="width: 100%;" class="select2" required>
                    <option value=""></option>
                    <option value="add">Deposit</option>
                    <option value="minus">Withdraw</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Amount <small class="text-red">*</small></label>
                  <input type="text" class="form-control form-control-border" name="amount" placeholder="Enter Amount" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Description <small class="text-red">*</small></label>
                  <input type="text" class="form-control form-control-border" name="description" placeholder="Enter Particular Description" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <input type="hidden" name="submit">
            <button type="submit" name="submitbtn" class="btn btn-primary">
              Update
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancel
            </button>
          </div>
        </div>
      </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<?php endif ?>