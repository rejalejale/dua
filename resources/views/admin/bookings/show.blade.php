@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
   

    <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Detail Jadwal') }}
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                        <tr>
                            <th>Nama Driver</th>
                            <td>{{ $booking->nama }}</td>
                        </tr>
                        <tr>
                            <th>Nomor</th>
                            <td>{{ $driver->nomor }}</td>
                        </tr>
                        <tr>
                            <th>Kendaraan</th>
                            <td>{{ $booking->mobil }}</td>
                        </tr>
                        <tr>
                            <th>Tujuan</th>
                            <td>{{ $booking->tujuan }}</td>
                        </tr>
                        <tr>
                            <th>Bidang</th>
                            <td>{{ $booking->bidang }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $booking->keterangan }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Keberangkatan</th>
                            <td>{{ $booking->berangkat }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Kedatangan</th>
                            <td>{{ $booking->pulang }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $booking->status }}     
                                <a href="{{ route('admin.countries.edit', $booking->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i> Update
                                </a>     
                            </td>
                            
                        </tr>
                    </table>
                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i> Edit
                                    </a>
                                    <form onclick="return confirm('are you sure ? ')" class="d-inline" action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                </div>
            </div>
        </div>
    <!-- Content Row -->

</div>
@endsection