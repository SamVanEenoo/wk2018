<?php
spl_autoload_register(function ($class_name) {
	if($class_name != "Memcached"){
    	include 'class/' . $class_name . '.php';
	}
});
?>