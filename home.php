<?php $layout_context = "home-public";
 
require_once 'config/initialize.php'; 

?>

<?php require '_includes/head.php'; ?>
<body onLoad="document.google.sr_01.focus();">
<noscript>
  <style type="text/css">
    .noscriptwrap {display:none;}
    .noscriptmsg { display:flex;width:100%;height:100vh;flex-direction:column;justify-content:center;align-items:center;color:#fff;padding:2em;font-size:16px;line-height:1.5em; }
  </style>
  <div class="noscriptmsg">
    <p>You don't have javascript enabled.</p>
    <p>Please come back when you have joined the 21st century.</p>
    <p>Seriously... how do you even?</p>
  </div>
</noscript>
<div class="noscriptwrap">

<div class="preload">
<!-- <p>centered content on page</p> -->
</div>

<?php // require '_includes/nav.php'; ?>

<div id="table-page">

 	<div id="table-wrap">

<?php require '_includes/search_stack_top.php'; ?>

<div class="tabs visitor">

<div id="landing" class="greet-login visitor1">
	<!-- <div class="visitor1"> -->
		<form class="front-login" action="login.php" method="post">

		<h3>No account? <a class="log" href="signup.php">Join Here</a></h3>

        <?php if(isset($_SESSION['message'])): ?>
        <div class="alert <?= $_SESSION['alert-class']; ?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['alert-class']); 
            ?>
        </div><!-- .alert -->
        <?php endif; ?>

        <input type="text" class="text" name="firstname" value="<?= $firstname; ?>" placeholder="First Name or Email">
        <input type="password" id="password" class="text login-pswd" name="password" placeholder="Password">

        <div class="showpassword-wrap"> 
            <div id="showLoginPass"><i class="far fa-eye"></i> Show Password</div>
        </div>

        <input type="checkbox" name="remember_me" id="remember_me">
        <label for="remember_me" class="rm-checked"> 
            <div class="rm-wrap">
                <div class="aa-rm-out">
                    <div class="aa-rm-in"></div>
                </div>
                <span class="rm-rm">Remember me</span>
            </div>
       </label>

        <input type="submit" name="login" class="submit" value="Login">

        <p class="btm-p"><a class="log" href="forgot_password.php">Forgot password?</a></p>

		</form>
	<!-- </div> -->
</div>

<div class="visitor2">
	<h1>BrowserGadget</h1>
	<p>Stop browsing the Internet like a caveman and upgrade to a Swiss Army homepage.</p>
	<p id="watchvideo"><a href="#" class="static"><i class="fab fa-youtube"></i> <span class="u">Watch this quick video</span> for the what and how.</a></p>
	<ul>
		<li>Consolidate | Organize</li>
    <li>Store bookmarks</li>
		<li>Share projects</li>
    <li>Hug strangers</li>
	</ul>
  <div class="tooltip dm"><span class="tooltiptext">In case dark isn't your thing</span><p class="dm"><i class="fas fa-star dmf"></i> Foofoo color option inside <i class="fas fa-star dml"></i></p></div>
</div>

</div><!-- .tabs .new-intro -->

<?php require '_includes/search_stack_bottom.php'; ?>

  </div><!-- #table-wrap -->
</div><!-- #table-page -->

</div><!-- .noscriptwrap -->

<div id="ytvideo" class="yt-modal">

<div class="yt-modal-content">
  <div class="yt-modal-header">
    <span class="yt-close shutterdown" onclick="stopVideo(this.getAttribute('vdoId'))" vdoId ="yvideo"><i class="fas fa-times-circle"></i></span>
    <h2>BrowserGadget | Better Browsing Awaits</h2>
  </div>

  <div class="yt-modal-wrap">
      <div class="yt-modal-body">

      <iframe id="foo" class="yvideo" width="100%" max-width="820" height="462" src="https://www.youtube.com/embed/yTVijw7oZT8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div><!-- .yt-modal-body -->

  </div><!-- .yt-modal-wrap -->
  <div class="yt-modal-footer">
    <h3>&nbsp;</h3>
  </div>

</div><!-- .yt-modal-content -->
</div><?php // #yt-modal ?>

<?php $footer_context = "visitor"; ?>
<?php require '_includes/footer.php'; ?>