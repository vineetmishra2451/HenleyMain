"use client";

import React, { useState } from "react";
import Link from "next/link";
import PlaceholderImage from "./PlaceholderImage";
import Badge from "./Badge";
import StarRating from "./StarRating";
import PriceTag from "./PriceTag";
import Button from "./Button";
import { useCart } from "./CartProvider";

/* ================================================================
   PRODUCT CARD (<ProductCard />)
   ================================================================
   Displays a botanical reserve product with:
   - Clickable image & title linking to /product/[slug]
   - Rating, category kicker, title, blend notes, and price
   - "View Product" button (links to PDP)
   - "Add to Cart" button (adds to cart & opens cart drawer)
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
  id,
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
  const { open: openCart, updateQuantity } = useCart();

  // Derive product slug
  const productSlug =
    id ||
    name
      .toLowerCase()
      .replace(/[^a-z0-9]+/g, "-")
      .replace(/^-|-$/g, "");

  const productUrl = `/product/${productSlug}`;

  const handleAddToCartClick = (e: React.MouseEvent) => {
    e.preventDefault();
    e.stopPropagation();
    if (onAddToCart) {
      onAddToCart();
    } else {
      openCart();
    }
  };

  return (
    <div
      className={`
        group bg-white rounded-xl border border-border/70 overflow-hidden
        shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between
        ${className}
      `}
      onMouseEnter={() => setHovered(true)}
      onMouseLeave={() => setHovered(false)}
    >
      {/* Image container linking to PDP */}
      <Link href={productUrl} className="block relative overflow-hidden bg-sand/30">
        <PlaceholderImage aspect={imageAspect} label={name} />

        {/* Badge */}
        {badge && (
          <div className="absolute top-3 left-3 z-10">
            <Badge variant={badge}>
              {badgeLabel ||
                (badge === "bestseller"
                  ? "Bestseller"
                  : badge === "organic"
                  ? "100% Organic"
                  : badge === "sale"
                  ? "Sale"
                  : "Low Stock")}
            </Badge>
          </div>
        )}

        {/* Hover overlay hint */}
        <div
          className={`
            absolute inset-0 bg-charcoal/5 transition-opacity duration-300
            ${hovered ? "opacity-100" : "opacity-0"}
          `}
        />
      </Link>

      {/* Card body */}
      <div className="p-4 lg:p-5 space-y-3 flex-1 flex flex-col justify-between text-left">
        <div className="space-y-1.5">
          {/* Star rating */}
          <div className="flex justify-start">
            <StarRating rating={rating} reviewCount={reviewCount} />
          </div>

          {/* Category kicker */}
          {category && (
            <p className="text-eyebrow text-gold !text-[10px] tracking-wider uppercase font-medium">
              {category}
            </p>
          )}

          {/* Product name linking to PDP */}
          <Link href={productUrl} className="block group-hover:text-maroon transition-colors">
            <h3 className="font-serif text-lg lg:text-xl text-charcoal leading-snug">
              {name}
            </h3>
          </Link>

          {/* Subtitle / Blend description */}
          {subtitle && (
            <p className="text-xs text-charcoal/55 line-clamp-1 leading-relaxed">
              {subtitle}
            </p>
          )}
        </div>

        {/* Price & Action Buttons */}
        <div className="space-y-3 pt-2 border-t border-border/50">
          {/* Price */}
          <div className="flex items-baseline justify-between">
            <PriceTag price={price} compareAt={compareAt} size="md" />
            {compareAt && (
              <span className="text-[10px] font-sans font-semibold uppercase text-terracotta bg-terracotta/10 px-1.5 py-0.5 rounded">
                Offer
              </span>
            )}
          </div>

          {/* Dual Action Buttons: View Product + Add to Cart */}
          <div className="grid grid-cols-2 gap-2 pt-1">
            {/* View Product Button */}
            <Link href={productUrl} className="w-full">
              <Button
                variant="secondary"
                className="w-full !text-[11px] !py-2 !px-2 font-medium tracking-normal text-center"
              >
                View Product
              </Button>
            </Link>

            {/* Add to Cart Button */}
            <Button
              variant="primary"
              className="w-full !text-[11px] !py-2 !px-2 font-medium tracking-normal text-center"
              onClick={handleAddToCartClick}
            >
              Add to Cart
            </Button>
          </div>
        </div>
      </div>
    </div>
  );
}
