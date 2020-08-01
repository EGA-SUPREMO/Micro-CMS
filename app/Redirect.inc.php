<?php

class Redirect {
    
    public function redirectTo($url) {
    	if (headers_sent()) {
        	echo "<script> location.replace('".$url."'); </script>";
        } else {
        	header("Location: " . $url, true, 301);
        	exit();
   		}
    }
    
}