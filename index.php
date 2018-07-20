<?php

/***********************************************************************
  Copyright (C) Keos Media
************************************************************************/
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

require_once('init.php'); 
require_once('lib'. DS .'functions.php');

new Access;
new Controller;
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);  //echo 'Page generated in '.$total_time.' seconds.';