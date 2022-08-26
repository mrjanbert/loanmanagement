<?php
require_once 'data/Database.php';
$today = date("Y-m-d", strtotime(' + ' . 3 . ' days'));

$sql = $conn->query("SELECT n.loan_ref, DATE_SUB(n.month_date, INTERVAL 3 DAY) as datetonotify, t.ref_no, b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name FROM ((tbl_transaction t INNER JOIN tbl_borrowers b on t.borrower_id = b.user_id) INNER JOIN tbl_monthlynotif n on t.ref_no = n.loan_ref) WHERE n.month_date = '$today'");
$num = 1;
$persons = $sql->fetch_all(MYSQLI_ASSOC);

foreach ($persons as $row) { ?>
  <p><?= $num++ . '. date: ' . $row["datetonotify"] . ', reference no: ' . $row["loan_ref"] . ', phone no: ' . $row['contactNumber'] . ', borrower name: ' . $row['borrower_name'] ?></p>

<?php
  $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
  $phone = $row['contactNumber']; // Phone number
  $msg = 'Hi MR/MRS. ' . $row['borrower_name'] . '. Scheduled payment date: ' . date("Y-m-d", strtotime(' + ' . 3 . ' days')) . ', please pay before due date.';  // Message
  $device = '319799';  //  Device code
  $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

  $data = array(
    "phone" => $phone,
    "msg" => $msg,
    "device" => $device,
    "token" => $token
  );

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  $output = curl_exec($curl);
  curl_close($curl);

  echo $msg;
}
?>

<!-- 
  ? borrower name
  ? loan reference number
  ? date of notification
  ? phone number
  ? message
-->

<!--
  todo:
    * get all 'month_date' from tbl_monthlynotif and subtract 3 days each row
    * check each row if the value is equal to today's date
    * get month_date(equal to today's date) from tbl_monthlynotif
    * execute sms messages each month_date
-->

<p>Localhost Time:</p>
<div id="clock" onload="currentTime()"></div>

<script>
  function currentTime() {
    let date = new Date();
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    let session = "AM";

    if (hh === 0) {
      hh = 12;
    }
    if (hh > 12) {
      hh = hh - 12;
      session = "PM";
    }

    hh = (hh < 10) ? "0" + hh : hh;
    mm = (mm < 10) ? "0" + mm : mm;
    ss = (ss < 10) ? "0" + ss : ss;

    let time = hh + ":" + mm + ":" + ss + " " + session;

    document.getElementById("clock").innerText = time;
    let t = setTimeout(function() {
      currentTime()
    }, 1000);
  }

  currentTime();
</script>