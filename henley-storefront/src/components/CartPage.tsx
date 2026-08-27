"use client";

import React, { useState } from "react";
import PlaceholderImage from "./PlaceholderImage";
import ArchFrame from "./ArchFrame";
import Button from "./Button";
import { useCart } from "./CartProvider";

/* ================================================================
   CART PAGE TEMPLATE (<CartPage />)
   ================================================================
   Standalone /cart route matching the luxury apothecary design system (INR / ₹):
   1. Breadcrumb + Serif Page Title
   2. Left: Cart items table / cards with stepper, line totals & remove
   3. Right: Sticky Order Summary (Coupon, Free Shipping meter, Taxes, Total)
   4. Empty Cart State with centered ArchFrame & CTA
   ================================================================ */

export default function CartPage() {
  const { items, itemCount, updateQuantity, removeItem } = useCart();

  // Coupon State
  const [couponCode, setCouponCode] = useState("");
  const [appliedCoupon, setAppliedCoupon] = useState<{
    code: string;
    discountPercent: number;
  } | null>(null);
  const [couponError, setCouponError] = useState("");

  // Delivery dropdown/speed state
  const [deliveryMethod, setDeliveryMethod] = useState<"standard" | "express">("standard");

  // Calculations in INR
  const numericSubtotal = items.reduce((sum, item) => {
    const unit = parseFloat(item.price.replace(/[^\d.]/g, "")) || 0;
    return sum + unit * item.quantity;
  }, 0);

  // Discount calculation
  const discountAmount = appliedCoupon
    ? Math.round((numericSubtotal * appliedCoupon.discountPercent) / 100)
    : 0;

  // Free shipping over ₹1,999
  const freeShippingThreshold = 1999;
  const isFreeShipping = numericSubtotal >= freeShippingThreshold;
  const shippingCost = isFreeShipping
    ? 0
    : deliveryMethod === "express"
    ? 299
    : 149;
  const remainingForFreeShipping = Math.max(0, freeShippingThreshold - numericSubtotal);
  const shippingProgress = Math.min(100, (numericSubtotal / freeShippingThreshold) * 100);

  // Estimated GST (5%)
  const discountedSubtotal = Math.max(0, numericSubtotal - discountAmount);
  const estimatedTax = Math.round(discountedSubtotal * 0.05);

  // Final Total
  const finalTotal = discountedSubtotal + shippingCost + estimatedTax;

  const handleApplyCoupon = (e: React.FormEvent) => {
    e.preventDefault();
    setCouponError("");
    const clean = couponCode.trim().toUpperCase();

    if (clean === "WELCOME10") {
      setAppliedCoupon({ code: "WELCOME10", discountPercent: 10 });
      setCouponCode("");
    } else if (clean === "HENLEY20") {
      setAppliedCoupon({ code: "HENLEY20", discountPercent: 20 });
      setCouponCode("");
    } else if (clean.length === 0) {
      setCouponError("Please enter a coupon code.");
    } else {
      setCouponError("Invalid code. Try 'WELCOME10' for 10% off.");
    }
  };

  const handleRemoveCoupon = () => {
    setAppliedCoupon(null);
    setCouponError("");
  };

  const isEmpty = items.length === 0;

  return (
    <div className="bg-ivory min-h-screen">
      {/* ── Breadcrumb ────────────────────────────────────────── */}
      <div className="henley-container pt-6 pb-2">
        <nav
          aria-label="Breadcrumbs"
          className="flex items-center gap-2 text-xs font-sans text-charcoal/50"
        >
          <a href="/" className="hover:text-maroon transition-colors">
            Home
          </a>
          <span className="text-charcoal/30">/</span>
          <span className="text-charcoal font-medium">Cart</span>
        </nav>
      </div>

      {/* ── Page Header ───────────────────────────────────────── */}
      <header className="henley-container py-6 lg:py-8 border-b border-border/80">
        <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
          <div>
            <p className="text-eyebrow text-gold mb-1">Your Botanical Bag</p>
            <h1 className="font-serif text-3xl lg:text-4xl text-charcoal">
              Your Ritual
            </h1>
          </div>
          {!isEmpty && (
            <p className="text-xs font-sans text-charcoal/60">
              {itemCount} {itemCount === 1 ? "item" : "items"} selected
            </p>
          )}
        </div>
      </header>

      {/* ── Main Cart Area ────────────────────────────────────── */}
      <div className="henley-container py-8 lg:py-14">
        {isEmpty ? (
          /* ── Empty Cart State ── */
          <div className="py-20 text-center flex flex-col items-center justify-center bg-sand/20 rounded-xl border border-dashed border-border p-8 max-w-xl mx-auto space-y-6">
            <div className="opacity-40">
              <ArchFrame variant="tall" className="!max-w-[120px] mx-auto" />
            </div>
            <div className="space-y-2">
              <h2 className="font-serif text-2xl lg:text-3xl text-charcoal">
                Your ritual awaits
              </h2>
              <p className="text-sm text-charcoal/60 max-w-sm mx-auto leading-relaxed">
                Your shopping bag is currently empty. Discover our rare teas, single-origin
                whole spices, and stoneground flours.
              </p>
            </div>
            <Button
              variant="primary"
              className="!px-8"
              onClick={() => (window.location.href = "/collections")}
            >
              Explore Collections →
            </Button>
          </div>
        ) : (
          /* ── Two-Column Cart Grid ── */
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            {/* ════════════════════════════════════════════════════
                LEFT COLUMN: CART ITEMS TABLE / CARDS (7 Cols)
               ════════════════════════════════════════════════════ */}
            <div className="lg:col-span-7 xl:col-span-8 space-y-6">
              {/* Desktop Table Header */}
              <div className="hidden sm:grid sm:grid-cols-12 gap-4 pb-3 border-b border-border text-xs font-sans font-semibold uppercase tracking-[0.1em] text-charcoal/60">
                <div className="sm:col-span-6">Product</div>
                <div className="sm:col-span-3 text-center">Quantity</div>
                <div className="sm:col-span-3 text-right">Total</div>
              </div>

              {/* Items List */}
              <div className="divide-y divide-border border-b border-border">
                {items.map((item) => {
                  const unitNum = parseFloat(item.price.replace(/[^\d.]/g, "")) || 0;
                  const lineTotal = "₹" + (unitNum * item.quantity).toLocaleString("en-IN");

                  return (
                    <div
                      key={item.id}
                      className="py-6 flex flex-col sm:grid sm:grid-cols-12 gap-4 items-start sm:items-center"
                    >
                      {/* Product Thumbnail & Details (6 cols) */}
                      <div className="sm:col-span-6 flex items-center gap-4 w-full">
                        {/* 4:5 Thumbnail */}
                        <div className="w-20 sm:w-24 flex-shrink-0">
                          <PlaceholderImage
                            aspect="4:5"
                            label={item.name}
                            className="!rounded-md"
                          />
                        </div>

                        {/* Title, Variant & Unit Price */}
                        <div className="space-y-1 flex-1 min-w-0">
                          <h3 className="font-serif text-lg text-charcoal leading-snug">
                            {item.name}
                          </h3>
                          <p className="text-xs font-sans text-charcoal/50">
                            {item.variant}
                          </p>
                          <p className="text-xs font-serif text-charcoal/80 sm:hidden">
                            Unit: {item.price}
                          </p>

                          {/* Mobile Remove button */}
                          <button
                            onClick={() => removeItem(item.id)}
                            className="text-xs font-sans text-charcoal/40 hover:text-error transition-colors sm:hidden pt-1 flex items-center gap-1 cursor-pointer"
                          >
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                              <path d="M18 6L6 18M6 6l12 12" />
                            </svg>
                            Remove
                          </button>
                        </div>
                      </div>

                      {/* Quantity Stepper (3 cols) */}
                      <div className="sm:col-span-3 flex items-center justify-between sm:justify-center w-full pt-2 sm:pt-0">
                        <span className="text-xs font-sans text-charcoal/60 sm:hidden">
                          Quantity:
                        </span>
                        <div className="flex items-center border border-border rounded-full bg-white overflow-hidden h-9 px-1">
                          <button
                            onClick={() =>
                              updateQuantity(item.id, item.quantity - 1)
                            }
                            disabled={item.quantity <= 1}
                            className="w-7 h-full flex items-center justify-center text-charcoal/60 hover:text-charcoal hover:bg-sand disabled:opacity-30 transition-colors cursor-pointer"
                            aria-label={`Decrease quantity of ${item.name}`}
                          >
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                              <path d="M5 12h14" />
                            </svg>
                          </button>
                          <span className="w-8 text-center text-xs font-sans font-medium text-charcoal tabular-nums">
                            {item.quantity}
                          </span>
                          <button
                            onClick={() =>
                              updateQuantity(item.id, item.quantity + 1)
                            }
                            className="w-7 h-full flex items-center justify-center text-charcoal/60 hover:text-charcoal hover:bg-sand transition-colors cursor-pointer"
                            aria-label={`Increase quantity of ${item.name}`}
                          >
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                              <path d="M12 5v14M5 12h14" />
                            </svg>
                          </button>
                        </div>
                      </div>

                      {/* Line Total & Desktop Remove Icon (3 cols) */}
                      <div className="sm:col-span-3 flex items-center justify-between sm:justify-end gap-3 w-full pt-1 sm:pt-0">
                        <span className="text-xs font-sans text-charcoal/60 sm:hidden">
                          Total:
                        </span>
                        <span className="font-serif text-base sm:text-lg text-charcoal font-medium tabular-nums">
                          {lineTotal}
                        </span>
                        {/* Desktop Remove Button */}
                        <button
                          onClick={() => removeItem(item.id)}
                          className="hidden sm:inline-flex p-1.5 text-charcoal/40 hover:text-error transition-colors rounded-full hover:bg-error/10 cursor-pointer"
                          aria-label={`Remove ${item.name} from cart`}
                          title="Remove item"
                        >
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round">
                            <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  );
                })}
              </div>

              {/* Bottom Actions */}
              <div className="flex items-center justify-between pt-2">
                <a
                  href="/collections"
                  className="inline-flex items-center gap-1.5 text-xs font-sans font-medium text-maroon hover:underline"
                >
                  ← Continue Shopping
                </a>
              </div>
            </div>

            {/* ════════════════════════════════════════════════════
                RIGHT COLUMN: ORDER SUMMARY (5 Cols, Sticky)
               ════════════════════════════════════════════════════ */}
            <div className="lg:col-span-5 xl:col-span-4 lg:sticky lg:top-28 space-y-6">
              <div className="bg-sand/60 rounded-xl border border-border p-6 sm:p-8 space-y-6 shadow-subtle">
                <h2 className="font-serif text-2xl text-charcoal pb-4 border-b border-border">
                  Order Summary
                </h2>

                {/* ── Free Shipping Progress Meter ── */}
                <div className="p-4 bg-white/80 rounded-lg border border-border/70 space-y-2">
                  <div className="flex items-center justify-between text-xs font-sans">
                    <span className="font-medium text-charcoal">
                      {isFreeShipping
                        ? "🎉 Free Shipping Unlocked!"
                        : `Add ₹${remainingForFreeShipping.toLocaleString("en-IN")} for Free Shipping`}
                    </span>
                    <span className="text-gold font-semibold">
                      ₹{freeShippingThreshold.toLocaleString("en-IN")} Goal
                    </span>
                  </div>
                  <div className="w-full h-2 bg-sand rounded-full overflow-hidden">
                    <div
                      className="h-full bg-maroon transition-all duration-500 rounded-full"
                      style={{ width: `${shippingProgress}%` }}
                    />
                  </div>
                </div>

                {/* ── Coupon Application Form ── */}
                <div className="space-y-2">
                  <span className="text-eyebrow text-charcoal/75 block !text-[10px]">
                    Promotion Code
                  </span>
                  {appliedCoupon ? (
                    <div className="flex items-center justify-between p-3 bg-success/10 border border-success/30 rounded-lg text-xs font-sans">
                      <div className="flex items-center gap-2 text-success font-medium">
                        <span>✓</span>
                        <span>{appliedCoupon.code} applied ({appliedCoupon.discountPercent}% OFF)</span>
                      </div>
                      <button
                        onClick={handleRemoveCoupon}
                        className="text-charcoal/50 hover:text-error text-xs font-medium cursor-pointer"
                      >
                        Remove
                      </button>
                    </div>
                  ) : (
                    <form onSubmit={handleApplyCoupon} className="flex gap-2">
                      <input
                        type="text"
                        value={couponCode}
                        onChange={(e) => {
                          setCouponCode(e.target.value);
                          setCouponError("");
                        }}
                        placeholder="e.g. WELCOME10"
                        className="
                          flex-1 px-3 py-2 text-xs font-sans uppercase tracking-wider
                          bg-white border border-border rounded-lg text-charcoal
                          placeholder:text-charcoal/35 placeholder:normal-case placeholder:tracking-normal
                          focus:outline-none focus:border-maroon
                        "
                      />
                      <Button
                        variant="secondary"
                        className="!py-2 !px-4 !text-xs"
                      >
                        Apply
                      </Button>
                    </form>
                  )}
                  {couponError && (
                    <p className="text-[11px] font-sans text-error">{couponError}</p>
                  )}
                </div>

                {/* ── Price Breakdown ── */}
                <div className="space-y-3 pt-2 text-xs font-sans">
                  {/* Subtotal */}
                  <div className="flex items-center justify-between text-charcoal/80">
                    <span>Subtotal</span>
                    <span className="font-serif text-sm text-charcoal font-medium tabular-nums">
                      ₹{numericSubtotal.toLocaleString("en-IN")}
                    </span>
                  </div>

                  {/* Discount */}
                  {appliedCoupon && (
                    <div className="flex items-center justify-between text-success">
                      <span>Discount ({appliedCoupon.code})</span>
                      <span className="font-serif text-sm font-medium tabular-nums">
                        -₹{discountAmount.toLocaleString("en-IN")}
                      </span>
                    </div>
                  )}

                  {/* Shipping */}
                  <div className="flex items-center justify-between text-charcoal/80">
                    <div className="flex items-center gap-1.5">
                      <span>Estimated Shipping</span>
                      <select
                        value={deliveryMethod}
                        onChange={(e) =>
                          setDeliveryMethod(e.target.value as "standard" | "express")
                        }
                        aria-label="Select delivery method"
                        className="bg-transparent border-b border-border/80 text-[11px] text-charcoal/70 focus:outline-none cursor-pointer"
                      >
                        <option value="standard">Standard (2-4 days)</option>
                        <option value="express">Express Air (1-2 days)</option>
                      </select>
                    </div>
                    <span className="font-serif text-sm text-charcoal font-medium tabular-nums">
                      {isFreeShipping && deliveryMethod === "standard"
                        ? "FREE"
                        : `₹${shippingCost.toLocaleString("en-IN")}`}
                    </span>
                  </div>

                  {/* Estimated Taxes */}
                  <div className="flex items-center justify-between text-charcoal/80">
                    <span>GST (5%)</span>
                    <span className="font-serif text-sm text-charcoal font-medium tabular-nums">
                      ₹{estimatedTax.toLocaleString("en-IN")}
                    </span>
                  </div>

                  {/* Divider & Total */}
                  <div className="border-t border-border pt-4 flex items-baseline justify-between">
                    <div>
                      <span className="font-sans font-semibold text-sm text-charcoal block">
                        Estimated Total
                      </span>
                      <span className="text-[10px] text-charcoal/40">
                        INR including taxes
                      </span>
                    </div>
                    <span className="font-serif text-2xl lg:text-3xl text-maroon font-semibold tabular-nums">
                      ₹{finalTotal.toLocaleString("en-IN")}
                    </span>
                  </div>
                </div>

                {/* ── Delivery Window Statement ── */}
                <div className="p-3 bg-sand/80 rounded-lg text-[11px] font-sans text-charcoal/70 space-y-1">
                  <div className="flex items-center gap-2 text-charcoal font-medium">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M5 18H3c-.6 0-1-.4-1-1V7c0-.6.4-1 1-1h10c.6 0 1 .4 1 1v11" />
                      <path d="M14 9h4l4 4v4c0 .6-.4 1-1 1h-2" />
                      <circle cx="7" cy="18" r="2" />
                      <circle cx="17" cy="18" r="2" />
                    </svg>
                    Carbon-Neutral Express Dispatch
                  </div>
                  <p className="text-charcoal/60">
                    Packed in insulated eco-craft boxes. Estimated delivery: 2–4 business days across India.
                  </p>
                </div>

                {/* ── Proceed to Checkout Button ── */}
                <Button
                  variant="primary"
                  className="w-full !h-12 !text-xs !tracking-wider flex items-center justify-center gap-2"
                  onClick={() => alert("Proceeding to secure checkout gateway (UPI / Cards / NetBanking)...")}
                >
                  Proceed to Checkout →
                </Button>

                {/* Security badges */}
                <div className="pt-2 text-center space-y-2">
                  <div className="flex items-center justify-center gap-1 text-[11px] font-sans text-charcoal/50">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    256-Bit SSL Encrypted Checkout
                  </div>
                  <div className="flex items-center justify-center gap-3 text-[10px] uppercase tracking-wider text-charcoal/40 font-mono">
                    <span>UPI</span>
                    <span>·</span>
                    <span>RuPay</span>
                    <span>·</span>
                    <span>Visa</span>
                    <span>·</span>
                    <span>Mastercard</span>
                    <span>·</span>
                    <span>NetBanking</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
