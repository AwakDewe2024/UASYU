<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Rekam Medis</title>
 <style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #f72585;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --gray-color: #6c757d;
        --border-radius: 8px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f5f7ff;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        color: var(--dark-color);
    }

    .confirmation-container {
        background-color: var(--light-color);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 40px;
        text-align: center;
        max-width: 500px;
        width: 100%;
        animation: fadeIn 0.5s ease;
    }

    .icon {
        font-size: 72px;
        color: var(--accent-color);
        margin-bottom: 20px;
        animation: bounce 1s;
    }

    h1 {
        color: var(--primary-color);
        margin-bottom: 15px;
        font-size: 28px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    p {
        color: var(--dark-color);
        margin-bottom: 30px;
        font-size: 16px;
        line-height: 1.6;
    }

    .progress-bar {
        height: 6px;
        background-color: #e0e0e0;
        border-radius: 3px;
        margin-bottom: 30px;
        overflow: hidden;
    }

    .progress {
        height: 100%;
        background-color: var(--primary-color);
        width: 100%;
        animation: progress 1.5s linear;
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: var(--accent-color);
        color: var(--light-color);
        text-decoration: none;
        border-radius: var(--border-radius);
        font-weight: 500;
        transition: var(--transition);
        border: none;
        cursor: pointer;
    }

    .btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-20px); }
        60% { transform: translateY(-10px); }
    }

    @keyframes progress {
        from { width: 0; }
        to { width: 100%; }
    }
</style>
</head>
<body>
    <?php
    include __DIR__ . '/../config/koneksi.php'; // path koneksi absolut

    $id = $_GET['id']; // menampung id

    // query hapus
    $datas = mysqli_query($koneksi, "DELETE FROM rekam_medis WHERE id='$id'") or die(mysqli_error($koneksi));
    ?>
    
    <div class="confirmation-container">
        <div class="icon">🗑️</div>
        <h1>Data Rekam Medis Berhasil Dihapus</h1>
        <p>Data rekam medis telah dihapus secara permanen dari database.</p>

        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        
        <script>
            // Redirect after 3 seconds
            setTimeout(function() {
                window.location.href = 'index.php?page=rekam_medis';
            }, 3000);
        </script>
    </div>
</body>
</html>