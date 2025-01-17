<?php
require('includes/header.php');
$title="Save Registration";
// grab form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate
if (empty($username)) {
    echo 'Username required.<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password required.<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords do not match.<br />';
    $ok = false;
}

if ($ok) {
    try{
    // connect
    require('includes/db.php');

    // does username already exist?
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->execute();
    $user = $cmd->fetch();
    if (empty($user)) {
        // hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // set up and run the insert using bindParam()
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();
    }
    else {
        echo 'User already exists.<br />';
        exit();
    }    
        

    // disconnect
    $db = null;
    }
    catch(Exception $e){
    header('location:error.php');
        exit();
    }

    // redirect
    header("index.php?pageId='Home'");
}
?>
<?php require('includes/footer.php'); ?>