//Función para ir a la ventana de login
function loginButton() {
    location.href = "/app/templates/login.html";
}

//Función para ir a la ventana de registro
function registerButton() {
    location.href = "/app/templates/register.html";
}

function altaUsuario() {
                    var mysql      = require('mysql');
                    var connection = mysql.createConnection({
                      host     : 'localhost',
                      user     : 'root',
                      password : '',
                      database : 'php_prueba'
                    });
                    connection.query('SELECT * FROM prueba', function(err,rows) {
                        if(err){
                         console.log(err);
                        }else{
                        var email = rows[0].Email;
                        $("#ojo").after(email);
                        }
                    });
};

    
