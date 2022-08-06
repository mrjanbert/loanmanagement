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
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li> -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user fa-lg"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php
        $user_id = $_SESSION['adminuser_id'];
        $sql = "SELECT * FROM tbl_users WHERE user_id = $user_id";
        $result = $conn->query($sql);

        while ($row = $result->fetch_array()) {
        ?>
          <span class="dropdown-header"><?= $row['role_name'] ?></span>
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
        window.location.href = '../../config/logout.php?logout_id=admin'
      }
    })
  }
</script>



<?php
$user_id = $_SESSION['adminuser_id'];
$sql = "SELECT * FROM tbl_users WHERE user_id = $user_id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
?>
  <div class="modal fade" id="view_user">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
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
                  <img src="../../assets/dist/img/profile.png" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                <?php } else { ?>
                  <img src="../../components/img/uploads/<?= $row['profilePhoto']; ?>" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                <?php } ?>
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div class="form-group">
                <label>Account Number:</label>
                <input type="text" id="side_idnumber" value="<?= $row['accountNumber']; ?>" class="form-control form-control-border text-center">
              </div>
              <div class="form-group">
                <label>Full Name:</label>
                <input type="text" id="side_name" value="<?= $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] ?>" class="form-control form-control-border text-center">
              </div>
              <div class="form-group">
                <label>Email:</label>
                <input type="text" id="side_email" value="<?= $row['email']; ?>" class="form-control form-control-border text-center">
              </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="form-group">
                <label>Birth Date:</label>
                <input type="text" id="side_birthdate" value="<?= date('F j, Y', strtotime($row['birthDate'])); ?>" class="form-control form-control-border text-center">
              </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" id="side_contactnumber" value="<?= $row['contactNumber']; ?>" class="form-control form-control-border text-center">
              </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="form-group">
                <label>User Role:</label>
                <input type="text" id="side_rolename" value="<?= $row['role_name']; ?>" class="form-control form-control-border text-center">
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div class="form-group">
                <label>Address:</label>
                <input type="text" id="side_address" value="<?= $row['address']; ?>" class="form-control form-control-border text-center">
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div class="form-group">
                <label>Date Registered:</label>
                <input type="text" id="side_usercreated" value="<?= date('F j, Y', strtotime($row['userCreated'])); ?>" class="form-control form-control-border text-center">
              </div>
            </div>
          </div>
        </div>
        <?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) == ("Admin")) || (trim($_SESSION['role_name']) == ("Manager")) || (trim($_SESSION['role_name']) == ("Processor")) || (trim($_SESSION['role_name']) == ("Cashier"))) : ?>
          <div class="modal-footer justify-content-end">
            <button class="btn btn-secondary" id="cancel_btn" data-dismiss="modal" data-side_idnumber="<?= $row['accountNumber'] ?>" data-side_name="<?= $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] ?>" data-side_email="<?= $row['email'] ?>" data-side_birthdate="<?= date('F j, Y', strtotime($row['birthDate'])) ?>" data-side_contactnumber="<?= $row['contactNumber'] ?>" data-side_rolename="<?= $row['role_name'] ?>" data-side_address="<?= $row['address'] ?>" data-side_usercreated="<?= date('F j, Y', strtotime($row['userCreated'])) ?>">Cancel</button>
            <a href='javascript:void(0);' class="btn btn-primary save_info">Save</a>
          </div>
        <?php endif ?>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


<?php } ?>

<script>
  $(document).ready(function() {
    $("#cancel_btn").click(function() {
      $('#side_idnumber').val($(this).data('side_idnumber'));
      $('#side_name').val($(this).data('side_name'));
      $('#side_email').val($(this).data('side_email'));
      $('#side_birthdate').val($(this).data('side_birthdate'));
      $('#side_contactnumber').val($(this).data('side_contactnumber'));
      $('#side_rolename').val($(this).data('side_rolename'));
      $('#side_address').val($(this).data('side_address'));
      $('#side_usercreated').val($(this).data('side_usercreated'));
    });
  });
</script>