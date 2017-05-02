
$(document).ready(function ()
{
    ControllerProducto.init();
});

ControllerProducto = {
    init: function ()
    {
        var self = this;
        self.$frm = $('[name="frmProducto"]');
        $('[name="btnGuardar"]', self.$frm).click(function ()
        {
            if (self.validar())
            {
                var data = self.data();
                console.log(data);
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    url: "../../procesos/producto.php",
                    data: data,
                    //use contentType, processData for sure.
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        //Company_Controller.beforeProcessBar();
                        //console.log('Hold on...');
                    },
                    xhr: function () {
                        var myXhr = $.ajaxSettings.xhr();
                        //console.log(myXhr);
                        //if (myXhr.upload) {
                        //myXhr.upload.addEventListener('progress', Company_Controller.uploadProgressBar, false);
                        //}
                        return myXhr;
                    },
                    success: function (data, textStatus, jqXHR) {
                        //fResponse(data);
                        if (data.isSuccess)
                        {
                            setTimeout(function () {
                                $(location).attr('href', "administrar_productos.php");
                            }, 1500);
                            
                        }
                        alert(data.message);
                    },
                    error: function () {
                        //console.log('error');
                        alert('Ocurrio un error en el envio');
                    }
                });
            }

        });
        $('[name="btnCancelar"]', self.$frm).click(function ()
        {
            var msg = confirm("¿Realmente desea cancelar? ");
            if (msg)
                window.location.assign("administrar_productos.php");
        });
    },
    validar: function ()
    {
        var self = this;

        var cboCategoria = $('[name="cboCategoria"]', self.$frm).val();
        if (cboCategoria == 0)
        {
            alert('Error: Seleccione la categoria del producto');
            $('[name="cboCategoria"]', self.$frm).focus();
            return false;
        }

        var txtNombre = $('[name="txtNombre"]', self.$frm).val();
        if (txtNombre.length == 0)
        {
            alert('Error: Ingrese el nombre del producto');
            $('[name="txtNombre"]', self.$frm).focus();
            return false;
        }

        var txtDescripcion = $('[name="txtDescripcion"]', self.$frm).val();
        if (txtDescripcion.length == 0)
        {
            alert('Error: Ingrese la descripción del producto');
            $('[name="txtDescripcion"]', self.$frm).focus();
            return false;
        }

        var txtPresentacion = $('[name="txtPresentacion"]', self.$frm).val();
        if (txtPresentacion.length == 0)
        {
            alert('Error: Ingrese la presentación del producto');
            $('[name="txtPresentacion"]', self.$frm).focus();
            return false;
        }

        return true;
    },
    data: function ()
    {
        var self = this;
        var formData = new FormData(self.$frm[0]);
        return formData;
    }
};