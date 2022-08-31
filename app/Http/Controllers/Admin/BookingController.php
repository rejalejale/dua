<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\jadwal;
use App\Models\supir;
use App\Models\mobil;
use App\Models\riwayat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\BookingRequest;
use DateTime;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('booking_access'), Response::HTTP_FORBIDDEN, 'Khusus ADMIN');

        $bookings = riwayat::all();

        return view('admin.bookings.index', compact('bookings'));
    }

     /**
     * Show the form for creating new Booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, 'khusus admin');

        //$customers = supir::get()->pluck('nama', 'id');
        $customers = supir::orderBy('nama','ASC')->get()->pluck('nama', 'id');
        $rooms = mobil::orderBy('model','ASC')->get()->pluck('model', 'id');
        //$rooms = mobil::get()->pluck('model', 'id');
        $roomId = $request->get('supir_id');
        $roomId1 = $request->get('mobil_id');
        $timeFrom = $request->get('berangkat');
        $timeTo = $request->get('pulang');

    return view('admin.bookings.create', compact('customers', 'rooms', 'roomId', 'roomId1', 'timeFrom', 'timeTo'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BookingRequest $r)
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $booking = jadwal::where('nama',$request->nama)->orWhere('mobil',$request->mobil)->get();
        function formatTanggaltostr($date){
            // menggunakan class Datetime
            $datetime = new DateTime( $date);
            return strtotime($datetime->format('Y-m-d'));
        }
        $rBerangkat = formatTanggaltoStr($request->berangkat);
        $rPulang = formatTanggaltoStr($request->pulang);
        
        foreach($booking as $a){
            $dataBerangkat = formatTanggaltoStr($a->berangkat);
            $dataPulang = formatTanggaltoStr($a->pulang);
            if($rBerangkat >= $dataBerangkat && $rBerangkat <= $dataPulang){
                return back()->with('error','Driver atau Kendaraan sudah terjadwal');
            }
            if($rPulang >= $dataBerangkat && $rPulang <= $dataPulang){
                return back()->with('error','Driver atau Kendaraan sudah terjadwal');
            }
            if($rBerangkat <= $dataBerangkat && $rPulang >= $dataBerangkat){
                return back()->with('error','Driver atau Kendaraan sudah terjadwal');
            }
        }
        // dd($booking);
        jadwal::create($r->validated());
        riwayat::create($r->validated());

        return redirect()->route('admin.system_calendars.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

     /**
     * Display Booking.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(jadwal $booking)
    {
        $driver = supir::where('nama',$booking->nama)->get();
        $driver = $driver[0];


        return view('admin.bookings.show', compact('booking','driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal $booking)
    {
        abort_if(Gate::denies('booking_edit'), Response::HTTP_FORBIDDEN, 'khusus admin');

        $customers = supir::get()->pluck('nama', 'id');
        $rooms = mobil::get()->pluck('model', 'id');

        return view('admin.bookings.edit', compact('booking', 'customers', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookingRequest $r, jadwal $booking, Request $request, riwayat $riwayat)
    {
        abort_if(Gate::denies('booking_edit'), Response::HTTP_FORBIDDEN, 'khusus admin');

        $booking = jadwal::where('nama',$request->nama)->orWhere('mobil',$request->mobil)->get();
        function formatTanggaltostr($date){
            // menggunakan class Datetime
            $datetime = new DateTime( $date);
            return strtotime($datetime->format('Y-m-d'));
        }
        $rBerangkat = formatTanggaltoStr($request->berangkat);
        $rPulang = formatTanggaltoStr($request->pulang);
        
        foreach($booking as $a){
            $dataBerangkat = formatTanggaltoStr($a->berangkat);
            $dataPulang = formatTanggaltoStr($a->pulang);
            if($rBerangkat >= $dataBerangkat && $rBerangkat <= $dataPulang){
                return back()->with('error','Driver atau Kendaraan sudah terjadwal');
            }
            if($rPulang >= $dataBerangkat && $rPulang <= $dataPulang){
                return back()->with('error','Driver atau Kendaraan sudah terjadwal');
            }
            if($rBerangkat <= $dataBerangkat && $rPulang >= $dataBerangkat){
                return back()->with('error','Driver atau Kendaraan sudah terjadwal');
            }
        }

        $booking->update($r->validated());
        $riwayat->update($r->validated());

        return redirect()->route('admin.system_calendars.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwal $booking)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, 'khusus admin');
        $booking->delete();

        return redirect()->route('admin.system_calendars.index')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
    public function updateStatus(jadwal $booking)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, 'khusus admin');
        dd($booking->status);
        $booking->delete();

        return redirect()->route('admin.system_calendars.index')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

        /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, 'khusus admin');

        jadwal::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    public function hancurkan(Request $request)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, 'khusus admin');

        riwayat::whereNotNull('id')->delete();  

        return redirect()->route('admin.bookings.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function leburkan(Request $request)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, 'khusus admin');

        jadwal::whereNotNull('id')->delete();  

        return redirect()->route('admin.system_calendars.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }
}
