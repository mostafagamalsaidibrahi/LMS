@include('doctor.header')

@yield('content')
<!-- Slider --><br>
<div class="slider-section">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?php echo asset('images/img1.jpg') ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?php echo asset('images/img2.jpg') ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?php echo asset('images/img3.jpg') ?>" class="d-block w-100" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</div>

<!-- About --><br><br><br><br><br>
<div class="about">
    <h1>About Us</h1>
    <br><br>
    <p>
      A university (Latin: universitas, 'a whole') is an institution of higher (or tertiary) education and research,
      which awards academic degrees in various academic disciplines.
      Universities typically provide undergraduate education and postgraduate education.

      The word university is derived from the Latin universitas magistrorum et scholarium,
      which roughly means "community of teachers and scholars".
      The modern university system has roots in the European medieval university,
      which was created in Italy and evolved from cathedral schools for the clergy during the High Middle Ages.
      An important idea in the definition of a university is the notion of academic freedom. The first documentary evidence of this comes from early in the life of the University of Bologna,
      which adopted an academic charter, the Constitutio Habita,
      in 1158 or 1155,
      which guaranteed the right of a traveling scholar to unhindered passage in the interests of education.
      Today this is claimed as the origin of "academic freedom".
      This is now widely recognised internationally - on 18 September 1988,
      430 university rectors signed the Magna Charta Universitatum,
      marking the 900th anniversary of Bologna's foundation.
      The number of universities signing the Magna Charta Universitatum continues to grow,
      drawing from all parts of the world.
    </p>

</div>

@include('doctor.footer')
