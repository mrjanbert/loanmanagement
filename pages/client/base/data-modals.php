<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  header('location: http://localhost/loanmanagement/pages/err/404-error.php');
  exit();
};
?>

<!-- Apply Loan Start -->

<div class="modal fade" id="addloan">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content card-outline card-primary">
      <form action="../../config/create-userclientloan.php" autocomplete="off" method="POST">
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
                <input type="number" id="view_loan_amount" name="amount" class="form-control form-control-border" placeholder="Amount" required>
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
            <input type="text" class="form-control form-control-border" id="view_loan_type" name="loan_type" placeholder="Type of Loan" required>
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
        <div class="modal-footer justify-content-end">
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Apply</button>
            <button type="button" class="btn btn-secondary" id="close_modal" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
</div>

<!-- Apply Loan End -->