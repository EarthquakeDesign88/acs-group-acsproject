<?php
namespace App\Models;

use App\Database\Db;

class Type extends Db {
    protected $tableName = 'project_type';

    public function getAllTypes() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getTypeById($type_id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE type_id = :type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['type_id' => $type_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createType($type_name_th, $type_name_en, $created_at) {
        $sql = "INSERT INTO {$this->tableName} (type_name_th, type_name_en, created_at) 
                VALUES (:type_name_th, :type_name_en, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'type_name_th' => $type_name_th,
            'type_name_en' => $type_name_en,
            'created_at' => $created_at
        ]);

        return true;
    }

    public function updateType($type_id, $type_name_th, $type_name_en, $updated_at) {
        $sql = "UPDATE {$this->tableName} SET type_name_th = :type_name_th,
                                              type_name_en = :type_name_en,
                                              updated_at = :updated_at
                                          WHERE type_id = :type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'type_name_th' => $type_name_th,
            'type_name_en' => $type_name_en,
            'updated_at' => $updated_at,
            'type_id' => $type_id
        ]);

        return true;
    }

    public function deleteType($type_id) {
        $sql = "DELETE FROM {$this->tableName} WHERE type_id = :type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['type_id' => $type_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    
    public function checkExistsType($type_name_th, $type_name_en) {
        $type_name_en = strtolower($type_name_en);

        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE type_name_th = :type_name_th
                                                             OR type_name_en = :type_name_en LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute([
            'type_name_th' => $type_name_th,
            'type_name_en' => $type_name_en
        ]);
        $rows = $stmt->fetchAll();

        $existsType = '';

        if(count($rows) > 0) {
            $existsType = 1;
        }
        else {
            $existsType = 0;
        }

        return $existsType;
    }


}



?>