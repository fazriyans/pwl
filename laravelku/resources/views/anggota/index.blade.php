@extends('layouts.index')
@section('content')
@php
    $ar_judul = ['No','Nama','Email','HP','Foto', 'Action'];
    $no = 1;
@endphp
<h3>Daftar Anggota</h3>
<a class="btn btn-primary btn-md" href="{{ route('anggota.create') }}" role="button">Tambah</a>
<table class = "table table-striped">
    <thead>
        <tr>
            @foreach($ar_judul as $jdl)
                <th>{{ $jdl }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($ar_anggota as $a)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $a->nama }}</td>
            <td>{{ $a->email }}</td>
            <td>{{ $a->hp }}</td>
            <td width="13%">
            @php
            if (!empty($a->foto)){
            @endphp
                <img src="{{  asset('images')}}/{{ $a->foto }}" width="60%" />
            @php
            } else {
            @endphp
                <img src="{{  asset('images')}}/nophoto.jpg" width="60%" />
            @php
            }
            @endphp
            </td>
            <td>
            <form method="POST" action="{{ route('anggota.destroy', $a->id) }}">
                @csrf
                @method('delete')
                <a class="btn btn-info" href="{{ route('anggota.show', $a->id) }}">Detail</a>
                <a class="btn btn-success" href="{{ route('anggota.edit', $a->id) }}">Edit</a>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin Data dihapus?')">Hapus</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
