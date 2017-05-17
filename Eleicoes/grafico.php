<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Consulta Votos</title>
	<style type="text/css">
		.grafico{
			position: relative;
			width: 200px;	
			border: 1px solid #B1D632;
			padding: 2px;
		}
		.grafico .barra{
			display: block;
			position: relative;
			background: #B1D632;
			text-align: left;
			color: #333;
			height: 2em;
		}
		.grafico .barra span{position: absolute;left: 1em;}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
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
            <h2 class="page-header" align="center">Gráfico</h2>
            </div>
<?php
   
 $seleciona=mysqli_query($conexao,"SELECT c.*, v.* from candidato as c, votos as v where c.id_candidato = v.id_candidato");
 $somo = mysqli_query($conexao,"SELECT sum(qtd_votos) from votos");

     while ($array=mysqli_fetch_array($somo)) {
     	$soma = $array['sum(qtd_votos)'];
     	while($linha = mysqli_fetch_array($seleciona)){
     		$parte = $linha['qtd_votos'];
     		$nome = $linha['nome'];

     		$calculo = ($parte * 100)/$soma;
   ?>

   <div align="center">
<a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $linha['partido']; ?>"><?php echo "<br>".$linha['nome']; ?></a>

<div class="grafico" align="left">
<strong style="width: <?php echo (int)$calculo; ?>%" class="barra"><?php echo number_format($calculo, 1, ",", "."); ?>%</strong>
</div>
</div>
   <?php
     	}
     }

 ?>
</body>
</html>
