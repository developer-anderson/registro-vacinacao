<template>
  <div id="app">
    <Header/>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <br/>
      <b-container class="bv-example-row">
        <b-card border-variant="primary" header="Aplicação de dose" header-bg-variant="primary" header-text-variant="white" align="center">
        <b-row>
          <b-col>
            <b-form-group id="input-group-1" label="Paciente" label-for="input-1">
              <div>
                <b-form-input list="my-list-nome_paciente" id="input-1" v-model="form.nome_paciente"  type="text" placeholder="Informe o nome do paciente" required></b-form-input>
                <datalist id="my-list-nome_paciente">
                  <option v-for="item in items2" :key="item">{{ item.nome_paciente }}</option>
                </datalist>
              </div>
            </b-form-group>

          </b-col>
          <b-col>
            <b-form-group id="input-group-2" label="Fabricante/ Vacina" label-for="input-2">
              <div>
                <b-form-input list="my-list-nome_fabricante" id="input-2" v-model="form.nome_fabricante"  type="text" placeholder="Informe o nome da vacina" required></b-form-input>
                <datalist id="my-list-nome_fabricante">
                  <option v-for="fabricante in fabricantes" :key="fabricante">{{ fabricante.nome_fabricante }}</option>
                </datalist>
              </div>
            </b-form-group>
          </b-col>
        </b-row>
        <br/>
        <b-button type="submit"   variant="primary" >Registrar aplicação de dose</b-button>
        
      </b-card>
      <br/>

      </b-container>
      <b-container class="bv-example-row">
              <b-card border-variant="primary" header="Pacientes vacinados" header-bg-variant="primary" header-text-variant="white" align="center">
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
        items2: '',
        fabricantes: '',
        vacinados: '',
        form: {
          nome_paciente: '',
          nome_fabricante: '',
        },
        show: true,
      }
      
    },
    methods: {
      onSubmit(event) {
        event.preventDefault()   

        axios.post('http://localhost/covid19/operacao.php', this.form)
        .then(function(response ){
          if(response.data.situacao > 0){
            this.$bvModal.msgBoxOk(response.data.msg, {
              size: 'lg',
              buttonSize: 'lg',
              okVariant: 'success',
              headerClass: 'p-2 border-bottom-0',
              footerClass: 'p-2 border-top-0',
              centered: true
            })
            this.vacinados = ''
            this.updateData()
          }
          else{
              this.$bvModal.msgBoxOk(response.data.msg, {
              size: 'lg',
              buttonSize: 'lg',
              okVariant: 'danger',
              headerClass: 'p-2 border-bottom-0',
              footerClass: 'p-2 border-top-0',
              centered: true
            })
          }


        }.bind(this))
        

      },
      updateData(){
        axios.get('http://localhost/covid19/operacao.php?listarvacinados=1').then(function(response){this.items = response.data;console.log(JSON.stringify(this.items))}.bind(this))
        axios.get('http://localhost/covid19/operacao.php?listarpacientes=1').then(function(response){this.items2 = response.data}.bind(this))
        axios.get('http://localhost/covid19/operacao.php?listarvacinas=1').then(function(response){this.fabricantes = response.data}.bind(this))
        
        //console.log(this.items)
        
      },
      
      onReset(event) {
        event.preventDefault()
        this.form.nome_paciente = ''
        this.form.nome_fabricante = ''
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