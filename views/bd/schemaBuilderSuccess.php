<?php
/** @var string|null $title
 * @var string|null $message */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? "Sucesso") ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Paleta de Cores Baseada no Azul Original */
            --bg-base: #020617;
            --bg-glow: rgba(78, 161, 255, 0.15); /* Azul do fundo */

            --card-bg: rgba(15, 23, 42, 0.6);
            --card-border: rgba(255, 255, 255, 0.08);

            --primary-main: #4ea1ff; /* Azul Principal */
            --primary-hover: #3b82f6; /* Azul Escuro (Hover) */

            --success-color: #22c55e; /* Verde exclusivo para o ícone */

            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: var(--bg-base);
            /* Efeito de luz de fundo azulada */
            background-image:
                    radial-gradient(circle at 50% 0%, var(--bg-glow) 0%, transparent 50%),
                    radial-gradient(circle at 50% 100%, rgba(15, 23, 42, 1) 0%, var(--bg-base) 100%);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 480px;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .success-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 48px 32px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        }

        /* Linha brilhante no topo do card (Azul) */
        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-main), transparent);
            opacity: 0.6;
        }

        /* Wrapper do ícone mantém o tom esverdeado de sucesso */
        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(34, 197, 94, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            border: 1px solid rgba(34, 197, 94, 0.2);
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.2);
            animation: scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s forwards;
            opacity: 0;
            transform: scale(0.5);
        }

        .icon-wrapper svg {
            width: 40px;
            height: 40px;
            color: var(--success-color);
        }

        h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.025em;
            color: var(--text-main);
        }

        p.message {
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.6;
            margin-bottom: 36px;
        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 14px 24px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-main), var(--primary-hover));
            color: #ffffff;
            box-shadow: 0 4px 14px 0 rgba(78, 161, 255, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px 0 rgba(78, 161, 255, 0.35);
            filter: brightness(1.1);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-main);
            border-color: var(--card-border);
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.15);
            color: var(--primary-main);
        }

        footer {
            margin-top: 32px;
            font-size: 0.875rem;
            color: var(--text-muted);
            opacity: 0.7;
        }

        /* Animações */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.5); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Responsividade */
        @media (min-width: 480px) {
            .actions {
                flex-direction: row;
            }
        }
    </style>
</head>
<body>

<main class="container">
    <div class="success-card">

        <header>
            <div class="icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>

            <h1><?= htmlspecialchars($title ?? "Operação Concluída") ?></h1>

            <p class="message">
                <?= htmlspecialchars($message ?? "Sua ação foi realizada com sucesso e o sistema foi atualizado.") ?>
            </p>
        </header>

        <section class="actions">
            <a href="/bd/schemaCreate" class="btn btn-primary">Voltar</a>
        </section>

    </div>

    <footer style="text-align: center;">
        &copy; <?= date('Y') ?> • Sistema de Automação Postgres
    </footer>
</main>

</body>
</html>