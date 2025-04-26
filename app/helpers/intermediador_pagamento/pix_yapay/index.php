<?php
    $valor_pix=$total_pagamento;
?>
<?php if($resultado_pedido['copia_pix'] <> ''){ ?>
    <center><img src="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/app/helpers/intermediador_pagamento/pix_estatico/pix.png"></center><br>
    <embed src="<?php echo $qrcode;?>" style="background-color: white;  width: 100%;">
    <h5>Linha do Pix (copia e cola):</h5>
    <textarea class="form-control" id="brcodepix" rows="<?= $linhas; ?>" cols="130" onclick="copiar()" style="width: 100%; height: 100px;" readonly><?php echo $copia_pix;?></textarea>
<?php } else { ?>
    <?php if($resultado_pedido['valor_total'] > '0'){ ?>
        <?php include('app/helpers/intermediador_pagamento/pix_yapay/gerar.php');?>
    <?php } else { ?>
        <?php include('app/layout/'.$resultado_templete_i['templete'].'/user/pedido/blocos/aprovado.php');?>
    <?php } ?>
<?php } ?>
