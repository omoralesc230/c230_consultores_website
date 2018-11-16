<style>
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
  <!-- carousel starts -->
  <div id="Projectscarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#Projectscarousel" data-slide-to="0" class="active"></li>
      <li data-target="#Projectscarousel" data-slide-to="1"></li>
      <li data-target="#Projectscarousel" data-slide-to="2"></li>
      <li data-target="#Projectscarousel" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div v-for="post in posts.data" :key="post.id" :class="{ 'active': post.id === 1 }" class="carousel-item h-100" :style="{ 'background-image': 'url(/img/posts/' + post.picture + ')' }" style="background-position: center;background-repeat: no-repeat;background-size: cover;min-height:210px;">
        <div class="carousel-caption">
          <div class="row justify-content-md-center">
            <div class="col-md-10">
              <p class="text-uppercase">{{ post.type }} destacado</p>
              <h1 class="">{{ post.title }}</h1>
              <p class="d-none d-md-block">
                {{ post.description }}
              </p>
              <button type="button" class="btn btn-orange mt-2">Saber más...</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- carousel ends -->
</template>

<script>
export default {
  data() {
    return {
      posts: {},
    }
  },
  methods: {
    getResults(page = 1) {
      axios.get('api/post?page=' + page).then(response => {
        this.posts = response.data;
      })
    },
    loadPosts(){
      axios.get("api/post").then(({data}) => (this.posts = data));
    },
  },
  mounted() {
    this.loadPosts();
  }
}
</script>
