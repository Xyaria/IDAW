function profile_modifyUser(){
    var userLogin = $(".signin input[name=userLogin]").val();
    var userPassword_old = $(".signin input[name=userPassword_old]").val(); 
    var userSurname = $(".signin input[name=userSurname]").val(); 
    var userName = $(".signin input[name=userName]").val(); 
    var userMail = $(".signin input[name=userMail]").val(); 
    var userBirthday = $(".signin input[name=userBirthday]").val(); 
    var userSex = $(".signin input[type=radio][name=userSex]:checked").val(); 
    var userLevel = $(".signin select[name=userLevel] option:checked").val(); 

    if(userPassword_old == userPassword){
        var userPassword = $(".signin input[name=userPassword]").val(); 
    }
    else{
        $(".modify table").append("<p>Mot de passe incorrect</p>");
        return;
    }
    
    var user = {
        login: userLogin, 
        mdp: userPassword,
        nom: userSurname,
        prenom: userName,
        mail: userMail,
        date_naissance: userBirthday,
        sexe: userSex,
        niveau: userLevel
    };
    return user;
}