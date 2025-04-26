<br><br>
<div class="row">
    <?php echo $msg_reset_password;?>
        <div class="col-lg-12">
            <h4>Redefinir senha</h4>
            <form action="https://<?php echo $host;?>/user/reset_password/request" method="POST">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" id="subject" placeholder="Subject">
                                <label for="subject">E-mail</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <a href="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/user">Acessar minha conta</a>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5" name="btn_reset_password" type="submit">Gerar nova senha</button>
                        </div>
                    </div>
                    <input type="hidden" name="url_redirect" value="<?php echo $url_completa;?>">
            </form>
                <br><br>
        </div>
</div>