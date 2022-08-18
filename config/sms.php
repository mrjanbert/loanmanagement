<?php
// require_once 'data/Database.php';

// $query = $conn->query("INSERT INTO tbl_notifications SET user_id = '13', ref_no = '12213456', contactNumber = '09300344555', message = 'Test Notification', date_posted= now() ");
// if ($conn->affected_rows > 0) {
// } else {
//   echo "Fuck you bitch";
// }

// $ref_no = strtotime(date("h:i:sa"));
// $sql = $conn->query("SELECT loan_date FROM tbl_transaction WHERE ref_no = $ref_no ");

echo "Philippine Standard Time";
?>
<div class="pst-date row text-right"> </div>
<p id="demo"></p>

<div id="clock" onload="currentTime()"></div>

<script type="text/javascript" id="gwt-pst">
  (function(d, eId) {
    var js, gjs = d.getElementById(eId);
    js = d.createElement('script');
    js.id = 'gwt-pst-jsdk';
    js.src = "//gwhs.i.gov.ph/pst/gwtpst.js?" + new Date().getTime();
    gjs.parentNode.insertBefore(js, gjs);
  }(document, 'gwt-pst'));

  var gwtpstReady = function() {
    // var otherFormat = 'dddd mmm dd, yyyy HH:MM:ss TT';
    var otherFormat = 'mmm dd, yyyy HH:MM:ss';
    var firstPst = new gwtpstTime({
      timerClass: 'pst-date',
      format: otherFormat
    });
  }

  const g = new Date();
  let month = g.getMonth();
  let date = g.getDate();
  let year = g.getFullYear();

  let day = month + "/" + date + "/" + year;

  document.getElementById("demo").innerHTML = day;


  // document.getElementById("demo").innerHTML = time;


  // function currentTime() {
  //   let date = new Date();
  //   let hh = date.getHours();
  //   let mm = date.getMinutes();
  //   let ss = date.getSeconds();
  //   let session = "AM";

  //   if (hh === 0) {
  //     hh = 12;
  //   }
  //   if (hh > 12) {
  //     hh = hh - 12;
  //     session = "PM";
  //   }

  //   hh = (hh < 10) ? "0" + hh : hh;
  //   mm = (mm < 10) ? "0" + mm : mm;
  //   ss = (ss < 10) ? "0" + ss : ss;

  //   let time = hh + ":" + mm + ":" + ss + " " + session;

  //   document.getElementById("clock").innerText = time;
  //   let t = setTimeout(function() {
  //     currentTime()
  //   }, 1000);
  // }

  // currentTime();
</script>

<?php
// $months = $loan_term + 1;
// $user_id = $user_id;
// $ref_no = $ref_no;
// $contactnumber = '09123456789';
// $message = "data inserted";

// for($i = 1; $i < $months; $i++) {

//   $query = $conn->query("INSERT INTO tbl_notifications SET user_id = '$user_id', ref_no = '$ref_no', contactNumber = '$contactnumber', message = '$message', date_posted= now() ");
//   if ($conn->affected_rows > 0) {
//     echo $message;
//   } else {
//     echo "Fuck you bitch";
//   }
// }

?>