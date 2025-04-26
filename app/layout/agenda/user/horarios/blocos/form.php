<br><br>
<div class="row">
    <div class="col-lg-12">
        <h4>horários de funcionamento</h4>
        <form action="" method="POST">
            <div class="row g-3">
                <div class="col-12">Segunda</div>
                <div class="col-6">
                    <b>Abertura</b>
                    <input type="text" class="form-control" name="abertura_seg" value="<?php echo $resultado_sobre['abertura_seg'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-6">
                    <b>Fechamento</b>
                    <input type="text" class="form-control" name="fechamento_seg" value="<?php echo $resultado_sobre['fechamento_seg'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-12 text-center"><br></div>
                <div class="col-12">Terça</div>
                <div class="col-6">
                    <b>Abertura</b>
                    <input type="text" class="form-control" name="abertura_ter" value="<?php echo $resultado_sobre['abertura_ter'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-6">
                    <b>Fechamento</b>
                    <input type="text" class="form-control" name="fechamento_ter" value="<?php echo $resultado_sobre['fechamento_ter'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-12 text-center"><br></div>
                <div class="col-12">Quarta</div>
                <div class="col-6">
                    <b>Abertura</b>
                    <input type="text" class="form-control" name="abertura_qua" value="<?php echo $resultado_sobre['abertura_qua'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-6">
                    <b>Fechamento</b>
                    <input type="text" class="form-control" name="fechamento_qua" value="<?php echo $resultado_sobre['fechamento_qua'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-12 text-center"><br></div>
                <div class="col-12">Quinta</div>
                <div class="col-6">
                    <b>Abertura</b>
                    <input type="text" class="form-control" name="abertura_qui" value="<?php echo $resultado_sobre['abertura_qui'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-6">
                    <b>Fechamento</b>
                    <input type="text" class="form-control" name="fechamento_qui" value="<?php echo $resultado_sobre['fechamento_qui'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-12 text-center"><br></div>
                <div class="col-12">Sexta</div>
                <div class="col-6">
                    <b>Abertura</b>
                    <input type="text" class="form-control" name="abertura_sex" value="<?php echo $resultado_sobre['abertura_sex'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-6">
                    <b>Fechamento</b>
                    <input type="text" class="form-control" name="fechamento_sex" value="<?php echo $resultado_sobre['fechamento_sex'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-12 text-center"><br></div>
                <div class="col-12">Sabado</div>
                <div class="col-6">
                    <b>Abertura</b>
                    <input type="text" class="form-control" name="abertura_sab" value="<?php echo $resultado_sobre['abertura_sab'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-6">
                    <b>Fechamento</b>
                    <input type="text" class="form-control" name="fechamento_sab" value="<?php echo $resultado_sobre['fechamento_sab'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-12 text-center"><br></div>
                <div class="col-12">Domingo</div>
                <div class="col-6">
                    <b>Abertura</b>
                    <input type="text" class="form-control" name="abertura_dom" value="<?php echo $resultado_sobre['abertura_dom'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-6">
                    <b>Fechamento</b>
                    <input type="text" class="form-control" name="fechamento_dom" value="<?php echo $resultado_sobre['fechamento_dom'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                </div>
                <div class="col-12 text-center"><br></div>
                
                <div class="col-12 text-center">
                    <button class="btn btn-primary rounded-pill py-3 px-5" name="BtnHorarios" type="submit">Atualizar</button>
                </div>
            </div>
            <input type="hidden" name="url_redirect" value="https://<?php echo $host;?>/dashboard">
        </form>
        <br><br>
    </div>
</div>
<script>
function formatarHora(input) {
    var cleaned = input.value.replace(/\D/g, '');
    if (cleaned.length > 2) {
        cleaned = cleaned.substring(0, 2) + ':' + cleaned.substring(2);
    }
    input.value = cleaned;
}
</script>