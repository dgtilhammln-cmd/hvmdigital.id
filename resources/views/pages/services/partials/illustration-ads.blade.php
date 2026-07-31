{{-- Digital Ads Dashboard — brand colors only --}}
<style>
.ads-g1{animation:adsGrow 1.5s .1s ease both;transform:scaleY(0);transform-origin:bottom}
.ads-g2{animation:adsGrow 1.5s .3s ease both;transform:scaleY(0);transform-origin:bottom}
.ads-g3{animation:adsGrow 1.5s .5s ease both;transform:scaleY(0);transform-origin:bottom}
.ads-g4{animation:adsGrow 1.5s .7s ease both;transform:scaleY(0);transform-origin:bottom}
.ads-g5{animation:adsGrow 1.5s .9s ease both;transform:scaleY(0);transform-origin:bottom}
.ads-line{stroke-dasharray:300;stroke-dashoffset:300;animation:adsDraw 2s 1.2s ease forwards}
.ads-badge{animation:adsPop .5s 2s ease both;opacity:0;transform:scale(.85)}
@keyframes adsGrow{to{transform:scaleY(1)}}
@keyframes adsDraw{to{stroke-dashoffset:0}}
@keyframes adsPop{to{opacity:1;transform:scale(1)}}
</style>
<svg viewBox="0 0 300 285" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full drop-shadow-2xl">
  <ellipse cx="150" cy="278" rx="90" ry="8" fill="#9acb03" opacity=".08"/>
  <!-- Dashboard card -->
  <rect x="12" y="14" width="276" height="210" rx="16" fill="#0d1f15" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".35"/>
  <!-- Header bar -->
  <rect x="12" y="14" width="276" height="38" rx="16" fill="#053d33"/>
  <rect x="12" y="38" width="276" height="14" fill="#053d33"/>
  <text x="28" y="37" font-size="9" fill="#9acb03" font-weight="bold">Ads Performance</text>
  <rect x="210" y="20" width="66" height="20" rx="10" fill="#9acb03" opacity=".15" stroke="#9acb03" stroke-width="1" stroke-opacity=".3"/>
  <text x="243" y="34" font-size="8" fill="#9acb03" text-anchor="middle" font-weight="bold">ROAS 4.2x</text>
  <!-- KPI Cards -->
  <rect x="22" y="62" width="76" height="44" rx="10" fill="#053d33"/>
  <text x="60" y="78" font-size="7" fill="#9acb03" text-anchor="middle">Impressi</text>
  <text x="60" y="96" font-size="14" fill="white" text-anchor="middle" font-weight="bold">128K</text>
  <rect x="110" y="62" width="76" height="44" rx="10" fill="#053d33"/>
  <text x="148" y="78" font-size="7" fill="#9acb03" text-anchor="middle">Klik</text>
  <text x="148" y="96" font-size="14" fill="white" text-anchor="middle" font-weight="bold">4.7K</text>
  <rect x="198" y="62" width="76" height="44" rx="10" fill="#053d33"/>
  <text x="236" y="78" font-size="7" fill="#9acb03" text-anchor="middle">Konversi</text>
  <text x="236" y="96" font-size="14" fill="white" text-anchor="middle" font-weight="bold">312</text>
  <!-- Chart baseline -->
  <line x1="22" y1="195" x2="278" y2="195" stroke="#9acb03" stroke-opacity=".12"/>
  <!-- Bars -->
  <rect x="36" y="148" width="26" height="47" rx="5" fill="#075749" opacity=".5" class="ads-g1"/>
  <rect x="80" y="133" width="26" height="62" rx="5" fill="#075749" opacity=".65" class="ads-g2"/>
  <rect x="124" y="120" width="26" height="75" rx="5" fill="#9acb03" opacity=".7" class="ads-g3"/>
  <rect x="168" y="130" width="26" height="65" rx="5" fill="#9acb03" opacity=".85" class="ads-g4"/>
  <rect x="212" y="110" width="26" height="85" rx="5" fill="#9acb03" class="ads-g5"/>
  <!-- Labels -->
  <text x="49" y="207" font-size="6" fill="white" text-anchor="middle" opacity=".35">Jan</text>
  <text x="93" y="207" font-size="6" fill="white" text-anchor="middle" opacity=".35">Feb</text>
  <text x="137" y="207" font-size="6" fill="white" text-anchor="middle" opacity=".35">Mar</text>
  <text x="181" y="207" font-size="6" fill="white" text-anchor="middle" opacity=".35">Apr</text>
  <text x="225" y="207" font-size="6" fill="white" text-anchor="middle" opacity=".35">Mei</text>
  <!-- Trend line -->
  <polyline points="49,175 93,158 137,141 181,152 225,124" stroke="#b8e832" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none" class="ads-line"/>
  <circle cx="225" cy="124" r="5" fill="#b8e832" class="ads-line"/>
  <!-- ROAS Badge -->
  <g class="ads-badge">
  <rect x="68" y="230" width="164" height="44" rx="12" fill="#053d33" stroke="#9acb03" stroke-width="1.5"/>
  <text x="150" y="249" font-size="9" fill="#9acb03" text-anchor="middle" font-weight="bold">Return on Ad Spend</text>
  <text x="150" y="266" font-size="16" fill="white" text-anchor="middle" font-weight="900">4.2x ROAS</text>
  </g>
  <!-- Platform labels -->
  <text x="60" y="282" font-size="7" fill="#9acb03" text-anchor="middle" opacity=".5">Google Ads</text>
  <text x="150" y="282" font-size="7" fill="#9acb03" text-anchor="middle" opacity=".5">Meta Ads</text>
  <text x="240" y="282" font-size="7" fill="#9acb03" text-anchor="middle" opacity=".5">YouTube Ads</text>
</svg>
