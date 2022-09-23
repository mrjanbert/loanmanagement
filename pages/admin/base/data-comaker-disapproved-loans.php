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
      <th class="text-center">Borrower</th>
      <th class="text-center">Comaker</th>
      <th class="text-center">Type of Loan</th>
      <th class="text-center">Principal Amount</th>
      <th class="text-center">View</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $sql = $conn->query("SELECT t.*, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name, s.*, concat(c.firstname, ' ', c.lastName) as comaker_name
    FROM (((tbl_transaction t 
      INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) 
      INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id) 
      INNER JOIN tbl_status s ON t.status_ref = s.ref_no) WHERE s.status_comaker = '2'");
    while ($row = $sql->fetch_assoc()) {
      $ref_no = $row['ref_no'];
      $borrower_id = $row['borrower_id'];
      $comaker_id = $row['comaker_id'];
      $borrower_name = $row['borrower_name'];
      $comaker_name = $row['comaker_name'];
      $loan_type = $row['loan_type'];
      $loan_type = $row['loan_type'];
      $amount = $row['amount'];
    ?>
      <tr>
        <td class="text-center"><?= $i++ ?></td>
        <td class="text-center"><?= $ref_no ?></td>
        <td><?= $borrower_name ?></td>
        <td><?= ($comaker_id == $borrower_id) ? '' : $comaker_name ?></td>
        <td><?= $loan_type ?></td>
        <td class="text-center"><?= number_format($amount, 2) ?></td>
        <td class="text-center">
          <a class="btn btn-info btn-xs my-1" href="index.php?page=view-dashboard-loan-information&ref_no=<?= $ref_no ?>">
            Loan Information
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>