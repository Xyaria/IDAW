$(document).ready(function () {
    $("#repas").DataTable({
        pageLength: 7,
        lengthChange: false,
        bInfo: false,
        ajax: {
            url: "../backend/api/users/consommation?id=1", // ajouter la bonne API
            method: 'GET',
            dataSrc: ''
        },
        columns: [
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
});