<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT,");

include_once "./db.php";


updateUser($conn);

function updateUser($conn){
    if (!isset($_COOKIE['user']))
        httpReply(403, "you are not logged in");

    $sql = "update users set first_name = ?, last_name=?, user_name=?,  email=?, pwd=?, r_pwd=? where user_name=?;";

    $stmt = $conn->stmt_init();

    parse_str(file_get_contents("php://input"), $_PATCH);

    $password = password_hash($_PATCH['pwd'], PASSWORD_DEFAULT);
    $stmt->prepare($sql);
    $stmt->bind_param('sssssss', $_PATCH['fName'], $_PATCH['lName'], $_PATCH['userName'], $_PATCH['email'], $password, $password, $_SESSION[$_COOKIE['user']]);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $userHash = password_hash($_PATCH['userName'], PASSWORD_DEFAULT);
            $_SESSION[$userHash] = $_PATCH['userName'];
            setcookie('user', $userHash);
            http_response_code(200);
            echo "record updated";
        } else {
            echo 'row not affected';
        }
    }
}


?>