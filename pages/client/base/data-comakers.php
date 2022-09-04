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
                <th class="text-center">View</th>
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
                  <td align="center">
                    <a href="index.php?page=loan-information&ref_no=<?= $ref_no ?>  " class="btn btn-info btn-xs">Loan Information</a>
                    <?php if (($row['status_cashier'] == '1') || ($row['status_cashier'] == '2')) { ?>
                      <a href="index.php?page=view-payments&ref_no=<?= $ref_no ?>" class="btn btn-warning text-white btn-xs">View Payments</a>
                    <?php } ?>
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