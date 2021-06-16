@php
$no = 1;
//array scalar
$s1 = ['nama'=>'Fawwaz', 'nilai'=>85];
$s2 = ['nama'=>'Bedu', 'nilai'=>58];
$s3 = ['nama'=>'Siti', 'nilai'=>95];
$s4 = ['nama'=>'Deden', 'nilai'=>30];
$judul = ['No', 'Nama', 'Nilai', 'Keterangan'];
//array assoc
$siswa = [$s1, $s2, $s3, $s4];
@endphp
<h3 align="center">Daftar Nilai Siswa</h3>
<table border="1" align="center" cellpadding="10">
    <thead>
        <tr bgcolor="pink">
            @foreach($judul as $jdl)
            <th>{{$jdl}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $sis)
        {{-- logic kelulusan dan warna-warni dengan ternary --}}
            @php
                $ket = ($sis['nilai'] >= 60) ? 'Lulus' : 'Gagal';
                $warna = ($no % 2 == 0) ? 'blue' : 'yellow';
            @endphp
        <tr bgcolor="{{ $warna }}">
            <td>{{ $no++ }}</td>
            <td>{{ $sis['nama'] }}</td>
            <td>{{ $sis['nilai'] }}</td>
            <td>{{ $ket }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

