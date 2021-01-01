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
    $("form").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        // onValid:function(e){
        //     e.preventDefault();
        //     $.ajax({
        //         url:"../php/formulario/formulario.php",
        //         method: "POST",
        //         data: $("#formularioAlumnos").serialize(),
        //         cache:false,
        //         success:function(respuesta){
        //             alert(respuesta);
        //         }
        //     });
        //}
    });

    $("#bachillerato").change(function () {
        $("#nombre_Escuela").val('');
        $("#label_nombre_escuela").prop('class', '');
        $("#localidad").prop('value', '');
        $("#label_localidad").prop('class', '');
        $("#nombre_Escuela2").val('');
        $("#label_nombre_escuela2").prop('class', '');
        resetCarreras();
        cambiarSelect();
        //$(".disabled").prop('class', 'disabled selected'); para resetear las escuelas
    });

    $("#escuelas").change(function (){
        var esc = $("#escuelas").val();
        $("#localidad").prop('value', '');
        resetCarreras();
        cambiarCarreras(esc);
        mismoSelect(esc);
    });

    $("#escuelas2").change(function (){
        var esc = $("#escuelas2").val();
        $("#localidad").prop('value', '');
        resetCarreras();
        mismoSelect(esc);
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
        $("#box_formacion_tecnica").css("display", "block");
        $("#localidad").prop('disabled', true);
    } else if (bachillerato == 'Bachillerato general') {
        $("#nombre_escuela").css("display", "block");
        $("#nombre_escuela2").css("display", "none");
        $("#box_escuela_1").css("display", "none");
        $("#box_escuela_2").css("display", "none");
        $("#box_formacion_tecnica").css("display", "none");
        $("#localidad").prop('disabled', false);
        $("#nombre_Escuela").prop('disabled', false);
    } else if (bachillerato == 'Bachillerato en línea') {
        $("#nombre_escuela").css("display", "none");
        $("#nombre_escuela2").css("display", "none");
        $("#box_escuela_1").css("display", "none");
        $("#box_escuela_2").css("display", "block");
        $("#box_formacion_tecnica").css("display", "none");
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
                $('#formacion_tecnica').append($('<option value="' + String(i) + '">'+AX[i]+'</option>'));
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
            $("#localidad").prop('value', ubicacion);
            $("#label_localidad").prop('class',"active");
        }
    });
}

function mismoSelect(esc){
    if(esc!="Otra"){
        $("#nombre_escuela2").css("display", "none");
        $("#localidad").prop('disabled', true);
        $("#nombre_Escuela2").val('');
        $("#label_nombre_escuela2").prop('class', '');
        cambiarUbicacion(esc);
    }
    else{
        $("#label_localidad").prop('class', '');
        $("#localidad").prop('disabled', false);
        $("#nombre_escuela2").css("display", "block");
    }
}

function resetCarreras(){
    var num_carreras = document.getElementById("formacion_tecnica");
    if(num_carreras.length > 1){
        num_carreras.length = 1;
    }
}


