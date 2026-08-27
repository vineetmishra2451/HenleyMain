"use client";

import React from "react";
import Link from "next/link";
import ArchFrame from "@/components/ArchFrame";
import Button from "@/components/Button";
import Header from "@/components/Header";
import Footer from "@/components/Footer";

export default function NotFound() {
  return (
    <div className="bg-ivory min-h-screen flex flex-col justify-between">
      <Header />

      <main className="flex-1 flex items-center justify-center py-16 lg:py-24 px-4">
        <div className="max-w-xl mx-auto text-center space-y-6">
          {/* Centered ArchFrame */}
          <div className="w-24 sm:w-28 mx-auto opacity-70">
            <ArchFrame variant="tall" className="!aspect-[3/4] shadow-card bg-sand/80 flex items-center justify-center">
              <span className="font-serif text-3xl sm:text-4xl text-maroon font-normal">
                404
              </span>
            </ArchFrame>
          </div>

          <div className="space-y-3">
            <p className="text-eyebrow text-gold font-medium tracking-[0.16em]">
              Pathway Uncharted
            </p>
            <h1 className="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal font-normal">
              Harvest Not Found
            </h1>
            <p className="text-xs sm:text-sm text-charcoal/65 max-w-md mx-auto leading-relaxed">
              The botanical archive or page you are seeking appears to have shifted with the seasons or does not exist in our sanctuary.
            </p>
          </div>

          {/* Quick Discover Links */}
          <div className="pt-2 pb-4">
            <p className="text-[11px] font-sans font-semibold uppercase tracking-wider text-charcoal/50 mb-3">
              Explore Our Reserves
            </p>
            <div className="flex flex-wrap items-center justify-center gap-2">
              {[
                { label: "All Reserves (22)", href: "/shop" },
                { label: "Tea (2)", href: "/collections?cat=tea" },
                { label: "Herbs & Spices (12)", href: "/collections?cat=herbs-spices" },
                { label: "About & Our Story", href: "/story" },
                { label: "Track Order", href: "/track-order" },
              ].map((link) => (
                <Link
                  key={link.href}
                  href={link.href}
                  className="px-3 py-1.5 rounded-full bg-sand/60 border border-border text-xs font-sans text-charcoal/70 hover:text-maroon hover:border-maroon/40 transition-colors"
                >
                  {link.label}
                </Link>
              ))}
            </div>
          </div>

          {/* Primary Return CTA */}
          <div className="flex flex-col sm:flex-row items-center justify-center gap-3">
            <Link href="/" className="w-full sm:w-auto">
              <Button
                variant="primary"
                className="w-full !px-8 !py-3 !text-xs !tracking-wider"
              >
                Return to Sanctuary →
              </Button>
            </Link>
            <Link href="/collections" className="w-full sm:w-auto">
              <Button
                variant="secondary"
                className="w-full !px-6 !py-3 !text-xs"
              >
                View Collections
              </Button>
            </Link>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
}
