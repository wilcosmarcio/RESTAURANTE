<?php
$totalpagar = $resultado_dados['total_pagar'];
$curl = curl_init();
    $dados["transaction_amount"]                    = floatval($totalpagar);
    $dados["description"]                           = 'Mensalidade Kifomi - Cardapio virtual';
    $dados["external_reference"]                    = "2";
    $dados["payment_method_id"]                     = "pix";
    $dados["notification_url"]                      = "https://".$host."/notification";
    $dados["payer"]["email"]                        = $resultado_dados['email'];
    $dados["payer"]["first_name"]                   = $resultado_dados['nome_empresa'];
    $dados["payer"]["last_name"]                    = "";
    
    $dados["payer"]["identification"]["type"]       = "CNPJ";
    $dados["payer"]["identification"]["number"]     = $resultado_dados['cnpj_empresa'];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dados),
    CURLOPT_HTTPHEADER => array(
        'accept: application/json',
        'content-type: application/json',
        'Authorization: Bearer '.$access_token
    ),
    ));
    $response = curl_exec($curl);
    $resultado = json_decode($response);
    //var_dump($resultado);
curl_close($curl);
echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/plano/checkout'>";
?>