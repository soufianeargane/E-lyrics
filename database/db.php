<?php
session_start();
class Dbcon
{
    public function connect()
    {
        try {

            $username = 'root';
            $password = '';
            $db       = new PDO('mysql:host=localhost;dbname=music', $username, $password);
            return $db;
        } catch (PDOException $e) {
            print $e->getMessage();
            die();
        }
    }
}
