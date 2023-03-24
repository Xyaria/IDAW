function onFormSubmit() {
    // prevent the form to be sent to the server
    event.preventDefault();
    $('#errorMessage').empty();

    let nom = $("#inputNom").val();
    let prenom = $("#inputPrenom").val();
    let birthday = $("#inputNaissance").val();
    let cours = $("#inputCours").prop('checked');
    let rmq = $("#inputRmq").val();
    if(nom == ""){
        $('#errorMessage').html("Le champ Nom est obligatoire");
        return;
    }
    $("#studentsTableBody").append(`
        <tr>
            <td class="nom">${nom}</td>
            <td class="prenom">${prenom}</td>
            <td class="birthday">${birthday}</td>
            <td class="cours">${cours}</td>
            <td class="rmq">${rmq}</td>
            <td onclick="addUserToForm(this);"><span>Modifier</span></td>
            <td onclick="deleteUser(this);"><span>Supprimer</span></td>
        </tr>
    `);

    $('#inputNom').val("");
    $('#inputPrenom').val("");
    $('#inputNaissance').val("");
    $('#inputRmq').val("");
    $('#inputCours').prop('checked', false);
}

function addUserToForm(modifyBtn){
    $('#modifyBtn').css({"display": "block"});
    $('#submitBtn').css({"display": "none"});
    let userRow = $(modifyBtn).closest("tr");

    $(userRow).attr('id', 'modifying');

    let nom = $(userRow).find(".nom").html();
    let prenom = $(userRow).find(".prenom").html();
    let birthday = $(userRow).find(".birthday").html();
    let cours = $(userRow).find(".cours").html();
    let rmq = $(userRow).find(".rmq").html();

    $('#inputNom').val(nom);
    $('#inputPrenom').val(prenom);
    $('#inputNaissance').val(birthday);
    $('#inputRmq').val(rmq);
    if(cours == "true"){
        $('#inputCours').prop('checked', true);
    }
}

function modifyUserInfo(){
    let nom = $("#inputNom").val();
    if(nom == ""){
        $('#errorMessage').html("Le champ Nom est obligatoire");
        return;
    }
    let prenom = $("#inputPrenom").val();
    let birthday = $("#inputNaissance").val();
    let cours = $("#inputCours").prop('checked');
    let rmq = $("#inputRmq").val();

    let userRow = $('#modifying');

    $(userRow).find(".nom").html(nom);
    $(userRow).find(".prenom").html(prenom);
    $(userRow).find(".birthday").html(birthday);
    $(userRow).find(".rmq").html(rmq);
    if(cours){
        $(userRow).find(".cours").html("true");
    }
    else{
        $(userRow).find(".cours").html("false");
    }

    $('#modifyBtn').css({"display": "none"});
    $('#submitBtn').css({"display": "block"});
    $('#inputNom').val("");
    $('#inputPrenom').val("");
    $('#inputNaissance').val("");
    $('#inputRmq').val("");
    $('#inputCours').prop('checked', false);
    $(userRow).removeAttr("id");
}

function deleteUser(userRow){
    $(userRow).closest("tr").remove();
}

$(document).ready(function(){});