<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Loan Types</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Loan Types</li>
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
                    <form action="../../config/create-loantype.php" method="POST">
                        <div class="card-header">
                            Loan Type Form
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="loantype_id">
                            <div class="form-group">
                                <label class="control-label">Type of Loan</label>
                                <input type="text" name="typeofLoan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary offset-md-3" type="submit" name="submit" value="submit"> Save</button>
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
                                    <th class="text-center">Loan Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM loan_types";
                                $results = $conn->query($query);
                                ?>
                                <?php while ($row = $results->fetch_row()) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo $row[0]; ?></td>
                                        <td class="">
                                            <p>Type Name: <b><?php echo $row[1]; ?></b></p>
                                            <p>Description: <b><?php echo $row[2]; ?></b></p>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-sm btn-primary my-1 edit_plan" type="button"><i class="fas fa-pen"></i></button>
                                            <a class="btn btn-sm btn-danger" onclick="deleteloanplan()"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <script>
                                        function deleteloanplan() {
                                            window.location.href = "../../config/delete-loantype.php?deleteloantype_id=<?php echo $row[0]; ?>"
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