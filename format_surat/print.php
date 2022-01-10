<link type="text/css" href="../assets/css/print.css" rel="stylesheet">
<title>Print Data Surat Tugas</title>

<body onload='window.print()'>
  <?php
  error_reporting(0);

  session_start();

  include "../include/config.php"; 
  

  if(isset ($_GET['id'])){
  $print 		= $_GET['id'];
    $sql 		= "SELECT * FROM outbox WHERE id_surat = '$print'";
    $data 		= mysqli_fetch_array (mysqli_query ($connect, $sql));
    $no_surat	= $data['no_surat'];
    $jenis		= $data['jenis'];
    $tanggal	= $data['tanggal'];
    $perihal	= $data['perihal'];
    $pengirim	= $data['pengirim'];
    $tujuan		= $data['tujuan'];
    $isi			= $data['isi'];
  }

  $perihal = strtoupper($perihal);

  $isi = nl2br($isi, false);
  $isi = '<p>' . preg_replace('#(<br>[\r\n]+){2}#', "</p>\n\n<p>", $isi) . '</p>';
  function tanggal_indonesia($tanggal){
    $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
    );
    
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal

    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }

  $tanggal = tanggal_indonesia($tanggal);
  ?>

  <table border=0 width=100%>
    <tr>
      <td align="center" rowspan='3' width='88px'><img width='150px' src="../assets/images/kop.png"></td>
    </tr>

    <tr>
      <td align="center">
        <h2 style='margin-bottom:-5px' align='center'><b> KEJAKSAAN REPUBLIK INDONESIA<br>KEJAKSAAN TINGGI ACEH <br>
        KEJAKSAAN NEGERI BIREUEN</b></h2>
      </td>

      <td align="center" rowspan='3' width='88px'>&nbsp;</td>
    </tr>

    <tr>
      <td align="center">
        <p>Jl. Raya Medan - Banda Aceh Cot Gapu Bireuen <br>
          Telp/Fax(0644)21258 www.kejari-bireuen.kejaksaan.go.id</p>
      </td>
    </tr>
  </table>

  <hr style='border:1px solid #000'>

  
  <table width=100%>
    <tr>
      <td align="center">
        <h3><u><?php echo $perihal; ?></u><br>
        Nomor : <?php echo $no_surat; ?>   
        </h3>
      </td>
    </tr>
  </table>
  
  <br />

  <!-- <table width='50%'>
    <tr>
      <td>Nomor</td>
      <td>: <?php echo $no_surat; ?></td>
    </tr>
    <tr>
      <td>Perihal</td>
      <td>: <?php echo $perihal?></td>
    </tr>
    <tr>
      <td>Kepada</td>
      <td>: <?php echo $tujuan?></td>
  </table>
  <br> -->

  <table width='100%'>
    <p>
      <?php echo $isi ?>
    </p>
  </table>

  <p>Demikian <?php echo $jenis?> Ini diberikan untuk dipergunakan sebagaimana Mestinya.</p>

  <br>
  <table width=100%>
    <tr>
      <td width="30%"></td>

      <td width="20%"></td>

      <td>
        <table>
          <tr>
            <td >Dikeluarkan di </td>
            <td>: Bireuen</td>
          </tr>

          <tr>
            <td>Pada Tanggal </td>
            <td>: <?php echo $tanggal; ?></td>
          </tr>
        </table><br>

        <table>
          <tr>
            <td align="center"><b>KEPALA KEJAKSAAN NEGERI BIREUN</b></td>
          </tr>
          <tr>
            <td><br><br><br><br></td>
          </tr>
          <tr>
            <td>
            <u><b>MOHAMMAD FARID RUMDANA, S.H., M.H. </u><br>
            <center>
            JAKSA MADYA Nip. 19680610 198910 1 001
            </center>
            </b>
            </td> 
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>