<template>
  <div id="app">
    <Header/>
    <img alt="Vue logo" src="../../assets/logo.png">

   <div>
        <b-jumbotron>
            <template #header>Desafio PRORADIS</template>

            <template #lead>
            Este desafio consiste em desenvolver um protótipo de aplicação que aborde a temática de 
                vacinação contra COVID-19. 
            </template>

            <hr class="my-4">

            <p>
            Os principais objetivos são: construir um cadastro de vacinas, 
                cadastrar pacientes, e registrar a aplicação de doses.
            </p>

            <b-button variant="primary" href="cadvacina">Comece cadastrando as vacinas</b-button>
            <b-button variant="success" href="cadpaciente">Agora cadastre os pacientes</b-button>
        </b-jumbotron>
    </div>

  </div>
</template>
     
<script>
import Header from './../../components/Header.vue'
export default {
  name: 'App',
  components: {
    Header
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
</style>
