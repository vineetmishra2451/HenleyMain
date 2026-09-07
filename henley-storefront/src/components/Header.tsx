"use client";

import React, { useState } from "react";
import Logo from "./Logo";
import { useCart } from "./CartProvider";

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

      {/* ── Mobile Drawer (Slide-in from Left) ─────────────── */}
      {mobileMenuOpen && (
        <div className="fixed inset-0 z-50 lg:hidden">
          {/* Backdrop */}
          <div
            className="absolute inset-0 bg-charcoal/40"
            onClick={() => setMobileMenuOpen(false)}
          />

          {/* Drawer panel */}
          <div className="
            relative w-[85vw] max-w-xs h-full bg-ivory shadow-card-hover
            flex flex-col justify-between p-6
            animate-slide-in-left
          ">
            {/* Drawer Header */}
            <div>
              <div className="flex items-center justify-between pb-6 border-b border-border">
                <Logo size="sm" />
                <button
                  onClick={() => setMobileMenuOpen(false)}
                  className="p-1.5 text-charcoal/60 hover:text-charcoal cursor-pointer"
                  aria-label="Close menu"
                >
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                    <path d="M18 6L6 18M6 6l12 12" />
                  </svg>
                </button>
              </div>

              {/* Drawer Links */}
              <nav className="py-6 space-y-1">
                {ALL_NAV_LINKS.map((link) => (
                  <a
                    key={link.label}
                    href={link.href}
                    onClick={() => setMobileMenuOpen(false)}
                    className={`
                      block py-3 px-3 rounded-md text-sm font-sans font-medium tracking-[0.08em] uppercase
                      transition-colors
                      ${link.active
                        ? "bg-sand text-maroon font-semibold"
                        : "text-charcoal hover:bg-sand/60 hover:text-maroon"
                      }
                    `}
                  >
                    {link.label}
                  </a>
                ))}
              </nav>
            </div>

            {/* Drawer Footer */}
            <div className="pt-6 border-t border-border space-y-3">
              <a
                href="/account"
                className="flex items-center gap-2 text-xs font-sans text-charcoal/70 hover:text-maroon"
              >
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8">
                  <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
                My Account
              </a>
              <p className="text-[11px] text-charcoal/40 font-sans">
                Complimentary shipping on orders over ₹1,999.
              </p>
            </div>
          </div>
        </div>
      )}
    </>
  );
}
