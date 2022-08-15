<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
<table id="example2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Employee ID</th>
      <th>Borrower Name</th>
      <th>Address</th>
      <th>Contact No.</th>
      <th>Email Address</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $query = "SELECT * FROM tbl_users WHERE is_archived = '0' ";
    $results = $conn->query($query);
    ?>
    <?php while ($row = $results->fetch_assoc()) : $user_id = $row['user_id']; ?>

      <tr>
        <td class="text-center"><?= $i++; ?></td>
        <td><?= $row['accountNumber']; ?></td>
        <td><?= $row['lastName'] . ', ' . $row['firstName'] . ' ' . $row['middleName']; ?> </td>
        <td><?= $row['address']; ?></td>
        <td><?= $row['contactNumber']; ?></td>
        <td><?= $row['email']; ?></td>
        <td>
          <a href="javascript:void(0);" class="btn btn-danger btn-xs delete_user" data-del_user_id="<?= $user_id ?>"><i class="fas fa-trash"></i> Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>