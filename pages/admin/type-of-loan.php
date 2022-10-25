<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../error/404-error.php');
  exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) == ("Admin"))) : ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Types of Loan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Types of Loan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <form action="../../config/create-loan-type.php" method="POST" autocomplete="off" onsubmit="submitbtn.disabled = true; return true;">
              <div class="card-header">
                Loan Type Form
              </div>
              <div class="card-body">
                <input type="hidden" name="loantype_id">
                <div class="form-group">
                  <label class="control-label">Type of Loan</label>
                  <input type="text" name="loantype_name" class="form-control">
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="addloantype_btn">
                    <button class="btn btn-primary offset-md-3" type="submit" name="submitbtn"> Save</button>
                    <input type="button" class="btn btn-secondary" value="Cancel" onclick="history.go(0)" />
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Loan Type</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  $query = "SELECT * FROM tbl_loantype";
                  $results = $conn->query($query);
                  ?>
                  <?php while ($row = $results->fetch_array()) : ?>
                    <tr>
                      <td class="text-center align-middle"><?= $i++ ?></td>
                      <td>
                        <p>Type Name: <b><?= $row['loantype_name']; ?></b></p>
                      </td>
                      <td class="text-center align-middle">
                        <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteloantype" data-type_id='<?= $row['loantype_id'] ?>'><i class="fas fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- /.content -->

  <script>
    $(".deleteloantype").click(function() {
      var type_id = $(this).data('type_id');
      console.log({
        type_id
      });
      Swal.fire({
        title: 'Are you sure?',
        text: "You won\'t be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "../../config/delete-loan-type.php?type_id=" + type_id;
        }
      })
    });
  </script>
<?php endif ?>