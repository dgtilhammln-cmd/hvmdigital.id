@extends('layouts.admin')
@section('title', 'Manajemen Akses & Role')
@section('page-title', 'Akses Admin')
@section('page-subtitle', 'Kelola hak akses pengguna untuk masuk ke dalam panel admin.')

@section('content')
<div class="panel">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <h2 style="font-size:16px;font-weight:600;color:#111827;margin:0;">Daftar Admin & Tim</h2>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Baru
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th style="width:120px;text-align:right;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td style="font-weight:500;">{{ $u->name }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        @if($u->role === 'admin')
                            <span class="badge-blue">Admin (Full Access)</span>
                        @elseif($u->role === 'copywriter')
                            <span class="badge-green">Copywriter</span>
                        @else
                            <span class="badge-gray">{{ $u->role }}</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <a href="{{ route('admin.users.edit', $u) }}" class="btn-secondary" style="padding:4px 8px;font-size:11px;">Edit</a>
                        @if($u->id !== session('admin_id'))
                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger" style="padding:4px 8px;font-size:11px;">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
