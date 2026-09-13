"use client";

import React, { useState, useEffect } from "react";
import Logo from "./Logo";
import SearchModal from "./SearchModal";
import LocationPromptModal from "./LocationPromptModal";
import { useCart } from "./CartProvider";
import { COLLECTIONS, PRODUCTS } from "@/data/catalog";
import {
  getSavedLocation,
  hasBeenPromptedForLocation,
  LocationServiceResult,
} from "@/utils/locationService";
import { captureReferralCodeFromUrl } from "@/utils/referralService";
import { getAuthenticatedUser, logoutUser, AuthUser } from "@/utils/authService";

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
  { label: "Shop All", href: "/shop" },
  { label: "Collections", href: "/collections" },
  { label: "Our Story", href: "/story" },
];

const RIGHT_NAV_LINKS: NavLink[] = [
  { label: "Apothecary", href: "/brands/henley" },
  { label: "Journal", href: "/story" },
  { label: "FAQ", href: "/faq" },
];

const ALL_NAV_LINKS: NavLink[] = [...LEFT_NAV_LINKS, ...RIGHT_NAV_LINKS];

export interface HeaderProps {
  activePath?: string;
}

export default function Header({ activePath }: HeaderProps = {}) {
  const [announcementVisible, setAnnouncementVisible] = useState(true);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [activeCategorySlug, setActiveCategorySlug] = useState<string | null>(null);
  const [searchModalOpen, setSearchModalOpen] = useState(false);
  const [locationModalOpen, setLocationModalOpen] = useState(false);
  const [savedLocation, setSavedLocation] = useState<LocationServiceResult | null>(null);
  const [referralBannerCode, setReferralBannerCode] = useState<string | null>(null);
  const [authUser, setAuthUser] = useState<AuthUser | null>(null);
  const { open: openCart, itemCount } = useCart();

  useEffect(() => {
    // 1. Initial saved location
    const loc = getSavedLocation();
    setSavedLocation(loc);

    // 2. Initial auth user
    setAuthUser(getAuthenticatedUser());

    // 3. Check for referral code in URL (?ref=...)
    const ref = captureReferralCodeFromUrl();
    if (ref) {
      setReferralBannerCode(ref);
    }

    // 4. Automatically prompt for location on initial visit if not set
    if (!loc && !hasBeenPromptedForLocation()) {
      const timer = setTimeout(() => {
        setLocationModalOpen(true);
      }, 1500);
      return () => clearTimeout(timer);
    }
  }, []);

  useEffect(() => {
    const handleLocationChange = (e: Event) => {
      const custom = e as CustomEvent<LocationServiceResult>;
      if (custom.detail) {
        setSavedLocation(custom.detail);
      }
    };
    const handleAuthChange = (e: Event) => {
      const custom = e as CustomEvent<AuthUser | null>;
      setAuthUser(custom.detail);
    };
    window.addEventListener("henley-location-changed", handleLocationChange);
    window.addEventListener("henley-auth-changed", handleAuthChange);
    return () => {
      window.removeEventListener("henley-location-changed", handleLocationChange);
      window.removeEventListener("henley-auth-changed", handleAuthChange);
    };
  }, []);

  return (
    <>
      <header className="sticky top-0 z-50 bg-ivory">
        {/* ── Announcement Bar ──────────────────────────────── */}
        {announcementVisible && (
          <div className="relative bg-maroon text-center py-2 px-4 sm:px-12 flex flex-col sm:flex-row items-center justify-between gap-1.5 text-[11px] font-sans">
            {/* Location selector button */}
            <button
              type="button"
              onClick={() => setLocationModalOpen(true)}
              className="inline-flex items-center gap-1.5 text-gold hover:text-ivory transition-colors cursor-pointer text-left"
              aria-label="Edit delivery location"
            >
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                <circle cx="12" cy="10" r="3" />
              </svg>
              <span>
                Deliver to:{" "}
                <strong className="underline underline-offset-2">
                  {savedLocation ? `${savedLocation.city} (${savedLocation.pincode})` : "Check Pincode"}
                </strong>
              </span>
              <span className="text-[10px] text-ivory/60 hover:text-ivory ml-0.5">(Change)</span>
            </button>

            {/* Central Promo / Referral message */}
            <p className="text-gold font-medium tracking-[0.06em]">
              {referralBannerCode ? (
                <span>
                  ✦ Friend Invitation Active: 10% off with code <strong className="text-ivory">{referralBannerCode}</strong>
                </span>
              ) : (
                <span>
                  Complimentary shipping over ₹1,999 · <a href="/referral" className="underline hover:text-ivory">Refer a Friend (Earn 20%)</a>
                </span>
              )}
            </p>

            {/* Dismiss button */}
            <button
              onClick={() => setAnnouncementVisible(false)}
              className="hidden sm:inline-flex text-ivory/60 hover:text-ivory transition-colors cursor-pointer"
              aria-label="Dismiss announcement"
            >
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
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
                <button
                  type="button"
                  onClick={() => setSearchModalOpen(true)}
                  className="p-2 text-charcoal hover:text-maroon transition-colors cursor-pointer rounded-full"
                  aria-label="Search catalog"
                >
                  <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                  </svg>
                </button>
              </div>

              {/* Account (with dropdown preview) */}
              <div className="relative group">
                <a
                  href="/account"
                  className="p-1.5 text-charcoal hover:text-maroon transition-colors flex items-center gap-1.5"
                  aria-label="Account"
                >
                  {authUser ? (
                    <div className="w-7 h-7 rounded-full bg-maroon text-gold font-serif text-xs flex items-center justify-center border border-gold/40 shadow-2xs">
                      {authUser.name
                        .split(" ")
                        .map((n) => n[0])
                        .join("")
                        .slice(0, 2)
                        .toUpperCase() || "H"}
                    </div>
                  ) : (
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                      <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                      <circle cx="12" cy="7" r="4" />
                    </svg>
                  )}
                </a>
                {/* Account dropdown */}
                <div className="
                  absolute right-0 top-full pt-2 w-52
                  opacity-0 translate-y-1 pointer-events-none
                  group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto
                  transition-all duration-200 z-50
                ">
                  {authUser ? (
                    <div className="bg-white rounded-xl shadow-card border border-border/80 p-3 space-y-2">
                      <div className="pb-2 border-b border-border/60">
                        <p className="text-xs font-serif font-semibold text-charcoal truncate">{authUser.name}</p>
                        <span className="text-[10px] font-sans text-maroon font-medium">✦ {authUser.tier || "Patron Reserve"}</span>
                      </div>
                      <a href="/account" className="block px-2.5 py-1.5 text-xs font-sans text-charcoal hover:bg-sand/60 hover:text-maroon rounded-md transition-colors">
                        Patron Dashboard
                      </a>
                      <a href="/account" className="block px-2.5 py-1.5 text-xs font-sans text-charcoal hover:bg-sand/60 hover:text-maroon rounded-md transition-colors">
                        My Consignments (2)
                      </a>
                      <a href="/referral" className="block px-2.5 py-1.5 text-xs font-sans text-charcoal hover:bg-sand/60 hover:text-maroon rounded-md transition-colors">
                        Connoisseur Wallet (₹{authUser.walletBalance || 1200})
                      </a>
                      <div className="border-t border-border/50 pt-1" />
                      <button
                        type="button"
                        onClick={() => logoutUser()}
                        className="w-full text-left px-2.5 py-1.5 text-xs font-sans text-charcoal/70 hover:text-danger hover:bg-danger/5 rounded-md transition-colors cursor-pointer"
                      >
                        Sign Out
                      </button>
                    </div>
                  ) : (
                    <div className="bg-white rounded-xl shadow-card border border-border/80 py-2">
                      <a href="/account" className="block px-4 py-2 text-xs font-sans text-charcoal hover:bg-sand/60 hover:text-maroon transition-colors">
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
                  )}
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
                    setSearchModalOpen(true);
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

              {/* Delivery Destination Card */}
              <div className="mx-5 my-2 p-3 rounded-xl bg-sand/50 border border-border/80 flex items-center justify-between">
                <div className="flex items-center gap-2.5 min-w-0">
                  <div className="w-8 h-8 rounded-full bg-maroon/10 text-maroon flex items-center justify-center flex-shrink-0">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                  </div>
                  <div className="min-w-0">
                    <p className="text-[10px] uppercase font-sans tracking-wider text-charcoal/50">Delivering To</p>
                    <p className="text-xs font-serif font-semibold text-charcoal truncate">
                      {savedLocation ? `${savedLocation.city} (${savedLocation.pincode})` : "Check Pincode"}
                    </p>
                  </div>
                </div>
                <button
                  type="button"
                  onClick={() => {
                    setMobileMenuOpen(false);
                    setLocationModalOpen(true);
                  }}
                  className="px-2.5 py-1 rounded-md bg-white border border-border text-[11px] font-sans text-maroon font-semibold hover:bg-sand transition cursor-pointer flex-shrink-0 ml-2"
                >
                  Change
                </button>
              </div>

              {/* Referral Banner in Mobile Drawer */}
              <div className="mx-5 mb-2">
                <a
                  href="/referral"
                  onClick={() => setMobileMenuOpen(false)}
                  className="flex items-center justify-between p-3 rounded-xl bg-maroon text-ivory text-xs font-sans shadow-xs hover:bg-maroon/90 transition-colors"
                >
                  <div className="flex items-center gap-2.5">
                    <span className="text-gold text-base">🎁</span>
                    <div>
                      <p className="font-semibold text-gold">Refer & Earn 20%</p>
                      <p className="text-[10px] text-ivory/70">Give 10% off on orders above ₹500</p>
                    </div>
                  </div>
                  <span className="text-gold font-bold">→</span>
                </a>
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
              {authUser ? (
                <div className="space-y-2">
                  <div className="p-2.5 rounded-lg bg-white border border-border/80 flex items-center justify-between">
                    <div>
                      <p className="text-xs font-serif font-semibold text-charcoal">{authUser.name}</p>
                      <p className="text-[10px] text-maroon font-medium">✦ {authUser.tier || "Patron Reserve"}</p>
                    </div>
                    <button
                      type="button"
                      onClick={() => {
                        logoutUser();
                        setMobileMenuOpen(false);
                      }}
                      className="text-[11px] font-sans text-charcoal/60 hover:text-danger cursor-pointer"
                    >
                      Sign Out
                    </button>
                  </div>
                  <a
                    href="/account"
                    onClick={() => setMobileMenuOpen(false)}
                    className="block w-full py-2.5 text-center text-xs font-sans font-semibold uppercase tracking-wider bg-maroon text-ivory rounded-lg hover:bg-maroon/90 transition-colors shadow-xs"
                  >
                    Open Patron Dashboard →
                  </a>
                </div>
              ) : (
                <a
                  href="/account"
                  onClick={() => setMobileMenuOpen(false)}
                  className="block w-full py-2.5 text-center text-xs font-sans font-semibold uppercase tracking-wider bg-maroon text-ivory rounded-lg hover:bg-maroon/90 transition-colors shadow-xs"
                >
                  Sign In / Create Account
                </a>
              )}
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

      {/* ── Live Search Modal ───────────────────────────────── */}
      <SearchModal
        isOpen={searchModalOpen}
        onClose={() => setSearchModalOpen(false)}
      />

      {/* ── Delivery Location Selector Modal ────────────────── */}
      <LocationPromptModal
        isOpen={locationModalOpen}
        onClose={() => setLocationModalOpen(false)}
      />
    </>
  );
}
