<?php
/** @var array $tables Lista de tabelas vindas do banco de dados */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schema View - Gerenciar Tabelas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-base: #020617;
            --card-bg: rgba(15, 23, 42, 0.6);
            --card-border: rgba(255, 255, 255, 0.08);
            --primary-main: #4ea1ff;
            --danger-color: #ef4444;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            min-height: 100vh;
            background-color: var(--bg-base);
            background-image: radial-gradient(circle at 50% 0%, rgba(78, 161, 255, 0.12) 0%, transparent 50%);
            color: var(--text-main);
            padding: 40px 20px;
        }

        .container { max-width: 800px; margin: 0 auto; }

        .back-link {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--text-muted); text-decoration: none; font-size: 0.9rem;
            margin-bottom: 24px; transition: all 0.2s;
        }
        .back-link:hover { color: var(--primary-main); transform: translateX(-4px); }

        header { margin-bottom: 32px; }
        header h1 { font-size: 1.8rem; font-weight: 700; margin-bottom: 8px; }
        header p { color: var(--text-muted); }

        /* Estilização da Tabela/Lista */
        .table-container {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .table-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            border-bottom: 1px solid var(--card-border);
            transition: background 0.2s;
        }
        .table-row:last-child { border-bottom: none; }
        .table-row:hover { background: rgba(255, 255, 255, 0.02); }

        .table-info { display: flex; align-items: center; gap: 16px; }
        .table-icon {
            color: var(--primary-main);
            background: rgba(78, 161, 255, 0.1);
            padding: 8px; border-radius: 8px;
        }

        .table-name { font-weight: 500; font-size: 1rem; color: var(--text-main); }

        /* Botão Deletar */
        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-delete:hover {
            background: var(--danger-color);
            color: white;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.4);
        }

        .empty-state {
            padding: 48px;
            text-align: center;
            color: var(--text-muted);
        }

        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

<div class="container">
    <a href="/bd/schemaBuilder" class="back-link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
        Voltar para Schema Builder
    </a>

    <header>
        <h1>Gerenciar Tabelas</h1>
        <p>Visualize a estrutura atual e remova tabelas do Postgres</p>
    </header>

    <main class="table-container">
        <?php if (!empty($tables)): ?>
            <?php foreach ($tables as $table): ?>
                <div class="table-row">
                    <div class="table-info">
                        <div class="table-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 3h18v18H3zM3 9h18M9 3v18"></path>
                            </svg>
                        </div>
                        <span class="table-name"><?= htmlspecialchars($table) ?></span>
                    </div>

                    <form action="/bd/schemaDelete" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar a tabela <?= $table ?>?');">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="table_name" value="<?= htmlspecialchars($table) ?>">
                        <button type="submit" class="btn-delete">
                            Deletar
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <p>Nenhuma tabela encontrada no schema.</p>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        &copy; <?= date('Y') ?> • Sistema de Automação Postgres
    </footer>
</div>

</body>
</html>