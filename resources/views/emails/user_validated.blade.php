<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte validé</title>
</head>
<body style="margin:0; padding:0; background-color:#f9fafb; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    <table width="100%" bgcolor="#f9fafb" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                <table width="600" bgcolor="#ffffff" cellpadding="0" cellspacing="0" style="border-radius:12px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td bgcolor="#1d4ed8" align="center" style="padding:20px 0;">
                            <h1 style="color:#ffffff; margin:0; font-size:24px;">Urban Guard</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color:#1d4ed8; font-size:20px;">Bonjour {{ $user->name }},</h2>
                            
                            <p style="color:#374151; font-size:16px; line-height:1.6; margin-top:10px;">
                                Félicitations ! Après vérification de vos informations, nous avons le plaisir de vous informer que
                                votre compte sur la plateforme <strong>Urban Guard</strong> a été 
                                <strong style="color:#16a34a;">validé</strong>.
                            </p>

                            <p style="color:#374151; font-size:16px; line-height:1.6;">
                                Vous pouvez désormais accéder à toutes les fonctionnalités qui vous sont réservées selon votre rôle.
                            </p>

                            <p style="color:#374151; font-size:16px; line-height:1.6;">
                                En cas de besoin, notre équipe reste disponible à tout moment à l’adresse suivante : 
                                <a href="mailto:support@urbanguard.com" style="color:#2563eb; text-decoration:none;">support@urbanguard.com</a>.
                            </p>

                            <div style="text-align:center; margin-top:30px;">
                                <a href="{{ route('login') }}" style="background-color:#1d4ed8; color:#fff; padding:12px 24px; border-radius:8px; text-decoration:none; font-weight:600;">
                                    Se connecter à mon compte
                                </a>
                            </div>

                            <p style="color:#374151; font-size:16px; line-height:1.6; margin-top:25px;">
                                Bienvenue parmi nous,<br>
                                <strong>L’équipe Urban Guard</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td bgcolor="#1e293b" align="center" style="padding:20px; color:#cbd5e1; font-size:14px;">
                            <p style="margin:0;">© {{ date('Y') }} Urban Guard. Tous droits réservés.</p>
                            <p style="margin:5px 0 0;">Plateforme de gestion communautaire sécurisée</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
