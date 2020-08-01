<?php

    $route = $_SERVER["REQUEST_URI"];
    if($route =='/login/'){
        header('Content-Type:application/json');
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');
        header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-Control-Allow-Headers');


        $data = json_decode(file_get_contents("php://input"),true);

        $username = $data["username"];
        $password = $data["password"];

        if(preg_match('/^[a-z]+$/',$username)){
            if(preg_match('/^[a-z0-9]{6}$/',$password)){
                if(preg_match('/^.*(?=.{4,10})(?=.*\d)(?=.*[a-zA-Z]).*$/',$password)){
                    echo json_encode(array("status"=>"200","msg"=>"Success"));
                }else{
                    echo json_encode(array("status"=>"202","msg"=>"Failure: password to have 1 character and 1 number"));
                }
                
            }else{
                echo json_encode(array("status"=>"201","msg"=>"Failure: password should be of length 6"));
            }
        }else{
            echo json_encode(array("status"=>"203","msg"=>"Failure: only characterss allowed in username"));
        }
    }else{
        echo "404";
    }
    
?>