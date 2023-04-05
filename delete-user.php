<?php
require('includes/auth.php');

$title = 'Delete User';
require('includes/header.php');

$userId = $_GET['userId'];

if (empty($userId) || !is_numeric($userId)) {
    header('location:400.php');  // bad request http 400 error
    exit();
}

try{
require('includes/db.php');


$sql = "DELETE FROM users WHERE userId = :userId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':userId', $userId, PDO::PARAM_INT);


$cmd->execute();


$db = null;
}catch(Exception $e){
    header('location:error.php');
    exit();
}
echo '<p>User Deleted</p>
    <a href="user-list.php.php">See the Updated User List</a>';

header('location:user-list.php');
?>
<?php require('includes/footer.php'); ?>