"use client";

import React, { useState, useMemo } from "react";
import ArchFrame from "./ArchFrame";
import Button from "./Button";
import ProductCard from "./ProductCard";
import { useCart } from "./CartProvider";
import { COLLECTIONS, PRODUCTS, Collection, ProductItem } from "@/data/catalog";

/* ================================================================
   PRODUCT LISTING PAGE TEMPLATE (<ProductListingPage />)
   ================================================================
   Taxonomy & Collections:
   1. Tea (2 products)
   2. Herbs & Spices (12 products)
   3. Flours & Grains (4 products)
   4. Cooking Essentials (3 products)
   5. Cocoa (1 product)

   Features:
   - Collection / Category Tabs bar
   - Left Sidebar Accordions (Collection, Benefit, Price)
   - View Mode: "Collections" (5 cards) or "Products" (filtered grid)
   - Mobile Sheet Filters
   - Empty State + Live Reset
   - Pagination
   - Bottom Trust Strip
   ================================================================ */

export type ListingVariant = "all" | "category" | "brand" | "search";

export interface BreadcrumbItem {
  label: string;
  href?: string;
}

export interface ProductListingPageProps {
  variant?: ListingVariant;
  title?: string;
  description?: string;
  activeCollectionSlug?: string;
  searchQuery?: string;
  breadcrumbs?: BreadcrumbItem[];
}

const BENEFIT_OPTIONS = [
  { id: "Immunity", label: "Immunity", count: 8 },
  { id: "Energy", label: "Energy", count: 10 },
  { id: "Digestion", label: "Digestion", count: 9 },
  { id: "Relaxation", label: "Relaxation", count: 7 },
  { id: "Focus", label: "Focus", count: 4 },
  { id: "Detox", label: "Detox", count: 4 },
  { id: "Sleep", label: "Sleep", count: 3 },
];

const PRICE_OPTIONS = [
  { id: "under-500", label: "Under ₹500", min: 0, max: 499 },
  { id: "500-1000", label: "₹500 - ₹1,000", min: 500, max: 1000 },
  { id: "1000-2000", label: "₹1,000 - ₹2,000", min: 1001, max: 2000 },
  { id: "above-2000", label: "Above ₹2,000", min: 2001, max: Infinity },
];

const SORT_OPTIONS = [
  { id: "featured", label: "Featured" },
  { id: "price-asc", label: "Price: Low to High" },
  { id: "price-desc", label: "Price: High to Low" },
  { id: "rating", label: "Highest Rated" },
  { id: "name-asc", label: "Alphabetical" },
];

export default function ProductListingPage({
  variant = "category",
  title,
  description,
  activeCollectionSlug,
  searchQuery = "Saffron",
  breadcrumbs,
}: ProductListingPageProps) {
  const { open: openCart } = useCart();

  // Active Variant override state for developer / reviewer switcher
  const [activeVariant, setActiveVariant] = useState<ListingVariant>(variant);

  // Active Collection Tab ('all' or specific collection slug)
  const [selectedCollection, setSelectedCollection] = useState<string>(
    activeCollectionSlug || "all"
  );

  // View Mode: 'collections' (shows 5 collection overview cards) or 'products' (shows individual products)
  const [viewMode, setViewMode] = useState<"collections" | "products">(
    variant === "category" && !activeCollectionSlug ? "collections" : "products"
  );

  // Filter States
  const [selectedCollectionsFilter, setSelectedCollectionsFilter] = useState<string[]>(
    activeCollectionSlug ? [activeCollectionSlug] : []
  );
  const [selectedBenefits, setSelectedBenefits] = useState<string[]>([]);
  const [selectedPrices, setSelectedPrices] = useState<string[]>([]);
  const [sortBy, setSortBy] = useState("featured");
  const [currentPage, setCurrentPage] = useState(1);
  const [isMobileFiltersOpen, setIsMobileFiltersOpen] = useState(false);

  // Accordion toggle states
  const [collectionExpanded, setCollectionExpanded] = useState(true);
  const [benefitExpanded, setBenefitExpanded] = useState(true);
  const [priceExpanded, setPriceExpanded] = useState(true);

  // Toggle helpers
  const toggleCollectionFilter = (slug: string) => {
    setSelectedCollectionsFilter((prev) =>
      prev.includes(slug) ? prev.filter((item) => item !== slug) : [...prev, slug]
    );
    setViewMode("products");
    setCurrentPage(1);
  };

  const toggleBenefit = (id: string) => {
    setSelectedBenefits((prev) =>
      prev.includes(id) ? prev.filter((item) => item !== id) : [...prev, id]
    );
    setViewMode("products");
    setCurrentPage(1);
  };

  const togglePrice = (id: string) => {
    setSelectedPrices((prev) =>
      prev.includes(id) ? prev.filter((item) => item !== id) : [...prev, id]
    );
    setViewMode("products");
    setCurrentPage(1);
  };

  const clearAllFilters = () => {
    setSelectedCollectionsFilter([]);
    setSelectedBenefits([]);
    setSelectedPrices([]);
    setSelectedCollection("all");
    setCurrentPage(1);
  };

  const totalActiveFilters =
    selectedCollectionsFilter.length +
    selectedBenefits.length +
    selectedPrices.length;

  // Filter products logic
  const filteredProducts = useMemo(() => {
    return PRODUCTS.filter((product) => {
      // Top Tab filtering (if not 'all')
      if (selectedCollection !== "all" && product.collectionSlug !== selectedCollection) {
        return false;
      }

      // Search Query filter
      if (activeVariant === "search" && searchQuery) {
        const q = searchQuery.toLowerCase();
        const matchesName = product.name.toLowerCase().includes(q);
        const matchesSub = product.subtitle.toLowerCase().includes(q);
        const matchesCat = product.collection.toLowerCase().includes(q);
        if (!matchesName && !matchesSub && !matchesCat) return false;
      }

      // Sidebar Collection filter
      if (selectedCollectionsFilter.length > 0) {
        if (!selectedCollectionsFilter.includes(product.collectionSlug)) return false;
      }

      // Benefit filter
      if (selectedBenefits.length > 0) {
        const matches = selectedBenefits.some((b) => product.benefits?.includes(b));
        if (!matches) return false;
      }

      // Price filter
      if (selectedPrices.length > 0) {
        const matchesPrice = selectedPrices.some((priceId) => {
          const cfg = PRICE_OPTIONS.find((p) => p.id === priceId);
          if (!cfg) return false;
          return product.numericPrice >= cfg.min && product.numericPrice <= cfg.max;
        });
        if (!matchesPrice) return false;
      }

      return true;
    });
  }, [
    selectedCollection,
    activeVariant,
    searchQuery,
    selectedCollectionsFilter,
    selectedBenefits,
    selectedPrices,
  ]);

  // Sort products
  const sortedProducts = useMemo(() => {
    const list = [...filteredProducts];
    switch (sortBy) {
      case "price-asc":
        return list.sort((a, b) => a.numericPrice - b.numericPrice);
      case "price-desc":
        return list.sort((a, b) => b.numericPrice - a.numericPrice);
      case "rating":
        return list.sort((a, b) => (b.rating ?? 0) - (a.rating ?? 0));
      case "name-asc":
        return list.sort((a, b) => a.name.localeCompare(b.name));
      default:
        return list;
    }
  }, [filteredProducts, sortBy]);

  // Pagination (6 per page)
  const itemsPerPage = 6;
  const totalPages = Math.ceil(sortedProducts.length / itemsPerPage) || 1;
  const paginatedProducts = sortedProducts.slice(
    (currentPage - 1) * itemsPerPage,
    currentPage * itemsPerPage
  );

  // Dynamic Header Metadata
  const resolvedHeader = useMemo(() => {
    switch (activeVariant) {
      case "all":
        return {
          title: title || "Shop All Reserves",
          description:
            description ||
            "Explore our complete apothecary of single-estate teas, organic herbs, whole spices, heirloom flours, and pure cocoa.",
          crumbs: breadcrumbs || [
            { label: "Home", href: "/" },
            { label: "Shop", href: "/shop" },
            { label: "All Products" },
          ],
        };
      case "category":
        return {
          title: title || "Curated Collections",
          description:
            description ||
            "Discover our 5 botanical collections: single-estate teas, rare whole spices, stoneground grains, cooking essentials, and pure cocoa.",
          crumbs: breadcrumbs || [
            { label: "Home", href: "/" },
            { label: "Collections", href: "/collections" },
            {
              label:
                selectedCollection !== "all"
                  ? COLLECTIONS.find((c) => c.slug === selectedCollection)?.name || "All"
                  : "All Collections",
            },
          ],
        };
      case "brand":
        return {
          title: "Henley Botanical Reserve",
          description:
            "Artisanal culinary apothecary rooted in ancestral herbal wisdom, Himalayan harvests, and pure whole spices.",
          crumbs: breadcrumbs || [
            { label: "Home", href: "/" },
            { label: "Brand", href: "/brands/henley" },
            { label: "Henley" },
          ],
        };
      case "search":
        return {
          title: `Results for "${searchQuery}"`,
          description: `Showing available matches across all 5 botanical collections for "${searchQuery}".`,
          crumbs: breadcrumbs || [
            { label: "Home", href: "/" },
            { label: "Search" },
            { label: `"${searchQuery}"` },
          ],
        };
    }
  }, [activeVariant, title, description, breadcrumbs, searchQuery, selectedCollection]);

  return (
    <div className="bg-ivory min-h-screen">
      {/* ── Variant Switcher Rail (For Developer / Reviewer) ── */}
      <div className="bg-sand/80 border-b border-border py-2 px-4 sticky top-[64px] lg:top-[72px] z-30 shadow-subtle backdrop-blur-sm">
        <div className="henley-container flex flex-wrap items-center justify-between gap-3 text-xs">
          <div className="flex items-center gap-2">
            <span className="font-mono font-semibold uppercase tracking-wider text-charcoal/60">
              Template Variant:
            </span>
            <div className="flex bg-ivory rounded-full p-0.5 border border-border">
              {(
                [
                  { id: "category", label: "1. Collections" },
                  { id: "all", label: "2. Shop All" },
                  { id: "brand", label: "3. Brand Profile" },
                  { id: "search", label: "4. Search Results" },
                ] as const
              ).map((v) => (
                <button
                  key={v.id}
                  onClick={() => {
                    setActiveVariant(v.id);
                    clearAllFilters();
                    if (v.id === "category") setViewMode("collections");
                    else setViewMode("products");
                  }}
                  className={`
                    px-3 py-1 rounded-full font-sans font-medium transition-colors cursor-pointer
                    ${
                      activeVariant === v.id
                        ? "bg-maroon text-ivory shadow-xs"
                        : "text-charcoal/70 hover:text-maroon"
                    }
                  `}
                >
                  {v.label}
                </button>
              ))}
            </div>
          </div>
          <span className="text-charcoal/50 text-[11px] hidden sm:inline">
            5 Collections · 22 Products mapped
          </span>
        </div>
      </div>

      {/* ════════════════════════════════════════════════════════
          1. PAGE HEADER BAND
         ════════════════════════════════════════════════════════ */}
      <header className="relative bg-sand/30 border-b border-border/80 overflow-hidden">
        {/* ArchFrame backdrop for Category view */}
        {activeVariant === "category" && (
          <div className="absolute inset-0 flex items-center justify-center pointer-events-none opacity-20">
            <ArchFrame variant="wide" className="!max-w-[720px] scale-125" />
          </div>
        )}

        <div className="henley-container relative z-10 py-10 lg:py-16">
          {/* Breadcrumbs */}
          <nav
            aria-label="Breadcrumbs"
            className="flex items-center justify-center gap-2 text-xs font-sans text-charcoal/50 mb-4"
          >
            {resolvedHeader.crumbs.map((crumb, idx) => (
              <React.Fragment key={crumb.label}>
                {idx > 0 && <span className="text-charcoal/30">/</span>}
                {crumb.href ? (
                  <a href={crumb.href} className="hover:text-maroon transition-colors">
                    {crumb.label}
                  </a>
                ) : (
                  <span className="text-charcoal font-medium">{crumb.label}</span>
                )}
              </React.Fragment>
            ))}
          </nav>

          {/* Header Content */}
          {activeVariant === "brand" ? (
            <div className="max-w-2xl mx-auto text-center space-y-4">
              <div className="w-20 h-20 mx-auto rounded-full bg-sand border-2 border-border p-3 shadow-subtle flex items-center justify-center">
                <span className="font-sans font-bold text-lg tracking-widest text-maroon uppercase">
                  H
                </span>
              </div>
              <h1 className="font-serif text-3xl lg:text-4xl text-charcoal">
                {resolvedHeader.title}
              </h1>
              <p className="text-sm lg:text-base text-charcoal/65 max-w-lg mx-auto leading-relaxed">
                {resolvedHeader.description}
              </p>
              <div className="flex items-center justify-center gap-6 pt-2 text-xs font-sans text-charcoal/60">
                <span>📍 Single-Origin Terroir</span>
                <span>🌿 100% Certified Organic</span>
                <span>✨ 5 Handcrafted Collections</span>
              </div>
            </div>
          ) : (
            <div className="max-w-2xl mx-auto text-center space-y-3">
              <h1 className="font-serif text-3xl lg:text-4xl text-charcoal tracking-tight">
                {resolvedHeader.title}
              </h1>
              <p className="text-sm lg:text-base text-charcoal/65 max-w-lg mx-auto leading-relaxed">
                {resolvedHeader.description}
              </p>

              {/* Search suggestions */}
              {activeVariant === "search" && (
                <div className="pt-2">
                  <span className="text-xs text-charcoal/50 mr-2">Suggested:</span>
                  {["Saffron", "Cardamom", "Cinnamon", "Herb & Spice Tea"].map((kw, i) => (
                    <React.Fragment key={kw}>
                      {i > 0 && <span className="text-charcoal/30 mx-2">·</span>}
                      <button
                        onClick={() => {
                          setSelectedCollection("all");
                          clearAllFilters();
                        }}
                        className="text-xs font-sans font-medium text-maroon hover:underline cursor-pointer"
                      >
                        {kw}
                      </button>
                    </React.Fragment>
                  ))}
                </div>
              )}
            </div>
          )}

          {/* ── Collection Navigation Tabs Bar ── */}
          <div className="flex items-center justify-center gap-2 overflow-x-auto pt-8 pb-1 scrollbar-none">
            <button
              onClick={() => {
                setSelectedCollection("all");
                setCurrentPage(1);
              }}
              className={`
                px-4 py-2 rounded-full text-xs font-sans font-medium transition-all whitespace-nowrap cursor-pointer border
                ${
                  selectedCollection === "all"
                    ? "bg-maroon text-ivory border-maroon shadow-xs"
                    : "bg-white/80 border-border text-charcoal/70 hover:bg-white hover:text-maroon"
                }
              `}
            >
              All Collections (22)
            </button>

            {COLLECTIONS.map((c) => {
              const isSelected = selectedCollection === c.slug;
              return (
                <button
                  key={c.id}
                  onClick={() => {
                    setSelectedCollection(c.slug);
                    setViewMode("products");
                    setCurrentPage(1);
                  }}
                  className={`
                    px-4 py-2 rounded-full text-xs font-sans font-medium transition-all whitespace-nowrap cursor-pointer border flex items-center gap-1.5
                    ${
                      isSelected
                        ? "bg-maroon text-ivory border-maroon shadow-xs"
                        : "bg-white/80 border-border text-charcoal/70 hover:bg-white hover:text-maroon"
                    }
                  `}
                >
                  <span>{c.name}</span>
                  <span className={`text-[10px] ${isSelected ? "text-ivory/80" : "text-charcoal/40"}`}>
                    ({c.productCount})
                  </span>
                </button>
              );
            })}
          </div>
        </div>
      </header>

      {/* ════════════════════════════════════════════════════════
          MAIN CONTENT AREA
         ════════════════════════════════════════════════════════ */}
      <div className="henley-container py-8 lg:py-14">
        {/* Mobile Filter Toggle + Sort Bar */}
        <div className="lg:hidden flex items-center justify-between gap-4 mb-6 pb-4 border-b border-border">
          <Button
            variant="secondary"
            className="!py-2 !px-4 !text-xs flex items-center gap-2"
            onClick={() => setIsMobileFiltersOpen(true)}
          >
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
              <path d="M4 6h16M7 12h10M10 18h4" />
            </svg>
            Filters
            {totalActiveFilters > 0 && (
              <span className="w-5 h-5 rounded-full bg-maroon text-ivory text-[10px] flex items-center justify-center">
                {totalActiveFilters}
              </span>
            )}
          </Button>

          {/* Mobile Sort Dropdown */}
          <div className="flex items-center gap-2">
            <span className="text-xs text-charcoal/60">Sort:</span>
            <select
              value={sortBy}
              onChange={(e) => setSortBy(e.target.value)}
              aria-label="Sort products"
              className="bg-sand/60 border border-border rounded-md px-2.5 py-1.5 text-xs font-sans text-charcoal focus:outline-none focus:border-maroon"
            >
              {SORT_OPTIONS.map((opt) => (
                <option key={opt.id} value={opt.id}>
                  {opt.label}
                </option>
              ))}
            </select>
          </div>
        </div>

        <div className="flex flex-col lg:flex-row gap-8 lg:gap-12 items-start">
          {/* ════════════════════════════════════════════════════
              2. LEFT SIDEBAR: FILTERS
             ════════════════════════════════════════════════════ */}
          <aside className="hidden lg:block w-64 flex-shrink-0 space-y-6 select-none">
            <div className="flex items-center justify-between pb-3 border-b border-border">
              <h2 className="font-sans font-semibold text-xs tracking-[0.14em] uppercase text-charcoal">
                Filters
              </h2>
              {totalActiveFilters > 0 && (
                <button
                  onClick={clearAllFilters}
                  className="text-xs text-maroon hover:underline font-medium cursor-pointer"
                >
                  Reset ({totalActiveFilters})
                </button>
              )}
            </div>

            {/* Accordion 1: Collection */}
            <div className="border-b border-border/70 pb-4">
              <button
                onClick={() => setCollectionExpanded(!collectionExpanded)}
                className="w-full flex items-center justify-between py-2 text-sm font-sans font-medium text-charcoal hover:text-maroon transition-colors cursor-pointer"
                aria-expanded={collectionExpanded}
              >
                <span>Collection</span>
                <span className="text-charcoal/40 text-xs font-mono">
                  {collectionExpanded ? "▲" : "▼"}
                </span>
              </button>
              {collectionExpanded && (
                <div className="space-y-2.5 pt-2">
                  {COLLECTIONS.map((c) => {
                    const isChecked =
                      selectedCollectionsFilter.includes(c.slug) ||
                      selectedCollection === c.slug;
                    return (
                      <label
                        key={c.id}
                        className="flex items-center justify-between text-xs font-sans text-charcoal/80 hover:text-charcoal cursor-pointer group"
                      >
                        <div className="flex items-center gap-2.5">
                          <input
                            type="checkbox"
                            checked={isChecked}
                            onChange={() => toggleCollectionFilter(c.slug)}
                            className="rounded-xs border-border text-maroon focus:ring-maroon cursor-pointer"
                          />
                          <span className={isChecked ? "font-medium text-maroon" : ""}>
                            {c.name}
                          </span>
                        </div>
                        <span className="text-charcoal/40 text-[11px]">
                          ({c.productCount})
                        </span>
                      </label>
                    );
                  })}
                </div>
              )}
            </div>

            {/* Accordion 2: Benefit */}
            <div className="border-b border-border/70 pb-4">
              <button
                onClick={() => setBenefitExpanded(!benefitExpanded)}
                className="w-full flex items-center justify-between py-2 text-sm font-sans font-medium text-charcoal hover:text-maroon transition-colors cursor-pointer"
                aria-expanded={benefitExpanded}
              >
                <span>Benefit</span>
                <span className="text-charcoal/40 text-xs font-mono">
                  {benefitExpanded ? "▲" : "▼"}
                </span>
              </button>
              {benefitExpanded && (
                <div className="space-y-2.5 pt-2">
                  {BENEFIT_OPTIONS.map((opt) => {
                    const isChecked = selectedBenefits.includes(opt.id);
                    return (
                      <label
                        key={opt.id}
                        className="flex items-center justify-between text-xs font-sans text-charcoal/80 hover:text-charcoal cursor-pointer group"
                      >
                        <div className="flex items-center gap-2.5">
                          <input
                            type="checkbox"
                            checked={isChecked}
                            onChange={() => toggleBenefit(opt.id)}
                            className="rounded-xs border-border text-maroon focus:ring-maroon cursor-pointer"
                          />
                          <span className={isChecked ? "font-medium text-maroon" : ""}>
                            {opt.label}
                          </span>
                        </div>
                        <span className="text-charcoal/40 text-[11px]">
                          ({opt.count})
                        </span>
                      </label>
                    );
                  })}
                </div>
              )}
            </div>

            {/* Accordion 3: Price */}
            <div className="border-b border-border/70 pb-4">
              <button
                onClick={() => setPriceExpanded(!priceExpanded)}
                className="w-full flex items-center justify-between py-2 text-sm font-sans font-medium text-charcoal hover:text-maroon transition-colors cursor-pointer"
                aria-expanded={priceExpanded}
              >
                <span>Price</span>
                <span className="text-charcoal/40 text-xs font-mono">
                  {priceExpanded ? "▲" : "▼"}
                </span>
              </button>
              {priceExpanded && (
                <div className="space-y-2.5 pt-2">
                  {PRICE_OPTIONS.map((opt) => {
                    const isChecked = selectedPrices.includes(opt.id);
                    return (
                      <label
                        key={opt.id}
                        className="flex items-center gap-2.5 text-xs font-sans text-charcoal/80 hover:text-charcoal cursor-pointer"
                      >
                        <input
                          type="checkbox"
                          checked={isChecked}
                          onChange={() => togglePrice(opt.id)}
                          className="rounded-xs border-border text-maroon focus:ring-maroon cursor-pointer"
                        />
                        <span className={isChecked ? "font-medium text-maroon" : ""}>
                          {opt.label}
                        </span>
                      </label>
                    );
                  })}
                </div>
              )}
            </div>

            {/* Clear All Button */}
            <Button
              variant="ghost"
              className="w-full !border !border-border !py-2 !text-xs"
              onClick={clearAllFilters}
            >
              Clear All
            </Button>
          </aside>

          {/* ════════════════════════════════════════════════════
              3. MAIN CONTENT COLUMN
             ════════════════════════════════════════════════════ */}
          <main className="flex-1 w-full min-w-0">
            {/* Top Controls Row */}
            <div className="hidden lg:flex items-center justify-between pb-4 mb-6 border-b border-border/80">
              <div className="flex items-center gap-4">
                {/* Result count */}
                <p className="text-xs font-sans font-medium text-charcoal/70">
                  {viewMode === "collections" && selectedCollection === "all"
                    ? `${COLLECTIONS.length} Collections (22 Products)`
                    : `${sortedProducts.length} Products`}
                </p>

                {/* Mode toggle button */}
                {variant === "category" && (
                  <div className="flex bg-sand/50 rounded-full p-0.5 border border-border text-xs">
                    <button
                      onClick={() => setViewMode("collections")}
                      className={`px-3 py-1 rounded-full font-medium transition-colors cursor-pointer ${
                        viewMode === "collections"
                          ? "bg-white text-maroon shadow-xs"
                          : "text-charcoal/60 hover:text-charcoal"
                      }`}
                    >
                      Collections View
                    </button>
                    <button
                      onClick={() => setViewMode("products")}
                      className={`px-3 py-1 rounded-full font-medium transition-colors cursor-pointer ${
                        viewMode === "products"
                          ? "bg-white text-maroon shadow-xs"
                          : "text-charcoal/60 hover:text-charcoal"
                      }`}
                    >
                      All Products ({sortedProducts.length})
                    </button>
                  </div>
                )}
              </div>

              {/* Sort By Dropdown */}
              <div className="flex items-center gap-2">
                <span className="text-xs font-sans text-charcoal/60">Sort by:</span>
                <select
                  value={sortBy}
                  onChange={(e) => setSortBy(e.target.value)}
                  aria-label="Sort items"
                  className="bg-sand/50 border border-border rounded-md px-3 py-1.5 text-xs font-sans text-charcoal focus:outline-none focus:border-maroon cursor-pointer"
                >
                  {SORT_OPTIONS.map((opt) => (
                    <option key={opt.id} value={opt.id}>
                      {opt.label}
                    </option>
                  ))}
                </select>
              </div>
            </div>

            {/* ── Mode A: Collections Card Grid (Matches Mockup) ── */}
            {viewMode === "collections" && selectedCollection === "all" ? (
              <div className="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
                {COLLECTIONS.map((c) => (
                  <div
                    key={c.id}
                    className="bg-white rounded-lg sm:rounded-xl border border-border/60 overflow-hidden shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between"
                  >
                    <div className="relative overflow-hidden bg-sand/30">
                      <ArchFrame variant="tall" className="!max-w-none !aspect-[4/5]">
                        <div className="w-full h-full relative flex flex-col items-center justify-end p-3 sm:p-6 text-center overflow-hidden">
                          {c.image && (
                            <img
                              src={c.image}
                              alt={c.name}
                              className="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                            />
                          )}
                          <div className="absolute inset-0 bg-gradient-to-t from-charcoal/80 via-charcoal/20 to-transparent" />
                          <div className="relative z-10 text-white">
                            <span className="font-serif text-base sm:text-2xl text-ivory font-medium block mb-0.5 sm:mb-1">
                              {c.name}
                            </span>
                            <span className="text-[10px] sm:text-xs font-sans text-gold-light font-medium uppercase tracking-wider">
                              {c.productCount} Products
                            </span>
                          </div>
                        </div>
                      </ArchFrame>
                      {c.badge && (
                        <div className="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 scale-90 sm:scale-100 origin-top-left">
                          <span className="px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full text-[10px] sm:text-xs font-sans font-medium uppercase tracking-wider bg-gold-light text-[#6B5A2F] border border-gold/20">
                            {c.badgeLabel}
                          </span>
                        </div>
                      )}
                    </div>

                    <div className="p-3 sm:p-5 text-center space-y-2 sm:space-y-3 flex-1 flex flex-col justify-between">
                      <div className="space-y-1">
                        <h3 className="font-serif text-sm sm:text-xl text-charcoal">{c.name}</h3>
                        <p className="text-[11px] sm:text-xs text-charcoal/60 leading-relaxed line-clamp-2 hidden sm:block">
                          {c.description}
                        </p>
                      </div>

                      <Button
                        variant="secondary"
                        className="w-full !text-[10px] sm:!text-xs !py-1.5 sm:!py-2.5"
                        onClick={() => {
                          setSelectedCollection(c.slug);
                          setViewMode("products");
                        }}
                      >
                        Explore →
                      </Button>
                    </div>
                  </div>
                ))}
              </div>
            ) : sortedProducts.length === 0 ? (
              /* ── Empty State ── */
              <div className="py-20 text-center flex flex-col items-center justify-center bg-sand/20 rounded-xl border border-dashed border-border p-8">
                <div className="mb-6 opacity-40">
                  <ArchFrame variant="tall" className="!max-w-[100px] mx-auto" />
                </div>
                <h3 className="font-serif text-2xl text-charcoal mb-2">
                  No products match these filters
                </h3>
                <p className="text-sm text-charcoal/60 max-w-sm mb-6">
                  Try clearing some filters or switching categories to explore our botanical catalogue.
                </p>
                <Button variant="primary" onClick={clearAllFilters}>
                  Clear Filters
                </Button>
              </div>
            ) : (
              /* ── Mode B: Product Cards Grid ── */
              <div className="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
                {paginatedProducts.map((product) => (
                  <ProductCard
                    key={product.id}
                    id={product.id}
                    name={product.name}
                    subtitle={product.subtitle}
                    category={product.collection}
                    price={product.price}
                    compareAt={product.compareAt}
                    rating={product.rating}
                    reviewCount={product.reviewCount}
                    badge={product.badge}
                    badgeLabel={product.badgeLabel}
                    cardType="product"
                    imageAspect="4:5"
                    onAddToCart={openCart}
                  />
                ))}
              </div>
            )}

            {/* Pagination Row */}
            {viewMode === "products" && totalPages > 1 && (
              <div className="flex items-center justify-center gap-2 mt-12 pt-8 border-t border-border">
                {/* Prev */}
                <button
                  onClick={() => setCurrentPage((prev) => Math.max(prev - 1, 1))}
                  disabled={currentPage === 1}
                  className="p-2 rounded-full border border-border text-charcoal/60 hover:text-maroon hover:border-maroon disabled:opacity-30 disabled:cursor-not-allowed transition-colors cursor-pointer"
                  aria-label="Previous page"
                >
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                    <path d="M15 18l-6-6 6-6" />
                  </svg>
                </button>

                {/* Page numbers */}
                {Array.from({ length: totalPages }).map((_, i) => {
                  const pNum = i + 1;
                  const isActive = currentPage === pNum;
                  return (
                    <button
                      key={pNum}
                      onClick={() => setCurrentPage(pNum)}
                      className={`
                        w-9 h-9 rounded-full text-xs font-sans font-medium transition-all cursor-pointer
                        ${
                          isActive
                            ? "bg-maroon text-ivory shadow-xs"
                            : "text-charcoal/70 hover:bg-sand border border-transparent hover:border-border"
                        }
                      `}
                    >
                      {pNum}
                    </button>
                  );
                })}

                {/* Next */}
                <button
                  onClick={() => setCurrentPage((prev) => Math.min(prev + 1, totalPages))}
                  disabled={currentPage === totalPages}
                  className="p-2 rounded-full border border-border text-charcoal/60 hover:text-maroon hover:border-maroon disabled:opacity-30 disabled:cursor-not-allowed transition-colors cursor-pointer"
                  aria-label="Next page"
                >
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                    <path d="M9 18l6-6-6-6" />
                  </svg>
                </button>
              </div>
            )}
          </main>
        </div>
      </div>

      {/* ════════════════════════════════════════════════════════
          4. BOTTOM TRUST STRIP (Mockup Match)
         ════════════════════════════════════════════════════════ */}
      <section className="bg-sand/40 border-t border-border mt-12">
        <div className="henley-container py-10 lg:py-14">
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:divide-x lg:divide-border/80">
            {[
              {
                title: "100% Organic",
                sub: "Pure ingredients, naturally sourced",
                icon: (
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
                    <path d="M5 19c2.8-3.5 6-6.1 12-8" />
                  </svg>
                ),
              },
              {
                title: "Single Origin Terroir",
                sub: "Cultivated in mountain micro-climates",
                icon: (
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round">
                    <path d="M18 8h1a4 4 0 010 8h-1" />
                    <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z" />
                    <line x1="6" y1="1" x2="6" y2="4" />
                  </svg>
                ),
              },
              {
                title: "Sustainably Sourced",
                sub: "Ethically grown for a better tomorrow",
                icon: (
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 2a14.5 14.5 0 000 20 14.5 14.5 0 000-20" />
                  </svg>
                ),
              },
              {
                title: "Small Batch Blends",
                sub: "Stoneground & hand packed for freshness",
                icon: (
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round">
                    <path d="M6 10h12l-1.5 9h-9L6 10z" />
                    <path d="M12 3v7" />
                  </svg>
                ),
              },
            ].map((item, idx) => (
              <div
                key={item.title}
                className={`flex flex-col items-center text-center space-y-2 ${
                  idx > 0 ? "lg:pl-8" : ""
                }`}
              >
                <div className="w-10 h-10 rounded-full bg-sand border border-border flex items-center justify-center text-gold">
                  {item.icon}
                </div>
                <h3 className="font-sans font-medium text-xs text-charcoal">
                  {item.title}
                </h3>
                <p className="text-[11px] text-charcoal/50 max-w-[200px]">
                  {item.sub}
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          5. MOBILE FILTER SHEET MODAL
         ════════════════════════════════════════════════════════ */}
      {isMobileFiltersOpen && (
        <div className="fixed inset-0 z-[60] lg:hidden">
          <div
            className="absolute inset-0 bg-charcoal/40"
            onClick={() => setIsMobileFiltersOpen(false)}
          />

          <div className="absolute inset-x-0 bottom-0 max-h-[85vh] bg-ivory rounded-t-2xl shadow-card-hover overflow-y-auto flex flex-col animate-slide-in-up">
            <div className="sticky top-0 bg-ivory flex items-center justify-between p-5 border-b border-border z-10">
              <h2 className="font-serif text-lg text-charcoal">Filters</h2>
              <button
                onClick={() => setIsMobileFiltersOpen(false)}
                className="p-1.5 text-charcoal/60 hover:text-charcoal cursor-pointer"
                aria-label="Close filters"
              >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                  <path d="M18 6L6 18M6 6l12 12" />
                </svg>
              </button>
            </div>

            <div className="p-6 space-y-6 flex-1">
              {/* Collection */}
              <div className="space-y-3">
                <h3 className="font-sans font-semibold text-xs tracking-wider uppercase text-charcoal">
                  Collection
                </h3>
                <div className="grid grid-cols-2 gap-2">
                  {COLLECTIONS.map((c) => {
                    const isChecked =
                      selectedCollectionsFilter.includes(c.slug) ||
                      selectedCollection === c.slug;
                    return (
                      <label
                        key={c.id}
                        className={`
                          flex items-center justify-between p-3 rounded-lg border text-xs font-sans cursor-pointer transition-colors
                          ${
                            isChecked
                              ? "bg-sand border-maroon text-maroon font-medium"
                              : "bg-white border-border text-charcoal/80"
                          }
                        `}
                      >
                        <span>{c.name}</span>
                        <span className="text-[10px] opacity-60">({c.productCount})</span>
                      </label>
                    );
                  })}
                </div>
              </div>

              {/* Benefit */}
              <div className="space-y-3">
                <h3 className="font-sans font-semibold text-xs tracking-wider uppercase text-charcoal">
                  Benefit
                </h3>
                <div className="grid grid-cols-2 gap-2">
                  {BENEFIT_OPTIONS.map((opt) => {
                    const isChecked = selectedBenefits.includes(opt.id);
                    return (
                      <label
                        key={opt.id}
                        className={`
                          flex items-center justify-between p-3 rounded-lg border text-xs font-sans cursor-pointer transition-colors
                          ${
                            isChecked
                              ? "bg-sand border-maroon text-maroon font-medium"
                              : "bg-white border-border text-charcoal/80"
                          }
                        `}
                      >
                        <span>{opt.label}</span>
                        <span className="text-[10px] opacity-60">({opt.count})</span>
                      </label>
                    );
                  })}
                </div>
              </div>

              {/* Price */}
              <div className="space-y-3">
                <h3 className="font-sans font-semibold text-xs tracking-wider uppercase text-charcoal">
                  Price
                </h3>
                <div className="space-y-2">
                  {PRICE_OPTIONS.map((opt) => {
                    const isChecked = selectedPrices.includes(opt.id);
                    return (
                      <label
                        key={opt.id}
                        className={`
                          flex items-center justify-between p-3 rounded-lg border text-xs font-sans cursor-pointer transition-colors
                          ${
                            isChecked
                              ? "bg-sand border-maroon text-maroon font-medium"
                              : "bg-white border-border text-charcoal/80"
                          }
                        `}
                      >
                        <span>{opt.label}</span>
                        <input
                          type="checkbox"
                          checked={isChecked}
                          onChange={() => togglePrice(opt.id)}
                          className="text-maroon focus:ring-maroon rounded-xs"
                        />
                      </label>
                    );
                  })}
                </div>
              </div>
            </div>

            <div className="sticky bottom-0 bg-ivory p-4 border-t border-border flex gap-3">
              <Button
                variant="secondary"
                className="flex-1 !py-3"
                onClick={clearAllFilters}
              >
                Clear All
              </Button>
              <Button
                variant="primary"
                className="flex-1 !py-3"
                onClick={() => setIsMobileFiltersOpen(false)}
              >
                Show {sortedProducts.length} Results
              </Button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
