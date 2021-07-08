<template>
  <div id="app">
    <Header/>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <br/>
      <b-container class="bv-example-row">
        <b-card border-variant="primary" header="Cadastro de pacientes" header-bg-variant="primary" header-text-variant="white" align="center">
        <b-row>
          <b-col>
            <b-form-group id="input-group-1" label="Nome completo" label-for="input-1">
              <b-form-input id="input-1" v-model="form.nome_paciente"  type="text" placeholder="Informe o nome do paciente" required></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-2" label="RG" label-for="input-2">
              <b-form-input id="input-2" v-model="form.rg" v-mask="'##.###.###-##'"  type="text" placeholder="Informe o rg do paciente" required></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-3" label="CPF" label-for="input-3">
              <b-form-input id="input-3" v-model="form.cpf" v-mask="'###.###.###-##'"  type="text" placeholder="Informe o CPF do paciente" required></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col>
            <b-form-group id="input-group-4" label="Data de nascimento" label-for="input-4">
              <b-form-input id="input-4" v-model="form.dt_nascimento"  type="date" placeholder="Informe a data de nascimento" required></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-5" label="Telefone" label-for="input-5">
              <b-form-input id="input-5" v-model="form.telefone" v-mask="'(##) #.####-####'"  type="text" placeholder="Informe o telefone do paciente" required></b-form-input>
            </b-form-group>
          </b-col>
          
        </b-row>
        <br/>
        <b-button type="submit"   variant="primary" >Cadastar</b-button>
        
      </b-card>
      <br/>

      </b-container>
            <b-container class="bv-example-row">
              <b-card border-variant="primary" header="Pacientes cadastrados" header-bg-variant="primary" header-text-variant="white" align="center">
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
          telefone: '',
          dt_nascimento: '',
          cpf: '',
          rg: '',
          nome_paciente: ''

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
          this.$bvModal.msgBoxOk('Paciente cadastrado com sucesso', {
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
        axios.get('http://localhost/covid19/operacao.php?listarpacientes=1').then(function(response){
          this.items = response.data
        }.bind(this))
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.nome_paciente = ''
        this.form.rg = ''
        this.form.cpf = ''
        this.form.telefone = ''
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