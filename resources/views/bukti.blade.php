@php
function hariIndo($hariInggris)
{
    switch ($hariInggris) {
        case 'Sunday':
            return 'Minggu';
        case 'Monday':
            return 'Senin';
        case 'Tuesday':
            return 'Selasa';
        case 'Wednesday':
            return 'Rabu';
        case 'Thursday':
            return 'Kamis';
        case 'Friday':
            return 'Jumat';
        case 'Saturday':
            return 'Sabtu';
        default:
            return 'hari tidak valid';
    }
}
function bulanIndo($hariInggris)
{
    switch ($hariInggris) {
        case 'Jan':
            return 'Januari';
        case 'Feb':
            return 'Februari';
        case 'Mar':
            return 'Maret';
        case 'Apr':
            return 'April';
        case 'May':
            return 'Mei';
        case 'Jun':
            return 'Juni';
        case 'Jul':
            return 'Juli';
        case 'Aug':
            return 'Agustus';
        case 'Sep':
            return 'September';
        case 'Oct':
            return 'Oktober';
        case 'Nov':
            return 'November';
        case 'Dec':
            return 'Desember';
        default:
            return 'bulan tidak valid';
    }
}
@endphp

<!DOCTYPE html>
<html lang="en">
    
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Classroom Itenas | {{ $title }}</title>
    <!-- Trying Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>
    <!-- Include header -->
    <div class="wrapper">
      <div class="text-center underline underline-offset-4 uppercase pt-5">
        <h1 class="text-3xl font-bold">Tiket Penggunaan Smart Classroom</h1>
        <!-- <h2 class="text-2xl font-bold text-bg">Itenas</h2> -->
      </div>
      <div class="main-wrapper px-40 pt-10">
        <div class="data-pemesan">
          <p class="underline">Data Pemesan</p>
          <p>Ticket No: {{ $buktis->id }}</p>
          <p>Nama Pemesan: {{ $buktis->User->name }}</p>
          <p>Tanggal Pemesanan: {{ date('d-m-Y', strtotime($buktis->updated_at)) }}</p>
        </div>
        <div class="data-pesanan mt-5">
          <p class="underline">Data Pesanan</p>
          <p>Tanggal Pemakaian: {{ date('d-m-Y', strtotime($buktis->tanggal_pinjam)) }}</p>
          <p>Ruangan: {{ $buktis->id_ruangan }}</p>
          <p>Jam Pemakaian: {{ date('H:i', strtotime($buktis->jam_masuk)) . '-' . date('H:i', strtotime($buktis->jam_keluar)) }}</p>
          <p>Dosen: {{ $buktis->dosen_matkul }}</p>
          <p>Mata Kuliah: {{ $buktis->matakuliah }}</p>
        </div>
      </div>
    </div>

  <script type="text/javascript">
      window.print();
  </script>

  </body>
</html>

