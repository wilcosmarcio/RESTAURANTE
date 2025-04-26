<br>
<b>Olá <?php echo $nome_user;?></b>
<?php include('app/helpers/user/update_cadastro/update.php');?>
<form action="" method="POST">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="nome" id="name" placeholder="Nome completo" value="<?php echo $resultado_user_cookie['nome'];?>" required>
                <label for="name">Nome completo</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="search_cpf"  placeholder="CPF" value="<?php echo $resultado_user_cookie['cpf'];?>" disabled>
                <label for="telefone">CPF</label>
            </div>
            <ul class="check_cpf"></ul>
        </div>
        
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="<?php echo $resultado_user_cookie['telefone'];?>" required>
                <label for="telefone">Telefone</label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-floating">
                <input type="email" class="form-control" id="search_email" placeholder="E-mail" value="<?php echo $resultado_user_cookie['email'];?>" disabled>
                <label for="telefone">E-mail</label>
            </div>
            <ul class="check_email"></ul>
        </div>
        <div class="col-md-12"><hr></div>
        <div class="col-md-12">
            <div class="form-floating">
                <input name="cep" type="text" class="form-control" id="cep" size="10" maxlength="9" value="<?php echo $resultado_user_cookie['cep'];?>" required/>
                <label for="telefone">CEP</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input name="rua" type="text" class="form-control" id="rua" size="60" value="<?php echo $resultado_user_cookie['rua'];?>" required/>
                <label for="telefone">Rua</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating">
                <input name="numero" type="text" class="form-control" id="numero" size="60" value="<?php echo $resultado_user_cookie['numero'];?>" required/>
                <label for="telefone">Numero</label>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-floating">
                <input name="bairro" type="text" class="form-control" id="bairro" size="40" value="<?php echo $resultado_user_cookie['bairro'];?>" required />
                <label for="telefone">Bairro</label>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="form-floating">
                <input name="cidade" type="text" class="form-control" id="cidade" size="40" value="<?php echo $resultado_user_cookie['cidade'];?>" required/>
                <label for="telefone">Cidade</label>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-floating">
                <input name="uf" type="text" class="form-control" id="uf" size="2" value="<?php echo $resultado_user_cookie['uf'];?>" required/>
                <label for="telefone">UF</label>
            </div>
        </div>
        <div class="col-12">
            <b>Atualizar senha:</b>
            <div class="form-floating">
                <input type="password" class="form-control" name="senha" id="subject" placeholder="Senha">
                <label for="subject">Senha</label>
            </div>
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="btn_atualizar">Atualizar</button>
        </div>
    </div>
</form>
<br>