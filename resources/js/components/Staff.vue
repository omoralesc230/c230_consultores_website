<style>
.container-staff {
  position: relative;
  width: 90%;
}

.image-staff {
  display: block;
  width: 100%;
  height: auto;
}

.overlay-staff {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: #ff7900;
  overflow: hidden;
  width: 100%;
  height: 0;
  transition: .5s ease;
}

.container-staff:hover .overlay-staff {
  height: 100%;
  overflow: auto;
}

.staff-title{
  padding: 15px;
}
</style>

<template>
  <div class="container">
    <div class="row justify-content-md-center align-items-center mt-5">
      <div class="col-sm-12">
        <h1 class="font-weight-light">Staff</h1>
        <hr>
        <div class="row mb-4">
          <div class="col-md-4 mb-4" v-for="user in users" :key="user.id">
            <div class="container-staff">
              <img :src="'/img/profile_pics/'+user.photo" alt="Avatar" class="image-staff">
              <div class="staff-title bg-secondary">
                <p>
                  <span class="text-uppercase">{{ user.name }}</span>
                  <br>{{ user.position }}
                </p>
              </div>
              <div class="overlay-staff">
                <div class="text-staff">
                  <div class="container text-white">
                    <p class="mt-2">
                      <span class="text-uppercase">{{ user.name }}</span>
                      <br>
                      <span class="">{{ user.position }}</span>
                    </p>
                    <p class="text-justify">{{ user.bio }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: {},
    }
  },
  methods: {
    loadUsers(){
      axios.get("api/user").then(({data}) => (this.users = data.data));
    },
  },
  created() {
    this.loadUsers();

    Fire.$on('AfterCreate',() => {
      this.loadUsers();
    });
  }
}
</script>
