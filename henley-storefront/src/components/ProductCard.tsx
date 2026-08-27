"use client";

import React, { useState } from "react";
import PlaceholderImage from "./PlaceholderImage";
import Badge from "./Badge";
import StarRating from "./StarRating";
import PriceTag from "./PriceTag";
import Button from "./Button";

/* ================================================================
   PRODUCT / COLLECTION CARD
   ================================================================
   Supports two layout modes:
   - "product": Kicker category, left-aligned, hover quick-add "Add to Ritual"
   - "collection": Centered typography, blend notes subtitle,
     permanent "View Collection" outline pill button (matches mockup)
   ================================================================ */

export interface ProductCardProps {
  id?: string;
  name: string;
  subtitle?: string;
  category?: string;
  price: string;
  compareAt?: string;
  rating?: number;
  reviewCount?: number;
  badge?: "organic" | "bestseller" | "sale" | "lowstock";
  badgeLabel?: string;
  imageAspect?: "1:1" | "4:5" | "16:9";
  cardType?: "product" | "collection";
  benefits?: string[];
  teaType?: "Green" | "Herbal" | "Black";
  numericPrice?: number;
  className?: string;
  onAddToCart?: () => void;
  onView?: () => void;
}

export default function ProductCard({
  name,
  subtitle,
  category,
  price,
  compareAt,
  rating = 5,
  reviewCount,
  badge,
  badgeLabel,
  imageAspect = "4:5",
  cardType = "product",
  className = "",
  onAddToCart,
  onView,
}: ProductCardProps) {
  const [hovered, setHovered] = useState(false);
  const isCollection = cardType === "collection";

  return (
    <div
      className={`
        group bg-white rounded-lg border border-border/50 overflow-hidden
        shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between
        ${className}
      `}
      onMouseEnter={() => setHovered(true)}
      onMouseLeave={() => setHovered(false)}
    >
      {/* Image container */}
      <div className="relative overflow-hidden bg-sand/30">
        <PlaceholderImage aspect={imageAspect} label={name} />

        {/* Badge */}
        {badge && (
          <div className="absolute top-3 left-3 z-10">
            <Badge variant={badge}>
              {badgeLabel || (badge === "bestseller" ? "Bestseller" : badge === "organic" ? "Organic" : badge === "sale" ? "Sale" : "Low Stock")}
            </Badge>
          </div>
        )}

        {/* Quick-add overlay for product cards on hover */}
        {!isCollection && (
          <div
            className={`
              absolute inset-x-0 bottom-0 p-3
              bg-gradient-to-t from-charcoal/40 to-transparent
              transition-all duration-300 ease-[cubic-bezier(0.25,1,0.5,1)]
              ${hovered ? "opacity-100 translate-y-0" : "opacity-0 translate-y-2"}
            `}
          >
            <Button
              variant="primary"
              className="w-full !text-xs !py-2.5"
              onClick={(e) => {
                e.stopPropagation();
                onAddToCart?.();
              }}
            >
              Add to Ritual →
            </Button>
          </div>
        )}
      </div>

      {/* Card body */}
      <div className={`p-4 lg:p-5 space-y-2.5 flex-1 flex flex-col justify-between ${isCollection ? "text-center" : "text-left"}`}>
        <div className="space-y-1.5">
          {/* Star rating */}
          <div className={`flex ${isCollection ? "justify-center" : "justify-start"}`}>
            <StarRating rating={rating} reviewCount={reviewCount} />
          </div>

          {/* Category kicker if product */}
          {!isCollection && category && (
            <p className="text-eyebrow text-gold !text-[10px]">{category}</p>
          )}

          {/* Product name */}
          <h3 className="font-serif text-lg lg:text-xl text-charcoal leading-snug">
            {name}
          </h3>

          {/* Subtitle / Blend description */}
          {subtitle && (
            <p className="text-xs text-charcoal/55 line-clamp-1">{subtitle}</p>
          )}
        </div>

        <div className="space-y-3 pt-1">
          {/* Price */}
          <div className={`flex ${isCollection ? "justify-center" : "justify-start"}`}>
            <PriceTag price={price} compareAt={compareAt} size={isCollection ? "md" : "sm"} />
          </div>

          {/* Action button for collection cards */}
          {isCollection && (
            <Button
              variant="secondary"
              className="w-full !text-xs !py-2.5"
              onClick={onView}
            >
              View Collection
            </Button>
          )}
        </div>
      </div>
    </div>
  );
}
