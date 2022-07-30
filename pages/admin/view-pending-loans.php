<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pending Loans</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Pending Loans</li>
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
            <h2 class="card-title">Pending Loan Transactions</h2>
            <div class="d-flex justify-content-end">
              <button onclick="history.back()" class="btn btn-warning btn-sm">
                <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                Back
              </button>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Reference No.</th>
                  <th class="text-center">Borrower Name</th>
                  <th class="text-center">Type of Loan</th>
                  <th class="text-center">Principal Amount</th>
                  <?php if (isset($_SESSION['role_name']) && ($_SESSION['role_name'] == null) || $_SESSION['role_name'] == 'Admin') {
                    '';
                  } else { ?>
                    <th class="text-center">Status</th>
                  <?php } ?>
                  <th class="text-center">View</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $i = 1;
                $role_name = $_SESSION['role_name'];
                $query = $conn->query("SELECT t.*, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name, s.*, concat(c.firstname, ' ', c.lastName) as comaker_name
                FROM (((tbl_transaction t 
                  INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) 
                  INNER JOIN tbl_status s ON t.status_ref = s.ref_no) 
                  INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id)
                WHERE status_processor = '0' OR status_manager = '0' OR status_cashier = '0' OR status_comaker = '0'");
                while ($row = $query->fetch_assoc()) :
                  $ref_no = $row['ref_no'];
                  $borrower_name = $row['borrower_name'];
                  $loan_type = $row['loan_type'];
                  $purpose = $row['purpose'];
                  $loan_term = $row['loan_term'];
                  $loan_date = strtotime($row['loan_date']);
                  $amount = $row['amount'];
                  $comaker_name = $row['comaker_name'];
                  $status_comaker = $row['status_comaker'];
                  $status_manager = $row['status_manager'];
                  $status_processor = $row['status_processor'];
                  $status_cashier = $row['status_cashier'];
                ?>

                  <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td><?= $ref_no; ?></td>
                    <td><?= $borrower_name; ?></td>
                    <td><?= $loan_type; ?></td>
                    <td><b style="color: blue"><?= number_format($amount, 2); ?></b></td>

                    <?php if (isset($role_name) && ($role_name == 'Manager')) {  ?>
                        <td class="text-center">
                          <?php if ($status_manager == 0) : ?>
                            <button type="button" class="btn btn-warning btn-sm my-1 btn-block text-white" style="pointer-events: none">Pending</button>
                          <?php elseif ($status_manager == 1) : ?>
                            <button type="button" class="btn btn-primary btn-sm my-1 btn-block" style="pointer-events: none">Approved</button>
                          <?php elseif ($status_manager == 3) : ?>
                            <button type="button" class="btn btn-danger btn-sm my-1 btn-block" style="pointer-events: none">Disapproved</button>
                          <?php endif; ?>
                        </td>

                    <?php } elseif (isset($role_name) && ($role_name == 'Processor')) {  ?>
                      <?php if ($status_comaker == 1) : ?>
                        <td class="text-center">
                          <?php if ($status_processor == 0) : ?>
                            <button type="button" class="btn btn-warning btn-sm my-1 btn-block text-white" style="pointer-events: none">Pending</button>
                          <?php endif; ?>
                        </td>
                      <?php elseif ($status_comaker == 0) : ?>
                        <td class="text-center">
                          <button type="button" class="btn btn-info btn-sm my-1 btn-block" style="pointer-events: none">Waiting for Co-maker's Approval</button>
                        </td>
                      <?php else : ?>
                        <td class="text-center">
                          <button type="button" class="btn btn-danger btn-sm my-1 btn-block" style="pointer-events: none">Disapproved by Co-maker</button>
                        </td>
                      <?php endif ?>

                    <?php } elseif (isset($role_name) && ($role_name == 'Cashier')) {  ?>
                      <?php if ($status_manager == 1) : ?>
                        <td class="text-center">
                          <?php if ($status_cashier == 0) : ?>
                            <button type="button" class="btn btn-warning btn-sm my-1 btn-block text-white" style="pointer-events: none">Pending</button>
                          <?php elseif ($status_cashier == 1) : ?>
                            <button type="button" class="btn btn-primary btn-sm my-1 btn-block" style="pointer-events: none">Approved</button>
                          <?php elseif ($status_cashier == 2) : ?>
                            <button type="button" class="btn btn-success btn-sm my-1 btn-block" style="pointer-events: none">Released</button>
                          <?php elseif ($status_cashier == 3) : ?>
                            <button type="button" class="btn btn-danger btn-sm my-1 btn-block" style="pointer-events: none">Disapproved</button>
                          <?php endif; ?>
                        </td>
                      <?php elseif ($status_manager == 3) : ?>
                        <td class="text-center">
                          <button type="button" class="btn btn-danger btn-sm my-1 btn-block" style="pointer-events: none">Approved by: CC Member <br />Disapproved by: Manager</button>
                        </td>
                      <?php elseif (($status_manager == 0) && ($status_processor == 1)) : ?>
                        <td class="text-center">
                          <button type="button" class="btn btn-info btn-sm my-1 btn-block" style="pointer-events: none">Waiting for Manager's Approval</button>
                        </td>
                      <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 1)) : ?>
                        <td class="text-center">
                          <button type="button" class="btn btn-info btn-sm my-1 btn-block" style="pointer-events: none">Waiting for CC Member's Approval</button>
                        </td>
                      <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 0)) : ?>
                        <td class="text-center">
                          <button type="button" class="btn btn-info btn-sm my-1 btn-block" style="pointer-events: none">Waiting for Co-maker's Approval</button>
                        </td>
                      <?php else : ?>
                        <td class="text-center">
                          <button type="button" class="btn btn-danger btn-sm my-1 btn-block" style="pointer-events: none">Disapproved by Co-maker</button>
                        </td>
                      <?php endif ?>
                    <?php } else {
                      '';
                    } ?>

                    <td class="text-center">
                      <button class="btn btn-info btn-sm btn-block my-1 viewloan" data-toggle="modal" data-target="#viewloan" data-borrower_name="<?= $borrower_name ?>" data-ref_no="<?= $ref_no ?>" data-viewloan_amount="<?= number_format($amount, 2) ?>" data-viewloan_term="<?= $loan_term ?> Months" data-viewloan_type="<?= $loan_type ?>" data-loan_date="<?= date('M j, Y - g:i A', strtotime($loan_date)) ?>" data-purpose="<?= $purpose ?>" data-comaker_name="<?= $comaker_name ?>" data-status_comaker=" <?php if ($row['status_comaker'] == '0') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          echo 'Pending';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($row['status_comaker'] == '1') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          echo 'Approved';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($row['status_comaker'] == '2') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          echo 'Disapproved';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } ?>" data-status_processor=" <?php if (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '0')) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo 'Pending';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } elseif (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '1')) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo 'Checked and Verified';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } elseif (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '3')) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo 'Disapproved';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo '';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>" data-status_manager=" <?php if (($row['status_processor'] == '1') && ($row['status_manager'] == '0')) {
                                                                                                        echo 'Pending';
                                                                                                      } elseif (($row['status_processor'] == '1') && ($row['status_manager'] == '1')) {
                                                                                                        echo 'Approved';
                                                                                                      } elseif (($row['status_processor'] == '1') && ($row['status_manager'] == '3')) {
                                                                                                        echo 'Disapproved';
                                                                                                      } else {
                                                                                                        echo '';
                                                                                                      } ?>" data-status_cashier=" <?php
                                                                                                    if (($row['status_manager'] == '1') && ($row['status_cashier'] == '0')) {
                                                                                                      echo 'Pending';
                                                                                                    } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '1')) {
                                                                                                      echo 'Approved';
                                                                                                    } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '2')) {
                                                                                                      echo 'Released';
                                                                                                    } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '3')) {
                                                                                                      echo 'Disapproved';
                                                                                                    } else {
                                                                                                      echo '';
                                                                                                    } ?>">
                        <i class="fa fa-eye"></i>&nbsp;
                        Loan Information
                      </button>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section><!-- /.content -->


<div class="modal fade" id="viewloan">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content card-outline card-primary">
      <div class="modal-header">
        <h4 class="modal-title">Loan Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <div class="row text-center">
          <div class="col-md-12">
            <div class="form-group">
              <label>Borrower Name</label>
              <input type="text" id="borrower_name" class="form-control form-control-border text-center" readonly>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Reference Number</label>
              <input type="text" id="ref_no" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Loan Amount</label>
              <input type="text" id="viewloan_amount" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Loan Term</label>
              <input type="text" id="viewloan_term" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Loan Date</label>
              <input type="text" id="loan_date" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Loan Type</label>
              <input type="text" id="viewloan_type" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Purpose</label>
              <input type="text" id="purpose" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Co-Maker Name</label>
              <input type="text" id="comaker_name" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Comaker's Status</label>
              <input type="text" id="status_comaker" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Processor's Status</label>
              <input type="text" id="status_processor" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Manager's Status</label>
              <input type="text" id="status_manager" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Cashier's Status</label>
              <input type="text" id="status_cashier" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="modal-footer justify-content-end">
        <div class="form-group">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><!-- /.modal-dialog -->
</div>

<script>
  $('#calculate').click(function() {
    calculate()
  })

  function calculate() {
    if ($('#plan_id').val() == '' || $('[name="amount"]').val() == '') {
      Swal.fire({
        icon: 'error',
        title: 'Oops ...',
        text: 'Please enter amount and plan term first.'
      })
      return false;
    }
    console.log({
      amount: $('[name="amount"]').val(),
      months: $('[name="loan_term"]').val(),
      membership: $('[name="membership"]').val()
    })
    $.ajax({
      url: "../../calculation_table.php",
      method: "POST",
      data: {
        amount: $('[name="amount"]').val(),
        months: $('[name="loan_term"]').val(),
        membership: $('[name="membership"]').val()
      },
      success: function(resp) {
        $('#calculation_table').html(resp)
      }
    })
  }

  $(document).ready(function() {
    $(".viewloan").click(function() {
      $('#borrower_name').val($(this).data('borrower_name'));
      $('#ref_no').val($(this).data('ref_no'));
      $('#viewloan_amount').val($(this).data('viewloan_amount'));
      $('#viewloan_term').val($(this).data('viewloan_term'));
      $('#loan_date').val($(this).data('loan_date'));
      $('#viewloan_type').val($(this).data('viewloan_type'));
      $('#purpose').val($(this).data('purpose'));
      $('#comaker_name').val($(this).data('comaker_name'));
      $('#status_comaker').val($(this).data('status_comaker'));
      $('#status_processor').val($(this).data('status_processor'));
      $('#status_manager').val($(this).data('status_manager'));
      $('#status_cashier').val($(this).data('status_cashier'));

      // $('#viewloan').modal('show');
    });
  });
</script>

<script>
  $(".approve_processor").click(function() {
    var status_ref = $(this).data('status_ref');
    console.log({
      status_ref
    });
    Swal.fire({
      title: 'Confirm Approve?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Approve'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../../config/update-status.php?approve_processor=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
      }
    })
  });

  $(".approve_manager").click(function() {
    var status_ref = $(this).data('status_ref');
    console.log({
      status_ref
    });
    Swal.fire({
      title: 'Confirm Approve?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Approve'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../../config/update-status.php?approve_manager=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
      }
    })
  });

  $(".disapprove_manager").click(function() {
    var status_ref = $(this).data('status_ref');
    console.log({
      status_ref
    });
    Swal.fire({
      title: 'Confirm Disapprove?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Disapprove'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../../config/update-status.php?disapprove_manager=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
      }
    })
  });

  $(".approve_cashier").click(function() {
    var status_ref = $(this).data('status_ref');
    console.log({
      status_ref
    });
    Swal.fire({
      title: 'Confirm Approve?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Approve'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../../config/update-status.php?approve_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
      }
    })
  });

  $(".disapprove_cashier").click(function() {
    var status_ref = $(this).data('status_ref');
    console.log({
      status_ref
    });
    Swal.fire({
      title: 'Confirm Disapprove?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Disapprove'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../../config/update-status.php?disapprove_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
      }
    })
  });

  $(".release_cashier").click(function() {
    var status_ref = $(this).data('status_ref');
    console.log({
      status_ref
    });
    Swal.fire({
      title: 'Confirm Release?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Release'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../../config/update-status.php?release_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
      }
    })
  });
</script>