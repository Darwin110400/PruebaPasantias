var tabla;

//Funcion que se ejecute al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e)
    {
        guardaryeditar(e);
    });
    
    $.post("../../ajax/capacitacioncolaborador.php?op=selectColaborador", function (r) {
        $("#id_cap_col").html(r);
        $("#id_cap_col").selectpicker('refresh');
    })
    $.post("../../ajax/capacitacioncolaborador.php?op=selectCapacitacion", function (r) {
        $("#id_cap_cap").html(r);
        $("#id_cap_Cap").selectpicker('refresh');
    })
}

//funcion limpiar

function  limpiar() {
    $("#id_cap_cap").val(" ");
    $("#id_cap_col").val(" ");

}

// funcion mostrar formulario

function mostrarform(flag)

{
    limpiar();
    if (flag) {

        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").show();

    } else {

        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }

}

function cancelarform() {

    limpiar();
    mostrarform(false);
}

// funcion listar

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
function guardaryeditar(e)
{
    e.preventDefault(); //No se activarÃ¡ la acciÃ³n predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
            url: "../../ajax/capacitacioncolaborador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

       success: function (datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    
    limpiar();
    
}

function mostrar(id_capcol) {
    $.post("../../ajax/capacitacioncolaborador.php?op=mostrar", {id_capcol: id_capcol}, function (data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);
        $("#id_capcol").val(data.id_ven);
        $("#id_cap_cap").val(data.id_cap_cap);
        $("#id_cap_cap").selectpicker('refresh');
        $("#id_cap_col").val(data.id_cap_col);
        $("#id_cap_col").selectpicker('refresh');
    });
}
//funcion para desactivar articulo
function desactivar(id_capcol) {
    bootbox.confirm("¿Esta seguro de querer desactivar la capacitacion del colaborador?", function (result) {
        if (result) {
            $.post("../../ajax/capacitacioncolaborador.php?op=desactivar", {id_capcol: id_capcol}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}
//funcion para activar articulo
function activar(id_capcol) {
    bootbox.confirm("¿Esta seguro de querer activar la capacitacion del colaborador?", function (result) {
        if (result) {
            $.post("../../ajax/capacitacioncolaborador.php?op=activar", {id_capcol: id_capcol}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });

        }
    });
}
function eliminar(id_capcol){
    bootbox.confirm("¿Está seguro que desea eliminar de manera definitiva esta Capacitacion del colaborador?", function(result){
     
        if(result){
            $.post("../../ajax/capacitacioncolaborador.php?op=eliminar", {id_capcol:id_capcol},function(e){
             bootbox.alert(e);
             tabla.ajax.reload();
            });
        }
    });
}

init();

