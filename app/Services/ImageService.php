<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Upload, compress, and convert image to WebP with custom/slugified SEO friendly naming.
     * Returns array with path, thumb_path, url, thumb_url, size_kb.
     */
    public function uploadAndConvert(
        $file,
        string $directory = 'uploads',
        int $maxWidth = 1920,
        int $quality = 80,
        ?string $customName = null
    ): array {
        if ($customName) {
            $filename = \Illuminate\Support\Str::slug(pathinfo($customName, PATHINFO_FILENAME));
        } else {
            $orig = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = \Illuminate\Support\Str::slug($orig);
        }

        if (empty($filename)) {
            $filename = uniqid();
        }

        // Add a short 5-char unique suffix to prevent collisions while keeping the filename short and clean for SEO
        $filename = $filename . '_' . substr(md5(uniqid()), 0, 5);
        $webpPath  = "{$directory}/{$filename}.webp";
        $thumbPath = "{$directory}/thumb_{$filename}.webp";

        // Main image
        $image = $this->manager->decodePath($file->getRealPath());
        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }
        $encoded = $image->encode(new \Intervention\Image\Encoders\WebpEncoder(quality: $quality));
        Storage::disk('public')->put($webpPath, (string) $encoded);

        // Thumbnail 400px
        $thumb        = $this->manager->decodePath($file->getRealPath());
        $encodedThumb = $thumb->scale(width: 400)->encode(new \Intervention\Image\Encoders\WebpEncoder(quality: 75));
        Storage::disk('public')->put($thumbPath, (string) $encodedThumb);

        return [
            'path'       => $webpPath,
            'thumb_path' => $thumbPath,
            'url'        => Storage::disk('public')->url($webpPath),
            'thumb_url'  => Storage::disk('public')->url($thumbPath),
            'size_kb'    => round(strlen((string) $encoded) / 1024, 2),
        ];
    }

    /**
     * Delete image and its thumbnail from storage.
     */
    public function delete(string $path): void
    {
        Storage::disk('public')->delete($path);

        $dir      = dirname($path);
        $basename = basename($path);
        $thumbPath = $dir . '/thumb_' . $basename;
        Storage::disk('public')->delete($thumbPath);
    }

    /**
     * Upload image preserving original format (JPEG/PNG) with custom/slugified SEO friendly naming.
     */
    public function uploadOriginal(
        $file,
        string $directory = 'uploads',
        int $maxWidth = 1200,
        ?string $customName = null
    ): array {
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'ico'])) {
            $extension = 'png';
        }

        if ($customName) {
            $filename = \Illuminate\Support\Str::slug(pathinfo($customName, PATHINFO_FILENAME));
        } else {
            $orig = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = \Illuminate\Support\Str::slug($orig);
        }

        if (empty($filename)) {
            $filename = uniqid();
        }

        $filename = $filename . '_' . substr(md5(uniqid()), 0, 5) . '.' . $extension;
        $path     = "{$directory}/{$filename}";

        if ($extension === 'ico') {
            Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));
        } else {
            $image = $this->manager->decodePath($file->getRealPath());
            if ($image->width() > $maxWidth) {
                $image->scaleDown(width: $maxWidth);
            }

            $encoder = match ($extension) {
                'jpg', 'jpeg' => new \Intervention\Image\Encoders\JpegEncoder(quality: 90),
                'gif'         => new \Intervention\Image\Encoders\GifEncoder(),
                default       => new \Intervention\Image\Encoders\PngEncoder(),
            };

            $encoded = $image->encode($encoder);
            Storage::disk('public')->put($path, (string) $encoded);
        }

        return [
            'path' => $path,
            'url'  => Storage::disk('public')->url($path),
        ];
    }
}
