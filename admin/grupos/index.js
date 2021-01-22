$(document).ready(function () {
    $(".button-collapse").sideNav();
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

    intializeTableSearch();

    intializeValidetta();

    intializeNewDay();
    intializeValidationNewHour();
    intializeValidationNewEdificio();
})

function intializeTableSearch() {
    // Searching in table
    $('#txtBuscar').keyup(function(){
        search_table($(this).val());
    });
    function search_table(value){
    $('#tblGrupos tbody tr').each(function(){
        var found = 'false';
        $(this).each(function(){
            if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                found = 'true';
        });
        if(found == 'true')
            $(this).show();
        else
            $(this).hide();
    });
    // This function makes a responsive bug

    $('#trSts').show();
    }
}

function intializeValidetta() {
    validateEdit();
}

function validateEdit() {
    $("#editar").validetta({
        validators: {
            regExp: {
                fechahorario : {
                    pattern: /^(2[0-1][2-9]\d)-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01]) {1}(0{1}\d{1}|1{1}\d{1}|2{1}[0-3]{1}):[0-5]{1}\d{1}:[0-5]{1}\d{1}$$/,
                    errorMessage: "Horario no valido"
                },
                cupo : {
                    pattern: /^([1-9]{1}|[1-9]{1}\d{1})$/,
                    errorMessage: "Rango valido [1,99]"
                }
            }
        },
        realTime : true,
        bubblePosition: 'bottom',
        onValid : function (e) {
            e.preventDefault();
            submitEdit();
        },
        onError : function (e) {
            // e.preventDefault();
            alert("No todos los campos son validos");
        }
    });
}

// Bug fixer
$(window).on('resize', function(){
    $("#tblGrupos").load("index.php #tblGrupos");
});

function editar(a) {
    var tableAux = a.parentNode.parentNode.parentNode.parentNode;
    var rowNumber = a.parentNode.parentNode.rowIndex;

    var clave = a.innerHTML;
    var horario = tableAux.rows[rowNumber].cells[1].innerHTML;
    var cupo = tableAux.rows[rowNumber].cells[2].innerHTML;

    $("#clave").val(clave);
    $("#horario").val(horario);
    $("#cupo").val(cupo);

    $("#showEditGroup").click();
}

/**
 * Función que pone leading zeros en un int
 * @param {int} num Un número dado
 * @param {int} size El tamaño del string a retornar
 */
function pad(num, size) {
    num = num.toString();
    while (num.length < size) num = "0" + num;
    return num;
}

function submitEdit() {
    $.ajax({
        url: "update.php",
        method: "POST",
        data: {clave: $("#clave").val(), horario: $("#horario").val(), cupo: $("#cupo").val()},
        cache: false,
        success: function (respax) {
            alert(respax);
            if (respax == "Grupo guardado correctamente") {
                window.location.reload();
            }
        }
    });
}

/**
 * Función que inicializa los controles para añadir un nuevo día
 */
function intializeNewDay() {
    validateNewDay();
    var today = new Date();
    var todayStr = today.getFullYear() + "-" + pad(today.getMonth() + 1, 2) + "-" + pad(today.getDate(), 2);
    $("#txtDate").val(todayStr);
}

function intializeValidationNewHour() {
    $("#newHorario").validetta({
        validators: {
            regExp: {
                hora: {
                    pattern: /^(0{1}\d{1}|1{1}\d{1}|2{1}[0-3]{1}):[0-5]{1}\d{1}$/,
                    errorMessage: "Horario no valido (formato 24 hrs)"
                }
            }
        },
        realTime : true,
        bubblePosition: 'bottom',
        onValid : function (e) {
            e.preventDefault();
            submitNewHour();
        },
        onError : function (e) {
            // e.preventDefault();
            alert("No todos los campos son validos");
        }
    });
}

function intializeValidationNewEdificio() {
    $("#newEdificio").validetta({
        validators: {
            regExp: {
                clave: {
                    pattern: /^\d{1,4}$/,
                    errorMessage: "Rango aceptado [0, 9999]"
                }
            }
        },
        realTime : true,
        bubblePosition: 'bottom',
        onValid : function (e) {
            e.preventDefault();
            submitNewEdificio();
        },
        onError : function (e) {
            // e.preventDefault();
            alert("No todos los campos son validos");
        }
    });
}

/**
 * Función que inicializa las validaciones del form newDay
 */
function validateNewDay() {
    $("#newDay").validetta({
        validators: {
            regExp: {
                date: {
                    pattern: /^(2[0-1][2-9]\d)-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01])$/,
                    errorMessage: "Fecha no valida"
                }
            }
        },
        realTime : true,
        bubblePosition: 'bottom',
        onValid : function (e) {
            e.preventDefault();
            submitNewDay();
        },
        onError : function (e) {
            // e.preventDefault();
            alert("No todos los campos son validos");
        }
    });
}

/**
 * Ingresa un nuevo dia a la base de datos
 */
function submitNewDay() {
    $.ajax({
        url: "./insertDia.php",
        method: "POST",
        cache: false,
        data: {fecha: $("#txtDate").val()},
        success: function (respax) {
            if (respax == "true") {
                window.location.reload();
            }
            else {
                alert(respax);
            }
        }
    });
}

function submitNewHour() {
    $.ajax({
        url: "./insertHora.php",
        method: "POST",
        cache: false,
        data: {hora: $("#txtHora").val()},
        success: function (respax) {
            console.log(respax);
            if (respax == "true") {
                window.location.reload();
            }
            else {
                alert(respax);
            }
        }
    });
}

function submitNewEdificio() {
    $.ajax({
        url: "./insertEdificio.php",
        method: "POST",
        cache: false,
        data: {edificio: pad(parseInt($("#txtEdificio").val()), 4)},
        success: function (respax) {
            console.log(respax);
            if (respax == "true") {
                window.location.reload();
            }
            else {
                alert(respax);
            }
        }
    });
}

/**
 * Elimina el día que el ususario clickea
 */
function eliminarDia(a) {
    var tableAux = a.parentNode.parentNode.parentNode.parentNode;
    var rowNumber = a.parentNode.parentNode.rowIndex;

    var fecha = tableAux.rows[rowNumber].cells[0].innerHTML;
    $.ajax({
        url: "deleteDia.php",
        cache: false,
        method: "POST",
        data: {fecha: fecha},
        success: function (respax) {
            if (respax == "true") {
                window.location.reload();
            }
            else {
                alert(respax);
            }
        }
    });
}

$("#eliminarGrupo").click(function (e) {
    e.preventDefault();
    // confirma con JQuery Confirm
    $.confirm({
        backgroundDismiss: true,
        title: '¡Atención!',
        content: '¿Está seguro de querer borrar el grupo ' + $("#clave").val() + '?',
        buttons: {
            Confirmar: {
                text: 'Eliminar',
                btnClass: 'btn-red',
                action: eliminarGrupo
            },
            Cancelar: {
                btnClass: 'white blue-text'
            }
        }
    });
});

/**
 * Elimina al grupo previa confirmación
 */
function eliminarGrupo() {
    $.ajax({
        url: "delete.php",
        method: "POST",
        cache: false,
        data: {clave: $("#clave").val()},
        success: function (respax) {
            if (respax == "true")
                window.location.reload();
            else
                alert(respax);
        }
    });
}

function eliminarHorario(a) {
    var tableAux = a.parentNode.parentNode.parentNode.parentNode;
    var rowNumber = a.parentNode.parentNode.rowIndex;

    var hora = tableAux.rows[rowNumber].cells[0].innerHTML;
    $.ajax({
        url: "deleteHora.php",
        cache: false,
        method: "POST",
        data: {hora: hora},
        success: function (respax) {
            if (respax == "true") {
                window.location.reload();
            }
            else {
                alert(respax);
            }
        }
    });
}

function eliminarEdifico(a) {
    var tableAux = a.parentNode.parentNode.parentNode.parentNode;
    var rowNumber = a.parentNode.parentNode.rowIndex;

    var edificio = tableAux.rows[rowNumber].cells[0].innerHTML;
    $.ajax({
        url: "deleteEdificio.php",
        cache: false,
        method: "POST",
        data: {edificio: edificio},
        success: function (respax) {
            if (respax == "true") {
                window.location.reload();
            }
            else {
                alert(respax);
            }
        }
    });
}