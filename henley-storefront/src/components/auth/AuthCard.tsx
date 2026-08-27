"use client";

import React from "react";
import Logo from "../Logo";

/* ================================================================
   AUTH CARD SHELL (<AuthCard />)
   ================================================================
   - Centered single-column shell (max-w ~420px)
   - Background: Ivory with subtle atmospheric lighting
   - Centered <Logo size="sm" /> on top
   - Sand card with generous padding (p-8 sm:p-10), subtle shadow
   - Serif display title + Inter eyebrow / subtitle
   - Reusable footer note/link
   ================================================================ */

export interface AuthCardProps {
  title: string;
  subtitle?: string;
  eyebrow?: string;
  children: React.ReactNode;
  footer?: React.ReactNode;
  showPreviewNav?: boolean;
  activeScreen?: "login" | "register" | "verify-email" | "forgot-password" | "reset-password";
}

export default function AuthCard({
  title,
  subtitle,
  eyebrow,
  children,
  footer,
  showPreviewNav = true,
  activeScreen,
}: AuthCardProps) {
  return (
    <div className="min-h-screen bg-ivory flex flex-col justify-between py-8 px-4 sm:px-6">
      {/* ── Optional Dev / Reviewer Screen Switcher ── */}
      {showPreviewNav && (
        <div className="w-full max-w-xl mx-auto mb-6 bg-sand/80 border border-border rounded-full p-1 shadow-subtle flex items-center justify-between text-[11px] overflow-x-auto scrollbar-none">
          <span className="font-mono font-semibold uppercase tracking-wider text-charcoal/50 px-3 hidden sm:inline">
            Auth Flow:
          </span>
          <div className="flex items-center gap-1 w-full sm:w-auto justify-center">
            {[
              { id: "login", label: "1. Login", href: "/login" },
              { id: "register", label: "2. Register", href: "/register" },
              { id: "verify-email", label: "3. Verify Email", href: "/verify-email" },
              { id: "forgot-password", label: "4. Forgot Pwd", href: "/forgot-password" },
              { id: "reset-password", label: "5. Reset Pwd", href: "/reset-password" },
            ].map((s) => (
              <a
                key={s.id}
                href={s.href}
                className={`
                  px-2.5 py-1 rounded-full font-sans font-medium transition-all whitespace-nowrap
                  ${
                    activeScreen === s.id
                      ? "bg-maroon text-ivory shadow-xs"
                      : "text-charcoal/70 hover:text-maroon hover:bg-white/60"
                  }
                `}
              >
                {s.label}
              </a>
            ))}
          </div>
        </div>
      )}

      {/* ── Main Centered Card Container ── */}
      <div className="w-full max-w-[420px] mx-auto my-auto space-y-6">
        {/* Logo centered above card */}
        <div className="flex flex-col items-center justify-center text-center space-y-2">
          <a href="/" aria-label="Henley Home" className="inline-block transition-transform hover:scale-105">
            <Logo size="sm" />
          </a>
        </div>

        {/* Sand Card */}
        <div className="bg-sand/60 rounded-2xl border border-border p-7 sm:p-9 shadow-card space-y-6 backdrop-blur-xs">
          {/* Card Header */}
          <div className="text-center space-y-1.5">
            {eyebrow && (
              <p className="text-eyebrow text-gold font-medium tracking-[0.14em]">
                {eyebrow}
              </p>
            )}
            <h1 className="font-serif text-2xl sm:text-3xl text-charcoal font-normal tracking-tight">
              {title}
            </h1>
            {subtitle && (
              <p className="text-xs font-sans text-charcoal/65 leading-relaxed pt-0.5">
                {subtitle}
              </p>
            )}
          </div>

          {/* Form Content */}
          <div className="space-y-4">{children}</div>
        </div>

        {/* Footer Link / Note */}
        {footer && <div className="text-center text-xs font-sans">{footer}</div>}
      </div>

      {/* Bottom Privacy & Terms */}
      <div className="text-center pt-8 text-[11px] text-charcoal/40 font-sans">
        <span>© {new Date().getFullYear()} Henley Botanical Reserve. All rights reserved.</span>
      </div>
    </div>
  );
}
