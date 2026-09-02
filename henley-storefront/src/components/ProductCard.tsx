"use client";

import React, { useState } from "react";
import Link from "next/link";
import PlaceholderImage from "./PlaceholderImage";
import Badge from "./Badge";
import StarRating from "./StarRating";
import PriceTag from "./PriceTag";
import Button from "./Button";
import { useCart } from "./CartProvider";
import { findProductBySlug } from "@/data/catalog";

/* ================================================================
   PRODUCT CARD (<ProductCard />)
   ================================================================
   Responsive 2-column mobile & multi-column desktop card with:
   - Real product photograph from /pimages with hover zoom
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
  image?: string;
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
  image,
  badge,
  badgeLabel,
  imageAspect = "4:5",
  cardType = "product",
  className = "",
  onAddToCart,
  onView,
}: ProductCardProps) {
  const [hovered, setHovered] = useState(false);
  const { addItem, open: openCart } = useCart();

  // Derive product slug
  const productSlug =
    id ||
    name
      .toLowerCase()
      .replace(/[^a-z0-9]+/g, "-")
      .replace(/^-|-$/g, "");

  const productUrl = `/product/${productSlug}`;

  // Automatically resolve real product image if not explicitly provided
  const resolvedImage = image || findProductBySlug(id || name)?.image;

  const handleAddToCartClick = (e: React.MouseEvent) => {
    e.preventDefault();
    e.stopPropagation();
    if (onAddToCart) {
      onAddToCart();
    } else {
      addItem({
        id: productSlug,
        name: name,
        variant: "Standard Pack",
        price: price,
        quantity: 1,
      });
    }
  };

  return (
    <div
      className={`
        group bg-white rounded-lg sm:rounded-xl border border-border/70 overflow-hidden
        shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between
        ${className}
      `}
      onMouseEnter={() => setHovered(true)}
      onMouseLeave={() => setHovered(false)}
    >
      {/* Image container linking to PDP with real image */}
      <Link href={productUrl} className="block relative overflow-hidden bg-sand/30">
        <PlaceholderImage
          aspect={imageAspect}
          label={name}
          src={resolvedImage}
          alt={name}
        />

        {/* Badge */}
        {badge && (
          <div className="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 scale-90 sm:scale-100 origin-top-left">
            <Badge variant={badge}>
              {badgeLabel ||
                (badge === "bestseller"
                  ? "Bestseller"
                  : badge === "organic"
                  ? "Organic"
                  : badge === "sale"
                  ? "Sale"
                  : "Low Stock")}
            </Badge>
          </div>
        )}

        {/* Hover overlay hint */}
        <div
          className={`
            absolute inset-0 bg-charcoal/5 transition-opacity duration-300 pointer-events-none
            ${hovered ? "opacity-100" : "opacity-0"}
          `}
        />
      </Link>

      {/* Card body */}
      <div className="p-2.5 sm:p-4 lg:p-5 space-y-2 sm:space-y-3 flex-1 flex flex-col justify-between text-left">
        <div className="space-y-1 sm:space-y-1.5">
          {/* Star rating */}
          <div className="flex justify-start scale-90 sm:scale-100 origin-left">
            <StarRating rating={rating} reviewCount={reviewCount} />
          </div>

          {/* Category kicker */}
          {category && (
            <p className="text-eyebrow text-gold !text-[9px] sm:!text-[10px] tracking-wider uppercase font-medium line-clamp-1">
              {category}
            </p>
          )}

          {/* Product name linking to PDP */}
          <Link href={productUrl} className="block group-hover:text-maroon transition-colors">
            <h3 className="font-serif text-sm sm:text-base lg:text-lg text-charcoal leading-snug line-clamp-1">
              {name}
            </h3>
          </Link>

          {/* Subtitle / Blend description */}
          {subtitle && (
            <p className="text-[11px] sm:text-xs text-charcoal/55 line-clamp-1 leading-relaxed hidden sm:block">
              {subtitle}
            </p>
          )}
        </div>

        {/* Price & Action Buttons */}
        <div className="space-y-2 sm:space-y-3 pt-1.5 sm:pt-2 border-t border-border/50">
          {/* Price */}
          <div className="flex items-baseline justify-between">
            <PriceTag price={price} compareAt={compareAt} size="sm" />
            {compareAt && (
              <span className="text-[9px] sm:text-[10px] font-sans font-semibold uppercase text-terracotta bg-terracotta/10 px-1 py-0.5 rounded">
                Offer
              </span>
            )}
          </div>

          {/* Action Buttons: Responsive for 2-column mobile */}
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-1.5 sm:gap-2 pt-0.5">
            {/* View Product Button */}
            <Link href={productUrl} className="w-full">
              <Button
                variant="secondary"
                className="w-full !text-[10px] sm:!text-[11px] !py-1.5 sm:!py-2 !px-1 font-medium tracking-normal text-center"
              >
                View
              </Button>
            </Link>

            {/* Add to Cart Button */}
            <Button
              variant="primary"
              className="w-full !text-[10px] sm:!text-[11px] !py-1.5 sm:!py-2 !px-1 font-medium tracking-normal text-center"
              onClick={handleAddToCartClick}
            >
              + Bag
            </Button>
          </div>
        </div>
      </div>
    </div>
  );
}
