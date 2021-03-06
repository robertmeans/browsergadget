<?php $layout_context = "home-first-visit"; 

if (isset($row['color'])) { // booyeah!
  $_SESSION['color'] = $row['color'];
}
require '_includes/head.php';
?>

<body <?= "onLoad=\"document.google.q.focus();\""; ?>>
<?php // set default values for search rows
  $s = array(0=>"1", 1=>"2", 2=>"3", 3=>"4", 4=>"5");
  $row['reference'] = "1";
?>
  <div class="preload"><!-- <p>centered content on page</p> --></div>

<?php require '_includes/nav.php'; ?>
  <div id="table-page">
  <div id="table-wrap">
<?php require '_includes/search_stack_top.php'; ?>

<div class="tabs new-intro">
  <p>Welcome <?= $_SESSION['username']; ?>,</p>
  <p>You don't have any projects. Let's get started!</p>
  <p>Projects are the heart of this website. There's a lot going on here. If you haven't already watched the introduction video (link also available on the login page), you can always find a quick overview there.</p>
    <form id="first-project" action="" method="post">
    <?php // ^^ submits to home_logged_in and processed by: create_new_project($row, $user_id); ?>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

      <p>Name your first project | Limit 30 characters</p>
      <input type="text" class="first-project-name" name="project_name" maxlength="30" value="<?php if (isset($_POST['project_name'])) { echo $_POST['project_name']; } ?>">

      <p>Project Notes | Limit 1,500 characters</p>
      <textarea id="textbox" name="project_notes" maxlength="1500"><?php if (isset($_POST['project_notes'])) { echo $_POST['project_notes']; } ?></textarea>

      <input type="submit" class="first-submit" name="first_project" value="Go!">

    </form>
</div><!-- .tabs .new-intro -->

<?php require '_includes/search_stack_bottom.php'; ?>
</div><!-- #table-wrap -->
</div><!-- #table-page -->
<?php require '_includes/footer.php'; ?>