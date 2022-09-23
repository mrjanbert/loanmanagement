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
      <th class="text-center">Date</th>
      <th class="text-center">Description</th>
      <th class="text-center">Deposit</th>
      <th class="text-center">Withdrawal</th>
      <th class="text-center">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      $borrower_id = $_SESSION['user_id'];
      $query = $conn->query("SELECT * FROM tbl_sharecapital WHERE borrower_id = '$borrower_id' ORDER BY id ASC");
      while($row = $query->fetch_assoc()) {
        $date = $row['date'];
        $description = $row['description'];
        $deposit = $row['deposit'];
        $withdrawal = $row['withdrawal'];
        $balance = $row['balance'];
    ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= date('M j, Y', strtotime($date)) ?></td>
        <td><?= $description ?></td>
        <td><?= ($deposit != 0) ? '+ ' . number_format($deposit, 2) : ''; ?></td>
        <td><?= ($withdrawal != 0) ? '- ' . number_format($withdrawal, 2) : ''; ?></td>
        <td><?= number_format($balance, 2) ?></td>
      </tr>
      <?php } ?>
  </tbody>
</table>