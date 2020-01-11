<!DOCTYPE html>
<html>
<head>
<title>Login de usuario</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<?php
//index.php

$error = '';
$user = '';
$pass = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["user"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your user</label></p>';
 }
 else
 {
  $user = clean_text($_POST["user"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$user))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["pass"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your pass</label></p>';
 }
 else
 {
  $pass = clean_text($_POST["pass"]);

 }

 if($error == '')
 {
  $file_open = fopen("../practica1/registros.csv", "a");
  $no_rows = count(file("../practica1/registros.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'user'  => $user,
   'pass'  => sha1($pass),
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">¡Registro exitoso!</label>';
  $user = '';
  $pass = '';
 }
}

?>

<h2>Formulario de Registro</h2>

<form method="post">
<?php echo $error; ?>
<div class="container">

    <label for="email"><b>Usuario</b></label>
    <input type="text" placeholder="Teclea tu nuevo usuario" name="user" value="<?php echo $user; ?>" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Teclea tu nuevo Password" name="pass" value="<?php echo $pass; ?>" required>

    <button type="submit" name="submit" value="Submit" class="registerbtn">Registrar usuario</button>
</div>
  
  <div class="container">
    <p>¿Ya tienes una cuenta? <a href="../practica1/index.php">Inicia sesión</a>.</p>
  </div>
</form>

</body>
</html>
