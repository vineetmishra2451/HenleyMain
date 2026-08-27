"use client";

import React, { useState } from "react";
import PlaceholderImage from "./PlaceholderImage";
import Badge from "./Badge";
import StarRating from "./StarRating";
import PriceTag from "./PriceTag";
import Button from "./Button";
import ProductCard from "./ProductCard";
import { useCart } from "./CartProvider";

/* ================================================================
   PRODUCT DETAILS PAGE TEMPLATE (<ProductDetailPage />)
   ================================================================
   Matches the PDP mockup's two-column architecture:
   1. Breadcrumbs
   2. Left: 1:1 Main Image with Zoom Icon + Thumbnail Swap Strip
   3. Right: Kicker + Title + Rating Anchor + Price + Weight Selector
      + Stepper + Add to Ritual + Buy Now + Wishlist + Trust Strip
   4. Accordion Tabs (About / Ingredients / Brewing / Shipping)
   5. "Our Promise" Sand Card
   6. Customer Reviews Anchor Section
   7. Related Products Grid
   ================================================================ */

interface ProductImage {
  id: string;
  label: string;
  thumbnailLabel: string;
}

interface ProductVariant {
  id: string;
  name: string;
  price: string;
  compareAt?: string;
  numericPrice: number;
}

const PRODUCT_IMAGES: ProductImage[] = [
  {
    id: "img-1",
    label: "Luxury Wellness Tea — Porcelain Cloche Jar",
    thumbnailLabel: "Cloche Jar",
  },
  {
    id: "img-2",
    label: "Loose Leaf Chamomile & Rose Botanicals",
    thumbnailLabel: "Loose Leaf",
  },
  {
    id: "img-3",
    label: "Brewed Golden Infusion in Glass Teacup",
    thumbnailLabel: "Brewed Cup",
  },
  {
    id: "img-4",
    label: "Apothecary Gift Packaging & Tasting Notes",
    thumbnailLabel: "Gift Box",
  },
];

const PRODUCT_VARIANTS: ProductVariant[] = [
  { id: "var-100g", name: "100g Jar", price: "₹1,299", numericPrice: 1299 },
  { id: "var-250g", name: "250g Refill", price: "₹2,699", compareAt: "₹2,999", numericPrice: 2699 },
  { id: "var-50g", name: "50g Discovery Tin", price: "₹749", numericPrice: 749 },
];

const RELATED_PRODUCTS = [
  {
    id: "rel-1",
    name: "Saffron",
    subtitle: "Grade A1 Kashmiri Mogra Filaments",
    category: "Herbs & Spices",
    price: "₹2,499",
    rating: 5,
    reviewCount: 310,
    badge: "bestseller" as const,
  },
  {
    id: "rel-2",
    name: "Cardamom",
    subtitle: "High-Grade Idukki Green Pods",
    category: "Herbs & Spices",
    price: "₹1,499",
    compareAt: "₹1,799",
    rating: 5,
    reviewCount: 198,
    badge: "organic" as const,
  },
  {
    id: "rel-3",
    name: "Pure & Natural Tea",
    subtitle: "First Flush Single Estate Darjeeling",
    category: "Tea",
    price: "₹1,699",
    rating: 5,
    reviewCount: 128,
    badge: "organic" as const,
  },
  {
    id: "rel-4",
    name: "Cocoa",
    subtitle: "Single-Estate Pure Dutch Cocoa Powder",
    category: "Cocoa",
    price: "₹1,299",
    compareAt: "₹1,499",
    rating: 5,
    reviewCount: 188,
    badge: "sale" as const,
  },
];

const REVIEWS = [
  {
    id: "rev-1",
    name: "Elena Rostova",
    date: "August 14, 2026",
    rating: 5,
    verified: true,
    title: "An exquisite evening ritual",
    comment:
      "The chamomile is fragrant and whole-blossom. Brewing a pot after a demanding workday has become my favorite mindful pause. The porcelain jar is stunning on my tea counter.",
  },
  {
    id: "rev-2",
    name: "Julian Vance",
    date: "July 29, 2026",
    rating: 5,
    verified: true,
    title: "Uncompromising botanical purity",
    comment:
      "You can taste the lack of artificial flavorings immediately. The subtle sweetness from holy basil balances the roasted dandelion root perfectly. Exceptional craft.",
  },
  {
    id: "rev-3",
    name: "Sophia Lin",
    date: "July 11, 2026",
    rating: 4.5,
    verified: true,
    title: "Deeply calming blend",
    comment:
      "Helped my sleep quality immensely. Arrived beautifully packaged in eco-friendly protective wrap. Highly recommend the 250g refill once you have the cloche jar.",
  },
];

export default function ProductDetailPage() {
  const { open: openCart } = useCart();

  // Active States
  const [activeImageIndex, setActiveImageIndex] = useState(0);
  const [selectedVariant, setSelectedVariant] = useState<ProductVariant>(PRODUCT_VARIANTS[0]);
  const [quantity, setQuantity] = useState(1);
  const [isWishlisted, setIsWishlisted] = useState(false);

  // Accordion open states (First open by default)
  const [openAccordions, setOpenAccordions] = useState<Record<string, boolean>>({
    about: true,
    ingredients: false,
    brewing: false,
    shipping: false,
  });

  const toggleAccordion = (key: string) => {
    setOpenAccordions((prev) => ({
      ...prev,
      [key]: !prev[key],
    }));
  };

  const handleAddToCart = () => {
    openCart();
  };

  const handleBuyNow = () => {
    openCart();
  };

  return (
    <div className="bg-ivory min-h-screen">
      {/* ── 1. BREADCRUMB ──────────────────────────────────── */}
      <div className="henley-container pt-6 pb-2">
        <nav
          aria-label="Breadcrumb"
          className="flex items-center gap-2 text-xs font-sans text-charcoal/50"
        >
          <a href="/" className="hover:text-maroon transition-colors">
            Home
          </a>
          <span className="text-charcoal/30">/</span>
          <a href="/shop" className="hover:text-maroon transition-colors">
            Herbal
          </a>
          <span className="text-charcoal/30">/</span>
          <span className="text-charcoal font-medium">Luxury Wellness Tea</span>
        </nav>
      </div>

      {/* ── 2. TWO-COLUMN PRODUCT HERO AREA ────────────────── */}
      <section className="henley-container py-8 lg:py-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
          {/* ════════════════════════════════════════════════════
              LEFT COLUMN: PRODUCT IMAGES (7 Cols on Desktop)
             ════════════════════════════════════════════════════ */}
          <div className="lg:col-span-6 space-y-4">
            {/* Primary Main Image Card */}
            <div className="relative bg-white rounded-xl border border-border/70 overflow-hidden shadow-subtle p-3 sm:p-6 flex items-center justify-center">
              {/* Zoom / Magnify icon button */}
              <button
                className="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-ivory/90 border border-border flex items-center justify-center text-charcoal/60 hover:text-maroon hover:bg-ivory shadow-xs transition-colors cursor-pointer"
                aria-label="Zoom product image"
              >
                <svg
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="1.8"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                >
                  <circle cx="11" cy="11" r="8" />
                  <line x1="21" y1="21" x2="16.65" y2="16.65" />
                  <line x1="11" y1="8" x2="11" y2="14" />
                  <line x1="8" y1="11" x2="14" y2="11" />
                </svg>
              </button>

              {/* Active Image Slot */}
              <div className="w-full">
                <PlaceholderImage
                  aspect="1:1"
                  label={PRODUCT_IMAGES[activeImageIndex].label}
                  className="!rounded-lg"
                />
              </div>
            </div>

            {/* Thumbnail Strip */}
            <div className="flex items-center gap-3 overflow-x-auto pb-2">
              {PRODUCT_IMAGES.map((img, idx) => {
                const isActive = activeImageIndex === idx;
                return (
                  <button
                    key={img.id}
                    onClick={() => setActiveImageIndex(idx)}
                    className={`
                      relative w-20 h-20 sm:w-24 sm:h-24 rounded-lg overflow-hidden flex-shrink-0
                      border-2 transition-all cursor-pointer p-1 bg-white
                      ${
                        isActive
                          ? "border-maroon ring-2 ring-maroon/20 shadow-xs"
                          : "border-border/80 hover:border-maroon/40 opacity-70 hover:opacity-100"
                      }
                    `}
                    aria-label={`Select image ${idx + 1}: ${img.thumbnailLabel}`}
                  >
                    <PlaceholderImage
                      aspect="1:1"
                      label={img.thumbnailLabel}
                      className="!rounded-xs h-full"
                    />
                  </button>
                );
              })}
            </div>
          </div>

          {/* ════════════════════════════════════════════════════
              RIGHT COLUMN: PRODUCT INFORMATION (6 Cols on Desktop)
             ════════════════════════════════════════════════════ */}
          <div className="lg:col-span-6 space-y-6">
            {/* Kicker row + 100% Organic Badge */}
            <div className="flex items-center gap-3">
              <span className="text-eyebrow text-charcoal/70 tracking-[0.15em]">
                Herbal Infusions
              </span>
              <span className="w-1 h-1 rounded-full bg-border" />
              <Badge variant="organic">100% Organic</Badge>
            </div>

            {/* Title */}
            <h1 className="font-serif text-3xl sm:text-4xl text-charcoal leading-tight">
              Luxury Wellness Tea
            </h1>

            {/* Description */}
            <p className="text-sm sm:text-base text-charcoal/70 leading-relaxed max-w-lg">
              A restorative botanical blend crafted to soothe the mind and rejuvenate
              the body. Notes of wild chamomile, holy basil, and roasted dandelion root.
            </p>

            {/* Rating Anchor Link */}
            <div className="flex items-center gap-2">
              <StarRating rating={5} />
              <a
                href="#reviews"
                className="text-xs font-sans text-charcoal/60 hover:text-maroon hover:underline transition-colors"
              >
                (124 Reviews)
              </a>
            </div>

            {/* Price Tag */}
            <div className="pt-1">
              <PriceTag
                price={selectedVariant.price}
                compareAt={selectedVariant.compareAt}
                size="lg"
              />
            </div>

            {/* Availability Indicator */}
            <div className="flex items-center gap-2 text-xs font-sans text-success font-medium">
              <span className="w-2 h-2 rounded-full bg-success animate-pulse" />
              <span>In Stock — Hand-blended & sealed in UV-blocking porcelain</span>
            </div>

            {/* ── Variant / Weight Selector ── */}
            <div className="space-y-2.5 pt-2">
              <span className="text-eyebrow text-charcoal/80 block !text-[11px]">
                Select Weight
              </span>
              <div className="flex flex-wrap gap-3">
                {PRODUCT_VARIANTS.map((v) => {
                  const isSelected = selectedVariant.id === v.id;
                  return (
                    <button
                      key={v.id}
                      onClick={() => setSelectedVariant(v)}
                      className={`
                        px-6 py-3 rounded-full text-xs font-sans font-medium transition-all cursor-pointer border
                        ${
                          isSelected
                            ? "border-maroon bg-white text-maroon shadow-xs ring-1 ring-maroon"
                            : "border-border bg-sand/30 text-charcoal/75 hover:bg-sand/70 hover:border-charcoal/30"
                        }
                      `}
                    >
                      {v.name}
                    </button>
                  );
                })}
              </div>
            </div>

            {/* ── Quantity Stepper & Add to Ritual Buttons ── */}
            <div className="space-y-3 pt-2">
              {/* Stepper + Add To Ritual Row */}
              <div className="flex items-center gap-3">
                {/* Quantity Stepper */}
                <div className="flex items-center border border-border rounded-full bg-white overflow-hidden h-12 px-1">
                  <button
                    onClick={() => setQuantity((q) => Math.max(1, q - 1))}
                    disabled={quantity <= 1}
                    className="w-9 h-full flex items-center justify-center text-charcoal/60 hover:text-charcoal disabled:opacity-30 transition-colors cursor-pointer"
                    aria-label="Decrease quantity"
                  >
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M5 12h14" />
                    </svg>
                  </button>
                  <span className="w-8 text-center text-sm font-sans font-medium text-charcoal tabular-nums">
                    {quantity}
                  </span>
                  <button
                    onClick={() => setQuantity((q) => q + 1)}
                    className="w-9 h-full flex items-center justify-center text-charcoal/60 hover:text-charcoal transition-colors cursor-pointer"
                    aria-label="Increase quantity"
                  >
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M12 5v14M5 12h14" />
                    </svg>
                  </button>
                </div>

                {/* Full-width Add to Ritual button */}
                <Button
                  variant="primary"
                  className="flex-1 !h-12 !text-xs !tracking-wider flex items-center justify-center gap-2"
                  onClick={handleAddToCart}
                >
                  Add to Ritual →
                </Button>
              </div>

              {/* Buy Now + Wishlist Row */}
              <div className="flex items-center gap-3">
                <Button
                  variant="secondary"
                  className="flex-1 !h-11 !text-xs"
                  onClick={handleBuyNow}
                >
                  Buy Now
                </Button>

                {/* Wishlist Heart Icon Button */}
                <button
                  onClick={() => setIsWishlisted(!isWishlisted)}
                  className={`
                    w-11 h-11 rounded-full border border-border flex items-center justify-center
                    transition-colors cursor-pointer
                    ${
                      isWishlisted
                        ? "bg-maroon/10 border-maroon text-maroon"
                        : "bg-white text-charcoal/50 hover:text-maroon hover:border-maroon/40"
                    }
                  `}
                  aria-label={isWishlisted ? "Remove from wishlist" : "Add to wishlist"}
                >
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill={isWishlisted ? "currentColor" : "none"}
                    stroke="currentColor"
                    strokeWidth="1.8"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  >
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                  </svg>
                </button>
              </div>
            </div>

            {/* Delivery Note */}
            <p className="text-xs text-charcoal/55 text-center sm:text-left">
              Complimentary standard shipping on orders over ₹1,999.
            </p>

            {/* Scaled-down 4-Icon Trust Row */}
            <div className="pt-4 border-t border-border/80 grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
              {[
                {
                  label: "100% Organic",
                  sub: "Ingredients",
                  icon: (
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                      <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
                      <path d="M5 19c2.8-3.5 6-6.1 12-8" />
                    </svg>
                  ),
                },
                {
                  label: "Caffeine Free",
                  sub: "& Natural",
                  icon: (
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                      <path d="M18 8h1a4 4 0 010 8h-1" />
                      <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z" />
                    </svg>
                  ),
                },
                {
                  label: "Sustainably",
                  sub: "Sourced",
                  icon: (
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                      <circle cx="12" cy="12" r="10" />
                      <path d="M12 2a14.5 14.5 0 000 20 14.5 14.5 0 000-20" />
                    </svg>
                  ),
                },
                {
                  label: "Hand Blended",
                  sub: "Small Batches",
                  icon: (
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                      <path d="M6 10h12l-1.5 9h-9L6 10z" />
                      <path d="M12 3v7" />
                    </svg>
                  ),
                },
              ].map((item) => (
                <div key={item.label} className="space-y-1">
                  <div className="text-gold mx-auto flex justify-center">{item.icon}</div>
                  <p className="text-[11px] font-sans font-medium text-charcoal leading-tight">
                    {item.label}
                  </p>
                  <p className="text-[10px] text-charcoal/45">{item.sub}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ── 3. DETAIL PANELS & "OUR PROMISE" SIDE CARD ────── */}
      <section className="henley-container py-10 lg:py-16 border-t border-border/80">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
          {/* Left Column: Collapsible Accordion Tabs (7 Cols) */}
          <div className="lg:col-span-8 bg-white rounded-xl border border-border/70 overflow-hidden divide-y divide-border">
            {/* Accordion 1: About the Tea */}
            <div>
              <button
                onClick={() => toggleAccordion("about")}
                className="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-sand/20 transition-colors cursor-pointer"
                aria-expanded={openAccordions.about}
              >
                <div className="flex items-center gap-3">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="text-gold" strokeWidth="1.5">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
                    <path d="M5 19c2.8-3.5 6-6.1 12-8" />
                  </svg>
                  <span className="font-sans font-semibold text-xs tracking-[0.14em] uppercase text-charcoal">
                    About the Tea
                  </span>
                </div>
                <span className="text-charcoal/50 text-xs transition-transform duration-300">
                  {openAccordions.about ? "▲" : "▼"}
                </span>
              </button>
              {openAccordions.about && (
                <div className="px-6 pb-6 pt-1 text-sm text-charcoal/70 leading-relaxed space-y-3">
                  <p>
                    A calming herbal infusion thoughtfully blended to restore balance
                    and enhance well-being. Perfect for unwinding after a long day or
                    starting your morning with serene intention.
                  </p>
                  <p>
                    Harvested in small batches from organic Himalayan mountain terraces,
                    the whole flowers and roots are dried gently below 40°C to lock in
                    volatile aromatics and antioxidants.
                  </p>
                </div>
              )}
            </div>

            {/* Accordion 2: Ingredients */}
            <div>
              <button
                onClick={() => toggleAccordion("ingredients")}
                className="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-sand/20 transition-colors cursor-pointer"
                aria-expanded={openAccordions.ingredients}
              >
                <div className="flex items-center gap-3">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="text-gold" strokeWidth="1.5">
                    <path d="M12 2a10 10 0 0 0-7.07 17.07A10 10 0 1 0 12 2z" />
                    <path d="M12 6v6l4 2" />
                  </svg>
                  <span className="font-sans font-semibold text-xs tracking-[0.14em] uppercase text-charcoal">
                    Ingredients
                  </span>
                </div>
                <span className="text-charcoal/50 text-xs">
                  {openAccordions.ingredients ? "▲" : "▼"}
                </span>
              </button>
              {openAccordions.ingredients && (
                <div className="px-6 pb-6 pt-1 text-sm text-charcoal/70 leading-relaxed">
                  <ul className="grid grid-cols-1 sm:grid-cols-2 gap-2 list-disc list-inside">
                    <li>Egyptian Whole Chamomile Blossoms</li>
                    <li>Biodynamic Holy Basil (Krishna Tulsi)</li>
                    <li>Slow-Roasted Dandelion Root</li>
                    <li>Organic Lemon Verbena Leaf</li>
                    <li>Wild Himalayan Lavender Buds</li>
                  </ul>
                </div>
              )}
            </div>

            {/* Accordion 3: Brewing Guide */}
            <div>
              <button
                onClick={() => toggleAccordion("brewing")}
                className="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-sand/20 transition-colors cursor-pointer"
                aria-expanded={openAccordions.brewing}
              >
                <div className="flex items-center gap-3">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="text-gold" strokeWidth="1.5">
                    <path d="M18 8h1a4 4 0 010 8h-1" />
                    <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z" />
                    <line x1="6" y1="1" x2="6" y2="4" />
                    <line x1="10" y1="1" x2="10" y2="4" />
                    <line x1="14" y1="1" x2="14" y2="4" />
                  </svg>
                  <span className="font-sans font-semibold text-xs tracking-[0.14em] uppercase text-charcoal">
                    Brewing Guide
                  </span>
                </div>
                <span className="text-charcoal/50 text-xs">
                  {openAccordions.brewing ? "▲" : "▼"}
                </span>
              </button>
              {openAccordions.brewing && (
                <div className="px-6 pb-6 pt-1 text-sm text-charcoal/70 leading-relaxed grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <div className="p-3 bg-sand/30 rounded-lg text-center">
                    <span className="text-xs font-semibold text-maroon block mb-1">Temperature</span>
                    <span className="font-serif text-lg text-charcoal">95°C / 203°F</span>
                  </div>
                  <div className="p-3 bg-sand/30 rounded-lg text-center">
                    <span className="text-xs font-semibold text-maroon block mb-1">Steep Time</span>
                    <span className="font-serif text-lg text-charcoal">5 – 7 Minutes</span>
                  </div>
                  <div className="p-3 bg-sand/30 rounded-lg text-center">
                    <span className="text-xs font-semibold text-maroon block mb-1">Ratio</span>
                    <span className="font-serif text-lg text-charcoal">1 Tsp / 250ml</span>
                  </div>
                </div>
              )}
            </div>

            {/* Accordion 4: Shipping & Returns */}
            <div>
              <button
                onClick={() => toggleAccordion("shipping")}
                className="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-sand/20 transition-colors cursor-pointer"
                aria-expanded={openAccordions.shipping}
              >
                <div className="flex items-center gap-3">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="text-gold" strokeWidth="1.5">
                    <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                  </svg>
                  <span className="font-sans font-semibold text-xs tracking-[0.14em] uppercase text-charcoal">
                    Shipping & Returns
                  </span>
                </div>
                <span className="text-charcoal/50 text-xs">
                  {openAccordions.shipping ? "▲" : "▼"}
                </span>
              </button>
              {openAccordions.shipping && (
                <div className="px-6 pb-6 pt-1 text-sm text-charcoal/70 leading-relaxed space-y-2">
                  <p>
                    Orders placed before 2:00 PM are dispatched the same business day.
                    Standard domestic delivery takes 2–4 business days.
                  </p>
                  <p>
                    Unopened botanical jars may be returned within 30 days of receipt
                    for a full refund or exchange.
                  </p>
                </div>
              )}
            </div>
          </div>

          {/* Right Column: "Our Promise" Card (4 Cols on Desktop) */}
          <div className="lg:col-span-4 bg-sand/60 rounded-xl border border-border p-8 text-center space-y-4 shadow-subtle">
            <div className="w-14 h-14 mx-auto rounded-full bg-sand border border-gold/30 flex items-center justify-center text-gold">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                <path d="M12 2L15 8.5L22 9.3L17 14L18.2 21L12 17.8L5.8 21L7 14L2 9.3L9 8.5L12 2Z" />
              </svg>
            </div>
            <h3 className="text-eyebrow text-charcoal font-semibold tracking-[0.15em]">
              Our Promise
            </h3>
            <p className="text-sm text-charcoal/70 leading-relaxed max-w-xs mx-auto">
              At Henley, we believe in purity, transparency, and gifting wellness through
              nature&apos;s finest botanical craftsmanship.
            </p>
            <div className="pt-2">
              <a
                href="/story"
                className="inline-flex items-center gap-1.5 text-xs font-sans font-medium text-maroon hover:underline"
              >
                LEARN MORE →
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* ── 4. REVIEWS SECTION (Anchor Target) ─────────────── */}
      <section id="reviews" className="bg-sand/30 border-t border-border py-14 lg:py-20 scroll-mt-24">
        <div className="henley-container">
          <div className="max-w-4xl mx-auto space-y-10">
            {/* Reviews Header */}
            <div className="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 pb-6 border-b border-border">
              <div>
                <p className="text-eyebrow text-gold mb-1">Customer Impressions</p>
                <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">
                  Reviews & Rituals
                </h2>
                <div className="flex items-center gap-2 mt-2">
                  <StarRating rating={5} />
                  <span className="text-xs font-sans text-charcoal/70">
                    4.9 out of 5 based on 124 verified purchasers
                  </span>
                </div>
              </div>

              <Button variant="secondary" className="!text-xs">
                Write a Review
              </Button>
            </div>

            {/* Review Cards Grid */}
            <div className="space-y-6">
              {REVIEWS.map((rev) => (
                <div
                  key={rev.id}
                  className="bg-white rounded-xl border border-border/70 p-6 shadow-subtle space-y-3"
                >
                  <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                      <div className="w-10 h-10 rounded-full bg-sand border border-border flex items-center justify-center font-serif text-sm text-charcoal font-semibold">
                        {rev.name[0]}
                      </div>
                      <div>
                        <div className="flex items-center gap-2">
                          <span className="font-sans font-medium text-sm text-charcoal">
                            {rev.name}
                          </span>
                          {rev.verified && (
                            <span className="text-[10px] uppercase font-semibold text-sage bg-sage/10 px-2 py-0.5 rounded-full">
                              ✓ Verified Buyer
                            </span>
                          )}
                        </div>
                        <span className="text-[11px] text-charcoal/45">
                          {rev.date}
                        </span>
                      </div>
                    </div>
                    <StarRating rating={rev.rating} />
                  </div>

                  <h4 className="font-serif text-base text-charcoal font-medium">
                    &ldquo;{rev.title}&rdquo;
                  </h4>
                  <p className="text-sm text-charcoal/70 leading-relaxed">
                    {rev.comment}
                  </p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ── 5. RELATED PRODUCTS ────────────────────────────── */}
      <section className="py-14 lg:py-20 border-t border-border">
        <div className="henley-container">
          <div className="text-center mb-10">
            <p className="text-eyebrow text-gold mb-2">Complete Your Ritual</p>
            <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">
              You May Also Enjoy
            </h2>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {RELATED_PRODUCTS.map((prod) => (
              <ProductCard
                key={prod.id}
                name={prod.name}
                subtitle={prod.subtitle}
                category={prod.category}
                price={prod.price}
                compareAt={prod.compareAt}
                rating={prod.rating}
                reviewCount={prod.reviewCount}
                badge={prod.badge}
                cardType="product"
                imageAspect="1:1"
                onAddToCart={openCart}
              />
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
