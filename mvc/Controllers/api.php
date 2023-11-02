<?php
    

    $_SESSION['user_list'] = [];

    $method = $router->method;
    $params_arr = $router->params ?? null;


    if ($method == 'get'){          
        if ($params_arr){            
            $data[] = $db->load_user_data_id($params_arr[0]);
        } else {
            $data = [];
            $query_result = $db->load_users();
            while($row = $query_result->fetch_assoc()){            
                $data[] = $row;                
            }  
        }                                        
    
        if ($data[0]) {                                   
            $fp = fopen('data.csv', 'w');
            
            foreach ($data as $row) {
                fputcsv($fp, $row);
            }            
            fclose($fp);
            header("Content-Type: application/json");                
            echo readfile('data.csv');
    
        } else {            
            header("Content-Type: application/json");  
            echo "Requested user does not exist";
        }

    } else {    

        $mysqli = $db->open();

        if ($method == 'post'){                
            try {
                if (count($params_arr) > 2){
                    $user = $db->load_user_data($params_arr[2]);
                    if ($user == null){                                  
                        $mysqli->query("INSERT INTO users (name, last, email) VALUES ('$params_arr[0]','$params_arr[1]', '$params_arr[2]');");
                        if (!$mysqli->error) echo "User $params_arr[2] was added successfully";
                    } else echo "This email is already in use";
                } else echo "Not enough params";
            } catch (Exception $e) {
                echo "wrong or not enough params";
            }
        }         
        else if ($method == 'update' && $params_arr){                               
            $user = $db->load_user_data_id($params_arr[0]);                                
            if ($user) {
                if (count($params_arr) > 2){
                    $mysqli->query("UPDATE users SET name='$params_arr[1]', last='$params_arr[2]' WHERE id=$params_arr[0];");
                    echo "User $user[email] was updated successfully";
                } else echo "Not enough params";
            }
            else echo "Wrong ID parameter";
        }
        else if ($method == 'delete' && $params_arr){        
            $user = $db->load_user_data_id($params_arr[0]);              
            if ($user) {
                $db->delete_user($params_arr[0]);                    
                echo "User $user[email] was deleted successfully";
            }
            else echo "Wrong ID parameter";
        } else echo "Incorrect API request or missing/wrong params";

        if ($mysqli->error){
            echo "Incorrect API request params";
        }

        $mysqli->close();
        header("Content-Type: application/json");                    
    }    
    
?>