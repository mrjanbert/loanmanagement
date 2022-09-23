<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: ../../error/403-error.php');
  exit();
};
?>

<!-- Apply Loan Start -->

<div class="modal fade" id="addloan">
  <div class="modal-dialog modal-md">
    <div class="modal-content card-outline card-primary">
      <form action="../../config/create-userclientloan.php" onsubmit="submitbtn.disabled = true; return true;" method="POST" autocomplete="off">
        <div class="modal-header">
          <h4 class="modal-title">Apply New Loan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 m-0 p-0">
              <?php if (isset($_SESSION['membership']) && ($_SESSION['membership']) == '0') : ?>
                <p>Status: <b class="text-warning">Non-member</b></p>
              <?php else : ?>
                <p>Status: <b class="text-success">Member</b></p>
              <?php endif; ?>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Loan Amount: <small class="text-red">*</small></label>
                <input type="text" id="view_loan_amount" name="amount" class="form-control form-control-border" placeholder="Amount" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Term (month/s): <small class="text-red">*</small></label>
                <input type="number" id="view_loan_months" name="loan_term" class="form-control form-control-border" placeholder="Loan Term" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Type of Loan <small class="text-red">*</small></label>
            <!-- <input type="text" class="form-control form-control-border" id="view_loan_type" name="loan_type" placeholder="Type of Loan" required> -->
            <select class="select2" style="width: 100%;" name="loan_type" id="view_loan_type" data-placeholder="Type of Loan" required>
              <option value=""></option>
              <option value="Emergency Loan">Emergency Loan</option>
              <option value="Salary Loan">Salary Loan</option>
              <option value="Rice Loan">Rice Loan</option>
            </select>
          </div>
          <div class="form-group">
            <label>Purpose <small class="text-red">*</small></label>
            <input type="text" class="form-control form-control-border" id="view_loan_purpose" name="purpose" placeholder="Purpose" required>
          </div>

          <?php if (isset($_SESSION['membership']) && ($_SESSION['membership']) == '0') : ?>

            <div class="form-group">
              <label>Co-maker <small class="text-red">*</small></label>

              <select class="select2" style="width: 100%;" name="comaker_id" id="view_loan_comaker" data-placeholder="Choose Co-maker" required>
                <option value=""></option>
                <?php
                $query = $conn->query("SELECT * FROM tbl_comakers ORDER BY lastName DESC");
                while ($row = $query->fetch_assoc()) :
                ?>
                  <option value="<?= $row['user_id'] ?>"><?= $row['firstName'] . ' ' . $row['lastName']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>

          <?php elseif (isset($_SESSION['membership']) && ($_SESSION['membership']) == '1') : ?>

            <div class="form-group">
              <label>Co-maker <small>(optional)</small></label>

              <select class="select2" style="width: 100%;" name="comaker_id" id="view_loan_comaker" data-placeholder="Choose Co-maker">
                <option value=""></option>
                <option value="<?= $_SESSION['user_id'] ?>">-- No Comaker Selected --</option>
                <?php
                $query = $conn->query("SELECT * FROM tbl_comakers WHERE user_id != $user_id ORDER BY lastName ASC");
                while ($row = $query->fetch_assoc()) :
                ?>
                  <option value="<?= $row['user_id'] ?>"><?= $row['firstName'] . ' ' . $row['lastName']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          <?php endif; ?>

          <input type="hidden" name="borrower_id" value="<?= $_SESSION['user_id']; ?>">
          <input type="hidden" name="membership" id="membership" value="<?= $_SESSION['membership']; ?>">

          <div class="col-12 d-flex justify-content-end">
            <div class="form-group">
              <button class="btn btn-primary btn-sm" type="button" id="calculate"> Calculate</button>
            </div>
          </div>
          <div id="calculation_table"></div>
        </div>
        <!-- /.card-body -->
        <div class="modal-footer ">
          <div class="form-group">
            <label class="form-check-label" for="invalidCheck">
              By clicking the "Apply" button, you are agree to the <a href="#" data-toggle="modal" data-target="#termsconditions">Terms and Conditions of NMSCST LMS</a>.
            </label>
          </div>
          <div class="form-group justify-content-end">
            <input type="hidden" name="submit">
            <button type="submit" name="submitbtn" class="btn btn-primary">Apply</button>
            <button type="button" class="btn btn-secondary" id="close_modal" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
</div>

<!-- Apply Loan End -->


<div class="modal fade" id="termsconditions">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">TERMS AND CONDITIONS</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <h5>I. Eligibility</h5> <br />
        <p>1. The borrower has to be an employee of NMSCST. (COS and Regular)</p>
        <p>2. The borrower has no default on any outstanding loan to the Coop.</p>
        <!-- <p>3. Contract of Service employee cannot avail a loan if the remaining months of their contract is below 3 months.</p> -->
        <p>3. Non - Members/Regular employee borrowers are entitled a loan based on the 50% of their net pay.</p>
        <br />
        <h5>II. Co-Maker</h5> <br />
        <p>1. The Co-Maker/Guarantor must be a member of the Cooperative and possess a higher share capital that can cater the loan amount of the borrower.</p>
        <p>2. The Co-Maker/Guarantor must understand that by agreeing and signing the Loan Application, they lawfully commit themselves to conditionally answer for the payment of the Borrower's obligation when due and demandable.</p>
        <br />
        <h5>III. Mode of Payment</h5> <br />
        <p>1. The payment shall be made on the next month of the same date when loan released occurs.</p>
        <p>2. It can be monthly or 15th & 30th based on the borrower's preferences.</p>
        <br />
        <h5>IV. Deductions</h5> <br />
        <p>1. Service Charge: 1% of the loan amount</p>
        <p>2. Share Capital: 1% of the loan amount for members only</p>
        <p>3. Notarial fee: 100.00</p>
        <br />
        <h5>V. Loans and Penalties</h5> <br />
        <p>1. The interest of loan shall be 12% anually or 1% per month.</p>
        <p>2. Loans are subject to penalty which is 1.5% in monthly amortization if the borrower did not agree for the salary deduction process.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  // (function formsubmit() {
  //   var allowSubmit = true;
  //   form.onsubmit = function() {
  //     if (allowSubmit)
  //       allowSubmit = false;
  //     else
  //       return false;
  //   }
  // })();
</script>