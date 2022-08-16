<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) != (null))) : ?>

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
                  <?php include_once 'base/data-profile.php' ?>
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
      $("#update_admin_info").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
          url: "../../config/update-admin-info.php",
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

<?php endif; ?>