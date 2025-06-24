<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style.css">
	<title>Digi Cart</title>
</head>

<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand"><img src="logo.png"> Digi Cart</a>
		<ul class="side-menu">
			<li><a href="/dashboard" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="aset fisik">Aset Fisik</li>
			<li>
				<a href="/produk"><i class='bx bxs-inbox icon' ></i> Produk</a>
			</li>
			<li><a href="/kategori"><i class='bx bxs-chart icon' ></i> Kategori</a></li>
			<li><a href="/detail"><i class='bx bxs-widget icon' ></i> Detail Pesanan</a></li>
			<li class="divider" data-text="layanan">Layanan</li>
			<li><a href="#"><i class='bx bx-table icon' ></i> Pembayaran</a></li>
			<li><a href="/pesanan"><i class='bx bx-table icon' ></i> Pesanan</a></li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar'></i>
			<span class="divider"></span>
			<div class="profile">
				<img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
					alt="">
				<ul class="profile-link">
					<li><a href="#"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Pesanan</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Halaman</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Pesanan</a></li>
			</ul>
			<div class="table-container">
    <table class="payment-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ahmad Rizky</td>
                <td>Transfer Bank BCA</td>
                <td><span class="status success">Berhasil</span></td>
                <td>2025-05-30 14:30</td>
            </tr>
            <tr>
                <td>Siti Nurhaliza</td>
                <td>E-Wallet OVO</td>
                <td><span class="status success">Berhasil</span></td>
                <td>2025-05-30 13:45</td>
            </tr>
            <tr>
                <td>Budi Santoso</td>
                <td>Credit Card Visa</td>
                <td><span class="status pending">Pending</span></td>
                <td>2025-05-30 12:20</td>
            </tr>
            <tr>
                <td>Maya Putri</td>
                <td>Transfer Bank Mandiri</td>
                <td><span class="status failed">Gagal</span></td>
                <td>2025-05-30 11:15</td>
            </tr>
            <tr>
                <td>Doni Prasetyo</td>
                <td>E-Wallet GoPay</td>
                <td><span class="status success">Berhasil</span></td>
                <td>2025-05-30 10:30</td>
            </tr>
            <tr>
                <td>Lisa Maharani</td>
                <td>Transfer Bank BNI</td>
                <td><span class="status success">Berhasil</span></td>
                <td>2025-05-30 09:45</td>
            </tr>
            <tr>
                <td>Andi Wijaya</td>
                <td>E-Wallet DANA</td>
                <td><span class="status pending">Pending</span></td>
                <td>2025-05-30 08:20</td>
            </tr>
            <tr>
                <td>Rina Sari</td>
                <td>Credit Card Mastercard</td>
                <td><span class="status success">Berhasil</span></td>
                <td>2025-05-29 16:10</td>
            </tr>
        </tbody>
    </table>
</div>
		</main>
		<!-- MAIN -->
	</section>
</body>
	<script src="script.js"></script>
</html>