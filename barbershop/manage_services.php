
 <?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin'){
    header("Location: login.php?pesan=gagal");
    exit();
}

// HAPUS LAYANAN
if(isset($_GET['hapus_id'])){
    $hapus_id = intval($_GET['hapus_id']);
    mysqli_query($koneksi,"DELETE FROM services WHERE id=$hapus_id");
    header("Location: manage_services_modal.php");
    exit();
}

// TAMBAH / EDIT LAYANAN (tanpa gambar)
if(isset($_POST['save_service'])){
    $sid = intval($_POST['sid']);
    $nama = mysqli_real_escape_string($koneksi,$_POST['nama']);
    $deskripsi = mysqli_real_escape_string($koneksi,$_POST['deskripsi']);
    $harga = floatval($_POST['harga']);

    if($sid > 0){
        mysqli_query($koneksi,"UPDATE services SET nama='$nama', deskripsi='$deskripsi', harga='$harga' WHERE id=$sid");
    } else {
        mysqli_query($koneksi,"INSERT INTO services(nama,deskripsi,harga) VALUES('$nama','$deskripsi','$harga')");
    }

    header("Location: manage_services_modal.php");
    exit();
}

$result = mysqli_query($koneksi,"SELECT * FROM services ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Layanan - Modal CRUD + Print</title>
<style>
body {font-family:Arial;margin:0;background:#121212;color:#EAEAEA;}
.container{padding:20px;}
h1{margin-bottom:20px;color:#EAEAEA;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th,td{padding:12px;border:1px solid #2A2A2A;text-align:left;}
th{background:#1F3A93;color:#fff;}
tr:hover{background:#1F1F1F;}
.button{background:#3C6FFF;padding:6px 12px;color:white;border-radius:5px;text-decoration:none;cursor:pointer;border:none;}
.button:hover{opacity:.8;}
.hapus{background:red;}
.hapus:hover{opacity:.8;}

/* MODAL */
.modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);justify-content:center;align-items:center;}
.modal-content{background:#1E1E1E;padding:20px;border-radius:10px;width:400px;position:relative;}
.close{position:absolute;top:10px;right:15px;font-size:22px;color:#fff;cursor:pointer;}
input,textarea{width:100%;padding:10px;margin-bottom:10px;border-radius:5px;border:1px solid #333;background:#0F0F0F;color:#EAEAEA;}
input[type=submit]{background:#3C6FFF;border:none;cursor:pointer;}

/* CSS khusus untuk Print */
@media print {
  body {
    background: #fff !important;
    color: #000 !important;
  }
  .button, .hapus, .modal, .no-print {
    display: none !important;
  }
  table {
    width: 100% !important;
    border: 1px solid #000;
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid #000 !important;
    color: #000 !important;
  }
}
</style>
</head>
<body>
<div class="container">
  <h1>Manajemen Layanan</h1>

  <!-- Tombol Print + Tambah -->
  <button class="button no-print" onclick="window.print()"> Print Layanan</button>
  <button class="button no-print" onclick="openModal()">+ Tambah Layanan</button>

  <table>
    <tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr>
    <?php while($s = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $s['id'] ?></td>
      <td><?= htmlspecialchars($s['nama']) ?></td>
      <td><?= htmlspecialchars($s['deskripsi']) ?></td>
      <td>Rp <?= number_format($s['harga'],0,",",".") ?></td>
      <td>
        <button class="button no-print" onclick='openModal(<?= json_encode($s) ?>)'>Edit</button>
        <a class="button hapus no‑print" href="?hapus_id=<?= $s['id'] ?>" onclick="return confirm('Hapus layanan ini?')">Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<!-- MODAL FORM -->
<div class="modal no-print" id="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2 id="modalTitle" style="color:#EAEAEA;">Tambah Layanan</h2>
    <form method="post">
      <input type="hidden" name="sid" id="sid" value="0">
      <label style="color:#EAEAEA;">Nama Layanan:</label>
      <input type="text" name="nama" id="nama" required>
      <label style="color:#EAEAEA;">Deskripsi:</label>
      <textarea name="deskripsi" id="deskripsi" required></textarea>
      <label style="color:#EAEAEA;">Harga (Rp):</label>
      <input type="number" name="harga" id="harga" required>
      <input type="submit" name="save_service" value="Simpan" class="button">
    </form>
  </div>
</div>

<script>
function openModal(data = null){
  document.getElementById('modal').style.display = 'flex';
  if(data){
    document.getElementById('modalTitle').innerText = 'Edit Layanan';
    document.getElementById('sid').value = data.id;
    document.getElementById('nama').value = data.nama;
    document.getElementById('deskripsi').value = data.deskripsi;
    document.getElementById('harga').value = data.harga;
  } else {
    document.getElementById('modalTitle').innerText = 'Tambah Layanan';
    document.getElementById('sid').value = 0;
    document.getElementById('nama').value = '';
    document.getElementById('deskripsi').value = '';
    document.getElementById('harga').value = '';
  }
}
function closeModal(){
  document.getElementById('modal').style.display = 'none';
}
</script>
</body>
</html>
