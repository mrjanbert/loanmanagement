<?php
// require_once 'data/Database.php';

// $query = $conn->query("INSERT INTO tbl_notifications SET user_id = '13', ref_no = '12213456', contactNumber = '09300344555', message = 'Test Notification', date_posted= now() ");
// if ($conn->affected_rows > 0) {
// } else {
//   echo "Fuck you bitch";
// }

// $ref_no = strtotime(date("h:i:sa"));
// $sql = $conn->query("SELECT loan_date FROM tbl_transaction WHERE ref_no = $ref_no ");

// echo "Philippine Standard Time";
?>
<div class="pst-date row text-right" style="font-family: 'Droid Sans', sans-serif;  font-size: medium;"> </div>
<p id="demo"></p>

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
    var otherFormat = 'mmm dd, yyyy HH:MM';
    var firstPst = new gwtpstTime({
      timerClass: 'pst-date',
      format: otherFormat
    });
    // console.log(timerClass);
  }

  const g = new Date();
  let ms = g.getMonth() + 1;
  document.getElementById("demo").innerHTML = ms;
</script>