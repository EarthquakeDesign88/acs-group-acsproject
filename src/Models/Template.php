<?php
namespace App\Models;

use App\Database\Db;

class Template extends Db {
    protected $tableName = 'template';
    protected $tableName2 = 'template_detail';
    protected $tableName3 = 'project';

    public function getAllTemplates() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getTemplateOnly($template_id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE template_id = :template_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['template_id' => $template_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getTemplateById($template_id) {
        $sql = "SELECT tp.template_name, 
                       tp.created_at as template_created, 
                       tp.user_created as template_user_created, 
                       tp.updated_at as template_updated_at, 
                       tp.user_updated as template_user_updated, 
                       td.tdetail_id,
                       p.*,
                       d.*,
                       o.*,
                       sc.*,
                       st.*,
                       t.*
                FROM {$this->tableName} as tp
                INNER JOIN {$this->tableName2} as td ON tp.template_id = td.tdetail_template_id
                INNER JOIN {$this->tableName3} as p  ON td.tdetail_project_id = p.project_id
                INNER JOIN department as d ON p.project_department = d.department_id
                INNER JOIN project_owner as o ON p.project_owner = o.owner_id
                INNER JOIN project_scope as sc ON p.project_scope = sc.scope_id
                INNER JOIN project_status as st ON p.project_status = st.status_id
                INNER JOIN project_type as t ON p.project_type = t.type_id
                WHERE template_id = :template_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['template_id' => $template_id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function createTemplate($data) {
        //Insert Template
        $sql_template = "INSERT INTO {$this->tableName} (template_name, template_language, created_at, user_created) 
                         VALUES (:template_name, :template_language, :created_at, :user_created)";
        $stmt = $this->conn->prepare($sql_template);
        $stmt->execute([
            'template_name' => $data['template_name'],
            'template_language' => $data['template_language'],
            'created_at' => $data['created_at'],
            'user_created' => $data['user_created']
        ]);


        //Get Template_id
        $sql_template_id = "SELECT MAX(template_id) as latest_id FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql_template_id);
        $stmt->execute();
        $data_template = $stmt->fetchAll();

        $template_id = $data_template[0]['latest_id'];

        
        //Insert Template Detail
        $all_projectId = $data['allProject_id'];
        $countProject = count($all_projectId);

        for($i=0; $i < $countProject; $i++) {
            $project_id = $data['allProject_id'][$i]['project_id'];


            $sql_tdetail = "INSERT INTO {$this->tableName2} (tdetail_template_id, tdetail_project_id) 
                            VALUES (:template_id, :project_id)";

            $stmt = $this->conn->prepare($sql_tdetail);
            $stmt->execute([
                'template_id' => $template_id,
                'project_id' => $project_id,
            ]);

        }


        return true;
    }

    public function updateTemplate($data) {
        //Update Template
        $sql_template = "UPDATE {$this->tableName} SET template_name = :template_name,
                                                       template_language = :template_language,
                                                       updated_at = :updated_at,
                                                       user_updated = :user_updated
                                                   WHERE template_id = :template_id";
        $stmt = $this->conn->prepare($sql_template);
        $stmt->execute([
            'template_name' => $data['template_name'],
            'template_language' => $data['template_language'],
            'updated_at' => $data['updated_at'],
            'user_updated' => $data['user_updated'],
            'template_id' => $data['template_id']
        ]);


        //Update Template Detail
        $all_projectId = $data['allProject_id'];
        $countProject = count($all_projectId);

        for($i = 0; $i < $countProject; $i++){
            $id = $data['allProject_id'][$i]['id'];
            if($id != ''){
                $sql_tdetail = "UPDATE {$this->tableName2} 
                                SET tdetail_id = :tdetail_id,
                                    tdetail_template_id = :tdetail_template_id,
                                    tdetail_project_id = :tdetail_project_id
                                WHERE tdetail_id = :tdetail_id";
                $stmt = $this->conn->prepare($sql_tdetail);
                $stmt->execute([
                    'tdetail_id' => $id,
                    'tdetail_template_id' => $data['template_id'],
                    'tdetail_project_id' => $data['allProject_id'][$i]['project_id'],
                ]);
            }else{
                $sql_tdetail = "INSERT INTO {$this->tableName2} (tdetail_template_id,tdetail_project_id)
                                VALUES (:tdetail_template_id,:tdetail_project_id)";
                $stmt = $this->conn->prepare($sql_tdetail);
                $stmt->execute([
                    'tdetail_template_id' => $data['template_id'],
                    'tdetail_project_id' => $data['allProject_id'][$i]['project_id'],
                ]);
            }
        }

        return true;
    }

    public function deleteTemplate($template_id) {
        $sql_template = "DELETE FROM {$this->tableName} WHERE template_id = :template_id";
        $stmt = $this->conn->prepare($sql_template);
        $stmt->execute(['template_id' => $template_id]);

        $sql_tdetail = "DELETE FROM {$this->tableName2} WHERE tdetail_template_id = :tdetail_template_id";
        $stmt = $this->conn->prepare($sql_tdetail);
        $stmt->execute(['tdetail_template_id' => $template_id]);

        return true;
    }

    public function deleteProject($tdetail_id) {
        $sql = "DELETE FROM {$this->tableName2} WHERE tdetail_id = :tdetail_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['tdetail_id' => $tdetail_id]);

        return true;
    }

    public function totalRowCount() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();

        return $totalRows;
    }

    
    public function checkExistsTemplate($template_name) {
        $template_name = strtolower($template_name);

        $sql_checkExists = "SELECT * FROM {$this->tableName} WHERE template_name = :template_name LIMIT 1";
        $stmt = $this->conn->prepare($sql_checkExists);
        $stmt->execute([
            'template_name' => $template_name,
        ]);
        $rows = $stmt->fetchAll();

        $existsTemplate = '';

        if(count($rows) > 0) {
            $existsTemplate = 1;
        }
        else {
            $existsTemplate = 0;
        }

        return $existsTemplate;
    }

    public function searchProject($keywords) {
        $keywords = strtolower($keywords);
        session_start();
		$sql_search = "SELECT * FROM {$this->tableName3} WHERE project_name_en LIKE '%{$keywords}%' 
                                                         OR project_name_th LIKE '%{$keywords}%'";

        $stmt = $this->conn->prepare($sql_search);
        $stmt->execute();

        $data  = $stmt->fetchAll();

        $output_search = '';
        $countData = count($data);

        for($i = 0; $i < $countData; $i++){
            if(preg_match("/^[a-zA-Z]+$/",$keywords)){
                $data[$i]['project_name'] = $data[$i]['project_name_en'];
            }else{
                $data[$i]['project_name'] = $data[$i]['project_name_th'];
            }
        }

        if($countData > 0) {
            $output_search = '<ul class="list-unstyled list_project scroll-auto" id="show_project">';
            foreach($data as $row) {
				$output_search .= '<li class="list-group-item border-1 project_row" id="'. $row['project_id'].'">' .  $row['project_name'] . '</li>';
            }
        }
        else {
            $text = $_SESSION['lang'] == "en" ? 'No search results found' : 'ไม่พบข้อมูลที่ค้นหา';
            $output_search .= '<li class="list-group-item border-1 text-center">'. $text .'</li>';
        }

        $output_search .='</ul>';

        return $output_search;
    }


}



?>