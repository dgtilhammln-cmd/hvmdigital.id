@extends('layouts.admin')
@section('title', 'Tambah Akses')
@section('page-title', 'Tambah Akses Admin')

@section('content')
<div class="panel" style="max-width:600px;">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div style="margin-bottom:16px;">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-input" value="{{ old('name') }}" required>
        </div>
        <div style="margin-bottom:16px;">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-input" value="{{ old('username') }}" required>
        </div>
        <div style="margin-bottom:16px;">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
        </div>
        <div style="margin-bottom:16px;">
            <label class="form-label">Role Akses</label>
            <select name="role" class="form-select" required>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
                <option value="copywriter" {{ old('role') == 'copywriter' ? 'selected' : '' }}>Copywriter (Hanya Artikel & Blog)</option>
            </select>
        </div>
        <div style="margin-bottom:16px;">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" required>
        </div>
        <div style="margin-bottom:24px;">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input" required>
        </div>
        
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn-primary">Simpan Admin</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
