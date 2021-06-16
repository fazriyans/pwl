@extends('layouts.index')
@section('content')
@php
    $ar_judul = ['No','Nama','Email','HP','Foto', 'Action'];
    $no = 1;
@endphp
<h3>Daftar Pengarang</h3>
<a class="btn btn-primary btn-md" href="{{ route('pengarang.create') }}" role="button">Tambah</a>
<table class = "table table-striped">
    <thead>
        <tr>
            @foreach($ar_judul as $jdl)
                <th>{{ $jdl }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($ar_pengarang as $p)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->email }}</td>
            <td>{{ $p->hp }}</td>
            <td width="13%">
            @php
            if (!empty($p->foto)){
            @endphp
                <img src="{{  asset('images')}}/{{ $p->foto }}" width="60%" />
            @php
            } else {
            @endphp
                <img src="{{  asset('images')}}/nophoto.jpg" width="60%" />
            @php
            }
            @endphp
            </td>
            <td>
            <form method="POST" action="{{ route('pengarang.destroy', $p->id) }}">
                @csrf
                @method('delete')
                <a class="btn btn-info" href="{{ route('pengarang.show', $p->id) }}">Detail</a>
                <a class="btn btn-success" href="{{ route('pengarang.edit', $p->id) }}">Edit</a>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin Data dihapus?')">Hapus</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
