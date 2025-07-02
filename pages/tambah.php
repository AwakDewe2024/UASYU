<!DOCTYPE html>
<html>
<head>
  <title>Tambah Rekam Medis</title>
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
      --radius: 12px;
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
      border-radius: var(--radius);
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
      position: relative;
      padding-bottom: 15px;
    }
    
    h1::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary), var(--success-dark));
      border-radius: 3px;
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
    textarea {
      width: 100%;
      padding: 14px 16px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s ease;
      background-color: #f8fafc;
    }
    
    input::placeholder,
    textarea::placeholder {
      color: var(--text-light);
      opacity: 0.7;
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
    }
    
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
      padding: 14px 16px;
      background: #f8fafc;
      border: 2px dashed var(--border);
      border-radius: 8px;
      text-align: center;
      color: var(--text-light);
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 15px;
    }
    
    .file-input-label:hover {
      border-color: var(--primary);
      color: var(--primary);
      background: rgba(67, 97, 238, 0.05);
    }
    
    .file-input-label i {
      margin-right: 8px;
      color: var(--primary);
    }
    
    /* Button */
    button[type="submit"] {
      background: var(--primary);
      color: white;
      border: none;
      padding: 16px 24px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s ease;
      margin-top: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    button[type="submit"]:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }
    
    button[type="submit"]::before {
      content: "+";
      margin-right: 8px;
      font-size: 18px;
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
    <h1 class="center-shadow">Tambah Rekam Medis</h1>
    <div class="form-card">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Nama Pasien</label>
          <input type="text" name="nama" required placeholder="Masukkan nama lengkap pasien">
        </div>
        
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" required placeholder="Masukkan alamat lengkap pasien">
        </div>
        
        <div class="form-group">
          <label>Keluhan</label>
          <textarea name="keluhan" required placeholder="Deskripsikan keluhan pasien"></textarea>
        </div>
        
        <div class="form-group">
          <label>Tanggal Periksa</label>
          <input type="date" name="tanggal_periksa" value="<?= date('Y-m-d'); ?>" required>
        </div>
        
        <div class="form-group">
          <label>Diagnosa</label>
          <input type="text" name="diagnosa" required placeholder="Masukkan diagnosa dokter">
        </div>

        <div class="form-group">
          <label>Resep Obat</label>
          <input type="text" name="resep_obat" required placeholder="Masukkan resep obat">
        </div>
        
        <div class="form-group">
          <label>Dokumen Medis (PDF/DOC/DOCX)</label>
          <div class="custom-file-input">
            <label class="file-input-label">
              <i>📁</i> Unggah file rekam medis (maks. 5MB)
              <input type="file" name="file_upload" accept=".pdf,.doc,.docx">
            </label>
          </div>
        </div>
        
        <button type="submit" name="submit" value="simpan">Simpan Rekam Medis</button>
      </form>
      
      <div class="success-message" id="successMessage" style="display:none;">
        Data rekam medis berhasil ditambahkan!
      </div>
    </div>
  </div>
  
  <?php
  include('config/koneksi.php');
  if (isset($_POST['submit'])) {
      $nama = $_POST['nama'];
      $alamat = $_POST['alamat'];
      $keluhan = $_POST['keluhan'];
      $tanggal_periksa = date('Y-m-d'); // otomatis tanggal hari ini
      $diagnosa = $_POST['diagnosa'];
      $resep_obat = $_POST['resep_obat'];

      // Proses upload file
$fileName = null; // Default value jika tidak ada file yang di-upload
    // Cek apakah ada file yang diupload dan tidak ada error
    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Tentukan folder tujuan upload
        $allowed = ['pdf', 'doc', 'docx'];
        $fileInfo = pathinfo($_FILES['file_upload']['name']);
        $ext = strtolower($fileInfo['extension']);
        
        // Pastikan direktori 'uploads' ada, jika tidak, coba buat
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Validasi ekstensi file
        if (in_array($ext, $allowed)) {
            // Buat nama file yang unik untuk menghindari penimpaan file
            $fileName = uniqid() . '_' . basename($_FILES['file_upload']['name']);
            $destination = $uploadDir . $fileName;

            // Memindahkan file dari temporary location ke folder 'uploads'
            // Perubahan utama ada di baris ini: '../uploads/' menjadi $destination
            if (!move_uploaded_file($_FILES['file_upload']['tmp_name'], $destination)) {
                // Gagal memindahkan file, set $fileName kembali ke null
                $fileName = null;
                // Anda bisa menambahkan pesan error di sini jika perlu
                echo "<script>alert('Gagal mengupload file!');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak diizinkan! Hanya .pdf, .doc, .docx.');</script>";
        }
    }

      // Simpan ke database
      mysqli_query($koneksi, "INSERT INTO rekam_medis (nama, alamat, keluhan, tanggal_periksa, diagnosa, resep_obat, file_upload) 
          VALUES('$nama', '$alamat', '$keluhan', '$tanggal_periksa', '$diagnosa', '$resep_obat', '$fileName')") or die(mysqli_error($koneksi));

      echo "<script>
          document.getElementById('successMessage').style.display = 'block';
          setTimeout(function() {
            window.location.href = 'index.php?page=rekam_medis';
          }, 1500);
      </script>";
  }
  ?>
</body>
</html>