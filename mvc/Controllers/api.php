<?php
    include "Models/users.php";

    $_SESSION['user_list'] = [];

    $method = $this->router->method;
    $params_arr = $this->router->params ?? null;


    if ($method == 'get'){          
        if ($params_arr){            
            $data[] = load_user_data($params_arr[0]);
        } else {
            $data = [];
            $query_result = load_users();
            while($row = $query_result->fetch_assoc()){            
                $data[] = $row;                
            }  
        }                                        
        
        if ($data) {                                   
            $fp = fopen('data.csv', 'w');
            
            foreach ($data as $row) {
                fputcsv($fp, $row);
            }            
            fclose($fp);
            //header("Content-Type: application/json");                
            echo readfile('data.csv');
    
        } else echo "Requested user does not exist";

    } else {    
        $mysqli = $db->open();
        if ($method == 'post'){                
            if ($params_arr){                  
                $mysqli->query("INSERT INTO users (name, last, email) VALUES ('$params_arr[0]','$params_arr[1]', '$params_arr[2]');");
            }            
        } 
        else if ($method == 'update'){       
            if ($params_arr){
                
                //$user = load_user_data($params_arr[0])->fetch;                
                $query_result = $mysqli->query("UPDATE users SET name='$params_arr[1]' last='$params_arr[2]' WHERE id=$params_arr[0];");                    
            }            
        }
        else if ($method == 'delete'){        
            if ($params_arr){
                delete_user($params_arr[0]);
            }        
        } else {
            echo "Incorrect API request";
        }
        $mysqli->close();
        //header("Content-Type: application/json");            
        
    }
    
    
?>