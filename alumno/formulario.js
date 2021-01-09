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
    $("form").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(e){
            e.preventDefault();
            $.ajax({
                url:"../php/formulario/formulario.php",
                method: "POST",
                data: $("#formulario_alumno").serialize(),
                cache:false,
                success:function(respuesta){
                    let AX = JSON.parse(respuesta);
                    if(AX.cod == 0){
                        $.alert({
                            title: "¡Error!",
                            content: AX.msj,
                            buttons:{
                                Ok: {
                                    btnClass: 'btn-blue'
                                }
                            }
                        });
                    }
                    else if(AX.cod == 1){
                        $.alert({
                            title:AX.msj,
                            content:""+
                            "<h7>Valida que tu curp sea CORRECTO, si no es así, puedes editarlo y crea una contraseña para que puedas acceder al sistema.</h7>"+
                            "<form>"+
                                "<br><div class='row'>"+
                                    "<div class='col s12 input-field'>"+
                                        "<label class='active' for='confirma_curp'>Curp</label>"+
                                        "<input readonly type='text' id='confirma_curp' name='confirma_curp' value='"+AX.curp+"'>"+
                                    "</div>"+
                                "</div>"+
                                "<div class='row'>"+
                                    "<div class='col s12 input-field'>"+
                                        "<label for='contrasena'>Contraseña</label>"+
                                        "<input type='password' id='contrasena' name='contrasena'>"+
                                    "</div>"+
                                "</div>"+
                                "<div class='row'>"+
                                    "<div class='col s12 input-field'>"+
                                        "<label for='confirma_contrasena'>Confirma la contraseña</label>"+
                                        "<input type='password' id='confirma_contrasena' name='confirma_contrasena'>"+
                                    "</div>"+
                                "</div>"+
                            "</form>",
                            buttons:{
                                formConfirm:{
                                    text: 'Confirmar',
                                    btnClass: 'btn-blue',
                                    action:function(){
                                        var contrasena = this.$content.find('#contrasena').val();
                                        var confirma_contrasena = this.$content.find('#confirma_contrasena').val();
                                        if(!contrasena){
                                            $.alert('Debes de crear una contraseña');
                                            return false;
                                        }
                                        if(!confirma_contrasena){
                                            $.alert('Debes de confirmar la contraseña');
                                            return false;
                                        }
                                        if(contrasena != confirma_contrasena){
                                            $.alert('La contraseña no coincide');
                                            return false;
                                        }
                                        location.reload();
                                    }
                                }
                            },
                            onContentReady: function(){
                                var jc = this;
                                this.$content.find('form').on('submit',function(e){
                                    e.preventDefault();
                                    jc.$$formConfirm.trigger('click');
                                });
                            }
                        });
                    }
                    else{
                        $.alert({
                            title:"¡¡Atención!!",
                            content: AX.msj,
                            buttons:{
                                incioSesion: {
                                    btnClass: 'btn-blue',
                                    text: "Iniciar sesión",
                                    action: function(){
                                        alert("Nos lleva a la pagina de inicio de sesion");
                                    }
                                },
                                confirmar: function(){
                                    location.reload();
                                }
                            },
                        });
                    }
                }
            });
        },
        onError:function(e){
            e.preventDefault();
            alert("Aun te faltan campos por completar");
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

    $("#escuelas").change(function (){
        var esc = $("#escuelas").val();
        var bachillerato = $("#bachillerato option:selected").text();
        $("#localidad").val('');
        
        if(bachillerato == "Bachillerato técnico"){
            $("#formacion_tecnica2").val('');
            resetCarreras();
            if (esc != "Otra"){
                cambiarCarreras(esc);
            }
            mismoSelect(esc, 1);
        }
        else if(bachillerato == "Bachillerato en línea"){
            mismoSelect(esc, 2);
        }
    });

    $("#btnPrevious2").click(function(){
        var el = document.getElementById("tabs-swipe-demo"); 
        var instance = M.Tabs.getInstance(el); 
        instance.select('test-swipe-1'); 
    });

    $("#btnContinue1, #btnPrevious3").click(function(){
        var el = document.getElementById("tabs-swipe-demo"); 
        var instance = M.Tabs.getInstance(el); 
        instance.select('test-swipe-2');
    });

    $("#btnContinue2, #btnPrevious4").click(function(){
        var el = document.getElementById("tabs-swipe-demo"); 
        var instance = M.Tabs.getInstance(el); 
        instance.select('test-swipe-3'); 
    });

    $("#btnContinue3").click(function(){
        var el = document.getElementById("tabs-swipe-demo"); 
        var instance = M.Tabs.getInstance(el); 
        instance.select('test-swipe-4'); 
    });
});

function cambiarSelect() {
    var bachillerato = $("#bachillerato option:selected").text();

    if (bachillerato == 'Bachillerato técnico') {
        $("#box_escuela_1").css("display", "block");
        $("#nombre_escuela").css("display", "none");
        $("#box_formacion_tecnica").css("display", "none");
        $("#input_formacion_tecnica").css("display", "none");
        $("#localidad").prop("readonly",true);
        cambiarEscuelas(bachillerato);
    } else if (bachillerato == 'Bachillerato general') {
        $("#nombre_escuela").css("display", "block");
        $("#box_escuela_1").css("display", "none");
        $("#box_formacion_tecnica").css("display", "none");
        $("#input_formacion_tecnica").css("display", "none");
        $("#localidad").prop("readonly", false);
    } else if (bachillerato == 'Bachillerato en línea') {
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
        data:{escuela:escuela},
        success: function (carreras) {
            let AX = JSON.parse(carreras);
            for (i = 0; i < AX.length; i++) {
                $('#formacion_tecnica').append($('<option value="' + AX[i] + '">'+AX[i]+'</option>'));
                $('#formacion_tecnica').formSelect();
            }
        }
    });
}

function cambiarUbicacion(escuela){
    $.ajax({
        url: "../php/formulario/ubicacion.php",
        method: "POST",
        cache: false,
        data:{escuela:escuela},
        success: function (ubicacion){
            var localidad = document.getElementById("localidad");
            localidad.value = ubicacion;
            M.updateTextFields();
        }
    });
}

function cambiarEscuelas(bachillerato){
    $.ajax({
        url: "../php/formulario/escuelas.php",
        cache: false,
        method: "POST",
        data: {bachillerato:bachillerato},
        success: function(escuelas){
            
            let AX = JSON.parse(escuelas);
            
            if(bachillerato == "Bachillerato técnico"){
                for (i = 0; i < AX.length; i++) {
                    if((i+1) < AX.length){
                        $('#escuelas').append($('<option value="' + (i+1) + '">'+AX[i]+'</option>'));
                    }
                    else{
                        $('#escuelas').append($('<option value="' + "Otra" + '">'+AX[i]+'</option>'));
                    }
                    $('#escuelas').formSelect();
                }
            }
            else if(bachillerato == "Bachillerato en línea"){
                $('#escuelas').append($('<option value="' + "10" + '">'+AX[0]+'</option>'));
                $('#escuelas').append($('<option value="' + "Otra" + '">'+AX[1]+'</option>'));
                $('#escuelas').formSelect();
            }
        }
    });
}

function mismoSelect(esc, n){
    if(esc!="Otra"){
        $("#nombre_escuela").css("display", "none");
        $("#localidad").prop("readonly", true);
        M.updateTextFields();
        if (n == 1){
            $("#box_formacion_tecnica").css("display", "block");
            $("#input_formacion_tecnica").css("display", "none");
        }
        cambiarUbicacion(esc);
    }
    else{
        M.updateTextFields();
        $("#localidad").prop("readonly", false);
        $("#nombre_escuela").css("display", "block");
        if (n == 1){
            $("#box_formacion_tecnica").css("display", "none");
            $("#input_formacion_tecnica").css("display", "block");
        }
    }
}

function resetCarreras(){
    var num_carreras = document.getElementById("formacion_tecnica");
    if(num_carreras.length > 1){
        num_carreras.length = 1;
    }
}

function resetEscuelas(){
    var num_escuelas = document.getElementById("escuelas");
    if(num_escuelas.length > 1){
        num_escuelas.length = 1;
    }
}

