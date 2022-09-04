<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../error/404-error.php');
  exit();
};
?>
<?php if (isset($_GET['conf'])) { ?>
  <?php $conf = $_GET['conf']; ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-5">
        <div class="col-sm-6">
          <h1>Authentication</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Profile</li>
            <li class="breadcrumb-item active">Authentication</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="card" style="width: 40rem;">
          <form action="../../config/update-client.php" method="post" autocomplete="off">
            <input type="hidden" name="data_inserted" value="<?= $conf ?>">
            <div class="card-header">
              <h3 class="text-center">Authentication</h3>
              <p class="text-center">We've sent a 6-digit authentication code to your number.</p>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label for="authcode">Enter Authentication Code</label>
                <input type="text" name="code" class="form-control" id="authcode" placeholder="Enter the 6-digit code">
              </div>

              <div class="form-group">
                <div class="col-12 text-right">
                  <a href="../../config/resend-code-client.php?conf=<?= $conf ?>">Resend Code</a>
                </div>
              </div>
            </div>

            <div class="card-footer d-flex justify-content-center">
              <button type="submit" name="submit" class="btn btn-primary ">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php } ?>