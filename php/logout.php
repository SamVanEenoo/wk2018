<?php
session_start();
session_destroy();
$output = json_encode(array(
'status' => 'true'
));
die($output);
?>