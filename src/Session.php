<?php
class Session
{
    public function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['active'])) {
            header('Location: ../');
            exit;
        }
    }
}

