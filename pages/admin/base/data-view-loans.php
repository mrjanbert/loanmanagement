<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
  exit();
};
?>
<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th class="text-center">Reference No.</th>
      <th class="text-center">Type of Loan</th>
      <th class="text-center">Principal Amount</th>
      <?php if (isset($_SESSION['role_name']) && ($_SESSION['role_name'] == null) || $_SESSION['role_name'] == 'Admin') {
        '';
      } else { ?>
        <th class="text-center">Status</th>
      <?php } ?>
      <th class="text-center">View</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $i = 1;
    $user_id = $_GET['uid'];
    $role_name = $_SESSION['role_name'];
    $query = $conn->query("SELECT t.*, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name, s.*, concat(c.firstname, ' ', c.lastName) as comaker_name,  concat(u.firstname, ' ', u.lastName) as user_name
                                    FROM ((((tbl_transaction t 
                                        INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) 
                                        INNER JOIN tbl_status s ON t.status_ref = s.ref_no) 
                                        LEFT JOIN tbl_users u ON s.processor_id = u.user_id) 
                                        INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id) 
                                    WHERE t.borrower_id = $user_id");
    while ($row = $query->fetch_assoc()) :
      $ref_no = $row['ref_no'];
      $borrower_name = $row['borrower_name'];
      $loan_type = $row['loan_type'];
      $purpose = $row['purpose'];
      $loan_term = $row['loan_term'];
      $loan_date = strtotime($row['loan_date']);
      $amount = $row['amount'];
      $comaker_name = $row['comaker_name'];
      $user_name = $row['user_name'];
      $status_comaker = $row['status_comaker'];
      $status_manager = $row['status_manager'];
      $status_processor = $row['status_processor'];
      $status_cashier = $row['status_cashier'];
      $comaker_date = $row['comaker_dateprocess'];
      $processor_date = $row['processor_dateprocess'];
      $manager_date = $row['manager_dateprocess'];
      $cashier_date = $row['cashier_dateprocess'];
    ?>

      <tr class="text-center">
        <td>
          <p class="my-1"><?= $i++; ?></p>
        </td>
        <td>
          <p class="my-1"><?= $ref_no; ?></p>
        </td>
        <td>
          <p class="my-1"><?= $loan_type; ?></p>
        </td>
        <td>
          <p class="my-1"><b style="color: blue"><?= number_format($amount, 2); ?></b></p>
        </td>

        <?php if (isset($role_name) && ($role_name == 'Manager')) {  ?>
          <?php if ($status_processor == 1) : ?>
            <td class="text-center">
              <?php if ($status_manager == 0) : ?>
                <button type="button" class="btn btn-warning btn-xs my-1 text-white" style="pointer-events: none">Pending</button>
              <?php elseif ($status_manager == 1) : ?>
                <button type="button" class="btn btn-primary btn-xs my-1" style="pointer-events: none">Approved</button>
              <?php elseif ($status_manager == 3) : ?>
                <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved</button>
              <?php endif; ?>
            </td>
          <?php elseif (($status_processor == 0) && ($status_comaker == 1)) : ?>
            <td class="text-center">
              <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for CC Member's Approval</button>
            </td>
          <?php elseif (($status_processor == 0) && ($status_comaker == 0)) : ?>
            <td class="text-center">
              <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for Co-maker's Approval</button>
            </td>
          <?php else : ?>
            <td class="text-center">
              <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved by Co-maker</button>
            </td>
          <?php endif ?>

        <?php } elseif (isset($role_name) && ($role_name == 'Processor')) {  ?>
          <?php if ($status_comaker == 1) : ?>
            <td class="text-center">
              <?php if ($status_processor == 0) : ?>
                <button type="button" class="btn btn-warning btn-xs my-1 text-white" style="pointer-events: none">Pending</button>
              <?php elseif ($status_processor == 1) : ?>
                <button type="button" class="btn btn-primary btn-xs my-1" style="pointer-events: none">Checked and Verified</button>
              <?php endif; ?>
            </td>
          <?php elseif ($status_comaker == 0) : ?>
            <td class="text-center">
              <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for Co-maker's Approval</button>
            </td>
          <?php else : ?>
            <td class="text-center">
              <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved by Co-maker</button>
            </td>
          <?php endif ?>

        <?php } elseif (isset($role_name) && ($role_name == 'Cashier')) {  ?>
          <?php if ($status_manager == 1) : ?>
            <td class="text-center">
              <?php if ($status_cashier == 0) : ?>
                <button type="button" class="btn btn-warning btn-xs my-1 text-white" style="pointer-events: none">Pending</button>
              <?php elseif ($status_cashier == 1) : ?>
                <button type="button" class="btn btn-primary btn-xs my-1" style="pointer-events: none">Approved</button>
              <?php elseif ($status_cashier == 2) : ?>
                <button type="button" class="btn btn-success btn-xs my-1" style="pointer-events: none">Released</button>
              <?php elseif ($status_cashier == 3) : ?>
                <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved</button>
              <?php endif; ?>
            </td>
          <?php elseif ($status_manager == 3) : ?>
            <td class="text-center">
              <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Approved by: CC Member <br />Disapproved by: Manager</button>
            </td>
          <?php elseif (($status_manager == 0) && ($status_processor == 1)) : ?>
            <td class="text-center">
              <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for Manager's Approval</button>
            </td>
          <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 1)) : ?>
            <td class="text-center">
              <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for CC Member's Approval</button>
            </td>
          <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 0)) : ?>
            <td class="text-center">
              <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for Co-maker's Approval</button>
            </td>
          <?php else : ?>
            <td class="text-center">
              <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved by Co-maker</button>
            </td>
          <?php endif ?>
        <?php } else {
          '';
        } ?>

        <td class="text-center">
          <a href="index.php?page=grace-period&ref_no=<?= $ref_no ?>" class="btn btn-primary my-1 btn-xs">
            Grace Period
          </a>
          <a href="app-form.php?ref_no=<?= $row['ref_no'] ?>" target="_blank" class="btn btn-success my-1 btn-xs">
            Application Form
          </a>
          <a class="btn btn-info btn-xs my-1" href="index.php?page=loan-information&ref_no=<?= $ref_no ?>">
            Loan Information
          </a>
          <?php if (($role_name != null) && (($status_cashier == 1) || ($status_cashier == 2))) {  ?>
            <a href="index.php?page=view-payments&refid=<?= $ref_no ?>" class="btn btn-warning my-1 text-white btn-xs">
              View Payments
            </a>
          <?php } ?>
        </td>
        <td class="text-center">
          <?php if (isset($role_name) && ($role_name == 'Admin')) {  ?>
            <a href="javascript:void(0);" class="btn btn-danger delete_loan btn-xs my-1" data-delete_loan="<?= $ref_no ?>">
              <i class="fa fa-trash"></i>
              Delete
            </a>
          <?php } ?>
          <?php if (isset($role_name) && ($role_name == 'Manager')) {  ?>
            <?php if ($status_processor == 1) : ?>
              <?php if ($status_manager == 0) : ?>
                <a href="javascript:void(0);" class="btn btn-success btn-xs my-1 approve_manager" title="Approve Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                  <i class="fas fa-thumbs-up"></i>&nbsp;Approve
                </a>
                <a href="javascript:void(0);" class="btn btn-danger btn-xs my-1 disapprove_manager" title="Disapprove Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                  <i class="fas fa-thumbs-down"></i>&nbsp;Disapprove
                </a>
              <?php elseif ($status_manager == 1) : ?>
                <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                  Approved
                </a>
              <?php elseif ($status_manager == 3) : ?>
                <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                  Disapproved
                </a>
              <?php endif; ?>
            <?php elseif (($status_processor == 0) && ($status_comaker == 0)) : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Waiting for Co-maker's Approval
              </a>
            <?php elseif (($status_processor == 0) && ($status_comaker == 1)) : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Waiting for CC Member's Approval
              </a>
            <?php else : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Disapproved by Co-maker
              </a>
            <?php endif; ?>

          <?php } elseif (isset($role_name) && ($role_name == 'Processor')) {  ?>
            <?php if ($status_comaker == 1) : ?>
              <?php if ($status_processor == 0) : ?>
                <a href="javascript:void(0);" class="btn btn-success btn-xs my-1 approve_processor" title="Approve Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                  <i class="fa fa-check"></i>&nbsp;Check and Verify
                </a>
              <?php elseif ($status_processor == 1) : ?>
                <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                  Checked and Verified
                </a>
              <?php endif; ?>
            <?php elseif ($status_comaker == 0) : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Waiting for Co-maker's Approval
              </a>
            <?php else : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Disapproved by Co-maker
              </a>

            <?php endif; ?>

          <?php } elseif (isset($role_name) && ($role_name == 'Cashier')) {  ?>
            <?php if ($status_manager == 1) : ?>
              <?php if ($status_cashier == 0) : ?>
                <a href="javascript:void(0);" class="btn btn-success btn-xs my-1 approve_cashier" title="Approve Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                  <i class="fas fa-thumbs-up"></i>&nbsp;Approve
                </a>
                <a href="javascript:void(0);" class="btn btn-danger btn-xs my-1 disapprove_cashier" title="Disapprove Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                  <i class="fas fa-thumbs-down"></i>&nbsp;Disapprove
                </a>
              <?php elseif ($status_cashier == 1) : ?>
                <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                  </i>&nbsp;Approved
                </a>
              <?php elseif ($status_cashier == 2) : ?>
                <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                  Released
                </a>
              <?php elseif ($status_cashier == 3) : ?>
                <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                  Disapproved
                </a>
              <?php endif; ?>
            <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 0)) : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Waiting for Co-maker's Approval
              </a>
            <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 1)) : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Waiting for CC Member's Approval
              </a>
            <?php elseif (($status_manager == 0) && ($status_processor == 1) && ($status_comaker == 1)) : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Waiting for Manager's Approval
              </a>
            <?php else : ?>
              <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                Disapproved by Co-maker
              </a>
            <?php endif; ?>
          <?php } else {
            '';
          } ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>