<?php

session_start();
# POUR REFRESH
if(!empty($_POST) OR !empty($_FILES))
{
$_SESSION['sauvegarde'] = $_POST ;
$_SESSION['sauvegardeFILES'] = $_FILES ;
$fichierActuel = $_SERVER['PHP_SELF'] ;
if(!empty($_SERVER['QUERY_STRING']))
{
$fichierActuel .= '?' . $_SERVER['QUERY_STRING'];
}
header('Location: ' . $fichierActuel);
exit;
}
if(isset($_SESSION['sauvegarde']))
{
$_POST = $_SESSION['sauvegarde'];
$_FILES = $_SESSION['sauvegardeFILES'];
unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);
}

# REGEX AND REDIRECTS IF FORM IS UNCORRECTLY FILLED.
if(!empty($_POST['submit'])) {

  if (empty($_POST['user_name'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['re_password'])) {
    exit("Please fill in all the fields of the form. <a href='./registration.php'>Return to the registration form</a>");
  }

  if ($_POST['password']!==$_POST['re_password']) {
    exit("Please check your password. <a href='./registration.php'>Return to the registration form</a>");
  }
#  $pattern = "/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-Z0-9]+)*\.[A-Za-Z0-9]+$/";
#  if (!preg_match(!$pattern,$_POST['email'])) {
#    exit("Please input a valid email address. <a href='./registration.php'>Return to the registration form</a>");
#  }
#  $pattern ="/^.(6,20)$/";
#  if (!preg_match(!$pattern,$_POST['password'])) {
#    exit("Password length must be between 6 and 20 characters. <a href='./registration.php'>Return to the registration form</a>");
#  }



  # USER'S ACTUAL ACCOUNT DATA.
  $user_name=addslashes($_POST['user_name']);
  $email=addslashes($_POST['email']);
  $password=addslashes($_POST['password']);

  # DATABASE CONNECTION
    require_once("connect.php");

    # CHECK IF EMAIL ALREADY EXISTS IN THE DATABASE.
    $sql="SELECT * FROM `user` WHERE `email`='{$email}'";
    $result=$db->query($sql);
    if ($db->error) {
      exit("There was an error with the SQL database. <a href='./registration.php'>Return to the registration form</a>");
    }
    if ($result->num_rows!==0) {
      exit("Email already exists in the database. <a href='./registration.php'>Return to the registration form</a>");
    }
    $result->free();

    # CHECK IF USER_NAME ALREADY EXISTS IN THE DATABASE.
    $sql="SELECT * FROM `user` WHERE `user_name`='{$user_name}'";
    $result=$db->query($sql);
    if ($db->error) {
      exit("There was an error with the SQL database. <a href='./registration.php'>Return to the registration form</a>");
    }
    if ($result->num_rows!==0) {
      exit("This username already exists in the database. <a href='./registration.php'>Return to the registration form</a>");
    }
    $result->free();

    # PASSWORD ENCRYPTION WITH MD5 HASH.
    $password = md5($password);

    # USER DATA INSERTION INTO THE DATABASE.
    $sql="INSERT INTO `user` SET `user_name`='{$user_name}', `email`='{$email}', `password`='{$password}'";
    $result=$db->query($sql);
    if ($result === true) {
      echo "Registration successful. <br/>";
    } else {
      echo "Registration failed. <br/>";
    }

    $db->close();
}
 ?>
<?php include("css.php"); ?>

<form class="" action="" method="POST">
  USERNAME:<input type="text" name="user_name" value=""><br>
  EMAIL:<input type="text" name="email" value=""><br>
  PASSWORD:<input type="password" name="password" value=""><br>
  VERIFY PASSWORD:<input type="password" name="re_password" value=""><br>
  <input type="submit" name="submit" value="submit"><br>
</form>
