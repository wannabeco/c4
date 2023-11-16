/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('buscar', function($scope,$http,$q,constantes)
{	
    $scope.initbuscar = function() {
		$scope.config = configLogin; // configuración global
		$scope.busquedaMatrices();
		$scope.busquedaRelEmpresaPalan();
		$(function(){
			$('[data-toggle="tooltip"]').tooltip();
		});
	};
	$scope.infoMatrices		= "";
	$scope.inforMiMatriz	= "";
	$scope.Checks  			= "";
	$continuar  = "";

	//plantilla informacion de matriz
	$scope.cargaPlantillaInfo = function(idNuevaMatriz,edita){	
		$('#modalParametros').modal("show");
		var controlador = 	$scope.config.apiUrl+"MisMatrices/miMatriz";
		var parametros  = 	"edita="+edita+"&idNuevaMatriz="+idNuevaMatriz;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formAgregaParametros");
		},'');
	}
	//cantidad de matrices que puede agregar la empresa
	$scope.busquedaRelEmpresaPalan = function() {
		var controlador = $scope.config.apiUrl+"Buscar/busquedaRelEmpresaPalan";
		var parametros = "";
		$.ajax({
			url: controlador,
			type: "GET",
			data: parametros,
			dataType: "json",
			success: function(response) {
				$scope.canMatrices = response.datos;
				$scope.Checks = response.datos[0].canChecks;
				$scope.$apply();
			}
		});
	};
	//busqueda de todas las matrices
	$scope.busquedaMatrices = function() {
		var controlador = $scope.config.apiUrl+"Buscar/matricesCreadas";
		var parametros = "";
		$.ajax({
			url: controlador,
			type: "GET",
			data: parametros,
			dataType: "json",
			success: function(response) {
				$scope.infoMatrices = response.infoMatrices;
				$scope.inforMiMatriz = response.inforMiMatriz;
				if($scope.inforMiMatriz.continuar == 0){
					$(".agregaGratisDos").css("display", "block");
					$(".PagaraButton").css("display", "none");
				}else{
					$(".agregaGratisDos").css("display", "none");
					$(".PagaraButton").css("display", "block");
				}
				$scope.$apply();
			}
		});
	};
	//buscador
	$scope.searchText = "";
	$scope.search = function() {
		var controlador = $scope.config.apiUrl+"Buscar/matricesCreadas";
		var parametros = "buscar="+$scope.searchText;
		$.ajax({
			url: controlador,
			type: "POST",
			data: parametros,
			dataType: "json",
			success: function(response) {
			$scope.infoMatrices = response.infoMatrices;
			$scope.inforMiMatriz = response.inforMiMatriz;
			$scope.$apply();
			}
		});
	};
	//paginador
	$scope.currentPage = 1;
	$scope.pageSize = 6;

	$scope.setCurrentPage = function(page) {
		$scope.currentPage = page;
	};

	$scope.getPagesArray = function() {
		var totalPages = Math.ceil($scope.infoMatrices.length / $scope.pageSize);
		var pagesArray = [];
		for (var i = 1; i <= totalPages; i++) {
			pagesArray.push(i);
		}
		return pagesArray;
	};
	$scope.setCurrentPage = function(page) {
		if (page < 1) {
		  return;
		}
		$scope.currentPage = page;
		$scope.buscarMatrices();
	};


	//agrega a la lista en bage	pago
	var tipos = [];
	var total = 0;
	var idss = [];
	
	$scope.agrega = function(nombreMatriz, idMatriz, precio) {
		var idEmpresa = $("#idEmpresa").val();
		var nuevaMatriz = {
			id: idMatriz,
			nombre: nombreMatriz,
			precio: precio
		};
		var indice = tipos.findIndex(function(elemento) {
			return elemento.id === nuevaMatriz.id;
		});
		if (indice === -1) {
			tipos.push(nuevaMatriz);
			total += parseInt(nuevaMatriz.precio);
			idss.push(idMatriz);
		}
		$(".tipos").html(
			tipos.map(function(elemento) {
				var palabra = elemento.nombre.trim();
				return (
					'<div class="float-left col-md-8"><span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
					palabra +
					' <a href="#" class="eliminar text-danger" data-palabra="' + palabra + '"> X </a></span></div>'
				);
			}).join('') +
			(total !== 0 ? '<div class="float-left col-md-2"> Total: <strong>' + total + '</strong></div>'+
			'<input type="text" id="idEmpresa" name="idEmpresa" value='+idEmpresa+' hidden>'+'<div class="float-left col-md-2" style="padding-right: 0px;top:-10px;"><button class="btn btn-primary float-righ" id="Pagar" type="button">Pagar</button></div>': '')
		);
		return false;
	};
	$(document).on('click', '.eliminar', function() {
		var palabraEliminar = $(this).data('palabra');
		var indice = tipos.findIndex(function(elemento) {
			return elemento.nombre.trim() === palabraEliminar;
		});
		if (indice !== -1) {
			var matrizEliminada = tipos[indice];
			tipos.splice(indice, 1);
			total -= matrizEliminada.precio;
			var idEliminar = idss[indice];
        	idss.splice(indice, 1);
	
			$(".tipos").html(
				tipos.map(function(elemento) {
					var palabra = elemento.nombre.trim();
					return (
						'<div class="float-left col-md-8"><span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
					palabra +
					' <a href="#" class="eliminar text-danger" data-palabra="' + palabra + '"> X </a></span></div>'
					);
				}).join('')+
				(total !== 0 ? '<div class="float-left col-md-2"> Total: <strong>' + total + '</strong></div>'+
				'<input type="text" id="idEmpresa" name="idEmpresa" value='+idEmpresa+' hidden>'+'<div class="float-left col-md-2" style="padding-right: 0px;top:-10px;"><button class="btn btn-primary float-righ" id="Pagar" type="button">Pagar</button></div>': '')
			);
		}
	});

	//agrego matrices que incluye el plan
	var tiposGratis = [];
	// var maxTiposGratis = 3;
	var ids = [];
	$scope.agregaGratis = function(nombreMatriz, idMatriz) {
		// if(tiposGratis.length >= maxTiposGratis){
		// 	constantes.alerta("Atención","Para tu plan, solo podras agregar 3 matrices gratis, por favor verifique y elimine la que no necesite.",'info',function(){});
		// 	return false;
		// }
	  var nuevaMatriz = {
		id: idMatriz,
		nombre: nombreMatriz
	  };
	  var indice = tiposGratis.findIndex(function(elemento) {
		return elemento.id === nuevaMatriz.id;
	  });
	  if (indice === -1) {
		tiposGratis.push(nuevaMatriz);
		ids.push(idMatriz);
	  }
	  $(".tipos").html(
		tiposGratis.map(function(elemento) {
		  var palabra = elemento.nombre.trim();
		  return (
			'<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
			palabra +
			' <a href="#" class="eliminar text-danger" data-palabra="' + palabra + '"> X </a></span>'
		  );
		}).join('')+
		(tiposGratis != 0 ?'<input type="text" id="idEmpresa" name="idEmpresa" value='+idEmpresa+' hidden>'+'<button class="btn btn-primary" id="btnAgregar" style="margin-left: 20px;" type="button">Agregar</button>': '')
	  );
	  return false;
	};
	$(document).on('click', '.eliminar', function() {
	  var palabraEliminar = $(this).data('palabra');
	  var indice = tiposGratis.findIndex(function(elemento) {
		return elemento.nombre.trim() === palabraEliminar;
	  });
	  if (indice !== -1) {
		tiposGratis.splice(indice, 1);
		var idEliminar = ids[indice];
        ids.splice(indice, 1);
	
		$(".tipos").html(
			tiposGratis.map(function(elemento) {
			var palabra = elemento.nombre.trim();
			return (
			  '<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
			  palabra +
			  ' <a href="#" class="eliminar text-danger" data-palabra="' + palabra + '"> X </a></span>'
			);
		  }).join('')+
		  (tiposGratis != 0 ?'<input type="text" id="idEmpresa" name="idEmpresa" value='+idEmpresa+' hidden>'+'<button class="btn btn-primary" id="btnAgregar" style="margin-left: 20px;" type="button">Agregar</button>': '')
		);
	  }
	});
	$(document).on('click', '#btnAgregar', function() {
		var idEmpresa = $("#idEmpresa").val();
		if(tiposGratis.length == 0){
			constantes.alerta("Atención","Por favor verifique que las matrices esten completas, recuerde que con su plan, puede agregar 3.",'info',function(){});
		}
		else{
			constantes.confirmacion("Confirmación","Esta apunto de agregar los chacks, ¿desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"MisMatrices/creaGratis";
				var parametros  = 	"id="+ids;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							// window.clearInterval(interval);
							window.location.assign($scope.config.apiUrl+"MisMatrices/matrices/43/"+idEmpresa+"/0");
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}
	});
	$(document).on('click', '#Pagar', function() {
		var idEmpresa = $("#idEmpresa").val();
		if(tipos.length < 1){
			constantes.alerta("Atención","Por favor verifique no hay chacks por comprar.",'info',function(){});
		}
		else{
			var proveedor = "payu";
			constantes.confirmacion("Atención","Esta apunto de realizar el pago, ¿Desea continuar?. Recuerde activar las ventanas emergentes antes de continuar.",'info',function(){
				//se abre ventana pop
				var codigo = $("#codigoPago").val();
				//verifico que la empresa no cuente con ninguna de las matrices para poder continuar.
					var controlador = $scope.config.apiUrl+"MisMatrices/getMatricesEmpresa";
					var parametros  = "id="+idss;
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1 ){
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
						else{
							var controlador = $scope.config.apiUrl+"PagoMatriz/insetCodigo";
							var parametros  = "proveedor="+proveedor;
							constantes.consultaApi(controlador,parametros,function(json){
								if(json.continuar == 1){
									var idPago = json.datos;	
									var controlador = $scope.config.apiUrl+"PagoMatriz/insetCmatrizTemporal";
									var parametros  = "proveedor="+proveedor+"&idPago="+json.datos+"&tipo="+JSON.stringify(tipos);
									constantes.consultaApi(controlador,parametros,function(json){
										var ventana ="";
										var pago ="matrices";								
										var parametro = "idPago="+ idPago+"&pago="+pago;
										var ruta = $scope.config.apiUrl+"Pagos/procesoPagoOnline/?"+parametro;
										var ventana = window.open(ruta, "pago_payu" , "width=600,height=880,left = 420");
										var tiempo= 0;
										var interval = setInterval(function(){
											if(ventana.closed !== false) {
												// window.clearInterval(interval);
												window.location.assign($scope.config.apiUrl+"MisMatrices/matrices/43/"+idEmpresa+"/0"); 
											} else {
												tiempo +=1;
											}
										},1000);
									});
								}
								else
								{
								constantes.alerta("Atención",json.mensaje,"error",function(){})
								}
							});
						}
					});
			});
		}
	});

	//seguerir matriz
	$scope.crearnueva =function(){
		$('#sugerirMatriz').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/sugerirMatriz";
	 	var parametros  = "";
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalCreaNueva").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#formsugerir");
	 	},'');
	}
	//solicitar check
	$scope.solicitar =function(){
		$('#solicitarcheck').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/solicitarMatriz";
	 	var parametros  = "";
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalCreaNuevaSolicitud").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#formsugerir");
	 	},'');
	}
	
	$scope.sugerirMatriz = function(){
		var descripcion = $("#descripcion").val();
		var nombre 		= $("#nombre").val();
		var email 		= $("#email").val();
		var matriz 		= "";
		var idEmpresa 		= $("#idEmpresa").val();
		var solicitud	= 0;
		if(descripcion == ""){
			constantes.alerta("Atención","Es necesario escribir una descipcion para sugerir un check.",'info',function(){});
		}else{
			constantes.confirmacion("Atención","Esta apunto de sugerir un check, ¿Desea continuar?.",'info',function(){
				var controlador = 	$scope.config.apiUrl+"Buscar/sugiereMatriz";
				var parametros  = "nombre="+nombre+"&email="+email+"&descripcion="+descripcion+"&matriz="+matriz+"&solicitud="+solicitud;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});	
		} 
	}
	$scope.solicitaMatriz = function(){
		var descripcion = $("#descripcion").val();
		var nombre 		= $("#nombre").val();
		var email 		= $("#email").val();
		var matriz 		= "";
		var idEmpresa 	= $("#idEmpresa").val();
		var solicitud	= 1;
		if(descripcion == ""){
			constantes.alerta("Atención","Es necesario escribir una descipcion para sugerir un check.",'info',function(){});
		}else{
			constantes.confirmacion("Atención","Esta apunto de sugerir un check, ¿Desea continuar?.",'info',function(){
				var controlador = 	$scope.config.apiUrl+"Buscar/sugiereMatriz";
				var parametros  = "nombre="+nombre+"&email="+email+"&descripcion="+descripcion+"&matriz="+matriz+"&solicitud="+solicitud;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});	
		} 
	}
	

	// sugerimos check
	$scope.sugerimosCheck =function(){
		$('#segerimosCheck').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/sugerimosCheck";
	 	var parametros  = "";
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalsegerimosCheck").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#formsugerir");
	 	},'');
		$scope.busquedaMatrices();
	}
	// codigo inicio tabla de los item internos
	$(document).on('click', '.infoInterno', function() {
		var idMatriz = $(this).data('idnuevamatriz');
		var controlador = $scope.config.apiUrl + "Buscar/infoInterno";
		var parametros = "idNuevaMatriz=" + idMatriz;
		constantes.consultaApi(controlador, parametros, function(json) {
			if (json.continuar == 1) {
				$('#listaInfo'+idMatriz).empty();
				const datos = json.datos["resultado"];//varible donde tengo el arreglo
				const catidad = json.datos["resultadoDos"];
				const TotalIntero = catidad.length - 3;
				console.log(json.datos);
				var container = document.createElement('div');
				container.classList.add('table-container');
				
				var alertDiv = document.createElement('div');
				alertDiv.classList.add('alert', 'alert-info');
				alertDiv.setAttribute('role', 'alert');
				var infoIcon = document.createElement('i');
				infoIcon.classList.add('fas', 'fa-info-circle');
				alertDiv.appendChild(infoIcon);
				alertDiv.innerHTML += ' Si adquieres este check, tendrás acceso a estas obligaciones  y <strong>' + TotalIntero + '</strong> obligaciones  más.';

				// boton para ocultar tabla
				var botonOcultarTabla = document.createElement('button');
				botonOcultarTabla.textContent = "X";
				botonOcultarTabla.setAttribute("id", "ocultarTabla" + idMatriz); // Asignar un id para cada tabla
				botonOcultarTabla.setAttribute("type", "button");
				botonOcultarTabla.classList.add("btn", "btn-primary", "float-right");

				//ocultar la tabla
				botonOcultarTabla.addEventListener('click', function() {
					var idMatriz = this.id.replace('ocultarTabla', ''); // Obtener el idMatriz
					document.querySelector('#listas' + idMatriz).style.display = 'none'; // Ocultar la fila
					document.querySelector('#listaInfo' + idMatriz).style.display = 'none'; // Ocultar la información
					this.remove(); // Eliminar el botón actual al hacer click
				});
				var botonesAnteriores = document.querySelectorAll('[id^="ocultarTabla"]');
				botonesAnteriores.forEach(function(boton) {
					boton.remove();
				});
				document.querySelector('#listaInfo' + idMatriz).appendChild(alertDiv);
				document.querySelector('#listas' + idMatriz).appendChild(botonOcultarTabla);

				// se creala tabla y sus elementos
				var table = document.createElement('table');
				table.classList.add('table', 'table-striped');

				// se crea el encabezado de la tabla
				var thead = document.createElement('thead');
				var headerRow = document.createElement('tr');
				['Obligación', 'Entidad', 'Norma Aplicable', 'Periodicidad', 'Frecuencia Check', 'Responsable'].forEach(function(headerText) {
					var th = document.createElement('th');
					th.setAttribute('scope', 'col');
					th.textContent = headerText;
					headerRow.appendChild(th);
				});
				thead.appendChild(headerRow);
				table.appendChild(thead);
				var tbody = document.createElement('tbody');// se crea el cuerpo de la tabla
				datos.forEach(function(item) { // Añadir filas a la tabla
					var tr = document.createElement('tr');
					['obligacion', 'nombreEntidades', 'normatividad', 'nombrePeriodicidad', 'frecuencia', 'nombrePerfil'].forEach(function(key) {
						var td = document.createElement('td');
						var p = document.createElement('p');
						p.classList.add('text-dark');
						var text = item[key];
						if (text.length > 40) {
							text = text.substring(0, 40) + "...";
						}
						p.textContent = text;
						td.appendChild(p);
						tr.appendChild(td);
					});
					tbody.appendChild(tr);
				});
				table.appendChild(tbody);

				// Agregar la tabla al contenedor #listaInfo
				var listaInfo = document.querySelector('#listaInfo table');
				if (!listaInfo) {
					listaInfo = document.createElement('div');
					listaInfo.classList.add('table-responsive');
					listaInfo.appendChild(table);
					document.querySelector('#listaInfo'+idMatriz).appendChild(listaInfo);
				} else {
					listaInfo.appendChild(table);
				}

				// Mostrar la tabla
				$('#listas'+idMatriz).slideDown();
				$('#listaInfo'+idMatriz).slideDown();
				$('#alert'+idMatriz).slideDown();

				
			} else {
				constantes.alerta("Atención", json.mensaje, "warning", function() {});
			}
		});
	});

	//click boton pagar de modal
	$(document).on('click', '.PagaraButton', function() {
		var idEmpresa = $(this).data('idempresa');
		var nombreMatriz = $(this).data('nombrenuevamatriz');
		var idMatriz = $(this).data('idnuevamatriz');
		var precio = $(this).data('precio');
		
		var nuevaMatriz = {
			id: idMatriz,
			nombre: nombreMatriz,
			precio: precio
		};
		var indice = tipos.findIndex(function(elemento) {
			return elemento.id === nuevaMatriz.id;
		});
		if (indice === -1) {
			tipos.push(nuevaMatriz);
			total += parseInt(nuevaMatriz.precio);
			idss.push(idMatriz);
		}
		$(".tiposDos").html(
			tipos.map(function(elemento) {
				var palabra = elemento.nombre.trim();
				return (
					'<div class="float-left col-md-8"><span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
					palabra +
					' <a href="#" class="eliminarDos text-danger" data-palabra="' + palabra + '"> X </a></span></div>'
				);
			}).join('') +
			(total !== 0 ? '<div class="float-left col-md-2"> Total: <strong>' + total + '</strong></div>'+
			'<input type="text" id="idEmpresa" name="idEmpresa" value='+idEmpresa+' hidden>'+'<div class="float-left col-md-2" style="padding-right: 0px;top:-10px;"><button class="btn btn-primary float-righ" id="Pagar" type="button">Pagar</button></div>': '')
		);
		return false;
	});
	$(document).on('click', '.agregaGratisDos', function() {
		var idEmpresa = $(this).data('idempresa');
		var nombreMatriz = $(this).data('nombrenuevamatriz');
		var idMatriz = $(this).data('idnuevamatriz');
		var nuevaMatriz = {
			id: idMatriz,
			nombre: nombreMatriz
		};
		var indice = tiposGratis.findIndex(function(elemento) {
			return elemento.id === nuevaMatriz.id;
		});
		if (indice === -1) {
			tiposGratis.push(nuevaMatriz);
			ids.push(idMatriz);
		}
		$(".tiposDos").html(
			tiposGratis.map(function(elemento) {
			var palabra = elemento.nombre.trim();
			return ( '<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
				palabra +
				' <a href="#" class="eliminarDos text-danger" data-palabra="' + palabra +'"> X </a></span>'
			);
			}).join('')+
			(tiposGratis != 0 ?'<input type="text" id="idEmpresa" name="idEmpresa" value='+idEmpresa+' hidden>'+'<button class="btn btn-primary" id="btnAgregar" style="margin-left: 20px;" type="button">Agregar</button>': '')
		);
		
		$(document).on('click', '.eliminarDos', function() {
			var palabraEliminar = $(this).data('palabra');
			var indice = tiposGratis.findIndex(function(elemento) {
				return elemento.nombre.trim() === palabraEliminar;
			});
			if (indice !== -1) {
				tiposGratis.splice(indice, 1);
				var idEliminar = ids[indice];
				ids.splice(indice, 1);
				$(".tiposDos").html(
					tiposGratis.map(function(elemento) {
					var palabra = elemento.nombre.trim();
					return (
					'<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
					palabra +
					' <a href="#" class="eliminarDos text-danger" data-palabra="' + palabra + '"> X </a></span>'
					);
				}).join('')+
				(tiposGratis != 0 ?'<input type="text" id="idEmpresa" name="idEmpresa" value='+idEmpresa+' hidden>'+'<button class="btn btn-primary" id="btnAgregar" style="margin-left: 20px;" type="button">Agregar</button>': '')
				);
			}
		});
		return false;
	});
	$(document).on('click', '.eliminarDos', function() {
		event.preventDefault();
		var palabraEliminar = $(this).data('palabra');
		var indice = tipos.findIndex(function(elemento) {
			return elemento.nombre.trim() === palabraEliminar;
		});
		if (indice !== -1) {
			var matrizEliminada = tipos[indice];
			tipos.splice(indice, 1);
			total -= matrizEliminada.precio;
			var idEliminar = idss[indice];
        	idss.splice(indice, 1);
			$(".tiposDos").html(
				tipos.map(function(elemento) {
					var palabra = elemento.nombre.trim();
					return (
						'<div class="float-left col-md-8"><span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
					palabra +
					' <a href="#" class="eliminarDos text-danger" data-palabra="' + palabra + '"> X </a></span></div>'
					);
				}).join('')+
				(total !== 0 ? '<div class="float-left col-md-2"> Total: <strong>' + total + '</strong></div>'+
				'<input type="text" id="idEmpresa" name="idEmpresa" value='+idEmpresa+' hidden>'+'<div class="float-left col-md-2" style="padding-right: 0px;top:-10px;"><button class="btn btn-primary float-righ" id="Pagar" type="button">Pagar</button></div>': '')
			);
		}
	});
	//la empresa crea su propio check
	$scope.creoMiCheck =function(){
		$('#miNuevocheck').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/creoMiCheck";
	 	var parametros  = "edita="+0;
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalmiNuevocheck").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#agregaNuevaMatriz");
	 	},'');
	}
	//cuadno la emrpesa va a crear su propia matriz
	$scope.crearMiMatriz = function(){
		var nombreNuevaMatriz 	= $('#nombreNuevaMatriz').val();
		var Precio			  	= $("#Precio").val();
		var descripcion		  	= $("#descripcion").val();
		var editar		  		= $("#editar").val();
		console.log(editar);		
		if(nombreNuevaMatriz == ""){
			constantes.alerta("Atención","Debe escribir un nombre del check.","info",function(){});
		}else if(Precio ==""){
			constantes.alerta("Atención","Debe escribir un precio para el check, de no tener ningun valor, por favor agregr 0.","info",function(){});
		}else if(descripcion == ""){
			constantes.alerta("Atención","Debe escribir una breve descripción para el check, así podrá ser identificada correctamente.","info",function(){});
		}else{
			if(editar == 0){
				constantes.confirmacion("Confirmación","Esta apunto de crear un check, ¿Desea continuar?",'info',function(){
					var controlador = $scope.config.apiUrl+"CrearMatriz/crearMiNuevaMatriz";
					var parametros  = 	$("#agregaNuevaMatriz").serialize();
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							constantes.alerta("Atención",json.mensaje,"success",function(){
								window.location = $scope.config.apiUrl+"MisMatrices/misCreados/47";
							});
						}
						else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
					});
				});
			}else{
				constantes.confirmacion("Confirmación","Esta apunto de actualizar el check, ¿Desea continuar?",'info',function(){
					var controlador = $scope.config.apiUrl+"MisMatrices/actualizoMiCheck";
					var parametros  = 	$("#agregaNuevaMatriz").serialize();
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							constantes.alerta("Atención",json.mensaje,"success",function(){
								window.location = $scope.config.apiUrl+"MisMatrices/misCreados/47";
							});
						}else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
					});
				});
			}
		}
	}
	$scope.matricesDisponibles = function(){
		window.location = $scope.config.apiUrl+"Buscar/consultaMatrices";
	}
	$scope.creoMiCheck =function(){
		$('#miNuevocheck').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/creoMiCheck";
	 	var parametros  = "edita="+0;
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalmiNuevocheck").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#agregaNuevaMatriz");
	 	},'');
	}
	//actualizo la matriz recien creada por la empresa
	$scope.actualizoCheck = function(idNuevaMatriz,edita){
		$('#miNuevocheck').modal("show");
		var controlador = 	$scope.config.apiUrl+"MisMatrices/creoMiCheck";
		var parametros  = 	"edita="+edita+"&idNuevaMatriz="+idNuevaMatriz;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalmiNuevocheck").html(json);
			$scope.compileAngularElement("#agregaNuevaMatriz");
		},'');
	}
	//borro la matriz creada por la emrpesa
	$scope.borraMatrizCreada = function($id){
		constantes.confirmacion("Confirmación","Esta apunto de eliminar un check, ¿Desea continuar?",'info',function(){
		var controlador = $scope.config.apiUrl+"MisMatrices/borraMatrizCreada";
			var parametros  = {idNuevaMatriz:$id}
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1){
					constantes.alerta("Atención",json.mensaje,"success",function(){
						location.reload();
					});
				}else{
					constantes.alerta("Atención",json.mensaje,"warning",function(){});
				}
			});
		});
	}
	// creo item interno de la matriz creada
	$scope.cargaPlantillaparametros = function(idNuevaMatriz,edita){	
		$('#modalParametros').modal("show");
		var controlador = 	$scope.config.apiUrl+"CrearMatriz/parametrizaciones";
		var parametros  = 	"edita="+edita+"&idNuevaMatriz="+idNuevaMatriz;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json);
			$scope.compileAngularElement("#formAgregaParametros");
		},'');
	}
	//ver matriz
	$scope.verMatriz = function($id){
		window.location = $scope.config.apiUrl+"InfomarcionMatriz/informacion/42/"+$id;
	}
	//duplicar matriz original
	// $scope.duplicar = function($idNuevaMatriz,$nombreNuevaMatriz){
	// 	constantes.confirmacion("Confirmación","Esta apunto de agregar el check "+$nombreNuevaMatriz+", el cual quedara en mis check's creados, ¿Desea continuar?",'info',function(){
	// 		var controlador = $scope.config.apiUrl+"MisMatrices/duplicarMatrizCreada";
	// 		var parametros  = {idNuevaMatriz:$idNuevaMatriz}
	// 		constantes.consultaApi(controlador,parametros,function(json){
	// 			if(json.continuar == 1){
	// 				constantes.alerta("Atención",json.mensaje,"success",function(){
	// 					window.location = $scope.config.apiUrl+"MisMatrices/misCreados/47";
	// 				});
	// 			}else{
	// 				constantes.alerta("Atención",json.mensaje,"warning",function(){});
	// 			}
	// 		});
	// 	});
	// }

	//Nuevo duplicado de matriz
	$(document).on('click', '.duplicar', function() {
		var nombreMatriz = $(this).data('nombrenuevamatriz');
		var idMatriz = $(this).data('idnuevamatriz');
		constantes.confirmacion("Confirmación","Esta apunto de agregar el check "+nombreMatriz+", el cual quedara en mis check's creados, ¿Desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"MisMatrices/duplicarMatrizCreada";
			var parametros  = {idNuevaMatriz:idMatriz}
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1){
					constantes.alerta("Atención",json.mensaje,"success",function(){
						window.location = $scope.config.apiUrl+"MisMatrices/misCreados/47";
					});
				}else{
					constantes.alerta("Atención",json.mensaje,"warning",function(){});
				}
			});
		});
	});




	//Redirecciona
	$scope.agregarMatriz =function(){
		window.location = $scope.config.apiUrl+"Buscar/consultaMatrices";
	} 
	//cierro pop y abro pop plantillas
	$scope.plantilla = function(creador){
		if(creador== 1){
			$('#miNuevocheck').modal("hide");
			setTimeout(function(){
				$scope.sugerimosCheck();
			},500);
		}
	}

	$scope.compileAngularElement = function(elSelector) {
        var elSelector = (typeof elSelector == 'string') ? elSelector : null ;  
		// The new element to be added
		if (elSelector != null ) {
			var $div = $( elSelector );
				// The parent of the new element
			var $target = $("[ng-app]");
			angular.element($target).injector().invoke(['$compile', function ($compile) {
						var $scope = angular.element($target).scope();
						$compile($div)($scope);
						// Finally, refresh the watch expressions in the new element
						$scope.$apply();
			}]);
		}
    }
});