"use client";

import React, { useRef } from "react";
import Image from "next/image";
import Link from "next/link";
import heroBannerImg from "@/assets/herobanner.png";
import {
  ArchFrame,
  Button,
  Badge,
  PlaceholderImage,
  ProductCard,
} from "@/components";

/* ================================================================
   HENLEY HOME PAGE
   ================================================================
   7 sections matching the sitemap & reference mockup tone.
   All images are <PlaceholderImage> — no generated photography.
   Header + Footer are rendered by LayoutShell (wraps all pages).
   ================================================================ */

/* ── Data ──────────────────────────────────────────────────────── */

const TRUST_ICONS = [
  { label: "100% Organic", sub: "Pure & Natural", icon: "leaf" },
  { label: "No Artificial Flavours", sub: "Just Pure Goodness", icon: "drop" },
  { label: "Handpicked Leaves", sub: "Finest Quality", icon: "hand" },
  { label: "Freshly Packed", sub: "For Maximum Freshness", icon: "box" },
];

const CATEGORIES = [
  { name: "Tea", slug: "tea", count: 2, image: "/pimages/tea.jpg", badge: "bestseller" as const },
  { name: "Herbs & Spices", slug: "herbs-spices", count: 12, image: "/pimages/cardamom.jpg", badge: "organic" as const },
  { name: "Flours & Grains", slug: "flours-grains", count: 4, image: "/pimages/besan.jpg", badge: undefined },
  { name: "Cooking Essentials", slug: "cooking-essentials", count: 3, image: "/pimages/sugarjpg.jpg", badge: undefined },
  { name: "Cocoa", slug: "cocoa", count: 1, image: "/pimages/cocoa.jpg", badge: "sale" as const },
];

const FEATURED_PRODUCTS = [
  { id: "spice-saffron", name: "Saffron", category: "Herbs & Spices", price: "₹2,499", rating: 5, reviews: 310, badge: "bestseller" as const },
  { id: "tea-herb-spice", name: "Herb & Spice Tea", category: "Tea", price: "₹1,299", compareAt: "₹1,499", rating: 5, reviews: 164, badge: "bestseller" as const },
  { id: "spice-cardamom", name: "Cardamom", category: "Herbs & Spices", price: "₹1,499", compareAt: "₹1,799", rating: 5, reviews: 198, badge: "organic" as const },
  { id: "cocoa-pure", name: "Cocoa", category: "Cocoa", price: "₹1,299", compareAt: "₹1,499", rating: 5, reviews: 188, badge: "sale" as const },
  { id: "tea-pure-natural", name: "Pure & Natural Tea", category: "Tea", price: "₹1,699", rating: 5, reviews: 128, badge: "organic" as const },
  { id: "spice-cinnamon", name: "Cinnamon", category: "Herbs & Spices", price: "₹999", rating: 5, reviews: 167, badge: "organic" as const },
];

const BESTSELLERS = [
  { id: "spice-saffron", name: "Saffron", category: "Herbs & Spices", price: "₹2,499", rating: 5, reviews: 310 },
  { id: "tea-herb-spice", name: "Herb & Spice Tea", category: "Tea", price: "₹1,299", rating: 5, reviews: 164 },
  { id: "spice-black-pepper", name: "Black Pepper", category: "Herbs & Spices", price: "₹899", rating: 5, reviews: 142 },
  { id: "grain-besan", name: "Besan", category: "Flours & Grains", price: "₹599", rating: 5, reviews: 112 },
];

export default function HomePage() {
  const scrollRef = useRef<HTMLDivElement>(null);
  const [mobileHeroIndex, setMobileHeroIndex] = React.useState(0);
  const mobileHeroImages = ["/brand/heromobile1.jpg", "/brand/heromobile2.jpg"];

  // Auto-rotate mobile hero images smoothly
  React.useEffect(() => {
    const timer = setInterval(() => {
      setMobileHeroIndex((prev) => (prev + 1) % mobileHeroImages.length);
    }, 4500);
    return () => clearInterval(timer);
  }, [mobileHeroImages.length]);

  return (
    <div className="bg-ivory">

      {/* ════════════════════════════════════════════════════════
          SECTION 1: HERO / PROMOTIONAL BANNER
         ════════════════════════════════════════════════════════ */}

      {/* ── MOBILE VARIANT (< lg): Half-screen rounded banner with single Shop Now CTA & zero text ── */}
      <section className="lg:hidden px-4 pt-3 pb-2">
        <div className="relative w-full h-[46vh] min-h-[310px] max-h-[420px] rounded-2xl sm:rounded-3xl overflow-hidden shadow-subtle border border-border/70 bg-sand/40">
          {/* Mobile Background Images with smooth crossfade */}
          {mobileHeroImages.map((src, idx) => (
            <div
              key={src}
              className={`
                absolute inset-0 transition-opacity duration-1000 ease-in-out
                ${mobileHeroIndex === idx ? "opacity-100 scale-100" : "opacity-0 scale-105 pointer-events-none"}
              `}
            >
              <img
                src={src}
                alt="Henley Botanical Sanctuary"
                className="w-full h-full object-cover object-center"
              />
            </div>
          ))}

          {/* Subtle bottom-edge shadow for contrast */}
          <div className="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-charcoal/50 via-charcoal/15 to-transparent pointer-events-none" />

          {/* Single Shop Now Button in Bottom Left */}
          <div className="absolute bottom-4 left-4 z-10">
            <Link href="/shop">
              <Button
                variant="primary"
                className="!px-6 !py-2.5 !text-xs !font-medium !shadow-card !bg-maroon text-ivory hover:!bg-maroon-dark uppercase tracking-wider"
              >
                Shop Now →
              </Button>
            </Link>
          </div>

          {/* Discrete Dot Indicator in Bottom Right */}
          <div className="absolute bottom-4 right-4 z-10 flex items-center gap-1.5 bg-charcoal/30 backdrop-blur-xs px-2.5 py-1 rounded-full border border-white/20">
            {mobileHeroImages.map((_, idx) => (
              <button
                key={idx}
                onClick={() => setMobileHeroIndex(idx)}
                className={`
                  w-2 h-2 rounded-full transition-all cursor-pointer
                  ${mobileHeroIndex === idx ? "bg-white w-4" : "bg-white/50 hover:bg-white/80"}
                `}
                aria-label={`Show mobile banner slide ${idx + 1}`}
              />
            ))}
          </div>
        </div>
      </section>

      {/* ── DESKTOP VARIANT (lg+): Full-bleed editorial landscape with typography & trust strip ── */}
      <section className="hidden lg:flex relative overflow-hidden min-h-[580px] flex-col justify-between">
        {/* Background image */}
        <Image
          src={heroBannerImg}
          alt="Henley — Tea, The Way Nature Intended"
          fill
          priority
          placeholder="blur"
          className="object-cover object-center select-none"
          sizes="100vw"
        />

        {/* Content */}
        <div className="henley-container relative z-10 py-24 flex items-center min-h-[560px]">
          <div className="max-w-xl">
            {/* Kicker */}
            <div className="flex items-center gap-3 mb-4">
              <p className="text-eyebrow text-gold">Pure Leaf. Pure Intent.</p>
              <span className="w-12 h-px bg-gold/40" />
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="text-gold" strokeWidth="1.5">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
                <path d="M5 19c2.8-3.5 6-6.1 12-8" />
              </svg>
            </div>

            {/* Headline */}
            <h1 className="font-serif text-4xl text-charcoal leading-[1.1] mb-5">
              Tea, The Way<br />
              Nature Intended.
            </h1>

            {/* Body */}
            <p className="text-charcoal/70 text-lg leading-relaxed mb-8 max-w-md">
              Organically extracted from handpicked pure leaves, crafted to preserve
              natural aroma, antioxidants, and authentic taste in every cup.
            </p>

            {/* CTAs */}
            <div className="flex flex-wrap items-center gap-3">
              <Link href="/shop">
                <Button variant="primary">Shop Collection →</Button>
              </Link>
              <Link href="/story">
                <Button variant="ghost">Discover Our Process →</Button>
              </Link>
            </div>
          </div>
        </div>

        {/* ── Desktop Trust Icons Strip ── */}
        <div className="border-t border-b border-border bg-sand/30">
          <div className="henley-container py-8">
            <div className="grid grid-cols-4 gap-8">
              {TRUST_ICONS.map((item) => (
                <div key={item.label} className="flex items-center gap-3 justify-start">
                  {/* Icon circle */}
                  <div className="w-10 h-10 rounded-full bg-ivory border border-border flex items-center justify-center flex-shrink-0">
                    <TrustIcon type={item.icon} />
                  </div>
                  <div>
                    <p className="text-xs font-sans font-semibold text-charcoal leading-tight">{item.label}</p>
                    <p className="text-[11px] text-charcoal/45">{item.sub}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 2: FEATURED CATEGORIES (HORIZONTALLY SCROLLABLE)
         ════════════════════════════════════════════════════════ */}
      <section className="py-8 sm:py-12 lg:py-24 overflow-hidden">
        <div className="henley-container">
          {/* Section heading + navigation controls */}
          <div className="flex flex-col sm:flex-row sm:items-end justify-between mb-8 lg:mb-12 gap-4">
            <div>
              <p className="text-eyebrow text-gold mb-2">Explore Our Range</p>
              <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">
                Curated Collections
              </h2>
              <p className="text-xs sm:text-sm text-charcoal/60 mt-1 max-w-md">
                Discover our meticulously crafted blends, single-origin spices, and stoneground flours.
              </p>
            </div>

            {/* Scroll Navigation Arrows & Mobile Indicator */}
            <div className="flex items-center gap-3 self-end sm:self-auto">
              <span className="text-[11px] font-sans text-charcoal/40 hidden sm:inline">
                Scroll to explore
              </span>
              <div className="flex items-center gap-2">
                <button
                  onClick={() => {
                    const el = document.getElementById("collections-scroll-container");
                    if (el) el.scrollBy({ left: -280, behavior: "smooth" });
                  }}
                  className="w-8 h-8 rounded-full border border-border bg-white text-charcoal/60 hover:text-maroon hover:border-maroon flex items-center justify-center transition-colors shadow-xs cursor-pointer"
                  aria-label="Scroll collections left"
                >
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                    <path d="M15 18l-6-6 6-6" />
                  </svg>
                </button>
                <button
                  onClick={() => {
                    const el = document.getElementById("collections-scroll-container");
                    if (el) el.scrollBy({ left: 280, behavior: "smooth" });
                  }}
                  className="w-8 h-8 rounded-full border border-border bg-white text-charcoal/60 hover:text-maroon hover:border-maroon flex items-center justify-center transition-colors shadow-xs cursor-pointer"
                  aria-label="Scroll collections right"
                >
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                    <path d="M9 18l6-6-6-6" />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          {/* Horizontally scrollable Category cards (5 Collections) */}
          <div
            id="collections-scroll-container"
            className="
              flex overflow-x-auto gap-4 sm:gap-5 lg:gap-6 pb-4 pt-1
              snap-x snap-mandatory scroll-smooth
              px-4 -mx-4 sm:px-0 sm:mx-0
              scrollbar-none
            "
          >
            {CATEGORIES.map((cat) => (
              <a
                key={cat.name}
                href={`/collections?cat=${cat.slug}`}
                className="
                  flex-shrink-0 w-[240px] sm:w-[270px] lg:w-[280px] xl:w-[calc(20%-19.2px)] snap-start
                  group relative bg-white rounded-xl border border-border/70 overflow-hidden
                  shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between
                "
              >
                {/* Image */}
                <div className="relative">
                  <PlaceholderImage
                    aspect="4:5"
                    label={cat.name}
                    src={cat.image}
                    alt={cat.name}
                  />
                  {cat.badge && (
                    <div className="absolute top-3 left-3 z-10">
                      <Badge variant={cat.badge}>
                        {cat.badge === "organic" ? "Organic" : cat.badge === "bestseller" ? "Signature" : "Reserve"}
                      </Badge>
                    </div>
                  )}
                  {/* Hover overlay */}
                  <div className="absolute inset-0 bg-charcoal/0 group-hover:bg-charcoal/10 transition-colors duration-300" />
                </div>

                {/* Card body */}
                <div className="p-4 lg:p-5 text-center flex-1 flex flex-col justify-between">
                  <div>
                    <h3 className="font-serif text-lg text-charcoal mb-1">{cat.name}</h3>
                    <p className="text-xs text-charcoal/50 mb-3">{cat.count} Products</p>
                  </div>
                  <span className="text-xs font-sans font-medium text-maroon group-hover:underline">
                    View Collection →
                  </span>
                </div>
              </a>
            ))}
          </div>

          {/* Mobile Swipe Hint */}
          <p className="text-center text-[11px] font-sans text-charcoal/40 pt-2 sm:hidden flex items-center justify-center gap-1.5">
            <span>←</span>
            <span>Swipe to explore collections</span>
            <span>→</span>
          </p>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 3: FEATURED PRODUCTS
         ════════════════════════════════════════════════════════ */}
      <section className="bg-sand/30 py-16 lg:py-24">
        <div className="henley-container">
          {/* Section heading */}
          <div className="flex items-end justify-between mb-10 lg:mb-14">
            <div>
              <p className="text-eyebrow text-gold mb-2">Handpicked for You</p>
              <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">
                Featured Products
              </h2>
            </div>
            <a href="/shop" className="hidden lg:inline-flex items-center gap-1 text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
              View All →
            </a>
          </div>

          {/* Horizontal scrollable on mobile, grid on desktop */}
          <div
            ref={scrollRef}
            className="
              flex lg:grid lg:grid-cols-3 xl:grid-cols-4 gap-5
              overflow-x-auto snap-x snap-mandatory
              pb-4 -mb-4
              scrollbar-none
              lg:overflow-visible lg:pb-0 lg:mb-0
            "
            style={{ scrollbarWidth: "none", msOverflowStyle: "none" }}
          >
            {FEATURED_PRODUCTS.map((product) => (
              <div key={product.name} className="snap-start flex-shrink-0 w-[72vw] sm:w-[45vw] lg:w-auto">
                <ProductCard
                  id={product.id}
                  name={product.name}
                  category={product.category}
                  price={product.price}
                  compareAt={product.compareAt}
                  rating={product.rating}
                  reviewCount={product.reviews}
                  badge={product.badge}
                  imageAspect="1:1"
                />
              </div>
            ))}
          </div>

          {/* Mobile "View All" link */}
          <div className="lg:hidden text-center mt-8">
            <a href="/shop" className="text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
              View All Products →
            </a>
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 4: BEST SELLERS
         ════════════════════════════════════════════════════════ */}
      <section className="py-16 lg:py-24">
        <div className="henley-container">
          {/* Section heading */}
          <div className="flex items-end justify-between mb-10 lg:mb-14">
            <div>
              <p className="text-eyebrow text-gold mb-2">Most Loved</p>
              <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">
                Best Sellers
              </h2>
            </div>
            <a href="/shop?sort=bestselling" className="hidden lg:inline-flex items-center gap-1 text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
              View All →
            </a>
          </div>

          {/* Product grid: 2 per row on mobile */}
          <div className="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
            {BESTSELLERS.map((product) => (
              <ProductCard
                key={product.name}
                id={product.id}
                name={product.name}
                category={product.category}
                price={product.price}
                rating={product.rating}
                reviewCount={product.reviews}
                badge="bestseller"
                badgeLabel="Bestseller"
                imageAspect="1:1"
              />
            ))}
          </div>

          {/* Mobile "View All" */}
          <div className="lg:hidden text-center mt-8">
            <a href="/shop?sort=bestselling" className="text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
              View All Best Sellers →
            </a>
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 5: OFFERS / COUPONS
         ════════════════════════════════════════════════════════ */}
      <OfferBanner />

      {/* ════════════════════════════════════════════════════════
          SECTION 6: PROMOTIONAL / EDITORIAL
         ════════════════════════════════════════════════════════ */}
      <section className="py-16 lg:py-24 bg-sand/30">
        <div className="henley-container">
          <div className="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
            {/* ArchFrame image */}
            <div className="flex-1 flex justify-center">
              <ArchFrame variant="tall" className="!max-w-[320px]">
                <PlaceholderImage
                  aspect="4:5"
                  label="Henley — Our Process"
                  src="/pimages/2.jpg"
                  alt="Henley — Our Process"
                  className="!aspect-auto h-full"
                />
              </ArchFrame>
            </div>

            {/* Copy */}
            <div className="flex-1 max-w-lg text-center lg:text-left">
              <p className="text-eyebrow text-gold mb-3">Our Promise</p>
              <h2 className="font-serif text-2xl lg:text-3xl text-charcoal leading-snug mb-4">
                From Leaf to Cup,<br />
                With Intention.
              </h2>
              <p className="text-charcoal/60 text-base leading-relaxed mb-3">
                At Henley, we believe in purity, transparency, and gifting wellness
                through nature&apos;s finest. Every blend is hand-selected from
                organic farms, slow-dried to preserve essential oils, and packed in
                small batches to ensure peak freshness.
              </p>
              <p className="text-charcoal/60 text-base leading-relaxed mb-8">
                Our apothecary-inspired tins are designed to be beautiful enough to
                keep and refill — because sustainability should never sacrifice style.
              </p>
              <a
                href="/story"
                className="inline-flex items-center gap-2 text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors group"
              >
                Learn More
                <span className="group-hover:translate-x-1 transition-transform">→</span>
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* Footer is rendered by LayoutShell */}
    </div>
  );
}


/* ================================================================
   LOCAL COMPONENTS (not exported — homepage only)
   ================================================================ */

/** Section 5: Offer/Coupon banner */
function OfferBanner() {
  const [copied, setCopied] = React.useState(false);

  const handleCopy = () => {
    if (typeof navigator !== "undefined" && navigator.clipboard) {
      navigator.clipboard.writeText("WELCOME10").then(() => {
        setCopied(true);
        setTimeout(() => setCopied(false), 2000);
      });
    } else {
      setCopied(true);
      setTimeout(() => setCopied(false), 2000);
    }
  };

  return (
    <section className="bg-maroon">
      <div className="henley-container py-12 lg:py-16">
        <div className="flex flex-col lg:flex-row items-center justify-between gap-8 text-center lg:text-left">
          {/* Copy */}
          <div className="max-w-lg">
            <p className="text-eyebrow text-gold mb-2">Welcome Offer</p>
            <h2 className="font-serif text-2xl lg:text-3xl text-ivory leading-snug mb-2">
              10% Off Your First Order
            </h2>
            <p className="text-ivory/60 text-sm">
              Use code at checkout to receive 10% off your first purchase. New customers only.
            </p>
          </div>

          {/* Code chip + CTA */}
          <div className="flex flex-col sm:flex-row items-center gap-4">
            {/* Clipboard code chip */}
            <button
              onClick={handleCopy}
              className="
                group flex items-center gap-2.5 px-5 py-3
                bg-ivory/10 border border-ivory/20 rounded-full
                hover:bg-ivory/15 transition-colors cursor-pointer
              "
            >
              <span className="font-mono text-sm font-semibold text-gold tracking-widest">
                WELCOME10
              </span>
              <span className="w-px h-4 bg-ivory/20" />
              {copied ? (
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="text-success" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                  <path d="M20 6L9 17l-5-5" />
                </svg>
              ) : (
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="text-ivory/50 group-hover:text-ivory transition-colors" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                  <rect x="9" y="9" width="13" height="13" rx="2" />
                  <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" />
                </svg>
              )}
            </button>

            <Link href="/shop">
              <Button
                variant="primary"
                className="!bg-ivory !text-maroon hover:!bg-sand"
              >
                Shop Now →
              </Button>
            </Link>
          </div>
        </div>
      </div>
    </section>
  );
}

/** Trust icon SVGs */
function TrustIcon({ type }: { type: string }) {
  const cls = "text-gold";
  switch (type) {
    case "leaf":
      return (
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" className={cls} strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
          <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
          <path d="M5 19c2.8-3.5 6-6.1 12-8" />
        </svg>
      );
    case "drop":
      return (
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" className={cls} strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
          <path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z" />
        </svg>
      );
    case "hand":
      return (
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" className={cls} strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
          <path d="M18 11V6a2 2 0 00-4 0v5" />
          <path d="M14 10V4a2 2 0 00-4 0v6" />
          <path d="M10 10.5V6a2 2 0 00-4 0v8" />
          <path d="M18 8a2 2 0 014 0v6a8 8 0 01-8 8H8a8 8 0 01-6-3" />
        </svg>
      );
    case "box":
      return (
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" className={cls} strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
          <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
          <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
          <line x1="12" y1="22.08" x2="12" y2="12" />
        </svg>
      );
    default:
      return null;
  }
}
