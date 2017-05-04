/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 01-may-2017
 * @time 7:20:10
 * Objetivo: Javascript utilizado para administrar, agregar, eliminar productos
 */
$(document).ready(function ()
{
    $("#btnAgregar").click(function ()
    {
        window.location.assign("agregar_producto.php");
    });
	
	$('.action-eliminar').click(function ()
        {
			var id_producto = $(this).attr('id'); //se obtiene el valor del id para enviarlo por ajax
            var msg = confirm("¿Realmente desea eliminar? ");
            if (msg)
                //ajax utilizamos, para hacer la petición de eliminar
			$.ajax({
				url: "../../procesos/producto.php",
				method: "post",
				dataType: "json",
				data: {id_producto:id_producto, accion:'eliminar'},
				success: function(data, textStatus, jqXHR)
				{
					//validar respuesta
					if (data.isSuccess)
					{
						setTimeout(function () {
							$(location).attr('href', "administrar_productos.php");
						}, 1500);
						
					}
					alert(data.message);
				}
			});
        });

});

