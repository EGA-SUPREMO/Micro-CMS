<?php

class ControlSession {
    
    public static function startSession($userId, $username) {
        if(session_id()=='') {
            session_start();
        }
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
    }
    
    public function closeSession() {
        if(session_id()=='') {
            session_start();
        }
        
        if(isset($_SESSION['userId'])) {
            unset($_SESSION['userId']);
        }
        if(isset($_SESSION['username'])) {
            unset($_SESSION['username']);
        }
        session_destroy();
    }
    
    public function isSessionStarted() {
        if(session_id()=='') {
            session_start();
        }
        
        return (isset($_SESSION['userId']) && isset($_SESSION['username']));
    }
}
