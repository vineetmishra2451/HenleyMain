"use client";

import React from "react";
import { useCart } from "./CartProvider";
import PlaceholderImage from "./PlaceholderImage";
import ArchFrame from "./ArchFrame";
import Button from "./Button";

/* ================================================================
   CART DRAWER
   ================================================================
   Slide-in panel from the right, triggered by header cart icon.
   Shows line items or empty state, subtotal, and checkout button.
   ================================================================ */

export default function CartDrawer() {
  const {
    isOpen,
    close,
    items,
    itemCount,
    subtotal,
    updateQuantity,
    removeItem,
  } = useCart();

  const isEmpty = items.length === 0;

  return (
    <>
      {/* Backdrop */}
      {isOpen && (
        <div
          className="fixed inset-0 z-[70] bg-charcoal/40 transition-opacity"
          onClick={close}
          aria-hidden="true"
        />
      )}

      {/* Drawer panel */}
      <div
        className={`
          fixed top-0 right-0 bottom-0 z-[80]
          w-full max-w-md bg-ivory shadow-card-hover
          flex flex-col
          transition-transform duration-300 ease-[cubic-bezier(0.25,1,0.5,1)]
          ${isOpen ? "translate-x-0" : "translate-x-full"}
        `}
        role="dialog"
        aria-modal="true"
        aria-label="Shopping cart"
      >
        {/* ── Drawer Header ────────────────────────────────── */}
        <div className="flex items-center justify-between px-6 py-5 border-b border-border">
          <h2 className="font-serif text-xl text-charcoal">
            Your Ritual
          </h2>
          <button
            onClick={close}
            className="p-1.5 text-charcoal/60 hover:text-charcoal transition-colors cursor-pointer"
            aria-label="Close cart"
          >
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
              <path d="M18 6L6 18M6 6l12 12" />
            </svg>
          </button>
        </div>

        {/* ── Drawer Body ──────────────────────────────────── */}
        <div className="flex-1 overflow-y-auto">
          {isEmpty ? (
            /* Empty State */
            <div className="flex flex-col items-center justify-center h-full px-6 py-12 text-center">
              <div className="mb-8 opacity-60">
                <ArchFrame variant="tall" className="!max-w-[120px] mx-auto" />
              </div>
              <p className="font-serif text-xl text-charcoal mb-2">
                Your cart is empty
              </p>
              <p className="text-sm text-charcoal/50 mb-6">
                Explore our collection and find your perfect blend.
              </p>
              <Button variant="primary" onClick={close}>
                Shop Now →
              </Button>
            </div>
          ) : (
            /* Line Items */
            <div className="divide-y divide-border">
              {items.map((item) => (
                <div key={item.id} className="flex gap-4 px-6 py-5">
                  {/* Thumbnail */}
                  <div className="w-20 flex-shrink-0">
                    <PlaceholderImage aspect="4:5" label="Tea" />
                  </div>

                  {/* Details */}
                  <div className="flex-1 min-w-0">
                    <div className="flex items-start justify-between gap-2">
                      <div>
                        <h3 className="font-serif text-base text-charcoal leading-snug">
                          {item.name}
                        </h3>
                        <p className="text-xs text-charcoal/50 mt-0.5">
                          {item.variant}
                        </p>
                      </div>
                      {/* Remove */}
                      <button
                        onClick={() => removeItem(item.id)}
                        className="p-1 text-charcoal/30 hover:text-error transition-colors flex-shrink-0 cursor-pointer"
                        aria-label={`Remove ${item.name}`}
                      >
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round">
                          <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                      </button>
                    </div>

                    {/* Quantity + Price row */}
                    <div className="flex items-center justify-between mt-3">
                      {/* Quantity stepper */}
                      <div className="flex items-center border border-border rounded-full overflow-hidden">
                        <button
                          onClick={() => updateQuantity(item.id, item.quantity - 1)}
                          disabled={item.quantity <= 1}
                          className="w-8 h-8 flex items-center justify-center text-charcoal/60 hover:text-charcoal hover:bg-sand disabled:opacity-30 transition-colors cursor-pointer disabled:cursor-not-allowed"
                          aria-label="Decrease quantity"
                        >
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M5 12h14" />
                          </svg>
                        </button>
                        <span className="w-8 text-center text-sm font-sans font-medium text-charcoal tabular-nums">
                          {item.quantity}
                        </span>
                        <button
                          onClick={() => updateQuantity(item.id, item.quantity + 1)}
                          className="w-8 h-8 flex items-center justify-center text-charcoal/60 hover:text-charcoal hover:bg-sand transition-colors cursor-pointer"
                          aria-label="Increase quantity"
                        >
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M12 5v14M5 12h14" />
                          </svg>
                        </button>
                      </div>

                      {/* Price */}
                      <span className="font-serif text-base text-charcoal tabular-nums">
                        {item.price}
                      </span>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>

        {/* ── Drawer Footer ────────────────────────────────── */}
        {!isEmpty && (
          <div className="border-t border-border px-6 py-5 space-y-4 bg-ivory">
            {/* Subtotal */}
            <div className="flex items-center justify-between">
              <span className="text-sm font-sans font-medium text-charcoal uppercase tracking-[0.06em]">
                Subtotal
              </span>
              <span className="font-serif text-xl text-charcoal">
                {subtotal}
              </span>
            </div>

            <p className="text-xs text-charcoal/50 text-center">
              Shipping and taxes calculated at checkout.
            </p>

            {/* Checkout CTA */}
            <Button variant="primary" className="w-full">
              Proceed to Checkout →
            </Button>

            {/* View Cart link */}
            <a
              href="/cart"
              onClick={close}
              className="
                block text-center text-sm font-sans font-medium text-charcoal/60
                hover:text-maroon underline underline-offset-4
                transition-colors
              "
            >
              View Cart
            </a>
          </div>
        )}
      </div>
    </>
  );
}
