
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskEasy | Gestor de tareas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            color: #263247;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 245px;
            min-height: 100vh;
            background: #172554;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 28px 18px;
        }

        .brand {
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 45px;
        }

        .brand span {
            color: #60a5fa;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 8px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #2563eb;
            color: white;
        }

        .main-content {
            margin-left: 245px;
            padding: 35px;
        }

        .stat-card, .content-card {
            background: white;
            border: 0;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(15, 23, 42, .05);
        }

        .stat-card {
            padding: 22px;
            height: 100%;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 21px;
        }

        .content-card {
            padding: 25px;
        }

        .task-item {
            border: 1px solid #e9edf5;
            border-radius: 12px;
            padding: 17px;
            margin-bottom: 12px;
        }

        .task-item:last-child {
            margin-bottom: 0;
        }

        .muted {
            color: #8490a3;
        }

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
        }

        .form-control, .form-select {
            padding: 11px 13px;
            border-color: #e2e8f0;
        }

        @media (max-width: 767px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding: 15px;
            }

            .brand {
                margin-bottom: 12px;
            }

            .sidebar nav {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }

            .sidebar a {
                margin: 0;
                padding: 8px 10px;
                font-size: 13px;
            }

            .main-content {
                margin-left: 0;
                padding: 20px 14px;
            }

            .content-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand"><i class="bi bi-check2-circle"></i> Task<span>Easy</span></div>

    <nav>
        <a href="{{ route('tasks.index') }}" class="active">
            <i class="bi bi-grid me-2"></i> Panel principal
        </a>
        <a href="#crear-tarea">
            <i class="bi bi-plus-circle me-2"></i> Nueva tarea
        </a>
        <a href="#lista-tareas">
            <i class="bi bi-list-task me-2"></i> Mis tareas
        </a>
    </nav>

    <div class="mt-5 small text-white-50">
        Organiza tu día.<br>
        Simplifica tus tareas.
    </div>
</aside>

<main class="main-content">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Panel principal</h2>
            <p class="muted mb-0">Administra tus actividades desde un solo lugar.</p>
        </div>
        <span class="badge text-bg-light p-3">
            <i class="bi bi-calendar3 me-1"></i>
            {{ now()->translatedFormat('d \d\e F \d\e Y') }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los siguientes datos:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Indicadores -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="muted mb-1">Total de tareas</p>
                        <h3 class="fw-bold mb-0">{{ $totalTasks }}</h3>
                    </div>
                    <div class="stat-icon bg-primary-subtle text-primary">
                        <i class="bi bi-list-task"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="muted mb-1">Pendientes</p>
                        <h3 class="fw-bold mb-0">{{ $pendingTasks }}</h3>
                    </div>
                    <div class="stat-icon bg-warning-subtle text-warning">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="muted mb-1">Completadas</p>
                        <h3 class="fw-bold mb-0">{{ $completedTasks }}</h3>
                    </div>
                    <div class="stat-icon bg-success-subtle text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="muted mb-1">Vencidas</p>
                        <h3 class="fw-bold mb-0">{{ $overdueTasks }}</h3>
                    </div>
                    <div class="stat-icon bg-danger-subtle text-danger">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <!-- Formulario -->
        <div class="col-lg-4" id="crear-tarea">
            <div class="content-card">
                <h5 class="fw-bold mb-1">
                    <i class="bi bi-plus-circle text-primary me-2"></i>
                    Nueva tarea
                </h5>
                <p class="muted small mb-4">Registra una actividad nueva.</p>

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Título</label>
                        <input type="text" name="title" class="form-control"
                               maxlength="150" value="{{ old('title') }}"
                               placeholder="Ej. Entregar actividad" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Descripción</label>
                        <textarea name="description" class="form-control" rows="3"
                                  placeholder="Describe la tarea...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Prioridad</label>
                        <select name="priority" class="form-select" required>
                            <option value="baja" {{ old('priority') == 'baja' ? 'selected' : '' }}>Baja</option>
                            <option value="media" {{ old('priority', 'media') == 'media' ? 'selected' : '' }}>Media</option>
                            <option value="alta" {{ old('priority') == 'alta' ? 'selected' : '' }}>Alta</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Fecha límite</label>
                        <input type="date" name="due_date" class="form-control"
                               value="{{ old('due_date') }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-plus-lg me-1"></i> Agregar tarea
                    </button>
                </form>
            </div>
        </div>

        <!-- Lista de tareas -->
        <div class="col-lg-8" id="lista-tareas">
            <div class="content-card">
                <div class="mb-3">
                    <h5 class="fw-bold mb-1">Mis tareas</h5>
                    <p class="muted small mb-0">Consulta, filtra y administra tus actividades.</p>
                </div>

                <form action="{{ route('tasks.index') }}" method="GET" class="row g-2 mb-4">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control"
                               value="{{ $search }}" placeholder="Buscar tarea...">
                    </div>

                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="pendiente" {{ $status == 'pendiente' ? 'selected' : '' }}>Pendientes</option>
                            <option value="completada" {{ $status == 'completada' ? 'selected' : '' }}>Completadas</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="priority" class="form-select">
                            <option value="">Prioridad</option>
                            <option value="baja" {{ $priority == 'baja' ? 'selected' : '' }}>Baja</option>
                            <option value="media" {{ $priority == 'media' ? 'selected' : '' }}>Media</option>
                            <option value="alta" {{ $priority == 'alta' ? 'selected' : '' }}>Alta</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-1">
                        <button class="btn btn-primary flex-grow-1" type="submit" title="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary" title="Limpiar">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </form>

                @forelse($tasks as $task)
                    <div class="task-item">
                        <div class="d-flex flex-wrap justify-content-between gap-2">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">
    <a href="{{ route('tasks.show', $task) }}"
       class="text-decoration-none text-dark">
        {{ $task->title }}
    </a>
</h6>

                                @if($task->description)
                                    <p class="muted small mb-2">{{ $task->description }}</p>
                                @endif

                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    @if($task->priority == 'alta')
                                        <span class="badge text-bg-danger">Prioridad alta</span>
                                    @elseif($task->priority == 'media')
                                        <span class="badge text-bg-warning">Prioridad media</span>
                                    @else
                                        <span class="badge text-bg-info">Prioridad baja</span>
                                    @endif

                                    @if($task->status == 'completada')
                                        <span class="badge text-bg-success">Completada</span>
                                    @else
                                        <span class="badge text-bg-secondary">Pendiente</span>
                                    @endif

                                    @if($task->due_date)
                                        <span class="small muted">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ $task->due_date->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-1">
                                <a href="{{ route('tasks.edit', $task) }}"
                                   class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-success" type="submit"
                                            title="Cambiar estado">
                                        <i class="bi bi-check2"></i>
                                    </button>
                                </form>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit"
                                            title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-clipboard-check display-4 text-secondary"></i>
                        <h6 class="fw-bold mt-3">No hay tareas para mostrar</h6>
                        <p class="muted small mb-0">Agrega una tarea o modifica los filtros de búsqueda.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <footer class="text-center muted small mt-4">
        TaskEasy · Organiza tus actividades de manera sencilla.
    </footer>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
