<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
  exit();
};
?>
<table id="example3" class="table table-bordered">
  <thead>
    <tr>
      <th class="text-center">No.</th>
      <th class="text-center">Borrower</th>
      <th class="text-center">Reference Number</th>
      <th class="text-center">Amount</th>
      <th class="text-center">Loan Term</th>
      <th class="text-center">View</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $sql = "SELECT t.*, s.*, concat(b.firstName, ' ', b.lastName) as borrower_name FROM ((tbl_transaction t INNER JOIN tbl_status s on s.ref_no = t.ref_no) INNER JOIN tbl_borrowers b on b.user_id = t.borrower_id) WHERE s.status_cashier = '2'";
    $results = mysqli_query($conn, $sql);
    while ($row = $results->fetch_assoc()) {
      $ref_no = $row['ref_no'];
      $borrower_name = $row['borrower_name'];
      $amount = $row['amount'];
      $loan_term = $row['loan_term'];
    ?>
      <tr>
        <td class="text-center"><?= $i++ ?></td>
        <td><?= $borrower_name ?></td>
        <td><?= $ref_no ?></td>
        <td><?= number_format($amount, 2) ?></td>
        <td><?= $loan_term ?> Month/s</td>
        <td class="text-center">
          <a href="index.php?page=view-payments&refid=<?= $row['ref_no'] ?>" class="my-1 btn btn-warning text-white btn-xs" title="View Payments" data-toggle="tooltip" data-placement="top">
            View Payments
          </a>
        </td>
      </tr>

    <?php } ?>
  </tbody>

</table>