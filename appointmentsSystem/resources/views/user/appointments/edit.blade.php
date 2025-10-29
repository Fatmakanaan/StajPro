@extends('layouts.app')
@section('title','Randevu Düzenle')
@section('content')
<h3>Randevu Düzenle</h3>
<form action="{{ route('user.appointments.update', $appointment) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label>Tarih ve Saat</label>
    <input type="datetime-local" name="appointment_date" value="{{ $appointment->appointment_date->format('Y-m-d\TH:i') }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Açıklama</label>
    <textarea name="purpose" class="form-control">{{ $appointment->purpose }}</textarea>
  </div>
  <button class="btn btn-primary">Güncelle</button>
</form>
@endsection
