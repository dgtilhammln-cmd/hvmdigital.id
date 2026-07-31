{{-- ===== WA DUAL AGENT BUTTON — Bottom RIGHT ===== --}}
<style>
#hvm-wa-widget { position:fixed; bottom:24px; right:24px; z-index:9999; display:flex; flex-direction:column; align-items:flex-end; gap:10px; }
#hvm-wa-panel  { display:none; flex-direction:column; gap:10px; margin-bottom:4px; width:300px; }
#hvm-wa-panel.open { display:flex; }
.wa-agent-card { display:flex; align-items:center; gap:12px; background:#fff; border-radius:16px; padding:14px 16px; box-shadow:0 8px 32px rgba(0,0,0,0.15); text-decoration:none; border:1px solid rgba(154,203,3,0.2); transition:all .2s; }
.wa-agent-card:hover { transform:translateY(-2px); box-shadow:0 12px 40px rgba(0,0,0,0.2); border-color:rgba(154,203,3,0.5); }
.wa-agent-card .img { width:48px; height:48px; border-radius:50%; object-fit:cover; border:2px solid rgba(154,203,3,0.4); flex-shrink:0; }
.wa-agent-card .info p { margin:0; line-height:1.3; }
.wa-agent-card .info .name { font-weight:700; font-size:13px; color:#0a1f12; }
.wa-agent-card .info .role { font-size:11px; color:#888; font-weight:400; }
.wa-agent-card .info .num  { font-size:10px; color:#9acb03; font-weight:700; margin-top:2px; }
.wa-agent-card .wa-ico { flex-shrink:0; }
.wa-online-dot { width:10px; height:10px; background:#22c55e; border-radius:50%; border:2px solid #fff; position:absolute; bottom:0; right:0; }
.wa-agent-img-wrap { position:relative; flex-shrink:0; }

/* New Custom Agent Toggle Button */
.wa-toggle-new-btn { display:flex; align-items:center; gap:14px; background:transparent; border:none; cursor:pointer; padding:0; outline:none; font-family:inherit; }
.wa-pill-bubble { background:#fff; color:#0a1f12; font-weight:600; font-size:15px; padding:12px 24px; border-radius:30px; box-shadow:0 8px 24px rgba(0,0,0,0.12); white-space:nowrap; border:1px solid rgba(154,203,3,0.3); transition:all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.wa-img-wrapper { position:relative; width:68px; height:68px; border-radius:50%; background:linear-gradient(135deg, #075749, #9acb03); padding:3px; box-shadow:0 8px 24px rgba(7,87,73,0.3); transition:all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.wa-img-wrapper img { width:100%; height:100%; object-fit:cover; border-radius:50%; border:2px solid #fff; background-color:#f8fdfa; }
.wa-pulse-dot { position:absolute; bottom:2px; right:2px; width:16px; height:16px; background:#22c55e; border-radius:50%; border:2px solid #fff; animation:wa-kembang-kempis 2s infinite; }

.wa-toggle-new-btn:hover .wa-img-wrapper { transform:scale(1.08) translateY(-2px); box-shadow:0 12px 30px rgba(154,203,3,0.4); }
.wa-toggle-new-btn:hover .wa-pill-bubble { border-color:#9acb03; box-shadow:0 8px 24px rgba(154,203,3,0.2); }

@keyframes wa-kembang-kempis {
    0% { transform:scale(0.95); box-shadow:0 0 0 0 rgba(34,197,94,0.7); }
    70% { transform:scale(1); box-shadow:0 0 0 12px rgba(34,197,94,0); }
    100% { transform:scale(0.95); box-shadow:0 0 0 0 rgba(34,197,94,0); }
}

.wa-header-bubble { background:linear-gradient(135deg,#053d33,#075749); border-radius:16px; padding:12px 18px; box-shadow:0 8px 24px rgba(0,0,0,0.2); }
.wa-header-bubble p { margin:0; line-height:1.4; }
@media(prefers-color-scheme:dark) { .wa-agent-card { background:#0d1f15; } .wa-agent-card .info .name { color:#fff; } .wa-pill-bubble { background:#0d1f15; color:#fff; border-color:rgba(255,255,255,0.1); } }
</style>

<div id="hvm-wa-widget">
    <div id="hvm-wa-panel">
        {{-- Header --}}
        <div class="wa-header-bubble">
            <p style="color:#9acb03;font-size:10px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;">HVM Digital — Chat Langsung</p>
            <p style="color:rgba(255,255,255,.6);font-size:12px;font-weight:300;margin-top:2px;">Pilih siapa yang ingin Anda hubungi</p>
        </div>

        {{-- Agent 1 --}}
        @php
            $agent1Name = setting('cs_agent_1_name', 'Ilham');
            $agent1Role = setting('cs_agent_1_role', 'Business Development');
            $agent1Wa   = setting('cs_agent_1_wa', '6285162612373');
            $agent1Init = strtoupper(substr($agent1Name, 0, 1));
        @endphp
        <a href="javascript:triggerLeadPopup('Halo {{ addslashes($agent1Name) }}, saya ingin konsultasi jasa website HVM Digital')"
           onclick="trackWaClick('agent-1')" class="wa-agent-card">
            <div class="wa-agent-img-wrap">
                <img src="{{ setting('cs_agent_1_avatar') ? get_image_url(setting('cs_agent_1_avatar')) : '' }}" alt="{{ $agent1Name }}" class="img"
                     onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2248%22 height=%2248%22><rect fill=%22%23075749%22 rx=%2224%22 width=%2248%22 height=%2248%22/><text x=%2224%22 y=%2229%22 text-anchor=%22middle%22 fill=%22white%22 font-size=%2220%22>{{ $agent1Init }}</text></svg>'">
                <span class="wa-online-dot"></span>
            </div>
            <div class="info" style="flex:1;min-width:0;">
                <p class="name">{{ $agent1Name }}</p>
                <p class="role">{{ $agent1Role }}</p>
                <p class="num">● +{{ $agent1Wa }}</p>
            </div>
            <svg class="wa-ico" width="28" height="28" fill="#25d366" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        </a>

        {{-- Agent 2 --}}
        @php
            $agent2Name = setting('cs_agent_2_name', 'HVM Digital Office');
            $agent2Role = setting('cs_agent_2_role', 'General Inquiry & Sales');
            $agent2Wa   = setting('cs_agent_2_wa', '6285179982373');
            $agent2Init = strtoupper(substr($agent2Name, 0, 1));
        @endphp
        <a href="javascript:triggerLeadPopup('Halo {{ addslashes($agent2Name) }}, saya ingin konsultasi jasa website')"
           onclick="trackWaClick('agent-2')" class="wa-agent-card">
            <div class="wa-agent-img-wrap">
                <img src="{{ setting('cs_agent_2_avatar') ? get_image_url(setting('cs_agent_2_avatar')) : '' }}" alt="{{ $agent2Name }}" class="img"
                     onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2248%22 height=%2248%22><rect fill=%22%23053d33%22 rx=%2224%22 width=%2248%22 height=%2248%22/><text x=%2224%22 y=%2229%22 text-anchor=%22middle%22 fill=%22white%22 font-size=%2216%22>{{ $agent2Init }}</text></svg>'">
                <span class="wa-online-dot"></span>
            </div>
            <div class="info" style="flex:1;min-width:0;">
                <p class="name">{{ $agent2Name }}</p>
                <p class="role">{{ $agent2Role }}</p>
                <p class="num">● +{{ $agent2Wa }}</p>
            </div>
            <svg class="wa-ico" width="28" height="28" fill="#25d366" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        </a>

        <p style="text-align:center;color:#999;font-size:10px;font-weight:300;">Senin–Sabtu, 08.00–21.00 WIB</p>
    </div>

    {{-- New Toggle Button --}}
    <button class="wa-toggle-new-btn" onclick="toggleWaPanel()" aria-label="Konsultasi HVM Digital">
        <div class="wa-pill-bubble" id="wa-btn-label">Konsultasi disini Yuk 👋</div>
        <div class="wa-img-wrapper">
            @php $toggleAvatar = setting('cs_toggle_avatar'); @endphp
            <img src="{{ $toggleAvatar ? get_image_url($toggleAvatar) : asset('images/whatsapp/office.webp') }}" alt="CS HVM Digital"
                 onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2268%22 height=%2268%22><rect fill=%22%23075749%22 rx=%2234%22 width=%2268%22 height=%2268%22/><text x=%2234%22 y=%2241%22 text-anchor=%22middle%22 fill=%22white%22 font-size=%2222%22>HVM</text></svg>'">
            <span class="wa-pulse-dot"></span>
        </div>
    </button>
</div>

<script>
function toggleWaPanel() {
    var panel = document.getElementById('hvm-wa-panel');
    var label = document.getElementById('wa-btn-label');
    var isOpen = panel.classList.contains('open');
    panel.classList.toggle('open', !isOpen);
    label.innerHTML = isOpen ? 'Konsultasi disini Yuk 👋' : 'Tutup ✕';
}
// Close when clicking outside
document.addEventListener('click', function(e) {
    var widget = document.getElementById('hvm-wa-widget');
    if (widget && !widget.contains(e.target)) {
        document.getElementById('hvm-wa-panel').classList.remove('open');
        document.getElementById('wa-btn-label').innerHTML = 'Konsultasi disini Yuk 👋';
    }
});
</script>
