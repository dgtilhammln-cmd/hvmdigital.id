{{-- Website UI mockup — brand colors only --}}
<style>
.ws-float{animation:wsFloat 3s ease-in-out infinite}
.ws-blink{animation:wsBlink 1s step-end infinite}
.ws-line1{animation:wsSlide 2.5s 0.5s ease both}
.ws-line2{animation:wsSlide 2.5s 0.9s ease both}
.ws-line3{animation:wsSlide 2.5s 1.3s ease both}
@keyframes wsFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes wsBlink{0%,100%{opacity:1}50%{opacity:0}}
@keyframes wsSlide{from{width:0}to{width:var(--w)}}
</style>
<svg viewBox="0 0 320 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="ws-float w-full drop-shadow-2xl">
  <!-- Glow -->
  <ellipse cx="160" cy="250" rx="100" ry="16" fill="#9acb03" opacity=".1"/>
  <!-- Browser shell -->
  <rect x="12" y="18" width="296" height="214" rx="14" fill="#0d1f15" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".35"/>
  <!-- Title bar -->
  <rect x="12" y="18" width="296" height="38" rx="14" fill="#053d33"/>
  <rect x="12" y="44" width="296" height="12" fill="#053d33"/>
  <!-- Traffic lights -->
  <circle cx="34" cy="37" r="5" fill="#075749" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <circle cx="52" cy="37" r="5" fill="#075749" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <circle cx="70" cy="37" r="5" fill="#9acb03" opacity=".7"/>
  <!-- URL bar -->
  <rect x="86" y="28" width="184" height="18" rx="9" fill="#0a3d30"/>
  <circle cx="98" cy="37" r="4" stroke="#9acb03" stroke-width="1" stroke-opacity=".5"/>
  <text x="191" y="40" font-size="8" fill="#9acb03" text-anchor="middle" font-family="monospace" opacity=".8">hvmdigital.id</text>
  <rect x="261" y="31" width="4" height="12" rx="1" fill="#9acb03" opacity=".3" class="ws-blink"/>
  <!-- Hero section -->
  <rect x="26" y="66" width="178" height="64" rx="8" fill="#075749" opacity=".6"/>
  <rect x="36" y="78" width="90" height="8" rx="4" fill="#9acb03" opacity=".9"/>
  <rect x="36" y="92" width="130" height="5" rx="2" fill="white" opacity=".25" style="--w:130px" class="ws-line1"/>
  <rect x="36" y="103" width="100" height="5" rx="2" fill="white" opacity=".15" style="--w:100px" class="ws-line2"/>
  <rect x="36" y="117" width="56" height="16" rx="8" fill="#9acb03"/>
  <!-- Right image block -->
  <rect x="214" y="66" width="98" height="64" rx="8" fill="#0a3d30"/>
  <rect x="222" y="74" width="82" height="48" rx="5" fill="#075749" opacity=".5"/>
  <circle cx="263" cy="98" r="14" fill="#053d33" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <path d="M259 98 L268 93 L268 103 Z" fill="#9acb03" opacity=".7"/>
  <!-- Divider -->
  <line x1="26" y1="142" x2="294" y2="142" stroke="#9acb03" stroke-opacity=".1"/>
  <!-- Service cards row -->
  <rect x="26" y="150" width="82" height="52" rx="7" fill="#075749" opacity=".4"/>
  <rect x="118" y="150" width="82" height="52" rx="7" fill="#075749" opacity=".4"/>
  <rect x="210" y="150" width="82" height="52" rx="7" fill="#075749" opacity=".4"/>
  <!-- Card content -->
  <rect x="34" y="158" width="12" height="12" rx="3" fill="#9acb03" opacity=".7"/>
  <rect x="34" y="175" width="55" height="5" rx="2" fill="white" opacity=".3" style="--w:55px" class="ws-line3"/>
  <rect x="34" y="185" width="40" height="4" rx="2" fill="white" opacity=".15"/>
  <rect x="126" y="158" width="12" height="12" rx="3" fill="#9acb03" opacity=".5"/>
  <rect x="126" y="175" width="55" height="5" rx="2" fill="white" opacity=".25"/>
  <rect x="126" y="185" width="40" height="4" rx="2" fill="white" opacity=".12"/>
  <rect x="218" y="158" width="12" height="12" rx="3" fill="#9acb03" opacity=".4"/>
  <rect x="218" y="175" width="55" height="5" rx="2" fill="white" opacity=".2"/>
  <rect x="218" y="185" width="40" height="4" rx="2" fill="white" opacity=".1"/>
</svg>
