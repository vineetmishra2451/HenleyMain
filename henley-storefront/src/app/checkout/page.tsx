"use client";

import React, { useState, useEffect } from "react";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import Button from "@/components/Button";
import { useCart } from "@/components/CartProvider";
import {
  getSavedLocation,
  checkPincodeAvailability,
  LocationServiceResult,
} from "@/utils/locationService";
import {
  getActiveReferralCode,
  clearActiveReferralCode,
  validateReferralCode,
  getWalletBalance,
  deductWalletCredit,
  ReferralValidationResult,
  getUserReferralCode,
} from "@/utils/referralService";

export default function CheckoutPage() {
  const { items, numericSubtotal, subtotal, clearCart } = useCart();
  const [paymentMethod, setPaymentMethod] = useState<"upi" | "card" | "netbanking" | "cod">("upi");
  const [orderPlaced, setOrderPlaced] = useState(false);

  // Delivery destination state
  const [shippingCity, setShippingCity] = useState("Mumbai");
  const [shippingPin, setShippingPin] = useState("400050");
  const [locationResult, setLocationResult] = useState<LocationServiceResult | null>(null);

  // Referral state
  const [referralInput, setReferralInput] = useState("");
  const [appliedReferral, setAppliedReferral] = useState<ReferralValidationResult | null>(null);
  const [referralError, setReferralError] = useState<string | null>(null);
  const [isApplyingReferral, setIsApplyingReferral] = useState(false);

  // Customer Wallet State
  const [walletBalance, setWalletBalance] = useState(1200);
  const [useWalletCredit, setUseWalletCredit] = useState(false);

  // Load saved location and check for URL referral
  useEffect(() => {
    const loc = getSavedLocation();
    if (loc) {
      if (loc.city) setShippingCity(loc.city);
      if (loc.pincode) setShippingPin(loc.pincode);
      setLocationResult(loc);
    } else {
      checkPincodeAvailability("400050").then(setLocationResult);
    }

    setWalletBalance(getWalletBalance());

    // Auto-apply referral code if stored from ?ref=...
    const activeRef = getActiveReferralCode();
    if (activeRef) {
      setReferralInput(activeRef);
      const effectiveAmount = numericSubtotal > 0 ? numericSubtotal : 1999;
      validateReferralCode(activeRef, effectiveAmount).then((res) => {
        if (res.valid) {
          setAppliedReferral(res);
        }
      });
    }
  }, [numericSubtotal]);

  // Handle PIN change in form
  const handlePinBlur = async () => {
    if (shippingPin.length === 6) {
      const res = await checkPincodeAvailability(shippingPin);
      setLocationResult(res);
      if (res.city) setShippingCity(res.city);
    }
  };

  const baseSubtotal = numericSubtotal > 0 ? numericSubtotal : 1999;

  // Handle Referral Apply
  const handleApplyReferral = async (e?: React.FormEvent) => {
    if (e) e.preventDefault();
    if (!referralInput.trim()) return;

    setReferralError(null);
    setIsApplyingReferral(true);
    try {
      const res = await validateReferralCode(referralInput, baseSubtotal);
      if (res.valid) {
        setAppliedReferral(res);
      } else {
        setReferralError(res.message);
        setAppliedReferral(null);
      }
    } catch {
      setReferralError("Unable to validate referral code.");
    } finally {
      setIsApplyingReferral(false);
    }
  };

  const handleRemoveReferral = () => {
    setAppliedReferral(null);
    setReferralInput("");
    setReferralError(null);
    clearActiveReferralCode();
  };

  // Calculations
  const referralDiscount = appliedReferral && appliedReferral.valid ? appliedReferral.discountAmount : 0;
  const discountedSubtotal = Math.max(0, baseSubtotal - referralDiscount);
  const shippingCost = discountedSubtotal >= 1000 || discountedSubtotal === 0 ? 0 : 150;
  const taxAmount = Math.round(discountedSubtotal * 0.05);
  const preWalletTotal = discountedSubtotal + shippingCost + taxAmount;

  const appliedWalletCredit = useWalletCredit ? Math.min(walletBalance, preWalletTotal) : 0;
  const grandTotal = Math.max(0, preWalletTotal - appliedWalletCredit);

  const myCode = getUserReferralCode();
  const shareUrl = typeof window !== "undefined"
    ? `${window.location.origin}/?ref=${myCode}`
    : `https://henleytea.com/?ref=${myCode}`;

  const whatsappShare = encodeURIComponent(
    `I just ordered single-estate botanicals from Henley. Use my code "${myCode}" for flat 10% off your first order above ₹500: ${shareUrl}`
  );

  if (orderPlaced) {
    return (
      <div className="min-h-screen bg-ivory text-charcoal flex flex-col justify-between">
        <Header activePath="/checkout" />
        <main className="henley-container py-16 text-center max-w-xl mx-auto space-y-6">
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

          {/* Referral Credit Confirmation Banner */}
          {appliedReferral && (
            <div className="p-4 rounded-xl bg-success/10 border border-success/30 text-xs font-sans text-charcoal space-y-1">
              <p className="font-semibold text-success flex items-center justify-center gap-1.5">
                <span>🎁 Referral Reward Confirmed</span>
              </p>
              <p className="text-charcoal/80">
                You saved <span className="font-bold">₹{appliedReferral.discountAmount}</span> (10% off). Your referrer ({appliedReferral.referrerName || "Friend"}) will receive{" "}
                <span className="font-bold text-maroon">₹{appliedReferral.referrerCreditAmount}</span> (20% store credit) in their customer wallet!
              </p>
            </div>
          )}

          {/* Post-Purchase Referral Invitation Card */}
          <div className="p-6 bg-sand/50 border border-border rounded-2xl text-left space-y-3">
            <div className="flex items-center gap-2 text-gold">
              <span className="text-lg">✦</span>
              <h3 className="font-serif text-lg text-charcoal">Earn 20% on Your Friends&apos; Orders</h3>
            </div>
            <p className="text-xs text-charcoal/70 leading-relaxed">
              Share your personal referral code with friends. They will get <strong className="text-maroon">10% off</strong> on orders above ₹500, and you will earn <strong className="text-maroon">20% of their cart value</strong> in store credit!
            </p>
            <div className="flex items-center gap-2 pt-1">
              <span className="px-3 py-1.5 bg-white border border-border rounded-lg font-mono text-xs font-bold text-maroon">
                {myCode}
              </span>
              <a
                href={`https://api.whatsapp.com/send?text=${whatsappShare}`}
                target="_blank"
                rel="noopener noreferrer"
                className="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 bg-[#25D366] text-white text-xs font-sans font-semibold rounded-lg hover:bg-[#25D366]/90 transition"
              >
                <span>💬 Share on WhatsApp</span>
              </a>
            </div>
          </div>

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
                <div className="flex items-center justify-between">
                  <h2 className="font-serif text-lg text-charcoal">1. Delivery Destination</h2>
                  {locationResult && locationResult.serviceable && (
                    <span className="text-[11px] font-sans font-medium text-success flex items-center gap-1">
                      <span>✓</span>
                      <span>{locationResult.expressAvailable ? "24–48h Express Air" : "3–5 Days Courier"}</span>
                    </span>
                  )}
                </div>

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
                      value={shippingCity}
                      onChange={(e) => setShippingCity(e.target.value)}
                      className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                    />
                  </div>
                  <div>
                    <label className="block text-charcoal/70 mb-1 font-medium">PIN Code</label>
                    <input
                      type="text"
                      maxLength={6}
                      value={shippingPin}
                      onChange={(e) => setShippingPin(e.target.value.replace(/[^0-9]/g, ""))}
                      onBlur={handlePinBlur}
                      className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                    />
                  </div>
                </div>

                {locationResult && !locationResult.serviceable && (
                  <div className="p-3 bg-danger/10 border border-danger/30 rounded-lg text-xs text-danger font-sans">
                    {locationResult.message}
                  </div>
                )}
              </div>

              {/* Payment Method */}
              <div className="bg-sand/40 border border-border rounded-xl p-6 space-y-4">
                <h2 className="font-serif text-lg text-charcoal">2. Payment Method</h2>
                <div className="space-y-2.5">
                  {[
                    { id: "upi", label: "UPI Instant (Google Pay / PhonePe / Paytm / BHIM)", badge: "Fastest" },
                    { id: "card", label: "Credit / Debit Card (Visa, Mastercard, RuPay, Amex)", badge: "Instant" },
                    { id: "netbanking", label: "NetBanking (HDFC, ICICI, SBI, Axis, etc.)" },
                    { id: "cod", label: "Cash on Delivery (Standard Verification Required)", disabled: Boolean(locationResult && !locationResult.codAvailable) },
                  ].map((method) => (
                    <label
                      key={method.id}
                      className={`
                        flex items-center justify-between p-3.5 rounded-lg border text-xs font-sans transition-all
                        ${method.disabled ? "opacity-50 cursor-not-allowed bg-sand/20" : "cursor-pointer"}
                        ${paymentMethod === method.id ? "bg-white border-maroon shadow-xs ring-1 ring-maroon" : "bg-white/60 border-border hover:bg-white"}
                      `}
                    >
                      <div className="flex items-center gap-3">
                        <input
                          type="radio"
                          name="payment"
                          disabled={method.disabled}
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

                {/* Referral Code Box */}
                <div className="p-3.5 bg-white/80 border border-border/80 rounded-xl space-y-2 text-xs font-sans">
                  <div className="flex items-center justify-between">
                    <span className="font-semibold text-charcoal flex items-center gap-1.5">
                      <span>🎁</span>
                      <span>Have a Referral Code?</span>
                    </span>
                    <span className="text-[10px] text-gold font-semibold uppercase tracking-wider">
                      Flat 10% Off
                    </span>
                  </div>

                  {appliedReferral ? (
                    <div className="p-2.5 bg-success/10 border border-success/30 rounded-lg flex items-center justify-between">
                      <div>
                        <p className="font-semibold text-success">
                          Code &ldquo;{appliedReferral.code}&rdquo; Applied
                        </p>
                        <p className="text-[11px] text-charcoal/70">
                          10% discount (-₹{appliedReferral.discountAmount}) · Referrer earns 20% credit
                        </p>
                      </div>
                      <button
                        type="button"
                        onClick={handleRemoveReferral}
                        className="text-xs text-charcoal/50 hover:text-danger underline ml-2 cursor-pointer"
                      >
                        Remove
                      </button>
                    </div>
                  ) : (
                    <form onSubmit={handleApplyReferral} className="flex gap-2">
                      <input
                        type="text"
                        value={referralInput}
                        onChange={(e) => setReferralInput(e.target.value.toUpperCase())}
                        placeholder="Enter code (e.g. HENLEY-ANANYA)"
                        className="flex-1 px-3 py-1.5 bg-white border border-border rounded-lg uppercase font-mono text-xs text-charcoal placeholder:text-charcoal/40 focus:outline-none focus:border-maroon"
                      />
                      <button
                        type="submit"
                        disabled={isApplyingReferral || !referralInput}
                        className="px-3 py-1.5 bg-maroon text-ivory rounded-lg text-xs font-semibold hover:bg-maroon/90 disabled:opacity-50 transition cursor-pointer"
                      >
                        {isApplyingReferral ? "..." : "Apply"}
                      </button>
                    </form>
                  )}

                  {referralError && (
                    <p className="text-[11px] text-danger">{referralError}</p>
                  )}
                </div>

                {/* Customer Store Credit Wallet Option */}
                {walletBalance > 0 && (
                  <div className="p-3.5 bg-sand/40 border border-border/80 rounded-xl space-y-2 text-xs font-sans">
                    <label className="flex items-center justify-between cursor-pointer">
                      <div className="flex items-center gap-2">
                        <input
                          type="checkbox"
                          checked={useWalletCredit}
                          onChange={(e) => setUseWalletCredit(e.target.checked)}
                          className="rounded text-maroon focus:ring-maroon"
                        />
                        <span className="font-semibold text-charcoal">Use Store Credit Wallet</span>
                      </div>
                      <span className="font-mono font-bold text-maroon">
                        Available: ₹{walletBalance.toLocaleString("en-IN")}
                      </span>
                    </label>
                  </div>
                )}

                {/* Cost Breakdown */}
                <div className="space-y-2 pt-3 border-t border-border text-xs font-sans">
                  <div className="flex justify-between text-charcoal/70">
                    <span>Subtotal</span>
                    <span className="font-mono">{numericSubtotal > 0 ? (subtotal || `₹${numericSubtotal.toLocaleString("en-IN")}`) : "₹1,999 (Sample Allocation)"}</span>
                  </div>

                  {referralDiscount > 0 && (
                    <div className="flex justify-between text-success font-medium">
                      <span>Referral Welcome Discount (10%)</span>
                      <span className="font-mono">-₹{referralDiscount.toLocaleString("en-IN")}</span>
                    </div>
                  )}

                  <div className="flex justify-between text-charcoal/70">
                    <span>Shipping</span>
                    <span className="font-mono">{shippingCost === 0 ? "FREE" : `₹${shippingCost}`}</span>
                  </div>

                  <div className="flex justify-between text-charcoal/70">
                    <span>Estimated GST (5%)</span>
                    <span className="font-mono">₹{taxAmount.toLocaleString("en-IN")}</span>
                  </div>

                  {appliedWalletCredit > 0 && (
                    <div className="flex justify-between text-maroon font-medium">
                      <span>Store Credit Applied</span>
                      <span className="font-mono">-₹{appliedWalletCredit.toLocaleString("en-IN")}</span>
                    </div>
                  )}

                  <div className="flex justify-between text-sm font-semibold text-charcoal pt-2 border-t border-border/60">
                    <span>Total Amount</span>
                    <span className="font-serif text-lg text-maroon">₹{grandTotal.toLocaleString("en-IN")}</span>
                  </div>
                </div>

                <Button
                  variant="primary"
                  className="w-full !h-12 !text-xs !tracking-wider"
                  onClick={() => {
                    if (appliedWalletCredit > 0) {
                      deductWalletCredit(appliedWalletCredit, "Used at checkout for Order HNL-2026-8819");
                    }
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
