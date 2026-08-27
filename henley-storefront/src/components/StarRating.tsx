import React from "react";

/**
 * <StarRating />
 *
 * Gold/terracotta filled stars with an optional review count.
 * Renders 5 stars total; filled stars use the gold color,
 * empty stars use a muted border tone.
 *
 * @prop rating - Number of filled stars (0–5, supports halves)
 * @prop reviewCount - Optional number to display as "(N Reviews)"
 */

interface StarRatingProps {
  rating?: number;
  reviewCount?: number;
  className?: string;
}

function StarIcon({ filled, half }: { filled: boolean; half?: boolean }) {
  if (half) {
    return (
      <svg
        width="16"
        height="16"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
      >
        <defs>
          <linearGradient id="halfGrad">
            <stop offset="50%" stopColor="currentColor" />
            <stop offset="50%" stopColor="transparent" />
          </linearGradient>
        </defs>
        <path
          d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
          fill="url(#halfGrad)"
          stroke="currentColor"
          strokeWidth="1.5"
          strokeLinejoin="round"
        />
      </svg>
    );
  }

  return (
    <svg
      width="16"
      height="16"
      viewBox="0 0 24 24"
      fill={filled ? "currentColor" : "none"}
      xmlns="http://www.w3.org/2000/svg"
      aria-hidden="true"
    >
      <path
        d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
        stroke="currentColor"
        strokeWidth="1.5"
        strokeLinejoin="round"
      />
    </svg>
  );
}

export default function StarRating({
  rating = 5,
  reviewCount,
  className = "",
}: StarRatingProps) {
  const fullStars = Math.floor(rating);
  const hasHalf = rating % 1 >= 0.5;
  const emptyStars = 5 - fullStars - (hasHalf ? 1 : 0);

  return (
    <div className={`inline-flex items-center gap-1 ${className}`}>
      <div className="flex items-center gap-0.5 text-gold" role="img" aria-label={`${rating} out of 5 stars`}>
        {Array.from({ length: fullStars }).map((_, i) => (
          <StarIcon key={`full-${i}`} filled />
        ))}
        {hasHalf && <StarIcon filled={false} half />}
        {Array.from({ length: emptyStars }).map((_, i) => (
          <StarIcon key={`empty-${i}`} filled={false} />
        ))}
      </div>
      {reviewCount !== undefined && (
        <span className="text-sm text-charcoal/60 font-sans ml-1">
          ({reviewCount} {reviewCount === 1 ? "Review" : "Reviews"})
        </span>
      )}
    </div>
  );
}
