<?php echo $object_item->AdicionarProduto();?>
<form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
<div class="container">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" class="btn btn-primary" href="#home" style="margin: 4px;">Dados</a></li>
        <li><a data-toggle="tab" class="btn btn-primary" href="#menu1" style="margin: 4px;">Preços</a></li>
        <li><button class="btn btn-success" name="btn_AddProduto" type="submit" style="margin: 4px;">Enviar produto</button></li>
            
    </ul>

    <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <br>
        <div class="col-6">
            <div class="form-floating">
                <div class="btn-group">
                    <input type="radio" class="btn-check" name="consumo_local" id="option1" value="1" autocomplete="off" />
                    <label class="btn btn-success" for="option1">Apenas consumo no local</label>
                                                    
                    <input type="radio" class="btn-check" name="consumo_local" id="option2" value="" autocomplete="off" checked/>
                    <label class="btn btn-success" for="option2">Local e delivery</label>
                </div>
            </div>
            <label for="subject">Consumir no local</label>
        </div>
        <br>
      <div class="row g-3">
        <div class="col-8">
            <div class="form-floating">
                <input type="text" class="form-control" name="titulo" placeholder="Título" value="<?php echo $resultado_item['titulo'];?>" required>
                <label for="subject">Título</label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-floating">
                <input type="text" class="form-control" name="ean" placeholder="Código EAN" value="<?php echo $resultado_item['ean'];?>" required>
                <label for="subject">Código EAN</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-floating">
                <select class="form-control" name="categoria" required>
                    <?php 
                        $sql_Categoriap = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE id = '".$resultado_item['categoria']."'") or die("Erro");
                        $resultado_Categoriap = mysqli_fetch_assoc($sql_Categoriap);
                    ?>
                    <option value="<?php echo $resultado_Categoriap['id'];?>"><?php echo $resultado_Categoriap['titulo'];?></option>
                    <?php while($linhas_Categorias = mysqli_fetch_assoc($sql_Categorias)){ ?>
                        <?php if($resultado_item['categoria'] <> $linhas_Categorias['id']){ ?>
                            <option value="<?php echo $linhas_Categorias['id'];?>"><?php echo $linhas_Categorias['titulo'];?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <label for="subject">Categoria</label>
            </div>
        </div>
        <div class="col-12">
            <textarea class="form-control" name="descricao" style="width: 100%; height: 200px;" placeholder="Ex: Produtos frescos e de primeira qualidade"><?php echo $resultado_item['descricao'];?></textarea>
        </div> 
                                        
        <div class="col-12"><hr></div>
                                        
        <b style="color: grey;">Adicionais</b>
        <?php $adicionais = substr($resultado_item['adicionais'],0,-2);?>
        <?php if($resultado_item['adicionais'] <> ''){ ?>
            <?php $sql_Adicionalp      = mysqli_query($conexao,"SELECT * FROM adicional WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id NOT IN (".$adicionais.")") or die("Erro1"); ?>
            <?php while($linhas_Adicionalp = mysqli_fetch_assoc($sql_Adicionalp)){ ?>
                <div class="col-1">
                    <label style="cursor: pointer;"><input type="checkbox" value="<?php echo $linhas_Adicionalp['id'];?>" onclick="addOrRemoveValue(this)" > <?php echo $linhas_Adicionalp['titulo'];?></label>
                </div>
            <?php } ?>
            <?php $sql_Adicionalcheck      = mysqli_query($conexao,"SELECT * FROM adicional WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id IN (".$adicionais.")") or die("Erro2"); ?>
            <?php while($linhas_Adicionalcheck = mysqli_fetch_assoc($sql_Adicionalcheck)){ ?>
                <div class="col-1">
                    <label style="cursor: pointer;"><input type="checkbox" value="<?php echo $linhas_Adicionalcheck['id'];?>" onclick="addOrRemoveValue(this)" checked> <?php echo $linhas_Adicionalcheck['titulo'];?></label>
                </div>
            <?php } ?>
        <?php } else { ?>
            <?php $sql_Adicionalcheck      = mysqli_query($conexao,"SELECT * FROM adicional WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro2"); ?>
            <?php while($linhas_Adicionalcheck = mysqli_fetch_assoc($sql_Adicionalcheck)){ ?>
                <div class="col-1">
                    <label style="cursor: pointer;"><input type="checkbox" value="<?php echo $linhas_Adicionalcheck['id'];?>" onclick="addOrRemoveValue(this)"> <?php echo $linhas_Adicionalcheck['titulo'];?></label>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="col-12">
            <textarea class="form-control" name="adicionais" style="width: 100%; height: 120px;" id="myTextarea" readonly><?php echo $resultado_item['adicionais'];?></textarea>
        </div>
        <div class="col-12">
            <b style="color: grey;">Foto do produto</b>
            <input type="file" class="form-control" name="imagem"/>
        </div>
        
        <?php
            if($resultado_item['destaque'] == '2'){
                $check_ativo    = 'checked';
            } else {
                $check_inativo  = 'checked';
            }
        ?>
        <div class="col-12"><br></div>
        <div class="col-6">
            <div class="form-floating">
                <div class="btn-group">
                    <input type="radio" class="btn-check" name="destaque" id="destaque1" value="2" autocomplete="off" <?php echo $check_ativo;?> />
                    <label class="btn btn-success" for="destaque1">Ativo</label>
                                                            
                    <input type="radio" class="btn-check" name="destaque" id="destaque2" value="1" autocomplete="off" <?php echo $check_inativo;?> />
                    <label class="btn btn-success" for="destaque2">Inativo</label>
                </div>
            </div>
            <label for="subject">Destaque</label>
        </div>
                                        
        <?php
            if($resultado_item['status'] == '2'){
                $checkStatus_ativo    = 'checked';
            } else {
                $checkStatus_inativo  = 'checked';
            }
        ?>
        <div class="col-6">
            <div class="form-floating">
                <div class="btn-group">
                    <input type="radio" class="btn-check" name="status" id="option1" value="2" autocomplete="off" <?php echo $checkStatus_ativo;?> />
                    <label class="btn btn-success" for="option1">Ativo</label>
                                                    
                    <input type="radio" class="btn-check" name="status" id="option2" value="1" autocomplete="off" <?php echo $checkStatus_inativo;?> />
                    <label class="btn btn-success" for="option2">Inativo</label>
                </div>
            </div>
            <label for="subject">Status</label>
        </div>
        
    </div>
    </div>
    <div id="menu1" class="tab-pane fade">
        <br>
        <div class="row g-3">
            <div class="col-4">
                <div class="form-floating">
                    <input type="text" class="form-control" name="preco_venda" placeholder="Título" value="<?php echo $resultado_item['preco_venda'];?>" onKeyPress="return(myfunction(this,'','.',event))" required>
                    <label for="subject">Preço de venda</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-floating">
                    <input type="text" class="form-control" name="preco_custo" placeholder="Título" value="<?php echo $resultado_item['preco_custo'];?>" onKeyPress="return(myfunction(this,'','.',event))" required>
                    <label for="subject">Preço de custo</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-floating">
                    <input type="text" class="form-control" name="estoque" placeholder="Título" value="<?php echo $resultado_item['estoque'];?>" required>
                    <label for="subject">Estoque</label>
                </div>
            </div>
        </div>
    </div>
    <br>
</form>
  </div>
</div>
<script>
function addOrRemoveValue(checkbox) {
  var textarea = document.getElementById("myTextarea");
  var currentValue = textarea.value;
  var checkboxValue = checkbox.value;

  if (checkbox.checked) {
    // Adiciona o valor do checkbox ao textarea se ainda não estiver lá
    if (currentValue.indexOf(checkboxValue) === -1) {
      textarea.value += checkboxValue + ", ";
    }
  } else {
    // Remove o valor do checkbox do textarea se ele estiver lá
    if (currentValue.indexOf(checkboxValue) !== -1) {
      textarea.value = currentValue.replace(checkboxValue + ", ", "");
      // Se o valor estava no início do textarea, remover a quebra de linha adicional
      if (textarea.value.indexOf(", ") === 0) {
        textarea.value = textarea.value.substring(1);
      }
    }
  }
}
</script>