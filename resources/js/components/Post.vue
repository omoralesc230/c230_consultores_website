<style>
  .fixed-btn {
    position: fixed;
    right: 40px;
    bottom: 40px;
  }
  .post-img{
    width: 100px;
  }
</style>
<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Posts</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Posts Component</div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>Thumbnail</th>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Created At</th>
                  <th>Featured</th>
                  <th>Order</th>
                  <th>Show</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <draggable :list="posts.data" :options="{animation:200, handle:'.my-handle'}" :element="'tbody'" @change="updateOrder">
                <tr v-for="post in posts.data" :key="post.id">
                  <td>
                    <i class="fas fa-arrows-alt my-handle" style="cursor:pointer;"></i>
                  </td>
                  <td>
                    <img class="post-img" :src="'/img/posts/'+post.picture" alt="post picture">
                  </td>
                  <td width="30%">{{ post.title }}</td>
                  <td>{{ post.type | upText }}</td>
                  <td>{{ post.created_at | myDate }}</td>
                  <td>
                    <i v-if="post.featured == 1" class="fas fa-star text-yellow"></i>
                    <i v-else="post.featured" class="fas fa-star text-grey"></i>
                  </td>
                  <td>{{ post.order }}</td>
                  <td>
                    <router-link :to="'/post/'+post.id" class="text-secondary">
                      <i class="fas fa-eye"></i>
                    </router-link>
                  </td>
                  <td>
                    <a class="text-primary" @click="editModal(post)">
                      <i class="fas fa-edit"></i>
                    </a>
                  </td>
                  <td>
                    <a class="text-danger" @click="deletePost(post.id)">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              </draggable>
            </table>
          </div>
          <div class="card-footer">
            <!-- <pagination :data="vacancies" @pagination-change-page="getResults"></pagination> -->
          </div>
        </div>
      </div>
    </div>
    <button class="btn btn-success fixed-btn" @click="newModal">
      <i class="fas fa-plus fa-fw"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="postsModal" tabindex="-1" role="dialog" aria-labelledby="postsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="createvacanciesLabel">Create Post</h5>
            <h5 class="modal-title" v-show="editmode" id="createvacanciesLabel">Update Post's Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updatePost() : createPost()">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input v-model="form.title" type="text" name="title" placeholder="Title"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                    <has-error :form="form" field="title"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.type" type="text" name="type" placeholder="Post type"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                    <has-error :form="form" field="type"></has-error>
                  </div>

                  <div class="form-group">
                    <textarea v-model="form.description" name="description" placeholder="Post description"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                    </textarea>
                    <has-error :form="form" field="description"></has-error>
                  </div>

                  <div class="form-group">
                    <input type="file" @change="updatePicture" class="form-control-file" id="picture" name="picture">
                  </div>

                  <div class="col-sm-offset-2 col-sm-10 mt-3">
                    <div class="form-check">
                      <input v-model="form.featured" type="checkbox" class="form-check-input" id="featured" name="featured" value="1">
                      <label class="form-check-label" for="exampleCheck2">Featured</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <input v-model="form.order" type="number" name="order" placeholder="Order"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('order') }">
                    <has-error :form="form" field="order"></has-error>
                  </div>
                </div>
              </div>
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
import draggable from 'vuedraggable'
import Multiselect from 'vue-multiselect'

export default {
  components: {
    draggable, Multiselect
  },
  data() {
    return {
      editmode: false,
      posts: {},
      post: {},
      form: new Form({
        id: '',
        title: '',
        type: '',
        description: '',
        featured: 0,
        picture: '',
        order: '',
      })
    }
  },
  methods: {
    updateOrder(){
      this.posts.data.map((post, index) => {
        post.order = index + 1;
      })
      this.$Progress.start();
      axios.put('api/ordered',
        {posts:this.posts.data}
      )
      .then(() => {
        toast({
          type: 'success',
          title: 'Post order updated successfully'
        })
        Fire.$emit('AfterCreate');
        this.$Progress.finish();
      })
      .catch(() => {
        this.$Progress.fail();
      });
    },
    getResults(page = 1) {
      axios.get('api/post?page=' + page).then(response => {
        this.posts = response.data;
      })
    },
    loadPosts(){
      axios.get("api/post").then(({data}) => (this.posts = data));
    },
    newModal(){
      this.editmode = false;
      this.selectedCostumers = [];
      this.form.reset();
      this.form.order = this.posts.data.length + 1;
      $('#postsModal').modal('show');
    },
    createPost(){
      this.$Progress.start();
      // Submit form via post request
      this.form.post('api/post').then(()=>{
        Fire.$emit('AfterCreate');

        $('#postsModal').modal('hide')

        toast({
          type: 'success',
          title: 'Post created successfully'
        })

        this.$Progress.finish();
      }).catch(()=>{
        this.$Progress.fail()
      })
    },
    editModal(post){
      this.editmode = true;
      this.selectedCostumers = [];
      this.form.reset();
      $('#postsModal').modal('show');
      this.form.fill(post);
    },
    updatePost(){
      this.$Progress.start();
      this.form.put('api/post/'+this.form.id).then(() =>{
        //successfull
        $('#postsModal').modal('hide');
        swal(
          'Updated!',
          'Post information has been updated.',
          'success'
        )
        this.$Progress.finish();
        Fire.$emit('AfterCreate');
      }).catch(() => {
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
    deletePost(id){
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
          this.form.delete('api/post/'+id).then(()=>{
            swal(
              'Deleted!',
              'Post has been deleted.',
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
    this.loadPosts();

    Fire.$on('AfterCreate',() => {
      this.loadPosts();
    });
  }
}
</script>
