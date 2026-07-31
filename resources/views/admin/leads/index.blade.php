@extends('layouts.admin')
@section('title', 'Leads CRM')
@section('page-title', 'Leads CRM')
@section('page-subtitle', 'Kelola prospek, status, follow-up, dan assign agent.')

@section('content')

{{-- Stats Mini Cards --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:14px;margin-bottom:24px;">
    @php
    $statItems = [
        [
            'label' => 'Total Leads',
            'value' => $stats['total'],
            'color' => '#6366f1',
            'icon'  => '<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
        ],
        [
            'label' => 'Lead Baru',
            'value' => $stats['new'],
            'color' => '#3b82f6',
            'icon'  => '<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/></svg>',
        ],
        [
            'label' => 'Won',
            'value' => $stats['won'],
            'color' => '#10b981',
            'icon'  => '<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        ],
        [
            'label' => 'Lost',
            'value' => $stats['lost'],
            'color' => '#ef4444',
            'icon'  => '<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        ],
        [
            'label' => 'Overdue Follow-up',
            'value' => $stats['overdue'],
            'color' => '#f59e0b',
            'icon'  => '<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        ],
    ];
    @endphp
    @foreach($statItems as $s)
    <div style="background:#fff;border-radius:14px;padding:16px 18px;border:1px solid #f3f4f6;display:flex;flex-direction:column;gap:6px;box-shadow:0 1px 4px rgba(0,0,0,.06);border-top:3px solid {{ $s['color'] }};">
        <span style="color:{{ $s['color'] }};">{!! $s['icon'] !!}</span>
        <span style="font-size:24px;font-weight:800;color:{{ $s['color'] }};line-height:1;">{{ $s['value'] }}</span>
        <span style="font-size:11px;color:#6b7280;font-weight:500;text-transform:uppercase;letter-spacing:.03em;">{{ $s['label'] }}</span>
    </div>
    @endforeach
</div>

{{-- CRM Panel --}}
<div class="panel">
    {{-- Header + Actions --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:20px;">
        <h2 style="font-size:15px;font-weight:700;color:#111827;margin:0;">Daftar Leads</h2>
        <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">
            <a href="{{ route('admin.leads.analytics') }}"
               style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:#6366f1;color:#fff;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Analytics
            </a>
            <a href="{{ route('admin.leads.tags') }}"
               style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:#f59e0b;color:#fff;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                Kelola Tag
            </a>
            <a href="{{ route('admin.leads.export', request()->query()) }}"
               style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:#10b981;color:#fff;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export CSV
            </a>
        </div>
    </div>

    {{-- Filter Bar --}}
    <form method="GET" action="{{ route('admin.leads.index') }}"
          style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px;align-items:center;padding:14px 16px;background:#f9fafb;border-radius:10px;border:1px solid #f3f4f6;">
        <div style="position:relative;flex:1;min-width:200px;">
            <svg width="14" height="14" fill="none" stroke="#9ca3af" viewBox="0 0 24 24" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, WA, perusahaan..."
                   style="width:100%;padding:7px 12px 7px 32px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;box-sizing:border-box;">
        </div>

        <select name="status" style="padding:7px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#fff;color:#374151;">
            <option value="">Semua Status</option>
            @foreach($statuses as $key => $label)
                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>

        <select name="agent" style="padding:7px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#fff;color:#374151;">
            <option value="">Semua Agent</option>
            @foreach($agents as $agent)
                <option value="{{ $agent->id }}" {{ request('agent') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
            @endforeach
        </select>

        <select name="tag" style="padding:7px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;background:#fff;color:#374151;">
            <option value="">Semua Tag</option>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
        </select>

        <label style="display:flex;align-items:center;gap:5px;font-size:13px;color:#374151;white-space:nowrap;cursor:pointer;">
            <input type="checkbox" name="overdue" value="1" {{ request('overdue') ? 'checked' : '' }}>
            Overdue Follow-up
        </label>

        <button type="submit" class="btn-primary" style="padding:7px 16px;font-size:13px;display:inline-flex;align-items:center;gap:5px;">
            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
            Filter
        </button>
        @if(request()->hasAny(['search','status','agent','tag','overdue']))
            <a href="{{ route('admin.leads.index') }}"
               style="display:inline-flex;align-items:center;gap:4px;padding:7px 12px;font-size:13px;color:#6b7280;text-decoration:none;border:1px solid #e5e7eb;border-radius:8px;background:#fff;">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                Reset
            </a>
        @endif
    </form>

    {{-- Table --}}
    <div style="overflow-x:auto;">
        <table class="admin-table" id="leads-table">
            <thead>
                <tr>
                    <th style="width:85px;">TANGGAL</th>
                    <th>NAMA / CATATAN</th>
                    <th style="width:140px;">NO. WA</th>
                    <th style="width:120px;">PERUSAHAAN</th>
                    <th style="width:160px;">KEBUTUHAN</th>
                    <th style="width:120px;">STATUS</th>
                    <th style="width:120px;">AGENT</th>
                    <th style="width:140px;">TAGS</th>
                    <th style="width:115px;">FOLLOW-UP</th>
                    <th style="width:120px;">SUMBER</th>
                    <th style="width:80px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                <tr id="lead-row-{{ $lead->id }}" style="{{ $lead->is_followup_overdue ? 'background:#fffbeb;' : '' }}">

                    {{-- Tanggal --}}
                    <td style="white-space:nowrap;">
                        <span style="font-size:12px;color:#374151;font-weight:500;">{{ $lead->created_at->format('d M Y') }}</span><br>
                        <span style="font-size:11px;color:#9ca3af;">{{ $lead->created_at->format('H:i') }}</span>
                    </td>

                    {{-- Nama + Notes preview --}}
                    <td>
                        <span style="font-weight:600;color:#111827;font-size:13px;">{{ $lead->name }}</span>
                        @if($lead->notes)
                            <div style="font-size:11px;color:#6b7280;margin-top:3px;font-style:italic;">{{ Str::limit($lead->notes, 45) }}</div>
                        @endif
                    </td>

                    {{-- Phone --}}
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}" target="_blank"
                           style="color:#16a34a;text-decoration:none;font-size:12px;display:inline-flex;align-items:center;gap:5px;font-weight:500;">
                            <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.002 21.867c-1.579 0-3.078-.403-4.382-1.118l-5.618 1.476 1.503-5.474c-.792-1.343-1.209-2.906-1.209-4.551 0-5.441 4.428-9.867 9.867-9.867 5.441 0 9.868 4.426 9.868 9.867 0 5.442-4.427 9.867-9.868 9.867z"/></svg>
                            {{ $lead->phone }}
                        </a>
                    </td>

                    {{-- Perusahaan --}}
                    <td style="font-size:12px;color:#374151;">{{ $lead->company ?? '—' }}</td>

                    {{-- Kebutuhan --}}
                    <td style="font-size:12px;color:#4b5563;max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $lead->needs }}">
                        {{ $lead->needs }}
                    </td>

                    {{-- Status (inline editable) --}}
                    <td>
                        <select class="status-select" data-lead="{{ $lead->id }}" data-url="{{ route('admin.leads.update', $lead) }}"
                                style="font-size:11px;font-weight:600;padding:5px 8px;border-radius:8px;border:2px solid {{ $lead->status_color }};color:{{ $lead->status_color }};background:{{ $lead->status_color }}18;cursor:pointer;width:100%;appearance:auto;">
                            @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" {{ $lead->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </td>

                    {{-- Agent --}}
                    <td>
                        <select class="agent-select" data-lead="{{ $lead->id }}" data-url="{{ route('admin.leads.update', $lead) }}"
                                style="font-size:11px;padding:5px 6px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;cursor:pointer;width:100%;color:#374151;">
                            <option value="">— Unassigned</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ $lead->assigned_to == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    {{-- Tags --}}
                    <td>
                        <div style="display:flex;flex-wrap:wrap;gap:3px;margin-bottom:4px;" id="tags-{{ $lead->id }}">
                            @foreach($lead->tags as $tag)
                                <span style="background:{{ $tag->color }}20;color:{{ $tag->color }};border:1px solid {{ $tag->color }}50;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:3px;"
                                      onclick="removeTag({{ $lead->id }}, {{ $tag->id }}, this)"
                                      title="Klik untuk hapus">
                                    {{ $tag->name }}
                                    <svg width="9" height="9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                </span>
                            @endforeach
                        </div>
                        <select class="tag-add-select" data-lead="{{ $lead->id }}"
                                style="font-size:10px;padding:3px 6px;border:1px dashed #d1d5db;border-radius:6px;background:#fff;cursor:pointer;width:100%;color:#6b7280;">
                            <option value="">+ Tambah Tag</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    {{-- Follow-up --}}
                    <td>
                        @if($lead->is_followup_overdue)
                            <div style="display:inline-flex;align-items:center;gap:4px;background:#fef3c7;color:#d97706;padding:3px 7px;border-radius:6px;font-size:10px;font-weight:600;margin-bottom:4px;width:100%;box-sizing:border-box;">
                                <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                                Terlambat
                            </div>
                        @endif
                        <input type="date" class="followup-input" data-lead="{{ $lead->id }}" data-url="{{ route('admin.leads.update', $lead) }}"
                               value="{{ $lead->followup_at?->format('Y-m-d') ?? '' }}"
                               style="font-size:11px;padding:4px 6px;border:1px solid #e5e7eb;border-radius:6px;width:100%;cursor:pointer;box-sizing:border-box;color:#374151;">
                    </td>

                    {{-- Sumber --}}
                    <td style="font-size:11px;max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        @if($lead->source_url)
                            <a href="{{ $lead->source_url }}" target="_blank"
                               style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;gap:3px;" title="{{ $lead->source_url }}">
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                {{ str_replace(['http://','https://','hvmdigital.id'], '', $lead->source_url) ?: '/' }}
                            </a>
                        @else
                            <span style="color:#d1d5db;">—</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td>
                        <button onclick="openNotesModal({{ $lead->id }}, '{{ addslashes($lead->name) }}', `{{ addslashes($lead->notes ?? '') }}`)"
                                style="display:inline-flex;align-items:center;justify-content:center;gap:4px;padding:5px 8px;font-size:11px;background:#6366f1;color:#fff;border:none;border-radius:6px;cursor:pointer;margin-bottom:5px;width:100%;font-weight:500;">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Catatan
                        </button>
                        <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Hapus lead ini?');">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="display:inline-flex;align-items:center;justify-content:center;gap:4px;padding:5px 8px;font-size:11px;background:#fef2f2;color:#ef4444;border:1px solid #fecaca;border-radius:6px;cursor:pointer;width:100%;font-weight:500;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" style="text-align:center;padding:60px 14px;color:#9ca3af;">
                        <svg width="40" height="40" fill="none" stroke="#d1d5db" viewBox="0 0 24 24" style="margin:0 auto 12px;display:block;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <div style="font-size:13px;">Belum ada data leads.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:20px;">{{ $leads->links() }}</div>
</div>

{{-- Notes Modal --}}
<div id="notes-modal" style="display:none;position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,.45);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:28px;width:90%;max-width:500px;box-shadow:0 20px 60px rgba(0,0,0,.25);">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px;">
            <svg width="18" height="18" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            <h3 id="notes-modal-title" style="font-size:15px;font-weight:700;margin:0;color:#111827;"></h3>
        </div>
        <textarea id="notes-textarea" rows="6" placeholder="Tambahkan catatan tentang lead ini..."
                  style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:10px;font-size:13px;resize:vertical;font-family:inherit;box-sizing:border-box;color:#374151;line-height:1.6;"></textarea>
        <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:14px;">
            <button onclick="document.getElementById('notes-modal').style.display='none'"
                    style="padding:8px 18px;border:1px solid #e5e7eb;border-radius:8px;background:#fff;cursor:pointer;font-size:13px;color:#374151;">
                Batal
            </button>
            <button id="notes-save-btn" onclick="saveNotes()"
                    style="padding:8px 18px;background:#6366f1;color:#fff;border:none;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">
                Simpan
            </button>
        </div>
    </div>
</div>

<script>
const csrfToken = '{{ csrf_token() }}';
let currentLeadId = null;

// Status update inline
document.querySelectorAll('.status-select').forEach(sel => {
    sel.addEventListener('change', function () {
        const colors = @json(\App\Models\Lead::$statusColors);
        patchLead(this.dataset.url, { status: this.value }, () => {
            const c = colors[this.value] || '#6b7280';
            this.style.borderColor = c;
            this.style.color       = c;
            this.style.background  = c + '18';
        });
    });
});

// Agent assign inline
document.querySelectorAll('.agent-select').forEach(sel => {
    sel.addEventListener('change', function () {
        patchLead(this.dataset.url, { assigned_to: this.value || '' });
    });
});

// Follow-up date
document.querySelectorAll('.followup-input').forEach(inp => {
    inp.addEventListener('change', function () {
        patchLead(this.dataset.url, { followup_at: this.value || '' });
    });
});

// Tag add
document.querySelectorAll('.tag-add-select').forEach(sel => {
    sel.addEventListener('change', function () {
        if (!this.value) return;
        fetch(`/admin/leads/${this.dataset.lead}/add-tag`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({ tag_id: this.value })
        }).then(r => r.json()).then(d => { if (d.success) location.reload(); });
        this.value = '';
    });
});

// Tag remove
function removeTag(leadId, tagId, el) {
    if (!confirm('Hapus tag ini dari lead?')) return;
    fetch(`/admin/leads/${leadId}/remove-tag`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ tag_id: tagId })
    }).then(r => r.json()).then(d => { if (d.success) el.remove(); });
}

// Notes modal
function openNotesModal(leadId, leadName, notes) {
    currentLeadId = leadId;
    document.getElementById('notes-modal-title').textContent = 'Catatan untuk: ' + leadName;
    document.getElementById('notes-textarea').value = notes;
    document.getElementById('notes-modal').style.display = 'flex';
}

function saveNotes() {
    patchLead(`/admin/leads/${currentLeadId}`, { notes: document.getElementById('notes-textarea').value }, () => {
        document.getElementById('notes-modal').style.display = 'none';
        location.reload();
    });
}

// Generic PATCH
function patchLead(url, data, cb) {
    fetch(url, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(d => { if (d.success && cb) cb(d); })
    .catch(e => console.error(e));
}

// Close modal on backdrop
document.getElementById('notes-modal').addEventListener('click', function(e) {
    if (e.target === this) this.style.display = 'none';
});
</script>
@endsection
