@extends('layouts.admin')
@section('content')

<div class="container">    
    <div class="card">
        

        <div class="card-body">
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control select2" name="customer_id" id="customer_id">
                                @foreach($customers as $id => $customer)
                                    <option value="{{ $customer }}" {{ request()->input('customer_id') == $id ? 'selected' : '' }}>{{ $customer }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <button class="btn btn-primary mt">
                            Filter
                        </button>
                    </div>
                    <div class="col-md-5">
                        <a href="{{ route('admin.system_calendars.index') }}" class="btn btn-primary mt-1">
                        <span class="icon text-white-50">
                            <i></i>
                        </span>
                        <span class="text">{{ __('Reset') }}</span>
                    </a>
                    </div>
                </div>
            </form>

            <div id='calendar'></div>
            <div class="row">
            <div class="col">
            <form onclick="return confirm('are you sure ? ')" class="d-inline" action="{{ route('admin.hancurkan.baby') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger mt-3">
                                            <i class="fa fa-trash"></i> Hapus Semua
                                        </button>
                </form>
                        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary float-right mt-3">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('Tambah Jadwal') }}</span>
                    </a>
                    </div>
                    
            </div>
        </div>
    </div>
</div>

@endsection

@push('script-alt')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
           
            bookings={!! json_encode($bookings) !!};
          
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: bookings


            });
        });
</script>


@endpush