<?php
include_once 'DefaultModel.php';
class Search extends DefaultModel
{
    //crear funcion busqueda de productos

    public function getProducts($string)
    {
        $sql = 'SELECT * FROM products WHERE deleted=0 AND (name LIKE :name OR publisher LIKE :publisher OR author LIKE :author OR people LIKE :people OR description LIKE :description)';
        $query = $this->db->prepare($sql);

        $param = [
            ':name' => '%' . $string . '%',
            ':publisher' => '%' . $string . '%',
            ':author' => '%' . $string . '%',
            ':people' => '%' . $string . '%',
            ':description' => '%' . $string . '%',
        ];

        $query->execute($param);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


}