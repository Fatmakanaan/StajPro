@extends('layouts.app')
@section('title','Randevularım')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Randevularım</h3>
    <a href="{{ route('user.appointments.create') }}" class="btn btn-primary">Yeni Randevu</a>
</div>

<table class="table table-striped">
    <thead><tr><th>ID</th><th>Client</th><th>Tarih</th><th>Purpose</th><th>Status</th><th>İşlemler</th></tr></thead>
    <tbody>
    @forelse($appointments as $a)
      <tr>
        <td>{{ $a->id }}</td>
        <td>{{ $a->client_name }}</td>
        <td>{{ $a->appointment_date }}</td>
        <td>{{ $a->purpose }}</td>
        <td>{{ $a->status }}</td>
        <td>
          <a href="{{ route('user.appointments.edit', $a) }}" class="btn btn-sm btn-secondary">Düzenle</a>
          <form action="{{ route('user.appointments.cancel', $a) }}" method="POST" style="display:inline" onsubmit="return confirm('İptal edilsin mi?')">
            @csrf
            <button class="btn btn-sm btn-danger">İptal Et</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Henüz randevun yok.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
