<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
<table id="example3" class="table table-bordered">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th class="text-center">Employee ID</th>
      <th class="text-center">Borrower Name</th>
      <th class="text-center">Date Registered</th>
      <th class="text-center">Membership Status</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $query = $conn->query("SELECT * FROM tbl_borrowers order by firstName asc");
    while ($row = $query->fetch_assoc()) :
      $userCreated = strtotime($row['userCreated']);
      $birthDate = strtotime($row['birthDate']);
      $name = $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'];
      $accountNumber = $row['accountNumber'];
    ?>
      <tr>
        <td class="text-center"><?= $i++; ?></td>
        <td><?= $row['accountNumber']; ?></td>
        <td><?= $name ?> </td>
        <td><?= date('F j, Y', $userCreated); ?></td>
        <td><?php if ($row['membership'] == 1) {
              echo 'Member';
            } else {
              echo 'Non-member';
            }
            ?></td>
        <td class="text-center">
          <a href="index.php?page=borrower-info&uid=<?= $row['user_id'] ?>" class="btn btn-info btn-xs my-1">View Information</a>
          <a href="index.php?page=view-loans&uid=<?= $row['user_id'] ?>" class="btn btn-primary btn-xs my-1">View Loans</a>

          <!-- Action for Admin only -->
          <?php if (isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Admin')) {  ?>
            <button class="btn btn-danger btn-xs" onclick="delete_borrower()" data-del_borrowerid="<?= $row['user_id'] ?>">
              <i class="fas fa-trash mr-1"></i>
              Delete
            </button>
          <?php } else {
            '';
          } ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>