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
        bubbleGapLeft: -5
    });

    $("#bachillerato").change(function () {
        cambiarSelect();
        $("#nombre_Escuela").val('');
    });

    $("#escuelas").change(function () {
        cambiarCarreras();
    });

    function cambiarSelect() {
        var bachillerato = $("#bachillerato option:selected").text();

        if (bachillerato == 'Bachillerato técnico') {
            $("#box_escuela_1").css("display", "block");
            $("#box_escuela_2").css("display", "none");
            $("#nombre_escuela").css("display", "none");
            $("#nombre_escuela2").css("display", "none");
        } else if (bachillerato == 'Bachillerato general') {
            $("#nombre_escuela").css("display", "block");
            $("#nombre_escuela2").css("display", "none");
            $("#box_escuela_1").css("display", "none");
            $("#box_escuela_2").css("display", "none");
        } else if (bachillerato == 'Bachillerato en línea') {
            $("#nombre_escuela").css("display", "none");
            $("#nombre_escuela2").css("display", "none");
            $("#box_escuela_1").css("display", "none");
            $("#box_escuela_2").css("display", "block");
        }
    }

    function cambiarCarreras() {
        var escuela = $("#escuelas").val(); //esta variable debe de ir al servidor
        $.ajax({
            url: "../php/formulario/carreras.php",
            method: "POST",
            cache: false,
            data:{escuela:escuela},
            success: function (carreras) {
                let AX = JSON.parse(carreras);
                alert(AX.length);
                // for (i = 0; i < Ax; i++) {
                //     $('#seg').append($('<option value="' + String(i) + '">' + 'hola</option>'));
                //     $('#seg').formSelect();
                // }
                // AX.forEach(logArrayElements);
                // function logArrayElements(element, index, array) {
                //     $('#formacion_tecnica').append($('<option value="' + String(index) + '">'+String(element)+'</option>'));
                //     $('#formacion_tecnica').formSelect();
                // }
            }
        });
    }



    /*$("#bachillerato").change(function(){
        var bachillerato = $("#bachillerato option:selected").text();

        if (bachillerato == 'Bachillerato técnico'){
           
            $("#localidad").prop('disabled', false);

            $.ajax({
                url:"../php/formulario.php",
                success:function(escuelas){
                    alert(escuelas);
                    $("#escuela").html(escuelas);
                }
              });
        }
        else if (bachillerato == 'Bachillerato general'){
            $("#nombre_Escuela").val("");
            $("#box_escuela").css("display","none");
            $("#nombre_escuela").css("display","block");
            $("#localidad").prop('disabled', false);
        }
        else{
            $("#box_escuela").css("display","block");
            $("#nombre_escuela").css("display","none");
            $("#localidad").prop('disabled', false);
        }
    });

    $("#escuela").change(function(){
        var escuela = $("#escuela option:selected").text();

        if (escuela == 'Otra'){
            $("#nombre_escuela2").css("display","block");
            $("#localidad").prop('disabled', false);
        }
        else{
            $("#localidad").val('');
            $("#nombre_escuela2").css("display","none");
            $("#localidad").prop('disabled', true);
        }
      });*/

});