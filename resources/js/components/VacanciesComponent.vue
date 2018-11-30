<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">Vacantes</h1>
        <hr>
        <div class="row" v-for="vacancy in vacancies.data" :key="vacancy.id">
          <div class="col-md-12">
            <div class="card">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-3 ml-2 mr-2 mt-2 mb-2" style="background-image: url('/img/vacancies/thumbnail_vacancy.jpg');background-position: center;background-repeat: no-repeat;background-size: cover;min-height:210px;">
                  </div>
                  <div class="col mt-2 mb-2">
                    <div class="row">
                      <div class="col">
                        <span class="badge badge-pill badge-secondary">{{ vacancy.department }}</span>
                        <i class="fas fa-clock ml-2"></i> {{ vacancy.created_at | DateS }} a las {{ vacancy.created_at | myTime }}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col mt-2">
                        <h3>{{ vacancy.name }}</h3>
                        <p v-if="vacancy.requirements" v-html="$options.filters.characters(vacancy.requirements)"></p>
                        <p v-else="vacancy.requirements">no requirements.</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <router-link :to="'/vacancy/'+vacancy.id" class="btn btn-link">
                          Leer más <i class="fas fa-angle-right ml-1"></i>
                        </router-link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <pagination :data="vacancies" @pagination-change-page="getResults"></pagination>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="vacanciesModal" tabindex="-1" role="dialog" aria-labelledby="vacanciesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createvacanciesLabel">{{ vacancy.name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <h5>Requisitos:</h5>
                    <span v-html="vacancy.requirements"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <span v-html="vacancy.description"></span>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      vacancies: {},
      vacancy: {},
    }
  },
  methods: {
    showModal(id){
      $('#vacanciesModal').modal('show');
      axios.get('api/vacancy/'+id).then((response) => {
        this.vacancy = response.data;
        console.log(this.vacancy)
      });
    },
    getResults(page = 1) {
      axios.get('api/vacancy?page=' + page).then(response => {
        this.vacancies = response.data;
      });
    },
    loadVacancies(){
      axios.get("api/vacancy").then(({data}) => (this.vacancies = data));
    }
  },
  mounted() {
    this.loadVacancies();
  }
}
</script>
