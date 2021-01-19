$(document).ready(function () {
    $(".button-collapse").sideNav();
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

    intializeTableSearch();

    intializeValidetta();

    // se coloca la fecha de hoy en el modal
    var today = new Date();
    var fecha = today.getFullYear() + "-" + pad(today.getMonth() + 1, 2) + "-" + pad(today.getDate());
    $("#txtFecha").val(fecha);
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
    validateNew();
}

function validateNew() {
    $("#nuevo").validetta({
        validators: {
            regExp: {
                clave : {
                    pattern: /^\d{4}-\d{2}$/,
                    errorMessage: "Clave no valida (formato: ####-##)"
                },
                fecha : {
                    pattern: /^(2[0-1][2-9]\d)-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01])$/,
                    errorMessage: "Fecha no valida"
                },
                horario : {
                    pattern: /^(\d{1}|1{1}\d{1}|2{1}[0-3]{1}):[0-5]{1}\d{1}$/,
                    errorMessage: "Horario no valido (formato de 24 hrs)"
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
            submitNew();
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

function submitNew() {
    alert("Guardar nuevo");
}