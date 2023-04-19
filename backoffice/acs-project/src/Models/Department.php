<?php
namespace App\Models;

use App\Database\Db;

class Department extends Db {
    protected $tableName = 'department';

    public function getAllDepartments() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getDepartmentById($department_id ) {
        $sql = "SELECT * FROM {$this->tableName} WHERE department_id  = :department_id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['department_id' => $department_id ]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createDepartment($department_name, $department_desc, $created_at) {
        $sql = "INSERT INTO {$this->tableName} (department_name, department_desc, created_at) 
                VALUES (:department_name, :department_desc, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'department_name' => $department_name,
            'department_desc' => $department_desc,
            'created_at' => $created_at
        ]);

        return true;
    }

    public function updateDepartment($department_id, $department_name, $department_desc, $updated_at) {
        $sql = "UPDATE {$this->tableName} SET department_name = :department_name,
                                              department_desc = :department_desc,
                                              updated_at = :updated_at
                                          WHERE department_id = :department_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'department_name' => $department_name,
            'department_desc' => $department_desc,
            'updated_at' => $updated_at,
            'department_id' => $department_id
        ]);

        return true;
    }

    public function deleteDepartment($department_id) {
        $sql = "DELETE FROM {$this->tableName} WHERE department_id = :department_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['department_id' => $department_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function checkExistsDepartment($department_name) {
        $department_name = strtolower($department_name);

        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE department_name = :department_name LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute(['department_name' => $department_name]);
        $rows = $stmt->fetchAll();

        $existsDepartment = '';

        if(count($rows) > 0) {
            $existsDepartment = 1;
        }
        else {
            $existsDepartment = 0;
        }

        return $existsDepartment;
    }

}


?>