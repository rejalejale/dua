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

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header py-3 d-flex">
            <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Jadwal') }}</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">
                        <span class="text">{{ __('Go Back') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama">{{ __('nama') }}</label>
                        <select class="form-control" name="nama" id="nama">
                            @foreach($customers as $id => $customer)
                                <option value="{{ $customer }}" {{ $booking->nama == $customer ? "selected" : '' }}>{{ $customer }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mobil">{{ __('kendaraan') }}</label>
                        <select class="form-control" name="mobil" id="mobil">
                            @foreach($rooms as $id => $room)
                                <option value="{{ $room }}" {{ $booking->mobil == $room ? "selected" : '' }}>{{ $room }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tujuan">{{ __('tujuan') }}</label>
                        <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ old('tujuan', $booking->tujuan) }}" />
                    </div>
                    <div class="form-group">
                        <label for="bidang">{{ __('bidang') }}</label>
                        <input type="text" class="form-control" id="bidang" name="bidang" value="{{ old('bidang', $booking->bidang) }}" />
                    </div>
                    <div class="form-group">
                        <label for="keterangan">{{ __('keterangan') }}</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', $booking->keterangan) }}" />
                    </div>
                    <div class="form-group">
                        <label for="berangkat">{{ __('berangkat') }}</label>
                        <input type="text" class="form-control datetimepicker" id="berangkat" name="berangkat" value="{{ old('berangkat', $booking->berangkat) }}" />
                    </div>
                    <div class="form-group">
                        <label for="pulang">{{ __('pulang') }}</label>
                        <input type="text" class="form-control datetimepicker" id="pulang" name="pulang" value="{{ old('pulang', $booking->pulang) }}" />
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
            format: "YYYY-MM-DD HH:mm"
        });
    </script>
@endpush