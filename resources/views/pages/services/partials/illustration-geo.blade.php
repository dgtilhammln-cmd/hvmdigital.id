{{-- GEO / AI — brand colors only --}}
<style>
.geo-ring{animation:geoSpin 8s linear infinite;transform-origin:150px 130px}
.geo-d1{animation:geoBlink 1.2s 0s step-end infinite}
.geo-d2{animation:geoBlink 1.2s .4s step-end infinite}
.geo-d3{animation:geoBlink 1.2s .8s step-end infinite}
.geo-glow{animation:geoPulse 2.5s ease-in-out infinite}
@keyframes geoSpin{to{transform:rotate(360deg)}}
@keyframes geoBlink{0%,100%{opacity:1}50%{opacity:0}}
@keyframes geoPulse{0%,100%{opacity:.15}50%{opacity:.3}}
</style>
<svg viewBox="0 0 300 270" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full drop-shadow-2xl">
  <!-- Glow -->
  <circle cx="150" cy="130" r="75" fill="#9acb03" class="geo-glow"/>
  <!-- Spinning ring -->
  <g class="geo-ring">
    <circle cx="150" cy="130" r="70" stroke="#9acb03" stroke-width="1" stroke-opacity=".25" stroke-dasharray="8 5"/>
    <circle cx="220" cy="130" r="5" fill="#9acb03" opacity=".6"/>
  </g>
  <!-- Core -->
  <circle cx="150" cy="130" r="48" fill="#0d1f15" stroke="#9acb03" stroke-width="1.5" stroke-opacity=".5"/>
  <!-- Circuit lines -->
  <line x1="150" y1="82" x2="150" y2="105" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <line x1="150" y1="155" x2="150" y2="178" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <line x1="102" y1="130" x2="125" y2="130" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <line x1="175" y1="130" x2="198" y2="130" stroke="#9acb03" stroke-width="1" stroke-opacity=".4"/>
  <circle cx="150" cy="82" r="4" fill="#9acb03" opacity=".7"/>
  <circle cx="150" cy="178" r="4" fill="#9acb03" opacity=".7"/>
  <circle cx="102" cy="130" r="4" fill="#9acb03" opacity=".7"/>
  <circle cx="198" cy="130" r="4" fill="#9acb03" opacity=".7"/>
  <!-- AI Label -->
  <text x="150" y="124" font-size="22" fill="#9acb03" text-anchor="middle" font-weight="900" font-family="monospace">AI</text>
  <text x="150" y="142" font-size="7" fill="white" text-anchor="middle" opacity=".5" letter-spacing="2">GENERATIVE</text>
  <!-- Chat bubbles -->
  <rect x="10" y="50" width="108" height="36" rx="10" fill="#053d33" stroke="#9acb03" stroke-width="1" stroke-opacity=".35"/>
  <text x="64" y="64" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">ChatGPT</text>
  <text x="64" y="78" font-size="7" fill="white" text-anchor="middle" opacity=".6">"HVM Digital ✓"</text>
  <rect x="182" y="50" width="108" height="36" rx="10" fill="#053d33" stroke="#9acb03" stroke-width="1" stroke-opacity=".35"/>
  <text x="236" y="64" font-size="7" fill="#9acb03" text-anchor="middle" font-weight="bold">Gemini AI</text>
  <text x="236" y="78" font-size="7" fill="white" text-anchor="middle" opacity=".6">"Rekomendasi: HVM"</text>
  <!-- Lines to center -->
  <line x1="118" y1="86" x2="144" y2="108" stroke="#9acb03" stroke-width="1" stroke-opacity=".3" stroke-dasharray="4 3"/>
  <line x1="182" y1="86" x2="156" y2="108" stroke="#9acb03" stroke-width="1" stroke-opacity=".3" stroke-dasharray="4 3"/>
  <!-- Typing indicator -->
  <rect x="96" y="210" width="108" height="32" rx="16" fill="#0d1f15" stroke="#9acb03" stroke-width="1" stroke-opacity=".3"/>
  <circle cx="135" cy="226" r="4" fill="#9acb03" class="geo-d1"/>
  <circle cx="150" cy="226" r="4" fill="#9acb03" class="geo-d2"/>
  <circle cx="165" cy="226" r="4" fill="#9acb03" class="geo-d3"/>
  <text x="150" y="258" font-size="7" fill="#9acb03" text-anchor="middle" opacity=".4">Perplexity · Gemini · ChatGPT</text>
</svg>
