<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paiement échoué</title>
</head>
<body style="font-family: system-ui, sans-serif; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; background:#111;">
    <div style="background:#fff; border-radius:20px; padding:32px 24px; max-width:380px; text-align:center;">
        <div style="font-size:42px;">❌</div>
        <h2>Le paiement a échoué</h2>
        <p style="color:#555; font-size:14px;">{{ request('reason', 'Une erreur est survenue pendant le paiement.') }}</p>
        <a href="{{ route('access.index') }}" style="display:inline-block; margin-top:18px; background:#e0602a; color:#fff; text-decoration:none; padding:14px 22px; border-radius:12px; font-weight:700;">Réessayer</a>
    </div>
</body>
</html>