module.exports = {
  pages: {
    index: {
      // entry for the page
      entry: 'src/pages/home/main.js',
      title: 'Desafio'
    },
    cadvacina: {
      entry: 'src/pages/cadvacina/main.js',
      title: 'Cadastro de vacinas'
    },
    cadpaciente: {
      entry: 'src/pages/cadpaciente/main.js',
      title: 'Cadastro de pacientes'
    },
    regvacinacao: {
      entry: 'src/pages/regvacinacao/main.js',
      title: 'Aplicação de doses'
    }
  },
  devServer: {
    proxy: 'http://localhost',
}
}