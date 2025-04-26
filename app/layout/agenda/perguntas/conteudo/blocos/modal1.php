<div id="myModal-ask1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Responder: <?php echo $resultado_blog['titulo'];?></h4>
      </div>
      <div class="modal-body">
        <p>Atenção! Sua resposta passará por análise, e será publicada em até 24 horas.</p>
        <hr>
        <form action="" method="POST">
            <textarea class="form-control" name="resposta" placeholder="Escreva sua mensagem"></textarea>
            <br>
            <input type="submit" name="btnResponder" class="btn btn-primary" value="Enviar resposta">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar janela</button>
      </div>
    </div>

  </div>
</div>