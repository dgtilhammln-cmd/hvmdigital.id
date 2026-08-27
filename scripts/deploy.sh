#!/bin/bash
# ─── DEPLOY SCRIPT — hvm-digital.id ─────────────────────────────────────────
# SSH: ssh -p 65002 u664715641@46.202.186.86
# Jalankan di: ~/public_html

cd ~/public_html

echo "🔄 Pulling latest from GitHub..."
git pull origin main

echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "✅ Deploy selesai!"
echo "📋 Verifikasi schema di: https://search.google.com/test/rich-results?url=https://hvm-digital.id/jasa-pembuatan-website-surabaya-murah"
