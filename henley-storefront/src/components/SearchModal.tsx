"use client";

import React, { useState, useEffect, useRef, useMemo } from "react";
import { useRouter } from "next/navigation";
import { PRODUCTS, COLLECTIONS } from "@/data/catalog";

interface SearchModalProps {
  isOpen: boolean;
  onClose: () => void;
}

const POPULAR_SEARCHES = [
  "First Flush Darjeeling",
  "Kashmir Mogra Saffron",
  "Silver Needle White Tea",
  "Malabar Green Cardamom",
  "Porcelain Cloche Gift Set",
];

export default function SearchModal({ isOpen, onClose }: SearchModalProps) {
  const [query, setQuery] = useState("");
  const inputRef = useRef<HTMLInputElement>(null);
  const router = useRouter();

  // Focus input when opened
  useEffect(() => {
    if (isOpen) {
      const timer = setTimeout(() => {
        inputRef.current?.focus();
      }, 100);
      return () => clearTimeout(timer);
    } else {
      setQuery("");
    }
  }, [isOpen]);

  // Handle ESC key
  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if (e.key === "Escape" && isOpen) {
        onClose();
      }
    };
    window.addEventListener("keydown", handleKeyDown);
    return () => window.removeEventListener("keydown", handleKeyDown);
  }, [isOpen, onClose]);

  // Filter products
  const matchingProducts = useMemo(() => {
    const q = query.trim().toLowerCase();
    if (q.length < 2) return [];

    return PRODUCTS.filter((p) => {
      return (
        p.name.toLowerCase().includes(q) ||
        p.subtitle.toLowerCase().includes(q) ||
        p.collection.toLowerCase().includes(q) ||
        p.description.toLowerCase().includes(q)
      );
    }).slice(0, 6);
  }, [query]);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (query.trim()) {
      onClose();
      router.push(`/search?q=${encodeURIComponent(query.trim())}`);
    }
  };

  if (!isOpen) return null;

  return (
    <div
      className="fixed inset-0 z-50 overflow-y-auto bg-charcoal/60 backdrop-blur-md p-3 sm:p-6 lg:p-8 animate-fadeIn"
      role="dialog"
      aria-modal="true"
      aria-label="Catalogue Live Search"
      onClick={onClose}
    >
      <div
        className="mx-auto max-w-2xl pt-4 sm:pt-14 pb-8"
        onClick={(e) => e.stopPropagation()}
      >
        <div className="overflow-hidden rounded-2xl border border-border bg-white shadow-2xl transition-all">
          {/* Search Header Bar */}
          <form
            onSubmit={handleSubmit}
            className="relative flex items-center border-b border-border px-4 sm:px-6 py-3.5 sm:py-4 bg-sand/30"
          >
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
              strokeLinecap="round"
              strokeLinejoin="round"
              className="text-maroon mr-3 flex-shrink-0"
            >
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>

            <input
              ref={inputRef}
              type="text"
              inputMode="search"
              autoCapitalize="none"
              autoCorrect="off"
              spellCheck={false}
              value={query}
              onChange={(e) => setQuery(e.target.value)}
              placeholder="Search rare teas, single-origin spices, grains..."
              aria-label="Search catalogue"
              className="w-full bg-transparent text-sm sm:text-base font-sans text-charcoal placeholder:text-charcoal/45 focus:outline-none [&::-webkit-search-cancel-button]:appearance-none"
            />

            {query && (
              <button
                type="button"
                onClick={() => setQuery("")}
                className="p-1 text-charcoal/40 hover:text-charcoal mr-2 cursor-pointer"
                aria-label="Clear search"
              >
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                  <line x1="18" y1="6" x2="6" y2="18" />
                  <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
              </button>
            )}

            <button
              type="button"
              onClick={onClose}
              aria-label="Close search overlay"
              className="rounded-full p-1.5 text-charcoal/50 hover:bg-sand hover:text-maroon transition cursor-pointer flex-shrink-0"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
              </svg>
            </button>
          </form>

          {/* Search Body Content */}
          <div className="max-h-[62vh] overflow-y-auto p-4 sm:p-6 space-y-6">
            {query.trim().length >= 2 ? (
              <div>
                <div className="flex items-center justify-between pb-3 border-b border-border/60 mb-4">
                  <span className="text-[11px] font-sans text-charcoal/60 uppercase tracking-widest font-semibold">
                    Search Results ({matchingProducts.length})
                  </span>
                  <span className="text-[10px] font-sans text-charcoal/40">
                    Instant harvest matches
                  </span>
                </div>

                {matchingProducts.length > 0 ? (
                  <div className="space-y-4">
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      {matchingProducts.map((product) => (
                        <a
                          key={product.id}
                          href={product.id ? `/product/${product.id}` : `/collections?cat=${product.collectionSlug}`}
                          onClick={onClose}
                          className="flex items-center gap-3 p-2.5 rounded-xl border border-border/70 bg-sand/20 hover:border-maroon/50 hover:bg-sand/40 transition-all group cursor-pointer"
                        >
                          <div className="h-14 w-14 flex-shrink-0 overflow-hidden rounded-lg bg-sand/60 border border-border/50">
                            <img
                              src={product.image || "/pimages/tea.jpg"}
                              alt={product.name}
                              className="h-full w-full object-cover group-hover:scale-105 transition-transform"
                            />
                          </div>

                          <div className="flex-1 min-w-0">
                            <h4 className="font-serif text-xs sm:text-sm font-semibold text-charcoal group-hover:text-maroon truncate transition-colors">
                              {product.name}
                            </h4>
                            <p className="text-[11px] font-sans text-charcoal/50 truncate mt-0.5">
                              {product.subtitle || product.collection}
                            </p>
                            <div className="mt-1 flex items-center justify-between">
                              <span className="text-xs font-sans font-semibold text-maroon">
                                {product.price}
                              </span>
                              <span className="text-[10px] font-sans text-charcoal/40">
                                View →
                              </span>
                            </div>
                          </div>
                        </a>
                      ))}
                    </div>

                    <div className="pt-2 text-center">
                      <button
                        type="button"
                        onClick={handleSubmit}
                        className="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-maroon text-ivory text-xs font-sans font-semibold hover:bg-maroon/90 transition-colors cursor-pointer shadow-xs"
                      >
                        <span>View All Results for &ldquo;{query}&rdquo;</span>
                        <span>→</span>
                      </button>
                    </div>
                  </div>
                ) : (
                  <div className="text-center py-8 space-y-2">
                    <p className="font-serif text-base text-charcoal">
                      No harvests found matching &ldquo;{query}&rdquo;
                    </p>
                    <p className="text-xs font-sans text-charcoal/50 max-w-sm mx-auto">
                      Try searching by aroma, estate origin, or botanical key like
                      <button
                        type="button"
                        onClick={() => setQuery("tea")}
                        className="text-maroon font-medium underline ml-1 cursor-pointer"
                      >
                        tea
                      </button>
                      ,
                      <button
                        type="button"
                        onClick={() => setQuery("saffron")}
                        className="text-maroon font-medium underline ml-1 cursor-pointer"
                      >
                        saffron
                      </button>
                      , or
                      <button
                        type="button"
                        onClick={() => setQuery("cardamom")}
                        className="text-maroon font-medium underline ml-1 cursor-pointer"
                      >
                        cardamom
                      </button>
                      .
                    </p>
                  </div>
                )}
              </div>
            ) : (
              /* Pre-query curation guide */
              <div className="space-y-6">
                <div>
                  <h4 className="text-[11px] font-sans text-charcoal/60 uppercase tracking-widest font-semibold mb-3">
                    Popular Curations
                  </h4>
                  <div className="flex flex-wrap gap-2">
                    {POPULAR_SEARCHES.map((term) => (
                      <button
                        key={term}
                        type="button"
                        onClick={() => setQuery(term)}
                        className="px-3 py-1.5 rounded-full bg-sand/50 border border-border/80 text-xs font-sans text-charcoal/70 hover:border-maroon hover:text-maroon hover:bg-sand transition cursor-pointer"
                      >
                        {term}
                      </button>
                    ))}
                  </div>
                </div>

                <div>
                  <h4 className="text-[11px] font-sans text-charcoal/60 uppercase tracking-widest font-semibold mb-3">
                    Explore by Terroir
                  </h4>
                  <div className="grid grid-cols-2 gap-2.5">
                    {COLLECTIONS.map((c) => (
                      <a
                        key={c.id}
                        href={`/collections?cat=${c.slug}`}
                        onClick={onClose}
                        className="p-3 rounded-xl border border-border/70 bg-sand/30 hover:border-maroon/50 hover:bg-sand/60 transition group cursor-pointer block"
                      >
                        <h5 className="font-serif text-xs font-semibold text-charcoal group-hover:text-maroon transition-colors">
                          {c.name}
                        </h5>
                        <p className="text-[10px] font-sans text-charcoal/50 uppercase tracking-wider mt-0.5">
                          {c.productCount} {c.productCount === 1 ? "Harvest" : "Harvests"} →
                        </p>
                      </a>
                    ))}
                  </div>
                </div>
              </div>
            )}
          </div>

          {/* Footer Bar */}
          <div className="flex items-center justify-between border-t border-border/60 bg-sand/20 px-4 sm:px-6 py-2.5 text-[10px] font-sans text-charcoal/50">
            <span>
              Press <kbd className="px-1.5 py-0.5 bg-white border border-border rounded text-[9px] font-mono">ESC</kbd> to close
            </span>
            <span className="hidden sm:inline">Direct-to-estate verified catalogue</span>
          </div>
        </div>
      </div>
    </div>
  );
}
