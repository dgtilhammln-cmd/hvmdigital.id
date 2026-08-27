@extends('layouts.app')

@section('title', 'Giveaway Booth HVM Digital - Megpreneur 2026')
@section('meta_description', 'Kunjungi booth HVM Digital di Megpreneur 2026! Isi form, follow akun kami, dan menangkan hadiah spesial.')

@push('head')
<meta property="og:title" content="Giveaway Booth HVM Digital - Megpreneur 2026">
<meta property="og:description" content="Kunjungi booth HVM Digital di Megpreneur 2026, ikuti undiannya dan menangkan hadiah menarik!">
<meta property="og:url" content="{{ url('/megpreneur/form') }}">
<style>
  .mgp-hero {
    background: linear-gradient(135deg, #061009 0%, #0d2a18 40%, #075749 100%);
    min-height: 100vh;
    padding-top: 90px;
  }
  .mgp-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(154,203,3,0.15);
    border-radius: 24px;
    backdrop-filter: blur(20px);
  }
  .mgp-input {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    color: #fff;
    padding: 12px 16px;
    width: 100%;
    font-size: 14px;
    transition: all 0.2s;
    outline: none;
  }
  .mgp-input:focus {
    border-color: #9acb03;
    box-shadow: 0 0 0 3px rgba(154,203,3,0.15);
    background: rgba(154,203,3,0.05);
  }
  .mgp-input::placeholder { color: rgba(255,255,255,0.3); }
  .mgp-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: rgba(255,255,255,0.5);
    margin-bottom: 8px;
  }
  .mgp-label span.req { color: #9acb03; }
  .upload-zone {
    border: 2px dashed rgba(154,203,3,0.3);
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background: rgba(154,203,3,0.03);
  }
  .upload-zone:hover, .upload-zone.drag-over {
    border-color: #9acb03;
    background: rgba(154,203,3,0.08);
  }
  .preview-img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 12px;
    display: none;
  }
  .preview-img.show { display: block; }
  .upload-placeholder { transition: opacity 0.2s; }
  .upload-placeholder.hidden { display: none; }
  .error-msg { color: #f87171; font-size: 12px; margin-top: 5px; display: flex; align-items: center; gap: 4px; }
  .btn-submit {
    background: linear-gradient(135deg, #075749, #9acb03);
    color: #fff;
    border: none;
    padding: 15px 32px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
    letter-spacing: 0.04em;
  }
  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(154,203,3,0.4);
  }
  .btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
  }
  .star-particle {
    position: absolute;
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: #9acb03;
    animation: float-star 6s infinite;
  }
  @keyframes float-star {
    0%,100% { opacity: 0; transform: translateY(0) scale(0); }
    50% { opacity: 1; transform: translateY(-40px) scale(1); }
  }
  .progress-step {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
  }
  .step-done { background: rgba(154,203,3,0.15); color: #9acb03; }
  .step-active { background: rgba(255,255,255,0.1); color: #fff; }
  .step-pending { background: transparent; color: rgba(255,255,255,0.3); }

  select.mgp-input option { background: #0d2a18; color: #fff; }
  .checkbox-custom {
    width: 20px; height: 20px;
    border: 2px solid rgba(154,203,3,0.5);
    border-radius: 5px;
    background: transparent;
    cursor: pointer;
    appearance: none;
    flex-shrink: 0;
    transition: all 0.2s;
  }
  .checkbox-custom:checked {
    background: #9acb03;
    border-color: #9acb03;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' fill='%23000' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3E%3C/svg%3E");
  }
</style>
@endpush

@section('content')
<div class="mgp-hero relative overflow-hidden">

  {{-- Decorative particles --}}
  @for($i=0;$i<15;$i++)
  <div class="star-particle" style="left:{{ rand(5,95) }}%;top:{{ rand(10,90) }}%;animation-delay:{{ $i*0.4 }}s;animation-duration:{{ rand(4,8) }}s;opacity:0.6;"></div>
  @endfor
  <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#9acb03]/5 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-[#075749]/30 rounded-full blur-3xl pointer-events-none"></div>

  <div class="container mx-auto px-4 py-16 relative z-10">

    {{-- Header --}}
    <div class="text-center mb-12">
      <h1 class="text-3xl md:text-5xl font-black text-white mb-4 leading-tight">
        Giveaway Booth<br class="md:hidden">
        <span class="text-[#9acb03]">HVM Digital</span>
      </h1>
      <p class="text-[#9acb03]/80 font-bold tracking-widest uppercase mb-4">@ Megpreneur 2026</p>
      <p class="text-white/60 text-base max-w-xl mx-auto leading-relaxed">
        Kunjungi booth kami, isi form di bawah ini, follow akun sosial media HVM Digital, dan dapatkan kesempatan memenangkan hadiah spesial!
      </p>
    </div>

    {{-- Progress Steps --}}
    <div class="flex items-center justify-center gap-3 flex-wrap mb-10">
      <div class="progress-step step-active">
        <span class="w-5 h-5 bg-[#9acb03] text-black rounded-full flex items-center justify-center text-xs font-black flex-shrink-0">1</span>
        Isi Data
      </div>
      <svg class="w-4 h-4 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      <div class="progress-step step-pending">
        <span class="w-5 h-5 border border-white/20 text-white/30 rounded-full flex items-center justify-center text-xs flex-shrink-0">2</span>
        Upload Bukti
      </div>
      <svg class="w-4 h-4 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      <div class="progress-step step-pending">
        <span class="w-5 h-5 border border-white/20 text-white/30 rounded-full flex items-center justify-center text-xs flex-shrink-0">3</span>
        Konfirmasi
      </div>
    </div>

    <div class="max-w-2xl mx-auto">
      <div class="mgp-card p-8 md:p-10">

        @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 rounded-xl px-5 py-4 mb-8 flex items-start gap-3">
          <svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
          <div>
            <p class="text-red-400 font-semibold text-sm mb-1">Terdapat kesalahan pada form:</p>
            <ul class="space-y-0.5">
              @foreach($errors->all() as $err)
              <li class="text-red-400/80 text-xs">• {{ $err }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif

        <form method="POST" action="{{ route('megpreneur.submit') }}" enctype="multipart/form-data" id="mgpForm" novalidate>
          @csrf

          {{-- Section 1: Data Usaha --}}
          <div class="mb-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-8 h-8 bg-[#9acb03]/20 rounded-xl flex items-center justify-center">
                <span class="text-[#9acb03] font-black text-sm">1</span>
              </div>
              <h2 class="text-white font-bold text-lg">Data Usaha</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div>
                <label class="mgp-label">Nama Penanggung Jawab <span class="req">*</span></label>
                <input type="text" name="nama_pic" id="nama_pic"
                  class="mgp-input @error('nama_pic') border-red-500/60 @enderror"
                  placeholder="cth: Budi Santoso"
                  value="{{ old('nama_pic') }}"
                  maxlength="255" required>
                @error('nama_pic')
                <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label class="mgp-label">Nama Usaha / Brand <span class="req">*</span></label>
                <input type="text" name="nama_usaha" id="nama_usaha"
                  class="mgp-input @error('nama_usaha') border-red-500/60 @enderror"
                  placeholder="cth: Warung Pak Budi"
                  value="{{ old('nama_usaha') }}"
                  maxlength="255" required>
                @error('nama_usaha')
                <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label class="mgp-label">No. WhatsApp Aktif <span class="req">*</span></label>
                <div style="position:relative;">
                  <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.4);font-size:13px;">+62</span>
                  <input type="tel" name="kontak_pic" id="kontak_pic"
                    class="mgp-input @error('kontak_pic') border-red-500/60 @enderror"
                    style="padding-left:44px;"
                    placeholder="812-3456-7890"
                    value="{{ old('kontak_pic') }}"
                    maxlength="20" required>
                </div>
                <p class="text-white/30 text-xs mt-1.5">Satu nomor hanya bisa mendaftar sekali.</p>
                @error('kontak_pic')
                <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label class="mgp-label">Bidang Usaha <span class="req">*</span></label>
                <select name="bidang_sektor" id="bidang_sektor"
                  class="mgp-input @error('bidang_sektor') border-red-500/60 @enderror" required>
                  <option value="" disabled {{ old('bidang_sektor') ? '' : 'selected' }}>-- Pilih Bidang --</option>
                  <option value="Kuliner" {{ old('bidang_sektor')=='Kuliner' ? 'selected' : '' }}>Kuliner & F&B</option>
                  <option value="Jasa" {{ old('bidang_sektor')=='Jasa' ? 'selected' : '' }}>Jasa & Servis</option>
                  <option value="Retail" {{ old('bidang_sektor')=='Retail' ? 'selected' : '' }}>Retail & Toko</option>
                  <option value="Fashion" {{ old('bidang_sektor')=='Fashion' ? 'selected' : '' }}>Fashion & Pakaian</option>
                  <option value="Kecantikan" {{ old('bidang_sektor')=='Kecantikan' ? 'selected' : '' }}>Kecantikan & Beauty</option>
                  <option value="Teknologi" {{ old('bidang_sektor')=='Teknologi' ? 'selected' : '' }}>Teknologi & Digital</option>
                  <option value="Pendidikan" {{ old('bidang_sektor')=='Pendidikan' ? 'selected' : '' }}>Pendidikan & Kursus</option>
                  <option value="Kesehatan" {{ old('bidang_sektor')=='Kesehatan' ? 'selected' : '' }}>Kesehatan & Wellness</option>
                  <option value="Properti" {{ old('bidang_sektor')=='Properti' ? 'selected' : '' }}>Properti & Dekorasi</option>
                  <option value="Pertanian" {{ old('bidang_sektor')=='Pertanian' ? 'selected' : '' }}>Pertanian & Agribisnis</option>
                  <option value="Lainnya" {{ old('bidang_sektor')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('bidang_sektor')
                <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>

          {{-- Section 2: Upload Bukti Follow --}}
          <div class="mb-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-8 h-8 bg-[#9acb03]/20 rounded-xl flex items-center justify-center">
                <span class="text-[#9acb03] font-black text-sm">2</span>
              </div>
              <h2 class="text-white font-bold text-lg">Bukti Follow Sosial Media</h2>
            </div>
            <p class="text-white/40 text-sm mb-5 -mt-2">Upload screenshot yang membuktikan Anda sudah follow akun HVM Digital. Format: JPG/PNG, maks. 2MB.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

              {{-- Upload IG --}}
              <div>
                <label class="mgp-label">Follow Instagram <span class="req">*</span></label>
                <div class="flex items-center gap-2 mb-2">
                  <a href="https://www.instagram.com/hvmdigital.id" target="_blank"
                     class="inline-flex items-center gap-1.5 text-xs text-pink-400 hover:text-pink-300 font-medium transition-colors">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07..."/></svg>
                    @hvmdigital.id ↗
                  </a>
                </div>
                <div class="upload-zone @error('foto_follow_ig') border-red-500/60 @enderror"
                     id="zone-ig" onclick="document.getElementById('foto_follow_ig').click()"
                     ondragover="handleDrag(event,'ig')" ondrop="handleDrop(event,'ig')" ondragleave="this.classList.remove('drag-over')">
                  <img id="preview-ig" class="preview-img" src="" alt="Preview IG">
                  <div class="upload-placeholder" id="placeholder-ig">
                    <div class="w-12 h-12 mx-auto mb-3 bg-gradient-to-br from-purple-600 to-pink-500 rounded-2xl flex items-center justify-center">
                      <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </div>
                    <p class="text-white/50 text-sm font-medium mb-1">Screenshot Follow IG</p>
                    <p class="text-white/25 text-xs">Klik atau drag & drop</p>
                  </div>
                  <input type="file" id="foto_follow_ig" name="foto_follow_ig"
                         accept="image/jpeg,image/png" class="hidden"
                         onchange="previewImage(this, 'ig')">
                </div>
                @error('foto_follow_ig')
                <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                @enderror
              </div>

              {{-- Upload TikTok --}}
              <div>
                <label class="mgp-label">Follow TikTok <span class="req">*</span></label>
                <div class="flex items-center gap-2 mb-2">
                  <a href="https://www.tiktok.com/@hvmdigital.id" target="_blank"
                     class="inline-flex items-center gap-1.5 text-xs text-white/60 hover:text-white font-medium transition-colors">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17..."/></svg>
                    @hvmdigital.id ↗
                  </a>
                </div>
                <div class="upload-zone @error('foto_follow_tiktok') border-red-500/60 @enderror"
                     id="zone-tiktok" onclick="document.getElementById('foto_follow_tiktok').click()"
                     ondragover="handleDrag(event,'tiktok')" ondrop="handleDrop(event,'tiktok')" ondragleave="this.classList.remove('drag-over')">
                  <img id="preview-tiktok" class="preview-img" src="" alt="Preview TikTok">
                  <div class="upload-placeholder" id="placeholder-tiktok">
                    <div class="w-12 h-12 mx-auto mb-3 bg-black rounded-2xl flex items-center justify-center border border-white/10">
                      <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.22-1.15 4.41-2.9 5.6-1.45 1-3.28 1.43-5.06 1.19-2.06-.28-3.95-1.55-4.88-3.41-.83-1.66-1.04-3.65-.49-5.43.51-1.65 1.7-3.08 3.25-3.83 1.09-.54 2.33-.74 3.55-.66v4.06c-.66-.02-1.34.05-1.95.34-.84.41-1.5 1.19-1.68 2.13-.19.98.05 2.05.69 2.8.69.81 1.8 1.25 2.87 1.16 1.06-.09 2.04-.68 2.58-1.59.45-.75.64-1.63.66-2.52.06-5.83.02-11.66.02-17.5h.28z"/></svg>
                    </div>
                    <p class="text-white/50 text-sm font-medium mb-1">Screenshot Follow TikTok</p>
                    <p class="text-white/25 text-xs">Klik atau drag & drop</p>
                  </div>
                  <input type="file" id="foto_follow_tiktok" name="foto_follow_tiktok"
                         accept="image/jpeg,image/png" class="hidden"
                         onchange="previewImage(this, 'tiktok')">
                </div>
                @error('foto_follow_tiktok')
                <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>

          {{-- Section 3: Foto Selfie Booth --}}
          <div class="mb-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-8 h-8 bg-[#9acb03]/20 rounded-xl flex items-center justify-center">
                <span class="text-[#9acb03] font-black text-sm">3</span>
              </div>
              <h2 class="text-white font-bold text-lg">Foto Selfie di Booth HVM Digital</h2>
            </div>
            <p class="text-white/40 text-sm mb-5 -mt-2">Ambil foto selfie di booth kami sendiri atau bersama tim HVM Digital. Gunakan kamera langsung atau upload (Maks 6MB).</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div class="md:col-span-2">
                <label class="mgp-label">Foto Selfie Booth <span class="req">*</span></label>
                <div class="upload-zone @error('foto_selfie_booth') border-red-500/60 @enderror"
                     id="zone-selfie" onclick="document.getElementById('foto_selfie_booth').click()"
                     ondragover="handleDrag(event,'selfie')" ondrop="handleDrop(event,'selfie')" ondragleave="this.classList.remove('drag-over')">
                  <img id="preview-selfie" class="preview-img" src="" alt="Preview Selfie">
                  <div class="upload-placeholder" id="placeholder-selfie">
                    <div class="w-12 h-12 mx-auto mb-3 bg-[#9acb03]/20 rounded-2xl flex items-center justify-center border border-[#9acb03]/30">
                      <svg class="w-6 h-6 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                    </div>
                    <p class="text-white/50 text-sm font-medium mb-1">Gunakan Kamera / Upload Foto</p>
                    <p class="text-white/25 text-xs">Klik untuk membuka kamera atau galeri</p>
                  </div>
                  <input type="file" id="foto_selfie_booth" name="foto_selfie_booth"
                         accept="image/*" capture="environment" class="hidden"
                         onchange="previewImage(this, 'selfie')">
                </div>
                @error('foto_selfie_booth')
                <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>

          {{-- Section 4: Konfirmasi --}}
          <div class="mb-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-8 h-8 bg-[#9acb03]/20 rounded-xl flex items-center justify-center">
                <span class="text-[#9acb03] font-black text-sm">4</span>
              </div>
              <h2 class="text-white font-bold text-lg">Konfirmasi & Submit</h2>
            </div>

            {{-- Maps Link --}}
            <div class="bg-[#9acb03]/5 border border-[#9acb03]/20 rounded-2xl p-5 mb-5">
              <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-[#9acb03]/15 rounded-xl flex items-center justify-center shrink-0">
                  <svg class="w-6 h-6 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <p class="text-white font-semibold text-sm mb-1">Kunjungi & Check-in Lokasi HVM Digital</p>
                  <p class="text-white/50 text-xs mb-3 leading-relaxed">Buka link Google Maps di bawah, kunjungi lokasi kami, dan beri ulasan / check-in sebagai bukti kunjungan.</p>
                  <a href="https://maps.app.goo.gl/1SzLLEQTmfxfqxVJ7" target="_blank" rel="noopener noreferrer"
                     class="inline-flex items-center gap-2 bg-[#9acb03] text-black font-bold text-xs px-4 py-2.5 rounded-xl hover:bg-[#8ab803] transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Buka Google Maps HVM Digital
                  </a>
                </div>
              </div>
            </div>

            {{-- Checkbox --}}
            <label class="flex items-start gap-3 cursor-pointer group" for="konfirmasi_maps">
              <input type="checkbox" id="konfirmasi_maps" name="konfirmasi_maps" value="1"
                     class="checkbox-custom mt-0.5"
                     {{ old('konfirmasi_maps') ? 'checked' : '' }} required>
              <span class="text-sm text-white/70 group-hover:text-white/90 transition-colors leading-relaxed">
                Saya menyatakan bahwa saya <strong class="text-white font-semibold">sudah mengunjungi atau check-in</strong> di lokasi HVM Digital melalui Google Maps yang tertera di atas.
              </span>
            </label>
            @error('konfirmasi_maps')
            <p class="error-msg mt-2"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
            @enderror
          </div>

          {{-- Submit --}}
          <div class="pt-2">
            <button type="submit" id="btnSubmit" class="btn-submit">
              <span id="btnText" class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Daftar Sekarang - GRATIS!
              </span>
              <span id="btnLoading" class="hidden items-center justify-center gap-2">
                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                Sedang Mengirim...
              </span>
            </button>
            <p class="text-center text-white/30 text-xs mt-4">
              Dengan mendaftar, Anda setuju mengikuti ketentuan event Megpreneur 2026 oleh HVM Digital.
            </p>
          </div>

        </form>
      </div>

      {{-- Info bantuan --}}
      <div class="mt-6 text-center">
        <p class="text-white/40 text-sm">
          Butuh bantuan? 
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp', '6281234567890')) }}" target="_blank"
             class="text-[#9acb03] hover:underline font-medium">Hubungi tim HVM Digital</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input, type) {
  const file = input.files[0];
  if (!file) return;

  // Validasi ukuran 2MB
  if (file.size > 2 * 1024 * 1024) {
    alert('Ukuran file terlalu besar. Maksimal 2MB.');
    input.value = '';
    return;
  }

  const reader = new FileReader();
  reader.onload = function(e) {
    const preview = document.getElementById('preview-' + type);
    const placeholder = document.getElementById('placeholder-' + type);
    preview.src = e.target.result;
    preview.classList.add('show');
    placeholder.classList.add('hidden');
  };
  reader.readAsDataURL(file);
}

function handleDrag(event, type) {
  event.preventDefault();
  document.getElementById('zone-' + type).classList.add('drag-over');
}

function handleDrop(event, type) {
  event.preventDefault();
  const zone = document.getElementById('zone-' + type);
  zone.classList.remove('drag-over');
  const file = event.dataTransfer.files[0];
  if (file) {
    const input = document.getElementById('foto_follow_' + type === 'ig' ? 'ig' : 'tiktok');
    // Manually set file
    const dt = new DataTransfer();
    dt.items.add(file);
    const fieldId = type === 'ig' ? 'foto_follow_ig' : 'foto_follow_tiktok';
    document.getElementById(fieldId).files = dt.files;
    previewImage({ files: [file] }, type);
  }
}

// Submit loading state
document.getElementById('mgpForm').addEventListener('submit', function(e) {
  // Quick client-side check
  const fields = ['nama_pic','nama_usaha','kontak_pic','bidang_sektor'];
  let valid = true;
  for (const f of fields) {
    if (!document.getElementById(f).value.trim()) { valid = false; break; }
  }
  if (!document.getElementById('konfirmasi_maps').checked) valid = false;
  if (!document.getElementById('foto_follow_ig').files.length) valid = false;
  if (!document.getElementById('foto_follow_tiktok').files.length) valid = false;

  if (valid) {
    document.getElementById('btnText').classList.add('hidden');
    document.getElementById('btnLoading').classList.remove('hidden');
    document.getElementById('btnLoading').classList.add('flex');
    document.getElementById('btnSubmit').disabled = true;
  }
});
</script>
@endpush
