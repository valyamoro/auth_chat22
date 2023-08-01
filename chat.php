<?php

require_once 'config.php';

session_start();

if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
    $login = $_POST['login'];
    $password = $_POST['password'];

    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
}


const MESSAGES_FILE = "data/messages.txt"; 

if(!file_exists(MESSAGES_FILE)){
    file_put_contents(MESSAGES_FILE, "{}"); 
}

$fileText = file_get_contents(MESSAGES_FILE);
$messagesArray = json_decode($fileText, true);

$message = $_POST["user_message"] ?? null; 
$login = $_SESSION["login"] ?? null; 

if($message && $login){
    $userMessage = htmlspecialchars($_POST["user_message"]); 

    $messagesArray[] = [
        'login' => $login,
        'message' => $userMessage,
    ];
    file_put_contents(MESSAGES_FILE, json_encode($messagesArray)); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Чат</title>
</head>
<body>
    <?php 
    if(isset($_SESSION['login']) && isset($_SESSION['password'])){
        foreach($messagesArray as $message){
            echo "<p>" . $login . "</p>";  
            echo "<p>" . $message['message'] . "</p>"; 
            echo '---------------------------------------'; 
        }
        echo '<form method="post">
        <input type="text" name="user_message">
        <input type="submit">
        </form>';
    }
    else if(!isset($_SESSION['login']) && !isset($_SESSION['password'])){
        echo '!isset'; 
    }
    ?>
  
</body>
</html>