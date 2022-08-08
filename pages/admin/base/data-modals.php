<!-- View Borrower -->
<div class="modal fade" id="view_borrower">
  <div class="modal-dialog modal-lg">
    <form action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Personal Information </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 d-flex justify-content-center">
              <div class="image">
                <img id="info_image" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div class="form-group">
                <label>ID Number:</label>
                <input type="text" id="info_idnumber" class="form-control form-control-border text-center" readonly>
              </div>
              <div class="form-group">
                <label>Full Name:</label>
                <input type="text" id="info_name" class="form-control form-control-border text-center" readonly>
              </div>
              <div class="form-group">
                <label>Email:</label>
                <input type="text" id="info_email" class="form-control form-control-border text-center" readonly>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="form-group">
                <label>Age:</label>
                <input type="text" id="info_age" class="form-control form-control-border text-center" readonly>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" id="info_mobilenumber" class="form-control form-control-border text-center" readonly>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="form-group">
                <label>Membership Status:</label>
                <input type="text" id="info_membership" class="form-control form-control-border text-center" readonly>
              </div>
            </div>
            <div class="col-md-12 text-center">
              <div class="form-group">
                <label>Address:</label>
                <input type="text" id="info_address" class="form-control form-control-border text-center" readonly>
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div class="form-group">
                <label>Birth Date:</label>
                <input type="text" id="info_birthdate" class="form-control form-control-border text-center" readonly>
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div class="form-group">
                <label>Date Registered:</label>
                <input type="text" id="info_usercreated" class="form-control form-control-border text-center" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <div class="form-group">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- View Borrower -->

<!-- Add Comaker -->
<div class="modal fade" id="addcomaker">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content card-outline card-primary">
      <form action="../../config/create-comaker.php" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Add New Co-maker</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Borrower Name <small class="text-red">*</small></label>
                <select class="select2" style="width: 100%;" name="user_id" data-placeholder="Select borrower" required>
                  <option></option>
                  <?php
                  $query = $conn->query("SELECT * FROM tbl_borrowers WHERE membership != '1' ");
                  while ($row = $query->fetch_assoc()) :
                  ?>
                    <option value="<?php echo $row['user_id'] ?>"><?php echo $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName']; ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="modal-footer justify-content-end">
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
</div>
<!-- Add Comaker -->

<!-- View Loans -->
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
          <div class="col-md-6">
            <div class="form-group">
              <label>Comaker's Status</label>
              <input type="text" id="status_comaker" class="form-control form-control-border text-center" readonly>
              <input type="text" id="comaker_date" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>CC Member's Status</label>
              <input type="text" id="status_processor" class="form-control form-control-border text-center" readonly>
              <input type="text" id="processor_date" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Manager's Status</label>
              <input type="text" id="status_manager" class="form-control form-control-border text-center" readonly>
              <input type="text" id="manager_date" class="form-control form-control-border text-center" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Cashier's Status</label>
              <input type="text" id="status_cashier" class="form-control form-control-border text-center" readonly>
              <input type="text" id="cashier_date" class="form-control form-control-border text-center" readonly>
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
<!-- View Loans -->

<!-- Add Payment -->
<div class="modal fade" id="addpayment">
  <div class="modal-dialog modal-md">
    <form action="../../config/create-payment.php" method="POST" autocomplete="off">
      <div class="modal-content card-outline card-primary">
        <div class="modal-header">
          <h4 class="modal-title">Add Payment</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <?php
          $ref_no = $_GET['refid'];
          $sql = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = '$ref_no'");
          while ($row = $sql->fetch_assoc()) {
          ?>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Loan Reference No. <small class="text-red">*</small></label>
                  <input type="text" class="form-control form-control-border" name="ref_no" value="<?= $ref_no ?>" readonly>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Payment Amount <small class="text-red">*</small></label>
                  <input type="number" class="form-control form-control-border" name="payment_amount" placeholder="Enter Amount" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>OR Number <small class="text-red">*</small></label>
                  <input type="number" class="form-control form-control-border" maxlength="10" name="receipt_no" placeholder="Enter OR #" required>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="submit" name="submit" class="btn btn-primary">
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

<!-- Add Penalty -->
<div class="modal fade" id="addpenalty">
  <div class="modal-dialog modal-md">
    <form action="../../config/create-payment.php" method="POST" autocomplete="off">
      <div class="modal-content card-outline card-primary">
        <div class="modal-header">
          <h4 class="modal-title">Add Penalty</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">

          <div class="row">
            <?php
            $ref_no = $_GET['refid'];
            $sql = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = '$ref_no'");
            while ($row = $sql->fetch_assoc()) {
            ?>
              <div class="col-12">
                <div class="form-group">
                  <label>Loan Reference No. <small class="text-red">*</small></label>
                  <input type="text" class="form-control form-control-border" name="ref_no" value="<?= $ref_no ?>" readonly>

                </div>
              </div>
            <?php } ?>
            <div class="col-12">
              <div class="form-group">
                <label>Penalty Amount <small class="text-red">*</small></label>
                <input type="number" class="form-control form-control-border" name="penalty" placeholder="Enter Amount" required>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Date<small class="text-red">*</small></label>
                <input type="date" class="form-control form-control-border" name="payment_date" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="submit" name="addpenalty" class="btn btn-primary">
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
<!-- Add Penalty -->