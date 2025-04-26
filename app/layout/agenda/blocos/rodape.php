<footer id="footer">
<div class="container">
  <div class="copyright">
    &copy; Copyright <strong><span>Kifomi Cardápio e webdelivery</span></strong>. Todos os direitos reservados.
  </div>
  <div class="credits">
    Desenvolvido por: <a href="https://www.instagram.com/maycon_bragaa">Maycon Braga</a>
  </div>
</div>
</footer><!-- End Footer -->
<!-- Vendor JS Files -->
<script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/aos/aos.js"></script>
<script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/js/main.js"></script>

<script>
function formatarCEP(input) {
    // Remover caracteres não numéricos
    let cep = input.value.replace(/\D/g, '');

    // Adicionar a máscara
    cep = cep.replace(/^(\d{5})(\d)/, '$1-$2');

    // Atualizar o valor do campo de entrada
    input.value = cep;
}
</script>