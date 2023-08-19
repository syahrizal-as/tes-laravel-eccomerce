@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Website Analytics-->
            <div class="col-md-12 mb-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Selamat Datang {{ auth()->user()->name }}</h4>

                        @php
                            $value = Carbon\Carbon::parse(date('Y-m-d H:i'));
                            $parse = $value->locale('id');
                            
                        @endphp
                        <h6> {{ $parse->translatedFormat('l, d F Y H:i') }} </h6>

                    </div>
                </div>



            </div>



        </div>


    </div>
@endsection
