<style>
  .sidenav-space{
    max-width:250px;
  }
  .full-height{
    min-height:100vh;
  }
  .bg-grey-black{
    background-color:#4a4a4a;
  }
  .padding-post {
    padding-top: 15%;
  }
  @media (min-width: 1450px) {
    .padding-post {
      padding-top: 10%;
    }
  }

  @media (min-width: 1500px) {
    .padding-post {
      padding-top: 6%;
    }
  }
</style>
<template>
  <div>
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col" style="background-color: #E6E6E6;">
        <div class="container">
          <div class="row justify-content-md-center align-items-center full-height">
            <div class="col-md-12">
              <p class="text-uppercase mt-3 padding-post">{{ post.type }}</p>
              <h1 class="mb-3">{{ post.title }}</h1>
              <div class="jumbotron">
                <p class="text-dark text-center">{{ post.description }}</p>
              </div>
              <div class="row">
                <h5 class="ml-3 mb-3">Clientes:</h5>
              </div>
              <div class="card-deck justify-content-center">
                <div class="card" style="max-width: 300px;" v-for="costumer in post.costumers" :key="costumer.id">
                  <img class="card-img-top" style="display:block; margin:auto; max-width: 250px;" :src="'/img/costumers/'+costumer.picture" :alt="costumer.name">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row" v-for="section in post.sections" :key="section.id">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col bg-grey-black">
        <div class="container">
          <div class="row">
            <div class="col-md-12 mt-3 mb-3">
              <h1 class="mb-3 text-white">{{ section.title }}</h1>
              <hr>
              <p class="text-white" v-if="section.description"><i class="fas fa-caret-right mr-2"></i>{{ section.description }}</p>
              <div class="mb-3 text-white" style="border-style: solid; border-width: 1.5px; border-color: #ff7900; padding: 20px;" v-for="item in section.items" :key="item.id" v-if="section.type == 'simple list'">
                <p>{{ item.title }}</p>
                <p>{{ item.text }}</p>
              </div>
              <p class="text-white" v-if="section.text"><i class="fas fa-caret-right mr-2"></i>{{ section.text }}</p>
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
      post: {},
    }
  },
  created() {
    this.$parent.active_el = this.$route.path;
    axios.get('/api/post/'+this.$route.params.id).then(({data}) => (this.post = data));
  }
}
</script>
