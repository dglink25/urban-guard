<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande d’inscription</title>
</head>
<body style="margin:0; padding:0; background-color:#f9fafb; font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

    <table width="100%" bgcolor="#f9fafb" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 10px;">
                <table width="600" bgcolor="#ffffff" cellpadding="0" cellspacing="0" style="border-radius:12px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.1);">
                    <tr>
                        <td bgcolor="#1d4ed8" align="center" style="padding:20px 0;">
                            <h1 style="color:#ffffff; margin:0; font-size:24px;">Urban Guard</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px;">
                            <h2 style="color:#1d4ed8; font-size:20px;">Nouvelle demande d’inscription</h2>
                            <p style="color:#374151; font-size:16px; line-height:1.6;">
                                Bonjour Administrateur,<br><br>
                                Une nouvelle demande d’inscription a été soumise par :
                            </p>
                            <ul style="color:#111827; font-size:16px; line-height:1.6;">
                                <li><strong>Nom :</strong> {{ $user->name }}</li>
                                <li><strong>Email :</strong> {{ $user->email }}</li>
                                <li><strong>Rôle :</strong> {{ ucfirst($user->role) }}</li>
                            </ul>
                            <p style="color:#374151; font-size:16px; line-height:1.6;">
                                Vous pouvez consulter la demande directement en cliquant sur le bouton ci-dessous :
                            </p>
                            <div style="text-align:center; margin-top:25px;">
                                <a href="{{ route('admin.users.index') }}" style="background-color:#1d4ed8; color:#fff; padding:12px 24px; border-radius:8px; text-decoration:none; font-weight:600;">
                                    Voir la demande
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
