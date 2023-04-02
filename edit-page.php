<?php 
    require('includes/auth.php');
    $title='Assignment 2';
    require('includes/header.php');

    $pageId=$_GET['pageId'];
    require('includes/db.php');
    $sql="SELECT * FROM pages WHERE pageId=:pageId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
    $cmd->execute();
    $page=$cmd->fetch();

    if (empty($page)) {
        header('location:404.php');
        exit();
    }
        $pageName=$page['pageName'];
        $content=$page['content'];
    ?>
    <h1>Edit Page</h1>
    <form action="update-page.php" method="post">
            <fieldset>
                <label for="pageName">Page Name:</label>
                <textarea name="pageName" id="pageName" required><?php echo $pageName; ?></textarea>
            </fieldset>
            <fieldset>
                <label for="content">Page Content:</label>
                <textarea name="content" id="content" required><?php echo $content; ?></textarea>
            </fieldset>
            <button class="btnOffset">Update</button>
            <input name="pageId" id="pageId" value="<?php echo $pageId; ?>" type="hidden" />
    </form>


<?php require('includes/footer.php'); ?>