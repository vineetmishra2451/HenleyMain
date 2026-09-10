"use client";

import React, { useState } from "react";
import Logo from "./Logo";
import { useCart } from "./CartProvider";
import { COLLECTIONS, PRODUCTS } from "@/data/catalog";

/* ================================================================
   HEADER / NAV
   ================================================================
   - Row 1: Dismissible announcement bar (gold on maroon)
   - Row 2: Symmetrical Split Nav:
     [Left Nav Links] <--- [HENLEY Logo Center] ---> [Right Nav Links + Icons]
   - Mobile: Hamburger slide-in from left, Logo centered, icons right
   ================================================================ */

interface NavLink {
  label: string;
  href: string;
  active?: boolean;
}

const LEFT_NAV_LINKS: NavLink[] = [
  { label: "SHOP", href: "/shop" },
  { label: "COLLECTIONS", href: "/collections", active: true },
  { label: "TEA", href: "/collections?cat=tea" },
  { label: "HERBS & SPICES", href: "/collections?cat=herbs-spices" },
];

const RIGHT_NAV_LINKS: NavLink[] = [
  { label: "GRAINS", href: "/collections?cat=flours-grains" },
  { label: "ESSENTIALS", href: "/collections?cat=cooking-essentials" },
  { label: "COCOA", href: "/collections?cat=cocoa" },
  { label: "STORY", href: "/story" },
];

const ALL_NAV_LINKS: NavLink[] = [...LEFT_NAV_LINKS, ...RIGHT_NAV_LINKS];

interface HeaderProps {
  activePath?: string;
}

export default function Header({ activePath }: HeaderProps = {}) {
  const [announcementVisible, setAnnouncementVisible] = useState(true);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [activeCategorySlug, setActiveCategorySlug] = useState<string | null>(null);
  const [searchOpen, setSearchOpen] = useState(false);
  const { open: openCart, itemCount } = useCart();

  return (
    <>
      <header className="sticky top-0 z-50 bg-ivory">
        {/* ── Announcement Bar ──────────────────────────────── */}
        {announcementVisible && (
          <div className="relative bg-maroon text-center py-2.5 px-12">
            <p className="text-gold text-xs font-sans font-medium tracking-[0.08em]">
              Complimentary shipping on orders over ₹1,999
            </p>
            <button
              onClick={() => setAnnouncementVisible(false)}
              className="absolute right-4 top-1/2 -translate-y-1/2 text-ivory/60 hover:text-ivory transition-colors cursor-pointer"
              aria-label="Dismiss announcement"
            >
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                <path d="M18 6L6 18M6 6l12 12" />
              </svg>
            </button>
          </div>
        )}

        {/* ── Symmetrical Split Nav Row ──────────────────────── */}
        <nav className="border-b border-border bg-ivory" aria-label="Main navigation">
          <div className="henley-container relative flex items-center justify-between h-16 lg:h-[72px]">

            {/* Left Nav (Desktop) / Hamburger (Mobile) */}
            <div className="flex items-center gap-1 lg:flex-1">
              {/* Hamburger — mobile only */}
              <button
                className="lg:hidden p-2 -ml-2 text-charcoal hover:text-maroon transition-colors cursor-pointer"
                onClick={() => setMobileMenuOpen(true)}
                aria-label="Open menu"
              >
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round">
                  <path d="M3 7h18M3 12h18M3 17h18" />
                </svg>
              </button>

              {/* Desktop Left Nav Links */}
              <div className="hidden lg:flex items-center gap-1 xl:gap-2">
                {LEFT_NAV_LINKS.map((link) => (
                  <a
                    key={link.label}
                    href={link.href}
                    className={`
                      px-2 xl:px-3 py-2 text-[11px] xl:text-xs font-sans font-medium tracking-[0.08em] uppercase
                      transition-colors whitespace-nowrap
                      ${link.active
                        ? "text-maroon border-b-2 border-maroon"
                        : "text-charcoal hover:text-maroon"
                      }
                    `}
                  >
                    {link.label}
                  </a>
                ))}
              </div>
            </div>

            {/* Center: Henley Logo - strictly centered on mobile and symmetrical on desktop */}
            <div className="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 lg:static lg:left-auto lg:top-auto lg:translate-x-0 lg:translate-y-0 flex items-center justify-center px-2 flex-shrink-0 z-10 pointer-events-auto">
              <a href="/" aria-label="Henley Home" className="flex items-center justify-center">
                <Logo size="md" />
              </a>
            </div>

            {/* Right Nav Links + Action Icons */}
            <div className="flex items-center justify-end gap-1 xl:gap-2 lg:flex-1">
              {/* Desktop Right Nav Links */}
              <div className="hidden lg:flex items-center gap-1 xl:gap-2 mr-2">
                {RIGHT_NAV_LINKS.map((link) => (
                  <a
                    key={link.label}
                    href={link.href}
                    className="px-2 xl:px-3 py-2 text-[11px] xl:text-xs font-sans font-medium tracking-[0.08em] uppercase text-charcoal hover:text-maroon transition-colors whitespace-nowrap"
                  >
                    {link.label}
                  </a>
                ))}
              </div>

              {/* Search */}
              <div className="relative">
                {searchOpen ? (
                  <div className="flex items-center gap-2">
                    <input
                      type="search"
                      placeholder="Search..."
                      autoFocus
                      className="
                        w-36 lg:w-48 h-9 px-3 text-sm font-sans
                        bg-sand border border-border rounded-full
                        text-charcoal placeholder:text-charcoal/40
                        focus:outline-none focus:border-maroon
                        transition-all
                      "
                    />
                    <button
                      onClick={() => setSearchOpen(false)}
                      className="p-1.5 text-charcoal/60 hover:text-charcoal cursor-pointer"
                      aria-label="Close search"
                    >
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                        <path d="M18 6L6 18M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                ) : (
                  <button
                    onClick={() => setSearchOpen(true)}
                    className="p-2 text-charcoal hover:text-maroon transition-colors cursor-pointer"
                    aria-label="Search"
                  >
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                      <circle cx="11" cy="11" r="8" />
                      <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                  </button>
                )}
              </div>

              {/* Account (with dropdown preview) */}
              <div className="relative group">
                <a
                  href="/account"
                  className="p-2 text-charcoal hover:text-maroon transition-colors flex items-center"
                  aria-label="Account"
                >
                  <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                  </svg>
                </a>
                {/* Account dropdown */}
                <div className="
                  absolute right-0 top-full pt-2 w-48
                  opacity-0 translate-y-1 pointer-events-none
                  group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto
                  transition-all duration-200 z-50
                ">
                  <div className="bg-white rounded-lg shadow-card border border-border/80 py-2">
                    <a href="/login" className="block px-4 py-2 text-xs font-sans text-charcoal hover:bg-sand/60 hover:text-maroon transition-colors">
                      Sign In
                    </a>
                    <a href="/register" className="block px-4 py-2 text-xs font-sans text-charcoal hover:bg-sand/60 hover:text-maroon transition-colors">
                      Create Account
                    </a>
                    <div className="border-t border-border/50 my-1" />
                    <a href="/track-order" className="block px-4 py-2 text-xs font-sans text-charcoal/70 hover:bg-sand/60 hover:text-maroon transition-colors">
                      Order Tracking
                    </a>
                  </div>
                </div>
              </div>

              {/* Cart Drawer Trigger */}
              <button
                onClick={openCart}
                className="relative p-2 text-charcoal hover:text-maroon transition-colors cursor-pointer"
                aria-label={`Shopping cart with ${itemCount} items`}
              >
                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                  <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                  <line x1="3" y1="6" x2="21" y2="6" />
                  <path d="M16 10a4 4 0 01-8 0" />
                </svg>
                {itemCount > 0 && (
                  <span className="
                    absolute top-0.5 right-0.5
                    w-4 h-4 rounded-full
                    bg-maroon text-ivory
                    text-[10px] font-sans font-semibold
                    flex items-center justify-center
                    leading-none
                  ">
                    {itemCount}
                  </span>
                )}
              </button>
            </div>
          </div>
        </nav>
      </header>

      {/* ── Mobile Drawer (Interactive & Detailed) ─────────── */}
      {mobileMenuOpen && (
        <div className="fixed inset-0 z-50 lg:hidden">
          {/* Backdrop */}
          <div
            className="absolute inset-0 z-0 bg-charcoal/50 backdrop-blur-xs transition-opacity"
            onClick={() => setMobileMenuOpen(false)}
          />

          {/* Drawer panel */}
          <div
            onClick={(e) => e.stopPropagation()}
            className="
            relative z-10 w-[88vw] max-w-sm sm:max-w-md h-full bg-ivory shadow-2xl
            flex flex-col justify-between overflow-y-auto pointer-events-auto
            animate-slide-in-left
          ">
            <div>
              {/* Drawer Header */}
              <div className="flex items-center justify-between p-5 border-b border-border bg-sand/20">
                <a href="/" onClick={() => setMobileMenuOpen(false)} className="flex items-center">
                  <Logo size="sm" />
                </a>
                <button
                  onClick={() => setMobileMenuOpen(false)}
                  className="p-2 -mr-1 text-charcoal/60 hover:text-charcoal transition-colors cursor-pointer rounded-full"
                  aria-label="Close menu"
                >
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                    <path d="M18 6L6 18M6 6l12 12" />
                  </svg>
                </button>
              </div>

              {/* Quick Search Bar */}
              <div className="px-5 pt-3 pb-2">
                <button
                  type="button"
                  onClick={() => {
                    setMobileMenuOpen(false);
                    setSearchOpen(true);
                  }}
                  className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-full bg-sand/60 border border-border/80 text-charcoal/60 text-xs font-sans hover:border-maroon hover:text-charcoal transition-colors text-left cursor-pointer"
                >
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="text-charcoal/50 flex-shrink-0">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                  </svg>
                  <span className="truncate">Search rare teas, single-origin spices...</span>
                </button>
              </div>

              {/* ── Primary Storefront Navigation Links ── */}
              <div className="px-5 pt-1 pb-2">
                <div className="grid grid-cols-2 gap-2">
                  <a
                    href="/shop"
                    onClick={() => setMobileMenuOpen(false)}
                    className="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-white border border-border/80 text-xs font-sans font-semibold text-charcoal hover:border-maroon hover:text-maroon transition-all shadow-2xs group"
                  >
                    <span className="flex items-center gap-2">
                      <span className="text-maroon">✦</span>
                      <span>Shop All</span>
                    </span>
                    <span className="text-[11px] text-charcoal/40 group-hover:text-maroon group-hover:translate-x-0.5 transition-all">→</span>
                  </a>
                  <a
                    href="/collections"
                    onClick={() => setMobileMenuOpen(false)}
                    className="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-white border border-border/80 text-xs font-sans font-semibold text-charcoal hover:border-maroon hover:text-maroon transition-all shadow-2xs group"
                  >
                    <span className="flex items-center gap-2">
                      <span className="text-gold">❖</span>
                      <span>Collections</span>
                    </span>
                    <span className="text-[11px] text-charcoal/40 group-hover:text-maroon group-hover:translate-x-0.5 transition-all">→</span>
                  </a>
                </div>
              </div>

              {/* ── Sub-Sections: Curated Collections & Products ── */}
              <div className="px-5 py-3">
                <div className="flex items-center justify-between mb-2.5">
                  <p className="text-[10px] font-sans font-semibold uppercase tracking-[0.14em] text-charcoal/50">
                    Curated Collections
                  </p>
                  <a
                    href="/collections"
                    onClick={() => setMobileMenuOpen(false)}
                    className="text-[10px] font-sans font-semibold uppercase tracking-wider text-maroon hover:underline"
                  >
                    View All →
                  </a>
                </div>

                <div className="space-y-2">
                  {COLLECTIONS.map((cat) => {
                    const isExpanded = activeCategorySlug === cat.slug;
                    const catProducts = PRODUCTS.filter((p) => p.collectionSlug === cat.slug).slice(0, 3);

                    return (
                      <div
                        key={cat.id}
                        className={`border rounded-xl overflow-hidden bg-white/70 transition-all duration-200 ${
                          isExpanded ? "border-maroon/40 bg-white shadow-xs" : "border-border/70"
                        }`}
                      >
                        {/* Category Row: Direct Link + Expand Toggle */}
                        <div className="flex items-center justify-between p-2.5 hover:bg-sand/30 transition-colors">
                          <a
                            href={`/collections?cat=${cat.slug}`}
                            onClick={() => setMobileMenuOpen(false)}
                            className="flex items-center gap-3 min-w-0 flex-1 cursor-pointer group"
                          >
                            <img
                              src={cat.image || "/pimages/cardamom.jpg"}
                              alt={cat.name}
                              className="w-10 h-10 rounded-lg object-cover border border-border/50 flex-shrink-0 group-hover:scale-105 transition-transform"
                              loading="lazy"
                            />
                            <div className="truncate">
                              <span className="block text-xs font-serif font-semibold text-charcoal group-hover:text-maroon tracking-wide truncate">
                                {cat.name}
                              </span>
                              <span className="block text-[10px] font-sans text-charcoal/50 group-hover:text-maroon/70">
                                {cat.productCount} {cat.productCount === 1 ? "Harvest" : "Harvests"} • View →
                              </span>
                            </div>
                          </a>

                          <button
                            type="button"
                            onClick={(e) => {
                              e.stopPropagation();
                              setActiveCategorySlug(isExpanded ? null : cat.slug);
                            }}
                            className="p-2 text-charcoal/50 hover:text-maroon transition-colors cursor-pointer rounded-lg hover:bg-sand/50 ml-1"
                            aria-label={`Toggle preview for ${cat.name}`}
                          >
                            <svg
                              width="15"
                              height="15"
                              viewBox="0 0 24 24"
                              fill="none"
                              stroke="currentColor"
                              strokeWidth="2"
                              strokeLinecap="round"
                              strokeLinejoin="round"
                              className={`transition-transform duration-200 ${isExpanded ? "rotate-180 text-maroon" : ""}`}
                            >
                              <path d="M6 9l6 6 6-6" />
                            </svg>
                          </button>
                        </div>

                        {/* Nested Sub-Section: Top Products */}
                        {isExpanded && (
                          <div className="px-2.5 pb-2.5 pt-1 border-t border-border/40 bg-sand/20 space-y-1.5 animate-fadeIn">
                            <div className="grid grid-cols-1 gap-1.5 pt-1">
                              {catProducts.map((prod) => (
                                <a
                                  key={prod.id}
                                  href={`/collections?cat=${cat.slug}`}
                                  onClick={() => setMobileMenuOpen(false)}
                                  className="flex items-center justify-between p-2 rounded-lg bg-white border border-border/40 hover:border-maroon/40 transition-colors group"
                                >
                                  <div className="flex items-center gap-2.5 min-w-0">
                                    <img
                                      src={prod.image || "/pimages/tea.jpg"}
                                      alt={prod.name}
                                      className="w-9 h-9 rounded-md object-cover border border-border/40 flex-shrink-0"
                                      loading="lazy"
                                    />
                                    <div className="truncate">
                                      <span className="block text-[11px] font-sans font-medium text-charcoal group-hover:text-maroon truncate">
                                        {prod.name}
                                      </span>
                                      <span className="block text-[10px] font-sans text-charcoal/50">
                                        {prod.price}
                                      </span>
                                    </div>
                                  </div>
                                  <span className="text-[10px] font-sans text-maroon font-medium flex-shrink-0 pl-2">
                                    View →
                                  </span>
                                </a>
                              ))}
                            </div>

                            <a
                              href={`/collections?cat=${cat.slug}`}
                              onClick={() => setMobileMenuOpen(false)}
                              className="block text-center py-1.5 text-[11px] font-sans font-semibold text-maroon hover:underline tracking-wider uppercase"
                            >
                              Explore All {cat.name} ({cat.productCount}) →
                            </a>
                          </div>
                        )}
                      </div>
                    );
                  })}
                </div>
              </div>

              {/* ── Curator's Top Reserves Showcase with Images ── */}
              <div className="px-5 py-4 border-t border-border/60 bg-sand/25">
                <div className="flex items-center justify-between mb-2.5">
                  <div>
                    <p className="text-[10px] font-sans font-semibold uppercase tracking-[0.14em] text-gold">
                      Single-Estate Picks
                    </p>
                    <h4 className="font-serif text-sm font-medium text-charcoal">
                      Curator's Top Reserves
                    </h4>
                  </div>
                  <span className="text-[10px] font-sans text-charcoal/40">Swipe →</span>
                </div>

                <div className="flex gap-2.5 overflow-x-auto pb-2 scrollbar-none snap-x snap-mandatory">
                  {PRODUCTS.filter((p) => p.badge === "bestseller" || p.badge === "organic").slice(0, 4).map((topProd) => (
                    <a
                      key={topProd.id}
                      href={`/collections?cat=${topProd.collectionSlug}`}
                      onClick={() => setMobileMenuOpen(false)}
                      className="flex-shrink-0 w-36 bg-white rounded-xl border border-border/70 p-2 shadow-2xs hover:shadow-xs transition-shadow snap-start flex flex-col justify-between"
                    >
                      <div className="relative aspect-square rounded-lg overflow-hidden bg-sand/40 mb-2">
                        <img
                          src={topProd.image || "/pimages/tea.jpg"}
                          alt={topProd.name}
                          className="w-full h-full object-cover"
                          loading="lazy"
                        />
                        {topProd.badge && (
                          <span className="absolute top-1 left-1 px-1.5 py-0.5 rounded-full text-[8px] font-sans font-semibold uppercase tracking-wider bg-maroon text-ivory">
                            {topProd.badgeLabel || "Reserve"}
                          </span>
                        )}
                      </div>
                      <div>
                        <p className="text-[9px] font-sans text-charcoal/50 uppercase tracking-wider truncate">
                          {topProd.collection}
                        </p>
                        <h5 className="text-xs font-serif font-semibold text-charcoal truncate mt-0.5">
                          {topProd.name}
                        </h5>
                        <div className="flex items-center justify-between mt-1.5">
                          <span className="text-[11px] font-sans font-semibold text-maroon">
                            {topProd.price}
                          </span>
                          <span className="text-[10px] text-gold font-sans">
                            ★ {topProd.rating}
                          </span>
                        </div>
                      </div>
                    </a>
                  ))}
                </div>
              </div>

              {/* ── House of Henley Sub-Section ── */}
              <div className="px-5 py-4 border-t border-border/60 space-y-2">
                <p className="text-[10px] font-sans font-semibold uppercase tracking-[0.14em] text-charcoal/50">
                  The House of Henley
                </p>
                <div className="grid grid-cols-2 gap-2 pt-1">
                  <a
                    href="/story"
                    onClick={() => setMobileMenuOpen(false)}
                    className="flex items-center gap-2 p-2 rounded-lg bg-white border border-border/50 text-xs font-sans text-charcoal hover:border-maroon hover:text-maroon transition-colors"
                  >
                    <span className="text-sm">🏔️</span>
                    <span className="font-medium text-[11px]">Terroir Story</span>
                  </a>
                  <a
                    href="/journal"
                    onClick={() => setMobileMenuOpen(false)}
                    className="flex items-center gap-2 p-2 rounded-lg bg-white border border-border/50 text-xs font-sans text-charcoal hover:border-maroon hover:text-maroon transition-colors"
                  >
                    <span className="text-sm">📖</span>
                    <span className="font-medium text-[11px]">Journal</span>
                  </a>
                </div>
              </div>
            </div>

            {/* Drawer Footer */}
            <div className="p-5 border-t border-border bg-sand/40 space-y-3">
              <div className="flex items-center justify-between text-[11px] font-sans">
                <span className="text-charcoal/60">Concierge Desk:</span>
                <a href="tel:+91800436539" className="font-medium text-maroon hover:underline">
                  +91 800 436 539
                </a>
              </div>
              <p className="text-[10px] font-sans text-charcoal/50 text-center">
                Complimentary shipping on orders above ₹1,999
              </p>
              <a
                href="/login"
                onClick={() => setMobileMenuOpen(false)}
                className="block w-full py-2.5 text-center text-xs font-sans font-semibold uppercase tracking-wider bg-maroon text-ivory rounded-lg hover:bg-maroon/90 transition-colors shadow-xs"
              >
                Sign In / Create Account
              </a>
            </div>
          </div>
        </div>
      )}

      {/* ── Mobile Bottom Navigation Bar ───────────────────── */}
      <aside
        className="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-ivory/95 backdrop-blur-md border-t border-border/80 shadow-[0_-4px_20px_rgba(34,26,23,0.06)] pb-[max(0.35rem,env(safe-area-inset-bottom))]"
        aria-label="Mobile bottom navigation"
      >
        <div className="grid grid-cols-4 items-center justify-items-center h-14 px-2">
          {/* 1. Home */}
          <a
            href="/"
            className={`flex flex-col items-center justify-center w-full h-full text-center transition-colors group relative ${
              activePath === "/" ? "text-maroon" : "text-charcoal/60 hover:text-maroon"
            }`}
            aria-label="Home"
          >
            <div className="relative flex items-center justify-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={activePath === "/" ? "2.2" : "1.8"} strokeLinecap="round" strokeLinejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
              </svg>
            </div>
            <span className={`text-[10px] font-sans ${activePath === "/" ? "font-semibold" : "font-normal"} tracking-wide mt-0.5`}>
              Home
            </span>
            {activePath === "/" && (
              <span className="absolute bottom-1 w-1 h-1 rounded-full bg-gold"></span>
            )}
          </a>

          {/* 2. Collection */}
          <a
            href="/collections"
            className={`flex flex-col items-center justify-center w-full h-full text-center transition-colors group relative ${
              activePath?.startsWith("/collections") ? "text-maroon" : "text-charcoal/60 hover:text-maroon"
            }`}
            aria-label="Collection"
          >
            <div className="relative flex items-center justify-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={activePath?.startsWith("/collections") ? "2.2" : "1.8"} strokeLinecap="round" strokeLinejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1.5" />
                <rect x="14" y="3" width="7" height="7" rx="1.5" />
                <rect x="14" y="14" width="7" height="7" rx="1.5" />
                <rect x="3" y="14" width="7" height="7" rx="1.5" />
              </svg>
            </div>
            <span className={`text-[10px] font-sans ${activePath?.startsWith("/collections") ? "font-semibold" : "font-normal"} tracking-wide mt-0.5`}>
              Collection
            </span>
            {activePath?.startsWith("/collections") && (
              <span className="absolute bottom-1 w-1 h-1 rounded-full bg-gold"></span>
            )}
          </a>

          {/* 3. Cart */}
          <button
            type="button"
            onClick={openCart}
            className="flex flex-col items-center justify-center w-full h-full text-center transition-colors group relative text-charcoal/60 hover:text-maroon cursor-pointer"
            aria-label={`Cart (${itemCount} items)`}
          >
            <div className="relative flex items-center justify-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                <line x1="3" y1="6" x2="21" y2="6" />
                <path d="M16 10a4 4 0 01-8 0" />
              </svg>
              {itemCount > 0 && (
                <span className="absolute -top-1 -right-2 min-w-[15px] h-[15px] px-0.5 rounded-full bg-maroon text-ivory text-[9px] font-sans font-bold flex items-center justify-center leading-none">
                  {itemCount > 9 ? "9+" : itemCount}
                </span>
              )}
            </div>
            <span className="text-[10px] font-sans font-normal tracking-wide mt-0.5">
              Cart
            </span>
          </button>

          {/* 4. Account */}
          <a
            href="/account"
            className={`flex flex-col items-center justify-center w-full h-full text-center transition-colors group relative ${
              activePath?.startsWith("/account") || activePath?.startsWith("/login") ? "text-maroon" : "text-charcoal/60 hover:text-maroon"
            }`}
            aria-label="Account"
          >
            <div className="relative flex items-center justify-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={activePath?.startsWith("/account") ? "2.2" : "1.8"} strokeLinecap="round" strokeLinejoin="round">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg>
            </div>
            <span className={`text-[10px] font-sans ${activePath?.startsWith("/account") ? "font-semibold" : "font-normal"} tracking-wide mt-0.5`}>
              Account
            </span>
            {activePath?.startsWith("/account") && (
              <span className="absolute bottom-1 w-1 h-1 rounded-full bg-gold"></span>
            )}
          </a>
        </div>
      </aside>
    </>
  );
}
