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
   Full luxury storefront matching Laravel and design tokens.
   Section Order:
     1. Hero Section (Mobile Banner Crossfade / Desktop Full Bleed)
     2. Brand Pillars Strip (Hidden on mobile, 4 badges on desktop)
     3. Curated Collections (Horizontally scrollable)
     4. Featured Products (Adaptive grid)
     5. Best Sellers (2 per row on mobile)
     6. Our Promise Story Band (Mihrab ArchFrame + editorial)
     7. Welcome Offer Ribbon (WELCOME10 click-to-copy)
     8. Why Henley? (Cloche artwork + 2x2 grid on mobile)
     9. The Botanical Journal (Horizontal swipe scroll on mobile)
    10. The Henley Ritual (Steeping Experience + 4 movements)
    11. Collector Reflections (Customer reviews + horizontal swipe)
   ================================================================ */

/* ── Data ──────────────────────────────────────────────────────── */

const TRUST_ICONS = [
  { label: "100% Organic", sub: "Pure & Natural", icon: "leaf" },
  { label: "No Artificial Flavours", sub: "Just Pure Goodness", icon: "drop" },
  { label: "Handpicked Leaves", sub: "Finest Quality", icon: "hand" },
  { label: "Freshly Packed", sub: "For Maximum Freshness", icon: "box" },
];

const BRAND_PILLARS = [
  {
    icon: "leaf",
    label: "Single-Estate Origin",
    caption: "Traceable directly to prime mountain slopes",
  },
  {
    icon: "package",
    label: "Apothecary Sealed",
    caption: "Flushed with nitrogen in porcelain tins",
  },
  {
    icon: "truck",
    label: "Complimentary Delivery",
    caption: "Express air courier on orders over ₹1,500",
  },
  {
    icon: "shield",
    label: "100% Biodynamic Purity",
    caption: "Zero synthetic pesticides or artificial aromas",
  },
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

const WHY_HENLEY_PILLARS = [
  {
    icon: "leaf",
    title: "Organic Leaves",
    description: "Handpicked tea leaves grown in organic gardens, nurturing nature and your well-being.",
  },
  {
    icon: "cycle",
    title: "Small Batch Processing",
    description: "Carefully crafted in small batches to preserve the natural flavor and goodness.",
  },
  {
    icon: "flask",
    title: "No Artificial Additives",
    description: "No artificial flavors, colors, or preservatives. Just pure leaves, nothing more.",
  },
  {
    icon: "sparkles",
    title: "Rich in Antioxidants",
    description: "Naturally rich in antioxidants that help you stay refreshed, revitalized, and balanced.",
  },
];

const JOURNAL_ARTICLES = [
  {
    title: "The Chemistry of Spring First Flush: Why Altitude Changes Everything",
    date: "Sep 04, 2026",
    readTime: 5,
    image: "/brand/productpage.jpeg",
    excerpt: "An exploration into the diurnal shifts and ultraviolet light of Himalayan slopes.",
  },
  {
    title: "Single-Estate vs Commercial Blends: Traceability Across 1,800 Metres",
    date: "Aug 20, 2026",
    readTime: 7,
    image: "/brand/collectionpage.jpeg",
    excerpt: "The hidden cost of supermarket tea and the renaissance of micro-lot terroir.",
  },
  {
    title: "The Architecture of the Apothecary Cloche: Preserving Terpenes",
    date: "Aug 15, 2026",
    readTime: 6,
    image: "/brand/product.jpeg",
    excerpt: "Why traditional tin containers oxidize delicate leaves and how porcelain solves it.",
  },
];

const RITUAL_PARAMETERS = [
  { label: "Pure Spring Water", value: "200 ml", note: "Sub-boiling mineral water" },
  { label: "Thermal Precision", value: "85°C / 185°F", note: "Protects delicate oils" },
  { label: "The Cloche Measure", value: "2.5g Scoop", note: "Unbroken whole leaf" },
  { label: "Infusion Duration", value: "3 Minutes", note: "Up to 3 re-steepings" },
];

const RITUAL_STEPS = [
  {
    step: "01",
    name: "The Cloche Dose",
    parameter: "2.5g · Whole Orthodox Leaf",
    description: "Measure unbroken orthodox leaves into pre-warmed porcelain or glass teaware. Inhale the dry bouquet — capturing notes of wild spring blossoms, dried apricot, and high-altitude mountain pine.",
  },
  {
    step: "02",
    name: "Thermal Precision",
    parameter: "85°C (185°F) · Spring Water",
    description: "Bring soft mountain spring water to a gentle simmer and rest for sixty seconds. Sub-boiling warmth coaxes out ethereal floral terpenes and vitamins without scorching or extracting bitter tannins.",
  },
  {
    step: "03",
    name: "The Unhurried Steep",
    parameter: "3 Minutes · Quietude",
    description: "Pour in slow concentric circles over the leaves. Cover and rest for three quiet minutes as the curled needles gently unfurl, releasing a radiant, crystal-clear golden amber liquor.",
  },
  {
    step: "04",
    name: "The Evolving Infusions",
    parameter: "Up to 3 Sequential Steeps",
    description: "Never discard pristine orthodox leaves after a single cup. Second and third steepings unlock deeper tertiary notes — roasted chestnut, wild honey, and lingering mineral sweetness.",
  },
];

const REVIEWS = [
  {
    customerName: "Rohan Mehra",
    date: "Sep 05, 2026",
    title: "The purest chamomile I have ever tasted.",
    body: "Noticeable calming effect within twenty minutes. The bone-white cloche looks stunning on the counter.",
    rating: 5,
    productName: "Tellicherry Reserve Whole Black Peppercorns",
    productUrl: "/product/spice-black-pepper",
  },
  {
    customerName: "Siddharth Bose",
    date: "Sep 03, 2026",
    title: "The purest chamomile I have ever tasted.",
    body: "Noticeable calming effect within twenty minutes. The bone-white cloche looks stunning on the counter.",
    rating: 5,
    productName: "Imperial Royal Kashmiri Saffron Kehwa",
    productUrl: "/product/spice-saffron",
  },
  {
    customerName: "Tara Deshmukh",
    date: "Sep 01, 2026",
    title: "Unbelievable aroma.",
    body: "The scent fills the whole room when unboxing. Packaging design is world class.",
    rating: 5,
    productName: "Tapioca Flour",
    productUrl: "/shop",
  },
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
            <div className="flex items-center gap-3 mb-4">
              <p className="text-eyebrow text-gold">Pure Leaf. Pure Intent.</p>
              <span className="w-12 h-px bg-gold/40" />
              <LeafIcon className="w-4 h-4 text-gold" />
            </div>

            <h1 className="font-serif text-4xl text-charcoal leading-[1.1] mb-5">
              Tea, The Way<br />
              Nature Intended.
            </h1>

            <p className="text-charcoal/70 text-lg leading-relaxed mb-8 max-w-md">
              Organically extracted from handpicked pure leaves, crafted to preserve
              natural aroma, antioxidants, and authentic taste in every cup.
            </p>

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

        {/* Desktop Hero Trust Icons Strip */}
        <div className="border-t border-b border-border bg-sand/30">
          <div className="henley-container py-8">
            <div className="grid grid-cols-4 gap-8">
              {TRUST_ICONS.map((item) => (
                <div key={item.label} className="flex items-center gap-3 justify-start">
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
          SECTION 2: BRAND PILLARS STRIP
          (Hidden on mobile per user request; visible on desktop)
         ════════════════════════════════════════════════════════ */}
      <section className="hidden md:block w-full bg-ivory py-4 border-b border-border/80">
        <div className="henley-container">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-6 text-charcoal">
            {BRAND_PILLARS.map((item) => (
              <div key={item.label} className="flex items-center gap-3">
                <div className="w-10 h-10 rounded-full bg-sand/40 border border-border flex items-center justify-center flex-shrink-0 text-gold">
                  {item.icon === "leaf" && <LeafIcon className="w-5 h-5 text-gold" />}
                  {item.icon === "package" && <PackageIcon className="w-5 h-5 text-gold" />}
                  {item.icon === "truck" && <TruckIcon className="w-5 h-5 text-gold" />}
                  {item.icon === "shield" && <ShieldCheckIcon className="w-5 h-5 text-gold" />}
                </div>
                <div>
                  <p className="text-xs font-sans font-semibold uppercase tracking-wider text-charcoal">{item.label}</p>
                  <p className="text-[11px] text-charcoal/60">{item.caption}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 3: CURATED COLLECTIONS
         ════════════════════════════════════════════════════════ */}
      <section className="py-8 sm:py-12 lg:py-24 overflow-hidden">
        <div className="henley-container">
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
              <Link
                key={cat.name}
                href={`/collections?cat=${cat.slug}`}
                className="
                  flex-shrink-0 w-[240px] sm:w-[270px] lg:w-[280px] xl:w-[calc(20%-19.2px)] snap-start
                  group relative bg-white rounded-xl border border-border/70 overflow-hidden
                  shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between
                "
              >
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
                        {cat.badge === "bestseller" ? "Signature" : "Organic"}
                      </Badge>
                    </div>
                  )}
                  <div className="absolute inset-0 bg-charcoal/0 group-hover:bg-charcoal/10 transition-colors duration-300" />
                </div>

                <div className="p-4 lg:p-5 text-center flex-1 flex flex-col justify-between">
                  <div>
                    <h3 className="font-serif text-lg text-charcoal mb-1">{cat.name}</h3>
                    <p className="text-xs text-charcoal/50 mb-3">{cat.count} Products</p>
                  </div>
                  <span className="text-xs font-sans font-medium text-maroon group-hover:underline">
                    View Collection →
                  </span>
                </div>
              </Link>
            ))}
          </div>

          <p className="text-center text-[11px] font-sans text-charcoal/40 pt-2 sm:hidden flex items-center justify-center gap-1.5">
            <span>←</span>
            <span>Swipe to explore collections</span>
            <span>→</span>
          </p>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 4: FEATURED PRODUCTS
         ════════════════════════════════════════════════════════ */}
      <section className="bg-sand/30 py-16 lg:py-24">
        <div className="henley-container">
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

          <div className="lg:hidden text-center mt-8">
            <a href="/shop" className="text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
              View All Products →
            </a>
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 5: BEST SELLERS
         ════════════════════════════════════════════════════════ */}
      <section className="py-16 lg:py-24">
        <div className="henley-container">
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

          <div className="lg:hidden text-center mt-8">
            <a href="/shop?sort=bestselling" className="text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
              View All Best Sellers →
            </a>
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 6: OUR PROMISE STORY BAND
         ════════════════════════════════════════════════════════ */}
      <section className="py-16 lg:py-24 bg-sand/30">
        <div className="henley-container">
          <div className="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
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

      {/* ════════════════════════════════════════════════════════
          SECTION 7: WELCOME OFFERS / COUPON RIBBON
         ════════════════════════════════════════════════════════ */}
      <OfferBanner />

      {/* ════════════════════════════════════════════════════════
          SECTION 8: WHY HENLEY? QUALITY PROMISE
          (Shifted above Botanical Journal; 2x2 grid on mobile)
         ════════════════════════════════════════════════════════ */}
      <section className="w-full bg-[#F7F4EE] py-16 sm:py-24 border-y border-[#E8E1D5]">
        <div className="henley-container space-y-12 sm:space-y-16">
          
          {/* Top Split Grid: Copy & Cloche Artwork */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            <div className="lg:col-span-7 space-y-5 sm:space-y-6">
              <div className="flex items-center gap-3">
                <span className="font-sans text-xs uppercase tracking-[0.24em] font-semibold text-[#B28746]">
                  OUR PROMISE
                </span>
                <span className="w-10 h-px bg-[#B28746]/50 inline-block" />
                <LeafIcon className="w-4 h-4 text-[#B28746]" />
              </div>

              <h2 className="font-serif text-3xl sm:text-4xl lg:text-5xl font-normal text-[#2A1418] tracking-tight leading-[1.12]">
                Why Henley?
              </h2>

              <p className="text-base sm:text-lg text-[#61544B] leading-relaxed max-w-xl font-sans font-normal">
                We go beyond the ordinary to bring you teas that are pure, mindful, and exceptional in every way.
              </p>

              <div className="pt-2 flex flex-wrap items-center gap-3 text-xs sm:text-sm">
                <span className="inline-flex items-center gap-1.5 text-xs uppercase tracking-[0.20em] font-semibold text-[#B28746]">
                  <LeafIcon className="w-3.5 h-3.5 text-[#B28746]" />
                  PURE LEAF. PURE INTENT.
                </span>
                <span className="text-[#8C7E74]">•</span>
                <span className="font-serif italic text-[#61544B] text-sm sm:text-base">
                  Diet the Health of Life
                </span>
              </div>
            </div>

            <div className="lg:col-span-5 flex justify-center lg:justify-end">
              <div className="relative w-full max-w-[340px] sm:max-w-[380px]">
                <div className="relative overflow-hidden rounded-3xl bg-[#ECE7DC] shadow-[0_20px_48px_-16px_rgba(42,20,24,0.16)] border border-[#E0D7C7] transition-all duration-500 hover:scale-[1.01]">
                  <img
                    src="/brand/why_henley.png"
                    alt="Henley single-estate porcelain cloche canister with botanical leaves and spices"
                    className="w-full h-auto object-cover block"
                  />
                </div>
              </div>
            </div>
          </div>

          {/* Bottom 4 Pillar Cards Grid (2x2 on Mobile, 4x1 on Desktop) */}
          <div className="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 pt-2">
            {WHY_HENLEY_PILLARS.map((pillar) => (
              <div
                key={pillar.title}
                className="group relative bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-7 lg:p-8 border border-[#E8E1D5] shadow-[0_4px_24px_-4px_rgba(42,20,24,0.04)] hover:shadow-[0_14px_36px_-6px_rgba(42,20,24,0.10)] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center justify-between min-h-[220px] sm:min-h-[270px]"
              >
                <div className="w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-[#F4F0E6] border border-[#E5DEC6]/80 flex items-center justify-center mb-3 sm:mb-5 text-[#5C2225] group-hover:bg-[#FAECEB] group-hover:border-[#5C2225]/25 transition-colors duration-300">
                  <PillarIcon type={pillar.icon} />
                </div>
                <div className="space-y-1.5 sm:space-y-3 flex-1 flex flex-col justify-center">
                  <h3 className="font-serif text-base sm:text-xl lg:text-2xl font-normal text-[#2A1418] tracking-tight leading-snug">
                    {pillar.title}
                  </h3>
                  <p className="text-xs sm:text-sm text-[#61544B] leading-relaxed font-sans font-normal line-clamp-3 sm:line-clamp-none">
                    {pillar.description}
                  </p>
                </div>
                <div className="pt-3 sm:pt-6 mt-auto">
                  <LeafIcon className="w-3.5 h-3.5 text-[#B28746]/40 group-hover:text-[#B28746] transition-colors duration-300" />
                </div>
              </div>
            ))}
          </div>

        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 9: THE BOTANICAL JOURNAL
          (Horizontal swipe scroll on mobile; 3-column on desktop)
         ════════════════════════════════════════════════════════ */}
      <section className="w-full bg-ivory py-16 sm:py-24">
        <div className="henley-container space-y-10">
          <div className="text-center max-w-xl mx-auto space-y-2">
            <p className="text-eyebrow text-gold">The Botanical Journal</p>
            <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">Field Notes & Brewing Alchemy</h2>
            <p className="text-sm text-charcoal/60 leading-relaxed">
              Essays on high-altitude terroir, aromatic chemistry, and the unhurried ritual of tea extraction.
            </p>
          </div>

          {/* Mobile Swipe Hint */}
          <div className="flex items-center justify-between md:hidden -mt-4 mb-1">
            <span className="text-[11px] uppercase tracking-wider text-charcoal/50 font-sans">Swipe field notes →</span>
          </div>

          {/* Mobile Horizontal Swipe Scroller & Desktop Grid */}
          <div className="flex overflow-x-auto scrollbar-none snap-x snap-mandatory gap-5 pb-4 -mx-4 px-4 sm:mx-0 sm:px-0 md:grid md:grid-cols-3 md:gap-8 md:overflow-visible md:pb-0">
            {JOURNAL_ARTICLES.map((post) => (
              <article
                key={post.title}
                className="group flex flex-col justify-between rounded-2xl border border-border/80 bg-white/70 overflow-hidden hover:border-gold/50 hover:shadow-card transition-all duration-300 w-[285px] sm:w-[320px] md:w-auto flex-shrink-0 snap-start"
              >
                <div>
                  <div className="aspect-[16/10] w-full overflow-hidden bg-sand/30 relative">
                    <img
                      src={post.image}
                      alt={post.title}
                      className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                    />
                  </div>
                  <div className="p-6 space-y-3">
                    <div className="flex items-center justify-between text-xs text-charcoal/50">
                      <span>{post.date}</span>
                      <span>{post.readTime} min read</span>
                    </div>
                    <h3 className="font-serif text-lg font-normal text-charcoal group-hover:text-maroon transition-colors leading-snug">
                      <Link href="/story">{post.title}</Link>
                    </h3>
                    <p className="text-xs text-charcoal/70 line-clamp-2 leading-relaxed">
                      {post.excerpt}
                    </p>
                  </div>
                </div>
                <div className="px-6 pb-6 pt-2">
                  <Link href="/story" className="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-maroon hover:text-maroon-dark inline-flex items-center gap-1.5 group">
                    <span>Read Essay</span>
                    <span className="inline-block transition-transform duration-200 group-hover:translate-x-1">→</span>
                  </Link>
                </div>
              </article>
            ))}
          </div>

          <div className="text-center pt-4">
            <Link href="/story">
              <Button variant="secondary">
                Read The Complete Botanical Journal →
              </Button>
            </Link>
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 10: THE HENLEY RITUAL (BREWING EXPERIENCE)
         ════════════════════════════════════════════════════════ */}
      <section className="w-full bg-[#FAF8F5] py-20 sm:py-28 border-t border-[#E8E1D5] overflow-hidden" id="henley-ritual">
        <div className="henley-container space-y-14 sm:space-y-18">
          
          {/* Header */}
          <div className="text-center max-w-2xl mx-auto space-y-4">
            <div className="inline-flex items-center justify-center gap-3">
              <span className="w-8 h-px bg-[#B28746]/50 inline-block" />
              <span className="font-sans text-xs uppercase tracking-[0.24em] font-semibold text-[#B28746]">
                THE ART OF INFUSION
              </span>
              <span className="w-8 h-px bg-[#B28746]/50 inline-block" />
            </div>
            <h2 className="font-serif text-3xl sm:text-4xl lg:text-5xl font-normal text-[#2A1418] tracking-tight leading-[1.12]">
              The Henley Ritual
            </h2>
            <p className="font-sans text-base sm:text-lg text-[#61544B] leading-relaxed font-normal">
              Four mindful movements to awaken delicate floral bouquets, essential terpenes, and the authentic single-estate character of your harvest.
            </p>
          </div>

          {/* Quick Metrics */}
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            {RITUAL_PARAMETERS.map((param) => (
              <div key={param.label} className="bg-white/85 rounded-2xl p-5 border border-[#E8E1D5] shadow-xs">
                <p className="text-[11px] uppercase tracking-[0.16em] font-medium text-[#8C7E74] mb-1">{param.label}</p>
                <p className="font-serif text-2xl sm:text-3xl text-[#2A1418] font-normal tracking-tight">{param.value}</p>
                <p className="text-xs text-[#B28746] font-sans mt-1">{param.note}</p>
              </div>
            ))}
          </div>

          {/* Main Split: Arch Visual & 4 Movements */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center pb-6">
            <div className="lg:col-span-5 flex flex-col items-center">
              <div className="relative w-full max-w-[340px] sm:max-w-[390px] mb-12 sm:mb-14 lg:mb-0">
                <div className="relative">
                  <ArchFrame variant="tall" className="shadow-[0_24px_50px_-16px_rgba(42,20,24,0.22)] border border-[#E0D7C7]">
                    <img
                      src="/pimages/tea.jpg"
                      alt="Henley whole orthodox tea leaves infusing in clear mountain spring water"
                      className="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                    />
                  </ArchFrame>
                  <div className="absolute -bottom-5 left-1/2 -translate-x-1/2 w-[90%] bg-white/95 backdrop-blur-md rounded-xl p-3.5 border border-[#E8E1D5] shadow-lg text-center">
                    <p className="text-xs uppercase tracking-[0.18em] font-semibold text-[#B28746] flex items-center justify-center gap-1.5">
                      <LeafIcon className="w-3.5 h-3.5 text-[#B28746]" />
                      Single-Origin Terroir
                    </p>
                    <p className="font-serif text-sm italic text-[#2A1418] mt-0.5">
                      &ldquo;Where mountain spring meets virgin leaf.&rdquo;
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {/* 4 Movements */}
            <div className="lg:col-span-7 space-y-5 sm:space-y-6">
              {RITUAL_STEPS.map((step) => (
                <div key={step.step} className="group bg-white/90 rounded-2xl p-6 sm:p-7 border border-[#E8E1D5] shadow-xs hover:shadow-card hover:border-[#B28746]/60 transition-all duration-300">
                  <div className="flex items-start gap-4 sm:gap-5">
                    <div className="shrink-0 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-[#FAF4EB] border border-[#B28746]/40 flex items-center justify-center text-[#B28746] font-serif text-lg font-semibold shadow-xs group-hover:bg-[#B28746] group-hover:text-white transition-colors duration-300">
                      {step.step}
                    </div>
                    <div className="flex-1 space-y-1.5">
                      <div className="flex flex-wrap items-center justify-between gap-2">
                        <h3 className="font-serif text-xl sm:text-2xl text-[#2A1418] font-normal">{step.name}</h3>
                        <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#F5EFE4] text-[#8A6329] border border-[#E5DAC6]">
                          {step.parameter}
                        </span>
                      </div>
                      <p className="text-sm sm:text-base text-[#61544B] leading-relaxed font-sans">{step.description}</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>

          {/* Bottom CTA Band */}
          <div className="pt-6 border-t border-[#E8E1D5] flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
            <div className="space-y-1">
              <p className="font-serif text-xl text-[#2A1418]">Begin your mindful steeping practice.</p>
              <p className="text-sm text-[#61544B]">Each Henley selection includes estate provenance notes and custom steeping guides.</p>
            </div>
            <div className="flex flex-wrap items-center justify-center sm:justify-end gap-4">
              <Link href="/collections">
                <Button variant="primary" className="!bg-[#2A1418] !text-ivory hover:!bg-[#3D1C24]">
                  Explore Loose-Leaf Harvests →
                </Button>
              </Link>
              <Link href="/collections">
                <Button variant="secondary">Discover Apothecary Teaware</Button>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          SECTION 11: COLLECTOR REFLECTIONS & REVIEWS
          (Horizontal swipe scroll on mobile; 3-column on desktop)
         ════════════════════════════════════════════════════════ */}
      <section className="py-16 lg:py-24 bg-sand/20 border-t border-border/70 overflow-hidden">
        <div className="henley-container">
          <div className="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
              <p className="text-eyebrow text-gold mb-2">Customer Impressions</p>
              <h2 className="font-serif text-2xl lg:text-3xl text-charcoal leading-snug">
                Collector Reflections
              </h2>
              <p className="text-xs sm:text-sm text-charcoal/60 mt-1 max-w-lg leading-relaxed">
                Unfiltered words from tea collectors, herbalists, and mindful living patrons across the globe.
              </p>
            </div>

            <div className="inline-flex items-center gap-3.5 px-4 py-2.5 bg-ivory rounded-full border border-border shadow-xs self-start md:self-auto">
              <div className="flex items-center gap-1 text-gold">
                {[...Array(5)].map((_, i) => (
                  <svg key={i} className="w-4 h-4 fill-current" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                  </svg>
                ))}
              </div>
              <div className="h-4 w-px bg-border" />
              <span className="text-xs font-sans font-medium text-charcoal">
                <strong className="font-semibold text-charcoal">4.98</strong> / 5.0 (1,420+ reviews)
              </span>
            </div>
          </div>

          {/* Mobile Swipe Hint */}
          <div className="flex items-center justify-between md:hidden -mt-6 mb-3">
            <span className="text-[11px] uppercase tracking-wider text-charcoal/50 font-sans">Swipe to view reflections →</span>
          </div>

          {/* Horizontal Swipe Scroller on Mobile, Grid on Desktop */}
          <div className="flex overflow-x-auto scrollbar-none snap-x snap-mandatory gap-4.5 pb-4 -mx-4 px-4 sm:mx-0 sm:px-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-6 md:overflow-visible md:pb-0">
            {REVIEWS.map((review) => (
              <div
                key={review.customerName}
                className="bg-ivory rounded-2xl border border-border/80 p-6 sm:p-7 shadow-subtle flex flex-col justify-between hover:border-gold/50 transition-colors duration-300 w-[290px] sm:w-[330px] md:w-auto flex-shrink-0 snap-start"
              >
                <div className="space-y-3.5">
                  <div className="flex items-center justify-between gap-2">
                    <div className="flex items-center gap-0.5 text-gold">
                      {[...Array(review.rating)].map((_, i) => (
                        <svg key={i} className="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                      ))}
                    </div>
                    <span className="inline-flex items-center gap-1 text-[10px] font-sans font-medium text-emerald-700 bg-emerald-50 border border-emerald-200/60 px-2 py-0.5 rounded-full">
                      <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                      </svg>
                      Verified Buyer
                    </span>
                  </div>
                  <h4 className="font-serif text-lg text-charcoal leading-snug">&ldquo;{review.title}&rdquo;</h4>
                  <p className="text-xs sm:text-[13px] text-charcoal/70 leading-relaxed font-sans line-clamp-4">
                    {review.body}
                  </p>
                </div>
                <div className="mt-6 pt-4 border-t border-border/60 flex items-center justify-between text-xs">
                  <div className="flex flex-col">
                    <span className="font-sans font-semibold text-charcoal text-[12px]">{review.customerName}</span>
                    <span className="text-[10px] text-charcoal/50">{review.date}</span>
                  </div>
                  <Link href={review.productUrl} className="inline-flex items-center gap-1 text-[11px] font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
                    <span className="truncate max-w-[120px]">{review.productName}</span>
                    <span>→</span>
                  </Link>
                </div>
              </div>
            ))}
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

/** Section: Offer/Coupon banner */
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
          <div className="max-w-lg">
            <p className="text-eyebrow text-gold mb-2">Welcome Offer</p>
            <h2 className="font-serif text-2xl lg:text-3xl text-ivory leading-snug mb-2">
              10% Off Your First Order
            </h2>
            <p className="text-ivory/60 text-sm">
              Use code at checkout to receive 10% off your first purchase. New customers only.
            </p>
          </div>

          <div className="flex flex-col sm:flex-row items-center gap-4">
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

function LeafIcon({ className = "w-5 h-5 text-gold" }: { className?: string }) {
  return (
    <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
      <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
      <path d="M5 19c2.8-3.5 6-6.1 12-8" />
    </svg>
  );
}

function PackageIcon({ className = "w-5 h-5 text-gold" }: { className?: string }) {
  return (
    <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
      <path d="M16.5 9.4 7.55 4.24a1.78 1.78 0 0 0-2.5 1.55v12.42a1.78 1.78 0 0 0 2.5 1.55L16.5 14.6a1.78 1.78 0 0 0 0-3.2z" />
      <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
    </svg>
  );
}

function TruckIcon({ className = "w-5 h-5 text-gold" }: { className?: string }) {
  return (
    <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
      <rect x="1" y="3" width="15" height="13" />
      <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
      <circle cx="5.5" cy="18.5" r="2.5" />
      <circle cx="18.5" cy="18.5" r="2.5" />
    </svg>
  );
}

function ShieldCheckIcon({ className = "w-5 h-5 text-gold" }: { className?: string }) {
  return (
    <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
      <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
      <path d="M9 12l2 2 4-4" />
    </svg>
  );
}

function PillarIcon({ type }: { type: string }) {
  const cls = "w-5 h-5 sm:w-6 sm:h-6 text-[#5C2225]";
  switch (type) {
    case "cycle":
      return (
        <svg className={cls} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
          <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
          <path d="M3 3v5h5" />
          <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
          <path d="M16 16h5v5" />
        </svg>
      );
    case "flask":
      return (
        <svg className={cls} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
          <path d="M10 2v6.292a1 1 0 0 1-.2.6l-5.6 7.466A2 2 0 0 0 5.8 19.5h12.4a2 2 0 0 0 1.6-3.142l-5.6-7.466a1 1 0 0 1-.2-.6V2" />
          <path d="M8.5 2h7" />
          <path d="M7 14h10" />
        </svg>
      );
    case "sparkles":
      return (
        <svg className={cls} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
          <path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8L12 2z" />
          <path d="M19 4v4m2-2h-4" />
        </svg>
      );
    case "leaf":
    default:
      return <LeafIcon className={cls} />;
  }
}
