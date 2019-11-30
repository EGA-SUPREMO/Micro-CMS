<?php

class Redirect {
    
    public function redirectTo($url) {
        header("Location: " . $url, true, 301);
        exit();
    }
    
}