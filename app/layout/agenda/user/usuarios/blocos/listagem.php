<?php $sql_blog_config = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and principal = '' ORDER BY id DESC ") or die("Erro2");?>
<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Último login</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php while($linhas_produtos=mysqli_fetch_assoc($sql_blog_config)){ ?> 
        <div id="myModal-<?php echo $linhas_produtos['id'];?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <b>Deseja remover: <?php echo $linhas_produtos['nome'];?>?</b>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="https://<?php echo $host;?>/user/usuarios/remover/<?php echo $linhas_produtos['id'];?>" style="width: 100%;" class="btn btn-danger">Remover <i class="fa fa-trash"></i></a>
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
        </div>
        <div id="myModal-editar-<?php echo $linhas_produtos['id'];?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <b>Atualizar: <?php echo $linhas_produtos['titulo'];?>?</b>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $linhas_produtos['id'];?>">
                            <div class="row">
                                <div class="col-12">
                                    <b>Nome</b>
                                    <input type="text" class="form-control" name="nome" value="<?php echo $linhas_produtos['nome'];?>">
                                </div>
                                <div class="col-12"><br></div>
                                <div class="col-12">
                                    <b>Login</b>
                                    <input type="text" class="form-control" name="login" value="<?php echo $linhas_produtos['login'];?>">
                                </div>
                                <div class="col-12"><br></div>
                                <div class="col-12">
                                    <b>Senha</b>
                                    <input type="password" class="form-control" name="senha" autocomplete="new-password">
                                </div>
                                <div class="col-12"><br></div>
                                <div class="col-12">
                                    <input type="submit" class="btn btn-success" name="btnatualizar" value="Atualizar">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                    </div>
                </div>
                        
            </div>
        </div>
        <tr>
            <td><a ><?php echo $linhas_produtos['nome'];?></a></td>
            <td><a ><?php echo $linhas_produtos['login'];?></a></td>
            <td><a ><?php echo $linhas_produtos['ultimo_acesso'];?></a></td>
            <td>
                <a data-toggle="modal" data-target="#myModal-editar-<?php echo $linhas_produtos['id'];?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a data-toggle="modal" data-target="#myModal-<?php echo $linhas_produtos['id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>