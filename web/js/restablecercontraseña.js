// $(document).ready(function () {
//     // Manejar el envío del formulario de correo electrónico
//     $(document).on('submit', '#resetPasswordForm', function (e) {
//         e.preventDefault();
//         var email = $('#email').val().trim();
//         var url = $(this).attr('action');

//         if (email === '' || !validateEmail(email)) {
//             Swal.fire('Error', 'Por favor, ingrese un correo electrónico válido.', 'error');
//             return;
//         }

//         $.ajax({
//             url: url,
//             type: 'POST',
//             data: { email: email },
//             success: function (data) {
//                 if (data.success) {
//                     $('#resetPasswordForm').hide();
//                     $('#verifyCodeForm').show();
//                     Swal.fire('Éxito', data.message, 'success');
//                     window.location.href = 'restablecer_contra.php';
//                 } else {
//                     Swal.fire('Error', data.message, 'error');
//                 }
//             }
//         });
//     });

//     // Manejar el envío del formulario de verificación de código
//     $(document).on('submit', '#verifyCodeForm', function (e) {
//         e.preventDefault();
//         var code = $('#code').val().trim();
//         var url = $(this).attr('action');

//         if (code === '') {
//             Swal.fire('Error', 'El campo de código es obligatorio.', 'error');
//             return;
//         }

//         $.ajax({
//             url: url,
//             type: 'POST',
//             data: { code: code },
//             success: function (data) {
//                 if (data.success) {
//                     $('#verifyCodeForm').hide();
//                     $('#newPasswordForm').show();
//                     Swal.fire('Éxito', data.message, 'success');
//                 } else {
//                     Swal.fire('Error', data.message, 'error');
//                 }
//             }
//         });
//     });

//     // Manejar el envío del formulario de nueva contraseña
//     $(document).on('submit', '#passwordForm', function (e) {
//         e.preventDefault();
//         var password = $('#password').val().trim();
//         var confirmPassword = $('#confirmPassword').val().trim();
//         var url = $(this).attr('action');

//         if (password === '' || password.length < 8 || password !== confirmPassword) {
//             Swal.fire('Error', 'Por favor, verifique su contraseña.', 'error');
//             return;
//         }

//         $.ajax({
//             url: url,
//             type: 'POST',
//             data: { password: password, confirmPassword: confirmPassword },
//             success: function (data) {
//                 if (data.success) {
//                     Swal.fire('Éxito', data.message, 'success').then(() => {
//                         window.location.href = 'login.php';
//                     });
//                 } else {
//                     Swal.fire('Error', data.message, 'error');
//                 }
//             }
//         });
//     });

//     function validateEmail(email) {
//         var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         return re.test(email);
//     }
// });