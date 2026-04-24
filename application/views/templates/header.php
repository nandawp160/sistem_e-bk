<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?> | E-BK SMA NEGERI 1 PRESTASI</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <style>
        :root {
            --warna-utama: #fd7e14; /* Oranye */
            --warna-gelap: #343a40;
            --warna-terang: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--warna-terang);
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background-color: var(--warna-utama);
            color: white;
            transition: all 0.3s;
            position: fixed;
            z-index: 1000;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.1);
            text-align: center;
        }

        #sidebar .sidebar-header img {
            width: 60px;
            margin-bottom: 10px;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 12px 25px;
            font-size: 0.95rem;
            display: block;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: 0.3s;
        }

        #sidebar ul li a:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
        }

        #sidebar ul li.active > a {
            color: #fff;
            background: rgba(0,0,0,0.1);
            font-weight: 600;
            border-left: 4px solid white;
        }

        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        #content {
            width: calc(100% - 250px);
            margin-left: 250px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .navbar {
            padding: 15px 30px;
            background: #fff;
            border: none;
            border-radius: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .main-content {
            padding: 30px;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 15px 25px;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
        }

        .btn-utama {
            background-color: var(--warna-utama);
            color: white;
            border: none;
        }

        .btn-utama:hover {
            background-color: #e86b00;
            color: white;
        }

        .text-oranye {
            color: var(--warna-utama);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #bbb;
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <div class="spinner-border text-utama" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h5 class="mt-3 fw-bold text-secondary animate-pulse">E-BK</h5>
        </div>
    </div>

    <style>
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s;
        }
        #preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }
        .loader {
            text-align: center;
        }
        .animate-pulse {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0.5; }
        }
        /* Custom scrollbar for premium feel */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #fd7e14;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #e67300;
        }
    </style>

    <div class="wrapper d-flex">
