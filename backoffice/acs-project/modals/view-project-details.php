<?php 

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){

        require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";

    }else{

        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";

    }

        

    session_start();



    use App\Models\Project;





    if(isset($_POST['project_id'])) {

        $project_id = $_POST['project_id'];



          

        $projectObj = new Project;

        $projectDetails = $projectObj->getProjectById($project_id);



        foreach($projectDetails as $project) {

        }



        //Set Language

        if($_SESSION['lang'] == "en") {

            $project_name = "Project Name";

            $project_category = "Project Category";

            $project_type = "Project Type";

            $project_department = "Project Department";

            $project_owner = "Project Owner";

            $project_location = "Project Location";

            $project_area = "Project Area (Sq.m.)";

            $project_value = "Project Value (M.Bath)";

            $project_status = "Project Status";

            $project_scope = "Project Scope Of Service";

            $project_description = "Project Description";

            $project_year_of_commencement = "Project Year Of Commencement";

            $project_year_of_completion = "Project Year Of Completion";

            $created_date = "Created Date";

            $user_created = "User Created";

            $updated_date = "Updated Date";

            $user_updated = "User Updated";

        }

        else {

            $project_name = "ชื่อโครงการ";

            $project_category = "หมวดหมู่โครงการ";

            $project_type = "ประเภทโครงการ";

            $project_department= "แผนกที่ทำโครงการ";

            $project_owner = "เจ้าของโครงการ";

            $project_location = "ที่อยู่โครงการ";

            $project_area = "พื้นที่โครงการ (ตารางเมตร)";

            $project_value = "มูลค่าโครงการ (ล้านบาท)";

            $project_status = "สถานะโครงการ";

            $project_scope = "ขอบเขตโครงการ";

            $project_description = "รายละเอียดโครงการ";

            $project_year_of_commencement = "ปีที่เริ่มดำเนินการโครงการ";

            $project_year_of_completion = "ปีที่เสร็จสิ้นโครงการ";

            $created_date = "เวลาที่สร้างข้อมูล";

            $user_created = "ผู้ใช้ที่สร้างข้อมูล";

            $updated_date = "เวลาที่แก้ไขข้อมูลล่าสุด";

            $user_updated = "ผู้ใช้ที่แก้ไขข้อมูลล่าสุด";

        }



        $content = '<div class="row">

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_name. ' : ';             

                                if ($_SESSION['lang'] == "th") { 

                                    $content .= '<span><small class="text-main">' .$project['project_name_th']. '</small></span>';

                                }

                                else {

                                    $content .= '<span><small class="text-main">' .$project['project_name_en']. '</small></span>';

                                }

                $content .= '           

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_category. ' : ';             

                                if ($_SESSION['lang'] == "th") { 

                                    $content .= '<span><small class="text-main">' .$project['pcategory_name_th']. '</small></span>';

                                }

                                else {

                                    $content .= '<span><small class="text-main">' .$project['pcategory_name_en']. '</small></span>';

                                }

                    $content .= '           

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_type. ' : ';   

                                if ($_SESSION['lang'] == "th") { 

                                    $content .= '<span><small class="text-main">' .$project['type_name_th']. '</small></span>';

                                }

                                else {

                                    $content .= '<span><small class="text-main">' .$project['type_name_en']. '</small></span>';

                                }

                $content .= '  

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_department. ' : ';   

                                if ($_SESSION['lang'] == "th") { 

                                    $content .= '<span><small class="text-main">' .$project['department_desc']. '</small></span>';

                                }

                                else {

                                    $content .= '<span><small class="text-main">' .$project['department_name']. '</small></span>';

                                }

                $content .= '  

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_owner. ' : ';   

                                    if ($_SESSION['lang'] == "th") { 

                                        $content .= '<span><small class="text-main">' .$project['owner_name_th']. '</small></span>';

                                    }

                                    else {

                                        $content .= '<span><small class="text-main">' .$project['owner_name_en']. '</small></span>';

                                    }

                $content .= '  

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_location. ' : ';   

                                    if ($_SESSION['lang'] == "th") { 

                                        $content .= '<span><small class="text-main">' .$project['project_location_th']. '</small></span>';

                                    }

                                    else {

                                        $content .= '<span><small class="text-main">' .$project['project_location_en']. '</small></span>';

                                    }

                $content .= '  

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_area. ' : <span><small class="text-main">' .number_format($project['project_area'], 0). '</small></span>

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_value. ' : <span><small class="text-main">' .number_format($project['project_value'], 0). '</small></span>

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                            ' .$project_status. ' : ';   

                            if ($_SESSION['lang'] == "th") { 

                                $content .= '<span><small class="text-main">' .$project['status_name_th']. '</small></span>';

                            }

                            else {

                                $content .= '<span><small class="text-main">' .$project['status_name_en']. '</small></span>';

                            }

            $content .= '  

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_scope. ' : ';   

                                if ($_SESSION['lang'] == "th") { 

                                    $content .= '<span><small class="text-main">' .$project['scope_name_th']. '</small></span>';

                                }

                                else {

                                    $content .= '<span><small class="text-main">' .$project['scope_name_en']. '</small></span>';

                                }

            $content .= '  

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_description. ' : ';   

                                if ($_SESSION['lang'] == "th") { 

                                    $content .= '<span><small class="text-main">' .$project['project_description_th']. '</small></span>';

                                }

                                else {

                                    $content .= '<span><small class="text-main">' .$project['project_description_en']. '</small></span>';

                                }

        $content .= '  

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_year_of_commencement. ' : <span><small class="text-main">' .$project['project_year_of_commencement']. '</small></span>

                            </p>

                        </div>

                        <div class="col-12">

                            <p class="text-title">

                                ' .$project_year_of_completion. ' : <span><small class="text-main">' .$project['project_year_of_completion']. '</small></span>
                                
                            </p>

                        </div>';



                        if($_SESSION['user_role'] == 'admin') { 

                            $content .= '<div class="col-12">

                                            <p class="text-title">

                                                '.$created_date.' : 

                                                <span><small class="text-main">'.$project['created_at'].'</small></span>

                                            </p>

                                        </div>

                                        <div class="col-12">

                                            <p class="text-title">

                                                '.$user_created.' : 

                                                <span><small class="text-main">'.$project['user_created'].'</small></span>

                                            </p>

                                        </div>

                                        <div class="col-12">

                                            <p class="text-title">

                                                '.$updated_date.' : 

                                                <span><small class="text-main">'.$project['updated_at'].'</small></span>

                                            </p>

                                        </div>

                                        <div class="col-12">

                                            <p class="text-title">

                                                '.$user_updated.' : 

                                                <span><small class="text-main">'.$project['user_updated'].'</small></span>

                                            </p>

                                        </div>

                                        

                                        ';

                        }

        $content .= '</div>';





        $response = [

            'status' => 'success',

            'message' => 'Get project details',

            'content' => $content

        ];

    

        echo json_encode($response);

      

    }

    else {

        $response = [

            'status' => 'error',

            'message' => 'Unable to retrieve content'

        ];

    

        echo json_encode($response);

    }

