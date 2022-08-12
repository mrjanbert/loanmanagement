<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>

<script>
  function getImage(imagename) {
    var file = document.getElementById("upload").files;
    var newimage = imagename.replace(/^.*\\/, "");

    $('#photoname').val(newimage);

    if (file.length > 0) {
      var fileReader = new FileReader();

      fileReader.onload = function(e) {
        document.getElementById("photopreview").setAttribute("src", e.target.result);

      };

      fileReader.readAsDataURL(file[0]);
    }

  }
</script>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Personal Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Profile</li>
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
                  $user_id = $_SESSION['user_id'];
                  $sql = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id = $user_id");
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
                    $membership = $row['membership'];
                  ?>

                    <form class="form" enctype="multipart/form-data" autocomplete="off" id="update_client_info">
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
                            <div class="mt-2">
                              <!-- <input type="file" id="upload" onchange="readURL(this);" hidden /> -->
                              <input type="file" id="upload" name="profilePhoto" onchange="getImage(this.value);" hidden />
                              <input type="text" id="photoname" name="tmp_photo" value="<?= $profilePhoto ?>" hidden />
                              <label class="upload btn btn-primary" for="upload"><i class="fa fa-camera"></i> Change Photo</label>
                            </div>
                          </div>
                          <div class="text-center text-sm-right">
                            <span class="badge badge-secondary"><?= ($row['membership'] == '1') ? 'Member' : 'Non-member' ?></span>
                            <div class="text-muted"><small>Joined <?= date('j M, Y', strtotime($row['userCreated'])) ?></small></div>
                          </div>
                        </div>
                      </div>
                      <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="javascript:void(0)" class="active nav-link">Personal Information</a></li>
                      </ul>
                      <div class="tab-content pt-3">
                        <div class="tab-pane active">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>ID Number</label>
                                    <input class="form-control" type="text" name="accountNumber" placeholder="Enter ID number" value="<?= $accountNumber ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" type="text" name="username" placeholder="Enter username" value="<?= $username ?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="firstName" placeholder="Enter first name" value="<?= $firstName ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Middle Name</label>
                                    <input class="form-control" type="text" name="middleName" placeholder="Enter middle name" value="<?= $middleName ?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" name="lastName" placeholder="Enter last name" value="<?= $lastName ?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-7">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" placeholder="Ex.: user@nmsc.edu.ph" value="<?= $email ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" type="text" name="contactNumber" placeholder="Ex.: 09123456789" value="<?= $contactNumber ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" name="address" placeholder="Enter address" value="<?= $address ?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Birth Date</label>
                                    <input class="form-control" type="text" name="birthDate" placeholder="Enter birth date" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?= $birthDate ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>Age</label>
                                    <input class="form-control" type="text" placeholder="Age" value="<?= $age ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mt-3">
                                <b>Change Password</b>
                                <p class="text-muted">Note: If don't want to change your password, just leave it blank.</p>
                              </div>
                              <div class="row ">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Enter new password">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col d-flex justify-content-end">
                              <button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $("#update_client_info").on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        url: "../../config/update-client-info.php",
        method: "POST",
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response) {
          if (response.status == 1) {
            window.location.href = "index.php?page=profile"
          } else {
            console.log("Error");
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 5000
            })

            Toast.fire({
              icon: 'error',
              title: response.message
            })
          }
        }
      })
    })
  })
</script>