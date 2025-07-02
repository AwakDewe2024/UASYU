<?php
include('config/koneksi.php');
$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM rekam_medis WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

$show_success = false; // Tambahkan ini

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $keluhan = $_POST['keluhan'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $diagnosa = $_POST['diagnosa'];
    $resep_obat = $_POST['resep_obat'];

    // Proses upload file
    $fileName = $row['file_upload']; // default: file lama
    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {
        $allowed = ['pdf', 'doc', 'docx'];
        $ext = strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            if (!empty($row['file_upload']) && file_exists('uploads/' . $row['file_upload'])) {
                unlink('uploads/' . $row['file_upload']);
            }
            $fileName = uniqid() . '_' . $_FILES['file_upload']['name'];
            move_uploaded_file($_FILES['file_upload']['tmp_name'], 'uploads/' . $fileName);
        }
    }

    mysqli_query($koneksi, "UPDATE rekam_medis SET nama='$nama', alamat='$alamat', keluhan='$keluhan', tanggal_periksa='$tanggal_periksa', diagnosa='$diagnosa', resep_obat='$resep_obat', file_upload='$fileName' WHERE id='$id'")
    or die(mysqli_error($koneksi));

    $show_success = true; // Set flag sukses

    // Refresh data setelah update
    $result = mysqli_query($koneksi, "SELECT * FROM rekam_medis WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Rekam Medis</title>
  <style>
    /* Base Styles */
    :root {
      --primary: #4361ee;
      --primary-dark: #3f37c9;
      --secondary: #3a86ff;
      --danger: #f72585;
      --danger-dark: #c9184a;
      --success: #4cc9f0;
      --success-dark: #4895ef;
      --text: #2b2d42;
      --text-light: #8d99ae;
      --bg: #f8f9fa;
      --card-bg: #ffffff;
      --border: #e9ecef;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Poppins', 'Segoe UI', Roboto, sans-serif;
      background-color: var(--bg);
      color: var(--text);
      line-height: 1.6;
      padding: 0;
      margin: 0;
    }
    
    /* Container */
    .container {
      max-width: 800px;
      margin: 40px auto;
      padding: 0 20px;
    }
    
    /* Card Style */
    .form-card {
      background: var(--card-bg);
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      padding: 40px;
      margin-top: 20px;
    }
    
    /* Header */
    h1 {
      color: var(--primary);
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 10px;
      text-align: center;
    }
    
    /* Form Elements */
    .form-group {
      margin-bottom: 24px;
    }
    
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--text);
      font-size: 14px;
    }
    
    input[type="text"],
    input[type="date"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 14px 16px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s ease;
      background-color: #f8fafc;
    }
    
    input:focus,
    textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }
    
    textarea {
      min-height: 120px;
      resize: vertical;
    }
    
    /* File Upload */
    .file-upload-container {
      margin-top: 8px;
      display: flex;
      align-items: center;
    }
    
    .file-upload-container a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      margin-left: 10px;
      display: flex;
      align-items: center;
    }
    
    .file-upload-container a::before {
      content: "↓";
      margin-right: 4px;
      font-size: 14px;
    }
    
    .file-upload-container a:hover {
      text-decoration: underline;
    }
    
    /* Button */
    button[type="submit"] {
      background: var(--primary);
      color: white;
      border: none;
      padding: 14px 24px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s ease;
      margin-top: 10px;
    }
    
    button[type="submit"]:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
    }
    
    /* Success Message */
    .success-message {
      background: #4ade80;
      color: white;
      padding: 16px;
      border-radius: 8px;
      text-align: center;
      font-weight: 500;
      margin-top: 20px;
      display: none;
      animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 0 15px;
      }
      
      .form-card {
        padding: 30px;
      }
      
      h1 {
        font-size: 24px;
      }
    }
    
    /* Custom File Input */
    .custom-file-input {
      position: relative;
      overflow: hidden;
      display: inline-block;
      width: 100%;
    }
    
    .custom-file-input input[type="file"] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    
    .file-input-label {
      display: block;
      padding: 12px 16px;
      background: #f8fafc;
      border: 1px dashed var(--border);
      border-radius: 8px;
      text-align: center;
      color: var(--text-light);
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .file-input-label:hover {
      border-color: var(--primary);
      color: var(--primary);
    }
    
    .file-name {
      margin-top: 8px;
      font-size: 14px;
      color: var(--text-light);
    }

    .center-shadow {
  text-align: center;
  margin: 0 auto 28px auto;
  box-shadow: 0 8px 24px -8px rgba(67, 97, 238, 0.18);
  background: #fff;
  border-radius: 12px;
  padding: 24px 0 18px 0;
  position: relative;
  width: 60%;
}

.center-shadow::after {
  content: "";
  display: block;
  margin: 18px auto 0 auto;
  width: 80px;
  height: 4px;
  border-radius: 2px;
  background: linear-gradient(90deg, var(--primary), var(--primary-dark));
  opacity: 0.7;
}
  </style>
</head>
<body>
  <div class="container">
    <h1 class="center-shadow">Edit Rekam Medis</h1>
    <div class="form-card">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Nama Pasien</label>
          <input type="text" name="nama" required value="<?= htmlspecialchars($row['nama']); ?>">
          <input type="hidden" name="id" value="<?= $row['id']; ?>">
        </div>
        
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" required value="<?= htmlspecialchars($row['alamat']); ?>">
        </div>
        
        <div class="form-group">
          <label>Keluhan</label>
          <textarea name="keluhan" required><?= htmlspecialchars($row['keluhan']); ?></textarea>
        </div>
        
        <div class="form-group">
          <label>Tanggal Periksa</label>
          <input type="date" name="tanggal_periksa" value="<?= htmlspecialchars($row['tanggal_periksa']); ?>" required>
        </div>
        
        <div class="form-group">
          <label>Diagnosa</label>
          <input type="text" name="diagnosa" required value="<?= htmlspecialchars($row['diagnosa']); ?>">
        </div>

        <div class="form-group">
          <label>Resep Obat</label>
          <input type="text" name="resep_obat" required value="<?= htmlspecialchars($row['resep_obat']); ?>">
        </div>
        
        <div class="form-group">
          <label>Dokumen Medis (PDF/DOC)</label>
          <div class="custom-file-input">
            <label class="file-input-label">
              Klik untuk upload file baru
              <input type="file" name="file_upload" accept=".pdf,.doc,.docx">
            </label>
          </div>
          <?php if (!empty($row['file_upload'])): ?>
            <div class="file-upload-container">
              <span class="file-name">File saat ini:</span>
              <a href="uploads/<?= htmlspecialchars($row['file_upload']); ?>" target="_blank"><?= htmlspecialchars($row['file_upload']); ?></a>
            </div>
          <?php endif; ?>
        </div>
        
        <button type="submit" name="submit" value="simpan">Simpan Perubahan</button>
      </form>
      
<?php if ($show_success): ?>
  <div class="success-message" id="successMessage" style="display:block;">
    Data rekam medis berhasil diperbarui!
  </div>
  <script>
    setTimeout(function() {
      window.location.href = 'index.php?page=rekam_medis';
    }, 1500);
  </script>
<?php endif; ?>
    </div>
  </div>
</body>
</html>