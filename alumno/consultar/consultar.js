$(document).ready(function(){
    $("#input_correo").hide();
    $("form").validetta({
        validators: {
              regExp: {
                  curp: {
                      pattern: /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
                      errorMessage: "Ingresa un curp válido"
                  }
              }
        },
        realTime: true,
        display : 'inline',
        errorTemplateClass : 'validetta-inline',
        onValid: function(e) {
            e.preventDefault();
            consultar();
        }
    });
});

    function consultar() {
        $.ajax({
            url: "./consultar.php",
            method: "POST",
            cache: false,
            data: {curp: $("#curp").val(), contra: $("#password").val()},
            success: function (respax){
                if (respax != "false") {
                    let AX = JSON.parse(respax);
                    enviarCorreo(AX.curp,AX.nombre,AX.primer_apellido,AX.correo);
                }
                else {
                    alert("CURP o contraseña incorrectos");
                }
            }
        });
    }

  /**
   * Función que enviará el comprobante al correo, si pone un correo en el formulario se enviará a ese correo, esto siendo útil si el alumno pierde acceso al correo con el que se había registrado
   * (Tal vez también se puede actualizar el correo registrado en dado caso)
   */
function enviarCorreo(curp,nombre,primer_ape,correo) {
    let nuevo_correo = $("#email").val();
    if (nuevo_correo != ""){
        correo = nuevo_correo;
    }
    $.get("../../php/formulario/pdf.php",{curp:curp,nombre:nombre+" "+primer_ape},function(){
        $.confirm({
            content: function(){
                var self = this;
                return $.ajax({
                    url: "../../php/formulario/correo.php",
                    method: "POST",
                    data:{nombre:nombre+" "+primer_ape,curp:curp,correo:correo},
                    cache: false
                }).done(function(respuesta2){
                    console.log(respuesta2);
                    let AX2 = JSON.parse(respuesta2);
                    if(AX2.cod == 0){
                        self.setTitle("No se pudo enviar el correo, por favor intentalo de nuevo.");
                        self.setContent(AX2.msj);
                    }
                    else{
                        self.setTitle("¡Correo enviado!");
                        self.setContent(AX2.msj);
                    }
                }).fail(function(){
                    self.setContent('Ocurrio un error al enviarte tu comprobante, por favor envia un mensaje a escom.exdiagnostico@gmail.com para poder enviarte tu comprobante lo antes posible.');
                });
            },
            buttons: {
                Confirmar: {
                    btnClass: 'btn-blue'
                }
            },
            onDestroy(){
                location.reload();
            }
        });
    });
}

function mostrar_input(){
    $("#input_correo").show();
}
