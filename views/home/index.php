<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MiniFramework | Projeto Pessoal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-base: #020617;
            --bg-secondary: #0f172a;
            --card-bg: rgba(15, 23, 42, 0.4);
            --primary: #38bdf8;
            --primary-glow: rgba(56, 189, 248, 0.4);
            --accent: #818cf8; /* Tom complementar roxo/azulado */
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: var(--bg-base);
            background-image:
                    radial-gradient(circle at 15% 50%, rgba(56, 189, 248, 0.08), transparent 25%),
                    radial-gradient(circle at 85% 30%, rgba(129, 140, 248, 0.08), transparent 25%);
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 24px;
            overflow-x: hidden;
        }

        /* --- Navbar Superior --- */
        nav {
            width: 100%;
            max-width: 1000px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 0;
            margin-bottom: 40px;
            border-bottom: 1px solid var(--border);
        }

        .logo {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo svg {
            color: var(--primary);
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            color: var(--text-main);
            padding: 10px 20px;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
            box-shadow: 0 0 20px var(--primary-glow);
            transform: translateY(-2px);
        }

        /* --- Container Principal --- */
        .container {
            max-width: 1000px;
            width: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* --- Hero Section --- */
        .hero {
            text-align: center;
            margin-bottom: 64px;
            padding: 40px 0;
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(56, 189, 248, 0.1);
            border: 1px solid rgba(56, 189, 248, 0.2);
            color: var(--primary);
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        /* Texto com Gradiente Foda */
        .text-gradient {
            background: linear-gradient(135deg, var(--text-main) 0%, var(--primary) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* --- Grid de Módulos --- */
        .section-title {
            font-size: 1.1rem;
            color: var(--text-main);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 32px;
            text-decoration: none;
            color: var(--text-main);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(800px circle at var(--mouse-x, 50%) var(--mouse-y, -20%), rgba(56,189,248,0.1), transparent 40%);
            opacity: 0;
            transition: opacity 0.5s;
            z-index: 0;
        }

        .card:hover::before { opacity: 1; }

        .card:hover {
            transform: translateY(-5px);
            border-color: rgba(56, 189, 248, 0.4);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5), 0 0 20px rgba(56, 189, 248, 0.1);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            background: rgba(56, 189, 248, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            position: relative;
            z-index: 1;
        }

        .card-content {
            position: relative;
            z-index: 1;
        }

        .card h2 {
            font-size: 1.3rem;
            margin-bottom: 8px;
        }

        .card p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        footer {
            margin-top: auto;
            padding: 40px 0;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border);
            width: 100%;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero p { font-size: 1rem; }
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        DevEngine
    </div>
    <a href="/auth/login" class="btn-login">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
        Acessar Painel
    </a>
</nav>

<div class="container">

    <header class="hero">
        <div class="badge">🚀 Framework PHP v1.0</div>
        <h1>Bem-vindo ao <span class="text-gradient">MiniFramework</span></h1>
        <p>Um ecossistema caseiro construído do zero para automação, roteamento eficiente e gestão visual de banco de dados.</p>
    </header>

    <h3 class="section-title">Módulos Disponíveis</h3>

    <main class="grid">
        <a href="/bd/schemaBuilder" class="card">
            <div class="card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
            </div>
            <div class="card-content">
                <h2>Schema Builder</h2>
                <p>Definição da estrutura do banco de dados de forma visual e intuitiva diretamente no PostgreSQL.</p>
            </div>
        </a>

    </main>

</div>

<footer>
    &copy; <?= date('Y') ?> • MiniFramework - Projeto PHP Caseiro
</footer>

<script>
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
</script>

</body>
</html>