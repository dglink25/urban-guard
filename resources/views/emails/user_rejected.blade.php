<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande rejetée</title>
</head>
<body style="margin:0; padding:0; background-color:#f9fafb; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    <table width="100%" bgcolor="#f9fafb" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                <table width="600" bgcolor="#ffffff" cellpadding="0" cellspacing="0" style="border-radius:12px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.1);">
                    <tr>
                        <td bgcolor="#1d4ed8" align="center" style="padding:20px 0;">
                            <h1 style="color:#ffffff; margin:0; font-size:24px;">Urban Guard</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color:#1d4ed8; font-size:20px;">Bonjour {{ $user->name }},</h2>
                            <p style="color:#374151; font-size:16px; line-height:1.6; margin-top:10px;">
                                Nous vous remercions pour votre inscription sur la plateforme <strong>Urban Guard</strong>.
                                Après examen de votre demande, nous sommes au regret de vous informer que celle-ci a été <strong style="color:#dc2626;">rejetée</strong>.
                            </p>

                            <p style="color:#374151; font-size:16px; line-height:1.6;">
                                Si vous pensez qu’il s’agit d’une erreur, vous pouvez contacter notre équipe à tout moment
                                à l’adresse suivante : <a href="mailto:support@urbanguard.com" style="color:#2563eb; text-decoration:none;">support@urbanguard.com</a>.
                            </p>

                            <p style="color:#374151; font-size:16px; line-height:1.6;">
                                Merci de votre compréhension.<br>
                                <strong>L’équipe Urban Guard</strong>
                            </p>

                            <div style="text-align:center; margin-top:30px;">
                                <a href="{{ url('/') }}" style="background-color:#1d4ed8; color:#fff; padding:12px 24px; border-radius:8px; text-decoration:none; font-weight:600;">
                                    Retourner sur le site
                                </a>
                            </div>
                        </td>
                    </tr>

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
