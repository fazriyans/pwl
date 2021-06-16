@extends('layouts.index')
@section('content')
<h3>Form Anggota</h3>
<form method="POST" action="{{ route('anggota.store') }}"
        enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Nama Anggota</label>
        <input type="text" name="nama" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Email Anggota</label>
        <input type="text" name="email" class="form-control"/>
    </div>
    <div class="form-group">
        <label>HP Anggota</label>
        <input type="text" name="hp" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Foto Anggota</label>
        <input type="file" name="foto" class="form-control"/>
    </div>
    <button type="submit" class="btn btn-primary" name="proses">Simpan</button>
    <button type="reset" class="btn btn-danger" name="unproses">Batal</button>
</form>
@endsection
