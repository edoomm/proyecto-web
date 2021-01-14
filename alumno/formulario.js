$(document).ready(function () {
    var rango = [1994, 2021];
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoClose: true,
        minDate: new Date(1995, 0, 1),
        maxDate: new Date(2020, 11, 31),
        yearRange: rango,
        i18n: {
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
            weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
        }
    });
    $('select').formSelect();
    $('.tabs').tabs();
    M.updateTextFields();

    $("form input").focus(function(){
        let parent = $(this).parent();
        if(parent.hasClass("validetta-error") == true){
            parent.removeClass("validetta-error");
            parent.find("span.validetta-bubble").remove();
        }
    });

    $("form").validetta({
        // validators: {
        //     regExp: {
        //         curp: {
        //             pattern: /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        //             errorMessage: "Ingresa un curp válido."
        //         },
        //         fecha_nac: {
        //             pattern: /^((199[0-9]|200[0-5])(-)(0[1-9]|1[0-2])(-)(0[1-9]|1[0-9]|2[0-9]|3[0-1]))$/,
        //             errorMessage: "Elige una fecha válida."
        //         },
        //         telefono: {
        //             pattern: /^[2-9]{10}$/,
        //             errorMenssage: "Proporciona tu número a 10 dígitos."
        //         },
        //         cp: {
        //             pattern: /^[0-9]{5}$/,
        //             errorMenssage: "Agrega solo los 5 dígitos de tu código postal."
        //         },
        //         promedio: {
        //             pattern: /^(10)$|(^(\b[0-9]\b)(\.\b[0-9]{1,2}\b)?$)/,
        //             errorMenssage: "Puedes ocupar un número entero o un decimal con máximo 2 decimales."
        //         }
        //     }
        // },
        realTime: true,
        bubblePosition: 'bottom',
        //bubbleGapTop: 10,
        //bubbleGapLeft: -5,
        onValid: function (e) {
            e.preventDefault();
            var curp = $("#curp").val();
            var correo = $("#correo").val();
            $.alert({
                title: "VALIDA QUE TU CURP Y TU CORREO SEAN CORRECTOS, SON IMPORTANTES PARA TU ACCESO AL SISTEMA",
                content: "" +
                    "<h6>Si colocaste mal un caracter puedes CANCELAR para volver al formulario y editar tu información, si todo es correcto, agrega una contraseña con la que podras iniciar sesión.</h6>" +
                    "<form>" +
                        "<br><div class='row'>" +
                            "<div class='col s12 m6 input-field'>" +
                                "<label class='active' for='confirma_curp'>Curp</label>" +
                                "<input readonly type='text' id='confirma_curp' name='confirma_curp' value='" + curp + "'>" +
                            "</div>" +
                            "<div class='col s12 m6 input-field'>" +
                                "<label class='active' for='confirma_correo'>Correo</label>" +
                                "<input readonly type='text' id='confirma_correo' name='confirma_correo' value='" + correo + "'>" +
                            "</div>" +
                        "</div>" +
                        "<div class='row'>" +
                            "<div class='col s12 m6 input-field'>" +
                                "<label for='contrasena'>Contraseña</label>" +
                                "<input type='password' id='contrasena' name='contrasena'>" +
                            "</div>" +
                            "<div class='col s12 m6 input-field'>" +
                                "<label for='confirma_contrasena'>Confirma la contraseña</label>" +
                                "<input type='password' id='confirma_contrasena' name='confirma_contrasena'>" +
                            "</div>" +
                        "</div>" +
                    "</form>",
                buttons: {
                    Cancelar: {
                        btnClass: 'btn-red'
                    },
                    formConfirm: {
                        text: 'Confirmar',
                        btnClass: 'btn-blue',
                        action: function () {
                            var contrasena = this.$content.find('#contrasena').val();
                            var confirma_contrasena = this.$content.find('#confirma_contrasena').val();
                            if (!contrasena) {
                                $.alert('Debes de crear una contraseña');
                                return false;
                            }
                            if (!confirma_contrasena) {
                                $.alert('Debes de confirmar la contraseña');
                                return false;
                            }
                            if (contrasena != confirma_contrasena) {
                                $.alert('La contraseña no coincide');
                                return false;
                            }
                            var datos_form = $("#formulario_alumno").serializeArray();
                            datos_form.push({
                                name: 'contrasena',
                                value: contrasena
                            });
                            $.ajax({
                                url: "../php/formulario/formulario.php",
                                method: "POST",
                                data: datos_form,
                                cache: false,
                                success: function (respuesta) {
                                    let AX = JSON.parse(respuesta);
                                    if (AX.cod == 0) {
                                        $.alert({
                                            title: "¡Error!",
                                            content: AX.msj,
                                            buttons: {
                                                Confirmar: {
                                                    btnClass: 'btn-blue'
                                                }
                                            }
                                        });
                                    } else if (AX.cod == 1) {
                                        $.alert({
                                            title: AX.msj,
                                            content: AX.msj2,
                                            buttons: {
                                                Confirmar: {
                                                    btnClass: 'btn-blue',
                                                    action: function () {
                                                        let nombre = $("#nombre").val();
                                                        let curp = $("#curp").val();
                                                        //location.reload();
                                                        window.location.replace("../php/formulario/pdf.php?curp="+curp+"&nombre="+nombre);
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        $.alert({
                                            title: "¡¡Atención!!",
                                            content: AX.msj,
                                            buttons: {
                                                incioSesion: {
                                                    btnClass: 'btn-blue',
                                                    text: "Iniciar sesión",
                                                    action: function () {
                                                        $.alert("Nos lleva a la pagina de inicio de sesion");
                                                        location.reload();
                                                    }
                                                },
                                                Confirmar: {
                                                        action: function () {
                                                        location.reload();
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    }
                },
                onContentReady: function () {
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        e.preventDefault();
                        jc.$$formConfirm.trigger('click');
                    });
                }
            });
        },
        onError: function (e) {
            e.preventDefault();
            $.alert("Aun te faltan campos por completar");
        }
    });

    $("#bachillerato").change(function () {
        $("#nombre_Escuela").val('');
        $("#localidad").val('');
        $("#formacion_tecnica2").val('');
        $("#nombre_Escuela").prop("readonly", false);
        M.updateTextFields();
        resetCarreras();
        resetEscuelas();
        cambiarSelect();
    });

    $("#escuelas").change(function () {
        var esc = $("#escuelas").val();
        //var bachillerato = $("#bachillerato option:selected").text();
        var bachillerato = $("#bachillerato").val();
        $("#localidad").val('');

        if (bachillerato == "BACHILLERATO TÉCNICO") {
            $("#formacion_tecnica2").val('');
            resetCarreras();
            if (esc != "OTRA") {
                cambiarCarreras(esc);
            }
            mismoSelect(esc, 1);
        } else if (bachillerato == "BACHILLERATO EN LÍNEA") {
            mismoSelect(esc, 2);
        }
    });

    $("#btnPrevious2").click(function () {
        var el = document.getElementById("tabs-swipe-demo");
        var instance = M.Tabs.getInstance(el);
        instance.select('test-swipe-1');
    });

    $("#btnContinue1, #btnPrevious3").click(function () {
        var el = document.getElementById("tabs-swipe-demo");
        var instance = M.Tabs.getInstance(el);
        instance.select('test-swipe-2');
    });

    $("#btnContinue2, #btnPrevious4").click(function () {
        var el = document.getElementById("tabs-swipe-demo");
        var instance = M.Tabs.getInstance(el);
        instance.select('test-swipe-3');
    });

    $("#btnContinue3").click(function () {
        var el = document.getElementById("tabs-swipe-demo");
        var instance = M.Tabs.getInstance(el);
        instance.select('test-swipe-4');
    });
});

function cambiarSelect() {
    //var bachillerato = $("#bachillerato option:selected").text();
    var bachillerato = $("#bachillerato").val();
    if (bachillerato == 'BACHILLERATO TÉCNICO') {
        $("#box_escuela_1").css("display", "block");
        $("#nombre_escuela").css("display", "none");
        $("#box_formacion_tecnica").css("display", "none");
        $("#input_formacion_tecnica").css("display", "none");
        $("#localidad").prop("readonly", true);
        cambiarEscuelas(bachillerato);
    } else if (bachillerato == 'BACHILLERATO GENERAL') {
        $("#nombre_escuela").css("display", "block");
        $("#box_escuela_1").css("display", "none");
        $("#box_formacion_tecnica").css("display", "none");
        $("#input_formacion_tecnica").css("display", "none");
        $("#localidad").prop("readonly", false);
    } else if (bachillerato == 'BACHILLERATO EN LÍNEA') {
        $("#nombre_escuela").css("display", "none");
        $("#box_escuela_1").css("display", "block");
        $("#box_formacion_tecnica").css("display", "none");
        $("#input_formacion_tecnica").css("display", "none");
        $("#localidad").prop("readonly", true);
        cambiarEscuelas(bachillerato);
    }
}

function cambiarCarreras(escuela) {
    $.ajax({
        url: "../php/formulario/carreras.php",
        method: "POST",
        cache: false,
        data: {
            escuela: escuela
        },
        success: function (carreras) {
            let AX = JSON.parse(carreras);
            for (i = 0; i < AX.length; i++) {
                $('#formacion_tecnica').append($('<option value="' + AX[i] + '">' + AX[i] + '</option>'));
                $('#formacion_tecnica').formSelect();
            }
        }
    });
}

function cambiarUbicacion(escuela) {
    $.ajax({
        url: "../php/formulario/ubicacion.php",
        method: "POST",
        cache: false,
        data: {
            escuela: escuela
        },
        success: function (ubicacion) {
            var localidad = document.getElementById("localidad");
            localidad.value = ubicacion;
            let parent = $("#localidad").parent();
            if(parent.hasClass("validetta-error") == true){
                parent.removeClass("validetta-error");
                parent.find("span.validetta-bubble").remove();
            }
            M.updateTextFields();
        }
    });
}

function cambiarEscuelas(bachillerato) {
    $.ajax({
        url: "../php/formulario/escuelas.php",
        cache: false,
        method: "POST",
        data: {
            bachillerato: bachillerato
        },
        success: function (escuelas) {

            let AX = JSON.parse(escuelas);

            if (bachillerato == "BACHILLERATO TÉCNICO") {
                for (i = 0; i < AX.length; i++) {
                    if ((i + 1) < AX.length) {
                        $('#escuelas').append($('<option value="' + (i + 1) + '">' + AX[i] + '</option>'));
                    } else {
                        $('#escuelas').append($('<option value="' + "OTRA" + '">' + AX[i] + '</option>'));
                    }
                    $('#escuelas').formSelect();
                }
            } else if (bachillerato == "BACHILLERATO EN LÍNEA") {
                $('#escuelas').append($('<option value="' + "10" + '">' + AX[0] + '</option>'));
                $('#escuelas').append($('<option value="' + "OTRA" + '">' + AX[1] + '</option>'));
                $('#escuelas').formSelect();
            }
        }
    });
}

function mismoSelect(esc, n) {
    if (esc != "OTRA") {
        $("#nombre_escuela").css("display", "none");
        $("#localidad").prop("readonly", true);
        M.updateTextFields();
        if (n == 1) {
            $("#box_formacion_tecnica").css("display", "block");
            $("#input_formacion_tecnica").css("display", "none");
        }
        cambiarUbicacion(esc);
    } else {
        M.updateTextFields();
        $("#localidad").prop("readonly", false);
        $("#nombre_escuela").css("display", "block");
        if (n == 1) {
            $("#box_formacion_tecnica").css("display", "none");
            $("#input_formacion_tecnica").css("display", "block");
        }
    }
}

function resetCarreras() {
    var num_carreras = document.getElementById("formacion_tecnica");
    if (num_carreras.length > 1) {
        num_carreras.length = 1;
    }
}

function resetEscuelas() {
    var num_escuelas = document.getElementById("escuelas");
    if (num_escuelas.length > 1) {
        num_escuelas.length = 1;
    }
}

function mayuscula(e){
    e.value = e.value.toUpperCase();
}