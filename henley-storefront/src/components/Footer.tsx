import React from "react";
import Logo from "./Logo";
import Button from "./Button";

/* ================================================================
   FOOTER
   ================================================================
   Sand background. Newsletter signup, 4 link columns, social/payment
   icons, copyright.
   ================================================================ */

const FOOTER_COLUMNS = [
  {
    title: "Collections",
    links: [
      { label: "All Reserves (22)", href: "/shop" },
      { label: "Tea (2)", href: "/collections?cat=tea" },
      { label: "Herbs & Spices (12)", href: "/collections?cat=herbs-spices" },
      { label: "Flours & Grains (4)", href: "/collections?cat=flours-grains" },
      { label: "Cooking Essentials (3)", href: "/collections?cat=cooking-essentials" },
      { label: "Cocoa (1)", href: "/collections?cat=cocoa" },
    ],
  },
  {
    title: "Company",
    links: [
      { label: "About & Our Story", href: "/story" },
      { label: "Botanical Journal", href: "/journal" },
      { label: "Contact Concierge", href: "/contact" },
    ],
  },
  {
    title: "Support",
    links: [
      { label: "FAQ & Guidance", href: "/faq" },
      { label: "Shipping & Delivery", href: "/shipping" },
      { label: "Track Your Order", href: "/track-order" },
    ],
  },
  {
    title: "Legal",
    links: [
      { label: "Privacy Policy", href: "/privacy" },
      { label: "Terms of Service", href: "/terms" },
    ],
  },
];

export default function Footer() {
  return (
    <footer className="bg-sand border-t border-border">
      {/* ── Newsletter Block ───────────────────────────────── */}
      <div className="henley-container py-16 lg:py-20">
        <div className="max-w-xl mx-auto text-center mb-16 lg:mb-20">
          <p className="text-eyebrow text-gold mb-3">Join the Ritual</p>
          <h2 className="font-serif text-2xl lg:text-3xl text-charcoal mb-3">
            Stay in the Know
          </h2>
          <p className="text-sm text-charcoal/60 mb-6">
            Be the first to hear about new blends, seasonal collections, and exclusive offers.
          </p>
          <form
            className="flex flex-col sm:flex-row gap-3 max-w-md mx-auto"
            onSubmit={(e) => e.preventDefault()}
          >
            <input
              type="email"
              placeholder="Your email address"
              className="
                flex-1 h-12 px-5 text-sm font-sans
                bg-ivory border border-border rounded-full
                text-charcoal placeholder:text-charcoal/40
                focus:outline-none focus:border-maroon
                transition-colors
              "
            />
            <Button variant="primary" type="submit">
              Subscribe
            </Button>
          </form>
        </div>

        {/* ── Link Columns ─────────────────────────────────── */}
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 pb-12 border-b border-border/60">
          {FOOTER_COLUMNS.map((col) => (
            <div key={col.title}>
              <h3 className="text-eyebrow text-charcoal mb-4">{col.title}</h3>
              <ul className="space-y-2.5">
                {col.links.map((link) => (
                  <li key={link.label}>
                    <a
                      href={link.href}
                      className="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors"
                    >
                      {link.label}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>

        {/* ── Bottom Row ───────────────────────────────────── */}
        <div className="pt-8 flex flex-col lg:flex-row items-center justify-between gap-6">
          {/* Social icons (placeholders) */}
          <div className="flex items-center gap-4">
            {["Instagram", "Facebook", "Pinterest", "Twitter"].map((name) => (
              <a
                key={name}
                href="#"
                className="w-9 h-9 rounded-full bg-ivory border border-border flex items-center justify-center text-charcoal/50 hover:text-maroon hover:border-maroon/30 transition-colors"
                aria-label={name}
              >
                <span className="text-xs font-sans font-semibold">
                  {name[0]}
                </span>
              </a>
            ))}
          </div>

          {/* Payment icons (placeholders) */}
          <div className="flex items-center gap-2">
            {["Visa", "MC", "Amex", "PayPal", "Apple"].map((name) => (
              <div
                key={name}
                className="h-7 px-2.5 bg-ivory border border-border rounded-xs flex items-center justify-center"
              >
                <span className="text-[10px] font-sans font-medium text-charcoal/40 tracking-wide uppercase">
                  {name}
                </span>
              </div>
            ))}
          </div>

          {/* Copyright */}
          <div className="flex items-center gap-3">
            <Logo size="sm" className="opacity-30" />
            <p className="text-xs text-charcoal/40">
              © 2024 Henley Herb & Spice. All rights reserved.
            </p>
          </div>
        </div>
      </div>
    </footer>
  );
}
