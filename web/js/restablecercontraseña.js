$(document).ready(function() {
    $('#emailForm').on('submit', function(e) {
        e.preventDefault();
        let email = $('#email').val();

        $.ajax({
            url: 'restablecer_contra.php',
            type: 'POST',
            data: {
                action: 'request_reset',
                email: email
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Enlace Enviado',
                        text: response.message
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

    $('#passwordForm').on('submit', function(e) {
        e.preventDefault();
        let password = $('#password').val();
        let confirmPassword = $('#confirmPassword').val();
        let token = new URLSearchParams(window.location.search).get('token');

        if (password !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas no coinciden.'
            });
            return;
        }

        $.ajax({
            url: 'restablecer_contra.php',
            type: 'POST',
            data: {
                action: 'reset_password',
                token: token,
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
                            window.location.href = 'login.php';
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

