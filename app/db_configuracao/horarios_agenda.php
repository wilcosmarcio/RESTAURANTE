<form action="" method="POST">
    <div class="row">
        <div class="col-lg-9">
            <input type="date" class="form-control" name="data" value="<?php echo $hora_consulta;?>">
        </div>
        <div class="col-lg-3">
            <button type="submit" class="btn btn-primary" name="btndata">Consultar <i class="fa fa-calendar"></i></button>
        </div>
    </div>
    
    
</form>
<?php
include('dbconfig.php');
error_reporting(0);
ini_set(“display_errors”, 0 );

date_default_timezone_set("America/Sao_Paulo");

if($_POST['data'] == ''){
        $hora_consulta          = date('Y-m-d');
    } else {
        $hora_consulta          = $_GET['data'];
    }

//Use a variável abaixo para pegar a hora automaticamente
$horaDefinida           = date('09:00');
$tempoEmMinutos         = 30;

$preco                  = '35.00';

$quantidadeIntervalos   = 20;



$interval = 0;
while($interval <= $quantidadeIntervalos){

    $horaNova = strtotime("$horaDefinida + ".$tempoEmMinutos." minutes");
    $horaNovaFormatada = date("H:i:s",$horaNova);   
    $horaDefinida = $horaNovaFormatada;

    $h = $hora_consulta.' '.$horaDefinida;
    
    
    $horas = array($h);


    foreach ($horas as $hora) {
        
        $horaNova = strtotime("$hora + ".$tempoEmMinutos." minutes");
        $horaNovaFormatada = $hora_consulta.' '.date("H:i:s",$horaNova);
    	
    	$sql_sobre = mysqli_query($conexao,"SELECT * FROM events WHERE start = '".$hora."'") or die("Erro");
	    $resultado_agendas = mysqli_fetch_assoc($sql_sobre);
    	
        if($hora <> $resultado_agendas['start'] || $horaNovaFormatada <> $resultado_agendas['end']){
            echo '<button class="btn btn-success" style="width: 100%;">'.date('d/m/Y H:i:s', strtotime($hora)).' > '.date('d/m/Y H:i:s', strtotime($horaNovaFormatada)).' <b>R$ '.$preco.'</b></button><br><br>';
        } else {
            echo '<button class="btn btn-danger" style="width: 100%;">'.date('d/m/Y H:i:s', strtotime($hora)).' > '.date('d/m/Y H:i:s', strtotime($horaNovaFormatada)).' <b>R$ '.$preco.'</b></button><br><br>';
        }
    }
    
    
    
    $interval++;

}


//Hora com acrescimos a partir de um array

?>