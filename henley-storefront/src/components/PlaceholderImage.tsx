"use client";

import React, { useState } from "react";

/* ================================================================
   PLACEHOLDER & PRODUCT IMAGE (<PlaceholderImage />)
   ================================================================
   Renders real product photography from /pimages or falls back to
   a luxury sand dashed placeholder with label and icon.
   ================================================================ */

type AspectRatio = "1:1" | "4:5" | "16:9";

export interface PlaceholderImageProps {
  aspect?: AspectRatio;
  label?: string;
  src?: string;
  alt?: string;
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
  src,
  alt,
  className = "",
}: PlaceholderImageProps) {
  const [imgError, setImgError] = useState(false);

  // If real image source is provided and hasn't errored, render real photo
  if (src && !imgError) {
    return (
      <div
        className={`
          relative w-full ${aspectClasses[aspect]}
          bg-sand/40 overflow-hidden select-none
          ${className}
        `}
      >
        <img
          src={src}
          alt={alt || label}
          onError={() => setImgError(true)}
          loading="lazy"
          className="w-full h-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-105"
        />
      </div>
    );
  }

  // Fallback luxury sand placeholder
  return (
    <div
      className={`
        relative w-full ${aspectClasses[aspect]}
        bg-sand rounded-xs overflow-hidden select-none
        ${className}
      `}
    >
      {/* Dashed inner border */}
      <div className="absolute inset-3 border-2 border-dashed border-border rounded-xs" />

      {/* Centered label */}
      <div className="absolute inset-0 flex flex-col items-center justify-center gap-2 p-3 text-center">
        {/* Placeholder icon */}
        <svg
          width="28"
          height="28"
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
        <span className="text-[11px] font-sans font-medium tracking-wider uppercase text-charcoal/40 line-clamp-2">
          {label}
        </span>
      </div>
    </div>
  );
}
