
        <br><br>
<div class="row">
                <div class="col-lg-12">
                    <h4>Dados Delivery</h4>
                    <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="nome_empresa" value="<?php echo $resultado_sobre['nome_empresa'];?>" placeholder="Nome empresa">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="titulo_util" value="<?php echo $resultado_sobre['titulo_util'];?>" placeholder="Descrição curta">
                                </div>
                                
                                <div class="col-12 text-center"><br></div>
                                
                                <div class="col-4">
                                    <input type="text" class="form-control" name="facebook" value="<?php echo $resultado_sobre['link_facebook'];?>" placeholder="Facebook">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="instagram" value="<?php echo $resultado_sobre['link_instagram'];?>" placeholder="Instagram">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="whatsapp" value="<?php echo $resultado_sobre['whatsapp'];?>" placeholder="WhastApp">
                                </div>
                                
                                <div class="col-12 text-center"><br></div>
                                
                                <div class="col-12">
                                    <textarea class="form-control" name="sobre" style="width: 100%; height: 200px;" placeholder="Sobre a empresa"><?php echo $resultado_sobre['sobre'];?></textarea>
                                </div>
                                
                                <div class="col-12 text-center"><br></div>
                                
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" name="BtnEditarSobre" type="submit">Atualizar</button>
                                </div>
                            </div>
                            <input type="hidden" name="url_redirect" value="https://<?php echo $host;?>/dashboard">
                    </form>
                        <br><br>
                </div>
            
            </div>
















