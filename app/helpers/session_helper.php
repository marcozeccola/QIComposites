<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    function isLoggedIn() {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    function isAdmin() {
        if (isset($_SESSION['role']) && $_SESSION['role']=="admin") {
            return true;
        } else {
            return false;
        }
    }