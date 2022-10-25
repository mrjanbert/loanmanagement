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
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Logs:</h3>
            </div>
            <div class="card-body">
              <table id="example3" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Mobile Number</th>
                    <!-- <th>Name</th> -->
                    <th>Message</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = $conn->query("SELECT * FROM tbl_smslogs ORDER BY date DESC");
                  $i = 1;
                  $messages = $sql->fetch_all(MYSQLI_ASSOC);

                  foreach ($messages as $message) { ?>
                    <tr>
                      <td class="text-center"><?= $i++ ?></td>
                      <td><?= $message["contactNumber"] ?></td>
                      <!-- <td><?= $message["name"] ?></td> -->
                      <td>
                        <a href="index.php?page=message&id=<?= $message['id'] ?>">
                          <?= substr($message["message"], 0, 45) . ' ...' ?>
                        </a>
                      </td>
                      <td>
                        <?= date("F d, Y  h:i A", strtotime($message["date"])) ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->

<?php endif ?>