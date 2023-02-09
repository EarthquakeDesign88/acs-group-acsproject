<?php
namespace App\Models;

use App\Database\Db;

class Project extends Db {
    protected $tableName = 'project';

    public function getAllProjects() {
        $sql = "SELECT p.*, c.pcategory_name_th, c.pcategory_name_en, d.department_name, d.department_desc, o.owner_name_th, o.owner_name_en
                ,sc.scope_name_th, sc.scope_name_en, st.status_name_th, st.status_name_en, t.type_name_th, t.type_name_en
                FROM {$this->tableName} as p
                INNER JOIN project_category as c ON p.project_category = c.pcategory_id
                INNER JOIN department as d ON p.project_department = d.department_id
                INNER JOIN project_owner as o ON p.project_owner = o.owner_id
                INNER JOIN project_scope as sc ON p.project_scope = sc.scope_id
                INNER JOIN project_status as st ON p.project_status = st.status_id
                INNER JOIN project_type as t ON p.project_type = t.type_id
                WHERE p.project_active = '1' AND p.project_reviewstatus = 'authorized'
                ORDER BY p.project_year_of_completion DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getAllInactiveProjects() {
        $sql = "SELECT p.*, c.pcategory_name_th, c.pcategory_name_en, d.department_name, d.department_desc, o.owner_name_th, o.owner_name_en
                ,sc.scope_name_th, sc.scope_name_en, st.status_name_th, st.status_name_en, t.type_name_th, t.type_name_en
                FROM {$this->tableName} as p
                INNER JOIN project_category as c ON p.project_category = c.pcategory_id
                INNER JOIN department as d ON p.project_department = d.department_id
                INNER JOIN project_owner as o ON p.project_owner = o.owner_id
                INNER JOIN project_scope as sc ON p.project_scope = sc.scope_id
                INNER JOIN project_status as st ON p.project_status = st.status_id
                INNER JOIN project_type as t ON p.project_type = t.type_id
                WHERE p.project_active = '0'
                ORDER BY p.project_year_of_completion DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getProjectById($project_id) {
        $sql = "SELECT p.*, c.pcategory_name_th, c.pcategory_name_en, d.department_name, d.department_desc, o.owner_name_th, o.owner_name_en
                ,sc.scope_name_th, sc.scope_name_en, st.status_name_th, st.status_name_en, t.type_name_th, t.type_name_en
                FROM {$this->tableName} as p
                INNER JOIN project_category as c ON p.project_category = c.pcategory_id
                INNER JOIN department as d ON p.project_department = d.department_id
                INNER JOIN project_owner as o ON p.project_owner = o.owner_id
                INNER JOIN project_scope as sc ON p.project_scope = sc.scope_id
                INNER JOIN project_status as st ON p.project_status = st.status_id
                INNER JOIN project_type as t ON p.project_type = t.type_id
                WHERE p.project_id = :project_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['project_id' => $project_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createProject($data) {
        $sql = "INSERT INTO {$this->tableName} (project_name_th, project_name_en, project_category, project_location_th, project_location_en, project_owner,
                                                project_scope, project_type, project_department, project_status, project_value, project_area, project_description_th, 
                                                project_description_en, project_year_of_commencement, project_year_of_completion, project_active, 
                                                project_action, project_reviewstatus, created_at, user_created, updated_at, user_updated) 
                VALUES (:project_name_th, :project_name_en, :project_category, :project_location_th, :project_location_en, :project_owner,
                        :project_scope, :project_type, :project_department, :project_status, :project_value, :project_area, :project_description_th, 
                        :project_description_en, :project_year_of_commencement, :project_year_of_completion, :project_active, :project_action, 
                        :project_reviewstatus, :created_at, :user_created, :updated_at, :user_updated)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'project_name_th' => $data['project_name_th'],
            'project_name_en' => $data['project_name_en'],
            'project_category' => $data['project_category'],
            'project_location_th' => $data['project_location_th'],
            'project_location_en' => $data['project_location_en'],
            'project_owner' => $data['project_owner'],
            'project_scope' => $data['project_scope'],
            'project_type' => $data['project_type'],
            'project_department' => $data['project_department'],
            'project_status' => $data['project_status'],
            'project_value' => $data['project_value'],
            'project_area' => $data['project_area'],
            'project_description_th' => $data['project_description_th'],
            'project_description_en' => $data['project_description_en'],
            'project_year_of_commencement' => $data['project_year_of_commencement'],
            'project_year_of_completion' => $data['project_year_of_completion'],
            'project_active' => $data['project_active'],
            'project_action' => $data['project_action'],
            'project_reviewstatus' => $data['project_reviewstatus'],
            'created_at' => $data['created_at'],
            'user_created' => $data['user_created'],
            'updated_at' => $data['updated_at'],
            'user_updated' => $data['user_created']
        ]);

        return true;
    }

    public function updateProject($data) {
        $sql = "UPDATE {$this->tableName} SET project_name_th = :project_name_th,
                                              project_name_en = :project_name_en,
                                              project_category = :project_category,
                                              project_location_th = :project_location_th,
                                              project_location_en = :project_location_en,
                                              project_owner = :project_owner,
                                              project_scope = :project_scope,
                                              project_type = :project_type,
                                              project_department = :project_department,
                                              project_status = :project_status,
                                              project_value = :project_value,
                                              project_area = :project_area,
                                              project_description_th = :project_description_th,
                                              project_description_en = :project_description_en,
                                              project_year_of_commencement = :project_year_of_commencement,
                                              project_year_of_completion = :project_year_of_completion,
                                              project_active = :project_active,
                                              project_action = :project_action,
                                              project_reviewstatus = :project_reviewstatus,
                                              updated_at = :updated_at,
                                              user_updated = :user_updated
                                          WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'project_name_th' => $data['project_name_th'],
            'project_name_en' => $data['project_name_en'],
            'project_category' => $data['project_category'],
            'project_location_th' => $data['project_location_th'],
            'project_location_en' => $data['project_location_en'],
            'project_owner' => $data['project_owner'],
            'project_scope' => $data['project_scope'],
            'project_type' => $data['project_type'],
            'project_department' => $data['project_department'],
            'project_status' => $data['project_status'],
            'project_value' => $data['project_value'],
            'project_area' => $data['project_area'],
            'project_description_th' => $data['project_description_th'],
            'project_description_en' => $data['project_description_en'],
            'project_year_of_commencement' => $data['project_year_of_commencement'],
            'project_year_of_completion' => $data['project_year_of_completion'],
            'project_active' => $data['project_active'],
            'project_action' => $data['project_action'],
            'project_reviewstatus' => $data['project_reviewstatus'],
            'updated_at' => $data['updated_at'],
            'user_updated' => $data['user_updated'],
            'project_id' => $data['project_id']
        ]);

        return true;
    }

    public function deleteProject($project_id) {
        $sql = "DELETE FROM {$this->tableName} WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['project_id' => $project_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName} WHERE project_active = 1 AND project_reviewstatus = 'authorized'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function checkExistsProject($project_name_th, $project_name_en) {
        $project_name_en = strtolower($project_name_en);

        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE project_name_th = :project_name_th
                                                             OR project_name_en = :project_name_en 
                                                             LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute([
            'project_name_th' => $project_name_th,
            'project_name_en' => $project_name_en
        ]);
        $rows = $stmt->fetchAll();

        $existsProject = '';

        if(count($rows) > 0) {
            $existsProject = 1;
        }
        else {
            $existsProject = 0;
        }

        return $existsProject;
    }

    public function uploadImages($data, $files) {
        $sql = "UPDATE {$this->tableName} SET project_image = '$files',
                                              project_active = :project_active,
                                              project_action = :project_action,
                                              project_reviewstatus = :project_reviewstatus,
                                              updated_at = :updated_at,
                                              user_updated = :user_updated
                                          WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'project_active' => $data['project_active'],
            'project_action' => $data['project_action'],
            'project_reviewstatus' => $data['project_reviewstatus'],
            'updated_at' => $data['updated_at'],
            'user_updated' => $data['user_updated'],
            'project_id' => $data['project_id']
        ]);
    }

    public function deleteOriginalFile($file) {
        if($file != '') {
            //Check Original Images
            $replace_char1 = str_replace('"','', $file);
            $replace_char2 = str_replace('[','', $replace_char1);
            $replace_char3 = str_replace(']','', $replace_char2);

            $pathFile = '../../../uploads/project-images/';
            $originalFile = explode(',', $replace_char3);
            $totalOriginalFiles = count($originalFile);

            for($i=0; $i < $totalOriginalFiles; $i++) {
                if(!file_exists($pathFile.$originalFile[$i])) {
                    break;
                }
                else {
                    unlink($pathFile.$originalFile[$i]);
                }
            }
        } else {
            return false;
        }
    }

    public function deleteProjectImage($project_id) {
        $sql = "SELECT project_image FROM {$this->tableName} WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'project_id' => $project_id
        ]);
        $data = $stmt->fetchAll();

        if(is_null($data[0]['project_image'])){
        }else{
            $pathFile = '../../../uploads/project-images/';
            $decode_data = json_decode($data[0]['project_image']);
            for($i=0; $i < count($decode_data); $i++) {
                unlink($pathFile . $decode_data[$i]);
            }
        }

        return true;
    }

    public function viewImageGallery($project_id) {
        $sql = "SELECT project_name_th, project_name_en, project_image FROM {$this->tableName}
                                                                       WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'project_id' => $project_id
        ]);
        $data = $stmt->fetchAll();
        
        return $data;
    }

    public function searchProject($filter){
        $search_dep = isset($filter["check_data"]['search_dep']) ? $filter["check_data"]['search_dep'] : '' ;
        $search_cate = isset($filter["check_data"]['search_cate']) ? $filter["check_data"]['search_cate'] : '' ;
        $search_type = isset($filter["check_data"]['search_type']) ? $filter["check_data"]['search_type'] : '' ;
        $search_status = isset($filter["check_data"]['search_status']) ? $filter["check_data"]['search_status'] : '' ;
        $search_scope = isset($filter["check_data"]['search_scope']) ? $filter["check_data"]['search_scope'] : '' ;
        $search_owner = isset($filter["check_data"]['search_owner']) ? $filter["check_data"]['search_owner'] : '' ;
        $commencement_dt = isset($filter["check_data"]['commencement_dt']) ? $filter["check_data"]['commencement_dt'] : '' ;
        $commencement_df = isset($filter["check_data"]['commencement_df']) ? $filter["check_data"]['commencement_df'] : '' ;
        $completion_dt = isset($filter["check_data"]['completion_dt']) ? $filter["check_data"]['completion_dt'] : '' ;
        $completion_df = isset($filter["check_data"]['completion_df']) ? $filter["check_data"]['completion_df'] : '' ;

        $sql = "SELECT p.*, c.pcategory_name_th, c.pcategory_name_en, d.department_name, d.department_desc, o.owner_name_th, o.owner_name_en
                ,sc.scope_name_th, sc.scope_name_en, st.status_name_th, st.status_name_en, t.type_name_th, t.type_name_en
                FROM {$this->tableName} as p
                INNER JOIN project_category as c ON p.project_category = c.pcategory_id
                INNER JOIN department as d ON p.project_department = d.department_id
                INNER JOIN project_owner as o ON p.project_owner = o.owner_id
                INNER JOIN project_scope as sc ON p.project_scope = sc.scope_id
                INNER JOIN project_status as st ON p.project_status = st.status_id
                INNER JOIN project_type as t ON p.project_type = t.type_id
                WHERE p.project_active = '1' AND p.project_reviewstatus = 'authorized'";
       
        if($search_dep != '') {
            $sql .= " AND project_department = $search_dep";
        }

        if($search_cate != '') {
            $sql .= " AND project_category = $search_cate";
        }

        if($search_type != '') {
            $sql .= " AND project_type = $search_type";
        }

        if($search_status != '') {
            $sql .= " AND project_status = $search_status";
        }

        if($search_scope != '') {
            $sql .= " AND project_scope = $search_scope";
        }

        if($search_owner != '') {
            $sql .= " AND project_owner = $search_owner";
        }

        if($commencement_dt != '' && $commencement_df != '') {
            $sql .= " AND project_year_of_commencement BETWEEN $commencement_dt AND $commencement_df";
        }

        if($completion_dt != '' && $completion_df != '') {
            $sql .= " AND project_year_of_completion BETWEEN $completion_dt AND $completion_df";
        }

        if($commencement_dt != '' || $commencement_df != '') {
            $sql .= " AND project_year_of_commencement BETWEEN $commencement_dt";
            
            if($commencement_df == ''){
                $sql .= " AND $commencement_dt";
            }else{
                $sql .= " AND $commencement_df";
            }
        }

        if($completion_dt != '' || $completion_df != '') {
            $sql .= " AND project_year_of_completion BETWEEN $completion_dt";
            
            if($completion_df == ''){
                $sql .= " AND $completion_dt";
            }else{
                $sql .= " AND $completion_df";
            }
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;

    }

    public function setYearFormat() {
        $sql = "SELECT MIN(project_year_of_commencement) as oldestYearOfCommencement, 
                       MIN(project_year_of_completion) as oldestYearOfCompletion
                FROM {$this->tableName} WHERE project_year_of_commencement != 0 
                                        AND project_year_of_completion != 0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        //Check oldest year
        if($data[0]['oldestYearOfCommencement'] < $data[0]['oldestYearOfCompletion']) {
            $oldestYear = $data[0]['oldestYearOfCommencement'];
        }
        else {
            $oldestYear = $data[0]['oldestYearOfCompletion'];
        }

        //current year for thai
        $year = date('Y');
        $currentYear = $year + 543;

        $year = [$oldestYear, $currentYear];

        return $year;
    }

    //Admin Role
    public function awaitingReviews() {
        $sql = "SELECT p.*, c.pcategory_name_th, c.pcategory_name_en, d.department_name, d.department_desc, o.owner_name_th, o.owner_name_en
                ,sc.scope_name_th, sc.scope_name_en, st.status_name_th, st.status_name_en, t.type_name_th, t.type_name_en
                FROM {$this->tableName} as p
                INNER JOIN project_category as c ON p.project_category = c.pcategory_id
                INNER JOIN department as d ON p.project_department = d.department_id
                INNER JOIN project_owner as o ON p.project_owner = o.owner_id
                INNER JOIN project_scope as sc ON p.project_scope = sc.scope_id
                INNER JOIN project_status as st ON p.project_status = st.status_id
                INNER JOIN project_type as t ON p.project_type = t.type_id
                WHERE p.project_active = '0' AND p.project_reviewstatus = 'waiting for review'
                ORDER BY p.updated_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function totalAwaitingReviewCount($condition1, $condition2 = '') {
        $sql = "SELECT * FROM {$this->tableName} WHERE project_reviewstatus = '$condition1'";
        $sql .= (!empty($condition2)) ? "OR project_reviewstatus = '$condition2'" : "";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function historyReviews($condition1, $condition2 = '') {
        $sql = "SELECT p.*, c.pcategory_name_th, c.pcategory_name_en, d.department_name, d.department_desc, o.owner_name_th, o.owner_name_en
                ,sc.scope_name_th, sc.scope_name_en, st.status_name_th, st.status_name_en, t.type_name_th, t.type_name_en
                FROM {$this->tableName} as p
                INNER JOIN project_category as c ON p.project_category = c.pcategory_id
                INNER JOIN department as d ON p.project_department = d.department_id
                INNER JOIN project_owner as o ON p.project_owner = o.owner_id
                INNER JOIN project_scope as sc ON p.project_scope = sc.scope_id
                INNER JOIN project_status as st ON p.project_status = st.status_id
                INNER JOIN project_type as t ON p.project_type = t.type_id
                WHERE p.project_reviewstatus = '$condition1'";
        $sql .= (!empty($condition2)) ? "OR p.project_reviewstatus = '$condition2'" : "";
        $sql .= "ORDER BY p.updated_at DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function approveRequest($ids) {
        $countItems = count($ids);

        for($i=0; $i < $countItems; $i++) {
            $sql = "UPDATE {$this->tableName} SET project_active = '1',
                                                  project_reviewstatus = 'authorized' 
                                              WHERE project_id = $ids[$i] "; 

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        
        return true;
    }

    public function disapproveRequest($data) {
        $project_id = $data['project_id'];
        $resend_request = $data['resend_request'];
        $disapprove_reason = $data['disapprove_reason'];
        $project_action = $data['project_action'];


        if($resend_request == 'yes') {
            $sql = "UPDATE {$this->tableName} SET project_active = '0',
                                                  project_reviewstatus = 'resend request',
                                                  project_remarkstatus = '$disapprove_reason'
                                              WHERE project_id = '$project_id' "; 
        } 
        else {
            if($project_action == 'upload image' || $project_action == 'upload new image') {
                $projectObj = new Project;
                $projectObj->deleteProjectImage($project_id);
            }

            $sql = "UPDATE {$this->tableName} SET project_active = '0',
                                                  project_reviewstatus = 'unauthorized',
                                                  project_remarkstatus = '$disapprove_reason'
                                              WHERE project_id = '$project_id' "; 
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return true;
    }

    //User Role
    public function totalRequestByUser($user, $condition1, $condition2 = '') {
        $sql = "SELECT * FROM {$this->tableName} WHERE project_reviewstatus = '$condition1'";
        $sql .= (!empty($condition2)) ? "OR project_reviewstatus = '$condition2'" : "";
        $sql .= "AND user_updated = '$user' ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    public function requestListsByUser($user, $condition1, $condition2 = '') {
        $sql = "SELECT p.*, c.pcategory_name_th, c.pcategory_name_en, d.department_name, d.department_desc, o.owner_name_th, o.owner_name_en
                ,sc.scope_name_th, sc.scope_name_en, st.status_name_th, st.status_name_en, t.type_name_th, t.type_name_en
                FROM {$this->tableName} as p
                INNER JOIN project_category as c ON p.project_category = c.pcategory_id
                INNER JOIN department as d ON p.project_department = d.department_id
                INNER JOIN project_owner as o ON p.project_owner = o.owner_id
                INNER JOIN project_scope as sc ON p.project_scope = sc.scope_id
                INNER JOIN project_status as st ON p.project_status = st.status_id
                INNER JOIN project_type as t ON p.project_type = t.type_id
                WHERE p.project_reviewstatus = '$condition1'";
        $sql .= (!empty($condition2)) ? "OR p.project_reviewstatus = '$condition2'" : "";
        $sql .= "AND  p.user_updated = '$user' ORDER BY p.updated_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }


}



?>