<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) != (null))) : ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User Information</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">View Information</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row flex-lg-nowrap">
        <div class="col">
          <div class="row">
            <div class="col mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="e-profile">
                    <?php
                    $user_id = $_GET['uid'];
                    $sql = $conn->query("SELECT * FROM tbl_users WHERE user_id = $user_id");
                    while ($row = $sql->fetch_assoc()) {
                      $accountNumber = $row['accountNumber'];
                      $username = $row['username'];
                      $firstName = $row['firstName'];
                      $middleName = $row['middleName'];
                      $lastName = $row['lastName'];
                      $address = $row['address'];
                      $age = $row['age'];
                      $birthDate = $row['birthDate'];
                      $profilePhoto = $row['profilePhoto'];
                      $contactNumber = $row['contactNumber'];
                      $userCreated = $row['userCreated'];
                      $email = $row['email'];
                      $password = $row['password'];
                      $role_name = $row['role_name'];
                    ?>
                      <div class="row">
                        <div class="col-12 col-sm-auto mb-3">
                          <div class="mx-auto" style="width: 140px;">
                            <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                              <?php if ($profilePhoto == null) { ?>
                                <img src="../../assets/images/profile.png" id="photopreview" alt="User Image" style="height: 140px; width: 140px;">
                              <?php } else { ?>
                                <img src="../../assets/images/uploads/<?= $profilePhoto ?>" id="photopreview" alt="User Image" style="height: 140px; width: 140px;">
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                        <input type="text" name="user_id" value="<?= $user_id ?>" hidden>
                        <div class=" col d-flex flex-column flex-sm-row justify-content-between mb-3">
                          <div class="text-center text-sm-left mb-2 mb-sm-0">
                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $firstName . ' ' . $lastName ?></h4>
                            <p class="mb-0 text-muted"><?= $email ?></p>
                            <div class="text-muted"><small> &nbsp;</small></div>
                          </div>
                          <div class="text-center text-sm-right">
                            <span class="badge badge-secondary"><?= $row['role_name'] ?></span>
                            <div class="text-muted"><small>Joined <?= date('j M, Y', strtotime($userCreated)) ?></small></div>
                          </div>
                        </div>
                      </div>
                      <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="javascript:void(0)" class="active nav-link">Borrower Information</a></li>
                      </ul>
                      <div class="tab-content pt-3">
                        <div class="tab-pane active">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>ID Number</label>
                                    <input class="form-control" type="text" value="<?= $accountNumber ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" type="text" value="<?= $username ?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" value="<?= $firstName ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Middle Name</label>
                                    <input class="form-control" type="text" value="<?= $middleName ?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" value="<?= $lastName ?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-7">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="text" value="<?= $email ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" type="text" value="<?= $contactNumber ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" value="<?= $address ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Birth Date</label>
                                    <input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?= $birthDate ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>Age</label>
                                    <input class="form-control" type="text" value="<?= $age ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col d-flex justify-content-end">
                              <button class="btn btn-warning btn-sm" onclick="history.back()"><i class="fas fa-arrow-alt-circle-left"></i> &nbsp;Back</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>