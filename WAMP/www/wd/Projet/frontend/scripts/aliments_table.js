$(document).ready(function () {
    $("#aliment").DataTable({
        pageLength: 7,
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
                width: "30%",
                defaultContent: '0'
            },
            {
                data: 'Type',
                width: "20%",
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Energie',
                width: "10%",
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Eau',
                width: "10%",
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Protéines',
                width: "10%",
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Glucides',
                width: "10%",
                defaultContent: '0'
            },
            {
                data: 'Nutriments.Lipides',
                width: "10%",
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