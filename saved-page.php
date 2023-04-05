    <?php 
    $title='Saving Page..';
    require('includes/header.php');?>

    <section>
        <?php
        $ok = true;
        //all variables sent over by the previous form
        $name = $_POST['name'];
        $content = $_POST['content'];

        //verification for each variable depnding on what is required
        if (empty($name)) {
            echo '<p>Page name is required</p>';
            $ok = false;
        }

        if (empty($content)) {
            echo '<p>Page content is required</p>';
            $ok = false;
        }

        if ($ok) {
            try{
            require('includes/db.php');
            $sql = "INSERT INTO pages (pageName,content) VALUES(:name, :content)";

            //prepare and add each variable to be included in the SQL statement
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
            $cmd->bindParam(':content', $content, PDO::PARAM_STR, 255);

            $cmd->execute();

            $db = null;

            echo "Page added";
            }catch(Exception $e){
                header('location:error.php');
                exit();
            }
            
        }
        ?>
    </section>

    <a href="page-list.php">See List</a>

    <?php require('includes/footer.php'); ?>