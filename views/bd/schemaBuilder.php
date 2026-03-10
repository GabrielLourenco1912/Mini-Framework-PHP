<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Projeto Pessoal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --bg: #0f172a;
            --card: #020617;
            --primary: #38bdf8;
            --text: #e5e7eb;
            --muted: #94a3b8;
            --border: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #020617, #0f172a);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .container {
            max-width: 900px;
            width: 100%;
        }

        header {
            margin-bottom: 32px;
        }

        header h1 {
            font-size: 2.2rem;
            margin-bottom: 8px;
            color: white;
        }

        header p {
            color: var(--muted);
        }
        .back-link {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--muted); text-decoration: none; font-size: 0.9rem;
            margin-bottom: 28px; transition: color .2s ease;
        }
        .back-link:hover { color: var(--primary); transform: translateX(-4px); }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: linear-gradient(180deg, var(--card), #020617);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 24px;
            text-decoration: none;
            color: var(--text);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(56,189,248,0.15), transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .card:hover::before {
            opacity: 1;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(56,189,248,0.15);
        }

        .card h2 {
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .card p {
            font-size: 0.95rem;
            color: var(--muted);
        }

        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.85rem;
            color: var(--muted);
        }
    </style>
</head>
<body>

<div class="container">
    <a href="/" class="back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
        Voltar para Home
    </a>

    <header>
        <h1>Schema Builder</h1>
        <p>Acesso rápido aos módulos do schema builder</p>
    </header>

    <main class="grid">
        <a href="/bd/schemaCreate" class="card">
            <h2>Schema Create</h2>
            <p>Geração de tabelas.</p>
        </a>
        <a href="/bd/schemaView" class="card">
            <h2>Schema View</h2>
            <p>Visualização e remoção de tabelas.</p>
        </a>

    </main>

    <footer>
        &copy; <?= date('Y') ?> • Sistema de Automação Postgres
    </footer>
</div>

</body>
</html>
