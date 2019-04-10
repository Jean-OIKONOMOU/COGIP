<?php

session_start();
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

  if (empty($_POST['user_name'])||empty($_POST['email'])||empty($_POST['phone'])||empty($_POST['re_password'])) {
    exit("Please fill in all the fields of the form. <a href='./registration.php'>Return to the registration form</a>");
  }

  if ($_POST['phone']!==$_POST['re_password']) {
    exit("Please check your phone. <a href='./registration.php'>Return to the registration form</a>");
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
  $phone=addslashes($_POST['phone']);

  # DATABASE CONNECTION
    require_once("./connect.php");

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
    $sql="INSERT INTO `user` SET `user_name`='{$user_name}', `email`='{$email}', `phone`='{$phone}'";
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

<h1>AJOUT D'UNE NOUVELLE SOCIETE</h1>
<form class="" action="" method="POST">
  <table>
    <tr>
      <td>NOM DE LA SOCIETE:<input type="text" name="societe_name" value=""></td>
    </tr>
    <tr>
      <td>N° DE TVA:<input type="text" name="tva" value=""></td>
    </tr>
    <tr>
      <td>PHONE:<input type="text" name="phone" value=""></td>
    </tr>
    <tr>
      <td>TYPE DE SOCIETE:<select name="TYPE">
    <option value="Fournisseur">Fournisseur</option>
    <option value="Client">Client</option>
  </select>
    </td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" value="submit"></td>
    </tr>
  </table>
</form>
