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
        <td class="text-center"><?php echo $i++; ?></td>
        <td><?php echo $row['accountNumber']; ?></td>
        <td><?php echo $row['lastName'] . ', ' . $row['firstName'] . ' ' . $row['middleName'][0] . '.'; ?> </td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['contactNumber']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td>
          <a href="javascript:void(0);" class="btn btn-danger btn-xs delete_user" data-del_user_id="<?= $row['user_id'] ?>"><i class="fas fa-trash"></i> Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>