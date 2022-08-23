<!-- Small boxes (Stat box) -->
<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
<div class="row">
  <div class="col-lg-6 col-6">
    <?php
    $query = "SELECT * FROM tbl_transaction WHERE borrower_id = " . $_SESSION['user_id'];
    $results = mysqli_query($conn, $query);
    $totalloans = mysqli_num_rows($results);
    ?>
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo $totalloans; ?></h3>
        <p>Total Loans</p>
      </div>
      <div class="icon">
        <i class="fas fa-list-ul"></i>
      </div>
      <a href="index.php?page=view-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-6 col-6">
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
        <p>Payments List</p>
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
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Reference No.</th>
                <th class="text-center">Requested By</th>
                <th class="text-center">Principal Amount</th>
                <th class="text-center">Loan Date</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
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
                                        WHERE t.comaker_id = $user_id AND b.user_id != $user_id");

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
                  <td align="center">
                    <?php if ($status_comaker == 0) : ?>
                      <a href="../../config/update-status.php?approveref_no=<?= $row['status_ref']; ?>" class="btn btn-success btn-xs">Approve</a>
                      <a type="button" href="../../config/update-status.php?denyref_no=<?= $row['status_ref']; ?>" class="btn btn-danger btn-xs">Disapprove</a>
                    <?php elseif ($status_comaker == 1) : ?>
                      <button type="button" class="btn btn-secondary btn-xs">Approved</button>
                    <?php elseif ($status_comaker == 2) : ?>
                      <button type="button" class="btn btn-secondary btn-xs">Disapproved</button>
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