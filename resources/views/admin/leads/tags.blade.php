@extends('layouts.admin')
@section('title', 'Kelola Tag Leads')
@section('page-title', 'Kelola Tag Leads')
@section('page-subtitle', 'Buat dan kelola label/tag untuk kategorisasi leads.')

@section('content')

<div style="display:grid;grid-template-columns:340px 1fr;gap:20px;align-items:start;">

    {{-- Form Tambah Tag --}}
    <div class="panel" style="padding:24px;">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
            <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <h3 style="font-size:14px;font-weight:700;color:#111827;margin:0;">Tambah Tag Baru</h3>
        </div>
        <form method="POST" action="{{ route('admin.leads.tags.store') }}">
            @csrf
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:.04em;">Nama Tag</label>
                <input type="text" name="name" required placeholder="Contoh: Hot Lead, SEO, Website..."
                       style="width:100%;padding:9px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;box-sizing:border-box;color:#374151;">
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:.04em;">Warna</label>
                <div style="display:flex;align-items:center;gap:10px;">
                    <input type="color" name="color" value="#6366f1"
                           style="width:48px;height:40px;padding:2px;border:1px solid #e5e7eb;border-radius:8px;cursor:pointer;background:#fff;">
                    <div style="font-size:12px;color:#6b7280;">Pilih warna untuk badge tag</div>
                </div>
            </div>
            <button type="submit"
                    style="width:100%;display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:10px;background:#6366f1;color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Simpan Tag
            </button>
        </form>
    </div>

    {{-- Daftar Tags --}}
    <div class="panel" style="padding:24px;">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
            <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
            <h3 style="font-size:14px;font-weight:700;color:#111827;margin:0;">Semua Tag ({{ $tags->count() }})</h3>
        </div>

        @if($tags->isEmpty())
            <div style="text-align:center;padding:40px;color:#9ca3af;">
                <svg width="36" height="36" fill="none" stroke="#d1d5db" viewBox="0 0 24 24" style="margin:0 auto 12px;display:block;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                <div style="font-size:13px;">Belum ada tag. Buat tag pertama Anda.</div>
            </div>
        @else
            <div style="display:flex;flex-direction:column;gap:8px;">
                @foreach($tags as $tag)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border:1px solid #f3f4f6;border-radius:10px;background:#fafafa;gap:12px;">
                    <div style="display:flex;align-items:center;gap:12px;flex:1;">
                        <div style="width:12px;height:12px;border-radius:50%;background:{{ $tag->color }};flex-shrink:0;"></div>
                        <span style="background:{{ $tag->color }}20;color:{{ $tag->color }};border:1px solid {{ $tag->color }}50;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                            {{ $tag->name }}
                        </span>
                        <span style="font-size:12px;color:#9ca3af;">
                            {{ $tag->leads_count }} lead{{ $tag->leads_count != 1 ? 's' : '' }}
                        </span>
                    </div>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <span style="font-size:11px;color:#9ca3af;">{{ $tag->color }}</span>
                        <form action="{{ route('admin.leads.tags.destroy', $tag) }}" method="POST"
                              onsubmit="return confirm('Hapus tag \'{{ $tag->name }}\'? Tag ini akan dicopot dari semua leads.')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="display:inline-flex;align-items:center;gap:4px;padding:5px 10px;background:#fef2f2;color:#ef4444;border:1px solid #fecaca;border-radius:6px;cursor:pointer;font-size:11px;font-weight:500;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div style="margin-top:20px;">
    <a href="{{ route('admin.leads.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#6366f1;font-size:13px;text-decoration:none;font-weight:500;">
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Leads
    </a>
</div>
@endsection
