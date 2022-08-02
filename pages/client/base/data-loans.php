<thead>
  <tr>
    <th class="text-center">#</th>
    <th class="text-center">Reference No.</th>
    <th class="text-center">Principal Amount</th>
    <th class="text-center">Loan Date</th>
    <th class="text-center">Comaker's Status</th>
    <th class="text-center">CC Member's Status</th>
    <th class="text-center">Manager's Status</th>
    <th class="text-center">Cashier's Status</th>
    <th class="text-center">View</th>
  </tr>
</thead>
<tbody>
  <?php
  $i = 1;
  $user_id = $_SESSION['user_id'];
  $query = $conn->query("SELECT t.*,  s.*, concat(c.firstName,' ', c.lastName) as comaker_name, concat(u.firstName,' ', u.lastName) as user_name, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name
    FROM ((((tbl_transaction t 
      INNER JOIN tbl_status s ON t.ref_no = s.ref_no)
      LEFT JOIN tbl_users u ON s.processor_id = u.user_id) 
      INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id)
      INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) 
    WHERE t.borrower_id = $user_id ORDER BY id DESC");
  while ($row = $query->fetch_assoc()) :
    $comaker_date = $row['comaker_dateprocess'];
    $processor_date = $row['processor_dateprocess'];
    $manager_date = $row['manager_dateprocess'];
    $cashier_date = $row['cashier_dateprocess'];
  ?>
    <tr>
      <td class="text-center"><?= $i++; ?></td>
      <td><?= $row['ref_no']; ?></td>
      <td><b style="color: blue"><?= number_format($row['amount'], 2); ?></b></td>
      <td><?= date('F j, Y', strtotime($row['loan_date'])); ?></td>
      <td class="text-center">
        <?php if ($row['status_comaker'] == 0) : ?>
          <button type="button" style="pointer-events:none" class="btn btn-warning btn-sm btn-block text-white">Pending</button>
        <?php elseif ($row['status_comaker'] == 1) : ?>
          <button type="button" style="pointer-events:none" class="btn btn-success btn-sm btn-block">Approved</button>
        <?php elseif ($row['status_comaker'] == 2) : ?>
          <button type="button" style="pointer-events:none" class="btn btn-danger btn-block btn-sm btn-block">Disapproved</button>
        <?php endif; ?>
      </td>

      <?php if (($row['status_comaker'] == 1) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-warning btn-sm btn-block text-white">Pending</button>
        </td>
        <td class="text-center"></td>
        <td class="text-center"></td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-warning btn-sm btn-block text-white">Pending</button>
        </td>
        <td class="text-center"></td>

      <?php elseif (($row['status_comaker'] == 2) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
        <td class="text-center"></td>
        <td class="text-center"></td>
        <td class="text-center"></td>

      <?php elseif (($row['status_comaker'] == 0) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
        <td class="text-center"></td>
        <td class="text-center"></td>
        <td class="text-center"></td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 3) && ($row['status_cashier'] == 0)) : ?>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-danger btn-sm btn-block">Disapproved</button>
        </td>
        <td class="text-center"></td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 0)) : ?>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-warning btn-sm btn-block text-white">Pending</button>
        </td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 1)) : ?>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
        </td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 2)) : ?>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-success btn-sm btn-block">Released</button>
        </td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 3)) : ?>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
        </td>
        <td class="text-center">
          <button type="button" style="pointer-events:none" class="btn btn-info btn-sm btn-block">Disapproved</button>
        </td>
      <?php endif; ?>

      <td class="text-center">
        <a href="index.php?page=grace-period&ref_no=<?= $row['ref_no'] ?>" class="my-1 btn btn-primary btn-block btn-sm" title="View Grace Period" data-toggle="tooltip" data-placement="top">
          <i class="fas fa-calendar-alt"></i>&nbsp;
          Grace Period
        </a>
        <a href="index.php?page=application-form&ref_no=<?= $row['ref_no'] ?>" class="my-1 btn btn-success btn-block btn-sm" title="View Application Form" data-toggle="tooltip" data-placement="top">
          <i class="fa fa-print"></i>&nbsp; Application Form
        </a>
        <button class="my-1 btn btn-info btn-sm btn-block viewloan" data-toggle="modal" data-target="#viewloan" data-borrower_name="<?= $row['borrower_name'] ?>" data-ref_no="<?= $row['ref_no'] ?>" data-loan_amount="<?= number_format($row['amount'], 2) ?>" data-loan_terms="<?= $row['loan_term'] ?> Months" data-comaker_date="<?= ($comaker_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($comaker_date)) : '' ?>" data-processor_date="<?= ($processor_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($processor_date)) : '' ?>" data-manager_date="<?= ($manager_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($manager_date)) : '' ?>" data-cashier_date="<?= ($cashier_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($cashier_date)) : '' ?>" data-loan_type="<?= $row['loan_type'] ?>" data-loan_date="<?= date('M j, Y - g:i A', strtotime($row['loan_date'])) ?>" data-purpose="<?= $row['purpose'] ?>" data-comaker_name="<?= $row['comaker_name'] ?>" data-status_comaker="<?= ($row['status_comaker'] == '0') ? 'Pending' : (($row['status_comaker'] == '1') ? 'Approved' : 'Disapproved') ?>" data-status_processor="<?= (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '0')) ? 'Pending' : ((($row['status_comaker'] == '1') &&  ($row['status_processor'] == '1')) ? 'Checked and Verified by ' . $row['user_name'] : ((($row['status_comaker'] == '1') &&  ($row['status_processor'] == '3')) ? 'Disapproved' : '')) ?>" data-status_manager="<?= (($row['status_processor'] == '1') && ($row['status_manager'] == '0')) ? 'Pending' : ((($row['status_processor'] == '1') && ($row['status_manager'] == '1')) ? 'Approved' : ((($row['status_processor'] == '1') && ($row['status_manager'] == '3')) ? 'Disapproved' : '')) ?>" data-status_cashier="<?= (($row['status_manager'] == '1') && ($row['status_cashier'] == '0')) ? 'Pending' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '1')) ? 'Approved' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '2')) ? 'Released' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '3')) ? 'Disapproved' : ''))) ?>">
          <i class="fa fa-eye"></i>&nbsp;
          View Loan
        </button>
        <?php if (($row['status_cashier'] == '1') || ($row['status_cashier'] == '2')) { ?>
          <a href="index.php?page=view-payments&ref_no=<?= $row['ref_no'] ?>" class="my-1 btn btn-warning text-white btn-block btn-sm" title="View Payments" data-toggle="tooltip" data-placement="top">
            <i class="fa fa-print"></i>&nbsp; View Payments
          </a>
        <?php } ?>

      </td>
    </tr>
  <?php endwhile; ?>
</tbody>