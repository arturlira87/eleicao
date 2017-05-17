<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
	<title>Quantidade de votos</title>
	<script type="text/javascript">
            $().ready(function() {
                $("#pesquisa").autocomplete("auto_complete2.php", {
                    width: 260,
                    matchContains: true,
                    selectFirst: false
                });
            });
        </script>
</head>
<body>
<?php
include ("menu.php");
include ("conexao.php");
?>
<div class="container">
<br><br>
<div class="col-lg-12">
            <h2 class="page-header" align="center">Consultar Votos</h2>
            </div>
                  <form class="form-inline" method="post" action="qtd_votos.php" autocomplete="off">
  <div class="form-group">
    <label for="pesquisa">Digite o nome do candidato</label>
    <input type="text" class="form-control" id="pesquisa" name="pesquisa">
  </div>
  <input type="submit" name="cadastrar" id="cadastrar" value="Consultar" class="btn btn-primary">

</form>
<?php
@$nome = $_POST['pesquisa'];
@$botao = $_REQUEST['cadastrar'];

if($botao){
  echo "<br><br><br>";
 ?>
<div class="table-responsive col-md-6" align="center">
<table class="table">
  <thead>
    <tr>
      <th>Nome do Candidato</th><th>Votos</th>
    </tr>
  </thead>
  <tbody>
 <?php 

$consulta = mysqli_query($conexao, "SELECT c.nome, v.qtd_votos 
  from candidato as c, votos as v where c.id_candidato = v.id_candidato and c.nome = '$nome'");
while($linha = mysqli_fetch_assoc($consulta)){
?>
<tr>
<td><?php echo $linha['nome']; ?></td><td><?php echo $linha['qtd_votos']; ?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
<?php
}
?>

</div>
</body>
</html>

