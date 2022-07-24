<?php

$bdate = date_create("1999-10-11");
$now = date_create(date('Y-m-d'));

$diff = date_diff($bdate, $now);
$age = $diff->format("%y");


echo "$age";


