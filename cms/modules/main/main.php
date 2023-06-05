<?php
	$adb 		= $koneksi->query("SELECT * FROM admin");
	$admin 		= mysqli_num_rows($adb);
	$cdb 		= $koneksi->query("SELECT * FROM customer");
	$customer 	= mysqli_num_rows($cdb);
	$pdb 		= $koneksi->query("SELECT * FROM penjualan");
	$penjualan 	= mysqli_num_rows($pdb);
?>

<!-- boxdashboard -->
<div id="bgdash">
    <div id="bodash" class="clearfix">
        <div class="dashbox">
            <div class="dashimg">
                <i class="fa fa-user"></i>
            </div>
            <div class="dashnum">
                <h2><?= $admin; ?></h2>
            </div>
            <div class="dashtit">
                <h3>Admin</h3>  
            </div>
        </div>
        <div class="dashbox">
            <div class="dashimg2">
                <i class="fa fa-users"></i>
            </div>
            <div class="dashnum">
                <h2><?= $customer; ?></h2>
            </div>
            <div class="dashtit">
                <h3>Customer</h3>  
            </div>
        </div>
        <div class="dashbox">
            <div class="dashimg3">
            <i class="fa-regular fa-credit-card"></i>
            </div>
            <div class="dashnum">
                <h2><?= $penjualan; ?></h2>
            </div>
            <div class="dashtit">
                <h3>Penjualan</h3>  
            </div>
        </div>
    </div>
</div>

<!-- chart -->
<div id="chart" class="clearfix">
    <div class="chartkiri">
        <div class="charttit">
            Penjualan
        </div>
        <div class="chartjs">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="chartkanan">
        <div class="charttit">
            Pembayaran
        </div>
        <div class="chartjs">
        <canvas id="myChart2"></canvas>
        </div>
    </div>
</div>
<script>
//deklarasi chartjs untuk membuat grafik 2d di id mychart 
var ctx = document.getElementById('myChart').getContext('2d');

<?php
	$date1 	= date('Y-01');
	$pdb1 	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date1%'");
	$jan 	= mysqli_num_rows($pdb1);
	$date2 	= date('Y-02');
	$pdb2 	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date2%'");
	$feb 	= mysqli_num_rows($pdb2);
	$date3 	= date('Y-03');
	$pdb3 	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date3%'");
	$mar 	= mysqli_num_rows($pdb3);
	$date4 	= date('Y-04');
	$pdb4 	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date4%'");
	$apr 	= mysqli_num_rows($pdb4);
	$date5 	= date('Y-05');
	$pdb5 	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date5%'");
	$mei 	= mysqli_num_rows($pdb5);
	$date6 	= date('Y-06');
	$pdb6 	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date6%'");
	$jun 	= mysqli_num_rows($pdb6);
	$date7 	= date('Y-07');
	$pdb7 	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date7%'");
	$jul 	= mysqli_num_rows($pdb7);
	$date8 	= date('Y-08');
	$pdb8	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date8%'");
	$agu	= mysqli_num_rows($pdb8);
	$date9 	= date('Y-09');
	$pdb9	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date9%'");
	$sep	= mysqli_num_rows($pdb9);
	$date10	= date('Y-10');
	$pdb10	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date10%'");
	$okt	= mysqli_num_rows($pdb10);
	$date11	= date('Y-11');
	$pdb11	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date11%'");
	$nov	= mysqli_num_rows($pdb11);
	$date12	= date('Y-11');
	$pdb12	= $koneksi->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$date12%'");
	$des	= mysqli_num_rows($pdb12);
?>
var myChart = new Chart(ctx, {
 //chart akan ditampilkan sebagai bar chart
    type: 'bar',
    data: {
     //membuat label chart
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [{
            label: '# Of Sell',
            //isi chart
            data: [<?= $jan; ?>, <?= $feb; ?>, <?= $mar; ?>, <?= $apr; ?>, <?= $mei; ?>, <?= $jun; ?>, <?= $jul; ?>, <?= $agu; ?>,<?= $sep; ?>,<?= $okt; ?>,<?= $nov; ?>,<?= $des; ?>],
            //membuat warna pada bar chart
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 70, 64, 0.2)',
				'rgba(125, 159, 230, 0.2)',
				'rgba(155, 159, 85, 0.2)',
				'rgba(85, 70, 85, 0.2)',
				'rgba(200, 132, 125, 0.2)',
				'rgba(120, 122, 70, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255, 70, 64, 1)',
				'rgba(125, 159, 230, 1)',
				'rgba(155, 159, 85, 1)',
				'rgba(85, 70, 85, 1)',
				'rgba(200, 132, 125, 12)',
				'rgba(120, 122, 70, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById('myChart2').getContext('2d');

var myChart = new Chart(ctx, {
 //chart akan ditampilkan sebagai bar chart
    type: 'bar',
    data: {
     //membuat label chart
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            //isi chart
            data: [12, 19, 3, 5, 2, 3],
            //membuat warna pada bar chart
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>