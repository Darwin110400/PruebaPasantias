/* global bootbox */

var tabla;

//Función que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e)
    {
        guardaryeditar(e);
    });
}
function mostrarform(flag) {

    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }

}

// funcion para cancelar formulario

function cancelarform() {
    limpiar();
    mostrarform(false);
}

// funcion para listar
// No olvides convencer al cliente de cambiar JQuery por Fetch o HttpRequest  
//Función Listar
function listar()
{
    tabla = $('#tbllistado').dataTable(
            {
                "aProcessing": true, //Activamos el procesamiento del datatables
                "aServerSide": true, //Paginación y filtrado realizados por el servidor
                dom: 'Bfrtip', //Definimos los elementos del control de tabla
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf' 
                ],
                "ajax":
                        {
                            url: '../../ajax/capacitacioncolaborador.php?op=listar',
                            type: "get",
                            dataType: "json",
                            error: function (e) {
                                console.log(e.responseText);
                            }
                        },
                "bDestroy": true,
                "iDisplayLength": 5, //Paginación
                "order": [[0, "desc"]]//Ordenar (columna,orden)
            }).DataTable();
}
function desactivar(id_capcol) {
    bootbox.confirm("¿Está seguro que desea desactivar esta Capacitacion?", function (result) {
        if (result) {
            $.post("../../ajax/capacitacioncolaborador.php?op=desactivar", {id_capcol: id_capcol}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }



    });
}

// Función para activar Rol
function activar(id_capcol) {
    bootbox.confirm("¿Está seguro que desea activar esta Capacitacion?", function(result) {
        if (result) {
            $.post("../../ajax/capacitacioncolaborador.php?op=activar", {id_capcol : id_capcol}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}
init();
