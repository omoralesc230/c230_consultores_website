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
                    <th>Modify</th>
                  </tr>
                  <tr>
                    <td>183</td>
                    <td>John Doe</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">Approved</span></td>
                    <td>
                      <a class="btn btn-primary" href="#">
                        <i class="fas fa-edit"></i>
                        <!-- <span class=""> Edit</span> -->
                      </a>
                      <a class="btn btn-danger" href="#">
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
    <button class="btn btn-success fixed-btn" data-toggle="modal" data-target="#usersModal">
      <i class="fas fa-user-plus fa-fw"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="usersModalLabel">Add New</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
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
                <option value="content">Content Admin</option>
                <option value="talent">Talent Admin</option>
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
            <button :disabled="form.busy" type="submit" class="btn btn-primary">Create</button>
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
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
