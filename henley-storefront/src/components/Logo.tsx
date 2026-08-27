import React from "react";
import Image from "next/image";
import logoImg from "@/assets/logo.png";

/**
 * <Logo />
 *
 * Renders the Henley wordmark logo from bundled asset.
 *
 * @prop size - "sm" (nav) | "md" (default) | "lg" (hero/footer)
 * @prop className - Additional classes (e.g. opacity)
 * @prop inverted - If true, applies CSS invert filter for use on dark backgrounds
 */

type LogoSize = "sm" | "md" | "lg";

interface LogoProps {
  size?: LogoSize;
  className?: string;
  inverted?: boolean;
}

const sizeDimensions: Record<LogoSize, { width: number; height: number }> = {
  sm: { width: 96, height: 32 },
  md: { width: 132, height: 44 },
  lg: { width: 180, height: 60 },
};

export default function Logo({ size = "md", className = "", inverted = false }: LogoProps) {
  const dims = sizeDimensions[size];

  return (
    <Image
      src={logoImg}
      alt="Henley"
      width={dims.width}
      height={dims.height}
      priority
      className={`
        object-contain select-none
        ${inverted ? "brightness-0 invert" : ""}
        ${className}
      `}
    />
  );
}
