<style>
  .sidenav-space{
    max-width:250px;
  }
  .bg-grey-black{
    background-color:#4a4a4a;
  }
  .bg-orange {
    background-color: #ff7900;
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
  /* builings effects */
  .clouds {
    width: 70%;
    position: relative;
    animation: linear-move 4s infinite alternate;
    animation-timing-function: linear;
  }
  @keyframes linear-move {
    from {left: -100px;}
    to {left: 100px;}
  }
  .land {
    width: 70%;
  }
  /* public organizations builing */
  .public_organizations {
    width: 18%;
    position: absolute;
    left: 40%;
    opacity: 0.4;
    cursor: pointer;
    animation: up-down-move 2s infinite alternate;
    animation-timing-function: linear;
  }

  .public_organizations:hover{
    opacity: 0.9;
  }

  @keyframes up-down-move {
    from {top: 54%;}
    to {top: 56%;}
  }

  @media (min-width: 1450px) {
    .public_organizations{
      width: 17%;
      left: 40%;
    }
    @keyframes up-down-move {
      from {top: 52%;}
      to {top: 54%;}
    }
  }

  @media (min-width: 1500px) {
    .public_organizations{
      width: 16%;
      left: 41%;
    }
    @keyframes up-down-move {
      from {top: 52%;}
      to {top: 54%;}
    }
  }

  @media (min-width: 1680px) {
    .public_organizations{
      width: 14%;
      left: 43%;
    }
    @keyframes up-down-move {
      from {top: 50%;}
      to {top: 52%;}
    }
  }
  /* public organizations builing */
  /* multilateral building */
  .multilateral {
    width: 18%;
    position: absolute;
    left: 23%;
    opacity: 0.4;
    cursor: pointer;
    animation: up-down-move-multilateral 2s infinite alternate;
    animation-timing-function: linear;
  }
  .multilateral:hover {
    opacity: 0.9;
  }
  @keyframes up-down-move-multilateral {
    from {top: 35%;}
    to {top: 37%;}
  }
  @media (min-width: 1450px) {
    .multilateral{
      width: 17%;
      left: 24%;
    }
    @keyframes up-down-move-multilateral {
      from {top: 33%;}
      to {top: 35%;}
    }
  }
  @media (min-width: 1500px) {
    .multilateral{
      width: 16%;
      left: 27%;
    }
    @keyframes up-down-move-multilateral {
      from {top: 32%;}
      to {top: 34%;}
    }
  }
  @media (min-width: 1680px) {
    .multilateral{
      width: 13%;
      left: 31%;
    }
    @keyframes up-down-move-multilateral {
      from {top: 30%;}
      to {top: 32%;}
    }
  }
  /* multilateral building */
  /* international org building */
  .international_org {
    width: 15%;
    position: absolute;
    left: 47%;
    top: 65%;
    opacity: 0.4;
    cursor: pointer;
    animation: up-down-move-int-org 2s infinite alternate;
    animation-timing-function: linear;
  }
  .international_org:hover {
    opacity: 0.9;
  }
  @keyframes up-down-move-int-org {
    from {top: 65%;}
    to {top: 67%;}
  }
  @media (min-width: 1450px) {
    .international_org{
      width: 14%;
      left: 46%;
    }
    @keyframes up-down-move-int-org {
      from {top: 64%;}
      to {top: 66%;}
    }
  }
  @media (min-width: 1500px) {
    .international_org{
      width: 12%;
      left: 46%;
    }
    @keyframes up-down-move-int-org {
      from {top: 64%;}
      to {top: 66%;}
    }
  }
  @media (min-width: 1680px) {
    .international_org{
      width: 10%;
      left: 47%;
    }
    @keyframes up-down-move-int-org {
      from {top: 64%;}
      to {top: 66%;}
    }
  }
  /* international org building */
  /* private sector building */
  .private_sector {
    width: 13%;
    position: absolute;
    left: 61%;
    top: 65%;
    opacity: 0.4;
    cursor: pointer;
    animation: up-down-move-private 2s infinite alternate;
    animation-timing-function: linear;
  }
  .private_sector:hover {
    opacity: 0.9;
  }
  @keyframes up-down-move-private {
    from {top: 50%;}
    to {top: 52%;}
  }
  @media (min-width: 1450px) {
    .private_sector{
      width: 12%;
      left: 60%;
    }
    @keyframes up-down-move-private {
      from {top: 48%;}
      to {top: 50%;}
    }
  }
  @media (min-width: 1500px) {
    .private_sector{
      width: 11%;
      left: 59%;
    }
    @keyframes up-down-move-private {
      from {top: 48%;}
      to {top: 50%;}
    }
  }
  @media (min-width: 1680px) {
    .private_sector{
      width: 9%;
      left: 57%;
    }
    @keyframes up-down-move-private {
      from {top: 48%;}
      to {top: 50%;}
    }
  }
  /* private sector building */
  .selected {
    opacity: 0.9 !important;
  }
  /* builings effects */
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
            <h1 class="mt-4">¿Para Quiénes?</h1>
            <hr class="separator" style="width:30%;" align="left">
            <img class="img-fluid mx-auto clouds d-none d-lg-block" src="/img/whatwedo/svg/clouds.svg" alt="clouds">
            <img class="img-fluid mx-auto land d-none d-lg-block" src="/img/whatwedo/svg/land.svg" alt="land">
            <img :class="{ selected : modal_type == 1 }" class="img-fluid mx-auto multilateral d-none d-lg-block" src="/img/whatwedo/svg/multilateral.svg" alt="multilateral" @click="changeModal(1)">
            <img :class="{ selected : modal_type == 2 }" class="img-fluid mx-auto public_organizations d-none d-lg-block" src="/img/whatwedo/svg/public_organizations.svg" alt="public organizations" @click="changeModal(2)">
            <img :class="{ selected : modal_type == 3 }" class="img-fluid mx-auto international_org d-none d-lg-block" src="/img/whatwedo/svg/international_org.svg" alt="international_org" @click="changeModal(3)">
            <img :class="{ selected : modal_type == 4 }" class="img-fluid mx-auto private_sector d-none d-lg-block" src="/img/whatwedo/svg/private_sector.svg" alt="private_sector" @click="changeModal(4)">
            <!-- Modal -->
            <div class="modal fade" id="buildingModal" tabindex="-1" role="dialog" aria-labelledby="buildingModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-orange">
                    <h5 class="modal-title text-white" id="buildingModalLabel" v-show="modal_type == 1">Multilaterales</h5>
                    <h5 class="modal-title text-white" id="buildingModalLabel" v-show="modal_type == 2">Organizaciones públicas</h5>
                    <h5 class="modal-title text-white" id="buildingModalLabel" v-show="modal_type == 3">Organismos internacionales</h5>
                    <h5 class="modal-title text-white" id="buildingModalLabel" v-show="modal_type == 4">Sector privado</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" @click="removeModalType">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p v-show="modal_type == 1">
                      Apoyamos a organizaciones compuestas por diversos países, en diferentes temáticas y que comparten agendas e intereses globales o regionales.
                    </p>
                    <p v-show="modal_type == 2">
                      Trabajamos de la mano con Organizaciones e Instituciones públicas de gobierno, desde el ámbito local, hasta lo estatal y federal.
                    </p>
                    <p v-show="modal_type == 3">
                      Colaboramos con Organismos Internacionales en la implementación de Políticas Públicas y proyectos de incidencia social.
                    </p>
                    <p v-show="modal_type == 4">
                      Respaldamos iniciativas desde lo privado, con un impacto público.
                    </p>
                  </div>
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
            <hr class="separator" style="width:60%;">
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
          <hr class="separator" align="left" style="width:60%;">
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
  data() {
    return {
      modal_type: 0
    }
  },
  methods: {
    removeModalType() {
      this.modal_type = 0;
    },
    changeModal(type) {
      this.modal_type = type;
      $('#buildingModal').modal('show');
    }
  },
  mounted() {
    this.$parent.active_el = this.$route.path;
    console.log('Component mounted.')
  }
}
</script>
