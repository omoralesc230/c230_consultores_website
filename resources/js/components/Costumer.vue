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
            <h1 class="m-0 text-dark">Manage Clients</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Clients</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Clients Component</div>

          <div class="card-body">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created at</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="costumer in costumers" :key="costumer.id">
                    <td>
                      <img style="width:100px;" :src="'/img/costumers/'+costumer.picture" alt="costumer picture">
                    </td>
                    <td>{{ costumer.name }}</td>
                    <td>{{ costumer.description }}</td>
                    <td>{{ costumer.created_at | myDate }}</td>
                    <td>
                      <a class="btn btn-primary" @click="editModal(costumer)">
                        <i class="fas fa-edit"></i>
                        <!-- <span class=""> Edit</span> -->
                      </a>
                      <a class="btn btn-danger" @click="deleteCostumer(costumer.id)">
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
      <i class="fas fa-plus fa-fw"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="costumersModal" tabindex="-1" role="dialog" aria-labelledby="costumersModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="createcostumersLabel">Create Client</h5>
            <h5 class="modal-title" v-show="editmode" id="createcostumersLabel">Update Client's Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateCostumer() : createCostumer()">
          <div class="modal-body">
            <div class="form-group">
              <input v-model="form.name" type="text" name="name" placeholder="Name"
                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
              <has-error :form="form" field="name"></has-error>
            </div>

            <div class="form-group">
              <textarea v-model="form.description" name="description" placeholder="Short description for client (Optional)"
                class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
              </textarea>
              <has-error :form="form" field="bio"></has-error>
            </div>

            <div class="form-group">
              <input type="file" @change="updatePicture" class="form-control-file" id="picture" name="picture">
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
        costumers: {},
        form: new Form({
          id: '',
          name: '',
          description: '',
          picture: ''
        })
      }
    },
    methods: {
      loadCostumers(){
        axios.get("api/costumer").then(({data}) => (this.costumers = data.data));
      },
      newModal(){
        this.editmode = false;
        this.form.reset();
        $('#costumersModal').modal('show');
      },
      editModal(costumer){
        this.editmode = true;
        this.form.reset();
        $('#costumersModal').modal('show');
        this.form.fill(costumer);
      },
      createCostumer(){
        this.$Progress.start();
        // Submit form via post request
        this.form.post('api/costumer').then(()=>{
          Fire.$emit('AfterCreate');

          $('#costumersModal').modal('hide')

          toast({
            type: 'success',
            title: 'Client created successfully'
          })

          this.$Progress.finish();
        }).catch(()=>{
          this.$Progress.fail()
        })
      },
      updateCostumer(){
        this.$Progress.start();
        //console.log("editing data");
        this.form.put('api/costumer/'+this.form.id)
        .then(() => {
          // successfull
          $('#costumersModal').modal('hide');
          swal(
            'Updated!',
            'Client information has been updated.',
            'success'
          )
          this.$Progress.finish();
          Fire.$emit('AfterCreate');
        })
        .catch(() => {
          this.$Progress.fail();
        });
      },
      updatePicture(e) {
        // console.log('uploading');
        let file = e.target.files[0];
        console.log(file);
        let reader = new FileReader();
        // let vm = this;
        if (file['size'] < 2122775) {
          reader.onloadend = (file) => {
            // console.log('RESULT', reader.result)
            this.form.picture = reader.result;
          }
          reader.readAsDataURL(file);
        } else {
          swal({
            type: 'error',
            title: 'Oopss...',
            text: 'You are uploading a large file',
          })
        }
      },
      deleteCostumer(id){
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
            this.form.delete('api/costumer/'+id).then(()=>{
              swal(
                'Deleted!',
                'Client has been deleted.',
                'success'
              )
              Fire.$emit('AfterCreate');
            }).catch(()=>{
              swal("Failed!", "There was something wrong.", "warning");
            });
          }
        })
      }
    },
    created() {
      this.loadCostumers();

      Fire.$on('AfterCreate',() => {
        this.loadCostumers();
      });
    }
  }
</script>
