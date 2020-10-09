<?php

class Database
{
    public $db;

    public function __construct($host, $dbname, $dbuser, $dbpassword, $charset)
    {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset"));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return TRUE;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function select($sqlQuery, $values = array(), $type = PDO::FETCH_OBJ)
    {
        try {
            $query = $this->db->prepare($sqlQuery);
            $query->execute($values);
            return $query->fetchAll($type);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function row($sqlQuery, $values = array(), $type = PDO::FETCH_OBJ)
    {
        try {
            $query = $this->db->prepare($sqlQuery);
            $query->execute($values);
            return $query->fetch($type);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function insert($tableName, $columns, $values)
    {
        $setvalues = ltrim(str_repeat(',?', count($columns)), ",");
        $columns   = implode(",", $columns);

        try {
            $sql = "INSERT INTO $tableName ($columns) VALUES ($setvalues)";
            $insert = $this->db->prepare($sql);
            return $insert->execute($values);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function update($sqlQuery, $values)
    {
        try {
            $update = $this->db->prepare($sqlQuery);
            return $update->execute($values);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function delete($sqlQuery, $values)
    {
        try {
            $delete = $this->db->prepare($sqlQuery);
            return $delete->execute($values);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function __destruct()
    {
        $this->db = null;
    }
}
