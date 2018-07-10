<?php

require_once 'conexaoBD.php';
session_start();

$senha= $_POST['senhaLogin'];
$nome = $_POST['nomeLogin']; 

$consultar = "SELECT * FROM usuario WHERE senhaLogin='$senha' AND nomeLogin='$nome' ";

$result = mysqli_query($connect, $consultar);

if(!mysqli_num_rows($result)==1):
   header('Location: recuperarSenha.php');
endif;

if(mysqli_num_rows($result)==1):
   $id = mysqli_fetch_array($result); 
   $_SESSION[logado]= true;
   $_SESSION[id]=$id['id'];
   header('Location: userSession.php');
endif;

?>
