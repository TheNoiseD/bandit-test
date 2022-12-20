<?php

namespace App\Http\Controllers;

use App\DataTables\BookingsDataTable;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    protected $booking;
    public function __construct(Booking $booking){
        $this->booking = $booking;
    }

    public function index(Request $request,BookingsDataTable $dataTable)
    {
        if ($request->ajax()) {
            return $dataTable->ajax();
        }else{
            return view('bookings.index');
        }
    }

    public function store(BookingRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $ajax_request = false;
        if($request->ajax()){
            $ajax_request = true;
        }
        try {
            $this->booking->create($validated);
            if ($ajax_request) {
                return response()->json(['redirectTo' => route('reserve.index')], 200);
            }else{
                return redirect()->route('reserve.index')->with('success','Booking created successfully.');
            }
        }catch (\Exception $e){
            if ($ajax_request) {
                return response()->json(['message' => 'Error al crear la reserva'], 500);
            }else {
                return redirect()->route('reserve.index')->with('error', 'Booking not created.');
            }
        }
    }
}
