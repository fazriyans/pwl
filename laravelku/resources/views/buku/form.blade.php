@extends('layouts.index')
@section('content')
@php
    $rs1 = App\Models\Pengarang::all();
    $rs2 = App\Models\Penerbit::all();
    $rs3 = App\Models\Kategori::all();
@endphp
<h3>Form Buku</h3>
<form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>ISBN</label>
        <input type="text" name="isbn" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Tahun Cetak</label>
        <input type="text" name="tahun_cetak" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="text" name="stok" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Pengarang</label>
        <select class="form-control" name="idpengarang">
            <option value="">-- Pilih Pengarang --</option>
            @foreach($rs1 as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Penerbit</label>
        <select class="form-control" name="idpenerbit">
            <option value="">-- Pilih Penerbit --</option>
            @foreach($rs2 as $pen)
                <option value="{{ $pen->id }}">{{ $pen->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Kategori</label><br/>
        @foreach($rs3 as $k)
            <input type="radio" name="idkategori"
            value="{{ $k->id }}"/>{{ $k->nama }} &nbsp;
        @endforeach
    </div>
    <div class="form-group">
        <label>Cover</label>
        <input type="file" name="cover" class="form-control"/>
    </div>
    <button type="submit" class="btn btn-primary" name="proses">Simpan</button>
    <button type="reset" class="btn btn-danger" name="unproses">Batal</button>
</form>
@endsection
