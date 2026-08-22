<?php

declare(strict_types=1);

namespace App\Services;

class PlaceholderService
{
    /**
     * Named slot inventory with exact intrinsic dimensions, aspect ratios and labels.
     *
     * @var array<string, array{width: int, height: int, ratio: string, label: string}>
     */
    public const SLOTS = [
        'hero' => [
            'width' => 1920,
            'height' => 1080,
            'ratio' => '16:9',
            'label' => 'Hero Lifestyle Cloche',
        ],
        'banner' => [
            'width' => 1440,
            'height' => 480,
            'ratio' => '3:1',
            'label' => 'Promotional Banner',
        ],
        'collection_tile' => [
            'width' => 800,
            'height' => 1000,
            'ratio' => '4:5',
            'label' => 'Collection Tile',
        ],
        'product_square' => [
            'width' => 800,
            'height' => 800,
            'ratio' => '1:1',
            'label' => 'Product Square',
        ],
        'product_detail' => [
            'width' => 1200,
            'height' => 1200,
            'ratio' => '1:1',
            'label' => 'Product Detail Cloche',
        ],
        'story' => [
            'width' => 1200,
            'height' => 900,
            'ratio' => '4:3',
            'label' => 'Story Editorial',
        ],
        'journal_cover' => [
            'width' => 1200,
            'height' => 800,
            'ratio' => '3:2',
            'label' => 'Journal Cover',
        ],
        'avatar' => [
            'width' => 200,
            'height' => 200,
            'ratio' => '1:1',
            'label' => 'Avatar',
        ],
    ];

    /**
     * Palette steps for deterministic variety.
     */
    private const BACKGROUNDS = [
        0 => '#FBF9F6', // Canvas Base
        1 => '#F5F3EF', // Surface Raised
        2 => '#EFECE6', // Warm Stone
    ];

    /**
     * Get image URL for a named slot with optional record ID for deterministic shade variation.
     */
    public static function url(string $slot, int|string|null $id = null): string
    {
        $idParam = $id !== null ? (int) abs(crc32((string) $id)) % 3 : 0;

        return "/placeholders/{$slot}-{$idParam}.svg";
    }

    /**
     * Check if a given URL or path is a placeholder asset.
     */
    public static function isPlaceholder(?string $url): bool
    {
        if (! $url) {
            return true;
        }

        return str_contains($url, 'placeholders/') || str_contains($url, 'placeholder');
    }

    /**
     * Get slot specifications.
     *
     * @return array{width: int, height: int, ratio: string, label: string}
     */
    public static function slot(string $slot): array
    {
        return self::SLOTS[$slot] ?? [
            'width' => 800,
            'height' => 800,
            'ratio' => '1:1',
            'label' => 'Standard Placeholder',
        ];
    }

    /**
     * Generate pure SVG content for a slot and variation.
     */
    public static function generateSvg(string $slot, int $variant = 0): string
    {
        $spec = self::slot($slot);
        $w = $spec['width'];
        $h = $spec['height'];
        $label = htmlspecialchars($spec['label'], ENT_QUOTES, 'UTF-8');
        $bg = self::BACKGROUNDS[$variant % 3] ?? self::BACKGROUNDS[0];

        $wBorder = $w - 16;
        $hBorder = $h - 16;

        $archScale = min($w, $h) * 0.22;
        $archHalf = $archScale / 2;
        $archYMid = $archScale * 0.45;
        $archX = ($w - $archScale) / 2;
        $archY = ($h / 2) - ($archScale * 0.7);
        $circleY = $archYMid - $archHalf - 6;

        $centerX = $w / 2;
        $textBrandY = ($h / 2) + ($archScale * 0.45);
        $textMetaY = $textBrandY + 30;
        $textSubY = $textBrandY + 52;
        $ratio = $spec['ratio'];

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {$w} {$h}" width="{$w}" height="{$h}">
    <defs>
        <style>
            .bg { fill: {$bg}; }
            .hairline { stroke: #E5DFD6; stroke-width: 2; fill: none; }
            .gold-arch { stroke: #B08B4F; stroke-width: 1.5; fill: none; opacity: 0.45; }
            .gold-fill { fill: #B08B4F; opacity: 0.12; }
            .brand { font-family: 'Cormorant Garamond', Georgia, serif; font-size: 28px; font-weight: 500; fill: #231C18; letter-spacing: 0.25em; text-anchor: middle; }
            .meta { font-family: 'Plus Jakarta Sans', -apple-system, sans-serif; font-size: 13px; font-weight: 600; fill: #6E635B; letter-spacing: 0.16em; text-transform: uppercase; text-anchor: middle; }
            .sub { font-family: 'Plus Jakarta Sans', -apple-system, sans-serif; font-size: 11px; font-weight: 400; fill: #8E8278; letter-spacing: 0.08em; text-anchor: middle; }
        </style>
    </defs>
    <!-- Background Canvas -->
    <rect width="{$w}" height="{$h}" class="bg" />
    <!-- 1px Inset Hairline Border -->
    <rect x="8" y="8" width="{$wBorder}" height="{$hBorder}" class="hairline" rx="8" />

    <!-- Centered Apothecary Arch Motif -->
    <g transform="translate({$archX}, {$archY})">
        <!-- Arch Niche -->
        <path d="M 0,{$archScale} L 0,{$archYMid} A {$archHalf},{$archHalf} 0 0,1 {$archScale},{$archYMid} L {$archScale},{$archScale} Z" class="gold-fill" />
        <path d="M 0,{$archScale} L 0,{$archYMid} A {$archHalf},{$archHalf} 0 0,1 {$archScale},{$archYMid} L {$archScale},{$archScale} Z" class="gold-arch" />
        <!-- Cloche Handle Top Notch -->
        <circle cx="{$archHalf}" cy="{$circleY}" r="4" stroke="#B08B4F" stroke-width="1.5" fill="none" opacity="0.45" />
    </g>

    <!-- Typography Block -->
    <text x="{$centerX}" y="{$textBrandY}" class="brand">HENLEY</text>
    <text x="{$centerX}" y="{$textMetaY}" class="meta">{$label}</text>
    <text x="{$centerX}" y="{$textSubY}" class="sub">{$w} × {$h}px • {$ratio}</text>
</svg>
SVG;
    }

    /**
     * Ensure all placeholder files are generated on disk in public/placeholders/
     */
    public static function generateAllFiles(): void
    {
        $dir = public_path('placeholders');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach (array_keys(self::SLOTS) as $slot) {
            for ($variant = 0; $variant < 3; $variant++) {
                $file = "{$dir}/{$slot}-{$variant}.svg";
                file_put_contents($file, self::generateSvg($slot, $variant));
            }
        }
    }
}
