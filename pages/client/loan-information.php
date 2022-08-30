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
        <h1>Loan Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Loan Information</li>
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
                  $ref_no = $_GET['ref_no'];
                  $query = $conn->query("SELECT t.*,  s.*, concat(c.firstName,' ', c.lastName) as comaker_name, concat(u.firstName,' ', u.lastName) as user_name, b.profilePhoto, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name, b.membership
                      FROM ((((tbl_transaction t 
                        INNER JOIN tbl_status s ON t.ref_no = s.ref_no)
                        LEFT JOIN tbl_users u ON s.processor_id = u.user_id) 
                        INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id)
                        INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) 
                      WHERE t.ref_no = $ref_no");
                  $row = $query->fetch_array();
                  $borrower_id = $row['borrower_id'];
                  $comaker_id = $row['comaker_id'];
                  $borrower_membership = $row['membership'];
                  $borrower_profilePhoto = $row['profilePhoto'];
                  $borrower_name = $row['borrower_name'];
                  $comaker_name = $row['comaker_name'];
                  $user_name = $row['user_name'];
                  $amount = $row['amount'];
                  $loan_date = $row['loan_date'];
                  $loan_term = $row['loan_term'];
                  $loan_type = $row['loan_type'];
                  $purpose = $row['purpose'];
                  $comaker_date = $row['comaker_dateprocess'];
                  $processor_date = $row['processor_dateprocess'];
                  $manager_date = $row['manager_dateprocess'];
                  $cashier_date = $row['cashier_dateprocess'];

                  ?>
                  <div class="row">
                    <div class="col-12 col-sm-auto mb-3">
                      <div class="mx-auto" style="width: 140px;">
                        <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                          <?php if ($borrower_profilePhoto == null) { ?>
                            <img src="../../assets/images/profile.png" id="photopreview" alt="User Image" style="height: 140px; width: 140px;">
                          <?php } else { ?>
                            <img src="../../assets/images/uploads/<?= $borrower_profilePhoto ?>" id="photopreview" alt="User Image" style="height: 140px; width: 140px;">
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class=" col d-flex flex-column flex-sm-row justify-content-between mb-3">
                      <div class="text-center text-sm-left mb-2 mb-sm-0">
                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $borrower_name ?></h4>
                        <p class="mb-0 text-muted"><?= ($borrower_membership == 1) ? 'Member' : 'Non-member' ?></p>
                      </div>
                      <div class="text-center text-sm-right">
                        <button class="btn btn-warning btn-sm" onclick="history.back()"><i class="fas fa-arrow-alt-circle-left"></i> &nbsp;Back</button>
                      </div>
                    </div>
                  </div>
                  <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="javascript:void(0)" class="active nav-link">Loan Information</a></li>
                  </ul>
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Borrower Name</label>
                                <input class="form-control" type="text" placeholder="<?= $borrower_name ?>" value="<?= $borrower_name ?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Comaker Name</label>
                                <input class="form-control" type="text" placeholder="<?= ($borrower_id == $comaker_id) ? '' : $comaker_name ?>" value="<?= ($borrower_id == $comaker_id) ? '' : $comaker_name ?>">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Reference Number</label>
                                <input class="form-control" type="text" placeholder="<?= $ref_no ?>" value="<?= $ref_no ?>">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Loan Amount</label>
                                <input class="form-control" type="text" placeholder="<?= number_format($amount, 2) ?>" value="<?= number_format($amount, 2) ?>">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Loan Term</label>
                                <input class="form-control" type="text" placeholder="<?= $loan_term ?> Month/s" value="<?= $loan_term ?> Month/s">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Date of Application</label>
                                <input class="form-control" type="text" placeholder="<?= date('F j, Y', strtotime($loan_date)) ?>" value="<?= date('F j, Y', strtotime($loan_date)) ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Type of Loan</label>
                                <input class="form-control" type="text" placeholder="<?= $loan_type ?>" value="<?= $loan_type ?>">
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label>Purpose</label>
                                <input class="form-control" type="text" placeholder="<?= $purpose ?>" value="<?= $purpose ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mt-3 mb-0">
                            <b>Loan Status</b>
                          </div>
                          <table id="example2" class="table">
                            <thead>
                              <tr>
                                <th width="25%"></th>
                                <th>Status</th>
                                <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="text-bold">Comaker Status:</td>
                                <?php if ($row['status_comaker'] == '0') { ?>
                                  <td>Pending</td>
                                <?php } elseif ($row['status_comaker'] == '1') { ?>
                                  <td>Approved</td>
                                <?php } else { ?>
                                  <td>Disapproved</td>
                                <?php } ?>
                                <td><?= ($comaker_date != null) ? date('F j, Y', strtotime($comaker_date)) : '' ?></td>
                              </tr>
                              <tr>
                                <td class="text-bold">CC Member Status:</td>
                                <?php if (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '0')) { ?>
                                  <td>Pending</td>
                                <?php } elseif (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '1')) { ?>
                                  <td>Check and Verified by <b><?= $user_name ?></b></td>
                                <?php } elseif (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '3')) { ?>
                                  <td>Disapproved</td>
                                <?php } else { ?>
                                  <td></td>
                                <?php } ?>
                                <td><?= ($processor_date != null) ? date('F j, Y', strtotime($processor_date)) : '' ?></td>
                              </tr>
                              <tr>
                                <td class="text-bold">Manager Status:</td>
                                <?php if (($row['status_processor'] == '1') && ($row['status_manager'] == '0')) { ?>
                                  <td>Pending</td>
                                <?php } elseif (($row['status_processor'] == '1') && ($row['status_manager'] == '1')) { ?>
                                  <td>Approved</td>
                                <?php } elseif (($row['status_processor'] == '1') && ($row['status_manager'] == '3')) { ?>
                                  <td>Disapproved</td>
                                <?php } else { ?>
                                  <td></td>
                                <?php } ?>
                                <td><?= ($manager_date != null) ? date('F j, Y', strtotime($manager_date)) : '' ?></td>
                              </tr>
                              <tr>
                                <td class="text-bold">Cashier Status:</td>
                                <?php if (($row['status_manager'] == '1') && ($row['status_cashier'] == '0')) { ?>
                                  <td>Pending</td>
                                <?php } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '1')) { ?>
                                  <td>Approved</td>
                                <?php } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '2')) { ?>
                                  <td>Released</td>
                                <?php } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '3')) { ?>
                                  <td>Disapproved</td>
                                <?php } else { ?>
                                  <td></td>
                                <?php } ?>
                                <td><?= ($cashier_date != null) ? date('F j, Y', strtotime($cashier_date)) : '' ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
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