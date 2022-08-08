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
          <a href="index.php?page=application-form&ref_no=<?= $ref_no ?>" class="btn btn-success my-1 btn-xs">
            Application Form
          </a>
          <button class="btn btn-info btn-xs my-1 viewuserloan" data-toggle="modal" data-target="#viewloan" data-borrower_name="<?= $borrower_name ?>" data-ref_no="<?= $ref_no ?>" data-viewloan_amount="<?= number_format($amount, 2) ?>" data-viewloan_term="<?= $loan_term ?> Months" data-viewloan_type="<?= $loan_type ?>" data-loan_date="<?= date('M j, Y - g:i A', $loan_date) ?>" data-purpose="<?= $purpose ?>" data-comaker_name="<?= $comaker_name ?>" data-status_user_name="<?= $user_name ?>" data-comaker_date="<?= ($comaker_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($comaker_date)) : '' ?>" data-processor_date="<?= ($processor_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($processor_date)) : '' ?>" data-manager_date="<?= ($manager_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($manager_date)) : '' ?>" data-cashier_date="<?= ($cashier_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($cashier_date)) : '' ?>" data-status_comaker="<?= ($row['status_comaker'] == '0') ? 'Pending' : (($row['status_comaker'] == '1') ? 'Approved' : 'Disapproved') ?>" data-status_processor="<?= (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '0')) ? 'Pending' : ((($row['status_comaker'] == '1') &&  ($row['status_processor'] == '1')) ? 'Checked and Verified by ' . $user_name : ((($row['status_comaker'] == '1') &&  ($row['status_processor'] == '3')) ? 'Disapproved' : '')) ?>" data-status_manager="<?= (($row['status_processor'] == '1') && ($row['status_manager'] == '0')) ? 'Pending' : ((($row['status_processor'] == '1') && ($row['status_manager'] == '1')) ? 'Approved' : ((($row['status_processor'] == '1') && ($row['status_manager'] == '3')) ? 'Disapproved' : '')) ?>" data-status_cashier="<?= (($row['status_manager'] == '1') && ($row['status_cashier'] == '0')) ? 'Pending' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '1')) ? 'Approved' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '2')) ? 'Released' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '3')) ? 'Disapproved' : ''))) ?>">
            Loan Information
          </button>
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