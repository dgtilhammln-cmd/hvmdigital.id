{{-- Content Creator — brand colors only --}}
<style>
.ct-float{animation:ctFloat 3s ease-in-out infinite}
.ct-rec{animation:ctBlink 1s step-end infinite}
.ct-eq1{animation:ctEq 1s 0s ease-in-out infinite;transform-origin:center bottom}
.ct-eq2{animation:ctEq 1s .2s ease-in-out infinite;transform-origin:center bottom}
.ct-eq3{animation:ctEq 1s .4s ease-in-out infinite;transform-origin:center bottom}
.ct-eq4{animation:ctEq 1s .6s ease-in-out infinite;transform-origin:center bottom}
.ct-eq5{animation:ctEq 1s .8s ease-in-out infinite;transform-origin:center bottom}
@keyframes ctFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes ctBlink{0%,100%{opacity:1}50%{opacity:0}}
@keyframes ctEq{0%,100%{transform:scaleY(.35)}50%{transform:scaleY(1)}}
</style>
<svg viewBox="0 0 300 280" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full drop-shadow-2xl">
  <ellipse cx="150" cy="272" rx="80" ry="8" fill="#9acb03" opacity=".08"/>
  <g class="ct-float">
  <!-- Camera body -->
  <rect x="55" y="82" width="190" height="126" rx="18" fill="#0d1f15" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".5"/>
  <!-- Viewfinder grip top -->
  <rect x="118" y="68" width="64" height="18" rx="8" fill="#053d33" stroke="#9acb03" stroke-width="1" stroke-opacity=".3"/>
  <!-- Lens outer -->
  <circle cx="150" cy="145" r="42" fill="#053d33" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".4"/>
  <!-- Lens middle -->
  <circle cx="150" cy="145" r="30" fill="#0a1510" stroke="#9acb03" stroke-width="1" stroke-opacity=".3"/>
  <!-- Lens inner -->
  <circle cx="150" cy="145" r="18" fill="#075749" opacity=".6"/>
  <circle cx="150" cy="145" r="10" fill="#9acb03" opacity=".3"/>
  <circle cx="143" cy="138" r="4" fill="white" opacity=".35"/>
  <!-- REC dot + label -->
  <circle cx="218" cy="98" r="7" fill="#075749" stroke="#9acb03" stroke-width="1"/>
  <circle cx="218" cy="98" r="4" fill="#9acb03" class="ct-rec"/>
  <text x="210" y="88" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">REC</text>
  <!-- Flash -->
  <rect x="65" y="90" width="24" height="18" rx="5" fill="#075749" stroke="#9acb03" stroke-width=".5" stroke-opacity=".4"/>
  <path d="M73 99 L78 90 L78 97 L83 97 L77 107 L77 99 Z" fill="#9acb03" opacity=".8"/>
  </g>
  <!-- Equalizer bars -->
  <rect x="82" y="226" width="14" height="30" rx="3" fill="#075749" class="ct-eq1"/>
  <rect x="102" y="226" width="14" height="30" rx="3" fill="#075749" class="ct-eq2"/>
  <rect x="122" y="226" width="14" height="30" rx="3" fill="#9acb03" class="ct-eq3"/>
  <rect x="142" y="226" width="14" height="30" rx="3" fill="#9acb03" class="ct-eq4"/>
  <rect x="162" y="226" width="14" height="30" rx="3" fill="#9acb03" class="ct-eq5"/>
  <rect x="182" y="226" width="14" height="30" rx="3" fill="#075749" class="ct-eq2"/>
  <rect x="202" y="226" width="14" height="30" rx="3" fill="#075749" class="ct-eq1"/>
  <!-- Platform pills -->
  <rect x="20" y="30" width="62" height="22" rx="11" fill="#075749" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <text x="51" y="45" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">Instagram</text>
  <rect x="90" y="30" width="48" height="22" rx="11" fill="#075749" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <text x="114" y="45" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">TikTok</text>
  <rect x="146" y="30" width="56" height="22" rx="11" fill="#075749" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <text x="174" y="45" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">YouTube</text>
  <rect x="210" y="30" width="56" height="22" rx="11" fill="#075749" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <text x="238" y="45" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">LinkedIn</text>
</svg>
