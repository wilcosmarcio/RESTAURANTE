<div class="container">
    <div class="row">
        <div class="col">
            <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top">
                        <div class="inner-circle"></div>
                        <p class="h6 mt-3 mb-1"><?php echo $resultadoComandaInt['data_completa'];?></p>
                        <p class="h6 text-muted mb-0 mb-lg-0">Novo pedido</p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title>
                        <?php if($resultadoComandaInt['data_status_2'] == '' && $resultadoComandaInt['data_status_5'] == ''){?>
                            <div class="inner-circle-off"></div>
                            <p class="h6 mt-3 mb-1">...</p>
                            <form id="FormAdd" data-form-id="2">
                                <input type="hidden" name="status" value="2">
                                <input type="submit" name="status_2" class="btn btn-primary" value="Preparando">
                            </form>
                        <?php } else { ?>
                            <div class="inner-circle"></div>
                            <p class="h6 mt-3 mb-1"><?php echo $resultadoComandaInt['data_status_2'];?></p>
                            <input type="submit" class="btn btn-primary" value="Preparando" disabled>
                        <?php } ?>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title>
                        <?php if($resultadoComandaInt['data_status_3'] == '' && $resultadoComandaInt['data_status_5'] == ''){?>
                            <div class="inner-circle-off"></div>
                            <p class="h6 mt-3 mb-1">...</p>
                            <form id="FormAdd" data-form-id="3">
                                <input type="hidden" name="status" value="3">
                                <input type="submit" name="status_3" class="btn btn-primary" value="Saiu para entrega">
                            </form>
                        <?php } else { ?>
                            <div class="inner-circle"></div>
                            <p class="h6 mt-3 mb-1"><?php echo $resultadoComandaInt['data_status_3'];?></p>
                            <input type="submit" class="btn btn-primary" value="Saiu para entrega" disabled>
                        <?php } ?>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title>
                        <?php if($resultadoComandaInt['data_status_4'] == '' && $resultadoComandaInt['data_status_5'] == ''){?>
                            <div class="inner-circle-off"></div>
                            <p class="h6 mt-3 mb-1">...</p>
                            <form id="FormAdd" data-form-id="4">
                                <input type="hidden" name="status" value="4">
                                <input type="submit" name="status_4" class="btn btn-primary" value="Concluído">
                            </form>
                        <?php } else { ?>
                            <div class="inner-circle"></div>
                            <p class="h6 mt-3 mb-1"><?php echo $resultadoComandaInt['data_status_4'];?></p>
                            <input type="submit" class="btn btn-primary" value="Concluído" disabled>
                        <?php } ?>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title>
                        <?php if($resultadoComandaInt['data_status_5'] == '' && $resultadoComandaInt['data_status_4'] == ''){?>
                            <div class="inner-circle-off"></div>
                            <p class="h6 mt-3 mb-1">...</p>
                            <form id="FormAdd" data-form-id="5">
                                <input type="hidden" name="status" value="5">
                                <input type="submit" name="status_5" class="btn btn-danger" value="Cancelar">
                            </form>
                        <?php } else { ?>
                            <div class="inner-circle"></div>
                            <p class="h6 mt-3 mb-1"><?php echo $resultadoComandaInt['data_status_5'];?></p>
                            <input type="submit" class="btn btn-danger" value="Cancelar" disabled>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>