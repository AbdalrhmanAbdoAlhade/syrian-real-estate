<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('properties') || ! Schema::hasTable('property_media')) {
            return;
        }

        $legacyImages = DB::table('properties')
            ->whereNotNull('image')
            ->where('image', '<>', '')
            ->orderBy('id')
            ->select(['id', 'image', 'created_at', 'updated_at'])
            ->get();

        foreach ($legacyImages as $property) {
            $path = trim((string) $property->image);

            if ($path === '') {
                continue;
            }

            $alreadyMigrated = DB::table('property_media')
                ->where('property_id', $property->id)
                ->where('path', $path)
                ->exists();

            if ($alreadyMigrated) {
                continue;
            }

            $hasCover = DB::table('property_media')
                ->where('property_id', $property->id)
                ->where('is_cover', true)
                ->exists();

            $timestamp = $property->created_at ?: now();
            $updatedAt = $property->updated_at ?: $timestamp;

            DB::insert(
                'insert into property_media (property_id, type, path, disk, mime_type, size, sort_order, is_cover, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $property->id,
                    'image',
                    $path,
                    'public',
                    $this->mimeTypeFor($path),
                    null,
                    0,
                    $hasCover ? false : true,
                    $timestamp,
                    $updatedAt,
                ]
            );
        }
    }

    public function down(): void
    {
        // Data backfills are intentionally not reversed to avoid deleting legacy media.
    }

    private function mimeTypeFor(string $path): ?string
    {
        $extension = strtolower(pathinfo(parse_url($path, PHP_URL_PATH) ?: $path, PATHINFO_EXTENSION));

        return match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'avif' => 'image/avif',
            'gif' => 'image/gif',
            default => null,
        };
    }
};
