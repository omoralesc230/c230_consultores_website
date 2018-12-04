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
  .bg-light-grey{
    background-color: #b5b5b5;
  }
</style>
<template>
  <div>
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col bg-light-grey">
        <vacancies style="padding-top: 50px;"></vacancies>
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
