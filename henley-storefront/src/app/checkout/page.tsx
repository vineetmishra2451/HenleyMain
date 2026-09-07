"use client";

import React, { useState } from "react";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import Button from "@/components/Button";
import { useCart } from "@/components/CartProvider";

export default function CheckoutPage() {
  const { items, numericSubtotal, subtotal, clearCart } = useCart();
  const [paymentMethod, setPaymentMethod] = useState<"upi" | "card" | "netbanking" | "cod">("upi");
  const [orderPlaced, setOrderPlaced] = useState(false);

  const shippingCost = numericSubtotal >= 1000 || numericSubtotal === 0 ? 0 : 150;
  const taxAmount = Math.round(numericSubtotal * 0.05);
  const grandTotal = numericSubtotal + shippingCost + taxAmount;

  if (orderPlaced) {
    return (
      <div className="min-h-screen bg-ivory text-charcoal flex flex-col justify-between">
        <Header activePath="/checkout" />
        <main className="henley-container py-20 text-center max-w-xl mx-auto space-y-6">
          <div className="w-16 h-16 bg-success/15 text-success rounded-full flex items-center justify-center mx-auto">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
              <path d="M20 6L9 17l-5-5" />
            </svg>
          </div>
          <p className="text-eyebrow text-gold tracking-widest uppercase">Order Confirmed</p>
          <h1 className="font-serif text-3xl sm:text-4xl text-charcoal">Your Ritual Has Commenced</h1>
          <p className="text-sm text-charcoal/70 leading-relaxed">
            Consignment order <span className="font-mono font-bold text-maroon">HNL-2026-8819</span> has been scheduled for preparation at our Siliguri vault. You will receive dispatch coordinates via WhatsApp.
          </p>
          <div className="pt-4 flex items-center justify-center gap-4">
            <a href="/track-order">
              <Button variant="primary">Track Consignment →</Button>
            </a>
            <a href="/shop">
              <Button variant="secondary">Return to Shop</Button>
            </a>
          </div>
        </main>
        <Footer />
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-ivory text-charcoal flex flex-col justify-between">
      <Header activePath="/checkout" />

      <main className="henley-container py-10 lg:py-16">
        <div className="max-w-4xl mx-auto space-y-8">
          {/* Header */}
          <div className="border-b border-border/80 pb-6">
            <p className="text-eyebrow text-gold tracking-widest uppercase">Express Reserve Checkout</p>
            <h1 className="font-serif text-3xl sm:text-4xl text-charcoal mt-1">Direct Procurement Checkout</h1>
            <p className="text-xs text-charcoal/60 mt-1">Single-origin micro-lot packaging sealed at source.</p>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            {/* Left: Shipping Details & Payment */}
            <div className="lg:col-span-7 space-y-6">
              {/* Shipping Address */}
              <div className="bg-sand/40 border border-border rounded-xl p-6 space-y-4">
                <h2 className="font-serif text-lg text-charcoal">1. Delivery Destination</h2>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs font-sans">
                  <div>
                    <label className="block text-charcoal/70 mb-1 font-medium">Full Name</label>
                    <input
                      type="text"
                      defaultValue="Ananya Singhal"
                      className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                    />
                  </div>
                  <div>
                    <label className="block text-charcoal/70 mb-1 font-medium">Phone (WhatsApp updates)</label>
                    <input
                      type="text"
                      defaultValue="+91 98200 11223"
                      className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                    />
                  </div>
                  <div className="sm:col-span-2">
                    <label className="block text-charcoal/70 mb-1 font-medium">Street Address</label>
                    <input
                      type="text"
                      defaultValue="B-402, Pali Hill Reserve, Bandra West"
                      className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                    />
                  </div>
                  <div>
                    <label className="block text-charcoal/70 mb-1 font-medium">City</label>
                    <input
                      type="text"
                      defaultValue="Mumbai"
                      className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                    />
                  </div>
                  <div>
                    <label className="block text-charcoal/70 mb-1 font-medium">PIN Code</label>
                    <input
                      type="text"
                      defaultValue="400050"
                      className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                    />
                  </div>
                </div>
              </div>

              {/* Payment Method */}
              <div className="bg-sand/40 border border-border rounded-xl p-6 space-y-4">
                <h2 className="font-serif text-lg text-charcoal">2. Payment Method</h2>
                <div className="space-y-2.5">
                  {[
                    { id: "upi", label: "UPI Instant (Google Pay / PhonePe / Paytm / BHIM)", badge: "Fastest" },
                    { id: "card", label: "Credit / Debit Card (Visa, Mastercard, RuPay, Amex)", badge: "Instant" },
                    { id: "netbanking", label: "NetBanking (HDFC, ICICI, SBI, Axis, etc.)" },
                    { id: "cod", label: "Cash on Delivery (Standard Verification Required)" },
                  ].map((method) => (
                    <label
                      key={method.id}
                      className={`
                        flex items-center justify-between p-3.5 rounded-lg border text-xs font-sans cursor-pointer transition-all
                        ${paymentMethod === method.id ? "bg-white border-maroon shadow-xs ring-1 ring-maroon" : "bg-white/60 border-border hover:bg-white"}
                      `}
                    >
                      <div className="flex items-center gap-3">
                        <input
                          type="radio"
                          name="payment"
                          checked={paymentMethod === method.id}
                          onChange={() => setPaymentMethod(method.id as any)}
                          className="text-maroon focus:ring-maroon"
                        />
                        <span className="font-medium text-charcoal">{method.label}</span>
                      </div>
                      {method.badge && (
                        <span className="text-[10px] uppercase font-mono px-2 py-0.5 rounded-full bg-sand text-gold font-semibold">
                          {method.badge}
                        </span>
                      )}
                    </label>
                  ))}
                </div>
              </div>
            </div>

            {/* Right: Summary */}
            <div className="lg:col-span-5 space-y-6">
              <div className="bg-sand/60 border border-border rounded-xl p-6 space-y-5">
                <h2 className="font-serif text-xl text-charcoal pb-3 border-b border-border">Order Overview</h2>

                <div className="divide-y divide-border/60 max-h-60 overflow-y-auto text-xs">
                  {items.length === 0 ? (
                    <p className="py-3 text-charcoal/60">Cart is empty. Using sample allocation.</p>
                  ) : (
                    items.map((item) => (
                      <div key={item.id} className="py-2.5 flex items-center justify-between">
                        <div>
                          <p className="font-medium text-charcoal">{item.name}</p>
                          <p className="text-[11px] text-charcoal/60">
                            {item.variant} × {item.quantity}
                          </p>
                        </div>
                        <span className="font-mono text-charcoal font-semibold">{item.price}</span>
                      </div>
                    ))
                  )}
                </div>

                <div className="space-y-2 pt-3 border-t border-border text-xs font-sans">
                  <div className="flex justify-between text-charcoal/70">
                    <span>Subtotal</span>
                    <span className="font-mono">{subtotal || "₹0"}</span>
                  </div>
                  <div className="flex justify-between text-charcoal/70">
                    <span>Shipping</span>
                    <span className="font-mono">{shippingCost === 0 ? "FREE" : `₹${shippingCost}`}</span>
                  </div>
                  <div className="flex justify-between text-charcoal/70">
                    <span>Estimated GST (5%)</span>
                    <span className="font-mono">₹{taxAmount.toLocaleString("en-IN")}</span>
                  </div>
                  <div className="flex justify-between text-sm font-semibold text-charcoal pt-2 border-t border-border/60">
                    <span>Total Amount</span>
                    <span className="font-serif text-lg text-maroon">₹{grandTotal.toLocaleString("en-IN")}</span>
                  </div>
                </div>

                <Button
                  variant="primary"
                  className="w-full !h-12 !text-xs !tracking-wider"
                  onClick={() => {
                    clearCart();
                    setOrderPlaced(true);
                  }}
                >
                  Confirm & Pay ₹{grandTotal.toLocaleString("en-IN")}
                </Button>

                <p className="text-[11px] text-center text-charcoal/50">
                  🔒 256-bit Encrypted SSL Payment with RBI-compliant Tokenization.
                </p>
              </div>
            </div>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
}
