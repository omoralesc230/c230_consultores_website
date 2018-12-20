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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/dashboard">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item">
                <router-link to="/post">
                  Posts
                </router-link>
              </li>
              <li class="breadcrumb-item active">{{ post.id }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="jumbotron">
          <div class="" :style="{ 'background-image': 'url(/img/posts/' + post.picture + ')' }" style="background-position: center;background-repeat: no-repeat;background-size: cover;min-height:300px; border-radius: 0.3rem;"></div>
          <h3 class="mt-3">
            {{ post.title }}
            <span class="badge badge-pill badge-secondary">
              {{ post.type }}
              <i v-if="post.featured == 1" class="fas fa-star text-yellow"></i>
              <i v-else="post.featured" class="fas fa-star text-grey"></i>
            </span>
          </h3>
          <p>{{ post.description }}</p>
          <button type="button" class="btn btn-primary" @click="newSectionModal"><i class="fas fa-align-justify"></i> Add section</button>
          <button type="button" class="btn btn-primary" @click="linkCostumerModal"><i class="fas fa-handshake"></i> Link costumers</button>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="container-fluid">
          <h3>Sections</h3>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <draggable :list="post.sections" :options="{animation:200, handle:'.my-handle'}" :element="'div'" @change="updateOrder">
                <div class="card" v-for="section in post.sections" :key="section.id">
                  <div class="card-header">
                    <h5 class="card-title">
                      <i class="fas fa-arrows-alt my-handle" style="cursor:pointer;"></i>
                      {{section.title}}
                      <small>
                        <span class="badge badge-pill badge-secondary">
                          {{ section.type }}
                        </span>
                      </small>
                    </h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool text-secondary" @click="editSectionModal(section)">
                        <i class="fa fa-pencil-alt"></i>
                      </button>
                      <button type="button" class="btn btn-tool text-danger" @click="deleteSection(section.id)">
                        <i class="fa fa-trash"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <p>
                      {{ section.description }}
                    </p>
                    <button class="btn btn-secondary btn-sm mt-3 mb-3 float-right" name="button" @click="newItemModal(section.id)" v-if="section.type !== 'simple section'">Add item</button>
                    <div class="table-responsive" v-if="section.type !== 'simple section'">
                      <table class="table table-hover table-sm col-md-12">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th v-if="section.type !== 'simple list'">picture</th>
                            <th v-if="section.type !== 'simple list'">title</th>
                            <th>text</th>
                            <th>Edit</th>
                            <th>delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="item in section.items" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td v-if="section.type !== 'simple list'">
                              <img style="max-width:50px;" :src="'/img/items/'+item.picture" :alt="item.picture">
                            </td>
                            <td v-if="section.type !== 'simple list'">{{ item.title }}</td>
                            <td>
                              {{ item.text }}
                            </td>
                            <td>
                              <a class="btn text-secondary" @click="editItemModal(item)">
                                <i class="fas fa-pencil-alt"></i>
                              </a>
                            </td>
                            <td>
                              <a class="btn text-danger" @click="deleteItem(item.id)">
                                <i class="fas fa-trash"></i>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <p>
                      {{ section.text }}
                    </p>
                  </div>
                </div>
              </draggable>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="container-fluid">
          <h3 class="mt-3">Costumers</h3>
          <hr>
          <div class="row">
            <div class="card-deck">
              <div class="card" v-for="costumer in post.costumers" :key="costumer.id">
                <img class="rounded mx-auto d-block mt-3 mb-3" style="width:200px;" :src="'/img/costumers/'+costumer.picture" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">
                    {{ costumer.description }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Section Modal -->
    <div class="modal fade" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="sectionModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!sectionEditmode" class="modal-title" id="sectionModalLabel">Create Section</h5>
            <h5 v-show="sectionEditmode" class="modal-title" id="sectionModalLabel">Update Section</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="sectionEditmode ? updateSection() : createSection()">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <multiselect v-model="sectionForm.type" :options="sectionTypeOptions" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Pick section type"></multiselect>
                    <has-error :form="sectionForm" field="type"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="sectionForm.title" type="text" name="title" placeholder="Title"
                      class="form-control" :class="{ 'is-invalid': sectionForm.errors.has('title') }">
                    <has-error :form="sectionForm" field="title"></has-error>
                  </div>

                  <div class="form-group">
                    <textarea v-model="sectionForm.description" name="description" placeholder="Description"
                      class="form-control" :class="{ 'is-invalid': sectionForm.errors.has('description') }">
                    </textarea>
                    <has-error :form="sectionForm" field="description"></has-error>
                  </div>

                  <div class="form-group">
                    <textarea v-model="sectionForm.text" name="text" placeholder="Text"
                      class="form-control" :class="{ 'is-invalid': sectionForm.errors.has('text') }">
                    </textarea>
                    <has-error :form="sectionForm" field="text"></has-error>
                  </div>

                  <!-- <div class="form-group">
                    <input type="file" @change="updatePicture" class="form-control-file" id="picture" name="picture">
                  </div> -->

                  <div class="form-group">
                    <input v-model="sectionForm.order" type="number" name="order" placeholder="Order"
                      class="form-control" :class="{ 'is-invalid': sectionForm.errors.has('order') }">
                    <has-error :form="sectionForm" field="order"></has-error>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button v-show="sectionEditmode" type="submit" class="btn btn-primary">Update</button>
            <button v-show="!sectionEditmode" type="submit" class="btn btn-success" @click="assignProp(post.id)">Create</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Item Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!itemEditmode" class="modal-title" id="itemModalLabel">Create Item</h5>
            <h5 v-show="itemEditmode" class="modal-title" id="itemModalLabel">Update Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="itemEditmode ? updateItem() : createItem()">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input v-model="itemForm.title" type="text" name="title" placeholder="Title"
                      class="form-control" :class="{ 'is-invalid': itemForm.errors.has('title') }">
                    <has-error :form="itemForm" field="title"></has-error>
                  </div>

                  <div class="form-group">
                    <textarea v-model="itemForm.text" name="text" placeholder="Text"
                      class="form-control" :class="{ 'is-invalid': itemForm.errors.has('text') }">
                    </textarea>
                    <has-error :form="itemForm" field="text"></has-error>
                  </div>

                  <div class="form-group">
                    <input type="file" @change="updateItemPicture" class="form-control-file" id="picture" name="picture">
                  </div>

                  <!-- <div class="form-group">
                    <input v-model="sectionForm.order" type="number" name="order" placeholder="Order"
                      class="form-control" :class="{ 'is-invalid': sectionForm.errors.has('order') }">
                    <has-error :form="sectionForm" field="order"></has-error>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button v-show="itemEditmode" type="submit" class="btn btn-primary">Update</button>
            <button v-show="!itemEditmode" type="submit" class="btn btn-success">Create</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Costumers Modal -->
    <div class="modal fade" id="costumersModal" tabindex="-1" role="dialog" aria-labelledby="costumersModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="costumersModalLabel">Link costumers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-check" v-for="costumer in costumers" :key="costumer.id">
                    <input v-model="selectedCostumers" class="form-check-input" type="checkbox" :value="costumer.id" :id="'Checkbox'+costumer.id">
                    <label class="form-check-label" :for="'Checkbox'+costumer.id">
                      {{costumer.name}}
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" @click="linkCostumers">Add</button>
          </div>
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
      sectionEditmode: false,
      itemEditmode: false,
      items: {},
      costumers: {},
      post: {},
      selectedCostumers: [],
      sectionTypeOptions: ['simple section','carousel', 'image list', 'simple list'],
      sectionForm: new Form({
        type: '',
        id: '',
        title: '',
        description: '',
        text: '',
        order: '',
        post_id: '',
      }),
      itemForm: new Form({
        id: '',
        title: '',
        text: '',
        picture: '',
        section_id: '',
      })
    }
  },
  methods: {
    updateOrder(){
      this.post.sections.map((section, index) => {
        section.order = index + 1;
      })
      this.$Progress.start();
      axios.put('/api/sectionsOrdered',
        {sections:this.post.sections}
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
    linkCostumers(){
      this.$Progress.start();
      axios.put('/api/linkedcostumers',
        {
          costumers:this.selectedCostumers,
          post_id: this.post.id
        }
      ).then(() => {
        $('#costumersModal').modal('hide');
        toast({
          type: 'success',
          title: 'Cliente(s) ligado a publicación'
        })
        Fire.$emit('AfterCreate');
        this.$Progress.finish();
      }).catch(() => {
        this.$Progress.fail();
      });
    },
    newItemModal(section){
      this.itemEditmode = false;
      this.itemForm.reset();
      $('#itemModal').modal('show');
      this.itemForm.section_id = section;
    },
    createItem(){
      this.$Progress.start();
      this.itemForm.post('/api/item').then(()=>{
        Fire.$emit('AfterCreate');

        $('#itemModal').modal('hide')

        toast({
          type: 'success',
          title: 'Item created successfully'
        })

        this.$Progress.finish();
      }).catch(()=>{
        this.$Progress.fail()
      })
    },
    editItemModal(item){
      this.itemEditmode = true;
      this.itemForm.reset();
      $('#itemModal').modal('show');
      this.itemForm.fill(item);
    },
    updateItem(){
      this.$Progress.start();
      this.itemForm.put('/api/item/'+this.itemForm.id).then(() =>{
        //successfull
        $('#itemModal').modal('hide');
        swal(
          'Updated!',
          'Item information has been updated.',
          'success'
        )
        this.$Progress.finish();
        Fire.$emit('AfterCreate');
      }).catch(() => {
        this.$Progress.fail();
      });
    },
    updateItemPicture(e) {
      // console.log('uploading');
      let file = e.target.files[0];
      console.log(file);
      let reader = new FileReader();
      // let vm = this;
      if (file['size'] < 2122775) {
        reader.onloadend = (file) => {
          // console.log('RESULT', reader.result)
          this.itemForm.picture = reader.result;
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
    deleteItem(id) {
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
          this.itemForm.delete('/api/item/'+id).then(()=>{
            swal(
              'Deleted!',
              'Item has been deleted.',
              'success'
            )
            Fire.$emit('AfterCreate');
          }).catch(()=>{
            swal("Failed!", "There was something wrong.", "warning");
          });
        }
      })
    },
    assignProp(post){
      this.sectionForm.post_id = post;
    },
    linkCostumerModal(){
      for (var i = 0; i < this.post.costumers.length; i++) {
        this.selectedCostumers.push(this.post.costumers[i].id);
      }
      $('#costumersModal').modal('show');
    },
    newSectionModal(){
      this.sectionEditmode = false;
      this.sectionForm.reset();
      $('#sectionModal').modal('show');
    },
    createSection(){
      this.$Progress.start();
      this.sectionForm.post('/api/section').then(()=>{
        Fire.$emit('AfterCreate');

        $('#sectionModal').modal('hide')

        toast({
          type: 'success',
          title: 'Section created successfully'
        })

        this.$Progress.finish();
      }).catch(()=>{
        this.$Progress.fail()
      })
    },
    editSectionModal(section){
      this.sectionEditmode = true;
      this.sectionForm.reset();
      $('#sectionModal').modal('show');
      this.sectionForm.fill(section);
    },
    updateSection(){
      this.$Progress.start();
      this.sectionForm.put('/api/section/'+this.sectionForm.id).then(() => {
        $('#sectionModal').modal('hide');
        swal(
          'Updated!',
          'Section information has been updated.',
          'success'
        )
        this.$Progress.finish();
        Fire.$emit('AfterCreate');
      }).catch(() => {
        this.$Progress.fail();
      })
    },
    deleteSection(id){
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
          this.sectionForm.delete('/api/section/'+id).then(()=>{
            swal(
              'Deleted!',
              'Section has been deleted.',
              'success'
            )
            Fire.$emit('AfterCreate');
          }).catch(()=>{
            swal("Failed!", "There was something wrong.", "warning");
          });
        }
      })
    },
    loadData(){
      axios.get('/api/post/'+this.$route.params.id).then(({data}) => (this.post = data));
      axios.get("/api/costumer").then(({data}) => (this.costumers = data.data));
      axios.get("/api/item").then(({data}) => (this.items = data));
    }
  },
  created() {
    this.loadData();

    Fire.$on('AfterCreate',() => {
      this.loadData();
    });
  }
}
</script>
