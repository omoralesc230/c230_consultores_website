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

  .btn-orange{
    background-color: #ff7900;
    border-color: #ff7900;
    color: white;
  }

  .about-cards{
    border-style: solid;
    border-width: 2px;
    border-color: #ff7900;
    padding: 25px;
  }
  .h-100{
    height: 100vh !important;
  }
  .carousel-indicators .active{
    background-color: #ff7900 !important;
  }

  .carousel-indicators li{
    width: 20px;
    height: 20px;
    margin-right: 10px;
    margin-left: 10px;
    border-radius: 50%;
  }

  .carousel-caption{
    bottom: 0;
    top: 180px;
    text-align: left;
  }
</style>
<template>
  <div>
    <div class="row">
      <div class="col">
        <!-- carousel starts -->
        <div id="Projectscarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#Projectscarousel" v-for="featuredPost in featuredPosts" :key="featuredPost.id" :data-slide-to="featuredPost.order-1" :class="{ 'active': featuredPost.order === 1 }"></li>
          </ol>
          <div class="carousel-inner">
            <div v-for="featuredPost in featuredPosts" :key="featuredPost.id" :class="{ 'active': featuredPost.order === 1 }" class="carousel-item h-100" :style="{ 'background-image': 'url(/img/posts/' + featuredPost.picture + ')' }" style="background-position: center;background-repeat: no-repeat;background-size: cover;min-height:210px;">
              <div class="carousel-caption">
                <div class="row justify-content-md-center">
                  <div class="col-md-10">
                    <p class="text-uppercase">{{ featuredPost.type }} destacado</p>
                    <h1 class="">{{ featuredPost.title }}</h1>
                    <p class="d-none d-md-block">
                      {{featuredPost.description}}
                    </p>
                    <router-link :to="'/posts/'+featuredPost.id" class="btn btn-orange mt-2">
                      Saber más...
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- carousel ends -->
      </div>
    </div>
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col bg-grey-black">
        <div class="container">
          <div class="row justify-content-md-center align-items-center" style="min-height:100vh;">
            <div class="col-sm-12 col-md-8  col-lg-8 text-light text-center">
              <h1 class="font-weight-light">¿Quiénes somos?</h1>
              <hr>
              <p>
                Somos una consultoría con 11 años de experiencia generando información para impulsar la mejor toma de decisiones.
              </p>
              <p>
                Nuestros valores se basan en la excelencia e innovación en procesos, solidez en el manejo de tiempos y flexibilidad para entregar resultados específicos y en sintonía a las necesidades de nuestros clientes.
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
      <div class="col">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-7" style="background-color:white;">
            <div class="container">
              <div class="row justify-content-md-center align-items-center what-we-do-home">
                <div class="col-sm-12 col-md-8 col-lg-8">
                  <h1 class="font-weight-light">¿Qué hacemos?</h1>
                  <hr>
                  <p class="text-uppercase">
                    Asesoramos la toma de decisiones
                  </p>
                  <p>
                    Ayudamos a resolver problemas y añadimos valor a los proyectos de cada uno de nuestros clientes.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-5 bg-grey">
            <div class="container">
              <div class="row justify-content-md-center align-items-center our-practice-home">
                <div class="col-sm-12 col-md-10 col-lg-10">
                  <div class="card" style="border:0px;">
                    <v-lazy-image class="card-img-top" src="/img/home/card_img.jpg" src-placeholder="" alt="Card image cap"/>
                    <div class="card-body">
                      <h5 class="card-title text-uppercase">nuestra práctica</h5>
                      <p class="card-text">
                        Nuestra experiencia nos facilita diseñar y adaptar el alcance de nuestros proyectos de acuerdo a los problemas y a las necesidades específicas de cada cliente.
                      </p>
                    </div>
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
      <div class="col" style="background-color:#ff7900;">
        <div class="container">
          <div class="row justify-content-md-center align-items-center join-us-home">
            <div class="col-sm-12 col-md-8  col-lg-8 text-light text-center">
              <h2 class="font-weight-light">Únete a C230 Consultores</h2>
              <p>
                Estamos constantemente en búsqueda de talento.
              </p>
              <p>
                Si estas interesado en ingresar a C230 Consultores, revisa nuestras vacantes:
              </p>
              <button type="button" class="btn btn-outline-light">Ir a vacantes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col" style="background-color:white;">
        <div class="container mb-4 mt-4">
          <div class="row justify-content-around align-items-center" style="padding:20px;">
            <div class="col-sm-10 col-md-6 col-lg-4 about-cards order-1 order-md-2">
              <h1 class="font-weight-light">¿Para Quiénes?</h1>
              <hr>
              <ul>
                <li>Organizaciones públicas</li>
                <li>Multilaterales</li>
                <li>Organismos internacionales</li>
                <li>Sector privado</li>
                <li>Organizaciosin fines de lucro</li>
              </ul>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-4 order-2 order-md-1">
              <v-lazy-image src="/img/home/city.png" src-placeholder="" class="img-fluid" alt="city"/>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col" style="background-color:white;">
        <div class="container mb-4">
          <div class="row justify-content-around align-items-center" style="padding:20px;">
            <div class="col-sm-10 col-md-6 col-lg-4 about-cards">
              <h1 class="font-weight-light">¿En qué trabajamos?</h1>
              <hr>
              <ul>
                <li>Estrategias</li>
                <li>Políticas públicas</li>
                <li>Problemas públicos</li>
                <li>Iniciativas públicas</li>
                <li>Comunicación</li>
              </ul>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-4">
              <v-lazy-image src="/img/home/graph.png" src-placeholder="" class="img-fluid" alt="city"/>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col" style="background-color:white;">
        <div class="container mb-4">
          <div class="row justify-content-around align-items-center" style="padding:20px;">
            <div class="col-sm-10 col-md-6 col-lg-4 about-cards order-1 order-md-2">
              <h1 class="font-weight-light">Proyectos</h1>
              <hr>
              <p>
                Desde hace 11 años hemos realizado proyectos en diversos sectores y para múltiples clientes lo cual nos ha brindado una experiencia única en consultoría en Latinoamérica.
              </p>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-4 order-2 order-md-1">
              <v-lazy-image src="/img/home/laptop.png" src-placeholder="" class="img-fluid" alt="city"/>
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
      featuredPosts: {},
      scrolled: 0
    }
  },
  methods: {
    loadFeatured(){
      axios.get("api/featured").then(({data}) => (this.featuredPosts = data));
    },
    handleScroll () {
      let logodark = document.getElementById("logodark");
      let logowhite = document.getElementById("logowhite");
      let aboutus = document.getElementById("aboutus");
      let whatwedo = document.getElementById("whatwedo");
      let vacancies = document.getElementById("vacancies");
      let contact = document.getElementById("contact");
      if (document.body.scrollTop >= $(window).height() || document.documentElement.scrollTop > $(window).height()) {
        console.log("second section");
        logodark.classList.remove("d-none");
        logowhite.classList.remove("d-block");
        aboutus.classList.remove("text-white");
        whatwedo.classList.remove("text-white");
        vacancies.classList.remove("text-white");
        contact.classList.remove("text-white");
      } else {
        logodark.classList.add("d-none");
        logowhite.classList.add("d-block");
        aboutus.classList.add("text-white");
        whatwedo.classList.add("text-white");
        vacancies.classList.add("text-white");
        contact.classList.add("text-white");
      }
    }
  },
  created() {
    this.$parent.active_el = this.$route.path;
    window.addEventListener('scroll', this.handleScroll);
    this.loadFeatured();
  },
  destroyed () {
    window.removeEventListener('scroll', this.handleScroll);
  }
}
</script>
