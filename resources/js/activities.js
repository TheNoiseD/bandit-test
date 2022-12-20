
let table = $('#activities-table').DataTable({
    initComplete: function () {
        var api = this.api();
        api.$('td').click(function () {
            // obtenew datos de la fila
            let data = api.row($(this).parents('tr')).data();
            window.location.href = 'activities/' + data.id;
        })
    },
    ajax: 'activities',
    language: {
        url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
    },
    columns: [
        { data: 'title' },
        { data: 'description' },
        { data: 'price' },
        { data: 'start_date' },
        { data: 'end_date' },
        { data: 'action'}
    ],
    buttons: [],
    })


