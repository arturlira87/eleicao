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
                <h1 class="page-header" align="center">Cadastro de Eleitor</h1>
            </div>
            </div>
               <form method="post" action="cadastrar_eleitor.php">
 <div class="well" id="w1">
<label id="l1">Nome :</label>
<input type="text" name="nome" id="nome" class="form-control" onKeyUp="javascript:somente_letra(this);">
<label id="l2">Data de nascimento :</label>
<input type="date" name="dt_nasc" id="dt_nasc" class="form-control" onKeyUp="javascript:somente_numero(this);">
<label id="l3">Título de Eleitor :</label>
<input type="text" name="titulo" id="titulo" class="form-control" onKeyUp="javascript:somente_numero(this);">
<label id="l4">CPF :</label>
<input type="text" name="cpf" id="cpf" class="form-control" OnKeyPress="formatar('###.###.###-##', this)" onKeyUp="javascript:somente_numero(this);">
<label id="l5">Telefone :</label>
<input type="text" name="telefone" id="telefone" class="form-control" OnKeyPress="formatar('##-####-####', this)" onKeyUp="javascript:somente_numero(this);">
<label id="l1">Bairro :</label>
<input type="text" name="bairro" id="bairro" class="form-control" onKeyUp="javascript:somente_letra(this);">

<input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn btn-primary">
<input type="reset" name="reset" id="reset" value="Cancelar" class="btn btn-danger">
</form>
</div>

<?php
@$nome = $_POST['nome'];
@$dt_nasc = $_POST['dt_nasc'];
@$titulo = $_POST['titulo'];
@$cpf = $_POST['cpf'];
@$telefone = $_POST['telefone'];
@$bairro = $_POST['bairro'];
@$botao = $_REQUEST['cadastrar'];
$convert_cpf = preg_replace('/[.-]/', '', $cpf);  
$convert_telefone = preg_replace('/[.-]/', '', $telefone);  
$data_atual = date("Y-m-d");


if($botao){
$tempo_dt_nasc = strtotime($dt_nasc);
$tempo_data_atual = strtotime($data_atual);
$diferenca = $tempo_data_atual - $tempo_dt_nasc;
$dias = (int)floor($diferenca/(60 * 60 * 24));
$anos = (int)floor($dias/365);
	if($anos < 16){
		echo "<script type='text/javascript'>alert('Você não tem idade suficiente para votar.');window.location.href = 'Index.php';</script>";
	}else{
		$verificar_titulo = mysqli_query($conexao, "SELECT * from eleitor where titulo = '$titulo'");
	$rows1 = mysqli_num_rows($verificar_titulo);
	if($rows1 == 1){
		echo "<script type='text/javascript'>alert('Título de eleitor já cadastrado!');window.location.href='cadastrar_eleitor.php';</script>";
	}else{
		$cadastrar = mysqli_query($conexao, "INSERT into eleitor values('', '$nome', '$dt_nasc', '$titulo', '$convert_cpf', '$convert_telefone', '$bairro', '')");
		$rows = mysqli_num_rows($cadastrar);
		if($rows > 0){
		echo "<script type='text/javascript'>alert('Não foi possível efetuar o cadastro!');window.location.href = 'cadastrar_eleitor.php';</script>";
		}else{
		echo "<script type='text/javascript'>alert('Cadastro efetuado com sucesso!');window.location.href = 'Index.php';</script>";
	}
	}
		
	}

}
?>
 </body>
</html>