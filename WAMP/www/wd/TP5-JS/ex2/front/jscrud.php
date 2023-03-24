<!doctype html>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <title>tabletest</title>
    <style>
        body { 
            margin-top: 5em; 
        }

        .table {
            margin-top: 100px;
            margin-bottom: 100px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        td {
            padding: 0.1em 1em;
        }
        
        th:not(:last-child) {
            border-right: 1px solid black;
            font-weight: bold;
        }

        span {
            text-decoration: underline solid black 1px;
        }

        span:hover {
            color: rgb(77, 0, 177);
            text-decoration: underline solid rgb(77, 0, 177) 1px;

        }

        #modifyBtn {
            display: none;
        }
    </style>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Mail</th>
                <th scope="col" colspan="2">CRUD</th>
            </tr>
        </thead>

        <tbody id="studentsTableBody">
            <!-- table body -->
        </tbody>
    </table>

    <form id="addStudentForm" action="" onsubmit="onFormSubmit();">
        <div id="errorMessage"></div>
        <div class="form-group row">
            <label for="inputNom" class="col-sm-2 col-form-label">Nom*</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputNom" >
            </div>
        </div>
        <div class="form-group row">
            <label for="inputMail" class="col-sm-2 col-form-label">Mail</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputMail" >
            </div>
        </div>

        <div class="form-group row">
            <span class="col-sm-2"></span>
            <div class="col-sm-2">
                <button type="submit" id="submitBtn" class="btn btn-primary form-control">Submit</button>
            </div>
        </div>

        <div class="form-group row">
            <span class="col-sm-2"></span>
            <div class="col-sm-2">
                <button type="button" id="modifyBtn" class="btn btn-primary form-control" onclick="modifyUserInfo();">Modify</button>
            </div>
        </div>
    </form>

    <script>
        let lastID = 0;
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
    
            let user = {name: nom, mail: mail, id: 0};
            console.log(JSON.stringify(user)); // CHECKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK
    
            $.ajax({
                url: '../back/API/users.php',
                type: 'POST',
                data: JSON.stringify(user)
            })
            .done( (db_user) => {
                user['id'] = db_user['id'];
            });

            addToTable(user);
            clearForm();
        }

        function addToTable(user){
            $("#studentsTableBody").append(`
                <tr>
                    <td class="id" hidden="true">${user['id']}</td>
                    <td class="nom">${user['name']}</td>
                    <td class="mail">${user['mail']}</td>
                    <td onclick="addUserToForm(this);"><span>Modifier</span></td>
                    <td onclick="deleteUser(this);"><span>Supprimer</span></td>
                </tr>
            `);
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

            let user = {name: nom, mail: mail};

            // TODO - get user ID to use on POST
    
            $('#modifyBtn').css({"display": "none"});
            $('#submitBtn').css({"display": "block"});
            clearForm();
            $(userRow).removeAttr("id");
        }
    
        function deleteUser(userRow){
            $(userRow).closest("tr").remove();
        }

        function clearForm(){
            $('#inputNom').val("");
            $('#inputmail').val("");
        }
    
        $(document).ready(function(){
            var _API_PATH = "<?php require_once("../back/API/config.php"); echo _API_PATH; ?>";

            /* $.ajax({
                url: "../back/DB/db_init.php",
                method: 'GET'
            }); */
    
            $.ajax({
                url: "../back/API/users.php",
                method: 'GET',
                dataType: 'json'
            })
            .done((users) => {
                users.forEach(user => {
                    addToTable(user);
                });
                lastID = users[users.length-1]['id'];
            })
            .fail(() => {
                console.err("Error - data not obtained");
            });
        });
    </script>
</body>
</html>