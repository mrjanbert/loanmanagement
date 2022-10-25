<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
  exit();
};
?>
<table id="example2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th width="10%" class="text-center">#</th>
      <th>Due Date</th>
      <th>Date To Notify</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $ref_no = $_GET['ref_no'];
    $query = $conn->query("SELECT n.loan_ref, n.id, n.month_date, DATE_SUB(n.month_date, INTERVAL 3 DAY) as datetonotify, t.ref_no, b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name FROM ((tbl_transaction t INNER JOIN tbl_borrowers b on t.borrower_id = b.user_id) INNER JOIN tbl_monthlynotif n on t.ref_no = n.loan_ref) WHERE n.loan_ref = '$ref_no' ORDER BY n.month_date ASC");
    // $query = $conn->query("SELECT * FROM tbl_monthlynotif WHERE loan_ref = '$ref_no' ORDER BY month_date ASC");
    while ($row = $query->fetch_assoc()) :
      $datetonotify = $row['datetonotify'];
      $duedate = $row['month_date'];
      $id = $row['id']

    ?>
      <tr>
        <td class="text-center">
          <?= $i++; ?>
        </td>
        <td>
          <?= date("F d, Y", strtotime($duedate)) ?>
        </td>
        <td>
          <?= date("F d, Y", strtotime($datetonotify)) ?>
        </td>
        <td>
          <a data-del_month_notif="<?= $id ?>" class="btn btn-danger btn-xs delete_monthly_notify"><i class="fa fa-trash"></i> Delete</a>
        </td>
      </tr>
    <?php endwhile ?>
  </tbody>
</table>