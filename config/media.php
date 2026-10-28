<?php

return [
    'disk' => env('MEDIA_DISK', 'public'),

    'directory' => env('MEDIA_DIRECTORY', 'properties/media'),

    'placeholder' => env(
        'MEDIA_PLACEHOLDER',
        'https://placehold.co/600x400/c53030/ffffff?text=' . urlencode('إرث الشام')
    ),

    'images' => [
        'mimes' => ['jpg', 'jpeg', 'png', 'webp', 'avif'],
        'max_size_kb' => (int) env('MEDIA_IMAGE_MAX_KB', 5120),
        'max_count' => (int) env('MEDIA_IMAGE_MAX_COUNT', 10),
    ],

    'videos' => [
        'mimes' => ['mp4', 'webm', 'mov'],
        'max_size_kb' => (int) env('MEDIA_VIDEO_MAX_KB', 51200),
        'max_count' => (int) env('MEDIA_VIDEO_MAX_COUNT', 3),
    ],
];
