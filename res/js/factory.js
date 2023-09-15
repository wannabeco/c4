project.factory("constantes", function()
{
    var interfaz = {
        tamanoImagenAnuncio:1024,
        lblImgAnuncio:"1 Mb",
        tamanoArchivosExcel:10240,
        lblArchivoExcel:"10 Mb",
        tiposArchivoExcel:['xls',"xlsx"],
        tiposArchivoAnuncio:["jpg","png","gif"],
        urlBase:"",
        validaMail:function(mail)
		{
			var salida  = false;
			var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    // Se utiliza la funcion test() nativa de JavaScript
		    if (regex.test(mail.trim())) 
		    {
		        salida  = true;
		    }
		    else 
		    {
		        salida  = false;
		    }
		    return salida;
		},
		consultaApi:function(url,parametros,callback,tipo)
		{
			var tipoSalida = (tipo == undefined)?"json":tipo;
			//la variable callback es una funcion que esta creada, esto es para que el ajax responda a esta función y ud haga lo que quiera dentro de ella y no tener que hacer nada dentro del succes del ajax y que esta función quede como standar
			 $.ajax({
		        url: url,
		        data: parametros,
		        type: "POST",
		        dataType: tipoSalida,
		        success:function(data)
		        {
		        	callback(data);
		        },
		        error:function(e) {
		            
		        }
		    });
		},
		alerta:function(titulo,mensaje,tipo,callback){
			swal({   
					title: titulo,   
					text: mensaje, 
					type: tipo,  
					html: true,
				  	confirmButtonColor: "#4e73df",
  					animation: "slide-from-top",
					confirmButtonText: "Aceptar",
				},
				function(isConfirm)
				{
					if(isConfirm)
					{
						callback()
					}
				}
			);
		},
		confirmacion:function(titulo,mensaje,tipo,callback,close){
			swal({
				  title: titulo,
				  text: mensaje,
				  type: tipo,
				  showCancelButton: true,
				  confirmButtonColor: "#009688",
				  confirmButtonText: "Continuar",
				  closeOnConfirm: (close == undefined)?false:true,
  				  showLoaderOnConfirm: true,
  				  animation: "slide-from-top",
				  confirmButtonText: "Continuar",
				},
				function(isConfirm){
					if(isConfirm)
					{
						callback()
					}
				}
			);
		},
	   
    }
    return interfaz;
})