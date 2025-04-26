<br>
<p>Defina em quais categorias seu restaurante se encaixa:</p>
<form action="" method="POST">
    <div class="row g-3">
        <?php $adicionais = substr($resultado_dados['categorias'],0,-2);?>
        <?php if($resultado_dados['categorias'] <> ''){ ?>
            <?php $sql_Adicionalp      = mysqli_query($conexao,"SELECT * FROM categorias_administrativas WHERE id NOT IN (".$adicionais.")") or die("Erro1"); ?>
            <?php while($linhas_Adicionalp = mysqli_fetch_assoc($sql_Adicionalp)){ ?>
                <div class="col-2">
                    <label style="cursor: pointer;"><input type="checkbox" value="<?php echo $linhas_Adicionalp['id'];?>" onclick="addOrRemoveValue(this)" > <?php echo $linhas_Adicionalp['titulo'];?></label>
                </div>
            <?php } ?>
            <?php $sql_Adicionalcheck      = mysqli_query($conexao,"SELECT * FROM categorias_administrativas WHERE id IN (".$adicionais.")") or die("Erro2"); ?>
            <?php while($linhas_Adicionalcheck = mysqli_fetch_assoc($sql_Adicionalcheck)){ ?>
                <div class="col-2">
                    <label style="cursor: pointer;"><input type="checkbox" value="<?php echo $linhas_Adicionalcheck['id'];?>" onclick="addOrRemoveValue(this)" checked> <?php echo $linhas_Adicionalcheck['titulo'];?></label>
                </div>
            <?php } ?>
        <?php } else { ?>
            <?php $sql_Adicionalcheck      = mysqli_query($conexao,"SELECT * FROM categorias_administrativas") or die("Erro2"); ?>
            <?php while($linhas_Adicionalcheck = mysqli_fetch_assoc($sql_Adicionalcheck)){ ?>
                <div class="col-2">
                    <label style="cursor: pointer;"><input type="checkbox" value="<?php echo $linhas_Adicionalcheck['id'];?>" onclick="addOrRemoveValue(this)"> <?php echo $linhas_Adicionalcheck['titulo'];?></label>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="col-12">
            <input type="hidden" class="form-control" name="categorias" style="width: 100%;" id="myTextarea" value="<?php echo $resultado_dados['categorias'];?>" readonly>
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="btn_seo">Atualizar</button>
        </div>
    </div>
</form>
<br>
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