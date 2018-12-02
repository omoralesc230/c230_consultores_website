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
      <div class="col bg-secondary">
        <div class="container">
          <div class="row justify-content-md-center align-items-center full-height">
            <div class="col-md-10">
              <p class="text-uppercase">{{ post.type }}</p>
              <h1 class="">{{ post.title }}</h1>
              <p>{{ post.description }}</p>
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
