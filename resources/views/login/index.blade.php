<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Acervo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg:           #0f172a;
            --bg2:          #1e293b;
            --bg3:          #334155;
            --surface:      #1e293b;
            --border:       #334155;
            --border-light: #475569;
            --text:         #f1f5f9;
            --text-muted:   #94a3b8;
            --blue:         #38bdf8;
            --blue-dark:    #0ea5e9;
            --blue-glow:    rgba(56,189,248,0.15);
            --blue-deep:    #0284c7;
            --green:        #34d399;
            --green-bg:     rgba(52,211,153,0.12);
            --red:          #f87171;
            --red-bg:       rgba(248,113,113,0.12);
            --amber:        #fbbf24;
            --amber-bg:     rgba(251,191,36,0.12);
            --purple:       #c084fc;
            --purple-bg:    rgba(192,132,252,0.12);
            --white:        #ffffff;
            --radius:       8px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { font-size: 16px; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            line-height: 1.5;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: var(--bg2);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            height: 60px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 20px rgba(0,0,0,0.4);
        }

        .topbar-brand {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: 0.04em;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .topbar-brand .dot {
            width: 8px; height: 8px;
            background: var(--blue);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--blue);
            display: inline-block;
        }

        .topbar-nav { display: flex; align-items: center; gap: 0.75rem; }

        .btn-nav {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.4rem 0.9rem;
            border-radius: var(--radius);
            transition: all 0.2s;
        }
        .btn-nav:hover { color: var(--text); background: var(--bg3); }

        /* ── CONTAINER ── */
        .container {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* ── ALERTS ── */
        .alert {
            padding: 0.85rem 1.2rem;
            margin-bottom: 1.25rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            border-radius: var(--radius);
            font-weight: 500;
            animation: slideDown 0.3s ease both;
        }

        .alert-success {
            background: var(--green-bg);
            border: 1px solid rgba(52,211,153,0.3);
            color: var(--green);
        }

        .alert-error {
            background: var(--red-bg);
            border: 1px solid rgba(248,113,113,0.3);
            color: var(--red);
        }

        /* ── FILTERS ── */
        .filters-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .filter-group { flex: 1; min-width: 180px; }

        .filter-input {
            width: 100%;
            background: var(--bg2);
            border: 1px solid var(--border);
            color: var(--text);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            padding: 0.65rem 1rem;
            border-radius: var(--radius);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .filter-input::placeholder { color: var(--text-muted); }
        .filter-input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px var(--blue-glow);
        }

        .btn-filter {
            background: var(--blue);
            border: none;
            color: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.68rem 1.4rem;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-filter:hover { background: var(--blue-dark); box-shadow: 0 0 16px var(--blue-glow); }

        .btn-clear {
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            padding: 0.68rem 0.75rem;
            border-radius: var(--radius);
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-clear:hover { color: var(--red); background: var(--red-bg); }

        /* ── GRID ── */
        .grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 1.5rem;
            align-items: start;
        }

        /* ── TABLE CARD ── */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            animation: fadeUp 0.4s ease both;
        }

        .table-card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg2);
        }

        .table-card-title {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text);
        }

        .badge {
            background: var(--blue-glow);
            color: var(--blue);
            border: 1px solid rgba(56,189,248,0.25);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.2rem 0.65rem;
            border-radius: 20px;
        }

        /* ── TABLE SCROLL ── */
        .table-scroll {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.82rem;
            min-width: 700px;
        }

        thead tr { background: rgba(51,65,85,0.5); }

        th {
            text-align: left;
            padding: 0.7rem 1rem;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            white-space: nowrap;
        }

        td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            color: var(--text);
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr { transition: background 0.15s; }
        tbody tr:hover { background: rgba(56,189,248,0.04); }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.2rem 0.6rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-disponivel { background: var(--green-bg); color: var(--green); }
        .status-emprestado { background: var(--amber-bg); color: var(--amber); }
        .status-reservado  { background: var(--purple-bg); color: var(--purple); }

        .id-cell {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .name-cell { font-weight: 600; }

        .actions { display: flex; gap: 0.4rem; }

        .btn-edit, .btn-delete {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            border: 1px solid;
            cursor: pointer;
            background: transparent;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-edit  { border-color: rgba(56,189,248,0.35); color: var(--blue); }
        .btn-edit:hover { background: var(--blue); color: var(--bg); }

        .btn-delete { border-color: rgba(248,113,113,0.35); color: var(--red); }
        .btn-delete:hover { background: var(--red); color: var(--white); }

        .empty-row td {
            text-align: center;
            color: var(--text-muted);
            padding: 3.5rem;
            font-size: 0.85rem;
        }

        /* ── PAGINATION ── */
        .pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.9rem 1.25rem;
            border-top: 1px solid var(--border);
            background: var(--bg2);
            gap: 1rem;
            flex-wrap: wrap;
        }

        .pagination-info {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .pagination-links { display: flex; align-items: center; gap: 0.25rem; }

        .pagination-links a,
        .pagination-links span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2rem;
            height: 2rem;
            padding: 0 0.4rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.15s;
            color: var(--text-muted);
            background: var(--bg2);
        }

        .pagination-links a:hover {
            background: var(--blue);
            color: var(--bg);
            border-color: var(--blue);
        }

        .pagination-links span.active {
            background: var(--blue);
            color: var(--bg);
            border-color: var(--blue);
            font-weight: 700;
        }

        .pagination-links span.disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        /* ── FORM CARD ── */
        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            animation: fadeUp 0.4s 0.1s ease both;
            position: sticky;
            top: 76px;
        }

        .form-card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, var(--blue-glow), transparent);
        }

        .form-card-title {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--blue);
        }

        .form-body { padding: 1.25rem; }

        .form-group { margin-bottom: 1rem; }

        label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.35rem;
        }

        input[type="text"],
        input[type="number"],
        input[type="hidden"],
        textarea,
        select {
            width: 100%;
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem;
            padding: 0.65rem 0.9rem;
            border-radius: var(--radius);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            resize: vertical;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px var(--blue-glow);
        }

        input::placeholder, textarea::placeholder { color: var(--text-muted); opacity: 0.6; }
        
        select option { background: var(--bg2); color: var(--text); }

        .btn-submit {
            width: 100%;
            background: var(--blue);
            border: none;
            color: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 0.85rem;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            background: var(--blue-dark);
            box-shadow: 0 0 20px var(--blue-glow);
        }

        .btn-cancel {
            width: 100%;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-muted);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.7rem;
            border-radius: var(--radius);
            cursor: pointer;
            margin-top: 0.5rem;
            transition: all 0.2s;
        }
        .btn-cancel:hover { border-color: var(--text-muted); color: var(--text); }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15,23,42,0.8);
            backdrop-filter: blur(4px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
        }

        .modal-overlay.active { opacity: 1; pointer-events: all; }

        .modal {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            transform: translateY(20px) scale(0.97);
            transition: transform 0.25s;
            box-shadow: 0 24px 80px rgba(0,0,0,0.5);
        }

        .modal-overlay.active .modal { transform: translateY(0) scale(1); }

        .modal-title {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .modal-text {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 1.75rem;
            line-height: 1.6;
        }

        .modal-text strong { color: var(--text); }

        .modal-actions { display: flex; gap: 0.75rem; }
        .modal-actions .btn-submit { margin-top: 0; background: var(--red); }
        .modal-actions .btn-submit:hover { background: #ef4444; box-shadow: 0 0 16px var(--red-bg); }
        .modal-actions .btn-cancel { margin-top: 0; flex: 1; }
        .modal-actions form { flex: 1; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .grid { grid-template-columns: 1fr; }
            .form-card { position: static; }
        }

        @media (max-width: 640px) {
            .container { padding: 1rem; }
            .topbar { padding: 0 1rem; }
            .page-title { font-size: 1.3rem; }
        }

        /* ── ANIMATIONS ── */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<nav class="topbar">
    <div class="topbar-brand">
        <span class="dot"></span>
        SISTEMA
    </div>
    <div class="topbar-nav">
        <a href="{{ route('dashboard.index') }}" class="btn-nav">Acervo</a>
    </div>
</nav>

<div class="container">

    @if (session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">✕ {{ $errors->first() }}</div>
    @endif

    {{-- ── FILTROS ── --}}
    <form method="GET" action="{{ route('dashboard.index') }}" class="filters-bar">
        <div class="filter-group">
            <input
                type="text"
                name="nome"
                placeholder="Buscar por título ou nome…"
                value="{{ request('nome') }}"
                class="filter-input"
            >
        </div>
        <button type="submit" class="btn-filter">Filtrar</button>
        @if(request('nome') || request('status'))
            <a href="{{ route('dashboard.index') }}" class="btn-clear">✕ Limpar</a>
        @endif
    </form>

    <div class="grid">

        {{-- ── TABELA ── --}}
        <div class="table-card">
            <div class="table-card-header">
                <span class="table-card-title">Itens cadastrados</span>
                <span class="badge">{{ $estoques->total() }} itens</span>
            </div>

            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Gênero</th>
                            <th>Páginas</th>
                            <th>Ano</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($estoques as $item)
                            @php
                                $statusClass = 'status-disponivel';
                                if($item->status == 'Emprestado') $statusClass = 'status-emprestado';
                                if($item->status == 'Reservado') $statusClass = 'status-reservado';
                            @endphp
                            <tr>
                                <td class="id-cell">#{{ $item->id }}</td>
                                <td class="name-cell">{{ $item->titulo ?? $item->nome }}</td>
                                <td>{{ $item->autor }}</td>
                                <td>{{ $item->genero }}</td>
                                <td>{{ $item->quantidade_paginas }}</td>
                                <td>{{ $item->ano_publicacao }}</td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">{{ $item->status }}</span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <button
                                            class="btn-edit"
                                            onclick="fillEdit(
                                                {{ $item->id }},
                                                '{{ addslashes($item->titulo ?? $item->nome) }}',
                                                '{{ addslashes($item->autor) }}',
                                                '{{ addslashes($item->genero) }}',
                                                {{ $item->quantidade_paginas ?? 0 }},
                                                '{{ addslashes($item->ano_publicacao) }}',
                                                '{{ addslashes($item->status) }}'
                                            )"
                                        >Editar</button>
                                        <button
                                            class="btn-delete"
                                            onclick="openDelete({{ $item->id }}, '{{ addslashes($item->titulo ?? $item->nome) }}')"
                                        >Excluir</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="8">Nenhum item encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ── PAGINAÇÃO ── --}}
            @if ($estoques->hasPages())
                <div class="pagination-wrap">
                    <span class="pagination-info">
                        Exibindo {{ $estoques->firstItem() }}–{{ $estoques->lastItem() }}
                        de {{ $estoques->total() }} itens
                    </span>
                    <div class="pagination-links">
                        @if ($estoques->onFirstPage())
                            <span class="disabled">&lsaquo;</span>
                        @else
                            <a href="{{ $estoques->appends(request()->query())->previousPageUrl() }}">&lsaquo;</a>
                        @endif

                        @foreach ($estoques->appends(request()->query())->getUrlRange(1, $estoques->lastPage()) as $page => $url)
                            @if ($page == $estoques->currentPage())
                                <span class="active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($estoques->hasMorePages())
                            <a href="{{ $estoques->appends(request()->query())->nextPageUrl() }}">&rsaquo;</a>
                        @else
                            <span class="disabled">&rsaquo;</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- ── FORMULÁRIO ── --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title" id="form-title">+ Novo Item</div>
            </div>
            <div class="form-body">
                <form id="item-form" method="POST" action="{{ route('estoque.store') }}">
                    @csrf
                    <input type="hidden" name="_method"    id="form-method"    value="POST">
                    <input type="hidden" name="estoque_id" id="form-estoque-id" value="">

                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo"
                               value="{{ old('titulo') }}" placeholder="Título da obra" required>
                    </div>
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" id="autor" name="autor"
                               value="{{ old('autor') }}" placeholder="Nome do autor" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Gênero</label>
                        <input type="text" id="genero" name="genero"
                               value="{{ old('genero') }}" placeholder="Gênero literário" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="" disabled selected>Selecione um status...</option>
                            <option value="Disponivel" {{ old('status') == 'Disponivel' ? 'selected' : '' }}>Disponível</option>
                            <option value="Emprestado" {{ old('status') == 'Emprestado' ? 'selected' : '' }}>Emprestado</option>
                            <option value="Reservado"  {{ old('status') == 'Reservado'  ? 'selected' : '' }}>Reservado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantidade_paginas">Quantidade de Páginas</label>
                        <input type="number" id="quantidade_paginas" name="quantidade_paginas"
                               value="{{ old('quantidade_paginas') }}" placeholder="0" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="ano_publicacao">Ano de Publicação</label>
                        <input type="text" id="ano_publicacao" name="ano_publicacao"
                               value="{{ old('ano_publicacao') }}" placeholder="Ex: 2024" maxlength="8" required>
                    </div>

                    <button type="submit" class="btn-submit" id="btn-submit-label">Cadastrar Item</button>
                    <button type="button" class="btn-cancel" id="btn-cancel"
                            style="display:none" onclick="resetForm()">Cancelar edição</button>
                </form>
            </div>
        </div>

    </div>
</div>

{{-- ── MODAL DE EXCLUSÃO ── --}}
<div class="modal-overlay" id="delete-modal">
    <div class="modal">
        <div class="modal-title">Excluir item</div>
        <p class="modal-text">
            Tem certeza que deseja excluir <strong id="delete-name"></strong>?
            Esta ação não pode ser desfeita.
        </p>
        <div class="modal-actions">
            <form id="delete-form" method="POST" style="flex:1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-submit">Excluir</button>
            </form>
            <button class="btn-cancel" onclick="closeDelete()">Cancelar</button>
        </div>
    </div>
</div>

<script>
    const storeUrl = "{{ route('estoque.store') }}";

    function fillEdit(id, titulo, autor, genero, paginas, ano, status) {
        document.getElementById('form-title').textContent       = '✎ Editar Item';
        document.getElementById('btn-submit-label').textContent = 'Salvar alterações';
        document.getElementById('btn-cancel').style.display     = 'block';
        
        document.getElementById('form-estoque-id').value        = id;
        document.getElementById('titulo').value                 = titulo;
        document.getElementById('autor').value                  = autor;
        document.getElementById('genero').value                 = genero;
        document.getElementById('quantidade_paginas').value     = paginas;
        document.getElementById('ano_publicacao').value         = ano;
        document.getElementById('status').value                 = status;
        
        document.getElementById('item-form').action  = `/estoque/${id}`;
        document.getElementById('form-method').value = 'PUT';
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function resetForm() {
        document.getElementById('form-title').textContent       = '+ Novo Item';
        document.getElementById('btn-submit-label').textContent = 'Cadastrar Item';
        document.getElementById('btn-cancel').style.display     = 'none';
        
        document.getElementById('item-form').reset();
        document.getElementById('item-form').action  = storeUrl;
        document.getElementById('form-method').value = 'POST';
    }

    function openDelete(id, titulo) {
        document.getElementById('delete-name').textContent = titulo;
        document.getElementById('delete-form').action      = `/estoque/${id}`;
        document.getElementById('delete-modal').classList.add('active');
    }

    function closeDelete() {
        document.getElementById('delete-modal').classList.remove('active');
    }

    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) closeDelete();
    });
</script>

</body>
</html>