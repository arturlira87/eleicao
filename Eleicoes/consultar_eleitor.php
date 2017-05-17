<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
	
  <title>Consultar Eleitor</title>
  
<script type="text/javascript">
            $().ready(function() {
                $("#pesquisa").autocomplete("auto_complete.php", {
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
            <h2 class="page-header" align="center">Consultar Eleitores</h2>
            </div>
            <div align="center">
            <form class="form-inline" method="post" action="consultar_eleitor.php" autocomplete="off">
  <div class="form-group">
    <label for="pesquisa">Digite o nome do eleitor</label>
    <input type="text" class="form-control" id="pesquisa" name="pesquisa">
  </div>
  <input type="submit" name="cadastrar" id="cadastrar" value="Consultar" class="btn btn-primary">

</form>
</div>

<?php
@$nome = $_POST['pesquisa'];
@$botao = $_REQUEST['cadastrar'];

if($botao){
  echo "<br><br><br>";
 ?>
<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
      <th>Nome</th><th>Data de Nascimento</th><th>Título de Eleitor</th><th>CPF</th><th>Telefone</th><th>Bairro</th>
    </tr>
  </thead>
  <tbody>
 <?php 

$consulta = mysqli_query($conexao, "SELECT * from eleitor where nome like '%$nome%'");
while($linha = mysqli_fetch_assoc($consulta)){
?>
<tr>
<td><?php echo $linha['nome']; ?></td><td><?php echo implode("/",array_reverse(explode("-",$linha['dt_nasc'])));?></td><td><?php echo $linha['titulo']; ?></td>
<td><?php echo $linha['cpf']; ?></td><td><?php echo $linha['telefone']; ?></td>
<td><?php echo $linha['bairro']; ?></td>
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