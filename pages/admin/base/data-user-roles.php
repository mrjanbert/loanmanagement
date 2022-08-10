<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
<table id="example2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>User Name</th>
      <th>Role</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $user_id = $_SESSION['adminuser_id'];
    $query = "SELECT * FROM tbl_users WHERE user_id != $user_id AND role_name != ''";
    $results = $conn->query($query);
    while ($row = $results->fetch_assoc()) :
      $name = $row['lastName'] . ', ' . $row['firstName'] . ' ' . $row['middleName'][0] . '.';
      $role = $row['role_name'];
    ?>
      <tr>
        <td><?= $name; ?> </td>
        <td><?= $role; ?> </td>
        <td>
          <a data-perm_user_id="<?= $row['user_id'] ?>" class="btn btn-danger btn-sm delete_role"><i class="fa fa-trash"></i> Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>