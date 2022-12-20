let table = $('#bookings-table').DataTable({
    ajax: 'reserve',
    language: {
        url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
    },
    columns: [
        { data: 'title' },
        { data: 'description' },
        { data: 'date' },
        { data: 'status' },
    ],
    buttons: [],
    })
