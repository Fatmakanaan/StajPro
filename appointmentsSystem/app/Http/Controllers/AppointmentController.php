<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminIndex()
    {
        $appointments = Appointment::with('user')->orderBy('appointment_date','desc')->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function adminCreate()
    {
        $users = User::all();
        return view('admin.appointments.create', compact('users'));
    }

    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'client_name'=>'required|string|max:255',
            'appointment_date'=>'required|date|after:now',
            'purpose'=>'nullable|string',
            'status'=>'required|in:pending,approved,rejected,cancelled'
        ]);

        Appointment::create($data);

        return redirect()->route('admin.appointments.index')->with('success','Randevu oluşturuldu');
    }

    public function index()
    {
        $appointments = Auth::user()->appointments()->orderBy('appointment_date','desc')->get();
        return view('user.appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('user.appointments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name'=>'required|string|max:255',
            'appointment_date'=>'required|date|after:now',
            'purpose'=>'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        Appointment::create($data);

        return redirect()->route('user.appointments.index')->with('success','Randevu talebiniz oluşturuldu');
    }

    public function edit(Appointment $appointment)
    {
        if($appointment->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('user.appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if($appointment->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'appointment_date'=>'required|date|after:now',
            'purpose'=>'nullable|string'
        ]);

        $appointment->update($data);

        return redirect()->route('user.appointments.index')->with('success','Randevunuz güncellendi');
    }

    public function cancel(Appointment $appointment)
    {
        if($appointment->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $appointment->update(['status'=>'cancelled']);

        return redirect()->route('user.appointments.index')->with('success','Randevunuz iptal edildi');
    }

    public function adminEdit(Appointment $appointment)
    {
        $users = User::all();
        return view('admin.appointments.edit', compact('appointment','users'));
    }

    public function adminUpdate(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'client_name'=>'required|string|max:255',
            'appointment_date'=>'required|date|after:now',
            'purpose'=>'nullable|string',
            'status'=>'required|in:pending,approved,rejected,cancelled'
        ]);

        $appointment->update($data);

        return redirect()->route('admin.appointments.index')->with('success','Randevu güncellendi');
    }

    public function destroy(Appointment $appointment)
    {
        if(Auth::user()->role !== 'admin') abort(403);
        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('success','Randevu silindi');
    }
}
