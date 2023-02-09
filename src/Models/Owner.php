<?php
namespace App\Models;

use App\Database\Db;

class Owner extends Db {
    protected $tableName = 'project_owner';

    public function getAllOwners() {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_active = '1' AND owner_reviewstatus = 'authorized' 
                                                 ORDER BY updated_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getAllInactiveOwners() {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_active = '0'  
                                                 ORDER BY updated_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getOwnerById($owner_id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_id = :owner_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['owner_id' => $owner_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createOwner($data) {
        $sql = "INSERT INTO {$this->tableName} (owner_name_th, owner_name_en, owner_active, owner_action, owner_reviewstatus, created_at, user_created, updated_at, user_updated) 
                VALUES (:owner_name_th, :owner_name_en, :owner_active, :owner_action, :owner_reviewstatus, :created_at, :user_created, :updated_at, :user_updated)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'owner_name_th' => $data['owner_name_th'],
            'owner_name_en' => $data['owner_name_en'],
            'owner_active' => $data['owner_active'],
            'owner_action' => $data['owner_action'],
            'owner_reviewstatus' => $data['owner_reviewstatus'],
            'created_at' => $data['created_at'],
            'user_created' => $data['user_created'],
            'updated_at' => $data['updated_at'],
            'user_updated' => $data['user_updated']
        ]);

        return true;
    }

    public function updateOwner($data) {
        $sql = "UPDATE {$this->tableName} SET owner_name_th = :owner_name_th,
                                              owner_name_en = :owner_name_en,
                                              owner_active = :owner_active,
                                              owner_action = :owner_action,
                                              owner_reviewstatus = :owner_reviewstatus,
                                              user_updated = :user_updated,
                                              updated_at = :updated_at
                                          WHERE owner_id = :owner_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'owner_id' => $data['owner_id'],
            'owner_name_th' => $data['owner_name_th'],
            'owner_name_en' => $data['owner_name_en'],
            'owner_active' => $data['owner_active'],
            'owner_action' => $data['owner_action'],
            'owner_reviewstatus' => $data['owner_reviewstatus'],
            'updated_at' => $data['updated_at'],
            'user_updated' => $data['user_updated']
        ]);

        return true;
    }

    public function deleteOwner($owner_id) {
        $sql = "DELETE FROM {$this->tableName} WHERE owner_id = :owner_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['owner_id' => $owner_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_active = 1 AND owner_reviewstatus = 'authorized'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function checkExistsOwner($owner_name_th, $owner_name_en) {
        $owner_name_en = strtolower($owner_name_en);

        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE owner_name_th = :owner_name_th
                                                             OR owner_name_en = :owner_name_en LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute([
            'owner_name_th' => $owner_name_th,
            'owner_name_en' => $owner_name_en
        ]);
        $rows = $stmt->fetchAll();

        $existsOwner = '';

        if(count($rows) > 0) {
            $existsOwner = 1;
        }
        else {
            $existsOwner = 0;
        }

        return $existsOwner;
    }

    public function searchOwner($search){
        $sql = "SELECT * FROM project_owner WHERE owner_name_en LIKE '%$search%' OR owner_name_th LIKE '%$search%'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        for($i = 0; $i < count($data); $i++){
            if(preg_match("/^[a-zA-Z]+$/",$search)){
                $data[$i]['owner_name'] = $data[$i]['owner_name_en'];
            }else{
                $data[$i]['owner_name'] = $data[$i]['owner_name_th'];
            }
        }

        return $data;
    }

    //Admin Role
    public function awaitingReviews() {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_active = '0' AND owner_reviewstatus = 'waiting for review' 
                                                 ORDER BY updated_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function totalAwaitingReviewCount($condition1, $condition2 = '') {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_reviewstatus = '$condition1'";
        $sql .= (!empty($condition2)) ? "OR owner_reviewstatus = '$condition2'" : "";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function historyReviews($condition1, $condition2 = '') {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_reviewstatus = '$condition1'";
        $sql .= (!empty($condition2)) ? "OR owner_reviewstatus = '$condition2'" : "";
        $sql .= "ORDER BY updated_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function approveRequest($ids) {
        $countItems = count($ids);

        for($i=0; $i < $countItems; $i++) {
            $sql = "UPDATE {$this->tableName} SET owner_active = '1',
                                                  owner_reviewstatus = 'authorized' 
                                              WHERE owner_id = $ids[$i] "; 

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        
        return true;
    }

    public function disapproveRequest($data) {
        $owner_id = $data['owner_id'];
        $resend_request = $data['resend_request'];
        $disapprove_reason = $data['disapprove_reason'];
        $status = $resend_request == 'yes' ? 'resend request' : 'unauthorized';


        $sql = "UPDATE {$this->tableName} SET owner_active = '0',
                                              owner_reviewstatus = '$status',
                                              owner_remarkstatus = '$disapprove_reason'
                                          WHERE owner_id = '$owner_id' "; 

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return true;
    }


    //User Role
    public function totalRequestByUser($user, $condition1, $condition2 = '') {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_reviewstatus = '$condition1'";
        $sql .= (!empty($condition2)) ? "OR owner_reviewstatus = '$condition2'" : "";
        $sql .= "AND user_updated = '$user' ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function requestListsByUser($user, $condition1, $condition2 = '') {
        $sql = "SELECT * FROM {$this->tableName} WHERE owner_reviewstatus = '$condition1'";
        $sql .= (!empty($condition2)) ? "OR owner_reviewstatus = '$condition2'" : "";
        $sql .= "AND  user_updated = '$user' ORDER BY updated_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }


}



?>