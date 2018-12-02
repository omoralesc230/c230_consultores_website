<style>
  .sidenav-space{
    max-width:250px;
  }
  .full-height{
    min-height:100vh;
  }

  .w-100{
    width: 100%;
  }

  .h-100{
    min-height: 100%;
  }

  .btn-orange{
    background-color: #ff7900;
    border-color: #ff7900;
    color: white;
  }
</style>

<template>
  <div>
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col">
        <div class="container full-height" style="margin-top:80px;">
          <h1 class="">{{ vacancy.name }}</h1>
          <hr>
          <div class="row">
            <div class="col-md-7">
              <div class="card h-100">
                <div class="card-body">
                  <h3>Requisitos de la vacante</h3>
                  <span v-html="vacancy.requirements"></span>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card h-100">
                <v-lazy-image class="card-img-top" src="/img/vacancies/c230_staff.jpg" src-placeholder="/img/hourglass.png" alt="Card image cap"/>
                <div class="card-body">
                  <v-lazy-image class="img-fluid" src="/img/vacancies/distintivo_iuvenia.png" src-placeholder="/img/hourglass.png" alt="Card image cap"/>
                  <p class="card-text">
                    A C230 Consultores le otorgaron el distintivo IUVENIA para Empresas Amigas de los Jóvenes, por ser una organización líder en políticas de Recursos Humanos, que atrae al mejor talento, invierte en él y desarrolla a su gente.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col d-none d-md-block sidenav-space"></div>
      <div class="col bg-white">
        <div class="container mt-4 mb-4">
          <span v-html="vacancy.description"></span>
          <button class="btn btn-orange w-100 mt-2" @click="showModal()">
            Aplicar a la vacante
          </button>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="applicationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createvacanciesLabel">Aplicación para {{ vacancy.name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createApplication()">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="form-group">
                <input v-model="form.name" type="text" name="name" placeholder="Nombre completo"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <input v-model="form.email" type="email" name="email" placeholder="Correo electrónico"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group">
                <label for="motivation_letter">Carta motivos</label>
                <input type="file" @change="addMotivationLetter" class="form-control-file" id="motivation_letter" name="motivation_letter">
              </div>
              <div class="form-group">
                <label for="curriculum">Curriculum Vitae</label>
                <input type="file" @change="addCV" class="form-control-file" id="curriculum" name="curriculum">
              </div>
              <div class="form-group">
                <input v-model="form.source" type="text" name="source" placeholder="¿Cómo te enteraste de nosotros?"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('source') }">
                <has-error :form="form" field="source"></has-error>
              </div>
              <div class="form-group">
                <select v-model="form.situation" class="form-control" id="situation" name="situation" :class="{ 'is-invalid': form.errors.has('situation') }">
                  <option>Situación actual</option>
                  <option value="soy estudiante">Soy estudiante</option>
                  <option value="soy estudiante y busco empleo">Soy estudiante y busco empleo</option>
                  <option value="soy recién egresado y busco empleo">Soy recién egresado y busco empleo</option>
                  <option value="terminé mis estudios (pero aún no me titulo) y busco empleo">Terminé mis estudios (pero aún no me titulo) y busco empleo</option>
                  <option value="terminé mis estudios (pero aún no me titulo) y estoy trabajando">Terminé mis estudios (pero aún no me titulo) y estoy trabajando</option>
                  <option value="estoy titulado y busco empleo">Estoy titulado y busco empleo</option>
                  <option value="estoy titulado y trabajo actualmente">Estoy titulado y trabajo actualmente</option>
                  <option value="otro">Otro</option>
                </select>
                <has-error :form="form" field="situation"></has-error>
              </div>
              <div class="form-group">
                <input v-model="form.university" type="text" name="university" placeholder="Universidad"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('university') }">
                <has-error :form="form" field="university"></has-error>
              </div>
              <div class="form-group">
                <input v-model="form.grade_average" type="number" min="0" max="10" name="grade_average" placeholder="Promedio actual o final de licenciatura"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('grade_average') }">
                <has-error :form="form" field="grade_average"></has-error>
              </div>
              <div class="form-group">
                <textarea v-model="form.topics" class="form-control" :class="{ 'is-invalid': form.errors.has('topics') }" id="topics" name="topics" rows="3" placeholder="De los temas en los que hemos trabajado, ¿hay alguno en el que preferirías no trabajar? ¿por qué? No te preocupes, tu respuesta no afectará el proceso de reclutamiento."></textarea>
                <has-error :form="form" field="topics"></has-error>
              </div>
              <div class="form-group">
                <textarea v-model="form.stata" class="form-control" :class="{ 'is-invalid': form.errors.has('stata') }" id="stata" name="stata" rows="3" placeholder="Cuéntanos qué es lo más complejo que has hecho en STATA."></textarea>
                <has-error :form="form" field="stata"></has-error>
              </div>
              <div class="form-group">
                <textarea v-model="form.plans" class="form-control" :class="{ 'is-invalid': form.errors.has('plans') }" id="plans" name="plans" rows="3" placeholder="¿Dónde te ves profesionalmente en 5 años? ¿Qué haces y qué has logrado? Tal vez es prematuro, pero queremos entender tus planes a futuro."></textarea>
                <has-error :form="form" field="plans"></has-error>
              </div>
              <div class="form-group">
                <label for="mexican">¿Tienes nacionalidad mexicana? Si bien somos empleadores incluyentes y no discriminamos por ningún motivo, nacionalidad incluido, debemos saber para cumplir con requisitos administrativos.</label>
                <div class="form-check">
                  <input v-model="form.mexican" class="form-check-input" :class="{ 'is-invalid': form.errors.has('mexican') }" type="radio" name="mexican" id="si" value="1" checked>
                  <label class="form-check-label" for="si">
                    si
                  </label>
                </div>
                <div class="form-check">
                  <input v-model="form.mexican" class="form-check-input" :class="{ 'is-invalid': form.errors.has('mexican') }" type="radio" name="mexican" id="no" value="0">
                  <label class="form-check-label" for="no">
                    no
                  </label>
                  <has-error :form="form" field="mexican"></has-error>
                </div>
              </div>
              <p>por último, las dos preguntas más importantes</p>
              <div class="form-group">
                <textarea v-model="form.reason_to_work" class="form-control" :class="{ 'is-invalid': form.errors.has('reason_to_work') }" id="reason_to_work" name="reason_to_work" rows="3" placeholder="Please answer in English: Tell us why you are interested in working at C230 Consultores (please use between 200 and 300 words)."></textarea>
                <has-error :form="form" field="reason_to_work"></has-error>
              </div>
              <div class="form-group">
                <textarea v-model="form.reason_to_hire" class="form-control" :class="{ 'is-invalid': form.errors.has('reason_to_hire') }" id="reason_to_hire" name="reason_to_hire" rows="3" placeholder="Please answer in English: Why should we hire you?"></textarea>
                <has-error :form="form" field="reason_to_hire"></has-error>
              </div>
              <div class="form-group">
                <textarea v-model="form.comments" class="form-control" :class="{ 'is-invalid': form.errors.has('comments') }" id="comments" name="comments" rows="3" placeholder="¡Gracias por tu interés en nosotros! Si tienes algún otro comentario, puedes hacerlo en este espacio."></textarea>
                <has-error :form="form" field="comments"></has-error>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-orange" @click="assignProp(vacancy.id)">Aplicar</button>
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
      vacancy: {},
      form: new Form({
        id: '',
        name: '',
        email: '',
        motivation_letter: '',
        curriculum: '',
        source: '',
        situation: '',
        university: '',
        grade_average: '',
        topics: '',
        stata: '',
        plans: '',
        mexican: '',
        reason_to_work: '',
        reason_to_hire: '',
        comments: '',
        vacancy_id: '',
      })
    }
  },
  methods: {
    assignProp(vacancy){
      this.form.vacancy_id = vacancy;
    },
    showModal(){
      this.form.reset();
      $('#applicationModal').modal('show');
    },
    createApplication(){
      this.$Progress.start();

      this.form.post('/api/application').then(()=>{
        Fire.$emit('AfterCreate');

        $('#applicationModal').modal('hide')

        toast({
          type: 'success',
          title: 'Aplicación guardada correctamente, te contactaremos lo más pronto posible.'
        })
        this.$Progress.finish();
      }).catch(()=>{
        this.$Progress.fail()
      })
    },
    addMotivationLetter(e) {
      // console.log('uploading');
      let file = e.target.files[0];
      console.log(file);
      let reader = new FileReader();
      // let vm = this;
      if (file['size'] < 2122775) {
        reader.onloadend = (file) => {
          // console.log('RESULT', reader.result)
          this.form.motivation_letter = reader.result;
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
    addCV(e) {
      // console.log('uploading');
      let file = e.target.files[0];
      console.log(file);
      let reader = new FileReader();
      // let vm = this;
      if (file['size'] < 2122775) {
        reader.onloadend = (file) => {
          // console.log('RESULT', reader.result)
          this.form.curriculum = reader.result;
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
  },
  mounted() {
    this.$parent.active_el = this.$route.path;
    axios.get('/api/vacancy/'+this.$route.params.id).then(({data}) => (this.vacancy = data));
  }
}
</script>
