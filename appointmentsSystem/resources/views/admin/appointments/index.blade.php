@extends('layouts.app')

@section('title','Admin - Randevular')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Randevular</h3>
    <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">Yeni Randevu</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Tarih</th>
            <th>Purpose</th>
            <th>Status</th>
            <th>User</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
    @forelse($appointments as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->client_name }}</td>
            <td>{{ $a->appointment_date }}</td>
            <td>{{ $a->purpose }}</td>
            <td>
               <span class="badge 
               @if($a->status=='pending') bg-warning text-dark
               @elseif($a->status=='approved') bg-success
               @elseif($a->status=='rejected') bg-danger
               @else bg-secondary @endif">{{ $a->status }}</span>
            </td>
            <td>{{ $a->user->name ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.appointments.edit', $a) }}" class="btn btn-sm btn-info">Düzenle</a>
                <form action="{{ route('admin.appointments.destroy',$a) }}" method="POST" style="display:inline" onsubmit="return confirm('Silinsin mi?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Sil</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7">Kayıtlı randevu bulunmamaktadır</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
