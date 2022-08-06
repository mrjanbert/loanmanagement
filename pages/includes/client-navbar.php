<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/403-error.php');
  exit();
};
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../../index.php" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user fa-lg"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM tbl_borrowers WHERE user_id = $user_id";
        $result = $conn->query($sql);

        while ($row = $result->fetch_array()) {
        ?>
          <span class="dropdown-header"><?= ($row['membership'] == 1) ? 'Member User' : 'Non-member User' ?></span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#view_user">
            <i class="fas fa-user-alt mr-2"></i> Profile
          </a>
        <?php } ?>
        <a href="#" class="dropdown-item" onclick="logout()">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<script>
  function logout() {
    Swal.fire({
      title: 'Logout',
      text: "Are you sure you want to logout?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Logout'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '../../config/logout.php?logout_id=client'
      }
    })
  }
</script>


<div class="modal fade" id="view_user">
  <div class="modal-dialog modal-lg">
    <form action="../../config/update-info.php" method="POST">
      <div class="modal-content">
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id = $user_id");
        while ($row = $sql->fetch_assoc()) :
        ?>
          <div class="modal-header">
            <h4 class="modal-title">Personal Information of <?= $row['firstName'] . ' ' . $row['lastName']; ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 d-flex justify-content-center">
                <div class="image">
                  <?php if ($_SESSION['profilePhoto'] == null) { ?>
                    <img src="../../assets/images/profile.png" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                  <?php } else { ?>
                    <img src="../../assets/images/uploads/<?= $row['profilePhoto'] ?>" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                  <?php } ?>
                </div>
              </div>
              <div class="col-md-6 text-center">
                <div class="form-group">
                  <label>Account Number:</label>
                  <input type="text" id="side_idnumber" value="<?= $row['accountNumber']; ?>" class="form-control form-control-border text-center" readonly>
                </div>
                <div class="form-group">
                  <label>Full Name:</label>
                  <input type="text" id="side_name" value="<?= $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] ?>" class="form-control form-control-border text-center" readonly>
                </div>
                <div class="form-group">
                  <label>Email:</label>
                  <input type="text" id="side_email" value="<?= $row['email']; ?>" class="form-control form-control-border text-center" readonly>
                </div>
              </div>
              <div class="col-md-4 text-center">
                <div class="form-group">
                  <label>Birth Date:</label>
                  <input type="text" id="side_birthdate" value="<?= date('F j, Y', strtotime($row['birthDate'])); ?>" class="form-control form-control-border text-center" readonly>
                </div>
              </div>
              <div class="col-md-4 text-center">
                <div class="form-group">
                  <label>Membership Status:</label>
                  <input type="text" id="side_membership" value="<?= ($row['membership'] == 1) ? 'Member' : 'Non-member'; ?>" class="form-control form-control-border text-center" readonly>
                </div>
              </div>
              <div class="col-md-4 text-center">
                <div class="form-group">
                  <label>Date Registered:</label>
                  <input type="text" id="side_usercreated" value="<?= date('F j, Y', strtotime($row['userCreated'])); ?>" class="form-control form-control-border text-center" readonly>
                </div>
              </div>
              <div class="col-md-4 text-center">
                <div class="form-group">
                  <label>Contact Number:</label>
                  <input type="text" id="side_contactnumber" name="contactNumber" value="<?= $row['contactNumber']; ?>" class="form-control form-control-border text-center">
                </div>
              </div>
              <div class="col-md-4 text-center">
                <div class="form-group">
                  <label>Username:</label>
                  <input type="text" id="side_username" name="username" value="<?= $row['username']; ?>" class="form-control form-control-border text-center">
                </div>
              </div>
              <div class="col-md-4 text-center">
                <div class="form-group">
                  <label>Address:</label>
                  <input type="text" id="side_address" name="address" value="<?= $row['address']; ?>" class="form-control form-control-border text-center">
                </div>
              </div>
              <input type="text" name="borrower_id" value="<?= $row['user_id'] ?>" hidden>
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <button class="btn btn-secondary" id="cancel_btn" data-dismiss="modal" data-side_contactnumber="<?= $row['contactNumber'] ?>" data-side_address="<?= $row['address'] ?>" data-side_username="<?= $row['username'] ?>">
              Cancel
            </button>
            <button type="submit" class="btn btn-primary" name="update_info">Save</button>
          </div>
        <?php endwhile ?>
      </div>
    </form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<script>
  $(document).ready(function() {
    $("#cancel_btn").click(function() {
      $('#side_contactnumber').val($(this).data('side_contactnumber'));
      $('#side_username').val($(this).data('side_username'));
      $('#side_address').val($(this).data('side_address'));

      $('#addloan').modal('hide');
    });
  });
</script>