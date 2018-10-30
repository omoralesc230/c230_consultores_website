<style>
  .fixed-btn {
     position: fixed;
     right: 40px;
     bottom: 40px;
  }
</style>

<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Users Component</div>

          <div class="card-body">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Created at</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td><span class="badge badge-pill badge-secondary">{{ user.type | upText }}</span></td>
                    <td>{{ user.created_at | myDate }}</td>
                    <td>
                      <a class="btn btn-primary" @click="editModal(user)">
                        <i class="fas fa-edit"></i>
                        <!-- <span class=""> Edit</span> -->
                      </a>
                      <a class="btn btn-danger" @click="deleteUser(user.id)">
                        <i class="fas fa-trash"></i>
                        <!-- <span> Delete</span> -->
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button class="btn btn-success fixed-btn" @click="newModal">
      <i class="fas fa-user-plus fa-fw"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="createusersLabel">Create User</h5>
            <h5 class="modal-title" v-show="editmode" id="createusersLabel">Update User's Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateUser() : createUser()">
          <div class="modal-body">
            <div class="form-group">
              <input v-model="form.name" type="text" name="name" placeholder="Name"
                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
              <has-error :form="form" field="name"></has-error>
            </div>

            <div class="form-group">
              <input v-model="form.email" type="email" name="email" placeholder="Email"
                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
              <has-error :form="form" field="email"></has-error>
            </div>

            <div class="form-group">
              <textarea v-model="form.bio" name="bio" placeholder="Short bio for user (Optional)"
                class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
              </textarea>
              <has-error :form="form" field="bio"></has-error>
            </div>

            <div class="form-group">
              <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                <option value="">Select User Role</option>
                <option value="admin">Admin</option>
                <option value="content admin">Content Admin</option>
                <option value="talent admin">Talent Admin</option>
                <option value="user">User</option>
              </select>
            </div>

            <div class="form-group">
              <input v-model="form.password" type="password" name="password" placeholder="Password"
                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
              <has-error :form="form" field="password"></has-error>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button v-show="editmode" type="submit" class="btn btn-primary">Update</button>
            <button v-show="!editmode" type="submit" class="btn btn-success">Create</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      users: {},
      form: new Form({
        id: '',
        name: '',
        email: '',
        password: '',
        type: '',
        bio: '',
        photo: ''
      })
    }
  },
  methods: {
    loadUsers(){
      axios.get("api/user").then(({data}) => (this.users = data.data));
    },
    newModal(){
      this.editmode = false;
      this.form.reset();
      $('#usersModal').modal('show');
    },
    editModal(user){
      this.editmode = true;
      this.form.reset();
      $('#usersModal').modal('show');
      this.form.fill(user);
    },
    updateUser(){
      this.$Progress.start();
      //console.log("editing data");
      this.form.put('api/user/'+this.form.id)
      .then(() => {
        // successfull
        $('#usersModal').modal('hide');
        swal(
          'Updated!',
          'User information has been updated.',
          'success'
        )
        this.$Progress.finish();
        Fire.$emit('AfterCreate');
      })
      .catch(() => {
        this.$Progress.fail();
      });
    },
    deleteUser(id){
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        //Send request to server
        if (result.value) {
          this.form.delete('api/user/'+id).then(()=>{
            swal(
              'Deleted!',
              'User has been deleted.',
              'success'
            )
            Fire.$emit('AfterCreate');
          }).catch(()=>{
            swal("Failed!", "There was something wrong.", "warning");
          });
        }
      })
    },
    createUser(){
      this.$Progress.start();
      // Submit form via post request
      this.form.post('api/user').then(()=>{
        Fire.$emit('AfterCreate');

        $('#usersModal').modal('hide')

        toast({
          type: 'success',
          title: 'User created successfully'
        })

        this.$Progress.finish();
      }).catch(()=>{
        this.$Progress.fail()
      })
    }
  },
  created() {
    this.loadUsers();

    Fire.$on('AfterCreate',() => {
      this.loadUsers();
    });
  }
}
</script>
