import React from "react";

/**
 * <PlaceholderImage />
 *
 * A neutral sand-colored block with a centered dashed border and label text.
 * Used as a placeholder for product photos, banners, and thumbnails until
 * real assets exist.
 *
 * @prop aspect - "1:1" | "4:5" | "16:9" — controls the aspect ratio
 * @prop label - Text displayed in the center (e.g. "Product Photo")
 * @prop className - Additional classes
 */

type AspectRatio = "1:1" | "4:5" | "16:9";

interface PlaceholderImageProps {
  aspect?: AspectRatio;
  label?: string;
  className?: string;
}

const aspectClasses: Record<AspectRatio, string> = {
  "1:1": "aspect-square",
  "4:5": "aspect-[4/5]",
  "16:9": "aspect-video",
};

export default function PlaceholderImage({
  aspect = "1:1",
  label = "Image",
  className = "",
}: PlaceholderImageProps) {
  return (
    <div
      className={`
        relative w-full ${aspectClasses[aspect]}
        bg-sand rounded-xs overflow-hidden
        ${className}
      `}
    >
      {/* Dashed inner border */}
      <div className="absolute inset-3 border-2 border-dashed border-border rounded-xs" />

      {/* Centered label */}
      <div className="absolute inset-0 flex flex-col items-center justify-center gap-2">
        {/* Placeholder icon */}
        <svg
          width="32"
          height="32"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          className="text-charcoal/25"
          strokeWidth="1.5"
          strokeLinecap="round"
          strokeLinejoin="round"
          aria-hidden="true"
        >
          <rect x="3" y="3" width="18" height="18" rx="2" />
          <circle cx="8.5" cy="8.5" r="1.5" />
          <path d="M21 15l-5-5L5 21" />
        </svg>
        <span className="text-xs font-sans font-medium tracking-wider uppercase text-charcoal/40">
          {label}
        </span>
      </div>
    </div>
  );
}
