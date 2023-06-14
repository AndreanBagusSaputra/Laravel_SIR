@php
    $no = 1;
    $s1 = ['nama' => 'Andre', 'nilai' => 85];
    $s2 = ['nama' => 'Bagus', 'nilai' => 80];
    $s3 = ['nama' => 'Saputra', 'nilai' => 75];
    $s4 = ['nama' => 'Adam', 'nilai' => 90];
    $s5 = ['nama' => 'Langit', 'nilai' => 87];

    $judul = ['No', 'Nama', 'Keterangan'];
    $siswa = [$s1,$s2,$s3,$s4,$s5];
@endphp

<table>
    <thead>
        <tr>
            @foreach($judul as $jdl)
            <th>{{$jdl}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $s)
        @php
        $ket = ($s['nilai'] >= 60 ? 'Lulus' : 'Gagal');
        @endphp
    </tbody>
    <tr>
        <td>{{$no++}}</td>
        <td>{{$s['nama']}}</td>
        <td>{{$s['nilai']}}</td>
        <td>{{$ket}}</td>
    </tr>
        @endforeach
</table>