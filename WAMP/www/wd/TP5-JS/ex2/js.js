function onFormSubmit() {
    // prevent the form to be sent to the server
    event.preventDefault();
    $('#errorMessage').empty();

    let nom = $("#inputNom").val();
    let mail = $("#inputMail").val();

    if(nom == ""){
        $('#errorMessage').html("Le champ Nom est obligatoire");
        return;
    }

    let user = {nom: nom, mail: mail};

    $.ajax({
        url: '../tools/API/users.php',
        type: 'POST',
        data: user
    });

    $("#studentsTableBody").append(`
        <tr>
            <td class="nom">${nom}</td>
            <td class="mail">${mail}</td>
            <td onclick="addUserToForm(this);"><span>Modifier</span></td>
            <td onclick="deleteUser(this);"><span>Supprimer</span></td>
        </tr>
    `);

    $('#inputNom').val("");
    $('#inputMail').val("");
}

function addUserToForm(modifyBtn){
    $('#modifyBtn').css({"display": "block"});
    $('#submitBtn').css({"display": "none"});
    let userRow = $(modifyBtn).closest("tr");

    $(userRow).attr('id', 'modifying');

    let nom = $(userRow).find(".nom").html();
    let mail = $(userRow).find(".mail").html();

    $('#inputNom').val(nom);
    $('#inputMail').val(mail);
}

function modifyUserInfo(){
    let nom = $("#inputNom").val();
    let mail = $("#inputMail").val();
    if(nom == ""){
        $('#errorMessage').html("Le champ Nom est obligatoire");
        return;
    }

    let userRow = $('#modifying');

    $(userRow).find(".nom").html(nom);
    $(userRow).find(".mail").html(mail);

    $('#modifyBtn').css({"display": "none"});
    $('#submitBtn').css({"display": "block"});

    $('#inputNom').val("");
    $('#inputmail').val("");

    $(userRow).removeAttr("id");
}

function deleteUser(userRow){
    $(userRow).closest("tr").remove();
}

$(document).ready(function(){
    var response = "";
    $.ajax({
        url: "../tools/DB/db_init.php",
        type: 'GET'
    });

    $.ajax({
        url: "../tools/API/users.php",
        type: 'GET',
        dataType: 'json',
        success: function(txt) {
            response = txt;
            alert(response);
        }
    });
});