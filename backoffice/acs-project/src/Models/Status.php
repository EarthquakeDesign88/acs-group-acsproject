<?php
namespace App\Models;

use App\Database\Db;

class Status extends Db {
    protected $tableName = 'project_status';

    public function getAllStatus() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getStatusById($status_id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE status_id = :status_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status_id' => $status_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createStatus($status_name_th, $status_name_en, $created_at) {
        $sql = "INSERT INTO {$this->tableName} (status_name_th, status_name_en, created_at) 
                VALUES (:status_name_th, :status_name_en, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'status_name_th' => $status_name_th,
            'status_name_en' => $status_name_en,
            'created_at' => $created_at
        ]);

        return true;
    }

    public function updateStatus($status_id, $status_name_th, $status_name_en, $updated_at) {
        $sql = "UPDATE {$this->tableName} SET status_name_th = :status_name_th,
                                              status_name_en = :status_name_en,
                                              updated_at = :updated_at
                                          WHERE status_id = :status_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'status_name_th' => $status_name_th,
            'status_name_en' => $status_name_en,
            'updated_at' => $updated_at,
            'status_id' => $status_id
        ]);

        return true;
    }

    public function deleteStatus($status_id) {
        $sql = "DELETE FROM {$this->tableName} WHERE status_id = :status_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status_id' => $status_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function checkExistsStatus($status_name_th, $status_name_en) {
        $status_name_en = strtolower($status_name_en);

        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE status_name_th = :status_name_th
                                                             OR status_name_en = :status_name_en LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute([
            'status_name_th' => $status_name_th,
            'status_name_en' => $status_name_en
        ]);
        $rows = $stmt->fetchAll();

        $existsStatus = '';

        if(count($rows) > 0) {
            $existsStatus = 1;
        }
        else {
            $existsStatus = 0;
        }

        return $existsStatus;
    }


}



?>