<?php
session_start();          
//var_dump($_SESSION['carrinho']);
$json       = json_encode($_SESSION['carrinho']);
$resultado  = json_decode($json);


?>

<?php foreach($_SESSION['carrinho'] as $id => $qtd){ ?>
    <?php $sql_itens = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id = '".$id."'") or die("Erro"); $resultado_itens = mysqli_fetch_assoc($sql_itens);?>
    <tr> 
        <td><?php echo $resultado_itens['id'];?></td>
        <td><?php echo $resultado_itens['categoria'];?></td>
        <td><?php echo number_format($resultado_itens['preco'],2,",",".");?></td>
        <td><a href="https://<?php echo $host;?>/checkout/acao/subtrair/<?php echo $resultado_itens['id'];?>" class="btn btn-primary">-</a> <?php echo $qtd;?> <a href="https://<?php echo $host;?>/checkout/acao/somar/<?php echo $resultado_itens['id'];?>" class="btn btn-primary">+</a></td>
    </tr>
    <?php $valorTotal += $resultado_itens['preco'] * $qtd; ?>
<?php } ?>
<?php 
    $descontoCheckout   = ($valorTotal / 100) * $desconto_user;
    $totalDesconto      = $valorTotal - $descontoCheckout;
?>