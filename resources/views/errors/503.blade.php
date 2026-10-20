<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Maintenance — Khara Consulting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --red:#B70606; --ink:#262323; --bg:#FAF8F7; }
        * { box-sizing:border-box; margin:0; }
        body { background:var(--bg); color:var(--ink); font-family:'Manrope',system-ui,sans-serif; min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px; text-align:center; }
        .brand { font-family:'Playfair Display',serif; font-weight:800; font-size:clamp(2rem,6vw,3rem); color:var(--red); line-height:1; }
        h1 { font-family:'Playfair Display',serif; font-size:clamp(1.4rem,4vw,2rem); margin:16px 0 10px; }
        p { color:#5C5453; font-size:1.05rem; max-width:34rem; margin:0 auto; }
    </style>
</head>
<body>
    <div>
        <p class="brand">Khara Consulting</p>
        <h1>Site en maintenance</h1>
        <p>{{ $maintenanceMessage ?? 'Nous revenons très bientôt. Merci de votre patience.' }}</p>
    </div>
</body>
</html>
