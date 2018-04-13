<?php
  require_once('../private/initialize.php');
  $current_page = "lost";

  $logged_in = True;


?>

<!doctype html>

<html lang="en">
  <head>
    <title><?php echo h($site_name); ?></title>
    <meta charset="utf-8">
    <?php
        get_jquery();
        get_bootstrap();
    ?>
  </head>

<body>
<?php if($logged_in) : ?>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><?php echo h($site_name); ?></a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="found">Found</a></li>
        <li><a href="lost">Lost</a></li>
      </ul>
    </div>
  </nav>

<div class="container-fluid">
    <a href="../private/setup_db.php" class="btn btn-info" role="button">Setup Database</a>
<div>


<?php else : ?>

  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><?php echo h($site_name); ?></a>
        </div>
      </div>
    </nav>

<?php endif; ?>


<?php if(!$logged_in) : ?>
<div class="container-fluid col-md-8 col-md-offset-0">
<form class="form-horizontal" action="../../private/login.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">username:</label>
    <div class="col-sm-2">
      <input type="username" class="form-control" id="username" placeholder="Enter username">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-2"> 
      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
  </div>
  <!--div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
    </div>
  </div-->
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</div>

<?php endif; ?>
</body>

</html>