<?php
require('includes/auth.php');

$title = 'Page Details';
require('includes/header.php');

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;
$userId=$_POST['userId'];

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

if($ok){
    try{
    require('includes/db.php');
    $sql="UPDATE users SET username=:username,password=:password WHERE userId= :userId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
    $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);

    $cmd->execute();
    $db=null;
    echo "User updated";
    }
    catch(Exception $e){
        header('location:error.php');
        exit();
    }
}

header('location:user-list.php');
?>

<?php require('includes/footer.php'); ?>