<?php
include ("conexao.php");

$letra = strtolower($_GET["q"]);
if (!$letra) return;

$query = mysqli_query($conexao, "SELECT DISTINCT nome from eleitor where nome LIKE '%$letra%'");
while($linha = mysqli_fetch_array($query)) {
	$nome = $linha['nome'];
	echo "$nome\n";
}
?>