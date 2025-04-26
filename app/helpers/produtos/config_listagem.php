<?php
$sql_img = mysqli_query($conexao,"SELECT * FROM imagem_produto WHERE id_empresa = '".$resultado_dados['id']."' and codigo_produto = '".$linhas_produtos['codigo']."' LIMIT 1") or die("Erro");
$resultado_img = mysqli_fetch_assoc($sql_img);

$sql_categoria = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE codigo = '".$linhas_produtos['codigo_categoria']."' LIMIT 1") or die("Erro");
$resultado_categoria = mysqli_fetch_assoc($sql_categoria);
				    
if($resultado_img['file'] == ''){
    $img_principal = 'sem_foto/sem_foto.jpeg';
} else {
    $img_principal = $resultado_img['file'];
}
$sql_star = mysqli_query($conexao,"SELECT sum(estrelas) FROM avaliacoes WHERE id_item = '".$linhas_produtos['id']."'") or die("Erro");
$total_star = mysqli_num_rows($sql_star);
                    
while($linhas_star=mysqli_fetch_assoc($sql_star)){
    $contar_estrelas = $linhas_star['sum(estrelas)'];
}

$sql_avaliacoes = mysqli_query($conexao,"SELECT * FROM avaliacoes WHERE id_item = '".$linhas_produtos['id']."'") or die("Erro");
$total_avaliacoes = mysqli_num_rows($sql_avaliacoes);

$sql_downloads = mysqli_query($conexao,"SELECT * FROM pedido_lista WHERE id_item = '".$linhas_produtos['id']."'") or die("Erro");
$total_downloads = mysqli_num_rows($sql_downloads);


if($contar_estrelas > 0){
    $totalmedia = $contar_estrelas / $total_avaliacoes;
} else {
    $totalmedia = '0';
}

$avaliacoes = mysqli_query($conexao,"SELECT * FROM avaliacoes WHERE id_item = '".$linhas_produtos['id']."'");
$total_avaliacoes = mysqli_num_rows($avaliacoes);
                    
$totalmedias = $contar_estrelas / $total_avaliacoes;
                    
$i = 0;
?>