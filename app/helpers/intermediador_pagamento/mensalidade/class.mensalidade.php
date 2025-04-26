<?php
class mensalidade{
    public function gerar_pix(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $sql = mysqli_query($conexao,"SELECT * FROM clientes WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'") or die("Erro");
	    $resultado_dados = mysqli_fetch_assoc($sql);
	    if(strtotime(date('Y-m-d H:i:s')) > strtotime($resultado_dados['validade_pix'])){
    	    include('app/helpers/intermediador_pagamento/mercado_pago/config/config.php');
    	    include('app/helpers/intermediador_pagamento/mercado_pago/config/pix.php');
            $update = "UPDATE clientes SET
                codigo_transacao    = '".$resultado->id."',
                linha_pix           = '".$resultado->point_of_interaction->transaction_data->qr_code."',
                qrcode_pix          = '".$resultado->point_of_interaction->transaction_data->qr_code_base64."',
                validade_pix        = '".date('Y-m-d H:i:s', strtotime($dataInicial . ' +3 hours'))."'
            WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'";
            mysqli_query($conexao, $update);
	    }
    }
    function notification(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $sql = mysqli_query($conexao,"SELECT * FROM clientes WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'") or die("Erro");
	    $resultado_dados = mysqli_fetch_assoc($sql);
	    include('app/helpers/intermediador_pagamento/mercado_pago/config/config.php');
	    include('app/helpers/intermediador_pagamento/mercado_pago/config/notification.php');
    }
    
    function gerar(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $sql = mysqli_query($conexao,"SELECT * FROM clientes WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'") or die("Erro");
	    $resultado_dados = mysqli_fetch_assoc($sql);
	
        if(isset($_POST['BtnPagar'])){
            $meses  = str_replace($array_post, '', $_POST['meses']);
            $valor_total = $resultado_dados['valor_mensal'];
            if($meses < '1' || $meses == '1'){
                $total_pagar = $valor_total;
            }
            if($meses == '2' || $meses == '3' || $meses == '5'){
                $total_pagar    = $valor_total - ($valor_total / 100) * 5;
            }
            if($meses == '12'){
                $total_pagar    = $valor_total - ($valor_total / 100) * 10;
            }
            $total = $total_pagar * $meses;
            
            $update = "UPDATE clientes SET
            	meses       = '".$meses."',
            	total_pagar = '".number_format($total, 2, '.', '')."'
            WHERE id = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
            mysqli_query($conexao, $update);
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/plano/checkout'>";
        }
    }
}