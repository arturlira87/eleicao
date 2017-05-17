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
    
        var candidato=form.candidato;
        if(candidato.value=="") {          
            alert("Digite um valor no campo!");
            candidato.focus();
            return false;           
        }
        else {
            var aprova=verificaEspacos(candidato.value);
                if(!aprova) {
                    alert("Não digite apenas espaços em branco no campo!");
                    candidato.focus();
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
<br>
 <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" align="center">Voto Secreto</h1>
            </div>
        <form method="post" action="votar.php" onSubmit="return verificaCampos(this);">
        <?php
        $candidato = mysqli_query($conexao, "SELECT * from candidato");
        while($linha = mysqli_fetch_assoc($candidato)){
        ?>
        	<div class="radio">
  			<label><input type="radio" name="candidato" value="<?php echo $linha['id_candidato']; ?>"><?php echo $linha['nome']; ?></label>
			</div>
		<?php
	}
		?>
<input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-primary">
        </form>    
</div>

<?php
@$candidato = $_POST['candidato'];
@$botao = $_POST['cadastrar'];

if($botao){
	$select = mysqli_query($conexao, "SELECT * from votos where id_candidato = '$candidato'");
    while($linha2 = mysqli_fetch_assoc($select)){
        $votos = $linha2['qtd_votos'] + 1;
        $update = mysqli_query($conexao, "UPDATE votos set qtd_votos = '$votos' where id_candidato = '$candidato'");
        $row = mysqli_num_rows($update);
	if($row > 0){
		echo "<script type='text/javascript'>alert('Não foi possível registrar seu voto!');window.location.href = 'votar.php';</script>";
	}else{
		echo "<script type='text/javascript'>alert('Voto registrado com sucesso!');window.location.href = 'Index.php';</script>";
	}

    }
}
    



?>
</body>
</html>