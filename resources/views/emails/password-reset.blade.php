<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Restablecer contraseña - Defensa Civil Colombiana</title>
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
            .title {
                font-size: 24px !important;
            }
            .subtitle {
                font-size: 20px !important;
            }
            .logo {
                width: 100px !important;
            }
            .code-box {
                font-size: 28px !important;
                padding: 20px !important;
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
                                            Restablecer Contraseña
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
                                            Recibimos una solicitud para restablecer la contraseña de tu cuenta en la plataforma de la <strong style="color: #ff6600;">Defensa Civil Colombiana</strong>.
                                        </p>
                                        
                                        <!-- Código de verificación -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 30px 0;">
                                            <tr>
                                                <td align="center">
                                                    <p style="margin: 0 0 16px; color: #2d3748; font-size: 15px; font-weight: 600;">
                                                        Tu código de verificación es:
                                                    </p>
                                                    <div class="code-box" style="background: linear-gradient(135deg, #0770cc 0%, #0a5aa8 100%); border-radius: 10px; padding: 24px; box-shadow: 0 4px 15px rgba(7, 112, 204, 0.25);">
                                                        <p style="margin: 0; color: #ffffff; font-size: 36px; font-weight: 700; letter-spacing: 8px; font-family: 'Courier New', monospace; text-align: center;">
                                                            {{ $code }}
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Información de expiración -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 30px 0; background-color: #fff7ed; border-radius: 6px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <p style="margin: 0; color: #2d3748; font-size: 15px; line-height: 1.5; text-align: center;">
                                                        <strong style="color: #ff6600;">⏱️ Este código expira en {{ $expirationMinutes }} minutos</strong><br>
                                                        <span style="font-size: 13px; color: #4a5568;">Ingresa el código en la aplicación para continuar</span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Separador -->
                                        <div style="height: 1px; background-color: #e2e8f0; margin: 35px 0;"></div>
                                        
                                        <!-- Instrucciones -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 30px 0; background-color: #f0f7ff; border-radius: 6px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <p style="margin: 0 0 12px; color: #0770cc; font-size: 15px; font-weight: 600;">
                                                        Instrucciones:
                                                    </p>
                                                    <ol style="margin: 0; padding-left: 20px; color: #2d3748; font-size: 14px; line-height: 1.8;">
                                                        <li>Ingresa el código de 6 dígitos en la página de restablecimiento</li>
                                                        <li>Crea tu nueva contraseña segura</li>
                                                        <li>Confirma la nueva contraseña</li>
                                                    </ol>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Advertencia de seguridad -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #fff5f5; border-radius: 6px;">
                                            <tr>
                                                <td style="padding: 16px;">
                                                    <p style="margin: 0; color: #742a2a; font-size: 13px; line-height: 1.5;">
                                                        <strong style="color: #ff6600;">Importante:</strong> Si no solicitaste restablecer tu contraseña, ignora este correo. Tu cuenta permanecerá segura y no se realizarán cambios.
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