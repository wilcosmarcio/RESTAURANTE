<script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }
        
        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });
</script>

<?php echo $msg_erro;?>
        <br><br>
<div class="row">
    <?php echo $msg_reset_password;?>
    <div class="col-lg-6">
        <h4>Acesse sua conta</h4>
        <form action="https://<?php echo $host;?>/verificar/index.php" method="POST">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="codigo_loja" id="subject" placeholder="Loja">
                            <label for="subject">Loja</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="email" id="subject" placeholder="E-mail">
                            <label for="subject">E-mail</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="senha" id="subject" placeholder="Senha">
                            <label for="subject">Senha</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <input class="form-check-input" type="checkbox" name="conectado" value="1" id="flexCheckIndeterminate" checked>
                        <label class="form-check-label" for="flexCheckIndeterminate">
                            Mantenha-me conectado
                        </label> 
                    </div>
                    <div class="col-12 text-center">
                        <a href="https://<?php echo $host;?>/user/reset_password">Esqueci minha senha</a>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary rounded-pill py-3 px-5" name="btn_logar" type="submit">Entrar</button>
                    </div>
                </div>
                <input type="hidden" name="url_redirect" value="https://<?php echo $host;?>/dashboard">
        </form>
            <br><br>
    </div>
    <div class="col-lg-6">
        <h4>Cadastre-se</h4>
        <form action="" method="POST">
                <div class="row g-3">
                    <div class="col-md-12">
                        <b>Plano mensal (Teste por 7 dias)</b>
                        <select class="form-control" name="plano">
                            <?php while($linhasPlanos = mysqli_fetch_assoc($sql_planos)){ ?>
                                <option value="<?php echo $linhasPlanos['id'];?>"><?php echo $linhasPlanos['plano'];?> - R$ <?php echo $linhasPlanos['valor'];?> /Mês</option>
                            <?php } ?>
                        </select>
                        <a href="https://<?php echo $host;?>/#planos" target="_BLANK">Detalhes dos planos</a>
                    </div>
                    <div class="col-md-12"><hr></div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="nome_empresa" id="name" placeholder="Nome empresa" required>
                            <label for="name">Nome empresa</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="RazaoSocial" id="name" placeholder="Razão social" required>
                            <label for="name">Razão social</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="cnpj" id="search_cnpj"  placeholder="CNPJ" required>
                            <label for="telefone">CNPJ</label>
                        </div>
                        <ul class="check_cnpj"></ul>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone" required>
                            <label for="telefone">Telefone</label>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12"><hr></div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input name="cep" type="text" class="form-control" id="cep" value="" size="10" maxlength="9"  required/>
                            <label for="telefone">CEP</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="rua" type="text" class="form-control" id="rua" size="60"  required/>
                            <label for="telefone">Rua</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input name="numero" type="text" class="form-control" id="numero" size="60"  required/>
                            <label for="telefone">Numero</label>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input name="bairro" type="text" class="form-control" id="bairro" size="40" required />
                            <label for="telefone">Bairro</label>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="form-floating">
                            <input name="cidade" type="text" class="form-control" id="cidade" size="40"  required/>
                            <label for="telefone">Cidade</label>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input name="uf" type="text" class="form-control" id="uf" size="2" required/>
                            <label for="telefone">UF</label>
                        </div>
                    </div>
                    <div class="col-md-12"><hr></div>
                    <div class="col-md-12">
                        <b>E-mail (login administrador):</b>
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="search_email" placeholder="E-mail" required>
                            <label for="telefone">E-mail</label>
                        </div>
                        <ul class="check_email"></ul>
                    </div>
                    <div class="col-12">
                        <b>Crie uma senha:</b>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="senha" id="subject" placeholder="Senha" required>
                            <label for="subject">Senha</label>
                        </div>
                    </div>
                    <input type="hidden" name="conectado" value="1" id="flexCheckIndeterminate">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="btn_gravar" style="width: 100%;">Cadastrar</button>
                    </div>
                </div>
            </form>
    </div>
</div>
<script>
$(function(){
	$("#search_cnpj").keyup(function(){
		//Recuperar o valor do campo
		var search_cnpj = $(this).val();
		
		//Verificar se há algo digitado
		if(search_cnpj != ''){
			var dados = {
				palavra : search_cnpj
			}
			$.post('https://<?php echo $host;?>/app/helpers/user/check/?object=cnpj', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$(".check_cnpj").html(retorna);
			});
		}
	});
});

$(function(){
	$("#search_email").keyup(function(){
		//Recuperar o valor do campo
		var search_email = $(this).val();
		
		//Verificar se há algo digitado
		if(search_email != ''){
			var dados = {
				palavra : search_email
			}
			$.post('https://<?php echo $host;?>/app/helpers/user/check/?object=email', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$(".check_email").html(retorna);
			});
		}
	});
});
</script>