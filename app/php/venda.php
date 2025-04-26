<?php
//VIEWS
include('app/helpers/views/class.views.php');
$object_views = new views;
$object_views->geral();
?>
<?php session_start();?>
<?php if($_SESSION['nivel_usuario'] == '3'){ ?>
<?php
    //pedidos
    $sql_pedidos            = mysqli_query($conexao,"select * from pedidos WHERE id = '".$url[1]."' ORDER BY id DESC") or die("Erro");
        
        
        
    $sql_dados_pedido = mysqli_query($conexao,"select * from pedidos WHERE id = '".$url[1]."' ORDER BY id DESC") or die("Erro");
    $resultado_dados_pedido = mysqli_fetch_assoc($sql_dados_pedido);
    
    $valor_total    = $resultado_dados_pedido['valor_total'] - $resultado_dados_pedido['desconto'];
    $totalPagamento = $resultado_dados_pedido['valor_total'];
    $totalDesconto  = $resultado_dados_pedido['desconto'];
    
    $user_id        = $resultado_dados_pedido['user_id'];
        
    //VARIAVEIS DO AGENDAMENTO
    $pedido_id          = $resultado_dados_pedido['id'];
    $pedido_status      = $resultado_dados_pedido['status'];
    if($resultado_dados_pedido['status'] == '1'){
        $status      = 'Pendente';
    }
        
    if($resultado_dados_pedido['status'] == '2'){
        $status      = 'Finalizado';
    }
        
    if($resultado_dados_pedido['status'] == '3'){
        $status      = 'Cancelado';
    }
            
    $sql_items          = mysqli_query($conexao,"select * from pedido_lista WHERE pedido_id = '".$pedido_id."' ORDER BY id DESC") or die("Erro");
    $sql_items_total    = mysqli_query($conexao,"select * from pedido_lista WHERE pedido_id = '".$pedido_id."' ORDER BY id DESC") or die("Erro");
        
    while($linhas_pedidos=mysqli_fetch_assoc($sql_items_total)){ 
        $total_pagamento += ($linhas_pedidos['preco'] * $linhas_pedidos['qtde']);
    }
    
    $sql_user_cookie = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE id = '".$user_id."' ORDER BY 'id'") or die("Erro");
	$resultado_user_cookie = mysqli_fetch_assoc($sql_user_cookie);
	
	//variaveis login
    $nome_user          = $resultado_user_cookie['nome'];
    $telefone_user      = $resultado_user_cookie['telefone'];
    $email_user         = $resultado_user_cookie['email'];
    $cpf_user           = $resultado_user_cookie['cpf'];
    $cep_user           = $resultado_user_cookie['cep'];
    $rua_user           = $resultado_user_cookie['rua'];
    $numero_user        = $resultado_user_cookie['numero'];
    $bairro_user        = $resultado_user_cookie['bairro'];
    $cidade_user        = $resultado_user_cookie['cidade'];
    $uf_user            = $resultado_user_cookie['uf'];
    $desconto_user      = $resultado_user_cookie['desconto'];
	$nivel_user         = $resultado_user_cookie['nivel_usuario'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pedido: <?php echo $pedido_id;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <center>
                <img src="https://<?php echo $host;?>/uploads/<?php echo $resultado_logo['file'];?>" style="width: 35%;">
                <h3>Pedido: <?php echo $pedido_id;?></h3>
            </center>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
            <p class="mb-2">Telefones</p>
            <h6 class="mb-0"><?php echo $resultado_sobre['telefone'];?> <br> <?php echo $resultado_sobre['telefone_2'];?></h6>
            <p>Endereço: <?php echo $resultado_sobre['rua'];?>, <?php echo $resultado_sobre['bairro'];?> - <?php echo $resultado_sobre['cidade'];?></p>
        </div>
    </div>
    <hr>
            <div class=" mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-primary px-3">Total</h6>
                <h1 class="display-6 mb-4">R$ <?php echo number_format($valor_total,2,",",".");?></h1>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                        <b>Nome: <?php echo $nome_user;?> <br> <?php echo $telefone_user;?></b>
                        <hr>
                        <b>Endereço de cadastro:</b>
                        <br>
                        <?php echo $rua_user;?>, <?php echo $numero_user;?>, <?php echo $bairro_user;?> - <?php echo $cidade_user;?>-<?php echo $uf_user;?>
                    <hr>
                    
                    <?php if($pedido_status == '3'){ ?>
                        <h3>Pedido cancelado!</h3>
                        
                    <?php }?>
                    <br><br>
                </div>
                <div class="col-lg-6">
                    <center><h6 class="section-title bg-white text-center text-primary px-3">Produtos</h6></center>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Preço</th>
                                <th>Qtde</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($linhas_agendamentos=mysqli_fetch_assoc($sql_items)){ ?>
                                <tr>
                                    <th><?php echo $linhas_agendamentos['titulo'];?></th>
                                    <th><?php echo number_format($linhas_agendamentos['preco'],2,",",".");?></th>
                                    <th><?php echo $linhas_agendamentos['qtde'];?></th>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <table class="table">
                    <tr> 
                        <td><b>SubTotal:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($totalPagamento,2,",",".");?></td>
                    </tr>
                    <tr> 
                        <td><b>Desconto:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($totalDesconto,2,",",".");?></td>
                    </tr>
                    <tr> 
                        <td><b>Valor total:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($valor_total,2,",",".");?></td>
                    </tr>
                </table>
                    
                    <b>Status: <?php echo $status;?></b>
                </div>
            </div>
            
        </div>

<script type="text/javascript">window.print();</script>
</html>
<?php } else { ?>
    <b style="color: red;">Acesso negado!</b><br> Você precisa logar para ter acesso as informações.
<?php } ?>











