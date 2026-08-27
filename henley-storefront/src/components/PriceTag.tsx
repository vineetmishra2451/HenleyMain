import React from "react";

/**
 * <PriceTag />
 *
 * Displays a serif-styled price with an optional strikethrough
 * compare-at price for sales/discounts.
 *
 * @prop price - Current price (e.g. "$48.00")
 * @prop compareAt - Optional original price to show struck through
 * @prop size - "sm" (card) | "md" (default) | "lg" (PDP hero)
 * @prop className - Additional classes
 */

type PriceSize = "sm" | "md" | "lg";

interface PriceTagProps {
  price: string;
  compareAt?: string;
  size?: PriceSize;
  className?: string;
}

const sizeClasses: Record<PriceSize, string> = {
  sm: "text-lg",    /* 18px */
  md: "text-xl",    /* 24px */
  lg: "text-2xl",   /* 32px */
};

const compareSizeClasses: Record<PriceSize, string> = {
  sm: "text-sm",
  md: "text-base",
  lg: "text-lg",
};

export default function PriceTag({
  price,
  compareAt,
  size = "md",
  className = "",
}: PriceTagProps) {
  const hasDiscount = !!compareAt;

  return (
    <div className={`inline-flex items-baseline gap-2 ${className}`}>
      <span
        className={`
          font-serif font-normal tabular-nums
          ${sizeClasses[size]}
          ${hasDiscount ? "text-terracotta" : "text-charcoal"}
        `}
      >
        {price}
      </span>
      {compareAt && (
        <span
          className={`
            font-serif font-normal tabular-nums
            line-through text-charcoal/40
            ${compareSizeClasses[size]}
          `}
        >
          {compareAt}
        </span>
      )}
    </div>
  );
}
