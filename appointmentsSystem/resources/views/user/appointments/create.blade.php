@extends('layouts.app')
@section('title','Yeni Randevu')
@section('content')
<h3>Yeni Randevu</h3>
<form action="{{ route('user.appointments.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Client Name</label>
    <input type="text" name="client_name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Tarih ve Saat</label>
    <input type="datetime-local" name="appointment_date" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Açıklama</label>
    <textarea name="purpose" class="form-control"></textarea>
  </div>
  <button class="btn btn-primary">Kaydet</button>
</form>
@endsection
