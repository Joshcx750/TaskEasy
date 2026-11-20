
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskEasy | Gestor de tareas</title>

    <!-- Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f6fa;
            color: #25263a;
        }

        .sidebar {
            min-height: 100vh;
            background: #29264b;
            color: white;
            padding: 30px 20px;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 45px;
        }

        .brand span {
            color: #a99aff;
        }

        .menu-link {
            display: block;
            color: #c8c5df;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 8px;
        }

        .menu-link.active,
        .menu-link:hover {
            background: #514b80;
            color: white;
        }

        .main-content {
            padding: 35px;
        }

        .stat-card, .task-card {
            background: white;
            border: none;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 3px 15px rgba(0,0,0,.03);
        }

        .stat-number {
            font-size: 30px;
            font-weight: 800;
        }

        .task-card {
            margin-bottom: 13px;
        }

        .priority {
            font-size: 12px;
            border-radius: 20px;
            padding: 6px 12px;
        }

        .priority-high {
            background: #ffe2e2;
            color: #c0392b;
        }

        .priority-medium {
            background: #fff0cf;
            color: #a66a00;
        }

        .priority-low {
            background: #dcf5e7;
            color: #23834d;
        }

        .welcome-text {
            color: #77788a;
        }

        @media (max-width: 767px) {
            .sidebar {
                min-height: auto;
                padding: 18px;
            }

            .brand {
                margin-bottom: 15px;
            }

            .main-content {
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- Menú lateral -->
        <aside class="col-md-3 col-lg-2 sidebar">

            <div class="brand">
                Task<span>Easy</span>
            </div>

            <a href="#" class="menu-link active">▦ &nbsp; Dashboard</a>
            <a href="#" class="menu-link">☑ &nbsp; Mis tareas</a>
            <a href="#" class="menu-link">◷ &nbsp; Pendientes</a>
            <a href="#" class="menu-link">✓ &nbsp; Completadas</a>

            <hr style="border-color: #625e82;">

            <div class="small text-white-50 mt-4">
                Organiza tu día, simplifica tu vida.
            </div>

        </aside>

        <!-- Contenido principal -->
        <main class="col-md-9 col-lg-10 main-content">

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">

                <div>
                    <h2 class="fw-bold mb-1">Mi Dashboard</h2>
                    <p class="welcome-text mb-0">
                        Bienvenido a TaskEasy. Organiza tus actividades.
                    </p>
                </div>

                <button class="btn btn-primary px-4" style="background:#6657c8;border:0;">
                    + Nueva tarea
                </button>

            </div>

            <!-- Estadísticas -->
            <div class="row g-3 mb-4">

                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="welcome-text">Total de tareas</div>
                        <div class="stat-number">12</div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="welcome-text">Pendientes</div>
                        <div class="stat-number text-warning">5</div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="welcome-text">Completadas</div>
                        <div class="stat-number text-success">7</div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="welcome-text">Vencidas</div>
                        <div class="stat-number text-danger">2</div>
                    </div>
                </div>

            </div>

            <!-- Lista de tareas -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">Mis tareas recientes</h4>
                <a href="#" class="text-decoration-none">Ver todas</a>
            </div>

            <div class="task-card d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h6 class="fw-bold mb-1">Terminar proyecto escolar</h6>
                    <small class="welcome-text">Fecha límite: 25 de noviembre</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="priority priority-high">Alta</span>
                    <span class="badge bg-warning-subtle text-warning-emphasis">Pendiente</span>
                </div>
            </div>

            <div class="task-card d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h6 class="fw-bold mb-1">Revisar correos pendientes</h6>
                    <small class="welcome-text">Fecha límite: 22 de noviembre</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="priority priority-medium">Media</span>
                    <span class="badge bg-warning-subtle text-warning-emphasis">Pendiente</span>
                </div>
            </div>

            <div class="task-card d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h6 class="fw-bold mb-1">Organizar documentos</h6>
                    <small class="welcome-text">Fecha límite: 20 de noviembre</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="priority priority-low">Baja</span>
                    <span class="badge bg-success-subtle text-success-emphasis">Completada</span>
                </div>
            </div>

            <!-- Enlaces externos -->
            <div class="mt-4 p-3 bg-white rounded-4">
                <h6 class="fw-bold">Recursos útiles</h6>
                <a href="https://drive.google.com/" target="_blank" rel="noopener noreferrer">
                    Google Drive
                </a>
                <span class="text-secondary mx-2">|</span>
                <a href="https://fonts.google.com/" target="_blank" rel="noopener noreferrer">
                    Google Fonts
                </a>
            </div>

            <footer class="text-center mt-5 welcome-text small">
                TaskEasy © 2026 | Organiza tus tareas fácilmente.
            </footer>

        </main>

    </div>
</div>

</body>
</html>
