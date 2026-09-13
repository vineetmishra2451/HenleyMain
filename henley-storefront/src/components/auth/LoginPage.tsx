"use client";

import React, { useState, useEffect } from "react";
import AuthCard from "./AuthCard";
import WhatsAppOTP from "./WhatsAppOTP";
import Button from "../Button";
import AccountDashboard from "../AccountDashboard";
import {
  getAuthenticatedUser,
  loginUser,
  logoutUser,
  DEFAULT_DEMO_USER,
  AuthUser,
} from "@/utils/authService";

export interface LoginPageProps {
  onLoginSuccess?: (user: AuthUser) => void;
}

export default function LoginPage({ onLoginSuccess }: LoginPageProps = {}) {
  const [currentUser, setCurrentUser] = useState<AuthUser | null>(null);
  const [showEmailAuth, setShowEmailAuth] = useState(false);
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [errors, setErrors] = useState<{ [key: string]: string }>({});
  const [isSubmitting, setIsSubmitting] = useState(false);

  useEffect(() => {
    const user = getAuthenticatedUser();
    if (user) {
      setCurrentUser(user);
    }

    const handleAuthChange = (e: Event) => {
      const custom = e as CustomEvent<AuthUser | null>;
      setCurrentUser(custom.detail);
    };
    window.addEventListener("henley-auth-changed", handleAuthChange);
    return () => window.removeEventListener("henley-auth-changed", handleAuthChange);
  }, []);

  const triggerLoginSuccess = (userData: Partial<AuthUser> = {}) => {
    const user = loginUser(userData);
    setCurrentUser(user);
    if (onLoginSuccess) {
      onLoginSuccess(user);
    }
  };

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
      triggerLoginSuccess({
        email: email,
        name: email.split("@")[0].replace(/[._]/g, " ").replace(/\b\w/g, (c) => c.toUpperCase()),
      });
    }, 500);
  };

  // If already authenticated or logged in, render the full Account Dashboard!
  if (currentUser) {
    return <AccountDashboard user={currentUser} onLogout={() => setCurrentUser(null)} />;
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
      {/* ── Demo 1-Click Collector Access ── */}
      <div className="mb-4">
        <button
          type="button"
          onClick={() => triggerLoginSuccess(DEFAULT_DEMO_USER)}
          className="w-full py-2.5 px-3 rounded-xl border border-gold/50 bg-sand/40 hover:bg-sand text-xs font-sans text-charcoal font-semibold flex items-center justify-center gap-2 transition cursor-pointer shadow-2xs group"
        >
          <span className="text-gold font-bold">⚡</span>
          <span className="group-hover:text-maroon transition-colors">
            Instant Demo Sign In (Ananya Singhal · Patron)
          </span>
          <span className="text-gold text-[11px]">→</span>
        </button>
      </div>

      {/* ── Primary Sign-In Path: WhatsApp OTP ── */}
      <WhatsAppOTP
        mode="login"
        onSuccess={(data) => {
          triggerLoginSuccess({
            phone: data.phone,
            name: data.name || "Ananya Singhal",
          });
        }}
      />

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
                onChange={(e) => setEmail(e.target.value)}
                placeholder="ananya.singhal@example.com"
                className={`
                  w-full h-11 px-3.5 bg-white border rounded-xl text-xs font-sans text-charcoal
                  placeholder:text-charcoal/40 focus:outline-none focus:border-maroon
                  ${errors.email ? "border-danger ring-1 ring-danger" : "border-border"}
                `}
              />
              {errors.email && (
                <p className="text-[11px] font-sans text-danger">{errors.email}</p>
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
                onChange={(e) => setPassword(e.target.value)}
                placeholder="••••••••"
                className={`
                  w-full h-11 px-3.5 bg-white border rounded-xl text-xs font-sans text-charcoal
                  placeholder:text-charcoal/40 focus:outline-none focus:border-maroon
                  ${errors.password ? "border-danger ring-1 ring-danger" : "border-border"}
                `}
              />
              {errors.password && (
                <p className="text-[11px] font-sans text-danger">{errors.password}</p>
              )}
            </div>

            <Button
              variant="primary"
              type="submit"
              disabled={isSubmitting}
              className="w-full !h-11 !text-xs !tracking-wider"
            >
              {isSubmitting ? "Authenticating..." : "Sign In with Password →"}
            </Button>
          </form>
        )}
      </div>
    </AuthCard>
  );
}
