<style>
  .sidenav-space{
    max-width:250px;
  }
  .full-height{
    min-height:100vh;
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
              <p class="text-uppercase">{{ post.type }}</p>
              <h1 class="mb-3">{{ post.title }}</h1>
              <div class="jumbotron">
                <p class="text-dark">{{ post.description }}</p>
              </div>
              <div class="row">
                <h5 class="ml-3">Clientes:</h5>
              </div>
              <div class="row justify-content-md-center">
                <div class="col-md-4" v-for="costumer in post.costumers" :key="costumer.id">
                  <img class="img-fluid" :src="'/img/costumers/'+costumer.picture" alt="Card image cap">
                </div>
              </div>
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
