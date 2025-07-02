<?php
// Memulai sesi dan memastikan variabel peran (role) tersedia.
// Peran bisa 'admin' atau 'asisten', jika tidak ada sesi, maka akan kosong.
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Menentukan jumlah kolom dalam tabel berdasarkan peran pengguna.
// Ini berguna untuk 'colspan' pada baris "data tidak ditemukan".
$colspan = ($role === 'admin') ? 8 : 7;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis Pasien</title>
    <!-- Memuat Google Fonts untuk tampilan yang lebih modern -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Base Styles */
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --primary-dark: #3f37c9;
            --danger: #f72585;
            --danger-dark: #c9184a;
            --text: #2b2d42;
            --text-light: #6c757d;
            --bg: #f8f9fa;
            --card-bg: #ffffff;
            --border: #e9ecef;
            --border-light: #f1f3f5;
        }

        /* General Body Styling */
        body {
            font-family: 'Poppins', 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
            margin: 0;
        }

        /* Main Container */
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Section */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; /* Memastikan elemen turun ke bawah pada layar kecil */
            gap: 20px;
            margin-bottom: 24px;
        }

        .header-title-group {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-img {
            height: 40px;
            width: auto;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-dark);
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        /* Search Form */
        .search-form {
            position: relative;
        }

        .search-input {
            width: 250px;
            padding: 10px 16px 10px 40px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: white;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%238d99ae' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 16px center;
            background-size: 16px;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        /* Action Buttons (Add, Logout) */
        .btn {
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .add-btn {
            background: var(--primary);
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.2);
        }

        .add-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .logout-btn {
            background: var(--danger);
            box-shadow: 0 2px 8px rgba(247, 37, 133, 0.2);
        }

        .logout-btn:hover {
            background: var(--danger-dark);
        }

        /* Table Container */
        .table-container {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            /* Membuat tabel bisa di-scroll secara horizontal pada layar kecil */
            overflow-x: auto; 
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            /* min-width untuk memastikan tabel tidak terlalu sempit di layar kecil */
            min-width: 900px; 
        }

        thead {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        th, td {
            padding: 16px;
            text-align: left;
            vertical-align: middle;
            font-size: 14px;
            white-space: nowrap; /* Mencegah teks patah ke bawah */
        }

        /* Memberi efek garis pemisah antar header */
        th:not(:last-child) {
            border-right: 1px solid rgba(255, 255, 255, 0.2);
        }

        tbody tr {
            border-bottom: 1px solid var(--border-light);
            transition: background-color 0.2s ease;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }
        
        /* Mengatur agar teks yang panjang bisa pindah baris */
        td {
            white-space: normal;
        }

        /* Action Buttons in Table (Edit, Delete) */
        .action-btn-group {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            gap: 6px;
        }

        .edit-btn {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary);
        }

        .edit-btn:hover {
            background-color: rgba(59, 130, 246, 0.2);
        }

        .delete-btn {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .delete-btn:hover {
            background-color: rgba(239, 68, 68, 0.2);
        }

        /* Download Link */
        .download-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .download-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Empty State */
        .no-results {
            text-align: center;
            padding: 40px;
            color: var(--text-light);
        }
        .no-results-icon {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--border);
        }
        .no-results-title {
            font-size: 18px;
            font-weight: 600;
        }
        .no-results-desc {
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start; /* Rata kiri pada layar kecil */
            }
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            .search-form {
                flex-grow: 1; /* Membuat form pencarian memenuhi sisa ruang */
            }
            .search-input {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<main class="container">
    <header class="page-header">
        <div class="header-title-group">
            <!-- Pastikan path logo sudah benar -->
            <img src="assets/logo.png" alt="Logo Klinik Sehat" class="logo-img" 
                 onerror="this.style.display='none'">
            <h1 class="page-title">Rekam Medis Pasien</h1>
<?php
    $nama = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    if ($role === 'admin') {
        echo '<div style="font-size:14px;color:#4895ef;font-weight:600;margin-top:2px;"> Admin (Dokter) &mdash; ' . htmlspecialchars($nama) . '</div>';
    } elseif ($role === 'asisten') {
        echo '<div style="font-size:14px;color:#4895ef;font-weight:600;margin-top:2px;"> Asisten &mdash; ' . htmlspecialchars($nama) . '</div>';
    }
?>
        </div>
        <div class="header-actions">
            <form method="get" class="search-form">
                <input type="hidden" name="page" value="rekam_medis">
                <input type="text" name="kata_cari" class="search-input" 
                       placeholder="Cari pasien..." 
                       value="<?= isset($_GET['kata_cari']) ? htmlspecialchars($_GET['kata_cari']) : '' ?>">
            </form>
            <?php if ($role === 'admin'): ?>
                <a href="index.php?page=tambah" class="btn add-btn">Tambah Data</a>
            <?php endif; ?>
            <a href="index.php?page=logout" class="btn logout-btn">Logout</a>
        </div>
    </header>

    <?php
    // --- KONEKSI DAN QUERY DATA ---
    include('config/koneksi.php'); // Pastikan path ini benar

    // Cek apakah ada kata kunci pencarian
    if (isset($_GET['kata_cari']) && !empty($_GET['kata_cari'])) {
        $kata_cari = $_GET['kata_cari'];
        $query_param = "%" . $kata_cari . "%";
        
        // --- PENTING: MENGGUNAKAN PREPARED STATEMENT UNTUK MENCEGAH SQL INJECTION ---
        $stmt = mysqli_prepare($koneksi, "SELECT * FROM rekam_medis WHERE nama LIKE ? OR alamat LIKE ? OR keluhan LIKE ? OR diagnosa LIKE ? ORDER BY id DESC");
        // 's' berarti parameter adalah string. Ada 4 tanda tanya (?), jadi "ssss".
        mysqli_stmt_bind_param($stmt, "ssss", $query_param, $query_param, $query_param, $query_param);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

    } else {
        // Jika tidak ada pencarian, ambil semua data
        $query = "SELECT * FROM rekam_medis ORDER BY id DESC";
        $result = mysqli_query($koneksi, $query);
    }
    ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>Keluhan</th>
                    <th>Tanggal Periksa</th>
                    <th>Diagnosa</th>
                    <th>Resep Obat</th>
                    <th>File</th>
                    <?php if ($role === 'admin'): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['alamat']); ?></td>
                            <td><?= htmlspecialchars($row['keluhan']); ?></td>
                            <td><?= date('d M Y', strtotime($row['tanggal_periksa'])); ?></td>
                            <td><?= htmlspecialchars($row['diagnosa']); ?></td>
                            <td><?= htmlspecialchars($row['resep_obat']); ?></td>
                            <td>
                                <?php if (!empty($row['file_upload'])): ?>
                                    <!-- Pastikan path uploads sudah benar -->
                                    <a href="uploads/<?= htmlspecialchars($row['file_upload']); ?>" class="download-link" target="_blank">Unduh</a>
                                <?php else: ?>
                                    <span style="color: var(--text-light);">-</span>
                                <?php endif; ?>
                            </td>
                            <?php if ($role === 'admin'): ?>
                                <td>
                                    <div class="action-btn-group">
                                        <a href="index.php?page=edit&id=<?= $row['id']; ?>" class="action-btn edit-btn">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            Edit
                                        </a>
                                        <a href="index.php?page=hapus&id=<?= $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.')">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                <?php
                    }
                } else {
                    // Tampilan jika tidak ada data yang ditemukan
                    echo '<tr><td colspan="' . $colspan . '">
                            <div class="no-results">
                                <div class="no-results-icon">🕵️‍♂️</div>
                                <div class="no-results-title">Data Tidak Ditemukan</div>
                                <div class="no-results-desc">Silakan coba kata kunci lain atau tambahkan data baru.</div>
                            </div>
                          </td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>