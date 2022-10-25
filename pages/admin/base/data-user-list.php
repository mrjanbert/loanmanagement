<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
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
    $query = "SELECT * FROM tbl_users";
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
        <td class="text-center">
          <a href="index.php?page=user-info&uid=<?= $row['user_id'] ?>" class="btn btn-info btn-xs my-1">View Information</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>