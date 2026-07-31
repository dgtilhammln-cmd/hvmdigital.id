@extends('layouts.admin')
@section('title', 'Edit Akses')
@section('page-title', 'Edit Akses Admin')

@section('content')
<div class="panel" style="max-width:600px;">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        <div style="margin-bottom:16px;">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
        </div>
        <div style="margin-bottom:16px;">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-input" value="{{ old('username', $user->username) }}" required>
        </div>
        <div style="margin-bottom:16px;">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
        </div>
        <div style="margin-bottom:16px;">
            <label class="form-label">Role Akses</label>
            <select name="role" class="form-select" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
                <option value="copywriter" {{ old('role', $user->role) == 'copywriter' ? 'selected' : '' }}>Copywriter (Hanya Artikel & Blog)</option>
            </select>
        </div>
        
        <div style="margin-top:24px;border-top:1px solid #e5e7eb;padding-top:20px;margin-bottom:16px;">
            <div style="font-size:12px;color:#6b7280;margin-bottom:12px;">*Kosongkan jika tidak ingin mengubah password.</div>
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-input">
        </div>
        <div style="margin-bottom:24px;">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-input">
        </div>
        
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn-primary">Update Admin</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
