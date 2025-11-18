@extends('membe.tamplate')
@section('title', 'Dashboard Member')
@section('content')
@csrf
<div class="container mt-4">
    <div class="col-md-3 mb-4">
        @php
            $toko = Auth::user()->Toko;
        @endphp
        @if (!$toko)
        <div class="card text-black">
            <div class="container" style="height: 400px ; widht: 640px">
                <p>jika anda tertarik membuat toko di weeb ini hubungi admin</p>
                <a href=""><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        @else
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Prodak</h5>
                    </div>
                    <i class="fa-solid fa-users fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
