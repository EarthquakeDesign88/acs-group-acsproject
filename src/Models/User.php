<?php
namespace App\Models;

use App\Database\Db;

class User extends Db {
    protected $tableName = 'user';

    public function getAllUsers() {
        $sql = "SELECT u.user_id, u.username, u.user_email, u.user_firstname, u.user_lastname, u.user_mobilenumber, u.user_role, u.created_at as user_created, u.updated_at as user_updated, 
                d.department_name as user_department, d.department_desc as user_department_desc
                FROM {$this->tableName} as u 
                INNER JOIN department as d 
                ON u.user_depid = d.department_id
                ORDER BY u.created_at DESC";
        $stmt = $this->conn->query($sql);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getUserById($user_id) {
        $sql = "SELECT u.*, d.department_name
                FROM {$this->tableName} as u 
                INNER JOIN department as d 
                ON u.user_depid = d.department_id
                WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createUser($username, $password, $user_email, $user_firstname, $user_lastname, $user_mobilenumber, $user_role, $user_depid, $created_at) {
        $sql = "INSERT INTO {$this->tableName} (username, password, user_email, user_firstname, user_lastname, user_mobilenumber, user_role, user_depid, created_at) 
                VALUES (:username, :password, :user_email, :user_firstname, :user_lastname, :user_mobilenumber, :user_role, :user_depid, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'user_email' => $user_email,
            'user_firstname' => $user_firstname,
            'user_lastname' => $user_lastname,
            'user_mobilenumber' => $user_mobilenumber,
            'user_role' => $user_role,
            'user_depid' => $user_depid,
            'created_at' => $created_at
        ]);

        return true;
    }

    public function updateUser($user_id, $username, $user_email, $user_firstname, $user_lastname, $user_mobilenumber, $user_role, $user_depid, $updated_at) {
        $sql = "UPDATE {$this->tableName} SET username = :username,
                                              user_email = :user_email,
                                              user_firstname = :user_firstname,
                                              user_lastname = :user_lastname,
                                              user_mobilenumber = :user_mobilenumber,
                                              user_role = :user_role,
                                              user_depid = :user_depid,
                                              updated_at = :updated_at
                                          WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'user_email' => $user_email,
            'user_firstname' => $user_firstname,
            'user_lastname' => $user_lastname,
            'user_mobilenumber' => $user_mobilenumber,
            'user_role' => $user_role,
            'user_depid' => $user_depid,
            'updated_at' => $updated_at,
            'user_id' => $user_id
        ]);

        return true;
    }

    public function deleteUser($user_id) {
        $sql = "DELETE FROM {$this->tableName} WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function checkExistsUser($username) {
        $username = strtolower($username);
      
        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute(['username' => $username]);
        $rows = $stmt->fetchAll();

        $existsUser = '';

        if(count($rows) > 0) {
            $existsUser = 1;
        }
        else {
            $existsUser = 0;
        }

        return $existsUser;
    }

    public function resetPassword($user_id, $password, $updated_at) {
        $sql = "UPDATE {$this->tableName} SET password = :password,
                                              updated_at = :updated_at
                                          WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'password' => $password,
            'updated_at' => $updated_at,
            'user_id' => $user_id
        ]);

        return true;
    }

}



?>