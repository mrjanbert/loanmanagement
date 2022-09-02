<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
  exit();
};
?>
<table id="example3" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th width="15%" class="text-center">Date</th>
      <th width="15%" class="text-center">Principal</th>
      <th class="text-center">Interest</th>
      <th class="text-center">Penalty</th>
      <th class="text-center">OR #</th>
      <th class="text-center">Payment</th>
      <th class="text-center">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ref_no = $_GET['refid'];
    $sql = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = '$ref_no  '");
    $row = $sql->fetch_assoc()
    ?>
    <tr>
      <td>
        <strong><?= date('M j, Y', strtotime($row['loan_date'])) ?></strong>
      </td>
      <td>
        <strong><?= number_format($row['amount'], 2) ?></strong>
      </td>
      <td>
        <strong><?= number_format($row['total_interest'], 2) ?></strong>
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td>
        <strong><?= number_format($row['balance'], 2) ?></strong>
      </td>
    </tr>
    <?php
    $query = $conn->query("SELECT p.payment_date, t.interest, p.penalty, p.receipt_no, p.payment_amount, p.payment_balance FROM tbl_payments p INNER JOIN tbl_transaction t ON t.ref_no = p.ref_no WHERE p.ref_no = '$ref_no' ORDER BY p.id ASC");
    while ($row = $query->fetch_assoc()) {
    ?>
      <tr>
        <td><?= date('M j, Y', strtotime($row['payment_date'])) ?></td>
        <td></td>
        <td></td>
        <td><?= ($row['penalty'] != 0) ? number_format($row['penalty'], 2) : ''; ?></td>
        <td><?= $row['receipt_no']; ?></td>
        <td><?= ($row['payment_amount'] != 0) ? number_format($row['payment_amount'], 2) : ''; ?></td>
        <td><?= number_format($row['payment_balance'], 2) ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>