<?php
namespace App\Models;

use App\Database\Db;

class Category extends Db {
    protected $tableName = 'project_category';

    public function getAllCategories() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getCategoryById($pcategory_id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE pcategory_id = :pcategory_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pcategory_id' => $pcategory_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createCategory($pcategory_name_th, $pcategory_name_en, $created_at) {
        $sql = "INSERT INTO {$this->tableName} (pcategory_name_th, pcategory_name_en, created_at) 
                VALUES (:pcategory_name_th, :pcategory_name_en, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'pcategory_name_th' => $pcategory_name_th,
            'pcategory_name_en' => $pcategory_name_en,
            'created_at' => $created_at
        ]);

        return true;
    }

    public function updateCategory($pcategory_id, $pcategory_name_th, $pcategory_name_en, $updated_at) {
        $sql = "UPDATE {$this->tableName} SET pcategory_name_th = :pcategory_name_th,
                                              pcategory_name_en = :pcategory_name_en,
                                              updated_at = :updated_at
                                          WHERE pcategory_id = :pcategory_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'pcategory_name_th' => $pcategory_name_th,
            'pcategory_name_en' => $pcategory_name_en,
            'updated_at' => $updated_at,
            'pcategory_id' => $pcategory_id
        ]);

        return true;
    }

    public function deleteCategory($pcategory_id) {
        $sql = "DELETE FROM {$this->tableName} WHERE pcategory_id = :pcategory_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pcategory_id' => $pcategory_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function checkExistsCategory($pcategory_name_th, $pcategory_name_en) {
        $pcategory_name_en = strtolower($pcategory_name_en);

        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE pcategory_name_th = :pcategory_name_th
                                                             OR pcategory_name_en = :pcategory_name_en LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute([
            'pcategory_name_th' => $pcategory_name_th,
            'pcategory_name_en' => $pcategory_name_en
        ]);
        $rows = $stmt->fetchAll();

        $existsCategory = '';

        if(count($rows) > 0) {
            $existsCategory = 1;
        }
        else {
            $existsCategory = 0;
        }

        return $existsCategory;
    }

}



?>