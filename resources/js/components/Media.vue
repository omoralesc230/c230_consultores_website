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
            <h1 class="m-0 text-dark">Manage Media</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Media</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Media Component</div>

          <div class="card-body">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Publication date</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Modify</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="media in media" :key="media.id">
                    <td>{{ media.id }}</td>
                    <td>{{ media.title }}</td>
                    <td>{{ media.publication_date | myDate }}</td>
                    <td><span class="badge badge-pill badge-secondary">{{ media.type | upText }}</span></td>
                    <td>{{ media.status }}</td>
                    <td>
                      <a class="btn btn-primary" @click="editModal(media)">
                        <i class="fas fa-edit"></i>
                        <!-- <span class=""> Edit</span> -->
                      </a>
                      <a class="btn btn-danger" @click="deleteMedia(media.id)">
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
    <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="createmediaLabel">Create Media</h5>
            <h5 class="modal-title" v-show="editmode" id="createmediaLabel">Update Media's Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateMedia() : createMedia()">
          <div class="modal-body">
            <div class="form-group">
              <input v-model="form.title" type="text" name="title" placeholder="Title"
                class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
              <has-error :form="form" field="title"></has-error>
            </div>

            <div class="form-group">
              <input v-model="form.link" type="text" name="link" placeholder="Link"
                class="form-control" :class="{ 'is-invalid': form.errors.has('link') }">
              <has-error :form="form" field="link"></has-error>
            </div>

            <div class="form-group">
              <textarea v-model="form.description" name="description" placeholder="Short description for media (Optional)"
                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
              </textarea>
              <has-error :form="form" field="description"></has-error>
            </div>

            <div class="form-group">
              <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                <option value="">Select media type</option>
                <option value="opinion">Opinion</option>
                <option value="article">Article</option>
                <option value="tweet">Tweet</option>
              </select>
            </div>

            <div class="form-group">
              <select name="status" v-model="form.status" id="status" class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                <option value="">Select media status</option>
                <option value="public">Public</option>
                <option value="private">Private</option>
              </select>
            </div>

            <div class="form-group">
              <input v-model="form.publication_date" type="date" name="publication_date" placeholder="Publication date"
                class="form-control" :class="{ 'is-invalid': form.errors.has('publication_date') }">
              <has-error :form="form" field="publication_date"></has-error>
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
      media: {},
      form: new Form({
        id: '',
        title: '',
        type: '',
        link: '',
        thumbnail: 'no-image.png',
        publication_date: '',
        status: ''
      })
    }
  },
  methods: {
    loadMedia(){
      axios.get("api/media").then(({data}) => (this.media = data.data));
    },
    newModal(){
      this.editmode = false;
      this.form.reset();
      $('#mediaModal').modal('show');
    },
    editModal(media){
      this.editmode = true;
      this.form.reset();
      $('#mediaModal').modal('show');
      this.form.fill(media);
    },
    updateMedia(){
      this.$Progress.start();
      //console.log("editing data");
      this.form.put('api/media/'+this.form.id)
      .then(() => {
        // successfull
        $('#mediaModal').modal('hide');
        swal(
          'Updated!',
          'Media information has been updated.',
          'success'
        )
        this.$Progress.finish();
        Fire.$emit('AfterCreate');
      })
      .catch(() => {
        this.$Progress.fail();
      });
    },
    deleteMedia(id){
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
          this.form.delete('api/media/'+id).then(()=>{
            swal(
              'Deleted!',
              'Media has been deleted.',
              'success'
            )
            Fire.$emit('AfterCreate');
          }).catch(()=>{
            swal("Failed!", "There was something wrong.", "warning");
          });
        }
      })
    },
    createMedia(){
      this.$Progress.start();
      // Submit form via post request
      this.form.post('api/media').then(()=>{
        Fire.$emit('AfterCreate');

        $('#mediaModal').modal('hide')

        toast({
          type: 'success',
          title: 'Media created successfully'
        })

        this.$Progress.finish();
      }).catch(()=>{
        this.$Progress.fail()
      })
    }
  },
  created() {
    this.loadMedia();

    Fire.$on('AfterCreate',() => {
      this.loadMedia();
    });
  }
}
</script>
