
<?php

    require_once 'config.php'; 

    session_start(); 

    if(empty($_POST['password']) and empty($_POST['login'])) {
        echo '<form action="chat.php" method="POST">
        <input name="login" placeholder="login">
        <input name="password" type="password" placeholder="password">
        <input type="submit">
    </form>'; 
    }
	if (!empty($_POST['password']) and !empty($_POST['login'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		$query = "SELECT * FROM users 
			WHERE login='$login' AND password='$password'"; 
		$res = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($res);
		
		echo 'успех!' . $login; 
	}
?>