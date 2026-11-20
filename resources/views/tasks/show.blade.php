<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de tarea | TaskEasy</title>

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

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main-content {
            margin-left: 245px;
            padding: 35px;
        }

        .content-card {
            background: white;
            border: 0;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(15, 23, 42, .05);
            padding: 30px;
            max-width: 850px;
        }

        .detail-label {
            color: #8490a3;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .detail-value {
            font-weight: 600;
            margin-bottom: 25px;
        }

        .description {
            background: #f5f7fb;
            padding: 18px;
            border-radius: 10px;
            min-height: 80px;
            white-space: pre-wrap;
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

            .sidebar a {
                display: inline-block;
                margin: 0;
                padding: 8px 10px;
                font-size: 13px;
            }

            .main-content {
                margin-left: 0;
                padding: 20px 14px;
            }

            .content-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand"><i class="bi bi-check2-circle"></i> Task<span>Easy</span></div>

    <nav>
        <a href="{{ route('tasks.index') }}">
            <i class="bi bi-grid me-2"></i> Panel principal
        </a>
        <a href="{{ route('tasks.index') }}#crear-tarea">
            <i class="bi bi-plus-circle me-2"></i> Nueva tarea
        </a>
        <a href="{{ route('tasks.index') }}#lista-tareas">
            <i class="bi bi-list-task me-2"></i> Mis tareas
        </a>
    </nav>
</aside>

<main class="main-content">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Detalle de tarea</h2>
        <p class="text-secondary mb-0">Consulta toda la información de esta actividad.</p>
    </div>

    <div class="content-card">

        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
            <div>
                <span class="text-primary small fw-semibold">TAREA #{{ $task->id }}</span>
                <h3 class="fw-bold mt-2">{{ $task->title }}</h3>
            </div>

            @if($task->status == 'completada')
                <span class="badge text-bg-success p-2">Completada</span>
            @else
                <span class="badge text-bg-secondary p-2">Pendiente</span>
            @endif
        </div>

        <hr>

        <div class="mb-4">
            <div class="detail-label">Descripción</div>
            <div class="description">{{ $task->description ?: 'Sin descripción registrada.' }}</div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-label">Prioridad</div>
                <div class="detail-value">
                    @if($task->priority == 'alta')
                        <span class="badge text-bg-danger">Alta</span>
                    @elseif($task->priority == 'media')
                        <span class="badge text-bg-warning">Media</span>
                    @else
                        <span class="badge text-bg-info">Baja</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-label">Fecha límite</div>
                <div class="detail-value">
                    {{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Sin fecha límite' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-label">Fecha de creación</div>
                <div class="detail-value">
                    {{ $task->created_at->format('d/m/Y H:i') }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-label">Última actualización</div>
                <div class="detail-value">
                    {{ $task->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>

        <hr>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary px-4">
                <i class="bi bi-pencil me-1"></i> Editar tarea
            </a>

            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left me-1"></i> Volver al panel
            </a>
        </div>

    </div>

    <footer class="text-center text-secondary small mt-4">
        TaskEasy · Organiza tus actividades de manera sencilla.
    </footer>

</main>

</body>
</html>
