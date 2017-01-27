//Si el login se hace correcto devuelve el nombre de usuario y el email
function onSuccess(googleUser) {
 var usernameGoogle =  googleUser.getBasicProfile().getName();
 var emailGoogle = googleUser.getBasicProfile().getEmail();
 alert("Usuario: "+usernameGoogle+"Email: "+emailGoogle);
}
//Si el login se hace erronamente devuelve error
function onFailure(error) {
  console.log(error);
}