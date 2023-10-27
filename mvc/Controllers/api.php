<?php
    
    $_SESSION['user_list'] = [];
    $mysqli = connect_db();

    if ($router["method"] == 'get'){  
        $params_arr = $router["params"];
        if ($params_arr){
            $query_result = $mysqli->query("SELECT * FROM users WHERE id='$params_arr[0]';");    
        } else {
            $query_result = $mysqli->query("SELECT * FROM users;"); 
        } 
        $data = [];
        while($row = $query_result->fetch_assoc()){
            $id = $row['id'];
            $data[$id] = $row;                
        }

        if ($data) {
            $json_data = json_encode($data);            
            //header("Content-Type: $domena/API/json");
            echo $json_data;
        } else echo "No data for this request";

    }
    

    if ($router["method"] == 'post'){  
        $params_arr = $router["params"];        
        if ($params_arr){
            $query_result = $mysqli->query("INSERT INTO users (id, name, last) VALUES ('$params_arr[0]','$params_arr[1]', '$params_arr[2]');");    
        }
        
    }

    if ($router["method"] == 'update'){  
        $params_arr = $router["params"];        
        if ($params_arr){
            $query_result = $mysqli->query("UPDATE users SET name='$params_arr[1]' last='$params_arr[2]' WHERE id='$params_arr[0]';");    
        }
        
    }

    if ($router["method"] == 'delete'){  
        $params_arr = $router["params"];        
        if ($params_arr){
            $query_result = $mysqli->query("DELETE FROM users WHERE id='$params_arr[0]';");    
        }        
    }
    
    $mysqli->close();
?>