<?php

// for($m=1; $m<=12; ++$m){
//     echo date('F j Y', mktime(0, 0, 0, $m, 1, 2022)).'<br>';
// }

// $start = $month = strtotime('2022-01-01');
// $end = strtotime('2023-02-01');
// while($month < $end)
// {
//      echo date('F j Y', $month).'<br>';
//      $month = strtotime("+1 month", $month);
// }

echo '<table border="1">';
echo '<tr><th>#</th><th>PAYMENT</th><th>INTEREST</th><th>PRINCIPAL</th><th>BALANCE</th></tr>';
$start_date = '2014-12-14';
$end_date = '2015-03-12';
$count = 0;

$balance = 22400;
$rate = 1;
$payment = 1666.67;
do {
   $count++;

   // calculate interest on outstanding balance
   $interest = $balance * $rate/100;

   // what portion of payment applies to principal?
   $principal = $payment - $interest;

   // watch out for balance < payment
   if ($balance < $payment) {
      $principal = $balance;
      $payment   = $interest + $principal;
   } // if

   // reduce balance by principal paid
   $balance = $balance - $principal;

   // watch for rounding error that leaves a tiny balance
   if ($balance < 0) {
      $principal = $principal + $balance;
      $interest  = $interest - $balance;
      $balance   = 0;
   } // if

   echo "<tr>";
   echo "<td>$count</td>";
   echo "<td>" .number_format($payment,   2, ".", ",") ."</td>";
   echo "<td>" .number_format($interest,  2, ".", ",") ."</td>";
   echo "<td>" .number_format($principal, 2, ".", ",") ."</td>";
   echo "<td>" .number_format($balance,   2, ".", ",") ."</td>";
   echo "</tr>";

   @$totPayment   = $totPayment + $payment;
   @$totInterest  = $totInterest + $interest;
   @$totPrincipal = $totPrincipal + $principal;

   if ($payment < $interest) {
      echo "</table>";
      echo "<p>Payment < Interest amount - rate is too high, or payment is too low</p>";
      exit;
   } // if

} while ($balance > 0);

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td><b>" .number_format($totPayment,   2, ".", ",") ."</b></td>";
echo "<td><b>" .number_format($totInterest,  2, ".", ",") ."</b></td>";
echo "<td><b>" .number_format($totPrincipal, 2, ".", ",") ."</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";


//view payments code

$i = 1;
// $plan = $conn->query("SELECT * FROM loan_plans WHERE plan_id in (SELECT plan_id FROM tbl_transactions)");
// while ($row = $plan->fetch_assoc()) {
//     $plan_arr[$row['plan_id']] = $row;
// }

$loan = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no in (SELECT ref_no FROM tbl_payments)");
while ($row = $loan->fetch_assoc()) {
    $loan_array[$row['ref_no']] = $row;
    $loan_amount = $loan_array[$row['ref_no']]['amount'];
    $interest = $loan_array[$row['ref_no']]['interest'];
}
$query = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = " . $_GET['ref_no'] . " ORDER BY id DESC");
while ($row = $query->fetch_assoc()) :
    $payment_date = strtotime($row['payment_date']);
    $penalty = $row['penalty'];
    $receipt_no = $row['receipt_no'];
    $payment_amount = $row['payment_amount'];
    $balance = $row['balance'];

?>
    <tr>
        <td><?php echo date('F j, Y', $payment_date) ?></td>
        <td></td>
        <td><?php echo $interest ?></td>
        <td><?php echo $penalty ?></td>
        <td><?php echo $receipt_no ?></td>
        <td><?php echo $payment_amount ?></td>
        <td><?php echo $balance ?></td>
    </tr>
<?php endwhile; ?>




<a href="#" class="btn btn-info btn-sm view" image="img_name" data-toggle="modal" data-target="#myModal" title="View image">
    <i class="far fa-images"></i>
</a>

<script>
  $(document).on('click', '.view', function() {
    // var image = $(this).attr('image');
    // $('#image').attr('src', image);
    
    $('#image').attr('src', $(this).attr('image'));
  });
</script>

<img id="image" style="height: 50%; width: 100%;" />


<a class="btn btn-info btn-sm my-1 view_borrower " data-toggle="modal" data-target="#view_borrower" 
    data-name="<?= $row['name'];?>"
    data-image="<?= $row['profilePhoto'];?>"
>View Info</i></a>

<script>
    $(document).ready(function () {
        $(".view_borrower").click(function () {
            $('#name').val($(this).data('name'));
            $('#image').attr('src', $(this).data('image'));
            
            $('#viewloan').modal('show');
        }); 
    }); 
</script>

<img id="image" class="img-square elevation-3" alt="User Image" style="max-width: 200px; height: 200px;">