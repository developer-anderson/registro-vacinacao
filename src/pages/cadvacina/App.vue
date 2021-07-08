<template>
  <div id="app">
    <Header/>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <br/>
      <b-container class="bv-example-row">
        <b-card border-variant="primary" header="Cadastro de vacinas" header-bg-variant="primary" header-text-variant="white" align="center">
        <b-row>
          <b-col>
            <b-form-group id="input-group-1" label="Fabricante" label-for="input-1">
              <b-form-input id="input-1" v-model="form.fabricante"  type="text" placeholder="Informe o nome do fabricante" required></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-2" label="Lote" label-for="input-2">
              <b-form-input id="input-2" v-model="form.lote"  type="text" placeholder="Informe o lote da vacina" required></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-3" label="Data de validade do lote" label-for="input-3">
              <b-form-input id="input-3" v-model="form.datavalidade" value="2021-06-30"  type="date" placeholder="Informe a data de validade do lote das vacinas" required></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col>
            <b-form-group id="input-group-4" label="Numero de doses" label-for="input-4">
              <b-form-input id="input-4" v-model="form.numerodoses"  type="number" placeholder="Informe o numero de doses" required></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-5" label="Intervalo das doses" label-for="input-5">
              <b-form-input id="input-5" v-model="form.intervalominimodoses"  type="number" placeholder="Informe o intervalo minimo em dias" required></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <br/>
        <b-button type="submit"   variant="primary" >Cadastar</b-button>
        
      </b-card>
      <br/>

      </b-container>
      <b-container class="bv-example-row">
              <b-card border-variant="primary" header="Vacinas cadastradas" header-bg-variant="primary" header-text-variant="white" align="center">
        <div>
          <b-table :items="items" :fields="fields" :tbody-tr-class="rowClass"></b-table>
         </div>
      </b-card>
      </b-container>  

      
    </b-form>
  </div>
</template>

<script>
import Header from './../../components/Header.vue'
import axios from 'axios'

  export default {
    name: 'App',
    components: {
      Header
    },
    data() {
      this.updateData()
      return {
        items: '',
        form: {
          intervalominimodoses: '',
          numerodoses: '',
          datavalidade: '',
          lote: '',
          fabricante: ''

        },
        show: true,
      }
      
    },
    methods: {
      onSubmit(event) {
        event.preventDefault()   

        axios.post('http://localhost/covid19/operacao.php', this.form)
        .then(function( ){
          this.renderComponent = true;
          this.$bvModal.msgBoxOk('Vacina cadastrada com sucesso', {
            size: 'sm',
            buttonSize: 'sm',
            okVariant: 'success',
            headerClass: 'p-2 border-bottom-0',
            footerClass: 'p-2 border-top-0',
            centered: true
          })
          this.items = ''
          this.updateData()
        }.bind(this))
        

      },
      updateData(){
        axios.get('http://localhost/covid19/operacao.php?listarvacinas=1').then(function(response){
          this.items = response.data
        }.bind(this))
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.intervalominimodoses = ''
        this.form.numerodoses = ''
        this.form.datavalidade = ''
        this.form.lote = ''
        this.form.fabricante = ''
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;

}
input{margin: 10px}
</style>