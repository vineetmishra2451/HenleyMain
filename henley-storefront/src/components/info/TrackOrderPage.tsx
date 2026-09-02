"use client";

import React, { useState } from "react";
import ArchFrame from "../ArchFrame";
import PlaceholderImage from "../PlaceholderImage";
import Button from "../Button";
import Badge from "../Badge";
import { findProductBySlug } from "@/data/catalog";

/* ================================================================
   MOCK TRACK ORDER PAGE (<TrackOrderPage />)
   ================================================================
   Interactive luxury apothecary order tracker:
   1. Breadcrumbs + Page Header
   2. Order Lookup Card (Order # + Phone/Email) with pre-fill demo chip
   3. Live Tracking Status Card with:
      - Order status summary & pulse badge
      - 4-step interactive progress milestone rail
      - Timestamped carrier event log
      - Itemized package contents with INR pricing
      - Delivery address & carrier details
      - Concierge assistance action
   ================================================================ */

interface TrackedItem {
  id: string;
  name: string;
  variant: string;
  price: string;
  quantity: number;
}

interface TrackingMilestone {
  date: string;
  time: string;
  location: string;
  status: string;
  description: string;
  completed: boolean;
  current?: boolean;
}

export default function TrackOrderPage() {
  const [orderNumber, setOrderNumber] = useState("HNL-88492");
  const [contactInfo, setContactInfo] = useState("98765-43210");
  const [isSearching, setIsSearching] = useState(false);
  const [hasTracked, setHasTracked] = useState(true);

  // Mock Package Items
  const items: TrackedItem[] = [
    {
      id: "1",
      name: "Saffron",
      variant: "5g Porcelain Jar",
      price: "₹2,499",
      quantity: 1,
    },
    {
      id: "2",
      name: "Herb & Spice Tea",
      variant: "100g Jar",
      price: "₹1,299",
      quantity: 2,
    },
    {
      id: "3",
      name: "Cardamom",
      variant: "100g Jar",
      price: "₹1,499",
      quantity: 1,
    },
  ];

  // Mock Milestones
  const milestones: TrackingMilestone[] = [
    {
      date: "August 28, 2026",
      time: "08:45 AM",
      location: "Bangalore Hub, Karnataka",
      status: "Out for Delivery",
      description: "Package assigned to carbon-neutral electric courier vehicle. Expected delivery today by 4:00 PM.",
      completed: false,
      current: true,
    },
    {
      date: "August 27, 2026",
      time: "11:20 PM",
      location: "Delhi Airport Sorting Facility",
      status: "In Transit — Express Air",
      description: "Customs cleared and transferred onto overnight domestic express flight to Bangalore.",
      completed: true,
    },
    {
      date: "August 27, 2026",
      time: "03:15 PM",
      location: "London Botanical Sanctuary, UK",
      status: "Dispatched from Sanctuary",
      description: "Porcelain vessels sealed in temperature-stabilized biodegradable containers.",
      completed: true,
    },
    {
      date: "August 26, 2026",
      time: "10:30 AM",
      location: "Henley Apothecary Laboratory",
      status: "Order Confirmed & Artisan Blend Packed",
      description: "Fresh micro-lot batch inspected by master herbalist and verified with wax seal.",
      completed: true,
    },
  ];

  const handleTrack = (e: React.FormEvent) => {
    e.preventDefault();
    if (!orderNumber.trim()) return;

    setIsSearching(true);
    setTimeout(() => {
      setIsSearching(false);
      setHasTracked(true);
    }, 450);
  };

  const fillSampleOrder = (sampleId: string) => {
    setOrderNumber(sampleId);
    setContactInfo("98765-43210");
    setHasTracked(true);
  };

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
          <span className="text-charcoal font-medium">Track Order</span>
        </nav>
      </div>

      {/* ── Page Header ───────────────────────────────────────── */}
      <header className="henley-container py-8 lg:py-12 border-b border-border/80 text-center max-w-2xl mx-auto space-y-2">
        <p className="text-eyebrow text-gold font-medium tracking-[0.14em]">
          Consignment Tracking
        </p>
        <h1 className="font-serif text-3xl sm:text-4xl text-charcoal font-normal">
          Track Your Botanical Consignment
        </h1>
        <p className="text-xs sm:text-sm text-charcoal/65 leading-relaxed">
          Monitor your micro-lot harvests in real time from our temperature-controlled apothecary to your doorstep.
        </p>
      </header>

      {/* ── Main Container ────────────────────────────────────── */}
      <div className="henley-container py-8 lg:py-14 max-w-4xl mx-auto space-y-8">
        {/* ════════════════════════════════════════════════════════
            1. ORDER LOOKUP SEARCH CARD
           ════════════════════════════════════════════════════════ */}
        <div className="bg-white rounded-2xl border border-border p-6 sm:p-8 shadow-subtle space-y-4">
          <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-border/60 pb-4">
            <h2 className="font-sans font-semibold text-xs tracking-[0.12em] uppercase text-charcoal">
              Consignment Lookup
            </h2>
            <div className="flex items-center gap-2 text-xs font-sans text-charcoal/50">
              <span>Try sample:</span>
              <button
                type="button"
                onClick={() => fillSampleOrder("HNL-88492")}
                className="font-mono text-[11px] text-maroon hover:underline font-semibold bg-sand/60 px-2 py-0.5 rounded cursor-pointer"
              >
                #HNL-88492
              </button>
            </div>
          </div>

          <form onSubmit={handleTrack} className="grid grid-cols-1 sm:grid-cols-12 gap-3 pt-1">
            <div className="sm:col-span-5 space-y-1">
              <label className="block text-[11px] font-sans font-medium text-charcoal/70 uppercase tracking-wider">
                Order Number
              </label>
              <input
                type="text"
                value={orderNumber}
                onChange={(e) => setOrderNumber(e.target.value)}
                placeholder="e.g. HNL-88492"
                className="w-full px-3.5 py-2.5 text-xs font-mono rounded-lg border border-border bg-white text-charcoal placeholder:text-charcoal/35 focus:outline-none focus:border-maroon"
                required
              />
            </div>

            <div className="sm:col-span-4 space-y-1">
              <label className="block text-[11px] font-sans font-medium text-charcoal/70 uppercase tracking-wider">
                Mobile / Email
              </label>
              <input
                type="text"
                value={contactInfo}
                onChange={(e) => setContactInfo(e.target.value)}
                placeholder="98765-43210 or email"
                className="w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border border-border bg-white text-charcoal placeholder:text-charcoal/35 focus:outline-none focus:border-maroon"
                required
              />
            </div>

            <div className="sm:col-span-3 flex items-end">
              <Button
                type="submit"
                variant="primary"
                className="w-full !h-[42px] !text-xs !tracking-wider flex items-center justify-center gap-1.5"
                disabled={isSearching}
              >
                {isSearching ? (
                  <span>Searching...</span>
                ) : (
                  <>
                    <span>Track Order</span>
                    <span>→</span>
                  </>
                )}
              </Button>
            </div>
          </form>
        </div>

        {/* ════════════════════════════════════════════════════════
            2. ACTIVE CONSIGNMENT TRACKER RESULT
           ════════════════════════════════════════════════════════ */}
        {hasTracked && (
          <div className="space-y-6">
            {/* Status Summary Banner */}
            <div className="bg-sand/60 rounded-2xl border border-border p-6 sm:p-8 shadow-subtle space-y-6">
              <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-border pb-6">
                <div>
                  <div className="flex items-center gap-2.5">
                    <span className="font-mono text-sm font-bold text-charcoal">
                      #{orderNumber}
                    </span>
                    <span className="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-100 text-emerald-800 border border-emerald-300">
                      <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse" />
                      Out for Delivery
                    </span>
                  </div>
                  <p className="text-xs text-charcoal/60 mt-1 font-sans">
                    Placed on <span className="font-medium text-charcoal">Aug 26, 2026</span> via Carbon-Neutral Air
                  </p>
                </div>

                <div className="sm:text-right">
                  <p className="text-[11px] font-sans text-charcoal/50 uppercase tracking-wider">
                    Estimated Delivery
                  </p>
                  <p className="font-serif text-xl sm:text-2xl text-maroon font-semibold">
                    Today, by 4:00 PM
                  </p>
                </div>
              </div>

              {/* ── 4-Step Visual Progress Bar ── */}
              <div className="space-y-2 pt-2">
                <div className="grid grid-cols-4 gap-2 text-center text-[11px] font-sans font-medium text-charcoal">
                  <span className="text-emerald-700">1. Placed</span>
                  <span className="text-emerald-700">2. Artisan Sealed</span>
                  <span className="text-emerald-700">3. In Flight</span>
                  <span className="text-maroon font-bold">4. Out for Delivery</span>
                </div>

                <div className="relative h-2 bg-sand rounded-full overflow-hidden border border-border">
                  <div
                    className="h-full bg-maroon rounded-full transition-all duration-700"
                    style={{ width: "88%" }}
                  />
                </div>
              </div>
            </div>

            {/* Two-Column Grid: Left = Timeline, Right = Package Contents & Address */}
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
              {/* ── Left Column: Timestamped Carrier Milestones (7 Cols) ── */}
              <div className="lg:col-span-7 bg-white rounded-2xl border border-border p-6 sm:p-8 shadow-subtle space-y-6">
                <h3 className="font-serif text-xl text-charcoal pb-2 border-b border-border">
                  Shipment Activity
                </h3>

                <div className="relative pl-6 space-y-8 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-border">
                  {milestones.map((m, idx) => (
                    <div key={idx} className="relative space-y-1">
                      {/* Circle indicator */}
                      <span
                        className={`
                          absolute -left-[27px] top-1 w-4 h-4 rounded-full border-2 bg-white flex items-center justify-center
                          ${
                            m.current
                              ? "border-maroon ring-4 ring-maroon/20 bg-maroon"
                              : "border-emerald-600 bg-emerald-600"
                          }
                        `}
                      >
                        {!m.current && (
                          <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="4">
                            <polyline points="20 6 9 17 4 12" />
                          </svg>
                        )}
                      </span>

                      <div className="flex items-baseline justify-between text-xs font-sans">
                        <span
                          className={`font-semibold ${
                            m.current ? "text-maroon text-sm" : "text-charcoal"
                          }`}
                        >
                          {m.status}
                        </span>
                        <span className="font-mono text-[11px] text-charcoal/45">
                          {m.time}
                        </span>
                      </div>

                      <p className="text-[11px] font-sans font-medium text-charcoal/60">
                        {m.location} · {m.date}
                      </p>

                      <p className="text-xs font-sans text-charcoal/70 leading-relaxed pt-0.5">
                        {m.description}
                      </p>
                    </div>
                  ))}
                </div>
              </div>

              {/* ── Right Column: Package Items & Address (5 Cols) ── */}
              <div className="lg:col-span-5 space-y-6">
                {/* Package Items Card */}
                <div className="bg-white rounded-2xl border border-border p-6 shadow-subtle space-y-4">
                  <h3 className="font-serif text-lg text-charcoal pb-2 border-b border-border">
                    Items in Consignment ({items.length})
                  </h3>

                  <div className="divide-y divide-border/70">
                    {items.map((item) => (
                      <div key={item.id} className="py-3 flex items-center gap-3">
                        <div className="w-12 h-14 flex-shrink-0">
                          <PlaceholderImage
                            aspect="4:5"
                            label={item.name}
                            src={findProductBySlug(item.name)?.image}
                            alt={item.name}
                            className="!rounded-md"
                          />
                        </div>
                        <div className="flex-1 min-w-0">
                          <h4 className="font-serif text-xs font-medium text-charcoal truncate">
                            {item.name}
                          </h4>
                          <p className="text-[11px] font-sans text-charcoal/50">
                            {item.variant} · Qty: {item.quantity}
                          </p>
                        </div>
                        <span className="font-serif text-xs text-charcoal font-medium tabular-nums">
                          {item.price}
                        </span>
                      </div>
                    ))}
                  </div>

                  <div className="border-t border-border pt-3 flex items-center justify-between text-xs font-sans">
                    <span className="text-charcoal/60">Order Total (Paid):</span>
                    <span className="font-serif text-sm font-semibold text-charcoal">
                      ₹6,596
                    </span>
                  </div>
                </div>

                {/* Delivery Address & Carrier Card */}
                <div className="bg-sand/50 rounded-2xl border border-border p-6 shadow-subtle space-y-3 text-xs font-sans">
                  <h4 className="font-semibold uppercase tracking-wider text-[11px] text-charcoal pb-1 border-b border-border">
                    Delivery Details
                  </h4>

                  <div className="space-y-1 text-charcoal/70">
                    <p className="font-medium text-charcoal">Lady Alexandra Sterling</p>
                    <p>402 Lavelle Sanctuary Residencies</p>
                    <p>Lavelle Road, Bangalore, Karnataka 560001</p>
                    <p className="font-mono text-[11px] text-charcoal/50 pt-1">
                      Phone: +91 98765-43210
                    </p>
                  </div>

                  <div className="pt-2 border-t border-border/70 space-y-1">
                    <p className="text-[11px] text-charcoal/50">Courier Partner:</p>
                    <p className="font-medium text-charcoal flex items-center justify-between">
                      <span>Blue Dart Eco Air</span>
                      <span className="font-mono text-[10px] text-maroon font-semibold">
                        BD-9912048
                      </span>
                    </p>
                  </div>
                </div>

                {/* Concierge Help Box */}
                <div className="p-4 bg-white rounded-xl border border-border text-center space-y-2">
                  <p className="text-xs font-sans font-medium text-charcoal">
                    Need assistance with delivery?
                  </p>
                  <Button
                    variant="ghost"
                    className="!py-1.5 !px-3 !text-xs !text-maroon"
                    onClick={() => (window.location.href = "/contact")}
                  >
                    Contact Apothecary Concierge →
                  </Button>
                </div>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
