<?php
$conexao = mysqli_connect("localhost", "root", "", "eleicoes") or die("Erro ao estabelecer uma conexão com o banco de dados");
mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao, 'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');
?>