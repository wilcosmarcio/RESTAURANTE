
        <br><br>
<div class="row">
    <?php echo $msg_reset_password;?>
                <div class="col-lg-12">
                    <h4>Olá <?php echo $nome_user;?>! Digite sua nova senha:</h4>
                    <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="senha_user" id="subject" placeholder="Subject">
                                        <label for="subject">Nova senha</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" name="btn_reset_password" type="submit">Salvar</button>
                                </div>
                            </div>
                            <input type="hidden" name="url_redirect" value="<?php echo $url_completa;?>">
                    </form>
                        <br><br>
                </div>
                
            </div>