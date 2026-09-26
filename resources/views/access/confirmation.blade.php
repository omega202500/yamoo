<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation de paiement — Yamoo</title>
    <style>
        body { margin:0; font-family: system-ui, sans-serif; }
        .bg-video {
            position: fixed; inset: 0; width: 100%; height: 100%;
            object-fit: cover; filter: blur(8px) brightness(0.7);
            z-index: -1;
        }
        .wrapper { min-height: 100vh; display:flex; align-items:center; justify-content:center; padding:24px; }
        .card {
            background:#fff; border-radius:20px; padding:32px 24px;
            max-width:380px; width:100%; text-align:center;
            box-shadow: 0 10px 30px rgba(0,0,0,.25);
        }
        .icon { font-size:42px; margin-bottom:12px; }
        h2 { margin:0 0 10px; }
        p { color:#555; font-size:14px; }
        .btn {
            display:inline-block; margin-top:18px; background:#25D366; color:#fff;
            text-decoration:none; padding:14px 22px; border-radius:12px; font-weight:700;
        }
        .pending { color:#e0602a; font-weight:600; }
    </style>
    @if(!$payment || $payment->status === 'pending')
    <meta http-equiv="refresh" content="4">
    @endif
</head>
<body>
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/background.mp4') }}" type="video/mp4">
    </video>

    <div class="wrapper">
        <div class="card">
            @if($payment && $payment->status === 'success')
                <div class="icon">✅</div>
                <h2>Paiement confirmé !</h2>
                <p>Vous allez être redirigé vers notre groupe WhatsApp.</p>
                <a class="btn" href="{{ $whatsappLink }}">Rejoindre le groupe WhatsApp</a>
            @elseif($payment && $payment->status === 'failed')
                <div class="icon">❌</div>
                <h2>Le paiement a échoué</h2>
                <p>Réessayez avec un autre numéro ou opérateur.</p>
                <a class="btn" style="background:#e0602a;" href="{{ route('access.index') }}">Réessayer</a>
            @else
                <div class="icon">⏳</div>
                <h2 class="pending">Vérification du paiement…</h2>
                <p>Merci de patienter, cette page se met à jour automatiquement.</p>
            @endif
        </div>
    </div>
</body>
</html>