<section id="testimonials" class="testimonials" >
      <div class="container" >

        <div class="testimonials-slider swiper">
          <div class="swiper-wrapper">
            <?php while($linhas_depoimentos=mysqli_fetch_assoc($sql_depoimentos)){ ?>
                <div class="swiper-slide">
                  <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <br><br>
                      <img src="uploads/<?php echo $linhas_depoimentos['file'];?>" class="testimonial-img" alt="">
                      <h3><?php echo $linhas_depoimentos['categoria'];?></h3>
                      <h4><?php echo $linhas_depoimentos['descricao'];?></h4>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        <?php echo $linhas_depoimentos['descricaocurta'];?>
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </div>
                  </div>
                </div>
            <?php } ?>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>