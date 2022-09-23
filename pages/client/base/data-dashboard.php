<!-- Small boxes (Stat box) -->
<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
  exit();
};
?>
<div class="row">
  <div class="col-lg-4 col-md-12 col-sm-12">
    <?php
    $query = "SELECT share_capital FROM tbl_totalshares WHERE borrower_id = " . $_SESSION['user_id'] . " ORDER BY id DESC";
    $results = mysqli_query($conn, $query);
    $data = $results->fetch_assoc();
    $share_capital = $data['share_capital'];
    ?>
    <div class="info-box">
      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-coins"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Share Capital <em>(for members only)</em></span>
        <span class="info-box-number">
          <?= number_format($share_capital, 2) ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-lg-4 col-md-12 col-sm-12">
    <?php
    $query = "SELECT SUM(t.amount) as total_loan FROM tbl_transaction t INNER JOIN tbl_status s ON s.ref_no = t.ref_no WHERE borrower_id = " . $_SESSION['user_id'] . " AND s.status_cashier = '2'";
    $results = mysqli_query($conn, $query);
    $data = $results->fetch_assoc();
    $total_loan = $data['total_loan'];
    ?>
    <div class="info-box">
      <span class="info-box-icon bg-success elevation-1"><i class="far fa-credit-card"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Loans</span>
        <span class="info-box-number">
          <?= number_format($total_loan, 2) ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
    
  <div class="col-lg-4 col-md-12 col-sm-12">
    <?php
    $query = "SELECT SUM(p.payment_amount) as payment_amount FROM ((tbl_payments p INNER JOIN tbl_transaction t ON p.ref_no = t.ref_no) INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) WHERE b.user_id = " . $_SESSION['user_id'];
    $results = mysqli_query($conn, $query);
    $data = $results->fetch_assoc();
    $payment_amount = $data['payment_amount'];
    ?>
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Payments</span>
        <span class="info-box-number">
          <?= number_format($payment_amount, 2) ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-lg-6 col-md-6">
    <?php
    $query = "SELECT * FROM tbl_transaction WHERE borrower_id = " . $_SESSION['user_id'];
    $results = mysqli_query($conn, $query);
    $totalloans = mysqli_num_rows($results);
    ?>
    <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?php echo $totalloans; ?></h3>
          <p>Total Number of Loans</p>
        </div>
        <div class="icon">
          <i class="fas fa-list-ul"></i>
        </div>
        <a href="index.php?page=view-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-6 col-md-6">
    <?php
    $sql = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s on s.ref_no = t.ref_no WHERE s.status_cashier = '2' AND t.borrower_id = " . $_SESSION['user_id'];
    $results = mysqli_query($conn, $sql);
    $total_releasedloans = mysqli_num_rows($results);
    ?>
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?= $total_releasedloans ?></h3>
        </h3>
        <p>Total Number of Loans Released</p>
      </div>
      <div class="icon">
        <i class="fas fa-tasks"></i>
      </div>
      <a href="index.php?page=view-payment-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->

  </div>
        <!-- /.row -->

        <!-- Main row -->
        <?php
        if ($_SESSION['membership'] == 1) :
        ?>
          <div class="row mt-5">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title">Co-maker's Requested Loans</h2>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Reference No.</th>
                        <th class="text-center">Requested By</th>
                        <th class="text-center">Principal Amount</th>
                        <th class="text-center">Loan Date</th>
                        <th class="text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      $user_id = $_SESSION['user_id'];

                      $query = $conn->query("SELECT t.*, 
                                        b.firstName, b.middleName, b.lastName, 
                                        s.status_comaker, s.status_processor, s.status_manager, s.status_cashier 
                                        FROM ((tbl_transaction t 
                                            INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) 
                                            INNER JOIN tbl_status s ON t.status_ref = s.ref_no)  
                                        WHERE t.comaker_id = $user_id AND b.user_id != $user_id ORDER BY t.loan_date DESC");

                      while ($row = $query->fetch_assoc()) :
                        $id = $row['id'];
                        $ref_no = $row['ref_no'];
                        $name = $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'];
                        $amount = $row['amount'];
                        $loan_date = $row['loan_date'];
                        $status_comaker = $row['status_comaker'];
                      ?>
                        <tr>
                          <td class="text-center"><?= $i++ ?></td>
                          <td><?= $ref_no; ?></td>
                          <td><?= $name; ?></td>
                          <td><?= number_format($amount, 2); ?></td>
                          <td><?= date('F j, Y', strtotime($loan_date)); ?></td>
                          <td class="text-center">
                            <?php if ($status_comaker == 0) : ?>
                              <button type="button" style="pointer-events:none" class="btn btn-warning text-white btn-xs">Pending</button>
                            <?php elseif ($status_comaker == 1) : ?>
                              <button type="button" style="pointer-events:none" class="btn btn-success btn-xs">Approved</button>
                            <?php elseif ($status_comaker == 2) : ?>
                              <button type="button" style="pointer-events:none" class="btn btn-danger btn-xs">Disapproved</button>
                            <?php endif; ?>
                          </td>
                        </tr>

                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div><!-- /.card-body -->
              </div><!-- /.card -->
            </div><!-- /.col -->
          </div>
          <!-- /.row (main row) -->
        <?php endif ?>