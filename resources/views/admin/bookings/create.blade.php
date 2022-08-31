@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header py-3 d-flex">
            <h1 class="h3 mb-0 text-gray-800">{{ __('Tambah Jadwal') }}</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin.system_calendars.index') }}" class="btn btn-primary">
                        <span class="text">{{ __('Go Back') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bookings.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">{{ __('Nama') }}</label>
                        <select class="form-control" name="nama" id="nama">
                            @foreach($customers as $id => $customer)
                                <option value="{{ $customer }}">{{ $customer }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mobil">{{ __('Kendaraan') }}</label>
                        <select class="form-control" name="mobil" id="mobil">
                            @foreach($rooms as $id => $room)
                                <option {{ $roomId == $id ? 'selected' : null }} value="{{ $room }}">{{ $room }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tujuan">{{ __('tujuan') }}</label>
                        <input class="form-control" name="tujuan" id="tujuan"  cols="10" rows="10">{{ old('tujuan') }}</input>
                    </div>
                    <div class="form-group">
                        <label for="bidang">{{ __('bidang') }}</label>
                        <input class="form-control" name="bidang" id="bidang"  cols="30" rows="10"></input>
                    </div>       
                        <div class="form-group">
                        <label for="keterangan">{{ __('keterangan') }}</label>
                        <input class="form-control" name="keterangan" id="keterangan"  cols="30" rows="10">{{ old('keterangan') }}</input>
                    </div>
                    <div class="form-group">
                        <label for="berangkat">{{ __('Time From') }}</label>
                        <input type="text" class="form-control datetimepicker" id="berangkat" name="berangkat" value="{{ old('berangkat', $timeFrom) }}" />
                    </div>
                    <div class="form-group">
                        <label for="pulang">{{ __('Time to') }}</label>
                        <input type="text" class="form-control datetimepicker" id="pulang" name="pulang" value="{{ old('pulang', $timeTo) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection

@push('style-alt')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endpush

@push('script-alt')
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            locale: 'en',
            sideBySide: true,
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            },
            stepping: 10
        });
    </script>
@endpush