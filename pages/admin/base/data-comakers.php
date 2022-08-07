<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th width="10%" class="text-center">#</th>
      <th>Borrower Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $query = $conn->query("SELECT * FROM tbl_comakers ORDER BY lastName ASC");
    while ($row = $query->fetch_assoc()) :
      $name = $row['lastName'] . ' ' . $row['firstName'];

    ?>
      <tr>
        <td class="text-center">
          <?= $i++; ?>
        </td>
        <td>
          <?= $name; ?>
        </td>
        <td>
          <a data-del_comaker_id="<?= $row['user_id'] ?>" class="btn btn-danger btn-xs delete_comaker"><i class="fa fa-trash"></i> Delete</a>
        </td>
      </tr>
    <?php endwhile ?>
  </tbody>
</table>