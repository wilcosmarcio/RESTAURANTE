<?php
class intermediado_pagamento {
    function pix_estatico(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        //Agendamento
        $sql_agendamento    = mysqli_query($conexao,"select * from events WHERE id_empresa = '".$resultado_dados['id']."' and codigo_agendamento = '".$url[2]."' and id_cliente = '".$id_user."' ORDER BY id DESC") or die("Erro");
        $sql_agendamentos   = mysqli_query($conexao,"select * from events WHERE id_empresa = '".$resultado_dados['id']."' and codigo_agendamento = '".$url[2]."' and id_cliente = '".$id_user."' GROUP BY codigo_agendamento ORDER BY id DESC") or die("Erro");
                    
        while($linhas_agendamento=mysqli_fetch_assoc($sql_agendamento)){ 
            $total_pagamento += $linhas_agendamento['valor'];
        }
        
        include('app/helpers/intermediador_pagamento/pix_estatico/index.php');
    }
    
    function pix_yapay(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        $sql_pedido = mysqli_query($conexao,"select * from pedidos WHERE id = '".$url[2]."' and user_id = '".$id_user."' ORDER BY id DESC") or die("Erro");
	    $resultado_pedido = mysqli_fetch_assoc($sql_pedido);
        
        $total_pagamento    = $resultado_pedido['valor_total'];
        $pedido_id          = $resultado_pedido['id'];
        $qrcode             = $resultado_pedido['qrcode_pix'];
        $copia_pix          = $resultado_pedido['copia_pix'];
        include('app/helpers/intermediador_pagamento/pix_yapay/index.php');
    }
    
    function mercado_pago(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        //Agendamento
        $sql_agendamento    = mysqli_query($conexao,"select * from events WHERE id_empresa = '".$resultado_dados['id']."' and codigo_agendamento = '".$url[2]."' and id_cliente = '".$id_user."' ORDER BY id DESC") or die("Erro");
        $sql_agendamentos   = mysqli_query($conexao,"select * from events WHERE id_empresa = '".$resultado_dados['id']."' and codigo_agendamento = '".$url[2]."' and id_cliente = '".$id_user."' GROUP BY codigo_agendamento ORDER BY id DESC") or die("Erro");
        
        $sql_dados_reserva = mysqli_query($conexao,"select * from events WHERE id_empresa = '".$resultado_dados['id']."' and codigo_agendamento = '".$url[2]."' and id_cliente = '".$id_user."' ORDER BY id DESC") or die("Erro");
	    $resultado_dados_reserva = mysqli_fetch_assoc($sql_dados_reserva);
	    
	    //VARIAVEIS DO AGENDAMENTO
            $agendamento_id     = $resultado_dados_reserva['id'];
            $copia_pix          = $resultado_dados_reserva['copia_pix'];
            $qrcode_pix         = $resultado_dados_reserva['qrcode_pix'];
        
        
        //Status do agendamento
            $agendamento_status = $resultado_dados_reserva['status'];
        
        while($linhas_agendamento=mysqli_fetch_assoc($sql_agendamento)){
            $total_pagamento += $linhas_agendamento['valor'];
        }
        
        //CONFIG PIX MERCADO PAGO
        if($copia_pix == ''){
            if(isset($_POST['gerar_pix'])){
                include('app/helpers/intermediador_pagamento/mercado_pago/config/pix.php');
            }
        }
        if($copia_pix == ''){
            include('app/helpers/intermediador_pagamento/mercado_pago/index.php');
        } 
    }
}
?>