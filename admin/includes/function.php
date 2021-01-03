<?php  

// Header function / Location function
function redirect($location){
    
    return header("Location:" . $location);
}

//Security escaping
function escape($string){

    global $db_connect;

    return mysqli_real_escape_string($db_connect, trim(strip_tags($string)));
    

}



// Testing Query 
function confirm($result){
    
    global $db_connect;
    
    if(!$result){
        
        die("<h1>QUERY FAILD</h1>" . mysqli_error($db_connect));
    }
    
}


// User Online count
//function users_online() {
//
//
//
//    if(isset($_GET['onlineusers'])) {
//
//    global $db_connect;
//
//    if(!$connection) {
//
//        session_start();
//
//        include("../includes/db.php");
//
//        $session = session_id();
//        $time = time();
//        $time_out_in_seconds = 05;
//        $time_out = $time - $time_out_in_seconds;
//
//        $query = "SELECT * FROM users_online WHERE session = '$session'";
//        $send_query = mysqli_query($db_connect, $query);
//        $count = mysqli_num_rows($send_query);
//
//            if($count == NULL) {
//
//                mysqli_query($db_connect, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
//
//
//            } else {
//
//                mysqli_query($db_connect, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
//
//
//            }
//
//        $users_online_query =  mysqli_query($db_connect, "SELECT * FROM users_online WHERE time > '$time_out'");
//        echo $count_user = mysqli_num_rows($users_online_query);
//
//
//    }
//
//
//    } // get request isset()
//
//
//}
//
//users_online();
//
//



// Add Data within Category
function insert_category(){
    
    global $db_connect;
    
    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){

            echo "<h2 class='bg-danger text-danger'>This fild should not be Empty</h2>";

        }
        else{

        $query = "INSERT INTO categories(cat_title)";
        $query .= "VALUE('{$cat_title}') ";

        $creat_category_query = mysqli_query($db_connect, $query);

            if(!$creat_category_query){   
            
                die("<h1>QUERY FAILD.</h1>" . mysqli_error($db_connect));
            
            }  

        }

    }

}



//DELETE DATA FROM CATEGORY 
function delete_category(){

    global $db_connect;
    
    if(isset($_GET['delete'])){

        $get_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id} ";
        $delete_query = mysqli_query($db_connect, $query);
        header("Location: Category.php");


    }

}

//CATEGORY TABLE

function category_table(){

    global $db_connect;

    $query = "SELECT * FROM categories";
    $select_cetagories = mysqli_query($db_connect, $query);

    while($row = mysqli_fetch_assoc($select_cetagories)){

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";

        echo  "<td>{$cat_id}</td>";
        echo  "<td>{$cat_title}</td>";
        echo  "<td><a class='btn btn-info' href='category.php?edit={$cat_id}'><i class='fa fa-edit' style='font-size: 15px;'></a></td>";
        echo  "<td><a class='btn btn-danger' href='category.php?delete={$cat_id}'><i class='fa fa-trash' style='font-size: 15px;'></a></td>";

        echo "</tr>";


    }    
}

//Admin Dashboar recoard Count


function recordCount($table){
    
    
    global $db_connect;
    
    $query = "SELECT * FROM " . $table;
    $select_all = mysqli_query($db_connect, $query);
    
    $result = mysqli_num_rows($select_all);
    
    confirm($result);
    
    return $result;
    
    
    
    
}


//Checking Status on Dashboard


function checkStatus($table, $colum, $status){
    
    global $db_connect;
    
    $query = "SELECT * FROM $table WHERE $colum = '$status' ";
    $result = mysqli_query($db_connect, $query);
     
    confirm($result);
    
    return mysqli_num_rows($result);
    
        
}

//Checking User_role on Dashboard


function checkUsreRole($table, $colum, $role){
    
    global $db_connect;
    
    $query = "SELECT * FROM $table WHERE $colum = '$role' ";
    $result = mysqli_query($db_connect, $query);
     
    confirm($result);
    
    return mysqli_num_rows($result);
    
        
}

//Admim detction feature

function is_admin($username){

    global $db_connect;

    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $result = mysqli_query($db_connect, $query);
    confirm($result);
    
    $row = mysqli_fetch_array($result);
    
    if($row['user_role'] == 'admin'){

        return true;
    }
    else{

        return false;
    }
}


//Naver exists same username function

function username_exists($username){
    
    global $db_connect;
    
    
    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($db_connect, $query);
    confirm($result);
    
    
    if(mysqli_num_rows($result) > 0){
         
        return true;
    
    }else{
    
        return false;
    }
  
}

//Naver exists same Email function

function email_exists($email){
    
    global $db_connect;
    
    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($db_connect, $query);
    confirm($result);
    
    
    if(mysqli_num_rows($result) > 0){
         
        return true;
    
    }else{
    
        return false;
    }
    
}


  
// Registation function
function register_user($username, $email, $password){
    
    global $db_connect;
            
            $username = mysqli_real_escape_string($db_connect, $username);
            $email = mysqli_real_escape_string($db_connect, $email);
            $password = mysqli_real_escape_string($db_connect, $password);

            $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));
            
            $query = "INSERT INTO users(username, user_email, user_password, user_role ) ";
            
            $query .= "VALUES( '{$username}', '{$email}', '{$password}', 'subscriber' )";
            
            $register_user_query = mysqli_query($db_connect, $query);
                

            confirm($register_user_query);    
}




function login_user($username, $password){
    
    global $db_connect;

    $username = trim($username);
    $password = trim($password);
    
    // This thing only security purpose
    $username = mysqli_real_escape_string($db_connect, $username);
    $password = mysqli_real_escape_string($db_connect, $password);
    
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($db_connect, $query);
    if(!$select_user_query){
        die("<h1>QUERY FAILD</h1>" . mysqli_error($db_connect));
    }
    
   while($row = mysqli_fetch_array($select_user_query)){

        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        
    }

    
    if(password_verify($password, $db_user_password)){
        
        //SESSION'S ID
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
            
        redirect("../admin");  
    }
    else{
        
        redirect("../index.php");  
    
    }
    
    
    
    
}












 










?>