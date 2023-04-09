function mesRepas_initTable(){
    var table_repas = $("#repas").DataTable({
        pageLength: 7,
        lengthChange: false,
        bInfo: false,
        select: {
            info: true,
            style: 'single'
        },
        ajax: {
            url: API_PATH + "/users/consommation?id=" + $(".userInfo#userId").text(),
            method: 'GET',
            dataSrc: ''
        },
        columns: [
            {
                data: 'id_conso',
                defaultContent: '0',
                visible: false
            },
            {
                data: 'label',
                width: '50%',
                defaultContent: '0'
            },
            {
                data: 'quantite',
                width: '25%',
                defaultContent: '0'
            },
            {
                data: 'date',
                width: '25%',
                defaultContent: '1970-01-01'
            }
        ]
    });
    $('#repas').append('<caption>Cliquer sur un repas pour le sélectionner</caption>');
}

function updatePage_mesRepas(){
    if(!$.fn.DataTable.isDataTable('#repas')){
        mesRepas_initTable();
    }
    else{
        $("#repas").DataTable().ajax.reload();
    }
}

function addConso(){
    $(".layer").removeClass("hidden");
    $("input[name='aliment_label']").val('');
    $("input[name='aliment_quantity']").val('');
    $("input[name='aliment_date']").val('');

    $(".layer form").on('submit', function(event) {
        event.preventDefault();

        var aliment_label = $("input[name='aliment_label']").val();
        var aliment_quantity = $("input[name='aliment_quantity']").val();
        var aliment_date = $("input[name='aliment_date']").val();
        var aliment_id = $("#db_aliments").find('option[value="' + aliment_label + '"]').attr("id");

        var aliment = {
            id_user: $(".userInfo#userId").text(),
            id_aliment: aliment_id,
            quantite: aliment_quantity,
            date: aliment_date
        };
        
        $.ajax({
            url: API_PATH + "/users/consommation",
            method: 'POST',
            data_type: 'json',
            data: JSON.stringify(aliment)
        })
        .done(() => {
            updatePage_mesRepas();
        });

        $(".layer").addClass("hidden");
    })
}