//Funcion Generica:
function actualizar_checkbox(checkbox_id, url_consulta, id_retorno){
	if($(checkbox_id).is(":checked")) {
      //alert("seleccionID=true,"+$(this).val());
      $.ajax({
          type: "GET", 
          url: url_consulta,
          data: "seleccionID=true,"+$(checkbox_id).val(),
          success: function(html) {
            $(id_retorno).html(html);
          }
      });
    } else {
      $.ajax({
          type: "GET", 
          url: url_consulta,
          data: "seleccionID=false,"+$(checkbox_id).val(),
          success: function(html) {
            $(id_retorno).html(html);
          }
      });
    }
}

//Checkers Events Nivel
$(document).on( "click", "input#activo_nivel", function() {
	actualizar_checkbox(this, "v_agregar_nivel.php", "#ingresar_mantenimiento");
});

//Checkers Events Tipos Contactos
$(document).on( "click", "input#activo_contacto", function() {
	actualizar_checkbox(this, "v_agregar_tipocontacto.php", "#ingresar_mantenimiento");
});

//Checkers Events Condiciones
$(document).on( "click", "input#activo_condicion", function() {
  actualizar_checkbox(this, "v_agregar_condicion.php", "#ingresar_mantenimiento");
});

//Checkers Events Personas
$(document).on( "click", "input#activo_persona", function() {
	actualizar_checkbox(this, "v_lista_personas.php", "#contenedor_personas");
});

//Checkers Events Empresas
$(document).on( "click", "input#activo_empresa", function() {
	actualizar_checkbox(this, "v_lista_empresas.php", "#contenedor_empresas");
});

//Checkers Events Empresas
$(document).on( "click", "input#activo_usuario", function() {
	actualizar_checkbox(this, "v_lista_usuarios.php", "#contenedor_usuario");
});

//Checkers Events Tareas
$(document).on( "click", "input#activo_tarea", function() {
  actualizar_checkbox(this, "tareas.php", "#");
});

//Lista Entidades
$(document).ready(function() {
  //alert("Todavia funciono...");
  $.get('v_lista_personas.php', function(data) {
    $('#contenedor_personas').html(data);
  });
});

$('#ver_persona').click(function() {
  //alert("Todavia funciono...");
  $.get('v_lista_personas.php', function(data) {
    $('#contenedor_personas').html(data);
  });
});

$('#agregar_persona').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_persona.php', function(data) {
    $('#contenedor_personas').html(data);
  });
});

$('#agregar_contacto_persona').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_contacto_persona.php', function(data) {
    $('#contenedor_personas').html(data);
  });
});

$('#agregar_empresa').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_empresa.php', function(data) {
    $('#contenedor_empresas').html(data);
  });
});

$(document).ready(function() {
  //alert("Todavia funciono...");
  $.get('v_lista_empresas.php', function(data) {
    $('#contenedor_empresas').html(data);
  });
});

$('#ver_empresa').click(function() {
  //alert("Todavia funciono...");
  $.get('v_lista_empresas.php', function(data) {
    $('#contenedor_empresas').html(data);
  });
});

$('#agregar_contacto_empresa').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_contacto_empresa.php', function(data) {
    $('#contenedor_empresas').html(data);
  });
});

$(document).ready(function() {
  //alert("Todavia funciono...");
  $.get('v_lista_usuarios.php', function(data) {
    $('#contenedor_usuarios').html(data);
  });
});

$('#ver_usuario').click(function() {
  //alert("Todavia funciono...");
  $.get('v_lista_usuarios.php', function(data) {
    $('#contenedor_usuarios').html(data);
  });
});

$('#agregar_usuario').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_usuario.php', function(data) {
    $('#contenedor_usuarios').html(data);
  });
});

$('#modificar_usuario').click(function() {
  //alert("Todavia funciono...");
  $.get('v_modificar_usuario.php', function(data) {
    $('#contenedor_usuarios').html(data);
  });
});

//Lista Usuarios
$(document).on( "change", "#modificar_persona", function() {
	//alert('Hola!!');
    $.ajax({
        url     : 'm_modificar_usuario.php',
        type    : 'POST',
        dataType: 'json',
        data    : $('#validation').serialize(),
        success: function( data ) {
               for(var id in data) {        
                      $(id).val( data[id] );
               }
        }
    });
});

//Lista Mantenimientos
$('#agregar_nivel').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_nivel.php', function(data) {
    $('#ingresar_mantenimiento').html(data);
  });
});

$('#agregar_referencia').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_referencia.php', function(data) {
    $('#ingresar_mantenimiento').html(data);
  });
});

$('#agregar_contacto').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_tipocontacto.php', function(data) {
    $('#ingresar_mantenimiento').html(data);
  });
});

$('#agregar_condicion').click(function() {
  //alert("Todavia funciono...");
  $.get('v_agregar_condicion.php', function(data) {
    $('#ingresar_mantenimiento').html(data);
  });
});

//Cambio de Contrasenia
$(function(){
    $('#submitContrasenia').on('click', function(e){
      e.preventDefault();
      $.post('cambiarContrasenia.php', 
         $('#cambioContrasenia').serialize(), 
         function(data, status, xhr){
           // do something here with response;
         });
    });
});

//Validar jpg de las paginas 
function validarForm()
{
var valor = document.getElementById("nombres").value;
var valor2 = document.getElementById("apellidos").value;
var valor3 = document.getElementById("apellidos").value;
var combo1 = document.getElementById("sexo").value;
var combo2 = document.getElementById("fechanacimiento").value;
var file=document.getElementById("file").value;
patron = /^\d{4}\-\d{2}\-\d{2}$/;


if( valor == null || valor.length == 0  ) {
 //$('#div_session_write').load('v_agregar_persona.php?txt.style.border = "2px solid red"');  
 document.getElementById("nombres").style.border = "2px solid red";

 return false;
}
else if( valor2 == null || valor2.length == 0  ) {
 //$('#div_session_write').load('v_agregar_persona.php?txt.style.border = "2px solid red"');  
 document.getElementById("apellidos").style.border = "2px solid red";

 return false;
}
else if( valor3 == null || valor3.length == 0  ) {
 //$('#div_session_write').load('v_agregar_persona.php?txt.style.border = "2px solid red"');  
 document.getElementById("apellidos").style.border = "2px solid red";

 return false;
}
else if(!patron.test(combo2))
{
  
  document.getElementById("fechanacimiento").style.border = "2px solid red";
   return false;

}
else if(combo1 == null || combo1 == "") { 
 document.getElementById("sexo").style.border = "2px solid red";

 return false;
}
else if(!/(\.bmp|\.gif|\.jpg|\.jpeg)$/i.test(file))
{ 
     document.getElementById("file").style.border = "2px solid red";         
        return false;     
}
else{

 return true;
}

}
//fin de la validacion 

