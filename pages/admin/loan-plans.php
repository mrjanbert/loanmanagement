<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Loans Plans</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Loan Plans</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <form action="../../config/create-plan.php" method="POST">
                        <div class="card-header">
                            Plan's Form
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="plan_id">
                            <div class="form-group">
                                <label class="control-label">Term (month/s)</label>
                                <input type="number" name="plan_term" class="form-control text-right">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Interest (percentage)</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" name="interest_percentage" class="form-control text-right">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mode of Payment</label>
                                <select class="form-control" name="mode_of_payment">
                                    <option value="15th/30th">15th/30th</option>
                                    <option value="Monthly">Monthly</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary offset-md-3" type="submit" name="submit" value="submit">Save</button>
                                    <input type="button" class="btn btn-secondary" value="Cancel" onclick="history.go(0)" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Plan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM loan_plans";
                                $results = $conn->query($query);
                                ?>
                                <?php while ($row = $results->fetch_row()) : ?>

                                    <tr>
                                        <td class="text-center align-middle"><?php echo $row[0]; ?></td>
                                        <td class="">
                                            <p>Term: <b><?php echo $row[1]; ?></b> month/s</p>
                                            <p>Interest: <b><?php echo $row[2]; ?></b> %</p>
                                            <p>Mode of Payment: <b><?php echo $row[3]; ?></b></p>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-sm btn-primary my-1" type="button"><i class="fas fa-pen"></i></button>
                                            <a role="button" class="btn btn-danger btn-sm" onclick="deleteplan()"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <script>
                                        function  deleteplan() {
                                            window.location.href = '../../config/delete-plan.php?deleteplan_id=<?php echo $row[0]; ?>'
                                        }
                                    </script>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->