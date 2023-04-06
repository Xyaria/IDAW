$(document).ready(function () {
    $("#repas").DataTable({
        pageLength: 9,
        lengthChange: false,
        bInfo: false,
        ajax: {
            url: "../backend/api/users/consommation", // ajouter la bonne API
            method: 'GET',
            dataSrc: ''
        },
        columns: [
            {
                data: 'Aliment',
                defaultContent: '0'
            },
            {
                data: 'Quantité',
                defaultContent: '0'
            },
            {
                data: 'Date',
                defaultContent: '1970-01-01'
            }
        ]
    });

    $.ajax({
        url: "../backend/api/users/consommation",
        method: 'GET',
        dataType: 'json'
    })
    .done((consos) => {
        var conso_list = [];
        consos.forEach(conso => {
            conso_list.push(conso['Nom']);
        });
    });
});