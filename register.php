<?php 

require_once 'config.php'; 

if(empty($_POST['login']) && empty($_POST['password'])){
    echo '<form action="" method="POST">
	<input name="login" placeholder="login">
	<input name="password" type="password" placeholder="password">
	<input type="submit">
    </form>';
}
if(!empty($_POST['login']) && !empty($_POST['password'])){
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "INSERT INTO users SET
    login='$login', password='$password'"; 

    mysqli_query($link, $query);

    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['auth'] = true;

    echo 'успех!';
}