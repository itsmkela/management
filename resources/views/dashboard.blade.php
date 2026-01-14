<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartSchool - School Management System</title>

    <!-- Bootstrap 5 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #2c3e50, #1a252f);
            color: #fff;
            padding-top: 80px;
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            color: #bdc3c7;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 15px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }
        .sidebar .nav-link i {
            width: 30px;
            font-size: 1.2rem;
        }
        .topbar {
            height: 70px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            z-index: 999;
            padding: 0 25px;
        }
        .main-content {
            margin-left: 260px;
            padding: 90px 25px 25px;
            min-height: 100vh;
        }
        .stat-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-8px);
        }
        .gradient-1 { background: linear-gradient(135deg, #667eea, #764ba2); }
        .gradient-2 { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .gradient-3 { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .gradient-4 { background: linear-gradient(135deg, #43e97b, #38f9d7); }

        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .sidebar .logo-text,
            .sidebar .text { display: none; }
            .topbar, .main-content { margin-left: 80px; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4 px-3">
            <h4 class="text-white fw-bold logo-text">SmartSchool</h4>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="#">
                <i class="bi bi-speedometer2"></i> <span class="text">Dashboard</span>
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-mortarboard"></i> <span class="text">Students</span>
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-person-workspace"></i> <span class="text">Teachers</span>
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-building"></i> <span class="text">Departments</span>
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-journal-text"></i> <span class="text">Classes</span>
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-calendar-check"></i> <span class="text">Attendance</span>
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-clipboard-data"></i> <span class="text">Exams & Grades</span>
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-bell"></i> <span class="text">Notices</span>
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-gear"></i> <span class="text">Settings</span>
            </a>
        </nav>
    </div>

    <!-- Topbar -->
    <div class="topbar d-flex align-items-center justify-content-between">
        <form class="d-flex flex-grow-1 me-4">
            <input class="form-control" type="search" placeholder="Search students, teachers, classes..." aria-label="Search">
        </form>

        <div class="d-flex align-items-center gap-3">
            <!-- Notifications -->
            <div class="dropdown">
                <a class="text-dark text-decoration-none position-relative" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-bell fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">New admission request</a></li>
                    <li><a class="dropdown-item" href="#">Fee payment overdue</a></li>
                    <li><a class="dropdown-item" href="#">Parent meeting scheduled</a></li>
                </ul>
            </div>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a class="d-flex align-items-center text-dark text-decoration-none" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="https://via.placeholder.com/40" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="40">
                    <span class="fw-semibold">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="#" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="mb-4">Welcome back, {{ Auth::user()->name ?? 'Admin' }}!</h2>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card text-white gradient-1">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
    <h5 class="mb-1">Total Students</h5>
    <h3 class="mb-0">{{ number_format($totalStudents) }}</h3>

</div>

                            <i class="bi bi-people fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card text-white gradient-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Teachers</h5>
                                <h3 class="mb-0">142</h3>
                            </div>
                            <i class="bi bi-person-badge fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card text-white gradient-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Today's Attendance</h5>
                                <h3 class="mb-0">97.3%</h3>
                            </div>
                            <i class="bi bi-check-circle fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card text-white gradient-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Active Classes</h5>
                                <h3 class="mb-0">68</h3>
                            </div>
                            <i class="bi bi-book fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Admissions + Quick Actions -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Recent Admissions</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
    @forelse ($recentStudents as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>
                {{ $student->class ?? 'N/A' }}
            </td>
            <td>{{ $student->created_at->format('d M Y') }}</td>
            <td>
                <span class="badge bg-success">Active</span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center text-muted">
                No students found
            </td>
        </tr>
    @endforelse
</tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="#" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i> Add Student
                            </a>
                            <a href="#" class="btn btn-success">
                                <i class="bi bi-person-check"></i> Mark Attendance
                            </a>
                            <a href="#" class="btn btn-info text-white">
                                <i class="bi bi-bell"></i> Send Notice
                            </a>
                            <a href="#" class="btn btn-warning text-white">
                                <i class="bi bi-file-earmark-text"></i> Generate Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>