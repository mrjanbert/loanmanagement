<?php
require_once 'data/Database.php';

// $sql = $conn->query("SELECT *, DATE_ADD(payment_date, INTERVAL 27 DAY) as datetonotify FROM tbl_payments");

// while ($row = $sql->fetch_array()) {

//   $payment_date = $row['datetonotify'];
//   $payment_date = date("Y-m-d");
//   $datetonotify = $payment_date;
//   $today = date("Y-m-d");

//   $notify_time = strtotime($datetonotify);
//   $today_time = strtotime($today);

//   if ($notify_time == $today_time) {
//     header("location: sms.php");
//   }
//   else {
    //TODO Do Nothing
?>

 <p> 
  <?
    // $notify_time 
  ?>
</p> 
<p> 
  <? 
    // $today_time 
  ?>
</p> 
<?php
//   }
// } 
?>



<?php 
  $sql = $conn->query("SELECT * FROM tbl_monthlyreminder");
  