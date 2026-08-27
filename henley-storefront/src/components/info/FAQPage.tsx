"use client";

import React, { useState, useMemo } from "react";
import Button from "../Button";

/* ================================================================
   FAQ SCREEN (<FAQPage />)
   ================================================================
   - Serif page title + search filter input
   - Grouped accordions by topic:
     1. Orders & Shipping
     2. Products & Ingredients
     3. Returns & Refunds
     4. Account & Membership
   - Interactive open/close state + instant search filtering
   ================================================================ */

interface FAQItem {
  id: string;
  q: string;
  a: string;
}

interface FAQCategory {
  title: string;
  slug: string;
  items: FAQItem[];
}

const FAQ_DATA: FAQCategory[] = [
  {
    title: "Orders & Shipping",
    slug: "shipping",
    items: [
      {
        id: "ship-1",
        q: "How long does standard delivery take?",
        a: "All orders are dispatched from our temperature-controlled apothecary within 24 hours. Standard carbon-neutral delivery typically arrives in 2–4 business days across North America and Western Europe.",
      },
      {
        id: "ship-2",
        q: "Do you offer complimentary shipping?",
        a: "Yes. Orders over ₹1,999 automatically qualify for complimentary insured standard shipping across India. A progress meter in your cart indicates how close you are to unlocking this benefit.",
      },
      {
        id: "ship-3",
        q: "How are the fragile porcelain jars and whole spices packaged?",
        a: "Every item is nestled inside custom biodegradable molded pulp buffers and cushioned in linen-feel unbleached kraft boxes to prevent temperature fluctuations and light degradation.",
      },
      {
        id: "ship-4",
        q: "Can I track my shipment internationally?",
        a: "Yes. Once dispatched, a live tracking link with carrier milestones is sent to your registered email and WhatsApp number.",
      },
    ],
  },
  {
    title: "Products & Ingredients",
    slug: "products",
    items: [
      {
        id: "prod-1",
        q: "Are all Henley botanicals, spices, and flours 100% organic?",
        a: "Every botanical ingredient is certified organic and tested for zero chemical pesticides, heavy metals, or artificial flavour additives. Our single-origin spices and teas come from certified biodynamic mountain estates.",
      },
      {
        id: "prod-2",
        q: "How should I store stoneground flours and whole spices?",
        a: "Keep all reserves in their UV-blocking porcelain jars in a cool, dry pantry away from direct sunlight and heat sources. Whole spices retain full potency for up to 24 months, while stoneground flours are best enjoyed within 6 months.",
      },
      {
        id: "prod-3",
        q: "What makes Grade A1 Kashmiri Saffron special?",
        a: "Our Mogra saffron consists solely of intact, dark crimson stigmas hand-picked at dawn in Pampore. It boasts unprecedented crocin concentrations (over 240+), yielding radiant golden infusions with just 2–3 strands.",
      },
      {
        id: "prod-4",
        q: "Are your teas caffeine-free?",
        a: "Our Herbal Infusions (such as Egyptian Chamomile and Holy Basil) are naturally 100% caffeine-free. Our black teas and first-flush Darjeeling contain gentle natural tea caffeine.",
      },
    ],
  },
  {
    title: "Returns & Refunds",
    slug: "returns",
    items: [
      {
        id: "ret-1",
        q: "What is your 30-day apothecary guarantee?",
        a: "If any blend or spice does not meet your discerning palate, contact our concierge within 30 days of receipt. We will arrange a complimentary exchange or full refund.",
      },
      {
        id: "ret-2",
        q: "How do I initiate a return?",
        a: "Simply email concierge@henleybotanicals.com with your order number. Our team will issue a pre-paid return shipping label within one business day.",
      },
      {
        id: "ret-3",
        q: "When will I receive my refund?",
        a: "Refunds are processed to your original payment method within 3–5 business days of item inspection at our facility.",
      },
    ],
  },
  {
    title: "Account & Membership",
    slug: "account",
    items: [
      {
        id: "acc-1",
        q: "Why is WhatsApp OTP used for sign-in?",
        a: "WhatsApp OTP provides instant, passwordless, 256-bit encrypted authentication directly to your mobile device without remembering complex passwords or waiting for delayed emails.",
      },
      {
        id: "acc-2",
        q: "Can I still sign in with traditional email and password?",
        a: "Yes. Both our Sign In and Register cards include a 'Log in with email instead' expandable option for members who prefer traditional credentials.",
      },
      {
        id: "acc-3",
        q: "How do I access Private Reserve first-flush allocations?",
        a: "Registered members receive priority access to seasonal micro-lots (such as spring first flush Darjeeling and autumn Pampore saffron) 48 hours before public release.",
      },
    ],
  },
];

export default function FAQPage() {
  const [searchQuery, setSearchQuery] = useState("");
  const [openItems, setOpenItems] = useState<{ [key: string]: boolean }>({
    "ship-1": true,
    "prod-1": true,
  });

  const toggleItem = (id: string) => {
    setOpenItems((prev) => ({ ...prev, [id]: !prev[id] }));
  };

  // Filtered FAQ categories based on search
  const filteredData = useMemo(() => {
    if (!searchQuery.trim()) return FAQ_DATA;
    const q = searchQuery.toLowerCase();

    return FAQ_DATA.map((cat) => ({
      ...cat,
      items: cat.items.filter(
        (item) =>
          item.q.toLowerCase().includes(q) || item.a.toLowerCase().includes(q)
      ),
    })).filter((cat) => cat.items.length > 0);
  }, [searchQuery]);

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
          <span className="text-charcoal font-medium">FAQ</span>
        </nav>
      </div>

      {/* ── Header & Search ───────────────────────────────────── */}
      <header className="henley-container py-8 lg:py-12 border-b border-border/80 text-center max-w-2xl mx-auto space-y-4">
        <p className="text-eyebrow text-gold font-medium tracking-[0.14em]">
          Knowledge Base
        </p>
        <h1 className="font-serif text-3xl sm:text-4xl text-charcoal font-normal">
          Frequently Asked Questions
        </h1>
        <p className="text-xs sm:text-sm text-charcoal/65 leading-relaxed max-w-lg mx-auto">
          Everything you need to know about our single-estate harvests, packaging, shipping, and member rituals.
        </p>

        {/* Search / Filter Input */}
        <div className="pt-2 max-w-md mx-auto relative">
          <input
            type="text"
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            placeholder="Search questions (e.g. shipping, saffron, return)..."
            className="
              w-full pl-10 pr-4 py-3 text-xs font-sans rounded-full
              bg-white border border-border text-charcoal placeholder:text-charcoal/40
              focus:outline-none focus:border-maroon focus:ring-1 focus:ring-maroon/20
              shadow-subtle transition-all
            "
          />
          <div className="absolute left-3.5 top-1/2 -translate-y-1/2 pt-1 text-charcoal/40 pointer-events-none">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </div>
          {searchQuery && (
            <button
              onClick={() => setSearchQuery("")}
              className="absolute right-3.5 top-1/2 -translate-y-1/2 pt-1 text-charcoal/40 hover:text-charcoal text-xs cursor-pointer"
            >
              Clear
            </button>
          )}
        </div>
      </header>

      {/* ── FAQ Accordion Groups ──────────────────────────────── */}
      <div className="henley-container py-10 lg:py-16 max-w-3xl mx-auto space-y-10">
        {filteredData.length === 0 ? (
          <div className="text-center py-16 bg-sand/30 rounded-xl border border-dashed border-border p-6 space-y-3">
            <h3 className="font-serif text-xl text-charcoal">No questions found</h3>
            <p className="text-xs font-sans text-charcoal/60 max-w-xs mx-auto">
              We couldn&apos;t find any answers matching &quot;{searchQuery}&quot;. Please contact our concierge team.
            </p>
            <Button
              variant="secondary"
              className="!text-xs"
              onClick={() => setSearchQuery("")}
            >
              Reset Search
            </Button>
          </div>
        ) : (
          filteredData.map((category) => (
            <div key={category.slug} className="space-y-3">
              <h2 className="font-serif text-xl sm:text-2xl text-charcoal pb-2 border-b border-border/80">
                {category.title}
              </h2>

              <div className="space-y-2.5">
                {category.items.map((item) => {
                  const isOpen = !!openItems[item.id] || !!searchQuery.trim();
                  return (
                    <div
                      key={item.id}
                      className="bg-white rounded-xl border border-border/70 overflow-hidden shadow-subtle transition-colors"
                    >
                      <button
                        onClick={() => toggleItem(item.id)}
                        className="w-full p-4 sm:p-5 text-left flex items-center justify-between gap-4 cursor-pointer hover:bg-sand/20 transition-colors"
                        aria-expanded={isOpen}
                      >
                        <span className="font-serif text-sm sm:text-base text-charcoal font-medium">
                          {item.q}
                        </span>
                        <span
                          className={`
                            w-6 h-6 rounded-full bg-sand/60 border border-border flex items-center justify-center text-charcoal/60 text-xs transition-transform duration-200 flex-shrink-0
                            ${isOpen ? "rotate-180 text-maroon bg-maroon/10 border-maroon/30" : ""}
                          `}
                        >
                          ▼
                        </span>
                      </button>

                      {isOpen && (
                        <div className="px-4 pb-5 sm:px-5 text-xs sm:text-sm font-sans text-charcoal/70 leading-relaxed border-t border-border/40 pt-3 animate-slide-in-up">
                          {item.a}
                        </div>
                      )}
                    </div>
                  );
                })}
              </div>
            </div>
          ))
        )}

        {/* ── Concierge Support Card ── */}
        <div className="p-6 sm:p-8 bg-sand/60 rounded-2xl border border-border text-center space-y-3 mt-12">
          <h3 className="font-serif text-xl text-charcoal">
            Have an Unanswered Question?
          </h3>
          <p className="text-xs font-sans text-charcoal/65 max-w-md mx-auto">
            Our master tea blenders and culinary curators are available for personalized guidance.
          </p>
          <div className="pt-2 flex justify-center gap-3">
            <Button
              variant="primary"
              className="!text-xs !py-2.5 !px-6"
              onClick={() => (window.location.href = "/contact")}
            >
              Contact Concierge →
            </Button>
          </div>
        </div>
      </div>
    </div>
  );
}
