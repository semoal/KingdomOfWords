/* Función para abrir el desplegable de fecha en la ventana de registro */
$(function() {
    $('#datetimepicker1').datetimepicker({
        defaultDate: 17041998,
        showClose: true,
        format: 'DD/MM/YYYY',
        locale: 'es',
        toolbarPlacement: 'top'
    });
});