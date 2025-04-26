<?php
$collector_id = $_REQUEST['id'];
$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$collector_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'accept: application/json',
        'content-type: application/json',
        'Authorization: Bearer '.$access_token
    ),
    ));
    $response = curl_exec($curl);
    $resultado = json_decode($response);
curl_close($curl);
if($collector_id <> ''){
    if($resultado->status == 'approved'){
        $data_vencimento    = $resultado_dados['data_vencimento'];
        $meses              = $resultado_dados['meses'];
        $update = "UPDATE clientes SET
            data_vencimento    = '".date('Y-m-d', strtotime($data_vencimento . ' +'.$meses.' months'))."',
            linha_pix           = '',
            qrcode_pix          = '',
            codigo_transacao    = '',
            meses               = ''
        WHERE codigo_transacao = '".$collector_id."'";
        mysqli_query($conexao, $update);
        
        $sqlVenda="INSERT INTO pagamentos(codigo_loja, id_loja, valor, data_pagamento, meses) VALUES('".$codigo_loja."', '".$id_loja."', '".$resultado_dados['total_pagar']."', '".date('d/m/Y H:i:s')."', '".$resultado_dados['meses']."')";
        mysqli_query($conexao, $sqlVenda);
    }
}
?>