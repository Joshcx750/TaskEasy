
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tarea | TaskEasy</title>

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

        .content-card {
            background: white;
            border: 0;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(15, 23, 42, .05);
            padding: 30px;
            max-width: 750px;
        }

        .muted {
            color: #8490a3;
        }

        .form-control, .form-select {
            padding: 11px 13px;
            border-color: #e2e8f0;
        }

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
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
        <h2 class="fw-bold mb-1">Editar tarea</h2>
        <p class="muted mb-0">Modifica la información de tu actividad.</p>
    </div>

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

    <div class="content-card">

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Título</label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    maxlength="150"
                    value="{{ old('title', $task->title) }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Descripción</label>
                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                >{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Prioridad</label>
                    <select name="priority" class="form-select" required>
                        <option value="baja" {{ old('priority', $task->priority) == 'baja' ? 'selected' : '' }}>Baja</option>
                        <option value="media" {{ old('priority', $task->priority) == 'media' ? 'selected' : '' }}>Media</option>
                        <option value="alta" {{ old('priority', $task->priority) == 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Estado</label>
                    <select name="status" class="form-select" required>
                        <option value="pendiente" {{ old('status', $task->status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="completada" {{ old('status', $task->status) == 'completada' ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Fecha límite</label>
                <input
                    type="date"
                    name="due_date"
                    class="form-control"
                    value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                >
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-save me-1"></i> Guardar cambios
                </button>

                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Cancelar
                </a>
            </div>

        </form>
    </div>

    <footer class="text-center muted small mt-4">
        TaskEasy · Organiza tus actividades de manera sencilla.
    </footer>

</main>

</body>
</html>
