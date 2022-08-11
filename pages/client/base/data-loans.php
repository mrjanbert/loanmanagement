<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
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
    <tr class="text-center">
      <td><?= $i++; ?></td>
      <td><?= $row['ref_no']; ?></td>
      <td><b style="color: blue"><?= number_format($row['amount'], 2); ?></b></td>
      <td><?= date('F j, Y', strtotime($row['loan_date'])); ?></td>
      <td>
        <?php if ($row['status_comaker'] == 0) : ?>
          <button type="button" style="pointer-events:none" class="btn btn-warning btn-xs text-white">Pending</button>
        <?php elseif ($row['status_comaker'] == 1) : ?>
          <button type="button" style="pointer-events:none" class="btn btn-success btn-xs">Approved</button>
        <?php elseif ($row['status_comaker'] == 2) : ?>
          <button type="button" style="pointer-events:none" class="btn btn-danger btn-xs">Disapproved</button>
        <?php endif; ?>
      </td>

      <?php if (($row['status_comaker'] == 1) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-warning btn-xs text-white">Pending</button>
        </td>
        <td></td>
        <td></td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Checked and Verified</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-warning btn-xs text-white">Pending</button>
        </td>
        <td></td>

      <?php elseif (($row['status_comaker'] == 2) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
        <td></td>
        <td></td>
        <td></td>

      <?php elseif (($row['status_comaker'] == 0) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
        <td></td>
        <td></td>
        <td></td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 3) && ($row['status_cashier'] == 0)) : ?>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Checked and Verified</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-danger btn-xs">Disapproved</button>
        </td>
        <td></td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 0)) : ?>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Checked and Verified</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Approved</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-warning btn-xs text-white">Pending</button>
        </td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 1)) : ?>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Checked and Verified</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Approved</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Approved</button>
        </td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 2)) : ?>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Checked and Verified</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Approved</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-success btn-xs">Released</button>
        </td>

      <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 3)) : ?>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Checked and Verified</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-primary btn-xs">Approved</button>
        </td>
        <td>
          <button type="button" style="pointer-events:none" class="btn btn-info btn-xs">Disapproved</button>
        </td>
      <?php endif; ?>

      <td>
        <a href="index.php?page=grace-period&ref_no=<?= $row['ref_no'] ?>" class="my-1 btn btn-primary btn-xs" title="View Grace Period" data-toggle="tooltip" data-placement="top">
          Grace Period
        </a>
        <a href="app-form.php?ref_no=<?= $row['ref_no'] ?>" target="_blank" class="btn btn-success my-1 btn-xs">
          Application Form
        </a>
        <a class="btn btn-info btn-xs my-1" href="index.php?page=loan-information&ref_no=<?= $row['ref_no'] ?>">
          Loan Information
        </a>
        <?php if (($row['status_cashier'] == '1') || ($row['status_cashier'] == '2')) { ?>
          <a href="index.php?page=view-payments&ref_no=<?= $row['ref_no'] ?>" class="my-1 btn btn-warning text-white btn-xs" title="View Payments" data-toggle="tooltip" data-placement="top">
            View Payments
          </a>
        <?php } ?>

      </td>
    </tr>
  <?php endwhile; ?>
</tbody>