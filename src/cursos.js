import DataTable from 'datatables.net-bs5';

document.addEventListener('DOMContentLoaded', function() {
  let cursosTable = new DataTable('.table-cursos', {
    searching: false,
    paging: false,
    bAutoWidth: false,
    language: {
      "sEmptyTable": "Nenhum curso encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ cursos",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 cursos",
      "sInfoFiltered": "(Filtrados de _MAX_ cursos)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ cursos por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum curso encontrado",
      "sSearch": "Pesquisar na tabela",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último",
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      },
    },
    "columnDefs": [
      { "targets": 0, "orderData": [ 1, 2, 0 ] },
      { "targets": 1, "orderData": [ 1 ] },
      { "targets": 2, "orderData": [ 1, 2 ] }
    ],
    "order": [[1, 'asc']],
  });
});
