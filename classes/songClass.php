<?php
include_once './database/db.php';

class Song extends Dbcon
{

    public function getData()
    {
        $sql = "SELECT * FROM songs";
        // prepare the query
        $stmt = $this->connect()->prepare($sql);
        // execute the query
        $stmt->execute();
        return $stmt;
    }

    // get single data
    public function getSingleData($id)
    {
        $sql = "SELECT * FROM songs WHERE id = :id";
        // prepare the query
        $stmt = $this->connect()->prepare($sql);
        // bind the parameters
        $stmt->bindParam(':id', $id);
        // execute the query
        $stmt->execute();
        return $stmt;
    }

    public function inserData($singer, $song, $lyrics)
    {
        $sql = "INSERT INTO songs (singer, song, lyrics) 
        VALUES (:singer, :song, :lyrics)";
        // prepare the query
        $stmt = $this->connect()->prepare($sql);
        // bind the parameters
        $stmt->bindParam(':singer', $singer);
        $stmt->bindParam(':song', $song);
        $stmt->bindParam(':lyrics', $lyrics);
        // execute the query
        $stmt->execute();
        return $stmt;
    }
    // delete
    public function deleteData($id)
    {
        $sql = "DELETE FROM songs WHERE id = :id";
        // prepare the query
        $stmt = $this->connect()->prepare($sql);
        // bind the parameters
        $stmt->bindParam(':id', $id);
        // execute the query
        $stmt->execute();
        return $stmt;
    }
    // update
    public function updateData($id, $singer, $song, $lyrics)
    {
        $sql = "UPDATE songs SET singer = :singer, song = :song, lyrics = :lyrics WHERE id = :id";
        // prepare the query
        $stmt = $this->connect()->prepare($sql);
        // bind the parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':singer', $singer);
        $stmt->bindParam(':song', $song);
        $stmt->bindParam(':lyrics', $lyrics);
        // execute the query
        $stmt->execute();
        return $stmt;
    }

    // order by
    public function orderBy($order)
    {
        $sql = "SELECT * FROM songs ORDER BY $order";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // select distinct
    public function singerStats()
    {
        $sql = "SELECT DISTINCT singer FROM songs";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
