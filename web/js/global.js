$(function() {
	$(".btn").click(function() {
		$(".form-signin").toggleClass("form-signin-left");
    $(".form-signup").toggleClass("form-signup-left");
    $(".frame").toggleClass("frame-long");
    $(".signup-inactive").toggleClass("signup-active");
    $(".signin-active")
    .toggleClass("signin-inactive");
    $(".forgot").toggleClass("forgot-left");   
    $(this).removeClass("idle").addClass("active");
	});
});

$(document).ready(function(){

    //console.log("Si se esta cargando el js");
    //Este es el que va a cambiar el formulario dependiendo de lo que seleccione
    $(document).on('change',"#tipoSolicitud",function(){
        //Aqui se obtiene el valor seleccionado

    let seleccion = $(this).val();

    // Obtiene el atributo data-url de la opción seleccionada
    let url = $(this).find(':selected').data('url');

    $('#formulario-dinamico').html('');


        if (url){ //Aqui es para verifica que la url no este vacio 
            $.ajax({
                url: url,
                type: 'POST',
                data: {valor: seleccion },
                success: function (data) {

                    // console.log("Respuesta del servidor: ", data);

                    $('#formulario-dinamico').html(data);
                },
                error: function (){
                    $('#formulario-dinamico').html('<p>Error al cargar el formulario.</p>');
                }
            });
        } else {
            //Este es para que limpie el formulario si no hay nada seleccionado
            $('#formulario-dinamico').html("<p class='text-center'>Por favor Seleccione una Opcion...</p>"); 

        }
    });


    $(document).on('change', "#EstadoSeñalizacion", function(){

    let seleccion = $(this).val();
        if (seleccion === 'reparacion'){
            $('#grupoTipoDano').show();
        } else {
            $('#grupoTipoDano').hide();

        }
    })
    
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

    $(document).ready(function() {
        $('#form-signup').submit(function(event) {
            event.preventDefault();
            
            let errores = [];
            let esValido = true;
    
            // Validación del nombre
            const nombre = $('#nombre').val().trim();
            if (nombre === '') {
                errores.push('El campo nombre es obligatorio.');
                esValido = false;
            } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombre)) {
                errores.push('El campo nombre solo puede contener letras.');
                esValido = false;
            }
    
            // Validación del apellido
            const apellido = $('#apellido').val().trim();
            if (apellido === '') {
                errores.push('El campo apellido es obligatorio.');
                esValido = false;
            } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(apellido)) {
                errores.push('El campo apellido solo puede contener letras.');
                esValido = false;
            }
    
            // Validación del tipo de documento
            const tipoDocumento = $('#td').val();
            if (tipoDocumento === '') {
                errores.push('Debe seleccionar un tipo de documento.');
                esValido = false;
            }
    
            // Validación del número de documento
            const numeroDocumento = $('input[name="numerodocumento"]').val().trim();
            if (numeroDocumento === '') {
                errores.push('El número de documento es obligatorio.');
                esValido = false;
            } else if (!/^\d+$/.test(numeroDocumento)) {
                errores.push('El número de documento solo debe contener dígitos.');
                esValido = false;
            }
    
            // Validación del teléfono
            const telefono = $('#telefono').val().trim();
            if (telefono === '') {
                errores.push('El campo teléfono es obligatorio.');
                esValido = false;
            } else if (!/^\d{10}$/.test(telefono)) {
                errores.push('El teléfono debe contener 10 dígitos.');
                esValido = false;
            }
    
            // Validación del email
            const email = $('#email').val().trim();
            if (email === '') {
                errores.push('El campo correo es obligatorio.');
                esValido = false;
            } else if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email)) {
                errores.push('El correo electrónico no es válido.');
                esValido = false;
            }
    
            // Validación de la contraseña
            const password = $('#password').val();
            if (password === '') {
                errores.push('El campo contraseña es obligatorio.');
                esValido = false;
            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
                errores.push('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.');
                esValido = false;
            }
    
            // Validación de confirmación de contraseña
            const confirmPassword = $('input[name="confirmpassword"]').val();
            if (confirmPassword === '') {
                errores.push('Debe confirmar la contraseña.');
                esValido = false;
            } else if (confirmPassword !== password) {
                errores.push('Las contraseñas no coinciden.');
                esValido = false;
            }
    
            // Validación de los campos de dirección
            const tipovia = $('select[name="tipovia"]').val();
            const numeroPrincipal = $('input[name="numeroprincipal"]').val().trim();
            const barrio = $('select[name="barrio"]').val();
    
            if (tipovia === '') {
                errores.push('Debe seleccionar un tipo de vía.');
                esValido = false;
            }
            if (numeroPrincipal === '') {
                errores.push('El número de la vía principal es obligatorio.');
                esValido = false;
            }
            if (barrio === '') {
                errores.push('Debe seleccionar un barrio.');
                esValido = false;
            }
    
            if (esValido) {
                this.submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    html: errores.join('<br>')
                });
            }
        });
    });
    
    $('#emailForm').on('submit', function(e) {
        let userEmail = '';
        e.preventDefault();
        userEmail = $('#email').val();

        $.ajax({
            url: 'cambiarContraseña.php',
            type: 'POST',
            data: {
                action: 'request_reset',
                email: userEmail
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Código Enviado',
                        text: response.message
                    });
                    $('#resetPasswordForm').hide();
                    $('#verifyCodeForm').show();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde.'
                });
            }
        });
    });

    $('#codeForm').on('submit', function(e) {
        e.preventDefault();
        let code = $('#code').val();

        $.ajax({
            url: 'cambiarContraseña.php',
            type: 'POST',
            data: {
                action: 'verify_code',
                email: userEmail,
                code: code
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Código Verificado',
                        text: response.message
                    });
                    $('#verifyCodeForm').hide();
                    $('#newPasswordForm').show();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde.'
                });
            }
        });
    });

    $('#passwordForm').on('submit', function(e) {
        e.preventDefault();
        let password = $('#password').val();
        let confirmPassword = $('#confirmPassword').val();

        if (password !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas no coinciden.'
            });
            return;
        }

        $.ajax({
            url: 'cambiarContraseña.php',
            type: 'POST',
            data: {
                action: 'reset_password',
                email: userEmail,
                code: $('#code').val(),
                password: password
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Contraseña Actualizada',
                        text: response.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'login.php'; // Redirige al login
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde.'
                });
            }
        });
    });

});