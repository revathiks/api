<?php

//header("Access-Control-Allow-Origin: *");
include_once 'conn.php';

class Career extends Dbconfig {

    public function __construct() {
        parent::__construct();
    }

    public function careerPost($data) {        
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["resume"]["name"]);
        isset($data['name']) ? $name = $data['name'] : $name = "";
        isset($data['email']) ? $email = $data['email'] : $email = "";
        isset($data['resume']) ? $country = $data['country'] : $country = "";
        
        $response = array();
        $response['actionState'] = 0;
        if ($_FILES["resume"]["size"] > 500000) {
            $response['msg'] = "Sorry, your file is too large.";
            $response['status'] = "failed";
        } else {
            if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
                $response['msg'] ="The file " . basename($_FILES["resume"]["name"]) . " has been uploaded.";
                $response['status'] ="success";
            } else {
                $response['status'] = "failed";
                $response['msg']="Sorry, there was an error uploading your file.";
            }
        }

        
        return $response;
    }

}

?>