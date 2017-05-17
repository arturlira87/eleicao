<!DOCTYPE html>
<html>
<head>
	<title>Votar</title>
	<script>
 /*
 	Script writed by Mario Bruno Morais Aliste
 */
 	
 function verificaEspacos(string) {
 
	var cont=0;
		for(var i=0;i<string.length;i++)
			if(string.substring(i,i+1)==" ") cont++;
		if(cont==string.length)	
			return false; 
		else
			return true;	
			
 }
 
 function verificaCampos(form) {
 	
 		var titulo=form.titulo;
		if(titulo.value=="") {			
			alert("Digite um valor no campo!");
			titulo.focus();
			return false;			
		}
		else {
			var aprova=verificaEspacos(titulo.value);
				if(!aprova) {
					alert("Não digite apenas espaços em branco no campo!");
					titulo.focus();
					return false;
				}
				else {
					return true;
				}
		}		
 	
 }
</script>
</head>
<body>
	<?php
require ("menu.php");
require ("conexao.php");
?>
<br><br>
 <div class="container">

				<div class="row">
						<div class="col-lg-12">
								<h1 class="page-header" align="center">Voto Secreto</h1>
						</div>
						<div align="center">
						 <form class="form-inline" method="post" action="voto.php" onSubmit="return verificaCampos(this);">
	<div class="form-group">
		<label for="eleitor">Digite o titulo de eleitor :</label>
		<input type="text" class="form-control" id="eleitor" name="titulo">
	</div>
	<br><br>
<input type="submit" name="cadastrar" id="cadastrar" value="Votar" class="btn btn-primary">
</form>
</div>
						</div>
	</div>
	<?php
@$titulo = $_POST['titulo'];
@$botao = $_POST['cadastrar'];

if($botao){  
$verificar_titulo = mysqli_query($conexao, "SELECT * from eleitor where titulo = '$titulo'");
$verificar_voto = mysqli_query($conexao, "SELECT * from eleitor where voto = 1 and titulo = '$titulo'");
$rows1 = mysqli_num_rows($verificar_titulo);
$rows2 = mysqli_num_rows($verificar_voto);

if($rows2 == 1){
	echo "<script type='text/javascript'>alert('O(a) senhor(a) já votou nessas eleições. Por favor aguarde novas eleições!');window.location.href = 'cadastrar_eleitor.php';</script>";
}else{
	if($rows1 == 1){
		$votou = mysqli_query($conexao, "UPDATE eleitor set voto = 1 where titulo = '$titulo'");
		echo "<script type='text/javascript'>alert('Vote com consciência');window.location.href = 'votar.php';</script>";
		}else{
		echo "<script type='text/javascript'>alert('Título de eleitor não cadastrado!');window.location.href = 'cadastrar_eleitor.php';</script>";
	}
}

}

	?>
</body>
</html>