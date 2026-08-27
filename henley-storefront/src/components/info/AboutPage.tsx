"use client";

import React from "react";
import ArchFrame from "../ArchFrame";
import PlaceholderImage from "../PlaceholderImage";
import Button from "../Button";

/* ================================================================
   ABOUT HENLEY & OUR STORY (<AboutPage />)
   ================================================================
   Merged comprehensive narrative combining About Us and Our Story:
   1. Hero: full-width ArchFrame image + serif headline + intro paragraph
   2. Four narrative chapters:
      - Chapter I: The Ancestral Origin & Botanical Lineage
      - Chapter II: Sacred Sourcing & Single-Origin Terroirs
      - Chapter III: Traditional Stoneground Milling & Micro-Batching
      - Chapter IV: Porcelain Vessels & Zero-Plastic Stewardship
   3. Measurable commitments / stats row
   4. Call-to-action to explore collections
   ================================================================ */

export default function AboutPage() {
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
          <span className="text-charcoal font-medium">About Henley & Our Story</span>
        </nav>
      </div>

      {/* ════════════════════════════════════════════════════════
          1. HERO SECTION (Editorial ArchFrame Hero)
         ════════════════════════════════════════════════════════ */}
      <section className="py-10 lg:py-16 overflow-hidden">
        <div className="henley-container max-w-4xl mx-auto text-center space-y-6">
          <p className="text-eyebrow text-gold font-medium tracking-[0.16em]">
            About Henley · The Botanical Lineage
          </p>
          <h1 className="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal font-normal leading-tight">
            Cultivating Serenity Through Sacred Terroirs & Ancestral Purity
          </h1>
          <p className="text-sm sm:text-base text-charcoal/70 max-w-2xl mx-auto leading-relaxed">
            Founded on centuries of apothecary wisdom, Henley brings together single-estate orthodox teas,
            rare sun-cured spices, stoneground grains, and pure cocoa directly from protected mountain sanctuaries.
          </p>

          {/* Full-width ArchFrame Hero Placeholder */}
          <div className="pt-6 relative max-w-3xl mx-auto">
            <ArchFrame variant="wide" className="!aspect-[16/9] shadow-card">
              <PlaceholderImage
                aspect="16:9"
                label="Himalayan Tea Sanctuary & Morning Harvest Mist"
                className="w-full h-full"
              />
            </ArchFrame>
          </div>
        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          2. MERGED FOUR-CHAPTER EDITORIAL STORY
         ════════════════════════════════════════════════════════ */}
      <section className="py-12 lg:py-20 border-t border-border/70 space-y-16 lg:space-y-28">
        <div className="henley-container">

          {/* Chapter I: The Origin (Image Left / Text Right) */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
            <div className="lg:col-span-6 order-2 lg:order-1">
              <ArchFrame variant="tall" className="!aspect-[4/5] shadow-card">
                <PlaceholderImage
                  aspect="4:5"
                  label="Ancestral Botanical Drying Room & Copper Vats"
                  className="w-full h-full"
                />
              </ArchFrame>
            </div>
            <div className="lg:col-span-6 order-1 lg:order-2 space-y-4">
              <p className="text-eyebrow text-gold font-medium">Chapter I · The Origin</p>
              <h2 className="font-serif text-2xl sm:text-3xl text-charcoal leading-snug">
                Born in the High Mountain Shadows
              </h2>
              <p className="text-xs sm:text-sm text-charcoal/70 leading-relaxed">
                What began as a secluded apothecary laboratory in the foothills of the Himalayas has evolved into a sanctuary for unadulterated botanical artistry. Every leaf, seed, and grain is gathered at its seasonal peak of potency.
              </p>
              <p className="text-xs sm:text-sm text-charcoal/70 leading-relaxed">
                We reject mass industrial blending in favour of micro-lot estate harvests. We believe true nourishment begins when the sacred character of each ingredient is honored without synthetic shortcuts.
              </p>
              <div className="pt-2">
                <Button
                  variant="secondary"
                  className="!text-xs"
                  onClick={() => (window.location.href = "/collections")}
                >
                  Explore Our Reserves →
                </Button>
              </div>
            </div>
          </div>

          {/* Chapter II: Sourcing & Terroirs (Text Left / Image Right) */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
            <div className="lg:col-span-6 space-y-4">
              <p className="text-eyebrow text-gold font-medium">Chapter II · Sourcing Terroirs</p>
              <h2 className="font-serif text-2xl sm:text-3xl text-charcoal leading-snug">
                Single-Origin Purity & Direct Grower Partnerships
              </h2>
              <p className="text-xs sm:text-sm text-charcoal/70 leading-relaxed">
                Our whole spices and orthodox teas originate from multi-generational smallholder families in Idukki, Pampore, Meghalaya, and Darjeeling. By eliminating intermediate brokerages, we ensure growers receive premium remuneration above fair-market baselines.
              </p>
              <p className="text-xs sm:text-sm text-charcoal/70 leading-relaxed">
                From our Grade A1 Kashmiri Saffron hand-culled at sunrise to high-curcumin Lakadong turmeric and Tellicherry peppercorns, each reserve mirrors the untouched mineral richness of its mother soil.
              </p>
              <div className="flex items-center gap-4 pt-1 text-xs font-sans text-charcoal/60">
                <span>✓ 100% Traceable Single Estates</span>
                <span>✓ Direct Grower Fair Trade</span>
              </div>
            </div>
            <div className="lg:col-span-6">
              <ArchFrame variant="tall" className="!aspect-[4/5] shadow-card">
                <PlaceholderImage
                  aspect="4:5"
                  label="Grade A1 Saffron Hand-Culled in Pampore Valley"
                  className="w-full h-full"
                />
              </ArchFrame>
            </div>
          </div>

          {/* Chapter III: Stoneground Milling & Craft (Image Left / Text Right) */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
            <div className="lg:col-span-6 order-2 lg:order-1">
              <ArchFrame variant="wide" className="!aspect-[16/9] shadow-card">
                <PlaceholderImage
                  aspect="16:9"
                  label="Slow Stoneground Milling & Whole Grain Emery Stones"
                  className="w-full h-full"
                />
              </ArchFrame>
            </div>
            <div className="lg:col-span-6 order-1 lg:order-2 space-y-4">
              <p className="text-eyebrow text-gold font-medium">Chapter III · Artisanal Milling</p>
              <h2 className="font-serif text-2xl sm:text-3xl text-charcoal leading-snug">
                Slow-Speed Stone Milling on Natural Emery Wheels
              </h2>
              <p className="text-xs sm:text-sm text-charcoal/70 leading-relaxed">
                Industrial steel rollers generate friction heat that denatures vital wheat germ and essential oils. At Henley, our ancient Sharbati wheat, roasted chana dal besan, and yellow maize are cold-milled on traditional emery stones.
              </p>
              <p className="text-xs sm:text-sm text-charcoal/70 leading-relaxed">
                This slow, deliberate milling retains 100% of natural bran fiber, micronutrients, and deep roasted aroma, creating culinary textures celebrated by connoisseurs.
              </p>
            </div>
          </div>

          {/* Chapter IV: Sustainability & Vessels (Text Left / Image Right) */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
            <div className="lg:col-span-6 space-y-4">
              <p className="text-eyebrow text-gold font-medium">Chapter IV · Stewardship</p>
              <h2 className="font-serif text-2xl sm:text-3xl text-charcoal leading-snug">
                UV-Blocking Porcelain Vessels & Zero-Plastic Packaging
              </h2>
              <p className="text-xs sm:text-sm text-charcoal/70 leading-relaxed">
                Every Henley product is sealed in reusable UV-resistant bone porcelain or airtight apothecary glass. Plastic is eliminated across our supply chain, replaced by plant-based biodegradable envelopes.
              </p>
              <p className="text-xs sm:text-sm text-charcoal/70 leading-relaxed">
                Our processing studios operate entirely on solar micro-grids, offsetting 100% of our carbon footprint from harvest to delivery across India.
              </p>
              <div className="pt-2">
                <Button
                  variant="primary"
                  className="!text-xs"
                  onClick={() => (window.location.href = "/collections")}
                >
                  Experience the Harvests →
                </Button>
              </div>
            </div>
            <div className="lg:col-span-6">
              <ArchFrame variant="tall" className="!aspect-[4/5] shadow-card">
                <PlaceholderImage
                  aspect="4:5"
                  label="Handcrafted Porcelain Jars & Die-Cut Arch Cloches"
                  className="w-full h-full"
                />
              </ArchFrame>
            </div>
          </div>

        </div>
      </section>

      {/* ════════════════════════════════════════════════════════
          3. CLOSING STATS / TRUST FIGURES ROW
         ════════════════════════════════════════════════════════ */}
      <section className="bg-sand/60 border-t border-b border-border py-14 lg:py-20">
        <div className="henley-container">
          <div className="text-center max-w-xl mx-auto mb-10">
            <h2 className="font-serif text-2xl sm:text-3xl text-charcoal">
              Our Commitments in Numbers
            </h2>
            <p className="text-xs sm:text-sm text-charcoal/60 mt-1">
              Measurable integrity across every stage of our culinary apothecary.
            </p>
          </div>

          <div className="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 text-center divide-y sm:divide-y-0 sm:divide-x divide-border/80">
            {[
              { stat: "100%", label: "Certified Organic", sub: "Zero pesticides or synthetic flavorings" },
              { stat: "12+", label: "Estate Terroirs", sub: "Directly partnered grower families" },
              { stat: "0 g", label: "Single-Use Plastic", sub: "Infinitely recyclable porcelain & glass" },
              { stat: "100%", label: "Carbon Neutral", sub: "Solar powered apothecary studios" },
            ].map((item, idx) => (
              <div key={item.label} className={`space-y-1.5 ${idx > 0 ? "pt-4 sm:pt-0 sm:pl-4" : ""}`}>
                <p className="font-serif text-3xl sm:text-4xl lg:text-5xl text-maroon font-normal">
                  {item.stat}
                </p>
                <p className="font-sans font-semibold text-xs sm:text-sm text-charcoal">
                  {item.label}
                </p>
                <p className="text-[11px] text-charcoal/50 max-w-[180px] mx-auto">
                  {item.sub}
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
