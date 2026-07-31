{{-- Branding — brand colors only --}}
<style>
.br-ring{animation:brSpin 10s linear infinite;transform-origin:150px 135px}
.br-sw1{animation:brFloat 3s 0s ease-in-out infinite}
.br-sw2{animation:brFloat 3s .8s ease-in-out infinite}
.br-sw3{animation:brFloat 3s 1.6s ease-in-out infinite}
.br-logo{animation:brPop .8s .3s ease both;opacity:0;transform:scale(.8)}
@keyframes brSpin{to{transform:rotate(360deg)}}
@keyframes brFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes brPop{to{opacity:1;transform:scale(1)}}
</style>
<svg viewBox="0 0 300 280" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full drop-shadow-2xl">
  <ellipse cx="150" cy="272" rx="80" ry="8" fill="#9acb03" opacity=".08"/>
  <!-- Rotating dashed ring -->
  <g class="br-ring">
    <circle cx="150" cy="135" r="78" stroke="#9acb03" stroke-width="1" stroke-opacity=".2" stroke-dasharray="8 6"/>
    <rect x="226" y="131" width="8" height="8" rx="2" fill="#9acb03" opacity=".5"/>
  </g>
  <!-- Color swatches left -->
  <g class="br-sw1">
    <rect x="18" y="68" width="52" height="52" rx="14" fill="#9acb03"/>
    <text x="44" y="100" font-size="7" fill="#053d33" text-anchor="middle" font-weight="bold">#9ACB03</text>
  </g>
  <g class="br-sw2">
    <rect x="18" y="130" width="52" height="52" rx="14" fill="#075749"/>
    <text x="44" y="162" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">#075749</text>
  </g>
  <g class="br-sw3">
    <rect x="18" y="192" width="52" height="52" rx="14" fill="#053d33" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
    <text x="44" y="224" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">#053D33</text>
  </g>
  <!-- Logo center -->
  <circle cx="150" cy="135" r="55" fill="#0d1f15" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".5"/>
  <g class="br-logo">
    <text x="150" y="125" font-size="26" fill="#9acb03" text-anchor="middle" font-weight="900" font-family="sans-serif">HVM</text>
    <text x="150" y="145" font-size="8" fill="white" text-anchor="middle" letter-spacing="4" opacity=".6">DIGITAL</text>
    <rect x="108" y="150" width="84" height="1.5" fill="#9acb03" opacity=".4"/>
    <text x="150" y="164" font-size="6" fill="#9acb03" text-anchor="middle" opacity=".5" letter-spacing="1">BRAND IDENTITY</text>
  </g>
  <!-- Typography card right -->
  <rect x="220" y="68" width="68" height="164" rx="12" fill="#0d1f15" stroke="#9acb03" stroke-width="1" stroke-opacity=".3"/>
  <text x="254" y="92" font-size="20" fill="#9acb03" text-anchor="middle" font-weight="900">Aa</text>
  <rect x="230" y="100" width="48" height="4" rx="2" fill="#9acb03" opacity=".7"/>
  <rect x="230" y="110" width="38" height="3" rx="1.5" fill="white" opacity=".3"/>
  <rect x="230" y="118" width="43" height="3" rx="1.5" fill="white" opacity=".2"/>
  <line x1="230" y1="130" x2="278" y2="130" stroke="#9acb03" stroke-opacity=".15"/>
  <text x="254" y="148" font-size="10" fill="#9acb03" text-anchor="middle" font-weight="700">Bold</text>
  <text x="254" y="164" font-size="10" fill="white" text-anchor="middle" opacity=".3" font-weight="300">Light</text>
  <text x="254" y="180" font-size="10" fill="white" text-anchor="middle" opacity=".2" font-style="italic">Italic</text>
  <rect x="230" y="190" width="48" height="28" rx="6" fill="#9acb03" opacity=".15"/>
  <text x="254" y="208" font-size="7" fill="#9acb03" text-anchor="middle">Brand Kit</text>
  <!-- Bottom tag -->
  <rect x="88" y="210" width="124" height="28" rx="14" fill="#053d33" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <text x="150" y="228" font-size="8" fill="#9acb03" text-anchor="middle" font-weight="600">Visual Identity System</text>
</svg>
