<?php

class DefaultModel
{
    protected $db;

    public function __construct()
    {
        $this->db = MySQLdb::getInstance()->getDatabase();
    }


}