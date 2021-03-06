<?php $layout_context = "my_projects";

require_once 'config/initialize.php';

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

if (isset($_GET['ds'])) {
	echo '<div id="success-wrap"><span class="success-msg">Delete Successful!</span></div>';
}

$user_id = $_SESSION['id'];

if (is_post_request()) {

	if(isset($_POST['go_to_homepage'])) {
		$id     			= $_SESSION['id']            		;
		$current_project   	= $_POST['current_project']  ?? ''	;

		$result = update_current_project($id, $current_project);

		if ($result === true) {
		$_SESSION['current_project'] = $current_project;

			header('location:' . WWW_ROOT);
		} else {
		$errors = $result;
		}
	}

	if(isset($_POST['edit_project'])) {
		$id     			= $_SESSION['id']            		;
		$current_project   	= $_POST['current_project']  ?? ''	;

		$result = update_current_project($id, $current_project);

		if ($result === true) {
		$_SESSION['current_project'] = $current_project;

			header('location: edit_content.php');
		} else {
		$errors = $result;
		}
	}

	if(isset($_POST['reorder_searches'])) {
		$id     			= $_SESSION['id']            		;
		$current_project   	= $_POST['current_project']  ?? ''	;

		$result = update_current_project($id, $current_project);

		if ($result === true) {
		$_SESSION['current_project'] = $current_project;

			header('location: edit_searches.php');
		} else {
		$errors = $result;
		}
	}
}

?>
<?php
$any_projects_for_user = find_users_projects($user_id);
$projects = mysqli_num_rows($any_projects_for_user);
?>
<?php require '_includes/head.php'; ?>
<body>
	<div class="preload"></div>
<?php require '_includes/nav.php'; ?>

<div id="table-page">
 	<div id="project-wrap">

 	<div class="project-greeting"><?php // special version of inner_nav just for this spot ?>
 		<?= $_SESSION['username']; ?>'s Projects | 
 		<a href="<?= WWW_ROOT ?>" class="my-nav"><div class="tooltip"><span class="tooltiptext">Homepage of last project viewed</span><i class="fas fa-house-user"></i></div></a> 

 		<a href="new_project.php" class="my-nav"><div class="tooltip"><span class="tooltiptext">Start a new project</span><i class="far fa-plus-square"></i></div></a>
 	</div>

<ul class="manage-my-projects">
<?php 
// find out if user has any projects they manage
if ($projects > 0) { //(321)
	while ($row = mysqli_fetch_assoc($any_projects_for_user)) { //(123) while this user has projects, list them. 
		$this_project = $row['project_id'];
		$sharing = show_shared_with_info($user_id, $this_project);
		
	if (($row['owner_id'] == $_SESSION['id']) || ($row['shared_with'] == $_SESSION['id'])) { //(xyz) 
			// making sure visitor is one of the users listed as either owner_id or shared_with 

	$is_it_shared = is_this_project_shared($this_project);
	$result2 = mysqli_num_rows($is_it_shared); // did we find any shared results? if so...

	if ($result2 > 0) { //(abc) we found shared results - here's a special version of results so we can 
						// display them. 

	if (($row['owner_id'] == $user_id) && ($row['shared_with'] != $user_id)) { // if you're the owner...?>
	<li>
		<div class="review-project my-projects">
			<div class="pro-left"><?= $row['project_name']; ?></div>
			<div class="pro-right"><div class="tooltip"><span class="tooltiptext">This project is shared</span><i class="fas fa-user-friends"></i></div></div> 
		</div><!-- .review-project .my-projects -->
		<div class="project-details">

		<?php /* nav for YOU owner -> sharing with others */ ?> 
		<ul class="inner-nav project-pg">
			<li>
				<form action="" method="post">
				<input type="hidden" name="current_project" value="<?= h($row['id']); ?>">
				<input type="hidden" name="current_project_name" value="<?= h($row['project_name']); ?>">
				<input type="hidden" name="go_to_homepage" value="1">

					<div class="tooltip"><span class="tooltiptext">Homepage of this project</span><a href="#" class="static" onclick="$(this).closest('form').submit()"><i class="fas fa-home fa-fw"></i></a></div>
				</form>
			</li>
			<li>
				<form action="" method="post">
				<input type="hidden" name="current_project" value="<?= h($row['id']); ?>">
				<input type="hidden" name="current_project_name" value="<?= h($row['project_name']); ?>">
				<input type="hidden" name="reorder_searches" value="1">

					<div class="tooltip"><span class="tooltiptext">Reorder search field</span><a href="#" class="static" onclick="$(this).closest('form').submit()"><i class="fas fa-sort fa-fw"></i></a></div>
				</form>
			</li>
	    <li>
	    	<a href="edit_project_details.php?id=<?= h($row['id']); ?>"><div class="tooltip"><span class="tooltiptext">Project name &amp; notes</span><i class="fas fa-info-circle fa-fw"></i></div></a>
	    </li>
	    <li>
	    	<a href="share_project.php?id=<?= h($row['id']); ?>"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a>
	    </li>
	    <li>
	    	<a href="delete_project.php?id=<?= h($row['id']); ?>"><div class="tooltip"><span class="tooltiptext">Delete project</span><i class="fas fa-minus-circle fa-fw"></i></div></a>
	    </li>
		</ul>

		<div class="shared-with">

		<?php echo "Owner: You | Sharing with: ";
		 // get names ready in case this project is shared
		 // being shardd with multiple people. add comma between names, remove last one.
		while ($row3 = mysqli_fetch_assoc($sharing)) { // while we find shared_with results, list them.
			$names[] = $row3['first_name'] . " " . $row3['last_name'] . ", ";  
		} echo rtrim(implode(array_unique($names)), ', '); // only share unique names once 
		?>

		</div>
	    <?php if(($row['project_notes']) != "") { ?>
	    	<div class="project-notes"><pre><?= h($row['project_notes']); ?><pre></div><!-- .project-notes -->
	   	<?php } ?>
		</div><!-- .project-details -->
	</li>

	<?php } else { // if you're the shared_with ?>

	<li>
		<div class="review-project my-projects">

			<div class="pro-left"><?= $row['project_name']; ?></div>
			<div class="pro-right"><div class="tooltip"><span class="tooltiptext">This project is shared</span><i class="fas fa-user-friends"></i></div></div>
			 
		</div><!-- .review-project .my-projects -->

		<div class="project-details">
		<?php /* nav for SOMEONE ELSE OWNER -> sharing with YOU */ ?>

		<ul class="inner-nav project-pg">
			<li>
				<form action="" method="post">
				<input type="hidden" name="current_project" value="<?= h($row['id']); ?>">
				<input type="hidden" name="current_project_name" value="<?= h($row['project_name']); ?>">
				<input type="hidden" name="go_to_homepage" value="1">

					<div class="tooltip"><span class="tooltiptext">Homepage of this project</span><a href="#" class="static" onclick="$(this).closest('form').submit()"><i class="fas fa-home fa-fw"></i></a></div>
				</form>
			</li>
			<li>
				<form action="" method="post">
				<input type="hidden" name="current_project" value="<?= h($row['id']); ?>">
				<input type="hidden" name="current_project_name" value="<?= h($row['project_name']); ?>">
				<input type="hidden" name="reorder_searches" value="1">

					<div class="tooltip"><span class="tooltiptext">Reorder search field</span><a href="#" class="static" onclick="$(this).closest('form').submit()"><i class="fas fa-sort fa-fw"></i></a></div>
				</form>
			</li>
	    <?php if ($row['share'] == "1") { ?>
	    <li>
	    	<a href="share_project.php?id=<?= h($row['id']); ?>"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a>
	    </li>
			<?php } ?>
		</ul>
		<?php /*
			below, need to show the current project owner's first & last name
			- and also shared_with's first and last name. these cannot be done 
			in one function because both require u.fist_name & u.last_name.
		*/ ?>
		<div class="shared-with">
		<?php echo "Project Owner: ";
		$owner = show_owner_info($this_project);
		$row4 = mysqli_fetch_assoc($owner); // this will return 1 name (first + last)
		echo $row4['first_name'] . " " . $row4['last_name']; // project owner's name
		// mysqli_free_result($owner);

		echo " | Shared with: You";

		$this_project = $row['project_id'];
		$foo = show_shared_with_info($user_id, $this_project);
		$anything_here = mysqli_num_rows($foo);

		if ($anything_here > 0) {
		while ($row3 = mysqli_fetch_assoc($foo)) { // while we find shared_with results, list them
				echo ", " . $row3['first_name'] . " " . $row3['last_name'] . " "; 
				}  //echo implode(', ', $names);
			} ?>
		</div>
		    <?php if(($row['project_notes']) != "") { ?>
		    	<div class="project-notes"><pre><?= h($row['project_notes']); ?><pre></div><!-- .project-notes -->
		   	<?php } ?>
		</div><!-- .project-details -->
	</li>
<?php }  //mysqli_free_result($owner); ?>
<?php 	 } else { // this project is not shared  ?>         
<?php // ^ (abc) ?>
	<li>
		<div class="review-project my-projects">
			<div class="pro-left">
				<?= $row['project_name']; ?>
			</div>
		</div><!-- .review-project .my-projects -->
		<div class="project-details">
		<?php /* nav for YOU owner -> not shared with anyone */ ?>
		<ul class="inner-nav project-pg">
			<li>
				<form action="" method="post">
				<input type="hidden" name="current_project" value="<?= h($row['id']); ?>">
				<input type="hidden" name="current_project_name" value="<?= h($row['project_name']); ?>">
				<input type="hidden" name="go_to_homepage" value="1">

					<div class="tooltip"><span class="tooltiptext">Homepage of this project</span><a href="#" class="static" onclick="$(this).closest('form').submit()"><i class="fas fa-home fa-fw"></i></a></div>
				</form>
			</li>
			<li>
				<form action="" method="post">
				<input type="hidden" name="current_project" value="<?= h($row['id']); ?>">
				<input type="hidden" name="current_project_name" value="<?= h($row['project_name']); ?>">
				<input type="hidden" name="reorder_searches" value="1">

					<div class="tooltip"><span class="tooltiptext">Reorder search field</span><a href="#" class="static" onclick="$(this).closest('form').submit()"><i class="fas fa-sort fa-fw"></i></a></div>
				</form>
			</li>
	    <li>
	    	<a href="edit_project_details.php?id=<?= h($row['id']); ?>"><div class="tooltip"><span class="tooltiptext">Project name &amp; notes</span><i class="fas fa-info-circle fa-fw"></i></div></a>
	    </li>
	    <li>
	    	<a href="share_project.php?id=<?= h($row['id']); ?>"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a>
	    </li>
	    <li>
	    	<a href="delete_project.php?id=<?= h($row['id']); ?>"><div class="tooltip"><span class="tooltiptext">Delete project</span><i class="fas fa-minus-circle fa-fw"></i></div></a>
	    </li>
		</ul>
	    <?php if(($row['project_notes']) != "") { ?>
	    	<div class="project-notes"><pre><?= h($row['project_notes']); ?><pre></div><!-- .project-notes -->
	   	<?php } ?>
		</div><!-- .project-details -->
	</li>
	<?php }  ?>

	<?php } //(xyz) end if owner_id == $_SESSION['id'] || shared_width == $_SESSION['id']
 	} //(123) end while loop (while this user has projects, list them)

	} else { // user has no meetings to manage
 // ^(321) -> if (projects > 0)
		header('location:' . WWW_ROOT );
		// echo "<p class=\"query-tinkerer\">You have no projects. How did you get here?</p>";
	}  mysqli_free_result($any_projects_for_user); ?>

	</ul><!-- .manage-my-projects -->
	</div><!-- #project-wrap -->
</div><!-- #table-page -->

<?php require '_includes/footer.php'; ?>