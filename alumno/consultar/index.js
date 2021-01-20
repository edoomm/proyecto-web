$("#auth").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "consultar.php",
        method: "POST",
        cache: false,
        data: {curp: $("#curp").val(), contra: $("#password").val()},
        success: function (respax) {
        if (respax == "true") {
            enviarCorreo();
        }
        else {
            alert("CURP o contraseña incorrectos");
        }
        }
    });
});

  /**
   * Función que enviará el comprobante al correo, si pone un correo en el formulario se enviará a ese correo, esto siendo útil si el alumno pierde acceso al correo con el que se había registrado
   * (Tal vez también se puede actualizar el correo registrado en dado caso)
   */
function enviarCorreo() {
    alert("Correo casi enviado xd");
}