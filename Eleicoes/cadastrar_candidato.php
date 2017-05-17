<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Candidato</title>
	<link rel="stylesheet" href="css/estilo_cad.css">
	<script>
    function formatar(mascara, documento){
        var i = documento.value.length;
        var saida = mascara.substring(0,1);
        var texto = mascara.substring(i)

        if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
        }
    }
    
    </script>
    <script language="JavaScript" type="text/javascript">               
    function somente_numero(campo){
    var digits="0123456789.-"
    var campo_temp 
    for (var i=0;i<campo.value.length;i++){
      campo_temp=campo.value.substring(i,i+1)   
      if (digits.indexOf(campo_temp)==-1){
            campo.value = campo.value.substring(0,i);
            break;
       }
    }
}

    function somente_letra(campo){
    var digits="qwertyuiopasdfghjklçzxcvbnm"
    var campo_temp
    for (var j=0;j<campo.value.length;j++){
        campo_temp=campo.value.substring(j,j+1)
        if (digits.indexOf(campo_temp) ==-1){
            campo.value = campo.value.substring(0,j);
            break;
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
                <h1 class="page-header" align="center">Cadastro de Candidato</h1>
            </div>
            </div>
                <form method="post" action="cadastrar_candidato.php">
 <div class="well" id="w1">
<label id="l1">Nome :</label>
<input type="text" name="nome" id="nome" class="form-control" onKeyUp="javascript:somente_letra(this);">
<label id="l1">Partido :</label>
<input type="text" name="partido" id="partido" class="form-control" onKeyUp="javascript:somente_letra(this);">
<label id="l4">CPF :</label>
<input type="text" name="cpf" id="cpf" class="form-control" OnKeyPress="formatar('###.###.###-##', this)" onKeyUp="javascript:somente_numero(this);">
<label id="l2">Data de Nascimento :</label>
<input type="date" name="dt_nasc" id="dt_nasc" class="form-control" onKeyUp="javascript:somente_numero(this);">
<label id="l1">Cargo :</label>
<input type="text" name="cargo" id="cargo" class="form-control" onKeyUp="javascript:somente_letra(this);">

<input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-primary">
<input type="reset" name="reset" id="reset" value="Cancelar" class="btn btn-danger">
</div>
</form>
<?php
@$nome = $_POST['nome'];
@$partido = $_POST['partido'];
@$cpf = $_POST['cpf'];
@$dt_nasc = $_POST['dt_nasc'];
@$cargo = $_POST['cargo'];
@$botao = $_REQUEST['cadastrar'];
$convert_cpf = preg_replace('/[.-]/', '', $cpf);  

if($botao){
$cadastrar = mysqli_query($conexao, "INSERT into candidato values('','$nome','$partido','$convert_cpf','$dt_nasc', '$cargo')");
$select = mysqli_query($conexao, "SELECT * from candidato where cpf = '$convert_cpf'");
while($linha = mysqli_fetch_assoc($select)){
    $candidato = $linha['id_candidato'];
    $voto = mysqli_query($conexao, "INSERT into votos values('', '$candidato', '')");
}
$rows = mysqli_num_rows($cadastrar);
		if($rows > 0){
		echo "<script type='text/javascript'>alert('Não foi possível efetuar o cadastro!');window.location.href = 'cadastrar_candidato.php';</script>";
		}else{
		echo "<script type='text/javascript'>alert('Cadastro efetuado com sucesso!');window.location.href = 'Index.php';</script>";
	}
}
?>

 </div>
</body>
</html>