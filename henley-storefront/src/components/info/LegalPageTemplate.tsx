"use client";

import React, { useState, useEffect } from "react";

/* ================================================================
   LEGAL PAGE TEMPLATE (<LegalPageTemplate />)
   ================================================================
   NOTE: This single, reusable template powers all legal documents
   across the storefront:
   - Privacy Policy (/privacy)
   - Terms & Conditions (/terms)
   - Shipping & Delivery Policy (/shipping)
   - Return & Refund Policy (/refunds)
   
   Only the document title, lastUpdated date, and sections array
   differ per legal page. The template automatically scales from
   short 4-section documents to extensive 10-section policies.
   ================================================================ */

export interface LegalSection {
  id: string;
  number: string;
  title: string;
  paragraphs: string[];
}

export interface LegalPageTemplateProps {
  title: string;
  lastUpdated?: string;
  description?: string;
  sections?: LegalSection[];
  activeDocument?: "terms" | "privacy" | "shipping" | "refunds";
}

// ── Default 10-Section Long Policy Data (e.g. Terms / Privacy) ──
export const LONG_LEGAL_SECTIONS: LegalSection[] = [
  {
    id: "section-1",
    number: "1.0",
    title: "Botanical Standards & Product Authenticity",
    paragraphs: [
      "All botanicals, teas, whole spices, and heirloom flours offered through Henley are cultivated in certified micro-lot estates and rigorously tested for purity. By accessing our platform, you acknowledge that seasonal harvest variations in aroma, color, and density are natural expressions of single-origin terroir.",
      "We reserve the right to limit harvest allocations per member to prevent unauthorized secondary commercial speculation.",
    ],
  },
  {
    id: "section-2",
    number: "2.0",
    title: "Account Registration & WhatsApp Authentication",
    paragraphs: [
      "Members may create an account using our primary WhatsApp One-Time Password (OTP) gateway or secondary email credentials. You are responsible for safeguarding your personal devices and notifying concierge immediately of unauthorized access.",
      "Henley will never ask for your 6-digit OTP outside our verified SSL-encrypted web interface.",
    ],
  },
  {
    id: "section-3",
    number: "3.0",
    title: "Pricing, Currency & Payment Security",
    paragraphs: [
      "All transactions are conducted in Indian Rupees (INR / ₹). Prices are inclusive of applicable packaging cloches and GST.",
      "Payments are processed through 256-bit PCI-DSS Level 1 certified gateways supporting UPI, RuPay, Visa, MasterCard, and NetBanking.",
    ],
  },
  {
    id: "section-4",
    number: "4.0",
    title: "Orders, Processing & Seasonal Reservations",
    paragraphs: [
      "Orders for ready-ship apothecary items are packed in temperature-stabilized containers and dispatched within 24 business hours. Private Reserve pre-orders (such as first flush Darjeeling harvests and Pampore saffron) will dispatch during their designated seasonal harvesting window.",
    ],
  },
  {
    id: "section-5",
    number: "5.0",
    title: "Carbon-Neutral Shipping & Domestic Transit",
    paragraphs: [
      "Standard shipping is carbon-neutral and complimentary on qualified orders over ₹1,999 across India. Express air consignments are available at checkout.",
    ],
  },
  {
    id: "section-6",
    number: "6.0",
    title: "30-Day Apothecary Satisfaction Guarantee & Returns",
    paragraphs: [
      "If any botanical reserve does not meet your expectations, you may request a replacement or refund within 30 days of confirmed delivery. Unopened porcelain containers and vacuum-sealed tins are eligible for prepaid return transit.",
    ],
  },
  {
    id: "section-7",
    number: "7.0",
    title: "Intellectual Property & Trademarks",
    paragraphs: [
      "The Henley name, crest, die-cut arch trademarks, bespoke apothecary packaging designs, and proprietary blending formulations are protected under international intellectual property conventions.",
    ],
  },
  {
    id: "section-8",
    number: "8.0",
    title: "Data Privacy & Member Confidentiality",
    paragraphs: [
      "We collect only necessary information required to fulfill your orders and dispatch harvest notifications. Member data is never sold, leased, or distributed to third-party advertising brokers.",
    ],
  },
  {
    id: "section-9",
    number: "9.0",
    title: "Limitation of Liability",
    paragraphs: [
      "Botanical infusions and culinary herbs are provided for dietary enjoyment and wellness rituals. Statements regarding herbal properties have not been evaluated by regulatory bodies and are not intended to diagnose, treat, or cure medical conditions.",
    ],
  },
  {
    id: "section-10",
    number: "10.0",
    title: "Governing Law & Dispute Resolution",
    paragraphs: [
      "These terms and conditions are governed by and construed in accordance with the laws of the United Kingdom and applicable international commercial arbitration statutes.",
    ],
  },
];

// ── Default 4-Section Short Policy Data (e.g. Shipping / Refunds) ──
export const SHORT_LEGAL_SECTIONS: LegalSection[] = [
  {
    id: "ship-sec-1",
    number: "1.0",
    title: "Dispatch Timelines & Packaging",
    paragraphs: [
      "All orders are processed from our climate-controlled botanical sanctuary within 24 business hours. Items are nestled in biodegradable pulp buffers and UV-resistant packaging.",
    ],
  },
  {
    id: "ship-sec-2",
    number: "2.0",
    title: "Complimentary Shipping Threshold",
    paragraphs: [
      "Orders of ₹1,999 or greater qualify for complimentary standard carbon-neutral delivery across India. Orders below ₹1,999 are charged a flat ₹149 standard shipping rate or ₹299 express air rate.",
    ],
  },
  {
    id: "ship-sec-3",
    number: "3.0",
    title: "Estimated Delivery Windows",
    paragraphs: [
      "Standard Delivery: 2–4 business days across continental zones. Express Dispatch: 1–2 business days with priority courier handoff.",
    ],
  },
  {
    id: "ship-sec-4",
    number: "4.0",
    title: "Damaged Shipments & Carrier Insurance",
    paragraphs: [
      "Every parcel is fully insured. In the unlikely event of transit breakage of porcelain jars, notify concierge within 48 hours for immediate express replacement.",
    ],
  },
];

export default function LegalPageTemplate({
  title = "Terms & Conditions",
  lastUpdated = "August 28, 2026",
  description = "Please review the guidelines governing the purchase of botanical reserves and membership at Henley.",
  sections = LONG_LEGAL_SECTIONS,
  activeDocument = "terms",
}: LegalPageTemplateProps) {
  const [activeSectionId, setActiveSectionId] = useState<string>(sections[0]?.id || "");

  // Update active TOC item on scroll
  useEffect(() => {
    const handleScroll = () => {
      const scrollPosition = window.scrollY + 180;
      for (const section of sections) {
        const el = document.getElementById(section.id);
        if (el) {
          const top = el.offsetTop;
          const height = el.offsetHeight;
          if (scrollPosition >= top && scrollPosition < top + height) {
            setActiveSectionId(section.id);
            break;
          }
        }
      }
    };

    window.addEventListener("scroll", handleScroll, { passive: true });
    return () => window.removeEventListener("scroll", handleScroll);
  }, [sections]);

  const scrollToSection = (id: string) => {
    const el = document.getElementById(id);
    if (el) {
      const yOffset = -120;
      const y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;
      window.scrollTo({ top: y, behavior: "smooth" });
      setActiveSectionId(id);
    }
  };

  return (
    <div className="bg-ivory min-h-screen">
      {/* ── Document Switcher Rail (For Reviewer / Dev) ── */}
      <div className="bg-sand/80 border-b border-border py-2 px-4 sticky top-[64px] lg:top-[72px] z-30 shadow-subtle backdrop-blur-sm">
        <div className="henley-container flex flex-wrap items-center justify-between gap-3 text-xs">
          <div className="flex items-center gap-2">
            <span className="font-mono font-semibold uppercase tracking-wider text-charcoal/50">
              Legal Documents:
            </span>
            <div className="flex bg-ivory rounded-full p-0.5 border border-border">
              {[
                { id: "terms", label: "Terms (10 Sec)", href: "/terms" },
                { id: "privacy", label: "Privacy (10 Sec)", href: "/privacy" },
                { id: "shipping", label: "Shipping (4 Sec)", href: "/shipping" },
              ].map((doc) => (
                <a
                  key={doc.id}
                  href={doc.href}
                  className={`
                    px-2.5 py-1 rounded-full font-sans font-medium transition-colors whitespace-nowrap
                    ${
                      activeDocument === doc.id
                        ? "bg-maroon text-ivory shadow-xs"
                        : "text-charcoal/70 hover:text-maroon"
                    }
                  `}
                >
                  {doc.label}
                </a>
              ))}
            </div>
          </div>
          <span className="text-charcoal/50 text-[11px] hidden sm:inline">
            Rendering {sections.length} sections
          </span>
        </div>
      </div>

      {/* ── Breadcrumb ── */}
      <div className="henley-container pt-6 pb-2">
        <nav
          aria-label="Breadcrumbs"
          className="flex items-center gap-2 text-xs font-sans text-charcoal/50"
        >
          <a href="/" className="hover:text-maroon transition-colors">
            Home
          </a>
          <span className="text-charcoal/30">/</span>
          <span className="text-charcoal font-medium">Legal</span>
          <span className="text-charcoal/30">/</span>
          <span className="text-charcoal font-medium">{title}</span>
        </nav>
      </div>

      {/* ── Page Header ── */}
      <header className="henley-container py-8 lg:py-12 border-b border-border/80 text-center max-w-2xl mx-auto space-y-2">
        <p className="text-eyebrow text-gold font-medium tracking-[0.14em]">
          Legal & Governance
        </p>
        <h1 className="font-serif text-3xl sm:text-4xl text-charcoal font-normal">
          {title}
        </h1>
        <p className="text-xs sm:text-sm text-charcoal/65 leading-relaxed">
          {description}
        </p>
        <p className="text-[11px] font-sans text-charcoal/45 pt-1">
          Last updated: <span className="font-medium text-charcoal/70">{lastUpdated}</span>
        </p>
      </header>

      {/* ── Mobile Jump Menu (Collapsible Jump Dropdown) ── */}
      <div className="lg:hidden henley-container py-4 border-b border-border/70 bg-sand/30">
        <label className="block text-[11px] font-sans font-semibold uppercase tracking-wider text-charcoal/60 mb-1">
          Jump to Section:
        </label>
        <select
          value={activeSectionId}
          onChange={(e) => scrollToSection(e.target.value)}
          className="w-full px-3 py-2 bg-white border border-border rounded-lg text-xs font-sans text-charcoal focus:outline-none focus:border-maroon"
        >
          {sections.map((sec) => (
            <option key={sec.id} value={sec.id}>
              {sec.number} {sec.title}
            </option>
          ))}
        </select>
      </div>

      {/* ── Two-Column Layout (Sticky TOC + Content) ── */}
      <div className="henley-container py-10 lg:py-16">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-start">
          {/* ════════════════════════════════════════════════════
              LEFT COLUMN: STICKY TABLE OF CONTENTS (4 Cols)
             ════════════════════════════════════════════════════ */}
          <aside className="hidden lg:block lg:col-span-4 lg:sticky lg:top-28 space-y-4">
            <div className="bg-sand/60 rounded-2xl border border-border p-6 shadow-subtle space-y-4">
              <h2 className="font-sans font-semibold text-xs tracking-[0.14em] uppercase text-charcoal pb-2 border-b border-border">
                Table of Contents ({sections.length})
              </h2>

              <nav className="space-y-1.5 max-h-[60vh] overflow-y-auto pr-1">
                {sections.map((sec) => {
                  const isActive = activeSectionId === sec.id;
                  return (
                    <button
                      key={sec.id}
                      onClick={() => scrollToSection(sec.id)}
                      className={`
                        w-full text-left px-3 py-2 rounded-lg text-xs font-sans transition-all flex items-start gap-2 cursor-pointer
                        ${
                          isActive
                            ? "bg-white text-maroon font-semibold shadow-xs border-l-2 border-maroon"
                            : "text-charcoal/70 hover:text-maroon hover:bg-white/50"
                        }
                      `}
                    >
                      <span className="font-mono text-[11px] opacity-60">
                        {sec.number}
                      </span>
                      <span className="leading-snug">{sec.title}</span>
                    </button>
                  );
                })}
              </nav>
            </div>

            {/* Concierge Help Note */}
            <div className="p-4 bg-white/60 rounded-xl border border-border/80 text-xs font-sans text-charcoal/60 space-y-1 text-center">
              <p className="font-medium text-charcoal">Questions about our policies?</p>
              <a href="/contact" className="text-maroon hover:underline font-semibold text-[11px]">
                Contact Legal Concierge →
              </a>
            </div>
          </aside>

          {/* ════════════════════════════════════════════════════
              RIGHT COLUMN: NUMBERED POLICY SECTIONS (8 Cols)
             ════════════════════════════════════════════════════ */}
          <main className="lg:col-span-8 bg-white rounded-2xl border border-border p-6 sm:p-10 shadow-subtle divide-y divide-border/80 space-y-8">
            {sections.map((sec, idx) => (
              <article
                key={sec.id}
                id={sec.id}
                className={`space-y-3 ${idx > 0 ? "pt-8" : ""}`}
              >
                <div className="flex items-baseline gap-2">
                  <span className="font-mono text-sm font-bold text-gold">
                    {sec.number}
                  </span>
                  <h3 className="font-serif text-xl sm:text-2xl text-charcoal">
                    {sec.title}
                  </h3>
                </div>

                <div className="space-y-3 text-xs sm:text-sm font-sans text-charcoal/75 leading-relaxed">
                  {sec.paragraphs.map((para, pIdx) => (
                    <p key={pIdx}>{para}</p>
                  ))}
                </div>
              </article>
            ))}
          </main>
        </div>
      </div>
    </div>
  );
}
