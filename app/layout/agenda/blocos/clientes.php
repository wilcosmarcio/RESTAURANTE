
<section id="clientes" class="clientes">
    
    <div class="container">
        <div class="section-title">
          <h2>Clientes</h2>
        </div>
        <div class="row">
        <?php while($linhas_parceiros = mysqli_fetch_assoc($sql_parceiros)){ ?>
            <div class="col-lg-2" style="background-image: url('https://<?php echo $host;?>/uploads/<?php echo $linhas_parceiros['file'];?>'); background-size: 100%; height: 130px; background-repeat: no-repeat;">
                
            </div>
            <br>
        <?php } ?>
        </div>
    </div>
</section>






























