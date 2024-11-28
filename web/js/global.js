$(function() {
	$(".btn").click(function() {
		$(".form-signin").toggleClass("form-signin-left");
    $(".form-signup").toggleClass("form-signup-left");
    $(".frame").toggleClass("frame-long");
    $(".signup-inactive").toggleClass("signup-active");
    $(".signin-active").toggleClass("signin-inactive");
    $(".forgot").toggleClass("forgot-left");   
    $(this).removeClass("idle").addClass("active");
	});
});

$(document).ready(function(){
    $('#form').submit(function(event){
        event.preventDefault();
        let mensajes = [];
        $('#error').html('');
        let esValido = true;
    
        const nombre =  $('#nombre').val().trim();
    
        if(nombre === ''){
            mensajes.push('El campo nombre es obligatorio.');
            esValido = false;
        } else {
            if(ValidarCampoLetras(nombre)){
                mensajes.push('El campo nombre solo puede tener letras.');
                esValido = false;
            }
        }
    
        const apellido =  $('#apellido').val().trim();
        if(apellido === ''){
            mensajes.push('el campo apellido es obligatorio.');
            esValido = false;
        }else{
            if(ValidarCampoLetras(apellido)){
                mensajes.push('El campo apellido solo puede tener letras.');
                esValido = false;
            }
        }
        
        const  email =  $('#email').val().trim();
        const patron = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
        if(email === ''){
            mensajes.push('El campo correo es obligatorio.');
            esValido = false;
        } else {
            if(!patron.test(email)){
                mensajes.push('El correo no es valido.');
                esValido = false;
            }
        }
    
        const contraseña =  $('#contraseña').val().trim();
        const patronContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
        if(contraseña === ''){
            mensajes.push('El campo contraseña es obligatorio.');
            esValido = false;
        } else {
            if(!patronContrasena.test(contraseña)){
                mensajes.push('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un caracter especial.');
                esValido = false;
            }
        }
        const rol =  $('#rol').val().trim();
        if(rol === 'Seleccione...'){
            mensajes.push('El campo rol es obligatorio.');
            esValido = false;
        }
        if(esValido){
             $("#error").fadeOut(500);
             $("#error").addClass('d-none');
            //  this.submit();
        }else{
            $('#error').html(mensajes.map(msg => `${msg}<br>`).join(''));
            $('#error').removeClass('d-none');
        }
    });
    $(document).on('keyup',"#buscar",function(){

        let buscar =  $(this).val();
        let url = $(this).attr('data-url');
        $.ajax({
            url: url,
            type: 'POST',
            data: {'buscar': buscar},
            success: function(data){
                $('tbody').html(data);
            }
        });
    });
    
    $(document).on('click','#cambiar_estado',function(){
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        let user = $(this).attr('data-user');
        //alert(id + " "+ user);
        $.ajax({
            url: url,
            type: 'POST',
            data: {id,user}, 
            success: function(data){
                $("tbody").html(data);
            }
        })
    });

    $(document).on('click','#cambiar_estado_materia',function(){
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        let materia = $(this).attr('data-materia');
        //alert(id + " "+ user);
        $.ajax({
            url: url,
            type: 'POST',
            data: {id,materia}, 
            success: function(data){
                $("tbody").html(data);
            }
        })
    });

    $(document).on('click','#copylist',function(){

        let listUser = $("#listUser").html();

        $("#responsables").append(
            "<div class'col-md-4 form-group'>"+
            "<label>Responsable</label>"+
            "<div class'row'>"+
                "div class='col-md-10'>"+listUser+"</div>"+
                "div class='col-md-2'>"+
                    "buttom class='btn btn-danger' type='button' id='responsables>x</button>'"+
                "</div>"+
            "</div>"+
            "</div>"
        )

    })
    $(document).on('click','#copylist',function(){

        $(this).parent().parent().parent().remove();
    })
    $('#form-signup').submit(function(event){
        event.preventDefault();
        
        let mensajes = [];
        let esValido = true;
    
        const nombre =  $('#nombre').val().trim();
    
        if(nombre === ''){
            mensajes.push('El campo nombre es obligatorio.');
            esValido = false;
        } else {
            if(ValidarCampoLetras(nombre)){
                mensajes.push('El campo nombre solo puede tener letras.');
                esValido = false;
            }
        }
    
        const apellido =  $('#apellido').val().trim();
        if(apellido === ''){
            mensajes.push('el campo apellido es obligatorio.');
            esValido = false;
        }else{
            if(ValidarCampoLetras(apellido)){
                mensajes.push('El campo apellido solo puede tener letras.');
                esValido = false;
            }
        }
        
        const  email =  $('#email').val().trim();
        const patron = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
        if(email === ''){
            mensajes.push('El campo correo es obligatorio.');
            esValido = false;
        } else {
            if(!patron.test(email)){
                mensajes.push('El correo no es valido.');
                esValido = false;
            }
        }
    
        const contraseña =  $('#password').val().trim();
        const patronContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
        if(contraseña === ''){
            mensajes.push('El campo contraseña es obligatorio.');
            esValido = false;
        } else {
            if(!patronContrasena.test(contraseña)){
                mensajes.push('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un caracter especial.');
                esValido = false;
            }
        }
        // const rol =  $('#rol').val().trim();
        // if(rol === 'Seleccione...'){
        //     mensajes.push('El campo rol es obligatorio.');
        //     esValido = false;
        // }
        if(esValido){
            //  $("#error").fadeOut(500);
            //  $("#error").addClass('d-none');
            this.submit();

        }else{
            alert("Error mi pana");
            mensajes.forEach( mensajito => {
                alert(mensajito);
            }); 
        //     $('#error').html(mensajes.map(msg => `${msg}<br>`).join(''));
        //     $('#error').removeClass('d-none');
        // 
        }
    });
});