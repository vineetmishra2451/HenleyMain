"use client";

import React, { useState } from "react";
import AuthCard from "./AuthCard";
import WhatsAppOTP from "./WhatsAppOTP";
import Button from "../Button";

/* ================================================================
   LOGIN SCREEN (<LoginPage />)
   ================================================================
   - Primary: WhatsApp OTP (Phone + 6-digit verification)
   - Secondary (Collapsed): Email + Password
   - Footer: Link to /register
   ================================================================ */

export default function LoginPage() {
  const [showEmailAuth, setShowEmailAuth] = useState(false);
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [errors, setErrors] = useState<{ [key: string]: string }>({});
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  const handleEmailLogin = (e: React.FormEvent) => {
    e.preventDefault();
    const newErrors: { [key: string]: string } = {};

    if (!email || !/\S+@\S+\.\S+/.test(email)) {
      newErrors.email = "Please enter a valid email address.";
    }
    if (!password || password.length < 6) {
      newErrors.password = "Password must be at least 6 characters.";
    }

    if (Object.keys(newErrors).length > 0) {
      setErrors(newErrors);
      return;
    }

    setErrors({});
    setIsSubmitting(true);

    setTimeout(() => {
      setIsSubmitting(false);
      setIsLoggedIn(true);
    }, 700);
  };

  if (isLoggedIn) {
    return (
      <AuthCard
        title="Welcome Back"
        subtitle="You have successfully signed into your Henley account."
        activeScreen="login"
      >
        <div className="text-center py-4 space-y-4">
          <div className="w-12 h-12 mx-auto rounded-full bg-success/15 text-success flex items-center justify-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
              <polyline points="20 6 9 17 4 12" />
            </svg>
          </div>
          <p className="text-xs font-sans text-charcoal/70">
            Signed in as <span className="font-semibold text-charcoal">{email}</span>
          </p>
          <Button
            variant="primary"
            className="w-full"
            onClick={() => (window.location.href = "/collections")}
          >
            Continue to Apothecary →
          </Button>
        </div>
      </AuthCard>
    );
  }

  return (
    <AuthCard
      eyebrow="Apothecary Sign In"
      title="Access Your Ritual"
      subtitle="Sign in to track orders, manage subscriptions, and unlock reserve harvests."
      activeScreen="login"
      footer={
        <p className="text-charcoal/60">
          New to Henley?{" "}
          <a href="/register" className="text-maroon font-semibold hover:underline">
            Create an account
          </a>
        </p>
      }
    >
      {/* ── Primary Sign-In Path: WhatsApp OTP ── */}
      <WhatsAppOTP mode="login" />

      {/* ── Divider ── */}
      <div className="relative my-4">
        <div className="absolute inset-0 flex items-center">
          <div className="w-full border-t border-border/80" />
        </div>
        <div className="relative flex justify-center text-[10px] uppercase font-sans tracking-wider">
          <span className="bg-sand/60 px-2 text-charcoal/40">or</span>
        </div>
      </div>

      {/* ── Secondary Path: Collapsible Email Login ── */}
      <div className="pt-1">
        {!showEmailAuth ? (
          <button
            type="button"
            onClick={() => setShowEmailAuth(true)}
            className="w-full text-center text-xs font-sans text-charcoal/70 hover:text-maroon transition-colors py-2 flex items-center justify-center gap-1.5 cursor-pointer group"
          >
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
            <span className="underline underline-offset-2">Log in with email instead</span>
            <span className="text-[10px] text-charcoal/40 group-hover:text-maroon">▾</span>
          </button>
        ) : (
          <form onSubmit={handleEmailLogin} className="space-y-3.5 pt-2 animate-slide-in-up">
            <div className="flex items-center justify-between pb-1">
              <span className="text-[11px] font-sans font-semibold uppercase tracking-wider text-charcoal/60">
                Email Authentication
              </span>
              <button
                type="button"
                onClick={() => setShowEmailAuth(false)}
                className="text-[11px] font-sans text-charcoal/40 hover:text-maroon cursor-pointer"
              >
                Hide email fields ▴
              </button>
            </div>

            {/* Email Field */}
            <div className="space-y-1">
              <label className="block text-xs font-sans font-medium uppercase tracking-[0.08em] text-charcoal/70">
                Email Address
              </label>
              <input
                type="email"
                value={email}
                onChange={(e) => {
                  setEmail(e.target.value);
                  setErrors((prev) => ({ ...prev, email: "" }));
                }}
                placeholder="alexandra@botanical.com"
                className={`
                  w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border bg-white text-charcoal
                  placeholder:text-charcoal/35 focus:outline-none transition-all
                  ${
                    errors.email
                      ? "border-error bg-error/5 focus:border-error"
                      : "border-border focus:border-maroon focus:ring-1 focus:ring-maroon/20"
                  }
                `}
              />
              {errors.email && (
                <p className="text-[11px] font-sans text-error">{errors.email}</p>
              )}
            </div>

            {/* Password Field */}
            <div className="space-y-1">
              <div className="flex items-center justify-between">
                <label className="block text-xs font-sans font-medium uppercase tracking-[0.08em] text-charcoal/70">
                  Password
                </label>
                <a
                  href="/forgot-password"
                  className="text-[11px] font-sans text-maroon hover:underline"
                >
                  Forgot password?
                </a>
              </div>
              <input
                type="password"
                value={password}
                onChange={(e) => {
                  setPassword(e.target.value);
                  setErrors((prev) => ({ ...prev, password: "" }));
                }}
                placeholder="••••••••"
                className={`
                  w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border bg-white text-charcoal
                  placeholder:text-charcoal/35 focus:outline-none transition-all
                  ${
                    errors.password
                      ? "border-error bg-error/5 focus:border-error"
                      : "border-border focus:border-maroon focus:ring-1 focus:ring-maroon/20"
                  }
                `}
              />
              {errors.password && (
                <p className="text-[11px] font-sans text-error">{errors.password}</p>
              )}
            </div>

            {/* Submit Email Login */}
            <Button
              type="submit"
              variant="secondary"
              className="w-full !py-2.5 !text-xs"
              disabled={isSubmitting}
            >
              {isSubmitting ? "Signing in..." : "Log In with Email →"}
            </Button>
          </form>
        )}
      </div>
    </AuthCard>
  );
}
