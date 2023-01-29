<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST,");

include_once "./db.php";

register($conn);

function register($conn){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $userName = $_POST['userName'];
    $passwd = $_POST['passwd'];
    $rPasswd = $_POST['rPasswd'];

    if(empty($fname || $lname || $userName || $passwd || $rPass)){
        http_response_code(400);
        echo "All fields are required";
        exit();
    }
    if( ! filter_var($email,FILTER_VALIDATE_EMAIL)){
        http_response_code(400);
        echo "Please enter a valid email address";
        exit();
    }

    if($passwd != $rPasswd){
        http_response_code(400);
        echo "Both password and repeat password must match";
        exit();
    }

    // hasing the password
    $passwd = password_hash($passwd,PASSWORD_DEFAULT);
    $rPasswd =$passwd 

    // sql statement
    $sql = "Insert into users (fname, lname, userName, email ,passwd, rPasswd) values (?, ?, ?, ?, ?, ?  );";
    
    // 
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "Something went wrong. Please try again !!";
        exit();
    }
    $stmt->bind_param('ssssss', $fname, $lname, $userName, $email, $passwd, $rPasswd);//six columns six strings
    $stmt->execute();
    if ($stmt->affected_rows) {
        http_response_code(200);
        echo "Congratulation!!\n Registration successful\n";
    }
    exit();

}


?>