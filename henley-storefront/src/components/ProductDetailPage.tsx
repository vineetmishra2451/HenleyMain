"use client";

import React, { useState, useMemo, useEffect } from "react";
import PlaceholderImage from "./PlaceholderImage";
import Badge from "./Badge";
import StarRating from "./StarRating";
import PriceTag from "./PriceTag";
import Button from "./Button";
import ProductCard from "./ProductCard";
import { useCart } from "./CartProvider";
import { PRODUCTS, findProductBySlug, ProductItem } from "@/data/catalog";

/* ================================================================
   PRODUCT DETAILS PAGE TEMPLATE (<ProductDetailPage />)
   ================================================================
   Dynamic PDP supporting all 22 products in the catalog:
   1. Breadcrumbs (Home / [Collection] / [Product Name])
   2. Left: 1:1 Main Image with Zoom Icon + 4-Thumbnail Swap Strip
   3. Right: Kicker + Title + Rating Anchor + Price + Weight Selector
      + Stepper + Add to Ritual + Buy Now + Wishlist + Trust Strip
   4. Accordion Tabs (About & Terroir / Ingredients / Ritual & Preparation / Shipping)
   5. "Our Promise" Sand Card
   6. Customer Reviews Anchor Section (#reviews)
   7. Dynamic Related Products Grid
   ================================================================ */

export interface ProductDetailPageProps {
  slug?: string;
  initialProduct?: ProductItem;
}

export default function ProductDetailPage({
  slug = "tea-herb-spice",
  initialProduct,
}: ProductDetailPageProps) {
  const { addItem, open: openCart } = useCart();

  // Find product from catalog
  const product: ProductItem = useMemo(() => {
    if (initialProduct) return initialProduct;
    return findProductBySlug(slug) || PRODUCTS[0];
  }, [slug, initialProduct]);

  // Dynamic Image Gallery tailored to product
  const productImages = useMemo(() => {
    return [
      {
        id: "img-1",
        label: `${product.name} — Sealed Porcelain Cloche Jar`,
        thumbnailLabel: "Cloche Jar",
        src: product.image,
      },
      {
        id: "img-2",
        label: `${product.name} — Whole Sun-Dried Botanical Specimen`,
        thumbnailLabel: "Harvest",
        src: "/pimages/2.jpg",
      },
      {
        id: "img-3",
        label: `${product.name} — Ground Texture & Aromatic Aroma`,
        thumbnailLabel: "Texture",
        src: "/pimages/18.jpg",
      },
      {
        id: "img-4",
        label: `${product.name} — Apothecary Gift Box & Wax Seal`,
        thumbnailLabel: "Gift Box",
        src: "/pimages/6.jpg",
      },
    ];
  }, [product]);

  // Dynamic Variants derived from product weights
  const variants = useMemo(() => {
    const basePrice = product.numericPrice;
    return product.weights.map((w, idx) => {
      let multiplier = 1;
      if (idx === 1) multiplier = 2.1; // Larger refill/bag
      else if (idx === 2) multiplier = 0.55; // Small discovery

      const varPriceNum = Math.round(basePrice * multiplier);
      const varPriceStr = "₹" + varPriceNum.toLocaleString("en-IN");
      const varCompareAt =
        idx === 1 ? "₹" + Math.round(varPriceNum * 1.15).toLocaleString("en-IN") : undefined;

      return {
        id: `var-${idx}`,
        name: w,
        price: varPriceStr,
        compareAt: varCompareAt,
        numericPrice: varPriceNum,
      };
    });
  }, [product]);

  // Active States
  const [activeImageIndex, setActiveImageIndex] = useState(0);
  const [selectedVariantIndex, setSelectedVariantIndex] = useState(0);
  const [quantity, setQuantity] = useState(1);
  const [isWishlisted, setIsWishlisted] = useState(false);

  // Reset variant and quantity when navigating between products
  useEffect(() => {
    setActiveImageIndex(0);
    setSelectedVariantIndex(0);
    setQuantity(1);
  }, [product.id]);

  const selectedVariant = variants[selectedVariantIndex] || variants[0] || {
    id: "var-0",
    name: "Standard Pack",
    price: product.price,
    numericPrice: product.numericPrice,
  };

  // Accordion open states
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
    addItem({
      id: `${product.id}-${selectedVariant.name.toLowerCase().replace(/[^a-z0-9]+/g, "-")}`,
      name: product.name,
      variant: selectedVariant.name,
      price: selectedVariant.price,
      quantity: quantity,
    });
  };

  const handleBuyNow = () => {
    addItem({
      id: `${product.id}-${selectedVariant.name.toLowerCase().replace(/[^a-z0-9]+/g, "-")}`,
      name: product.name,
      variant: selectedVariant.name,
      price: selectedVariant.price,
      quantity: quantity,
    });
  };

  // Related products from the same collection or fallback
  const relatedProducts = useMemo(() => {
    const fromSameCat = PRODUCTS.filter(
      (p) => p.collection === product.collection && p.id !== product.id
    );
    if (fromSameCat.length >= 4) return fromSameCat.slice(0, 4);

    const remaining = PRODUCTS.filter((p) => p.id !== product.id && !fromSameCat.includes(p));
    return [...fromSameCat, ...remaining].slice(0, 4);
  }, [product]);

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
          <a
            href={`/collections?cat=${product.collectionSlug}`}
            className="hover:text-maroon transition-colors"
          >
            {product.collection}
          </a>
          <span className="text-charcoal/30">/</span>
          <span className="text-charcoal font-medium">{product.name}</span>
        </nav>
      </div>

      {/* ── 2. TWO-COLUMN PRODUCT HERO AREA ────────────────── */}
      <section className="henley-container py-8 lg:py-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
          {/* ════════════════════════════════════════════════════
              LEFT COLUMN: PRODUCT IMAGES (6 Cols on Desktop)
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
                  label={productImages[activeImageIndex]?.label || product.name}
                  src={productImages[activeImageIndex]?.src || product.image}
                  alt={product.name}
                  className="!rounded-lg"
                />
              </div>
            </div>

            {/* Thumbnail Strip */}
            <div className="flex items-center gap-3 overflow-x-auto pb-2">
              {productImages.map((img, idx) => {
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
                          ? "border-maroon ring-2 ring-maroon/20 shadow-sm"
                          : "border-border/70 hover:border-maroon/40 opacity-70 hover:opacity-100"
                      }
                    `}
                    aria-label={`View ${img.thumbnailLabel}`}
                  >
                    <PlaceholderImage
                      aspect="1:1"
                      label={img.thumbnailLabel}
                      src={img.src}
                      alt={img.thumbnailLabel}
                      className="!rounded"
                    />
                  </button>
                );
              })}
            </div>
          </div>

          {/* ════════════════════════════════════════════════════
              RIGHT COLUMN: PRODUCT INFORMATION (6 Cols)
             ════════════════════════════════════════════════════ */}
          <div className="lg:col-span-6 space-y-6">
            {/* Kicker Row: Category + Organic Badge */}
            <div className="flex items-center gap-2 flex-wrap">
              <span className="text-eyebrow text-gold font-medium tracking-[0.14em]">
                {product.collection}
              </span>
              <span className="text-charcoal/30">·</span>
              <Badge variant={product.badge || "organic"}>
                {product.badgeLabel || (product.badge === "bestseller" ? "Signature Reserve" : "100% Organic")}
              </Badge>
            </div>

            {/* Product Title */}
            <h1 className="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal font-normal leading-tight">
              {product.name}
            </h1>

            {/* Subtitle / Botanical Notes */}
            <p className="text-xs sm:text-sm font-sans font-medium text-gold tracking-wide">
              {product.subtitle}
            </p>

            {/* Star Rating & Review Anchor */}
            <div className="flex items-center gap-3 pt-1">
              <StarRating rating={product.rating} />
              <a
                href="#reviews"
                className="text-xs font-sans text-charcoal/60 hover:text-maroon underline transition-colors"
              >
                ({product.reviewCount} Verified Reviews)
              </a>
            </div>

            {/* Price Tag with Sale Indicator */}
            <div className="py-2 border-y border-border/80 flex items-baseline justify-between">
              <PriceTag
                price={selectedVariant?.price || product.price}
                compareAt={selectedVariant?.compareAt || product.compareAt}
                size="lg"
              />
              <div className="flex items-center gap-1.5 text-xs font-sans text-success">
                <span className="w-2 h-2 rounded-full bg-success animate-pulse" />
                <span className="font-medium">In Stock — Dispatched in 24h</span>
              </div>
            </div>

            {/* Product Description */}
            <p className="text-xs sm:text-sm text-charcoal/75 leading-relaxed">
              {product.description} Sourced from certified single-origin mountain terroirs and slow-cured to preserve peak essential oils, volatile aromatics, and holistic potency.
            </p>

            {/* Variant / Weight Selector */}
            <div className="space-y-2.5">
              <label className="block text-xs font-sans font-semibold uppercase tracking-[0.1em] text-charcoal/70">
                Select Reserve Size:
              </label>
              <div className="flex flex-wrap gap-2.5">
                {variants.map((v, idx) => {
                  const isSelected = selectedVariantIndex === idx;
                  return (
                    <button
                      key={v.id}
                      onClick={() => setSelectedVariantIndex(idx)}
                      className={`
                        px-5 py-2.5 rounded-full text-xs font-sans font-medium transition-all cursor-pointer border
                        ${
                          isSelected
                            ? "border-maroon bg-white text-maroon shadow-xs ring-1 ring-maroon"
                            : "border-border bg-sand/30 text-charcoal/75 hover:bg-sand/70 hover:border-charcoal/30"
                        }
                      `}
                    >
                      <span>{v.name}</span>
                      <span className="ml-2 opacity-60 font-mono text-[11px]">{v.price}</span>
                    </button>
                  );
                })}
              </div>
            </div>

            {/* Quantity Stepper & Add to Ritual Buttons */}
            <div className="space-y-3 pt-2">
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
                  <span className="w-10 text-center text-sm font-sans font-medium text-charcoal tabular-nums">
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

                {/* Primary Add to Ritual Button */}
                <Button
                  variant="primary"
                  className="flex-1 !h-12 !text-xs !tracking-wider flex items-center justify-center gap-2"
                  onClick={handleAddToCart}
                >
                  Add to Ritual ({selectedVariant?.price || product.price}) →
                </Button>
              </div>

              {/* Buy Now + Wishlist Row */}
              <div className="flex items-center gap-3">
                <Button
                  variant="secondary"
                  className="flex-1 !h-11 !text-xs"
                  onClick={handleBuyNow}
                >
                  Instant Checkout
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
              Complimentary standard shipping across India on orders over ₹1,999.
            </p>

            {/* Scaled-down 4-Icon Trust Row */}
            <div className="pt-4 border-t border-border/80 grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
              {[
                { label: "100% Organic", sub: "Ingredients" },
                { label: "Single Origin", sub: "Smallholder Estate" },
                { label: "0g Plastic", sub: "Porcelain & Glass" },
                { label: "Carbon Neutral", sub: "Eco Express Air" },
              ].map((item) => (
                <div key={item.label} className="p-2.5 bg-sand/30 rounded-lg border border-border/50">
                  <p className="font-sans font-semibold text-[11px] text-charcoal">
                    {item.label}
                  </p>
                  <p className="text-[10px] text-charcoal/45">{item.sub}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ── 3. ACCORDION TABS & SIDE CARD ──────────────────── */}
      <section className="henley-container py-12 border-t border-border/80">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
          {/* Accordion Panels (8 Cols) */}
          <div className="lg:col-span-8 space-y-4">
            {/* About & Terroir Accordion */}
            <div className="border border-border rounded-xl bg-white overflow-hidden shadow-subtle">
              <button
                onClick={() => toggleAccordion("about")}
                className="w-full px-6 py-4 flex items-center justify-between text-left font-serif text-lg text-charcoal hover:bg-sand/30 transition-colors cursor-pointer"
              >
                <span>About {product.name} & Terroir</span>
                <span className="text-sm font-sans">{openAccordions.about ? "−" : "+"}</span>
              </button>
              {openAccordions.about && (
                <div className="px-6 pb-6 pt-2 text-xs sm:text-sm text-charcoal/70 leading-relaxed border-t border-border/50 space-y-2">
                  <p>{product.description}</p>
                  <p>
                    Every batch is harvested in accordance with seasonal astronomical calendars, ensuring volatile oils and aroma remain intensely concentrated.
                  </p>
                </div>
              )}
            </div>

            {/* Ingredients & Benefits Accordion */}
            <div className="border border-border rounded-xl bg-white overflow-hidden shadow-subtle">
              <button
                onClick={() => toggleAccordion("ingredients")}
                className="w-full px-6 py-4 flex items-center justify-between text-left font-serif text-lg text-charcoal hover:bg-sand/30 transition-colors cursor-pointer"
              >
                <span>Botanical Benefits & Profiling</span>
                <span className="text-sm font-sans">{openAccordions.ingredients ? "−" : "+"}</span>
              </button>
              {openAccordions.ingredients && (
                <div className="px-6 pb-6 pt-2 text-xs sm:text-sm text-charcoal/70 leading-relaxed border-t border-border/50 space-y-3">
                  <div className="flex flex-wrap gap-2">
                    {product.benefits.map((b) => (
                      <span key={b} className="px-2.5 py-1 rounded-full bg-sand text-charcoal text-xs font-sans">
                        ✓ {b}
                      </span>
                    ))}
                  </div>
                  <p>
                    Zero synthetic flavorings, preservatives, binders, or artificial anti-caking agents.
                  </p>
                </div>
              )}
            </div>

            {/* Ritual & Preparation */}
            <div className="border border-border rounded-xl bg-white overflow-hidden shadow-subtle">
              <button
                onClick={() => toggleAccordion("brewing")}
                className="w-full px-6 py-4 flex items-center justify-between text-left font-serif text-lg text-charcoal hover:bg-sand/30 transition-colors cursor-pointer"
              >
                <span>Ritual & Preparation Guide</span>
                <span className="text-sm font-sans">{openAccordions.brewing ? "−" : "+"}</span>
              </button>
              {openAccordions.brewing && (
                <div className="px-6 pb-6 pt-2 text-xs sm:text-sm text-charcoal/70 leading-relaxed border-t border-border/50 space-y-2">
                  <p>
                    <strong>Storage:</strong> Keep in a cool, dry sanctuary away from direct sunlight in its UV-blocking container.
                  </p>
                  <p>
                    <strong>Culinary / Infusion:</strong> Add to warm water or culinary dishes to release rich essential fragrances.
                  </p>
                </div>
              )}
            </div>
          </div>

          {/* Side Promise Card (4 Cols) */}
          <div className="lg:col-span-4 bg-sand/60 rounded-2xl border border-border p-6 sm:p-8 space-y-4 shadow-subtle">
            <h3 className="font-serif text-xl text-charcoal">The Henley Standard</h3>
            <p className="text-xs text-charcoal/70 leading-relaxed">
              We work exclusively with ancestral growers who adhere to regenerative, pesticide-free agriculture. If any reserve does not delight your ritual, contact concierge for an immediate replacement.
            </p>
            <div className="pt-2">
              <a href="/story" className="text-xs font-sans font-medium text-maroon hover:underline">
                Read Our Botanical Story →
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* ── 4. REVIEWS SECTION ANCHOR (#reviews) ───────────── */}
      <section id="reviews" className="henley-container py-12 border-t border-border/80 space-y-6">
        <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
          <div>
            <p className="text-eyebrow text-gold mb-1">Customer Impressions</p>
            <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">
              Verified Buyer Reviews
            </h2>
          </div>
          <div className="flex items-center gap-3">
            <StarRating rating={product.rating} />
            <span className="text-sm font-sans font-medium text-charcoal">
              5.0 ({product.reviewCount} Reviews)
            </span>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
          {[
            {
              name: "Lady Catherine Vance",
              date: "August 18, 2026",
              title: "Unmatched Aroma & Terroir",
              text: `The purity of ${product.name} is unlike anything found in retail grocers. The porcelain vessel preserves the aroma flawlessly.`,
            },
            {
              name: "Dr. Alistair Finch",
              date: "August 10, 2026",
              title: "Essential Daily Ritual",
              text: `Exceptional micro-lot quality. You can taste the single-origin mountain terroir with every preparation.`,
            },
            {
              name: "Priya Sharma",
              date: "July 29, 2026",
              title: "Authentic & Pure",
              text: `Dispatched quickly in eco-friendly packaging. Truly authentic and full of vibrant natural vitality.`,
            },
          ].map((rev) => (
            <div key={rev.name} className="bg-white rounded-xl border border-border p-6 shadow-subtle space-y-3">
              <StarRating rating={5} />
              <h4 className="font-serif text-base text-charcoal">{rev.title}</h4>
              <p className="text-xs text-charcoal/70 leading-relaxed">{rev.text}</p>
              <div className="pt-2 border-t border-border/50 flex items-center justify-between text-[11px] font-sans text-charcoal/50">
                <span>{rev.name}</span>
                <span>{rev.date}</span>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* ── 5. RELATED PRODUCTS GRID ───────────────────────── */}
      <section className="bg-sand/30 py-16 lg:py-24 border-t border-border">
        <div className="henley-container space-y-8">
          <div className="text-center max-w-xl mx-auto space-y-2">
            <p className="text-eyebrow text-gold">Complementary Reserves</p>
            <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">
              You May Also Appreciate
            </h2>
          </div>

          <div className="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            {relatedProducts.map((rel) => (
              <ProductCard
                key={rel.id}
                id={rel.id}
                name={rel.name}
                subtitle={rel.subtitle}
                category={rel.collection}
                price={rel.price}
                compareAt={rel.compareAt}
                rating={rel.rating}
                reviewCount={rel.reviewCount}
                badge={rel.badge}
                badgeLabel={rel.badgeLabel}
                cardType="product"
                imageAspect="4:5"
                onAddToCart={openCart}
              />
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
