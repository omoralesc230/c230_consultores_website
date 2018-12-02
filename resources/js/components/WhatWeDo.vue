<style>
  .sidenav-space{
    max-width:250px;
  }
  .bg-grey-black{
    background-color:#4a4a4a;
  }
  .bg-grey{
    background-color:#7a7a7a;
  }
  .full-height{
    height:100vh;
  }
  .half-height{
    height: 40vh;
  }
  .chess {
    padding: 10%;
  }
  .particles-content{
    position: absolute;
    padding: 10%;
  }
</style>
<template>
  <div>
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col bg-grey-black">
        <div class="container">
          <div class="row justify-content-md-center align-items-center full-height">
            <div class="col-sm-12 col-md-10 col-lg-10 text-light text-center">
              <div class="row justify-content-md-center">
                <div class="col-md-4">
                  <img src="/img/whatwedo/svg/hexagon.svg" alt="circles" style="width:40%;">
                  <p>Generamos insumos para apoyar la toma de decisiones de nuestros clientes</p>
                </div>
              </div>
              <h2 class="font-weight-light">C230 Consultores</h2>
              <h1 class="display-4 font-weight-bold">¿Qué hacemos?</h1>
              <div class="row">
                <div class="col-md-2">
                  <img src="/img/whatwedo/svg/circles.svg" alt="circles">
                  <p>Ayudamos a resolver problemas</p>
                </div>
                <div class="col-md-8">
                  <img src="/img/whatwedo/svg/line.svg" alt="line">
                </div>
                <div class="col-md-2">
                  <img src="/img/whatwedo/svg/triangle.svg" alt="triangle">
                  Añadimos valor al trabajo de nuestros clientes
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col bg-white">
        <div class="row">
          <div class="container">
            <h1 class="mt-4 text-center">¿En qué trabajamos?</h1>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 bg-grey-black">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/svg/strategies.svg" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
              <h4 class="text-white text-center text-uppercase mt-4">Estrategias</h4>
              <p class="text-white">
                Diseño, evaluación, análisis e implementación de programas, indicadores y soluciones que redunden en el beneficio de la sociedad, la economía y el medio ambiente.
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/svg/public_policies.svg" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
              <h4 class="text-center text-uppercase mt-4">Políticas públicas</h4>
              <p>
                Buscamos alinear intereses de diferentes grupos políticos sociales y económicos bajo una visión común que les permita desarrollarse y prosperar sosteniblemente.
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 bg-grey-black order-1 order-md-2">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/svg/public_initiatives.svg" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
              <h4 class="text-white text-center text-uppercase mt-4">Iniciativas públicas</h4>
              <p class="text-white">
                Trabajamos en proyectos que involucran al gobierno y que tienen con fin último un beneficio positivo en México.
              </p>
            </div>}
          </div>
          <div class="col-md-6 order-2 order-md-1">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/svg/public_problems.svg" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
              <h4 class="text-center text-uppercase mt-4">Problemas públicos</h4>
              <p>
                Analizamos recursos y oportunidades de desarrollo que afecten a la calidad de vida de las personas, comunidades y el entorno que las sostiene.
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col bg-white" style="min-height: 60vh;">
        <div class="container particles-content">
          <h1>Soluciones digitales</h1>
          <hr>
          <div class="row justify-content-md-center align-items-center" style="margin-top:3rem;">
            <div class="col-sm-12 col-md-10 col-lg-10">
              <h4 class="text-uppercase text-center">¿Qué hacemos?</h4>
              <p class="text-center">
                Diseñamos e implementamos soluciones digitales para innovar en estrategias, políticas e iniciativas públicas.
              </p>
            </div>
          </div>
        </div>
        <vue-particles
        color="#ff762b"
        :particleOpacity="0.7"
        :particlesNumber="150"
        shapeType="circle"
        :particleSize="4"
        linesColor="#dedede"
        :linesWidth="1"
        :lineLinked="true"
        :lineOpacity="0.4"
        :linesDistance="150"
        :moveSpeed="3"
        :hoverEffect="true"
        hoverMode="grab"
        :clickEffect="true"
        clickMode="push">
        </vue-particles>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col bg-white">
        <div class="row">
          <div class="col-md-6 bg-grey-black">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/hexagon.png" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="container mb-4 chess">
              <h4 class="mt-4">Ideación de soluciones digitales basadas en principios de diseño centrado en el usuario:</h4>
              <ul>
                <li>Aplicaciones web</li>
                <li>Aplicaciones móviles</li>
                <li>Diseño de bases de datos y API's</li>
                <li>Visualización de datos</li>
                <li>Plataformas digitales para monitoreo de indicadores</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 bg-grey-black order-1 order-md-2">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/circle.png" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
            </div>
          </div>
          <div class="col-md-6 order-2 order-md-1">
            <div class="container mb-4 chess">
              <h4 class="mt-4">Diseño de experiencias e interfaces para soluciones digitales (UI/UX):</h4>
              <ul>
                <li>User Interface</li>
                <li>User Experience</li>
                <li>Principios de Interación para plataformas</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 bg-grey-black">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/diamond.png" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="container mb-4 chess">
              <h4 class="mt-4">Desarrollo e implementación de soluciones digitales</h4>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 bg-grey-black order-1 order-md-2">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/triangle.png" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
            </div>
          </div>
          <div class="col-md-6 order-2 order-md-1">
            <div class="container mb-4 chess">
              <h4 class="mt-4">Desarrollo y prototipado de software y arquitectura de información</h4>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 bg-grey-black">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/double_cube.png" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="container mb-4 chess">
              <h4 class="mt-4">Implementación de metodología ágil para desarrollo de software</h4>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 bg-grey-black order-1 order-md-2">
            <div class="container mb-4 chess">
              <v-lazy-image src="/img/whatwedo/cube.png" src-placeholder="" class="img-fluid mx-auto d-block mt-4" style="width:40%;" alt="strategies"/>
            </div>
          </div>
          <div class="col-md-6 order-2 order-md-1">
            <div class="container mb-4 chess">
              <h4 class="mt-4">Talleres de diseño estratégico y metodologías de diseño de productos y servicios</h4>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</template>

<script>
export default {
  mounted() {
    this.$parent.active_el = this.$route.path;
    console.log('Component mounted.')
  }
}
</script>
