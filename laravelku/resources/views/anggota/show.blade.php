@extends('layouts.index')
@section('content')
    @foreach($ar_anggota as $a)
    <div class="card" style="width: 18rem;">
        @php
            if (!empty($a->foto)){
            @endphp
                <img src="{{  asset('images')}}/{{ $a->foto }}" width="60%" class="card-img-top" />
            @php
            } else {
            @endphp
                <img src="{{  asset('images')}}/nophoto.jpg" width="60%" class="card-img-top" />
            @php
            }
        @endphp
        <div class="card-body">
            <h5 class="card-title">{{ $a->nama }}</h5>
            <p class="card-text">
                Email: {{ $a->email }}
                <br/>HP: {{ $a->hp }}
            </p>
            <a href="{{ url('/anggota') }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
    @endforeach
@endsection
