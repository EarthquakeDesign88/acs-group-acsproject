<?php
namespace App\Models;

use App\Database\Db;

class ScopeOfService extends Db {
    protected $tableName = 'project_scope';

    public function getAllScopeOfServices() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getScopeOfServiceById($scope_id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE scope_id = :scope_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['scope_id' => $scope_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createScopeOfService($scope_name_th, $scope_name_en, $created_at) {
        $sql = "INSERT INTO {$this->tableName} (scope_name_th, scope_name_en, created_at) 
                VALUES (:scope_name_th, :scope_name_en, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'scope_name_th' => $scope_name_th,
            'scope_name_en' => $scope_name_en,
            'created_at' => $created_at
        ]);

        return true;
    }

    public function updateScopeOfService($scope_id, $scope_name_th, $scope_name_en, $updated_at) {
        $sql = "UPDATE {$this->tableName} SET scope_name_th = :scope_name_th,
                                              scope_name_en = :scope_name_en,
                                              updated_at = :updated_at
                                          WHERE scope_id = :scope_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'scope_name_th' => $scope_name_th,
            'scope_name_en' => $scope_name_en,
            'updated_at' => $updated_at,
            'scope_id' => $scope_id
        ]);

        return true;
    }

    public function deleteScopeOfService($scope_id) {
        $sql = "DELETE FROM {$this->tableName} WHERE scope_id = :scope_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['scope_id' => $scope_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function checkExistsScopeOfService($scope_name_th, $scope_name_en) {
        $scope_name_en = strtolower($scope_name_en);

        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE scope_name_th = :scope_name_th
                                                             OR scope_name_en = :scope_name_en LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute([
            'scope_name_th' => $scope_name_th,
            'scope_name_en' => $scope_name_en
        ]);
        $rows = $stmt->fetchAll();

        $existsScope = '';

        if(count($rows) > 0) {
            $existsScope = 1;
        }
        else {
            $existsScope = 0;
        }

        return $existsScope;
    }
}



?>