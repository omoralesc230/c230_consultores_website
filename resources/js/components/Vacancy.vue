<style>
  .fixed-btn {
    position: fixed;
    right: 40px;
    bottom: 40px;
  }
  .pointer{
    cursor: pointer;
  }
</style>

<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Vacancies</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vacancies</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Vacancies Component</div>

          <div class="card-body">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Applications</th>
                    <th>Modify</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="vacancy in vacancies.data" :key="vacancy.id">
                    <td>{{ vacancy.id }}</td>
                    <td>{{ vacancy.name }}</td>
                    <td>{{ vacancy.department | upText }}</td>
                    <td>{{ vacancy.status | upText }}</td>
                    <td>{{ vacancy.created_at | myDate }}</td>
                    <td>
                      <span @click="showModal(vacancy.id)" class="badge badge-pill badge-secondary pointer">{{ vacancy.applications.length }}</span>
                    </td>
                    <td>
                      <a class="btn btn-primary" @click="editModal(vacancy)">
                        <i class="fas fa-edit"></i>
                        <!-- <span class=""> Edit</span> -->
                      </a>
                      <a class="btn btn-danger" @click="deleteVacancy(vacancy.id)">
                        <i class="fas fa-trash"></i>
                        <!-- <span> Delete</span> -->
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <pagination :data="vacancies" @pagination-change-page="getResults"></pagination>
          </div>
        </div>
      </div>
    </div>
    <button class="btn btn-success fixed-btn" @click="newModal">
      <i class="fas fa-plus fa-fw"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="vacanciesModal" tabindex="-1" role="dialog" aria-labelledby="vacanciesModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="createvacanciesLabel">Create Vacancy</h5>
            <h5 class="modal-title" v-show="editmode" id="createvacanciesLabel">Update Vacancy's Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateVacancy() : createVacancy()">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-9">
                  <div class="form-group">
                    <input v-model="form.name" type="text" name="name" placeholder="Name"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>

                  <!-- <div class="form-group">
                    <textarea v-model="form.requirements" name="requirements" placeholder="Requirements for vacancy"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('requirements') }">
                    </textarea>
                    <has-error :form="form" field="requirements"></has-error>
                  </div> -->

                  <!-- <div class="form-group">
                    <textarea v-model="form.description" name="description" placeholder="Short description for vacancy"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                    </textarea>
                    <has-error :form="form" field="description"></has-error>
                  </div> -->

                  <div class="form-group">
                    <vue-editor v-model="form.requirements"></vue-editor>
                  </div>

                  <div class="form-group">
                    <vue-editor v-model="form.description"></vue-editor>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="status" v-model="form.status" id="status" class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                      <option value="">Status</option>
                      <option value="public">Public</option>
                      <option value="private">Private</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <select name="type" v-model="form.department" id="department" class="form-control" :class="{ 'is-invalid': form.errors.has('department') }">
                      <option value="">Department</option>
                      <option value="consultancy">Consultancy</option>
                      <option value="administration">Administration</option>
                      <option value="digital solutions">Digital solutions</option>
                    </select>
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

    <!-- Show Modal -->
    <div class="modal fade" id="vacancyModal" tabindex="-1" role="dialog" aria-labelledby="vacancyModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showVacancyLabel">{{ vacancy.name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="accordion" id="accordionApplications">
                <div class="card" v-for="application in vacancy.applications" :key="application.id">
                  <div class="card-header" :id="'heading'+application.id">
                    <h5 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="'#collapse'+application.id" aria-expanded="true" :aria-controls="'collapse'+application.id">
                        {{ application.name }} ({{ application.email }})
                      </button>
                    </h5>
                  </div>

                  <div :id="'collapse'+application.id" class="collapse" :aria-labelledby="'heading'+application.id" data-parent="#accordionApplications">
                    <div class="card-body">
                      <p>{{ application.source }}</p>
                      <p>{{ application.situation }}</p>
                      <p>{{ application.university }}</p>
                      <p>{{ application.grade_average }}</p>
                      <p>{{ application.topics }}</p>
                      <p>{{ application.stata }}</p>
                      <p>{{ application.plans }}</p>
                      <p>{{ application.mexican }}</p>
                      <p>{{ application.reason_to_work }}</p>
                      <p>{{ application.reason_to_hire }}</p>
                      <p>{{ application.comments }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueEditor } from 'vue2-editor'

export default {
  components: {
    VueEditor
  },
  data() {
    return {
      editmode: false,
      vacancies: {},
      vacancy: {},
      form: new Form({
        id: '',
        name: '',
        description: 'Add description...',
        department: '',
        status: '',
        requirements: 'Add requirements for this vacancy...'
      })
    }
  },
  methods: {
    getResults(page = 1) {
      axios.get('api/vacancy?page=' + page).then(response => {
        this.vacancies = response.data;
      });
    },
    loadVacancies(){
      axios.get("api/vacancy").then(({data}) => (this.vacancies = data));
    },
    showModal(id){
      $('#vacancyModal').modal('show');
      axios.get('/api/vacancy/'+id).then(({data}) => (this.vacancy = data));
    },
    newModal(){
      this.editmode = false;
      this.form.reset();
      $('#vacanciesModal').modal('show');
    },
    createVacancy(){
      this.$Progress.start();
      // Submit form via post request
      this.form.post('api/vacancy').then(()=>{
        Fire.$emit('AfterCreate');

        $('#vacanciesModal').modal('hide')

        toast({
          type: 'success',
          title: 'Vacancy created successfully'
        })

        this.$Progress.finish();
      }).catch(()=>{
        this.$Progress.fail()
      })
    },
    editModal(vacancy){
      this.editmode = true;
      this.form.reset();
      $('#vacanciesModal').modal('show');
      this.form.fill(vacancy);
    },
    updateVacancy(){
      this.$Progress.start();
      this.form.put('api/vacancy/'+this.form.id).then(() =>{
        //successfull
        $('#vacanciesModal').modal('hide');
        swal(
          'Updated!',
          'Vacancy information has been updated.',
          'success'
        )
        this.$Progress.finish();
        Fire.$emit('AfterCreate');
      }).catch(() => {
        this.$Progress.fail();
      });
    },
    deleteVacancy(id){
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
          this.form.delete('api/vacancy/'+id).then(()=>{
            swal(
              'Deleted!',
              'Vacancy has been deleted.',
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
    Fire.$on('searching',() => {
      let query = this.$parent.search;
      axios.get('api/findVacancy?q=' + query).then((data) => {
        this.vacancies = data.data
      }).catch(() => {

      })
    });

    this.loadVacancies();

    Fire.$on('AfterCreate',() => {
      this.loadVacancies();
    });
  }
}
</script>
