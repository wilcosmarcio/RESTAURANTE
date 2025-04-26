<?php
class FaixaCep{
    function update(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        if(isset($_POST['btnatualizar'])){
            $id             = str_replace($array_post, '', $_POST['id']);
            $cidade         = str_replace($array_post, '', $_POST['cidade']);
            $titulo         = str_replace($array_post, '', $_POST['titulo']);
            $faixa_inicio   = str_replace($array_post, '', $_POST['faixa_inicio']);
            $faixa_fim      = str_replace($array_post, '', $_POST['faixa_fim']);
            $preco          = str_replace($array_post, '', $_POST['preco']);
            
            $update = "UPDATE FaixasCEP SET
                titulo          = '".$titulo."',
                cidade          = '".$cidade."',
                faixa_inicio    = '".$faixa_inicio."',
                faixa_fim       = '".$faixa_fim."',
                preco           = '".$preco."'
            WHERE id = '".$id."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'";
            mysqli_query($conexao, $update);
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/FaixaCep'>";
        }
    }
    function cadastro(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        if(isset($_POST['btn_faixacep'])){
            $titulo         = str_replace($array_post, '', $_POST['titulo']);
            $cidade         = str_replace($array_post, '', $_POST['cidade']);
            $faixa_inicio   = str_replace($array_post, '', $_POST['faixa_inicio']);
            $faixa_fim      = str_replace($array_post, '', $_POST['faixa_fim']);
            $preco          = str_replace($array_post, '', $_POST['preco']);
            
            $sql_catPizza="INSERT INTO FaixasCEP (
                codigo_loja,
                id_loja,
                titulo,
                cidade,
                faixa_inicio,
                faixa_fim,
                preco
            ) VALUES(
                '".$codigo_loja."',
                '".$id_loja."',
                '".$titulo."',
                '".$cidade."',
                '".$faixa_inicio."',
                '".$faixa_fim."',
                '".$preco."'
            )";
            mysqli_query($conexao, $sql_catPizza);
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/FaixaCep'>";
	    }
    }
    function cadFaixaCEP(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'preco_') === 0) {
                    $registro_id = substr($key, strpos($key, '_') + 1);
                    
                    $id     = mysqli_real_escape_string($conexao, $_POST['id_' . $registro_id]);
                    $preco  = mysqli_real_escape_string($conexao, $_POST['preco_' . $registro_id]);
                    if($preco <> ''){
                        $sql_FaixaCepAdministrativo = mysqli_query($conexao,"SELECT * FROM FaixaCepAdministrativo WHERE id = '".$id."'") or die("Erro");
                        $resultado_FaixaCepAdministrativo	= mysqli_fetch_assoc($sql_FaixaCepAdministrativo);
                        
                        $sql="INSERT INTO FaixasCEP(
                        titulo, 
                        cidade, 
                        faixa_inicio, 
                        faixa_fim, 
                        preco, 
                        codigo_loja, 
                        id_loja, 
                        IdAdministrativo
                        ) VALUES(
                            '".$resultado_FaixaCepAdministrativo['titulo']."',
                            '".$resultado_FaixaCepAdministrativo['cidade']."',
                            '".$resultado_FaixaCepAdministrativo['faixa_inicio']."',
                            '".$resultado_FaixaCepAdministrativo['faixa_fim']."',
                            '".$preco."',
                            '".$codigo_loja."',
                            '".$id_loja."',
                            '".$id."'
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
        $sql_FaixasCEP = mysqli_query($conexao,"SELECT * FROM FaixasCEP WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and IdAdministrativo <> ''") or die("Erro");
        $total_FaixasCEP = mysqli_num_rows($sql_FaixasCEP);
        while($linhas_FaixasCEP=mysqli_fetch_assoc($sql_FaixasCEP)){
            $idCep    .= $linhas_FaixasCEP['IdAdministrativo'].', ';
        }
        $ids = $idCep;
        if($total_FaixasCEP > 0){
            $sql_ceps = mysqli_query($conexao,"SELECT * FROM FaixaCepAdministrativo WHERE cidade LIKE '%".$url[2]."%' and id NOT IN (".substr($ids, 0, -2).")") or die("Erro");
        } else {
            $sql_ceps = mysqli_query($conexao,"SELECT * FROM FaixaCepAdministrativo WHERE cidade LIKE '%".$url[2]."%'") or die("Erro");
        }
        $total_registro = mysqli_num_rows($sql_ceps);
        ?>
        Bairro encotrados: <?php echo $total_registro;?>
        <table class="table">
            <thead>
                <tr>
                    <th>Bairro</th>
                    <th>Faixa cep</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php while($linhas_ceps=mysqli_fetch_assoc($sql_ceps)){ ?>
                    <tr>
                        <td><?php echo $linhas_ceps['titulo'];?>/<?php echo $linhas_ceps['cidade'];?></td>
                        <td><?php echo $linhas_ceps['faixa_inicio'];?> - <?php echo $linhas_ceps['faixa_fim'];?></td>
                        <td><input type="text" name="preco_<?php echo $linhas_ceps['id']; ?>" class="form-control" placeholder="Preço" onKeyPress="return(myfunction(this,'','.',event))"></td>
                    </tr>
                    <input type="hidden" name="id_<?php echo $linhas_ceps['id']; ?>" value="<?php echo $linhas_ceps['id']; ?>" >
                <?php } ?>
                <button type="submit" class="btn btn-success" style="float: right;">Gravar Frete</button>
            </tbody>
        </table>
        
        <?php
    }
}