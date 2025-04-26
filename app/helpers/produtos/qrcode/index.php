
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
<div class="container">
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-6" style="background-color: <?php echo $cor;?>; border-radius: 6px;">
			<center>
			    <b>Mesa: </b><?php echo $resultado_mesas['titulo'];?>
			    <br>
			    <a href="<?php echo $aux;?>" class="btn btn-success" download>Baixar imagem</a>
				<img src="<?php echo $aux;?>" style="width: 100%;">
				
			</center>
		</div>
	</div>
</div>