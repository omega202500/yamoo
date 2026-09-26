<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accès au Groupe Privé — Yamoo</title>
    <style>
        body { margin:0; font-family: system-ui, sans-serif; }
        .bg-video {
            position: fixed; inset: 0; width: 100%; height: 100%;
            object-fit: cover; filter: blur(8px) brightness(0.7);
            z-index: -1;
        }
        .wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .card {
            background: #fff; border-radius: 20px; padding: 28px 22px;
            max-width: 380px; width: 100%; box-shadow: 0 10px 30px rgba(0,0,0,.25);
        }
        .title { color: #e0602a; font-weight: 700; font-size: 15px; margin-bottom: 4px; }
        .price { font-size: 22px; font-weight: 700; margin-bottom: 18px; }
        .price span { color: #e0602a; }
        .advantages { background: #fbeef4; border-radius: 14px; padding: 14px; margin-bottom: 20px; }
        .advantages h4 { margin: 0 0 10px; font-size: 14px; }
        .chip { display: inline-block; background: #fff; border-radius: 20px; padding: 6px 12px; font-size: 12.5px; margin: 3px 4px 0 0; }
        label { font-size: 13px; font-weight: 600; display:block; margin-bottom: 6px; }
        input[type=tel] {
            width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #f0c9a8;
            box-sizing: border-box; font-size: 15px; margin-bottom: 16px;
        }
        button {
            width: 100%; background: linear-gradient(90deg,#f7941d,#e0602a); color:#fff; border:none;
            padding: 16px; border-radius: 12px; font-size: 15px; font-weight: 700; cursor: pointer;
        }
        .divider { text-align:center; color:#999; font-size:12px; margin: 18px 0; }
        .note { border: 1px dashed #ddd; border-radius: 12px; padding: 14px; font-size: 12.5px; color:#555; text-align:center; }
        .error { color:#c0392b; font-size: 12.5px; margin-top: -10px; margin-bottom: 12px; }
    </style>
</head>
<body>
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/background.mp4') }}" type="video/mp4">
    </video>

    <div class="wrapper">
        <div class="card">
            <div class="title">Accès au Groupe Privé</div>
          <div class="price">Accès à seulement <span>{!! number_format($amount, 0, ',', '&nbsp;') !!} FCFA</span></div>

            <div class="advantages">
                <h4>🌟 Avantages Groupe Privé</h4>
                <span class="chip">👥 Communauté active</span>
                <span class="chip">📱 Échanges directs</span>
                <span class="chip">🎁 Contenu exclusif</span>
            </div>

            <form method="POST" action="{{ route('access.pay') }}">
                @csrf
                <label for="phone">Numéro de téléphone</label>
                <input type="tel" id="phone" name="phone" placeholder="Entrer votre numéro pour payer" required>
                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit">Payer et rejoindre le groupe<br>{!! number_format($amount, 0, ',', '&nbsp;') !!} FCFA</button>
            </form>

            <div class="divider">OU</div>

            <div class="note">
                Effectuez simplement le paiement.<br>
                Une fois celui-ci confirmé, vous serez automatiquement redirigé vers le groupe privé.<br><br>
                💬 Discussions · 📰 Actualités · 🤝 Networking
            </div>
        </div>
    </div>
</body>
</html>