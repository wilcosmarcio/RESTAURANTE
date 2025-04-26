
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Criar uma nova avalição</h4>
      </div>
      <div class="modal-body">
        <p>Atenção! Sua avalição passará por análise, e será publicada em até 24 horas.</p>
        <hr>
        <form action="" method="POST">
			<div class="estrelas">
				<input type="radio" id="vazio" name="estrela" value="" checked>
				
				<label for="estrela_um" style="font-size: 37px; cursor: pointer;"><i class="fa"></i></label>
				<input type="radio" id="estrela_um" name="estrela" value="1">
				
				<label for="estrela_dois" style="font-size: 37px; cursor: pointer;"><i class="fa"></i></label>
				<input type="radio" id="estrela_dois" name="estrela" value="2">
				
				<label for="estrela_tres" style="font-size: 37px; cursor: pointer;"><i class="fa"></i></label>
				<input type="radio" id="estrela_tres" name="estrela" value="3">
				
				<label for="estrela_quatro" style="font-size: 37px; cursor: pointer;"><i class="fa"></i></label>
				<input type="radio" id="estrela_quatro" name="estrela" value="4">
				
				<label for="estrela_cinco" style="font-size: 37px; cursor: pointer;"><i class="fa"></i></label>
				<input type="radio" id="estrela_cinco" name="estrela" value="5"><br><br>
				
			</div>
            <br>
            <textarea class="form-control" name="comentario" placeholder="Escreva sua mensagem"></textarea>
            <br>
            <input type="submit" name="btnAvaliar" class="btn btn-primary" value="Enviar avaliação">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar janela</button>
      </div>
    </div>

  </div>
</div>