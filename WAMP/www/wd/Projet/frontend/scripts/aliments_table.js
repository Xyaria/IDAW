$(document).ready(function () {
    $("#aliment").DataTable({
        pageLength: 9,
        lengthChange: false,
        bInfo: false,
        ajax: {
            url: "../backend/api/aliments/",
            method: 'GET',
            dataSrc: ''
        },
        columns: [
            {
                data: 'Nom',
                defaultContent: '0'
            },
            {
                data: 'Type',
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Energie',
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Eau',
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Protéines',
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Glucides',
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Lipides',
                defaultContent: '0'
            },
        ]
    });

    $.ajax({
        url: "../backend/api/aliments/",
        method: 'GET',
        dataType: 'json'
    })
    .done((aliments) => {
        var aliment_liste = [];
        aliments.forEach(aliment => {
            aliment_liste.push(aliment['Nom']);
        });
    });
});