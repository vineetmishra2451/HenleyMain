import React from "react";

/**
 * <ArchFrame />
 *
 * Clips children into the mihrab/arch shape seen on the Henley tin label
 * and homepage backdrop. Uses an inline SVG <clipPath> with cubic bézier
 * curves for a perfectly smooth arch.
 *
 * Two shapes drawn from the reference:
 * - "tall" (label die-cut): straight sides → curves inward to a slight pointed top (mihrab)
 * - "wide" (hero backdrop): straight sides → smooth semicircular round arch
 *
 * @prop variant - "tall" | "wide"
 * @prop className - Additional classes
 * @prop children - Content to clip (image, placeholder, etc.)
 */

type ArchVariant = "tall" | "wide";

interface ArchFrameProps {
  variant?: ArchVariant;
  className?: string;
  children?: React.ReactNode;
}

const variantSizes: Record<ArchVariant, string> = {
  tall: "aspect-[3/5] max-w-[280px]",
  wide: "aspect-[4/3] max-w-[600px]",
};

/**
 * SVG paths using objectBoundingBox units (0–1 coordinate space).
 *
 * "tall" (mihrab / pointed arch):
 *   Straight sides from bottom up to ~40% height, then two cubic bézier
 *   curves sweeping up to a slight point at top center.
 *   The control points pull inward to create the characteristic
 *   Islamic/mihrab pointed-arch profile.
 *
 * "wide" (doorway / round arch):
 *   Straight sides from bottom up to ~45% height, then a smooth
 *   semicircular arch across the top — control points spread wide
 *   for a full round profile matching the backdrop shape.
 */
const archPaths: Record<ArchVariant, string> = {
  tall: [
    "M 0,1",           // bottom-left
    "L 0,0.42",        // straight up left side
    "C 0,0.22 0.12,0.06 0.5,0", // left curve → pointed top
    "C 0.88,0.06 1,0.22 1,0.42", // pointed top → right curve
    "L 1,1",           // straight down right side
    "Z",               // close
  ].join(" "),
  wide: [
    "M 0,1",           // bottom-left
    "L 0,0.48",        // straight up left side
    "C 0,0.12 0.12,0 0.5,0", // left curve → round top
    "C 0.88,0 1,0.12 1,0.48", // round top → right curve
    "L 1,1",           // straight down right side
    "Z",               // close
  ].join(" "),
};

let idCounter = 0;

export default function ArchFrame({
  variant = "tall",
  className = "",
  children,
}: ArchFrameProps) {
  // Unique ID so multiple ArchFrames on the same page don't collide
  const clipId = `arch-clip-${variant}-${React.useId?.() ?? ++idCounter}`;

  return (
    <div
      className={`relative ${variantSizes[variant]} w-full ${className}`}
    >
      {/* Hidden SVG that defines the clip path */}
      <svg
        width="0"
        height="0"
        className="absolute"
        aria-hidden="true"
      >
        <defs>
          <clipPath
            id={clipId}
            clipPathUnits="objectBoundingBox"
          >
            <path d={archPaths[variant]} />
          </clipPath>
        </defs>
      </svg>

      {/* Clipped content */}
      <div
        className="w-full h-full overflow-hidden"
        style={{ clipPath: `url(#${clipId})` }}
      >
        {children || (
          <div className="w-full h-full bg-maroon flex items-center justify-center">
            <span className="text-ivory/60 font-sans text-sm tracking-wider uppercase">
              Arch {variant}
            </span>
          </div>
        )}
      </div>
    </div>
  );
}
