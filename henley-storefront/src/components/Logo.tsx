import React from "react";
import Image from "next/image";
import logoImg from "@/assets/logo.png";

/**
 * <Logo />
 *
 * Renders the Henley brand logo from the bundled asset.
 *
 * @prop size - "sm" (auth / footer) | "md" (nav / default) | "lg" (hero / display)
 * @prop className - Additional classes (e.g. opacity, scale)
 * @prop inverted - If true, applies CSS invert filter for dark backgrounds
 */

export type LogoSize = "sm" | "md" | "lg";

export interface LogoProps {
  size?: LogoSize;
  className?: string;
  inverted?: boolean;
}

const sizeDimensions: Record<LogoSize, { width: number; height: number; cssWidth: string }> = {
  sm: { width: 112, height: 28, cssWidth: "w-24 sm:w-28" },
  md: { width: 144, height: 36, cssWidth: "w-28 sm:w-36" },
  lg: { width: 180, height: 45, cssWidth: "w-36 sm:w-44" },
};

export default function Logo({ size = "md", className = "", inverted = false }: LogoProps) {
  const dims = sizeDimensions[size];

  return (
    <div className={`inline-flex items-center justify-center ${dims.cssWidth} ${className}`}>
      <Image
        src={logoImg}
        alt="Henley"
        width={dims.width}
        height={dims.height}
        priority
        className={`
          w-full h-auto object-contain select-none transition-opacity
          ${inverted ? "brightness-0 invert" : ""}
        `}
      />
    </div>
  );
}
