<style>
.widget-user-header {
  background-position: center center;
  background-size: cover;
}
</style>

<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-widget widget-user mt-3">
          <div class="widget-user-header text-white" style="background-image:url('./img/profile_pics/cover_image.jpg')">
            <h3 class="widget-user-username">{{ form.name }}</h3>
            <h5 class="widget-user-desc">{{ form.position }}</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">3</h5>
                  <span class="description-text">POSTS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">5</h5>
                  <span class="description-text">MEDIA</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">4</h5>
                  <span class="description-text">VACANCIES</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
              <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane" id="activity">
                <!-- Post -->

                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane active show" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input v-model="form.name" type="text" name="name" id="name" placeholder="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                      <has-error :form="form" field="name"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input v-model="form.email" type="email" id="email" name="email" placeholder="Email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Short Bio</label>

                    <div class="col-sm-10">
                      <textarea v-model="form.bio" name="bio" id="bio" placeholder="Short bio for user (Optional)" class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                      <has-error :form="form" field="bio"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Profile Photo</label>

                    <div class="col-sm-10">
                      <input type="file" @change="updateProfile" class="form-control-file" id="photo" name="photo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Password (leave empty if not changing)</label>
                    <div class="col-sm-10">
                      <input type="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" id="password" name="password">
                      <has-error :form="form" field="password"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>


    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      form: new Form({
        id: '',
        name: '',
        email: '',
        password: '',
        type: '',
        position: '',
        department: '',
        bio: '',
        photo: ''
      })
    }
  },

  methods: {
    getProfilePhoto() {
    // let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo;
      let photo = (!this.form.photo) ? "img/profile_pics/superhero.png" : (this.form.photo.length > 200) ? this.form.photo : "img/profile_pics/"+ this.form.photo;
      return photo;
    },
    updateInfo() {
      this.$Progress.start();
      this.form.put('api/profile')
      .then(() => {
        swal(
          'Edited!',
          'Profile data has been edited.',
          'success'
        )
        Fire.$emit('AfterCreate');
        this.$Progress.finish();
      })
      .catch(() => {
        this.$Progress.fail();
      });
    },

    updateProfile(e) {
      // console.log('uploading');
      let file = e.target.files[0];
      console.log(file);
      let reader = new FileReader();
      // let vm = this;
      if (file['size'] < 2122775) {
        reader.onloadend = (file) => {
          // console.log('RESULT', reader.result)
          this.form.photo = reader.result;
        }
        reader.readAsDataURL(file);
      } else {
        swal({
          type: 'error',
          title: 'Oopss...',
          text: 'You are uploading a large file',
        })
      }
    }
  },

  created() {
    axios.get("api/profile")
    .then(({ data }) => (this.form.fill(data)));
  }
}
</script>
