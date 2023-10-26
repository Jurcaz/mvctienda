<?php
include_once 'DefaultModel.php';
class Book extends DefaultModel
{

    public function getBooks()
    {
        $sql = 'SELECT * FROM products WHERE deleted=0 AND type=2';
        $query  = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}