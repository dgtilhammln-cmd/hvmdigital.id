{{-- Default fallback illustration --}}
<style>
.df-spin{animation:df-rot 6s linear infinite;transform-origin:150px 130px}
.df-pulse{animation:df-pulse 2s ease-in-out infinite}
@keyframes df-rot{to{transform:rotate(360deg)}}
@keyframes df-pulse{0%,100%{opacity:.3;r:55}50%{opacity:.1;r:70}}
</style>
<svg viewBox="0 0 300 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
  <circle cx="150" cy="130" r="55" fill="#9acb03" class="df-pulse"/>
  <g class="df-spin">
    <circle cx="150" cy="130" r="70" stroke="#9acb03" stroke-width="1" stroke-opacity=".2" stroke-dasharray="8 5"/>
    <circle cx="150" cy="130" r="90" stroke="#9acb03" stroke-width=".5" stroke-opacity=".1" stroke-dasharray="4 8"/>
  </g>
  <circle cx="150" cy="130" r="45" fill="#0d1f15" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".6"/>
  <text x="150" y="118" font-size="18" fill="#9acb03" text-anchor="middle" font-weight="900">HVM</text>
  <text x="150" y="138" font-size="8" fill="white" text-anchor="middle" letter-spacing="3" opacity=".6">DIGITAL</text>
  <rect x="110" y="142" width="80" height="1" fill="#9acb03" opacity=".4"/>
  <text x="150" y="158" font-size="7" fill="#9acb03" text-anchor="middle" opacity=".6">One-Stop Solution</text>
</svg>
