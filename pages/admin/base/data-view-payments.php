<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
  exit();
};
?>
<table id="example2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th width="15%" class="text-center">Date</th>
      <th width="15%" class="text-center">Principal</th>
      <th class="text-center">Interest</th>
      <th class="text-center">Penalty</th>
      <th class="text-center">OR #</th>
      <th class="text-center">Payment</th>
      <th class="text-center">Balance</th>
      <!-- <th class="text-center">Action</th> -->
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
      <!-- <td></td> -->
    </tr>
    <?php
    $query = $conn->query("SELECT id, payment_date, interest, operation_of_interest, penalty, receipt_no, payment_amount, payment_balance FROM tbl_payments WHERE ref_no = '$ref_no' ORDER BY id ASC");
    while ($row = $query->fetch_assoc()) {
      $id = $row['id'];
      $interest = $row['interest'];
      $penalty = $row['penalty'];
      $operation_of_interest = $row['operation_of_interest'];
      $receipt_no = $row['receipt_no'];
      $payment_amount = $row['payment_amount'];
      $payment_balance = $row['payment_balance'];
      $payment_date = $row['payment_date'];
    ?>
      <tr>
        <td><?= date('M j, Y', strtotime($payment_date)) ?></td>
        <td></td>
        <td><?= ($interest != 0) ? (($operation_of_interest == 'add') ? '+ ' : '- ') . number_format($interest, 2) : ''; ?></td>
        <td><?= ($penalty != 0) ? number_format($penalty, 2) : ''; ?></td>
        <td><?= $receipt_no ?></td>
        <td><?= ($payment_amount != 0) ? number_format($payment_amount, 2) : ''; ?></td>
        <td><?= number_format($payment_balance, 2) ?></td>
        <!-- <td class="text-center">
          <a class="btn btn-primary btn-xs my-1 edit_payment" data-id="<?= $id ?>" data-interest="<?= ($interest != 0) ? number_format($interest, 2) : ''; ?>" data-penalty="<?= ($penalty != 0) ? number_format($penalty, 2) : ''; ?>" data-receipt_no="<?= $receipt_no ?>" data-payment_amount="<?= number_format($payment_amount, 2) ?>" data-payment_date="<?= $payment_date ?>" data-toggle="modal" data-target="#edit_payment" href="javascript:void(0)">
            <i class="fas fa-edit"></i> Edit
          </a>
        </td> -->
      </tr>
    <?php } ?>
  </tbody>
</table>