<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../error/404-error.php');
  exit();
};
?>
<?php if ($_SESSION['role_name'] == 'Cashier') : ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Payments</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Payments</li>
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
              <h2 class="card-title">Payments List</h2>
              <div class="d-flex justify-content-end">
                <div class="d-flex justify-content-end mb-2">
                  <button class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#addpayment">
                    <i class="fa fa-plus mr-1"></i>
                    Add Payment
                  </button>
                </div>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <?php include_once 'base/data-payment-list.php' ?>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->

  <!-- Add Payment -->
  <div class="modal fade" id="addpayment">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <form action="../../config/create-payment.php" method="POST" onsubmit="submitbtn.disabled = true; return true;" autocomplete="off">
        <div class="modal-content card-outline card-primary">
          <div class="modal-header">
            <h4 class="modal-title">Add Payment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Loan Reference No. <small class="text-red">*</small></label>
                  <select name="ref_no" data-placeholder="Select Loan Reference No." style="width: 100%;" class="select2" required>
                    <option value=""></option>
                    <?php
                    $i = 1;
                    $sql = "SELECT t.*, s.*, concat(b.firstName, ' ', b.lastName) as borrower_name FROM ((tbl_transaction t INNER JOIN tbl_status s on s.ref_no = t.ref_no) INNER JOIN tbl_borrowers b on b.user_id = t.borrower_id) WHERE s.status_cashier = '2' ORDER BY b.lastName ASC";
                    $results = mysqli_query($conn, $sql);
                    while ($row = $results->fetch_assoc()) {
                      $ref_no = $row['ref_no'];
                      $borrower_name = $row['borrower_name'];
                      $amount = $row['amount'];
                      $loan_term = $row['loan_term'];
                    ?>
                      <option value="<?= $ref_no ?>"><?= $ref_no . ' - ' . $borrower_name ?></option>
                    <?php } ?>
                  </select>
                  <!-- <input type="text" class="form-control form-control-border" name="ref_no" value="" readonly> -->
                </div>
              </div>
              <div class="col-12">
                <div class="form-group pb-0">
                  <label>Add Penalty?</label>
                  <input class="ml-4 form-check-input" type="radio" value="1" name="radio1">
                  <label class="ml-5 form-check-label">Yes</label>
                  <input class="ml-4 form-check-input" type="radio" value="0" name="radio1">
                  <label class="ml-5 form-check-label">No</label>
                  <div class="d-flex">
                    <input type="number" id="penaltyinput" name="month" class="form-control form-control-border" placeholder="Pila ka bulan">
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Payment Amount <small class="text-red">*</small></label>
                  <input type="text" class="form-control form-control-border" name="payment_amount" placeholder="Enter Amount" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>OR Number <small class="text-red">*</small></label>
                  <input type="text" class="form-control form-control-border" maxlength="10" name="receipt_no" placeholder="Enter OR #" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Date <small class="text-red">*</small></label>
                  <input type="text" class="form-control form-control-border" onfocus="(this.type='date')" onblur="(this.type='text')" name="payment_date" placeholder="Enter Payment Date" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <input type="hidden" name="submit">
            <button type="submit" name="submitbtn" class="btn btn-primary">
              Save
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancel
            </button>
          </div>
        </div>
      </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  <!-- Add Payments -->

  <script>
    $('#penaltyinput').hide();
    $('input[name="radio1"]').click(function() {
      var inputValue = $(this).attr("value");
      if (inputValue == 1) {
        $('#penaltyinput').show();
        $('option[id="2"]').val('');
      } else {
        $('#penaltyinput').hide();
        $('#penaltyinput').val('');
      }
    })
  </script>
<?php endif; ?>