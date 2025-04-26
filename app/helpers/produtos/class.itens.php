<?php
class produtos {
        
function catPizza(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $sql_pizza = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and url = 'pizza'") or die("Erro");
	$resultado_pizza = mysqli_fetch_assoc($sql_pizza);
	
    if($resultado_pizza['id'] == ''){
        $sql_catPizza="INSERT INTO categoria_produtos (
            codigo_loja,
            id_loja,
            url,
            titulo
        ) VALUES(
            '".$codigo_loja."',
            '".$id_loja."',
            'pizza',
            'Pizzas'
        )";
        mysqli_query($conexao, $sql_catPizza);
    }
}

function cadProdutoAdmin(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'precovenda_') === 0) {
                $registro_id = substr($key, strpos($key, '_') + 1);
                
                $id             = mysqli_real_escape_string($conexao, $_POST['id_' . $registro_id]);
                $preco_venda    = mysqli_real_escape_string($conexao, $_POST['precovenda_' . $registro_id]);
                $preco_custo    = mysqli_real_escape_string($conexao, $_POST['precocusto_' . $registro_id]);
                $estoque        = mysqli_real_escape_string($conexao, $_POST['estoque_' . $registro_id]);
                $categoria      = mysqli_real_escape_string($conexao, $_POST['categoria']);
                if($preco_venda <> ''){
                    $sql_FaixaCepAdministrativo = mysqli_query($conexao,"SELECT * FROM ProdutosAdmin WHERE id = '".$id."'") or die("Erro");
                    $resultado_FaixaCepAdministrativo	= mysqli_fetch_assoc($sql_FaixaCepAdministrativo);
                    
                    $sql="INSERT INTO cadastrofeed(
                    titulo,
                    preco_venda,
                    preco_custo,
                    IdAdministrativo,
                    file,
                    estoque,
                    codigo_loja,
                    id_loja,
                    categoria,
                    status,
                    ean
                    ) VALUES(
                        '".$resultado_FaixaCepAdministrativo['titulo']."',
                        '".$preco_venda."',
                        '".$preco_custo."',
                        '".$id."',
                        '".$resultado_FaixaCepAdministrativo['url']."',
                        '".$estoque."',
                        '".$codigo_loja."',
                        '".$id_loja."',
                        '".$categoria."',
                        '2',
                        '0'
                        )";
                    mysqli_query($conexao, $sql);
                }
            }
        }
    }
    echo json_encode(['status' => 'ok']);
}

function ListagemAdministrativo(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    $sql_FaixasCEP = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and IdAdministrativo <> ''") or die("Erro");
    $total_FaixasCEP = mysqli_num_rows($sql_FaixasCEP);
    while($linhas_FaixasCEP=mysqli_fetch_assoc($sql_FaixasCEP)){
        $idCep    .= $linhas_FaixasCEP['IdAdministrativo'].', ';
    }
    $ids = $idCep;
    if($total_FaixasCEP > 0){
        $sql_ceps = mysqli_query($conexao,"SELECT * FROM ProdutosAdmin WHERE titulo LIKE '%".str_replace('-', ' ', $url[2])."%' and id NOT IN (".substr($ids, 0, -2).")") or die("Erro");
    } else {
        $sql_ceps = mysqli_query($conexao,"SELECT * FROM ProdutosAdmin WHERE titulo LIKE '%".str_replace('-', ' ', $url[2])."%'") or die("Erro");
    }
    $total_registro = mysqli_num_rows($sql_ceps);
    ?>
    
    <b>Categoria:</b>
    <select class="form-control" name="categoria">
        <?php while($linhas_cat=mysqli_fetch_assoc($sqlCategoriasModal)){ ?>
            <option value="<?php echo $linhas_cat['id'];?>"><?php echo $linhas_cat['titulo'];?></option>
        <?php } ?>
    </select>
    <br>
    Produtos encotrados: <?php echo $total_registro;?>
    <table class="table">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Titulo</th>
                <th>Valor venda</th>
                <th>Valor compra</th>
                <th>Estoque</th>
            </tr>
        </thead>
        <tbody>
            <?php while($linhas_ceps=mysqli_fetch_assoc($sql_ceps)){ ?>
                <tr>
                    <td><img src="<?php echo $linhas_ceps['url'];?>" style="width: 50px;"></td>
                    <td><?php echo $linhas_ceps['titulo'];?></td>
                    <td><input type="text" name="precovenda_<?php echo $linhas_ceps['id']; ?>" class="form-control" placeholder="Preço venda" onKeyPress="return(myfunction(this,'','.',event))"></td>
                    <td><input type="text" name="precocompra_<?php echo $linhas_ceps['id']; ?>" class="form-control" placeholder="Preço compra" onKeyPress="return(myfunction(this,'','.',event))"></td>
                    <td><input type="text" name="estoque_<?php echo $linhas_ceps['id']; ?>" class="form-control" placeholder="Estoque"></td>
                </tr>
                <input type="hidden" name="id_<?php echo $linhas_ceps['id']; ?>" value="<?php echo $linhas_ceps['id']; ?>" >
            <?php } ?>
            <button type="submit" class="btn btn-success" style="float: right;">Gravar Frete</button>
        </tbody>
    </table>
    
    <?php
}

function InsertVariacaoFilho(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    if(isset($_POST['BtnVar'])){
        $idItem         = str_replace($array_post, '', $_POST['idItem']);
        $idPai          = str_replace($array_post, '', $_POST['idPai']);
        $idFilho        = str_replace($array_post, '', $_POST['idFilho']);
        $preco          = str_replace($array_post, '', $_POST['preco']);
        
        $sql_catPizza="INSERT INTO cadastrofeed_varfilho (
            codigo_loja,
            id_loja,
            id_variacao,
            id_variacaofilho,
            id_produto,
            preco
        ) VALUES(
            '".$codigo_loja."',
            '".$id_loja."',
            '".$idPai."',
            '".$idFilho."',
            '".$idItem."',
            '".$preco."'
        )";
        mysqli_query($conexao, $sql_catPizza);
        
        echo '<div class="alert alert-success" role="alert">Variação: <b>'.$titulo.'</b> adicionada com sucesso.</div>';
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos/editar/".$url[2]."/variacoes'>";
    }
}

function UpdateVariacaoFilho(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    if(isset($_POST['BtnVarUpdate'])){
        $idVarFilho = str_replace($array_post, '', $_POST['idVarFilho']);
        $preco      = str_replace($array_post, '', $_POST['preco']);
        
        $update = "UPDATE cadastrofeed_varfilho SET
        	preco              = '".$preco."'
        WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$idVarFilho."'";
        mysqli_query($conexao, $update);
        
        echo '<div class="alert alert-success" role="alert">Variação: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos/editar/".$url[2]."/variacoes'>";
    }
}

function ListarVariacoesItem(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $sql_varpai      = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varpai WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_produto = '".$url[2]."'") or die("Erro");
    echo '<div class="row">';
    while($linhas_varpai = mysqli_fetch_assoc($sql_varpai)){
        $sql_dadosvarpai = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$linhas_varpai['id_variacao']."'") or die("Erro");
        $resultado_dadosvarpai = mysqli_fetch_assoc($sql_dadosvarpai);
        //remover variacao pai
            echo '<div id="myModal-removerVarPai-'.$resultado_dadosvarpai['id'].'" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Remover: '.$resultado_dadosvarpai['titulo'].'</h4>
                      </div>
                      <div class="modal-body">
                        <form action="" method="POST">
                            <p>Tem certeza que deseja remover?</p>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 text-center">
                                    <a class="btn btn-success" data-dismiss="modal">Cancelar</a>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="https://'.$host.'/produtos/editar/'.$url[2].'/RemoverVariacaoPai/'.$resultado_dadosvarpai['id'].'" class="btn btn-danger">Sim, remover <i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      </div>
                    </div>
                
                  </div>
                </div>';
        echo '<h4>'.$resultado_dadosvarpai['titulo'].' - <a class="btn btn-danger" data-toggle="modal" data-target="#myModal-removerVarPai-'.$resultado_dadosvarpai['id'].'"><i class="fa fa-trash"></i></a></h4>';
        
        $sql_varItemfilho      = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varfilho WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_variacao = '".$resultado_dadosvarpai['id']."' and id_produto = '".$url[2]."'") or die("Erro");      
        while($linhas_varItemfilho = mysqli_fetch_assoc($sql_varItemfilho)){
            $idVar  .=  $linhas_varItemfilho['id_variacaofilho'].', ';
        }
        $variacaoid = $resultado_dadosvarpai['id'];
        if($idVar == ''){
            $SqlIn      = 'ORDER BY id DESC LIMIT 0';
            $SqlNotIn   = '';
            //tras as variacoes que ainda nao foram adicionadas no banco
            $sql_varfilho      = mysqli_query($conexao,"SELECT * FROM variacao_item WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and variacao_id = '".$resultado_dadosvarpai['id']."'") or die("Erro");
        } else { 
            $SqlIn      = 'and id IN ('.substr($idVar, 0, -2).')';
            $SqlNotIn   = 'and variacao_id = '.$variacaoid.' and id NOT IN ('.substr($idVar, 0, -2).')';
            //tras as variacoes que ainda nao foram adicionadas no banco
            $sql_varfilho      = mysqli_query($conexao,"SELECT * FROM variacao_item WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'  ".$SqlNotIn) or die("Erro");
        }
        //tras as variacoes adicionadas no banco
        $sql_VarFilhoFeed      = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varfilho WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_variacao = '".$resultado_dadosvarpai['id']."' and id_produto = '".$url[2]."'") or die("Erro");
        while($linhas_varfilhoIn = mysqli_fetch_assoc($sql_VarFilhoFeed)){
            $sql_dadosvarpai = mysqli_query($conexao,"SELECT * FROM variacao_item WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$linhas_varfilhoIn['id_variacaofilho']."'") or die("Erro");
            $resultado_dadosvarpai = mysqli_fetch_assoc($sql_dadosvarpai);
            
            //remover variacao
            echo '<div id="myModal-remover-'.$linhas_varfilhoIn['id'].'" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Remover: '.$resultado_dadosvarpai['titulo'].'</h4>
                      </div>
                      <div class="modal-body">
                        <form action="" method="POST">
                            <input type="hidden" name="idVarFilho" value="'.$linhas_varfilhoIn['id'].'">
                            <p>Tem certeza que deseja remover?</p>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 text-center">
                                    <a class="btn btn-success" data-dismiss="modal">Cancelar</a>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="https://'.$host.'/produtos/editar/'.$url[2].'/RemoverVariacao/'.$linhas_varfilhoIn['id'].'" class="btn btn-danger">Sim, remover <i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      </div>
                    </div>
                
                  </div>
                </div>';
                
            echo '<div id="myModal-editar-'.$linhas_varfilhoIn['id'].'" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Editar: '.$resultado_dadosvarpai['titulo'].'</h4>
                      </div>
                      <div class="modal-body">
                        <form action="" method="POST">
                            <input type="hidden" name="idVarFilho" value="'.$linhas_varfilhoIn['id'].'">
                            <p>O preço da variação será somado com o preço principal do produto</p>';
                        ?>
                            <input type="text" class="form-control" name="preco" onKeyPress="return(myfunction(this,'','.',event))" value="<?=$linhas_varfilhoIn['preco']?>" placeholder="Preço ex: R$ 10.00">
                        <?php 
                        echo '
                            <br>
                            <div class="row">
                                <div class="col-lg-6 text-center">
                                    <input type="submit" name="BtnVarUpdate" value="Atualizar" class="btn btn-success">
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a data-toggle="modal" data-target="#myModal-remover-'.$linhas_varfilhoIn['id'].'" class="btn btn-danger" data-dismiss="modal">Remover <i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      </div>
                    </div>
                
                  </div>
                </div>';
                
            echo    '<div class="col-lg-2" style="padding: 5px;">
                        <a data-toggle="modal" data-target="#myModal-editar-'.$linhas_varfilhoIn['id'].'" class="btn btn-success rounded-pill py-3 px-5">+ R$ '.$linhas_varfilhoIn['preco'].' '.$resultado_dadosvarpai['titulo'].'</a>
                    </div>';
                    
        }
        
        
        while($linhas_varfilho = mysqli_fetch_assoc($sql_varfilho)){
            echo '<div id="myModal-cad-'.$linhas_varfilho['id'].'-'.$linhas_varfilho['variacao_id'].'" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">'.$linhas_varfilho['titulo'].'</h4>
                      </div>
                      <div class="modal-body">
                        <form action="" method="POST">
                            <input type="hidden" name="idItem" value="'.$url[2].'">
                            <input type="hidden" name="idFilho" value="'.$linhas_varfilho['id'].'">
                            <input type="hidden" name="idPai" value="'.$linhas_varfilho['variacao_id'].'">
                            <p>O preço da variação será somado com o preço principal do produto</p>';
                        ?>
                            <input type="text" class="form-control" name="preco" onKeyPress="return(myfunction(this,'','.',event))" placeholder="Preço ex: R$ 10.00">
                        <?php 
                        echo '
                            <br>
                            <input type="submit" name="BtnVar" class="btn btn-primary">
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      </div>
                    </div>
                
                  </div>
                </div>';
            echo    '<div class="col-lg-2" style="padding: 5px;">
                        <a data-toggle="modal" data-target="#myModal-cad-'.$linhas_varfilho['id'].'-'.$linhas_varfilho['variacao_id'].'" class="btn btn-primary rounded-pill py-3 px-5">Habilitar '.$linhas_varfilho['titulo'].'</a>
                    </div>';
                    
        }
        
        echo '<hr>';
    }
    echo '</div>';
}

function AddVariacaoItem(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    if(isset($_POST['BtnAddVariacao'])){
        $variacao         = str_replace($array_post, '', $_POST['variacao']);
        $sql="INSERT INTO cadastrofeed_varpai (
            id_loja,
            codigo_loja,
            id_variacao,
            id_produto
        ) VALUES(
            '".$id_loja."',
            '".$codigo_loja."',
            '".$variacao."',
            '".$url[2]."'
        )";
        mysqli_query($conexao, $sql);
        echo '<div class="alert alert-success" role="alert">Variação: <b>'.$titulo.'</b> adicionada com sucesso.</div>';
    
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos/editar/".$url[2]."/variacoes'>";
    }
}

function AtualizarProduto(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    if(isset($_POST['btn_EditarProduto'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        $ean            = str_replace($array_post, '', $_POST['ean']);
        $preco_venda    = str_replace($array_post, '', $_POST['preco_venda']);
        $preco_custo    = str_replace($array_post, '', $_POST['preco_custo']);
        $estoque        = str_replace($array_post, '', $_POST['estoque']);
        $categoria      = str_replace($array_post, '', $_POST['categoria']);
        $adicionais     = str_replace($array_post, '', $_POST['adicionais']);
        $descricao      = str_replace($array_post, '', $_POST['descricao']);
        $destaque       = str_replace($array_post, '', $_POST['destaque']);
        $status         = str_replace($array_post, '', $_POST['status']);
        $consumo_local  = str_replace($array_post, '', $_POST['consumo_local']);
        $desconto       = str_replace($array_post, '', $_POST['desconto']);
        
        $sql_check_item = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id = '".$url[2]."'") or die("Erro");
        $resultado_check_item = mysqli_fetch_assoc($sql_check_item);
		
		if($_FILES['imagem']['name'] <> ''){
		    array_map('unlink', glob($resultado_check_item['caminho']));
		}
        
        // Define o caminho para salvar a imagem WebP
        $caminho = 'uploads/'.md5(rand(1,9999).$id_loja.$codigo_loja.date('d-m-Y H:i:s'). basename($_FILES['imagem']['name'], '.' . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION))) . '.webp';
        
        // Muda o nome da imagem temporária com um prefixo "temp_"
        $temp_nome = 'temp_' . $_FILES['imagem']['name'];
        $temp_caminho = 'uploads/' . $temp_nome;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $temp_caminho)) {
            
            // Carrega a imagem com a biblioteca GD do PHP
            if ($_FILES['imagem']['type'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($temp_caminho);
            } else {
                $image = imagecreatefrompng($temp_caminho);
            }
            
            // Redimensiona a imagem para um tamanho máximo de 800x600 pixels
            $largura = imagesx($image);
            $altura = imagesy($image);
            $novaLargura = 800;
            $novaAltura = 600;
            if ($largura > $novaLargura || $altura > $novaAltura) {
                $escala = min($novaLargura/$largura, $novaAltura/$altura);
                $novaLargura = round($largura * $escala);
                $novaAltura = round($altura * $escala);
            }
            $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);
            imagecopyresampled($novaImagem, $image, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
            
            // Converte a imagem para o formato WebP e salva na pasta de destino com o novo nome
            imagewebp($novaImagem, $caminho, 80); // 80 é a qualidade da imagem
            
            // Libera a memória ocupada pelas imagens temporárias
            imagedestroy($image);
            imagedestroy($novaImagem);
            
            // Remove a imagem temporária
            unlink($temp_caminho);
            
            $update = "UPDATE cadastrofeed SET
            	file            = 'https://".$host."/".$caminho."',
            	caminho         = '".$caminho."',
            	titulo          = '".$titulo."',
            	destaque        = '".$destaque."',
            	status          = '".$status."',
            	adicionais      = '".$adicionais."',
            	descricao       = '".$descricao."',
            	categoria       = '".$categoria."',
            	estoque         = '".$estoque."',
            	preco_custo     = '".$preco_custo."',
            	preco_venda     = '".$preco_venda."',
            	ean             = '".$ean."',
            	consumo_local   = '".$consumo_local."',
            	desconto        = '".$desconto."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'";
            mysqli_query($conexao, $update);
            
            echo '<div class="alert alert-success" role="alert">Produto: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos/editar/".$url[2]."'>";
        }
        
        if($_FILES['imagem']['name'] == ''){
            $update = "UPDATE cadastrofeed SET
            	titulo          = '".$titulo."',
            	destaque        = '".$destaque."',
            	status          = '".$status."',
            	adicionais      = '".$adicionais."',
            	descricao       = '".$descricao."',
            	categoria       = '".$categoria."',
            	estoque         = '".$estoque."',
            	preco_custo     = '".$preco_custo."',
            	preco_venda     = '".$preco_venda."',
            	ean             = '".$ean."',
            	consumo_local   = '".$consumo_local."',
            	desconto        = '".$desconto."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'";
            mysqli_query($conexao, $update);
            
            echo '<div class="alert alert-success" role="alert">Produto: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos/editar/".$url[2]."'>";
        }
        
        
    }
}

function RemoverProduto(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $sql_item = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'") or die("Erro");
    $resultado_item	= mysqli_fetch_assoc($sql_item);
		
	if($resultado_item['id'] <> ''){
		array_map('unlink', glob($resultado_item['caminho']));
		
		$delete = "DELETE FROM `cadastrofeed` WHERE `cadastrofeed`.`id` = '".$resultado_item['id']."'";
		mysqli_query($conexao, $delete);
		
		$delete = "DELETE FROM `cadastrofeed_varfilho` WHERE `cadastrofeed_varfilho`.`id_produto` = '".$resultado_item['id']."'";
		mysqli_query($conexao, $delete);
		
		$delete = "DELETE FROM `cadastrofeed_varpai` WHERE `cadastrofeed_varpai`.`id_produto` = '".$resultado_item['id']."'";
		mysqli_query($conexao, $delete);
	}
	
	echo "<META HTTP-EQUIV=REFRESH CONTENT = '1;URL=https://".$host."/produtos'>";
}

function AdicionarProduto(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    if(isset($_POST['btn_AddProduto'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        $ean            = str_replace($array_post, '', $_POST['ean']);
        $preco_venda    = str_replace($array_post, '', $_POST['preco_venda']);
        $preco_custo    = str_replace($array_post, '', $_POST['preco_custo']);
        $estoque        = str_replace($array_post, '', $_POST['estoque']);
        $categoria      = str_replace($array_post, '', $_POST['categoria']);
        $adicionais     = str_replace($array_post, '', $_POST['adicionais']);
        $descricao      = str_replace($array_post, '', $_POST['descricao']);
        $destaque       = str_replace($array_post, '', $_POST['destaque']);
        $status         = str_replace($array_post, '', $_POST['status']);
        $consumo_local  = str_replace($array_post, '', $_POST['consumo_local']);
        
        if($_POST['pizza'] == '1'){
            $pizza          = str_replace($array_post, '', $_POST['pizza']);
            $dois_sabores   = str_replace($array_post, '', $_POST['dois_sabores']);
        } else {
            $pizza          = '';
            $dois_sabores   = '';
        }
        
        
        $sql_check_item = mysqli_query($conexao,"SELECT * FROM cadastrofeed ORDER BY 'id' DESC") or die("Erro");
        $resultado_check_item = mysqli_fetch_assoc($sql_check_item);
            
        $proximoId              = ($resultado_check_item['id'] + 1);
        $codificando_title      .= $titulo.''.$id_loja.' '.$proximoId.''.rand(1, 9999).''.rand(1, 500);
        $url_item               = preg_replace('/[ -]+/' , '-' , str_replace(array("#", "'", ";", "*", "=", "'/'", "/", "%", "+", "-", "&", "ˆ", "$", "]", "[", "}", "{"), '', $codificando_title));
        
        $data_cadastro  = date('d/m/Y H:i:s');
        // Define o caminho para salvar a imagem WebP
        $caminho = 'uploads/'.md5(rand(1,9999).$id_loja.$codigo_loja.date('d-m-Y H:i:s'). basename($_FILES['imagem']['name'], '.' . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION))) . '.webp';
        
        // Muda o nome da imagem temporária com um prefixo "temp_"
        $temp_nome = 'temp_' . $_FILES['imagem']['name'];
        $temp_caminho = 'uploads/' . $temp_nome;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $temp_caminho)) {
            // Carrega a imagem com a biblioteca GD do PHP
            if ($_FILES['imagem']['type'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($temp_caminho);
            } else {
                $image = imagecreatefrompng($temp_caminho);
            }
            
            // Redimensiona a imagem para um tamanho máximo de 800x600 pixels
            $largura = imagesx($image);
            $altura = imagesy($image);
            $novaLargura = 800;
            $novaAltura = 600;
            if ($largura > $novaLargura || $altura > $novaAltura) {
                $escala = min($novaLargura/$largura, $novaAltura/$altura);
                $novaLargura = round($largura * $escala);
                $novaAltura = round($altura * $escala);
            }
            $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);
            imagecopyresampled($novaImagem, $image, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
            
            // Converte a imagem para o formato WebP e salva na pasta de destino com o novo nome
            imagewebp($novaImagem, $caminho, 80); // 80 é a qualidade da imagem
            
            // Libera a memória ocupada pelas imagens temporárias
            imagedestroy($image);
            imagedestroy($novaImagem);
            
            // Remove a imagem temporária
            unlink($temp_caminho);
            
            $sql="INSERT INTO cadastrofeed (
                titulo,
                preco_venda,
                preco_custo,
                estoque,
                data_cadastro,
                id_loja,
                codigo_loja,
                ean,
                file,
                caminho,
                categoria,
                adicionais,
                destaque,
                url,
                descricao,
                status,
                pizza,
                dois_sabores,
                consumo_local
            ) VALUES(
                '".$titulo."',
                '".$preco_venda."',
                '".$preco_custo."',
                '".$estoque."',
                '".$data_cadastro."',
                '".$id_loja."',
                '".$codigo_loja."',
                '".$ean."',
                'https://".$host."/".$caminho."',
                '".$caminho."',
                '".$categoria."',
                '".$adicionais."',
                '".$destaque."',
                '".$url_item."',
                '".$descricao."',
                '".$status."',
                '".$pizza."',
                '".$dois_sabores."',
                '".$consumo_local."'
            )";
            mysqli_query($conexao, $sql);
               
            
            echo '<div class="alert alert-success" role="alert">Produto: <b>'.$titulo.'</b> enviado com sucesso.</div>';
        
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos'>";
            
        } else {
            $sql="INSERT INTO cadastrofeed (
                titulo,
                preco_venda,
                preco_custo,
                estoque,
                data_cadastro,
                id_loja,
                codigo_loja,
                ean,
                file,
                caminho,
                categoria,
                adicionais,
                destaque,
                url,
                descricao,
                status,
                pizza,
                dois_sabores,
                consumo_local
            ) VALUES(
                '".$titulo."',
                '".$preco_venda."',
                '".$preco_custo."',
                '".$estoque."',
                '".$data_cadastro."',
                '".$id_loja."',
                '".$codigo_loja."',
                '".$ean."',
                'https://".$host."/app/layout/agenda/assets/img/produto-sem-imagem.webp',
                'app/layout/agenda/assets/img/produto-sem-imagem.webp',
                '".$categoria."',
                '".$adicionais."',
                '".$destaque."',
                '".$url_item."',
                '".$descricao."',
                '".$status."',
                '".$pizza."',
                '".$dois_sabores."',
                '".$consumo_local."'
            )";
            mysqli_query($conexao, $sql);
               
            
            echo '<div class="alert alert-success" role="alert">Produto: <b>'.$titulo.'</b> enviado com sucesso.</div>';
        
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos'>";
        }
    }
}

function QrCodeMesa(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    
    $urlQrCode  = $dominio_app.'/loja/'.$codigo_loja.'/mesa/'.$url[2];
    
    $urlQrCodeCom = str_replace('www.', '', $urlQrCode);
    $cor = $_GET['cor'];
    
    $elementos = parse_url($url_2);
    
    $tags = get_meta_tags('https://'.$urlQrCodeCom);
    
    $sql_mesas = mysqli_query($conexao,"SELECT * FROM mesas WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
    $resultado_mesas = mysqli_fetch_assoc($sql_mesas);
    
    
    $aux = '../../app/helpers/produtos/qrcode/php/qr_img.php?';
    $aux .= 'd='.''.$urlQrCodeCom.'&';
    
    include('app/helpers/produtos/qrcode/index.php');
    
}

function RemoverMesa(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $delete = "DELETE FROM `mesas` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'";
	mysqli_query($conexao, $delete);
    
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/mesas'>";
    
}

function EditarMesa(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    
    if(isset($_POST['btn_EditarMesa'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        
        
        $update = "UPDATE mesas SET
        	titulo              = '".$titulo."'
        WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'";
        mysqli_query($conexao, $update);
        
        echo '<div class="alert alert-success" role="alert">Mesa: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/mesas'>";
    }
}

function AdicionarMesa(){
    
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    
    if(isset($_POST['btn_AddMesa'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        
        $sql="INSERT INTO mesas (
            titulo,
            id_loja,
            codigo_loja
        ) VALUES(
            '".$titulo."',
            '".$id_loja."',
            '".$codigo_loja."'
        )";
        mysqli_query($conexao, $sql);
        
        echo '<div class="alert alert-success" role="alert">Mesa: <b>'.$titulo.'</b> enviado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/mesas'>";
    }
}

function ListarMesas(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    while($linhasMesaModal = mysqli_fetch_assoc($sqlMesaModal)){
        echo '<div id="myModal-'.$linhasMesaModal['id'].'" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <b>Deseja remover: '.$linhasMesaModal['titulo'].'?</b>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="https://'.$host.'/mesas/remover/'.$linhasMesaModal['id'].'" style="width: 100%;" class="btn btn-danger">Remover <i class="fa fa-trash"></i></a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success" data-dismiss="modal" style="width: 100%;">Cancelar</a>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                  </div>
                </div>
            
              </div>
            </div>';
    }
    
    echo '<table class="table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Funções</th>
              </tr>
            </thead>
            <tbody>';
    while($linhas_Mesa = mysqli_fetch_assoc($sql_Mesa)){
        echo '<tr>';
            echo '<td><a href="https://'.$host.'/mesas/editar/'.$linhas_Mesa['id'].'">'.$linhas_Mesa['titulo'].'</a></td>';
            echo '<td>';
                echo '<a href="https://'.$host.'/mesas/qrcode/'.$linhas_Mesa['id'].'" class="btn btn-success" style="margin: 4px;" target="_BLANK"><i class="fa fa-qrcode"></i></a>';
                echo '<a data-toggle="modal" data-target="#myModal-'.$linhas_Mesa['id'].'" class="btn btn-danger" style="margin: 4px;"><i class="fa fa-trash"></i></a>';
            echo '</td>';
        echo '</tr>';
    }
    echo '
            </tbody>
        </table>';
}

function RemoverCategoria(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $sql_cat = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'") or die("Erro");
    $resultado_cat	= mysqli_fetch_assoc($sql_cat);
		
	if($resultado_cat['id'] <> ''){
		array_map('unlink', glob($resultado_cat['caminho']));
		
		$delete = "DELETE FROM `categoria_produtos` WHERE `categoria_produtos`.`id` = '".$resultado_cat['id']."'";
		mysqli_query($conexao, $delete);
	}
	
	echo "<META HTTP-EQUIV=REFRESH CONTENT = '1;URL=https://".$host."/categorias'>";
}

function EditarCategoria(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    
    if(isset($_POST['btn_EditarCategoria'])){
        $titulo     = str_replace($array_post, '', $_POST['titulo']);
        $destaque   = str_replace($array_post, '', $_POST['destaque']);
        
        $sql_cat = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'") or die("Erro");
        $resultado_cat	= mysqli_fetch_assoc($sql_cat);
		
		array_map('unlink', glob($resultado_cat['caminho']));
		
        
        // Define o caminho para salvar a imagem WebP
        $caminho = 'uploads/'.md5(rand(1,9999).$id_loja.$codigo_loja.date('d-m-Y H:i:s'). basename($_FILES['imagem']['name'], '.' . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION))) . '.webp';
        
        // Muda o nome da imagem temporária com um prefixo "temp_"
        $temp_nome = 'temp_' . $_FILES['imagem']['name'];
        $temp_caminho = 'uploads/' . $temp_nome;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $temp_caminho)) {
            
            // Carrega a imagem com a biblioteca GD do PHP
            if ($_FILES['imagem']['type'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($temp_caminho);
            } else {
                $image = imagecreatefrompng($temp_caminho);
            }
            
            // Redimensiona a imagem para um tamanho máximo de 800x600 pixels
            $largura = imagesx($image);
            $altura = imagesy($image);
            $novaLargura = 800;
            $novaAltura = 600;
            if ($largura > $novaLargura || $altura > $novaAltura) {
                $escala = min($novaLargura/$largura, $novaAltura/$altura);
                $novaLargura = round($largura * $escala);
                $novaAltura = round($altura * $escala);
            }
            $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);
            imagecopyresampled($novaImagem, $image, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
            
            // Converte a imagem para o formato WebP e salva na pasta de destino com o novo nome
            imagewebp($novaImagem, $caminho, 80); // 80 é a qualidade da imagem
            
            // Libera a memória ocupada pelas imagens temporárias
            imagedestroy($image);
            imagedestroy($novaImagem);
            
            // Remove a imagem temporária
            unlink($temp_caminho);
            
            $update = "UPDATE categoria_produtos SET
            	titulo      = '".$titulo."',
            	destaque    = '".$destaque."',
            	file        = 'https://".$host."/".$caminho."',
            	caminho     = '".$caminho."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'";
            mysqli_query($conexao, $update);
            
            echo '<div class="alert alert-success" role="alert">Categoria: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/categorias'>";
        }
        
        if($_FILES['imagem']['name'] == ''){
            $update = "UPDATE categoria_produtos SET
            	titulo      = '".$titulo."',
            	destaque    = '".$destaque."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'";
            mysqli_query($conexao, $update);
            
            echo '<div class="alert alert-success" role="alert">Categoria: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/categorias'>";
        }
        
        
    }
}

function AdicionarCategoria(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    
    if(isset($_POST['btn_AddCategoria'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        $destaque       = str_replace($array_post, '', $_POST['destaque']);
        
        // Define o caminho para salvar a imagem WebP
        $caminho = 'uploads/'.md5(rand(1,9999).$id_loja.$codigo_loja.date('d-m-Y H:i:s'). basename($_FILES['imagem']['name'], '.' . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION))) . '.webp';
        
        // Muda o nome da imagem temporária com um prefixo "temp_"
        $temp_nome = 'temp_' . $_FILES['imagem']['name'];
        $temp_caminho = 'uploads/' . $temp_nome;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $temp_caminho)) {
            
            // Carrega a imagem com a biblioteca GD do PHP
            if ($_FILES['imagem']['type'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($temp_caminho);
            } else {
                $image = imagecreatefrompng($temp_caminho);
            }
            
            // Redimensiona a imagem para um tamanho máximo de 800x600 pixels
            $largura = imagesx($image);
            $altura = imagesy($image);
            $novaLargura = 800;
            $novaAltura = 600;
            if ($largura > $novaLargura || $altura > $novaAltura) {
                $escala = min($novaLargura/$largura, $novaAltura/$altura);
                $novaLargura = round($largura * $escala);
                $novaAltura = round($altura * $escala);
            }
            $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);
            imagecopyresampled($novaImagem, $image, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
            
            // Converte a imagem para o formato WebP e salva na pasta de destino com o novo nome
            imagewebp($novaImagem, $caminho, 80); // 80 é a qualidade da imagem
            
            // Libera a memória ocupada pelas imagens temporárias
            imagedestroy($image);
            imagedestroy($novaImagem);
            
            // Remove a imagem temporária
            unlink($temp_caminho);
            $urlFoto    = "https://".$host."/".$caminho;
        }
        $sql="INSERT INTO categoria_produtos (
            titulo,
            destaque,
            file,
            id_loja,
            codigo_loja,
            caminho
        ) VALUES(
            '".$titulo."',
            '".$destaque."',
            '".$urlFoto."',
            '".$id_loja."',
            '".$codigo_loja."',
            '".$caminho."'
        )";
        mysqli_query($conexao, $sql);
        
        echo '<div class="alert alert-success" role="alert">Categoria: <b>'.$titulo.'</b> criada com sucesso.</div>';
    
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/categorias'>";

        
        
    }
}
function ListarCategorias(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    while($linhasCategoriasModal = mysqli_fetch_assoc($sqlCategoriasModal)){
        echo '<div id="myModal-'.$linhasCategoriasModal['id'].'" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <b>Deseja remover: '.$linhasCategoriasModal['titulo'].'?</b>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="https://'.$host.'/categorias/remover/'.$linhasCategoriasModal['id'].'" style="width: 100%;" class="btn btn-danger">Remover <i class="fa fa-trash"></i></a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success" data-dismiss="modal" style="width: 100%;">Cancelar</a>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                  </div>
                </div>
            
              </div>
            </div>';
    }
    
    echo '<table class="table">
            <thead>
              <tr>
                <th>Imagem</th>
                <th>Título</th>
                <th>Destaque</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="lista">';
    while($linhas_Categorias = mysqli_fetch_assoc($sql_Categorias)){
        if($linhas_Categorias['destaque'] == '2'){
            $destaque = '<b style="color: green;">Em destaque</b>';
        } else {
            $destaque = '<b style="color: black;">Somente no menu</b>';
        }
        
        if($linhas_Categorias['file'] == ''){
            $imagem = '<img src="https://'.$host.'/uploads/sem_foto/sem_foto.jpeg" style="60px; height: 60px;">';
        } else {
            $imagem = '<img src="'.$linhas_Categorias['file'].'" style="60px; height: 60px;">';
        }
        echo '<tr id="arrayordem_'.$linhas_Categorias['id'].'">';
            echo '<td><a href="https://'.$host.'/categorias/editar/'.$linhas_Categorias['id'].'">'.$imagem.'</a></td>';
            echo '<td><a href="https://'.$host.'/categorias/editar/'.$linhas_Categorias['id'].'">'.$linhas_Categorias['titulo'].'</a></td>';
            echo '<td><a href="https://'.$host.'/categorias/editar/'.$linhas_Categorias['id'].'">'.$destaque.'</a></td>';
            echo '<td>
                    <a data-toggle="modal" data-target="#myModal-'.$linhas_Categorias['id'].'" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>';
        echo '</tr>';
    }
    echo '
            </tbody>
        </table>';
}

function RemoverVariacao(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $sql_variacao = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
    $resultado_variacao = mysqli_fetch_assoc($sql_variacao);
    
    if($resultado_variacao['id'] <> ''){
        array_map('unlink', glob($resultado_variacao['caminho']));
        
        $delete = "DELETE FROM `variacao_nome` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'";
	    mysqli_query($conexao, $delete);
	    
	    $deletevariacao_item = "DELETE FROM `variacao_item` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and variacao_id = '".$url[2]."'";
	    mysqli_query($conexao, $deletevariacao_item);
    }
    
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/variacoes'>";
}

function RemoverVariacaoPai(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $sql_variacao = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varpai WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
    $resultado_variacao = mysqli_fetch_assoc($sql_variacao);
    
    if($resultado_variacao['id'] <> ''){
        $delete = "DELETE FROM `cadastrofeed_varpai` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'";
	    mysqli_query($conexao, $delete);
	    
	    $deletevariacao_item = "DELETE FROM `cadastrofeed_varfilho` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_variacao = '".$url[2]."'";
	    mysqli_query($conexao, $deletevariacao_item);
    }
    
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/variacoes'>";
}

function RemoverAdicional(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $delete = "DELETE FROM `adicional` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'";
	mysqli_query($conexao, $delete);
    
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/adicionais'>";
    
}

function EditarAdicional(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    
    if(isset($_POST['btn_EditarAdicional'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        $preco_venda    = str_replace($array_post, '', $_POST['preco_venda']);
        $preco_custo    = str_replace($array_post, '', $_POST['preco_custo']);
        $estoque        = str_replace($array_post, '', $_POST['estoque']);
        $data_cadastro  = date('d/m/Y');
        
        $update = "UPDATE adicional SET
        	titulo              = '".$titulo."',
        	preco_venda         = '".$preco_venda."',
        	preco_custo         = '".$preco_custo."',
        	estoque             = '".$estoque."',
        	data_atualizacao    = '".date('d/m/Y H:i:s')."'
        WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$url[2]."'";
        mysqli_query($conexao, $update);
        
        echo '<div class="alert alert-success" role="alert">Adicional: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/adicionais'>";
    }
}

function EditarVariacao_Item(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    
    if(isset($_POST['btn_EditarVariacao_Item'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        $id             = str_replace($array_post, '', $_POST['id']);
        
        
        $update = "UPDATE variacao_item SET
        	titulo              = '".$titulo."'
        WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$id."'";
        mysqli_query($conexao, $update);
        
        echo '<div class="alert alert-success" role="alert">Adicional: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/variacoes/AdicionarVariacoes/".$url[2]."'>";
    }
}

function ListarVariacaoFilho(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $sql_variacao_item      = mysqli_query($conexao,"SELECT * FROM variacao_item WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and variacao_id = '".$url[2]."'") or die("Erro");
    $sql_variacao_itemModal = mysqli_query($conexao,"SELECT * FROM variacao_item WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and variacao_id = '".$url[2]."'") or die("Erro");
    
    while($linhasvariacao_itemModal = mysqli_fetch_assoc($sql_variacao_itemModal)){
        echo '<div id="myModal-editar-'.$linhasvariacao_itemModal['id'].'" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <b>Deseja remover: '.$linhasvariacao_itemModal['titulo'].'?</b>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <form action="" method="POST">
                        <input type="hidden" name="id" value="'.$linhasvariacao_itemModal['id'].'">
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="titulo" placeholder="Título" value="'.$linhasvariacao_itemModal['titulo'].'" required>
                                    <label for="subject">Título</label>
                                </div>
                            </div>
                            
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary rounded-pill py-3 px-5" name="btn_EditarVariacao_Item" style="width: 100%;" value="Atualizar">
                            </div>
                        </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                  </div>
                </div>
            
              </div>
            </div>';
            
        echo '<div id="myModal-'.$linhasvariacao_itemModal['id'].'" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <b>Deseja remover: '.$linhasvariacao_itemModal['titulo'].'?</b>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="https://'.$host.'/variacoes/AdicionarVariacoes/remover/'.$linhasvariacao_itemModal['id'].'/'.$url[2].'" style="width: 100%;" class="btn btn-danger">Remover <i class="fa fa-trash"></i></a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success" data-dismiss="modal" style="width: 100%;">Cancelar</a>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                  </div>
                </div>
            
              </div>
            </div>';
    }
    
    echo '<table class="table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Remover</th>
              </tr>
            </thead>
            <tbody>';
    while($linhas_variacao_item = mysqli_fetch_assoc($sql_variacao_item)){
        echo '<tr>';
            echo '<td><a data-toggle="modal" data-target="#myModal-editar-'.$linhas_variacao_item['id'].'" style="cursor: pointer;">'.$linhas_variacao_item['titulo'].'</a></td>';
            echo '<td>';
                echo '<a data-toggle="modal" data-target="#myModal-editar-'.$linhas_variacao_item['id'].'" class="btn btn-primary" style="margin: 2px;"><i class="fa fa-edit"></i></a>';
                echo '<a data-toggle="modal" data-target="#myModal-'.$linhas_variacao_item['id'].'" class="btn btn-danger" style="margin: 2px;"><i class="fa fa-trash"></i></a>';
            echo '</td>';
        echo '</tr>';
    }
    echo '
            </tbody>
        </table>';
}

function AddVariacaoFilho(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    if(isset($_POST['btn_AddVariacaoFilho'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        
        $sql_adicional = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
        $resultado_adicional = mysqli_fetch_assoc($sql_adicional);
        
        $tituloVariacao    = $resultado_adicional['titulo'];
        
        $sql="INSERT INTO variacao_item (
            titulo,
            id_loja,
            codigo_loja,
            variacao_id
        ) VALUES(
            '".$titulo."',
            '".$id_loja."',
            '".$codigo_loja."',
            '".$resultado_adicional['id']."'
        )";
        mysqli_query($conexao, $sql);
        
        echo '<div class="alert alert-success" role="alert">Variação: <b>'.$titulo.'</b> enviado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/variacoes/AdicionarVariacoes/".$resultado_adicional['id']."'>";
    }
}

function AdicionarVariacoes(){
    
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    
    if(isset($_POST['btn_AddAdicional'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        $caminho = 'uploads/variacoes/'.md5(rand(1,9999).$id_loja.$codigo_loja.date('d-m-Y H:i:s'). basename($_FILES['imagem']['name'], '.' . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION))) . '.webp';
        
        // Muda o nome da imagem temporária com um prefixo "temp_"
        $temp_nome = 'temp_' . $_FILES['imagem']['name'];
        $temp_caminho = 'uploads/variacoes/' . $temp_nome;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $temp_caminho)) {
            // Carrega a imagem com a biblioteca GD do PHP
            if ($_FILES['imagem']['type'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($temp_caminho);
            } else {
                $image = imagecreatefrompng($temp_caminho);
            }
            
            // Redimensiona a imagem para um tamanho máximo de 800x600 pixels
            $largura = imagesx($image);
            $altura = imagesy($image);
            $novaLargura = 800;
            $novaAltura = 600;
            if ($largura > $novaLargura || $altura > $novaAltura) {
                $escala = min($novaLargura/$largura, $novaAltura/$altura);
                $novaLargura = round($largura * $escala);
                $novaAltura = round($altura * $escala);
            }
            $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);
            imagecopyresampled($novaImagem, $image, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
            
            // Converte a imagem para o formato WebP e salva na pasta de destino com o novo nome
            imagewebp($novaImagem, $caminho, 80); // 80 é a qualidade da imagem
            
            // Libera a memória ocupada pelas imagens temporárias
            imagedestroy($image);
            imagedestroy($novaImagem);
            
            // Remove a imagem temporária
            unlink($temp_caminho);
            $url_imagem = "https://".$host."/".$caminho;
            $sql="INSERT INTO variacao_nome (
                titulo,
                id_loja,
                codigo_loja,
                file,
                caminho
            ) VALUES(
                '".$titulo."',
                '".$id_loja."',
                '".$codigo_loja."',
                '".$url_imagem."',
                '".$caminho."'
            )";
            mysqli_query($conexao, $sql);
        } else {
            $sql="INSERT INTO variacao_nome (
                titulo,
                id_loja,
                codigo_loja
            ) VALUES(
                '".$titulo."',
                '".$id_loja."',
                '".$codigo_loja."'
            )";
            mysqli_query($conexao, $sql);
        }
        
        echo '<div class="alert alert-success" role="alert">Variação: <b>'.$titulo.'</b> enviado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/variacoes'>";
    }
}

function EditarVariacao_Nome(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    
    if(isset($_POST['btn_EditarVariacao_Nome'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        $id             = str_replace($array_post, '', $_POST['id']);
        
        $sql_check_item = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$id."'") or die("Erro");
        $resultado_check_item = mysqli_fetch_assoc($sql_check_item);
		
		if($_FILES['imagem']['name'] <> ''){
		    array_map('unlink', glob($resultado_check_item['caminho']));
		}
        
        // Define o caminho para salvar a imagem WebP
        $caminho = 'uploads/variacoes/'.md5(rand(1,9999).$id_loja.$codigo_loja.date('d-m-Y H:i:s'). basename($_FILES['imagem']['name'], '.' . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION))) . '.webp';
        
        // Muda o nome da imagem temporária com um prefixo "temp_"
        $temp_nome = 'temp_' . $_FILES['imagem']['name'];
        $temp_caminho = 'uploads/variacoes/' . $temp_nome;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $temp_caminho)) {
            
            // Carrega a imagem com a biblioteca GD do PHP
            if ($_FILES['imagem']['type'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($temp_caminho);
            } else {
                $image = imagecreatefrompng($temp_caminho);
            }
            
            // Redimensiona a imagem para um tamanho máximo de 800x600 pixels
            $largura = imagesx($image);
            $altura = imagesy($image);
            $novaLargura = 800;
            $novaAltura = 600;
            if ($largura > $novaLargura || $altura > $novaAltura) {
                $escala = min($novaLargura/$largura, $novaAltura/$altura);
                $novaLargura = round($largura * $escala);
                $novaAltura = round($altura * $escala);
            }
            $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);
            imagecopyresampled($novaImagem, $image, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
            
            // Converte a imagem para o formato WebP e salva na pasta de destino com o novo nome
            imagewebp($novaImagem, $caminho, 80); // 80 é a qualidade da imagem
            
            // Libera a memória ocupada pelas imagens temporárias
            imagedestroy($image);
            imagedestroy($novaImagem);
            
            // Remove a imagem temporária
            unlink($temp_caminho);
            $url_imagem = "https://".$host."/".$caminho;
            $update = "UPDATE variacao_nome SET
            	titulo  = '".$titulo."',
            	file    = '".$url_imagem."',
            	caminho = '".$caminho."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$id."'";
            mysqli_query($conexao, $update);
        } else {
            $update = "UPDATE variacao_nome SET
            	titulo              = '".$titulo."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$id."'";
            mysqli_query($conexao, $update);
        }
        
        echo '<div class="alert alert-success" role="alert">Variação: <b>'.$titulo.'</b> atualizado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/variacoes'>";
    }
}

function ListarVariacoes(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    while($linhasVariacaoModal = mysqli_fetch_assoc($sqlVariacaoModal)){
        echo '<div id="myModal-editar-'.$linhasVariacaoModal['id'].'" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <b>Atualizar: '.$linhasVariacaoModal['titulo'].'?</b>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="'.$linhasVariacaoModal['id'].'">
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="titulo" placeholder="Título" value="'.$linhasVariacaoModal['titulo'].'" required>
                                    <label for="subject">Título</label>
                                </div>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="imagem"/>
                                    <label for="subject">Imagem</label>
                                </div>
                            </div>';
                            if($linhasVariacaoModal['file'] == ''){
                                echo '<img src="https://'.$host.'/uploads/sem_foto/sem_foto.jpeg" style="60px; height: 60px;">';
                            } else {
                                echo '<img src="'.$linhasVariacaoModal['file'].'" style="width: 90px; height: 90px;">';
                            }
                            echo '
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary rounded-pill py-3 px-5" name="btn_EditarVariacao_Nome" style="width: 100%;" value="Atualizar">
                            </div>
                        </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                  </div>
                </div>
            
              </div>
            </div>';
            
        echo '<div id="myModal-'.$linhasVariacaoModal['id'].'" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <b>Deseja remover: '.$linhasVariacaoModal['titulo'].'?</b>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="https://'.$host.'/variacoes/remover/'.$linhasVariacaoModal['id'].'" style="width: 100%;" class="btn btn-danger">Remover <i class="fa fa-trash"></i></a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success" data-dismiss="modal" style="width: 100%;">Cancelar</a>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                  </div>
                </div>
            
              </div>
            </div>';
    }
    
    echo '<table class="table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Registros</th>
                <th>Remover</th>
              </tr>
            </thead>
            <tbody>';
    while($linhas_variacao = mysqli_fetch_assoc($sql_variacao)){
        $result = mysqli_query($conexao,"SELECT * FROM variacao_item WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and variacao_id = '".$linhas_variacao['id']."'");
        $num_rows = mysqli_num_rows($result);
        echo '<tr>';
            echo '<td><a href="https://'.$host.'/variacoes/AdicionarVariacoes/'.$linhas_variacao['id'].'">'.$linhas_variacao['titulo'].'</a></td>';
            echo '<td><a href="https://'.$host.'/variacoes/AdicionarVariacoes/'.$linhas_variacao['id'].'">'.$num_rows.'</a></td>';
            echo '<td>';
                echo '<a data-toggle="modal" data-target="#myModal-editar-'.$linhas_variacao['id'].'" class="btn btn-primary" style="margin: 2px;"><i class="fa fa-edit"></i></a>';
                echo '<a data-toggle="modal" data-target="#myModal-'.$linhas_variacao['id'].'" class="btn btn-danger" style="margin: 2px;"><i class="fa fa-trash"></i></a>';
            echo '</td>';
        echo '</tr>';
    }
    echo '
            </tbody>
        </table>';
}

function ListarAdicional(){
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    while($linhasAdicionalModal = mysqli_fetch_assoc($sqlAdicionalModal)){
        echo '<div id="myModal-'.$linhasAdicionalModal['id'].'" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <b>Deseja remover: '.$linhasAdicionalModal['titulo'].'?</b>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="https://'.$host.'/adicionais/remover/'.$linhasAdicionalModal['id'].'" style="width: 100%;" class="btn btn-danger">Remover <i class="fa fa-trash"></i></a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success" data-dismiss="modal" style="width: 100%;">Cancelar</a>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                  </div>
                </div>
            
              </div>
            </div>';
    }
    
    echo '<table class="table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Preço custo</th>
                <th>Preço venda</th>
                <th>Estoque</th>
                <th>Remover</th>
              </tr>
            </thead>
            <tbody>';
    while($linhas_adicional = mysqli_fetch_assoc($sql_adicional)){
        echo '<tr>';
            echo '<td><a href="https://'.$host.'/adicionais/editar/'.$linhas_adicional['id'].'">'.$linhas_adicional['titulo'].'</a></td>';
            echo '<td><a href="https://'.$host.'/adicionais/editar/'.$linhas_adicional['id'].'">'.$linhas_adicional['preco_custo'].'</a></td>';
            echo '<td><a href="https://'.$host.'/adicionais/editar/'.$linhas_adicional['id'].'">'.$linhas_adicional['preco_venda'].'</a></td>';
            echo '<td><a href="https://'.$host.'/adicionais/editar/'.$linhas_adicional['id'].'">'.$linhas_adicional['estoque'].'</a></td>';
            echo '<td><a data-toggle="modal" data-target="#myModal-'.$linhas_adicional['id'].'" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>';
        echo '</tr>';
    }
    echo '
            </tbody>
        </table>';
}

function AdicionarAdicional(){
    
    include('app/db_configuracao/dbconfig.php');
    include('app/db_configuracao/tabelas.php');
    include('app/db_configuracao/urlAmigavel.php');
    
    
    if(isset($_POST['btn_AddAdicional'])){
        $titulo         = str_replace($array_post, '', $_POST['titulo']);
        $preco_venda    = str_replace($array_post, '', $_POST['preco_venda']);
        $preco_custo    = str_replace($array_post, '', $_POST['preco_custo']);
        $estoque        = str_replace($array_post, '', $_POST['estoque']);
        $data_cadastro  = date('d/m/Y');
        $sql="INSERT INTO adicional (
            titulo,
            preco_venda,
            preco_custo,
            estoque,
            data_cadastro,
            id_loja,
            codigo_loja
        ) VALUES(
            '".$titulo."',
            '".$preco_venda."',
            '".$preco_custo."',
            '".$estoque."',
            '".$data_cadastro."',
            '".$id_loja."',
            '".$codigo_loja."'
        )";
        mysqli_query($conexao, $sql);
        
        echo '<div class="alert alert-success" role="alert">Adicional: <b>'.$titulo.'</b> enviado com sucesso.</div>';
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/adicionais'>";
    }
}
        
} //final class
?>