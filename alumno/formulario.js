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
                    alert(respuesta);
                }
            });
        }
    });

    $("#bachillerato").change(function () {
        $("#nombre_Escuela").val('');
        $("#localidad").val('');
        $("#nombre_Escuela2").val('');
        $("#formacion_tecnica2").val('');
        M.updateTextFields();
        //FALTA RESETEAR LOS SELECT de las escuelas
        resetCarreras();
        cambiarSelect();
    });

    $("#escuelas").change(function (){
        var esc = $("#escuelas").val();
        $("#localidad").prop('value', '');
        $("#formacion_tecnica2").val('');
        resetCarreras();
        if(esc != 'Otra'){
            cambiarCarreras(esc);
        }
        mismoSelect(esc, 1);
    });

    $("#escuelas2").change(function (){
        var esc = $("#escuelas2").val();
        $("#localidad").prop('value', '');
        mismoSelect(esc, 2);
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
        $("#box_escuela_2").css("display", "none");
        $("#nombre_escuela").css("display", "none");
        $("#nombre_escuela2").css("display", "none");
        $("#box_formacion_tecnica").css("display", "none");
        $("#input_formacion_tecnica").css("display", "none");
        $("#localidad").prop('disabled', true);
    } else if (bachillerato == 'Bachillerato general') {
        $("#nombre_escuela").css("display", "block");
        $("#nombre_escuela2").css("display", "none");
        $("#box_escuela_1").css("display", "none");
        $("#box_escuela_2").css("display", "none");
        $("#box_formacion_tecnica").css("display", "none");
        $("#input_formacion_tecnica").css("display", "none");
        $("#localidad").prop('disabled', false);
        $("#nombre_Escuela").prop('disabled', false);
    } else if (bachillerato == 'Bachillerato en línea') {
        $("#nombre_escuela").css("display", "none");
        $("#nombre_escuela2").css("display", "none");
        $("#box_escuela_1").css("display", "none");
        $("#box_escuela_2").css("display", "block");
        $("#box_formacion_tecnica").css("display", "none");
        $("#input_formacion_tecnica").css("display", "none");
        $("#localidad").prop('disabled', true);
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
        success: function (ubicacion) {
            $("#localidad").val('"'+ubicacion+'"');
            M.updateTextFields();
        }
    });
}

function mismoSelect(esc, n){
    if(esc!="Otra"){
        $("#nombre_escuela2").css("display", "none");
        $("#localidad").prop('disabled', true);
        $("#nombre_Escuela2").val('');
        M.updateTextFields();
        if (n == 1){
            $("#box_formacion_tecnica").css("display", "block");
            $("#input_formacion_tecnica").css("display", "none");
        }
        cambiarUbicacion(esc);
    }
    else{
        M.updateTextFields();
        $("#localidad").prop('disabled', false);
        $("#nombre_escuela2").css("display", "block");
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


