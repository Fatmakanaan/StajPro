@extends('layouts.app')
@section('title','Admin - Yeni Randevu')
@section('content')
<h3>Yeni Randevu (Admin)</h3>
<form action="{{ route('admin.appointments.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Kullanıcı</label>
    <select name="user_id" class="form-control">
      @foreach($users as $u)
        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
      @endforeach
    </select>
  </div>
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
  <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
      <option value="pending">pending</option>
      <option value="approved">approved</option>
      <option value="rejected">rejected</option>
      <option value="cancelled">cancelled</option>
    </select>
  </div>
  <button class="btn btn-primary">Kaydet</button>
</form>
@endsection
