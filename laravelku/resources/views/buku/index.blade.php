@extends('layouts.index')
@section('content')
@php
    $ar_judul = ['no','ISBN','Judul','Stok','Pengarang', 'Penerbit', 'Kategori', 'Cover', 'Action'];
    $no = 1;
@endphp
<h3>Daftar Buku</h3>
<a class="btn btn-primary btn-md" href="{{ route('buku.create') }}" role="button">Tambah</a>
<br/>
<table class = "table table-striped">
    <thead>
        <tr>
            @foreach($ar_judul as $jdl)
                <th>{{ $jdl }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($ar_buku as $b)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $b->isbn }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->stok }}</td>
            <td>{{ $b->nama }}</td>
            <td>{{ $b->pen }}</td>
            <td>{{ $b->kat }}</td>
            <td width="13%">
            @php
            if (!empty($b->cover)){
            @endphp
                <img src="{{  asset('images')}}/{{ $b->cover }}" width="60%" />
            @php
            } else {
            @endphp
                <img src="{{  asset('images')}}/nophoto.jpg" width="60%" />
            @php
            }
            @endphp
            </td>
            <td>
            <form method="POST" action="{{ route('buku.destroy', $b->id) }}" width="13%">
                @csrf
                @method('delete')
                <a class="btn btn-info" href="{{ route('buku.show', $b->id) }}">Detail</a>
                <a class="btn btn-success" href="{{ route('buku.edit', $b->id) }}">Edit</a>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin Data dihapus?')">Hapus</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
