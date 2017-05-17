<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<script>
 function showTimer() {
  var time=new Date();
  var hour=time.getHours();
  var minute=time.getMinutes();
  var second=time.getSeconds();
  if(hour<10)   hour  ="0"+hour;
  if(minute<10) minute="0"+minute;
  if(second<10) second="0"+second;
  var st=hour+":"+minute+":"+second;
  document.getElementById("timer").innerHTML=st; 
 }
 function initTimer() {
  // O metodo nativo setInterval executa uma determinada funcao em um determinado tempo  
  setInterval(showTimer,1000);
 }
</script>
</head>
<body onload="initTimer();">
<?php
include ("menu.php");
?>
<div class="container">
<br><br>
<div class="col-lg-12">
                <h2 class="page-header" align="center">Bem Vindo as Eleicões de <?php echo date("Y"); ?></h2>
                <div align="right"><b>Hora Atual: </b><span id="timer">Relógio</span></div>
                <div align="center">
                <img src="img/vote.jpg" class="img-rounded" alt="Cinque Terre" width="800" height="500">
                </div>
            </div>
</div>
</body>
</html>