@extends('layouts.app')
@section('title','Admin - Randevu Düzenle')
@section('content')
<h3>Randevu Düzenle (Admin)</h3>
<form action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label>Kullanıcı</label>
    <select name="user_id" class="form-control">
      @foreach($users as $u)
        <option value="{{ $u->id }}" @if($u->id == $appointment->user_id) selected @endif>{{ $u->name }} ({{ $u->email }})</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Client Name</label>
    <input type="text" name="client_name" value="{{ $appointment->client_name }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Tarih ve Saat</label>
    <input type="datetime-local" name="appointment_date" value="{{ $appointment->appointment_date->format('Y-m-d\TH:i') }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Açıklama</label>
    <textarea name="purpose" class="form-control">{{ $appointment->purpose }}</textarea>
  </div>
  <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
      <option value="pending" @if($appointment->status=='pending') selected @endif>pending</option>
      <option value="approved" @if($appointment->status=='approved') selected @endif>approved</option>
      <option value="rejected" @if($appointment->status=='rejected') selected @endif>rejected</option>
      <option value="cancelled" @if($appointment->status=='cancelled') selected @endif>cancelled</option>
    </select>
  </div>
  <button class="btn btn-primary">Güncelle</button>
</form>
@endsection
