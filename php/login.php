<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:POST");

// importing connection from db.php
include_once "./db.php";

login($conn);

function login($conn){
    $username = $_POST['userName'];
    $pwd = $_POST['pwd'];
    // sql statement
    $sql = "select pwd from users where user_name=?;";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql))
        httpReply(400, "Something went wrong");

    $stmt->bind_param('s', $username);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $isValid = password_verify($pwd, $data['pwd']);
        if ($isValid) {
            $key = password_hash($username, PASSWORD_DEFAULT);
            $_SESSION[$key] = $username;
            setcookie('user', $key);
            http_response_code(200);
            echo 'welcome ' . $username;
        } else {
            http_response_code(401);
            echo "Invalid User name or password";
        }
    }
    exit();
}


?>