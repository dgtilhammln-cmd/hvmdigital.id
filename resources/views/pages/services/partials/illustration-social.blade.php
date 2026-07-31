{{-- Social Media — brand colors only --}}
<style>
.sm-p1{animation:smRise .5s .1s ease both;opacity:0;transform:translateY(16px)}
.sm-p2{animation:smRise .5s .5s ease both;opacity:0;transform:translateY(16px)}
.sm-p3{animation:smRise .5s .9s ease both;opacity:0;transform:translateY(16px)}
.sm-bell{animation:smShake 3s 2s ease-in-out infinite}
.sm-heart{animation:smBeat 1.5s 1.5s ease-in-out infinite}
@keyframes smRise{to{opacity:1;transform:translateY(0)}}
@keyframes smShake{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-12deg)}40%,80%{transform:rotate(12deg)}}
@keyframes smBeat{0%,100%{transform:scale(1)}50%{transform:scale(1.4)}}
</style>
<svg viewBox="0 0 300 285" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full drop-shadow-2xl">
  <ellipse cx="150" cy="278" rx="70" ry="8" fill="#9acb03" opacity=".08"/>
  <!-- Phone frame -->
  <rect x="78" y="18" width="144" height="248" rx="20" fill="#0a1510" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".45"/>
  <rect x="86" y="26" width="128" height="232" rx="14" fill="#0d1f15"/>
  <rect x="118" y="28" width="64" height="10" rx="5" fill="#0a1510"/>
  <!-- Feed Header -->
  <rect x="86" y="46" width="128" height="32" rx="8" fill="#053d33"/>
  <circle cx="106" cy="62" r="8" fill="#075749" stroke="#9acb03" stroke-width="1" stroke-opacity=".5"/>
  <text x="140" y="59" font-size="8" fill="white" font-weight="bold">@hvmdigital</text>
  <text x="140" y="71" font-size="6" fill="#9acb03" opacity=".7">1.2K Followers</text>
  <!-- Post 1 -->
  <g class="sm-p1">
  <rect x="90" y="84" width="120" height="72" rx="8" fill="#053d33" stroke="#9acb03" stroke-width=".5" stroke-opacity=".3"/>
  <rect x="90" y="84" width="120" height="44" rx="8" fill="#075749" opacity=".7"/>
  <text x="150" y="112" font-size="9" fill="white" text-anchor="middle" font-weight="bold">HVM Digital</text>
  <text x="150" y="125" font-size="7" fill="#9acb03" text-anchor="middle">Jasa Website #1</text>
  <g class="sm-heart" style="transform-origin:108px 146px">
  <text x="100" y="150" font-size="11">♥</text>
  </g>
  <text x="98" y="151" font-size="9" fill="#9acb03">♥</text>
  <text x="112" y="151" font-size="7" fill="white" opacity=".5">1.2K</text>
  <text x="145" y="151" font-size="7" fill="white" opacity=".35">💬 87</text>
  <text x="172" y="151" font-size="7" fill="white" opacity=".3">↗ 34</text>
  </g>
  <!-- Post 2 -->
  <g class="sm-p2">
  <rect x="90" y="162" width="120" height="55" rx="8" fill="#053d33" stroke="#9acb03" stroke-width=".5" stroke-opacity=".2"/>
  <circle cx="108" cy="177" r="9" fill="#075749" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <rect x="122" y="172" width="64" height="6" rx="3" fill="white" opacity=".3"/>
  <rect x="122" y="183" width="48" height="4" rx="2" fill="white" opacity=".15"/>
  <text x="98" y="211" font-size="7" fill="#9acb03">♥ 847</text>
  <text x="140" y="211" font-size="7" fill="white" opacity=".3">Lihat semua komentar</text>
  </g>
  <!-- Post 3 -->
  <g class="sm-p3">
  <rect x="90" y="223" width="120" height="26" rx="8" fill="#053d33" stroke="#9acb03" stroke-width=".5" stroke-opacity=".15"/>
  <rect x="98" y="231" width="70" height="5" rx="2" fill="white" opacity=".2"/>
  <rect x="98" y="240" width="50" height="4" rx="2" fill="white" opacity=".1"/>
  </g>
  <!-- Notification bell -->
  <g class="sm-bell" style="transform-origin:258px 50px">
  <rect x="238" y="30" width="44" height="44" rx="12" fill="#053d33" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <path d="M260 42 C256 42 253 45 253 49 L253 53 L250 56 L270 56 L267 53 L267 49 C267 45 264 42 260 42Z" fill="#9acb03" opacity=".7"/>
  <path d="M257 56 C257 58 258 60 260 60 C262 60 263 58 263 56Z" fill="#9acb03" opacity=".5"/>
  <circle cx="270" cy="34" r="7" fill="#9acb03"/>
  <text x="270" y="38" font-size="7" fill="#053d33" text-anchor="middle" font-weight="bold">9+</text>
  </g>
  <!-- Stats bar bottom -->
  <rect x="20" y="268" width="260" height="18" rx="9" fill="#0d1f15"/>
  <text x="93" y="280" font-size="7" fill="#9acb03" text-anchor="middle">+12% Followers</text>
  <text x="200" y="280" font-size="7" fill="#9acb03" text-anchor="middle">+847% Reach</text>
</svg>
