<?php
echo '<br> Memory usage: ', round(memory_get_peak_usage() / (1024 * 1024), 2, PHP_ROUND_HALF_EVEN), ' MB<br>';
echo 'Generation time (starting with request receiving): ', round((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000, 0, PHP_ROUND_HALF_EVEN), ' ms<br>';
echo 'Generation time (starting with PHP script launch): ', round((microtime(true) - $start) * 1000, 0, PHP_ROUND_HALF_EVEN), ' ms';
