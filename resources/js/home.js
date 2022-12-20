let urlLang = "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
let activeSearch = false
let table, requestDate, participants

$('#search-activity').on('click', function(e) {
    e.preventDefault();
    requestDate = $('#date').val();
    participants = $('#participants').val();
    let uri = 'activities/search';
    dataTableOn(requestDate, participants,uri);
    activeSearch = true;
})
function dataTableOn(date, participants,uri) {
    if (activeSearch) {
        table.destroy();
    }
    table = $('#activities-table').DataTable({
        ajax: uri+'?date='+date+'&participants='+participants,
        language: {
            url: urlLang
        },
        columns: [
            { data: 'title' },
            { data: 'price' },
            { data: 'action'}
        ],
        createdRow: function (row, data) {
            $(row).attr('data-id', data.id);
        },
        buttons: []
    })
    let cardTable = $('.card-dataTable')
    if (cardTable.hasClass('d-none')) {
        // remover d-none con efecto fadein
        cardTable.fadeIn();
        cardTable.removeClass('d-none');
    }
    // al hacer click en .btn-reserve
    table.on('click', '.btn-reserve', function() {
        let id = $(this).parents('tr').data('id');
        $.ajax({
            url:'reserve',
            type:'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                activity_id: id,
                date: requestDate,
                participants: participants
            },
            success: function(data) {
                window.location.href = data.redirectTo;
            },
            error: function(data) {
                if (data.status == 401){
                    // redirect
                    window.location.href = '/login'
                }
            }
        })

    })
}


