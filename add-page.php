    <?php 
    require('includes/auth.php');

    $title='Add Page';
    require('includes/header.php'); ?>
    <main>
        <h1>Add Page</h1>
        <a href="page-list.php">See List</a>
        <form action="saved-page.php" method="post">
            <!--All fieldsets are required as they are all needed to correctly add a song -->
            <!-- Two text area for song name and artist-->
            <fieldset>
                <label for="name">Page Name: *</label>
                <input type="text" id="name" name="name">
            </fieldset>
            <fieldset>
                <label for="content">Page Content: *</label>
                <textarea name="content" id="content" required></textarea>
            </fieldset>
            <button>Save</button>
        </form>
    </main>