@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Data Driver')}}</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama">{{ __('nama') }}</label>
                        <input type="text" class="form-control" id="nama" placeholder="{{ __('nama') }}" name="nama" value="{{ old('nama', $user->nama) }}" />
                    </div>
                    <div class="form-group">
                        <label for="nomor">{{ __('no.telp') }}</label>
                        <input type="nomor" class="form-control" id="nomor" placeholder="{{ __('nomor') }}" name="nomor" value="{{ old('nomor',  $user->nomor) }}" />
                    </div>
                    <div class="form-group">
                        <label for="warna">warna</label>
                        <input type="color" class="form-control" id="warna" placeholder="{{ __('warna') }}" name="warna" value="{{ old('warna', $user->warna) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection