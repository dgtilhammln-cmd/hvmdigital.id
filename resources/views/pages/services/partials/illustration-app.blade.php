{{-- Mobile App — brand colors only --}}
<style>
.app-fl{animation:appFloat 3.5s ease-in-out infinite}
.app-b1{animation:appBar 1.8s 0s ease-in-out infinite}
.app-b2{animation:appBar 1.8s .3s ease-in-out infinite}
.app-b3{animation:appBar 1.8s .6s ease-in-out infinite}
.app-b4{animation:appBar 1.8s .9s ease-in-out infinite}
.app-notif{animation:appPop .6s 1.2s ease forwards;opacity:0;transform:scale(.8)translateY(-10px)}
@keyframes appFloat{0%,100%{transform:translateY(0) rotate(-3deg)}50%{transform:translateY(-12px) rotate(-3deg)}}
@keyframes appBar{0%,100%{opacity:.4;transform:scaleY(.7)}50%{opacity:1;transform:scaleY(1)}}
@keyframes appPop{to{opacity:1;transform:scale(1)translateY(0)}}
</style>
<svg viewBox="0 0 300 290" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full drop-shadow-2xl">
  <ellipse cx="150" cy="282" rx="70" ry="8" fill="#9acb03" opacity=".08"/>
  <g class="app-fl">
  <!-- Phone frame -->
  <rect x="82" y="18" width="136" height="240" rx="22" fill="#0a1510" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".5"/>
  <rect x="90" y="26" width="120" height="224" rx="16" fill="#0d1f15"/>
  <!-- Notch -->
  <rect x="122" y="28" width="56" height="12" rx="6" fill="#0a1510"/>
  <circle cx="161" cy="34" r="3.5" fill="#9acb03" opacity=".5"/>
  <!-- App header -->
  <rect x="90" y="48" width="120" height="38" rx="8" fill="#075749"/>
  <text x="150" y="63" font-size="8" fill="white" text-anchor="middle" font-weight="bold">HVM Dashboard</text>
  <text x="150" y="77" font-size="7" fill="#9acb03" text-anchor="middle">Selamat datang 👋</text>
  <!-- KPI Cards -->
  <rect x="95" y="93" width="52" height="42" rx="8" fill="#053d33" stroke="#9acb03" stroke-width=".5" stroke-opacity=".3"/>
  <rect x="153" y="93" width="52" height="42" rx="8" fill="#053d33" stroke="#9acb03" stroke-width=".5" stroke-opacity=".3"/>
  <text x="121" y="108" font-size="7" fill="#9acb03" text-anchor="middle">Revenue</text>
  <text x="121" y="124" font-size="12" fill="white" text-anchor="middle" font-weight="bold">+47%</text>
  <text x="179" y="108" font-size="7" fill="#9acb03" text-anchor="middle">Klien</text>
  <text x="179" y="124" font-size="12" fill="white" text-anchor="middle" font-weight="bold">100+</text>
  <!-- Chart bars -->
  <rect x="98" y="162" width="14" height="22" rx="3" fill="#075749" opacity=".6" class="app-b1" style="transform-origin:105px 184px"/>
  <rect x="116" y="155" width="14" height="29" rx="3" fill="#075749" opacity=".7" class="app-b2" style="transform-origin:123px 184px"/>
  <rect x="134" y="147" width="14" height="37" rx="3" fill="#9acb03" opacity=".8" class="app-b3" style="transform-origin:141px 184px"/>
  <rect x="152" y="151" width="14" height="33" rx="3" fill="#9acb03" opacity=".7" class="app-b4" style="transform-origin:159px 184px"/>
  <rect x="170" y="143" width="14" height="41" rx="3" fill="#9acb03" class="app-b3" style="transform-origin:177px 184px"/>
  <!-- Nav bar -->
  <rect x="90" y="210" width="120" height="32" rx="10" fill="#053d33"/>
  <circle cx="118" cy="226" r="6" fill="#9acb03" opacity=".9"/>
  <circle cx="150" cy="226" r="6" fill="#075749" opacity=".4"/>
  <circle cx="182" cy="226" r="6" fill="#075749" opacity=".4"/>
  </g>
  <!-- Notification -->
  <g class="app-notif">
  <rect x="170" y="22" width="118" height="52" rx="10" fill="#053d33" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <circle cx="186" cy="38" r="7" fill="#9acb03" opacity=".8"/>
  <text x="186" y="42" font-size="8" fill="#053d33" text-anchor="middle" font-weight="bold">!</text>
  <text x="239" y="36" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">Pesanan Baru!</text>
  <text x="239" y="50" font-size="7" fill="white" text-anchor="middle" opacity=".6">Rp 2.500.000</text>
  <text x="239" y="64" font-size="7" fill="#9acb03" text-anchor="middle">Lihat →</text>
  </g>
</svg>
