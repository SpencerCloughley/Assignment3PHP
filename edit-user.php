<?php
require('includes/auth.php');
$title='Edit User';
require('includes/header.php');

try{
$userId=$_GET['userId'];
require('includes/db.php');

$sql="SELECT * FROM users WHERE userId=:userId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
$cmd->execute();
$user=$cmd->fetch();


if (empty($page)) {
    header('location:404.php');
    exit();
}
$username=$user['username'];
}catch(Exception $e){
    header('location:error.php');
    exit();
}
?>
<main>
<h1>Edit User</h1>
    <form action="update-user.php" method="post">
            <fieldset>
                <label for="username">Username:</label>
                <textarea name="username" id="username" required><?php echo $username; ?></textarea>
            </fieldset>
            <fieldset>
            <label for="password">Change Password: *</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            <img src="img/show.png" alt="Show/Hide" id="imgShowHide" onclick="showHide()" />
        </fieldset>
        <fieldset>
            <label for="confirm">Confirm Password: *</label>
            <input type="password" name="confirm" id="confirm" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup="return comparePasswords()" />
            <span id="pwMsg" class="error"></span>
        </fieldset>
            <button class="btnOffset">Update</button>
            <input name="userId" id="userId" value="<?php echo $userId; ?>" type="hidden" />
    </form>
</main>
<?php require('includes/footer.php'); ?>