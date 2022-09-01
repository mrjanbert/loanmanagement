<?php
$msg = 'DO NOT share this AUTHENTICATION CODE with anyone. Enter the 6-digit code <u>244234</u> to verify your account on NMSCST LMS.';

echo $msg;
?>
<div class="container mt-3">
  <h4>Count down time from 10 second</h4>
  <p id="timerCountDown" class="lead">
    Start
  </p>
</div>
<script>
  const timerElement = document.getElementById('timerCountDown');
  let timer;

  function startTimeCountDown() {
    timer = 10;
    const timeCountdown = setInterval(countdown, 1000);
  }


  function countdown() {
    if (timer == 0) {
      clearTimeout(timer);
      timerElement.innerHTML = 'Start'

    } else {
      timerElement.innerHTML = timer + ' secs';
      timer--;
    }
  }

  timerElement.addEventListener('click', ev => {
    startTimeCountDown();
  });
</script>