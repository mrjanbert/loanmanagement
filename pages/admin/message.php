<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../error/404-error.php');
  exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) != ('Unknown User'))) : ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>SMS Logs</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">SMS Logs</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Message Content</h3>
              <div class="d-flex justify-content-end">
                <button onclick="history.back()" class="btn btn-warning btn-sm">
                  <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                  Back
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="container-fluid">
                <?php
                $id = $_GET['id'];
                $query = $conn->query("SELECT * FROM tbl_smslogs WHERE id = '$id'");
                $message = $query->fetch_assoc();
                ?>
                <div class="mailbox-read-info">
                  <h5><?= $message['name'] ?></h5>
                  <h6>Mobile Number: <?= $message['contactNumber'] ?>
                    <span class="mailbox-read-time float-right"><?= date("F d, Y h:i A", strtotime($message['date'])) ?></span>
                  </h6>
                </div>
                <div class="container-fluid">
                  <div class="mailbox-read-message">
                    <p align="justify">
                      <?= $message['message'] ?>
                    </p>
                  </div>
                </div>
                <!-- /.mailbox-read-message -->
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->

<?php endif ?>