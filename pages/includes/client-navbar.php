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
          <a href="../client/index.php?page=profile" class="dropdown-item">
            <i class="fas fa-user-alt mr-2"></i> Profile
          </a>
        <?php } ?>
        <a href="javascript:void(0)" class="dropdown-item" onclick="logout()">
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
