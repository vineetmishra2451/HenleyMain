import React from "react";

/**
 * <Badge />
 *
 * Small rounded pill badge for product cards and listings.
 *
 * Variants:
 * - organic: sage green background
 * - bestseller: gold background
 * - sale: terracotta background
 * - lowstock: error-tinted background
 */

type BadgeVariant = "organic" | "bestseller" | "sale" | "lowstock";

interface BadgeProps {
  variant?: BadgeVariant;
  children: React.ReactNode;
  className?: string;
}

const variantClasses: Record<BadgeVariant, string> = {
  organic: "bg-sage-light text-[#2D3B28] border-sage/20",
  bestseller: "bg-gold-light text-[#6B5A2F] border-gold/20",
  sale: "bg-terracotta-light text-white border-terracotta/20",
  lowstock: "bg-error/10 text-error border-error/20",
};

export default function Badge({
  variant = "organic",
  children,
  className = "",
}: BadgeProps) {
  return (
    <span
      className={`
        inline-flex items-center
        px-3 py-1
        rounded-full
        font-sans font-medium text-xs tracking-[0.08em] uppercase
        border
        ${variantClasses[variant]}
        ${className}
      `}
    >
      {children}
    </span>
  );
}
