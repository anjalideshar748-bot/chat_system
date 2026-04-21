<?php

namespace App\Support;

class AttachmentCompression
{
    public static function compress(string $contents): array
    {
        $compressed = gzencode($contents, 9);

        if ($compressed === false) {
            throw new \RuntimeException('Failed to compress attachment.');
        }

        $originalSize = strlen($contents);
        $compressedSize = strlen($compressed);

        if ($compressedSize >= $originalSize) {
            return [
                'algorithm' => 'stored',
                'contents' => $contents,
                'original_size' => $originalSize,
                'stored_size' => $originalSize,
            ];
        }

        return [
            'algorithm' => 'gzip',
            'contents' => $compressed,
            'original_size' => $originalSize,
            'stored_size' => $compressedSize,
        ];
    }

    public static function decompress(string $contents, ?string $algorithm): string
    {
        if ($algorithm !== 'gzip') {
            return $contents;
        }

        $decoded = gzdecode($contents);

        if ($decoded === false) {
            throw new \RuntimeException('Failed to decompress attachment.');
        }

        return $decoded;
    }

    public static function formatBytes(?int $bytes): ?string
    {
        if (! is_int($bytes) || $bytes < 0) {
            return null;
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $size = (float) $bytes;
        $unitIndex = 0;

        while ($size >= 1024 && $unitIndex < count($units) - 1) {
            $size /= 1024;
            $unitIndex++;
        }

        $precision = $size >= 100 || $unitIndex === 0 ? 0 : ($size >= 10 ? 1 : 2);

        return number_format($size, $precision) . ' ' . $units[$unitIndex];
    }
}
