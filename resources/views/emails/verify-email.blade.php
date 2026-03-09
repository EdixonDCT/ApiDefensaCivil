<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Verificar correo electrónico - Defensa Civil Colombiana</title>
    <style>
        /* Estilos responsive para móviles */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                max-width: 100% !important;
            }
            .content-padding {
                padding: 20px 25px !important;
            }
            .header-padding {
                padding: 30px 25px 20px !important;
            }
            .footer-padding {
                padding: 25px 25px !important;
            }
            .button {
                padding: 16px 30px !important;
                font-size: 16px !important;
            }
            .title {
                font-size: 24px !important;
            }
            .subtitle {
                font-size: 20px !important;
            }
            .logo {
                width: 100px !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f4f4;">
    
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f4; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <!-- Contenedor principal -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" class="container" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                    
                    <!-- Header con logo y banner -->
                    <tr>
                        <td style="background-color: #ff6600; padding: 0; position: relative;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td align="center" class="header-padding" style="padding: 40px 40px 30px;">
                                        <!-- Logo Defensa Civil -->
                                        <img src="{{ config('app.url') }}/assets/images/logos/defensa-civil-logo.png" 
                                             alt="Defensa Civil Colombiana" 
                                             width="120"
                                             class="logo"
                                             style="display: block; margin: 0 auto 20px;">
                                        <h1 class="title" style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700; letter-spacing: -0.5px; text-align: center;">
                                            Verificación de Cuenta
                                        </h1>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Onda decorativa -->
                            <div style="width: 100%; height: 30px; background-color: #ffffff; position: relative; margin-top: -1px;">
                                <svg width="100%" height="30" viewBox="0 0 600 30" preserveAspectRatio="none" style="display: block;">
                                    <path d="M0,15 Q150,0 300,15 T600,15 L600,30 L0,30 Z" fill="#ffffff"/>
                                </svg>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Contenido principal -->
                    <tr>
                        <td class="content-padding" style="padding: 30px 50px 40px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td>
                                        <h2 class="subtitle" style="margin: 0 0 10px; color: #0770cc; font-size: 22px; font-weight: 600;">
                                            ¡Hola, {{ $user->profile->first_name ?? $user->email }}!
                                        </h2>
                                        <p style="margin: 0 0 24px; color: #4a5568; font-size: 16px; line-height: 1.6;">
                                            Bienvenido a la plataforma de la <strong style="color: #ff6600;">Defensa Civil Colombiana</strong>. 
                                            Para activar tu cuenta y comenzar a utilizar nuestros servicios, necesitamos que verifiques tu dirección de correo electrónico.
                                        </p>
                                        
                                        <!-- Caja informativa -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 30px 0; background-color: #f0f7ff; border-radius: 6px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <p style="margin: 0; color: #2d3748; font-size: 15px; line-height: 1.5;">
                                                        <strong style="color: #0770cc;">Verificación requerida</strong><br>
                                                        Este paso es necesario para garantizar la seguridad de tu cuenta y validar tu identidad en nuestro sistema.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Botón de verificación -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 35px 0;">
                                            <tr>
                                                <td align="center">
                                                    <a href="{{ $url }}" 
                                                       class="button"
                                                       style="display: inline-block; background-color: #ff6600; color: #ffffff; text-decoration: none; padding: 18px 50px; font-size: 17px; font-weight: 600; border-radius: 8px;">
                                                        Verificar mi correo electrónico
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Proceso de registro -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 30px 0; background: linear-gradient(135deg, #f0f7ff 0%, #e6f2ff 100%); border-radius: 8px; border: 2px solid #0770cc;">
                                            <tr>
                                                <td style="padding: 24px;">
                                                    <p style="margin: 0 0 12px; color: #0770cc; font-size: 16px; font-weight: 600; text-align: center;">
                                                        📋 Proceso de Registro
                                                    </p>
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td style="padding: 8px 0;">
                                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                    <tr>
                                                                        <td width="30" style="vertical-align: top; padding-right: 10px;">
                                                                            <div style="width: 24px; height: 24px; background-color: #ff6600; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px;">1</div>
                                                                        </td>
                                                                        <td style="vertical-align: top;">
                                                                            <p style="margin: 0; color: #2d3748; font-size: 14px; line-height: 1.6;">
                                                                                <strong style="color: #ff6600;">Verificar tu correo</strong> (paso actual)
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px 0;">
                                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                    <tr>
                                                                        <td width="30" style="vertical-align: top; padding-right: 10px;">
                                                                            <div style="width: 24px; height: 24px; background-color: #cbd5e0; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px;">2</div>
                                                                        </td>
                                                                        <td style="vertical-align: top;">
                                                                            <p style="margin: 0; color: #2d3748; font-size: 14px; line-height: 1.6;">
                                                                                <strong style="color: #0770cc;">Revisión por un administrador</strong>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px 0;">
                                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                    <tr>
                                                                        <td width="30" style="vertical-align: top; padding-right: 10px;">
                                                                            <div style="width: 24px; height: 24px; background-color: #cbd5e0; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px;">3</div>
                                                                        </td>
                                                                        <td style="vertical-align: top;">
                                                                            <p style="margin: 0; color: #2d3748; font-size: 14px; line-height: 1.6;">
                                                                                <strong style="color: #0770cc;">Aprobación y acceso completo</strong>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <p style="margin: 16px 0 0; color: #4a5568; font-size: 13px; line-height: 1.5; text-align: center; font-style: italic;">
                                                        Recibirás una notificación cuando tu cuenta sea aprobada
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Separador -->
                                        <div style="height: 1px; background-color: #e2e8f0; margin: 35px 0;"></div>
                                        
                                        <!-- Link alternativo -->
                                        <p style="margin: 0 0 10px; color: #718096; font-size: 14px; line-height: 1.5;">
                                            Si el botón no funciona, copia y pega el siguiente enlace en tu navegador:
                                        </p>
                                        <p style="margin: 0 0 30px; padding: 12px; background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; word-break: break-all;">
                                            <a href="{{ $url }}" style="color: #0770cc; text-decoration: none; font-size: 13px;">{{ $url }}</a>
                                        </p>
                                        
                                        <!-- Advertencia de seguridad -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #fff5f5; border-radius: 6px;">
                                            <tr>
                                                <td style="padding: 16px;">
                                                    <p style="margin: 0; color: #742a2a; font-size: 13px; line-height: 1.5;">
                                                        <strong style="color: #ff6600;">Importante:</strong> Si no creaste una cuenta en nuestro sistema, por favor ignora este correo. Tu información permanecerá segura.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td class="footer-padding" style="background: linear-gradient(to bottom, #f7fafc 0%, #edf2f7 100%); padding: 35px 50px; border-top: 1px solid #e2e8f0;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <p style="margin: 0 0 8px; color: #0770cc; font-size: 16px; font-weight: 600;">
                                            Defensa Civil Colombiana
                                        </p>
                                        <p style="margin: 0 0 15px; color: #718096; font-size: 13px; line-height: 1.5;">
                                            Salvamos vidas y aliviamos el sufrimiento
                                        </p>
                                        
                                        <p style="margin: 15px 0 0; color: #a0aec0; font-size: 12px;">
                                            © {{ date('Y') }} Defensa Civil Colombiana. Todos los derechos reservados.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                </table>
                
            </td>
        </tr>
    </table>
    
</body>
</html>