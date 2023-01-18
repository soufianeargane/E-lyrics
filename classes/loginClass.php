<?php

include './database/db.php';
class User extends Dbcon
{
    public function getUser($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt;
    }
}
