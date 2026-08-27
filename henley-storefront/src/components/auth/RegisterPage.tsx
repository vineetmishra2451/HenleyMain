"use client";

import React, { useState } from "react";
import AuthCard from "./AuthCard";
import WhatsAppOTP from "./WhatsAppOTP";
import Button from "../Button";

/* ================================================================
   REGISTER SCREEN (<RegisterPage />)
   ================================================================
   - Primary: WhatsApp OTP (Name + Phone + Terms + 6-digit verification)
   - Secondary (Collapsed): Name + Email + Password + Confirm Password
   - Footer: Link to /login
   ================================================================ */

export default function RegisterPage() {
  const [showEmailRegister, setShowEmailRegister] = useState(false);

  // Email form fields
  const [fullName, setFullName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [termsAccepted, setTermsAccepted] = useState(false);

  const [errors, setErrors] = useState<{ [key: string]: string }>({});
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleEmailRegister = (e: React.FormEvent) => {
    e.preventDefault();
    const newErrors: { [key: string]: string } = {};

    if (!fullName.trim()) newErrors.fullName = "Full name is required.";
    if (!email || !/\S+@\S+\.\S+/.test(email)) newErrors.email = "Please enter a valid email address.";
    if (!password || password.length < 8) newErrors.password = "Password must be at least 8 characters.";
    if (password !== confirmPassword) newErrors.confirmPassword = "Passwords do not match.";
    if (!termsAccepted) newErrors.terms = "You must agree to the Terms of Service & Privacy Policy.";

    if (Object.keys(newErrors).length > 0) {
      setErrors(newErrors);
      return;
    }

    setErrors({});
    setIsSubmitting(true);

    setTimeout(() => {
      setIsSubmitting(false);
      // Navigate to /verify-email with the entered email
      window.location.href = `/verify-email?email=${encodeURIComponent(email)}`;
    }, 700);
  };

  return (
    <AuthCard
      eyebrow="Join the Society"
      title="Create an Account"
      subtitle="Register to reserve seasonal first-flush tea harvests and rare single-origin spices."
      activeScreen="register"
      footer={
        <p className="text-charcoal/60">
          Already have an account?{" "}
          <a href="/login" className="text-maroon font-semibold hover:underline">
            Log in
          </a>
        </p>
      }
    >
      {/* ── Primary Sign-Up Path: WhatsApp OTP ── */}
      <WhatsAppOTP mode="register" />

      {/* ── Divider ── */}
      <div className="relative my-4">
        <div className="absolute inset-0 flex items-center">
          <div className="w-full border-t border-border/80" />
        </div>
        <div className="relative flex justify-center text-[10px] uppercase font-sans tracking-wider">
          <span className="bg-sand/60 px-2 text-charcoal/40">or</span>
        </div>
      </div>

      {/* ── Secondary Path: Collapsible Email Registration ── */}
      <div className="pt-1">
        {!showEmailRegister ? (
          <button
            type="button"
            onClick={() => setShowEmailRegister(true)}
            className="w-full text-center text-xs font-sans text-charcoal/70 hover:text-maroon transition-colors py-2 flex items-center justify-center gap-1.5 cursor-pointer group"
          >
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
            <span className="underline underline-offset-2">Sign up with email instead</span>
            <span className="text-[10px] text-charcoal/40 group-hover:text-maroon">▾</span>
          </button>
        ) : (
          <form onSubmit={handleEmailRegister} className="space-y-3 pt-2 animate-slide-in-up">
            <div className="flex items-center justify-between pb-1">
              <span className="text-[11px] font-sans font-semibold uppercase tracking-wider text-charcoal/60">
                Email Registration
              </span>
              <button
                type="button"
                onClick={() => setShowEmailRegister(false)}
                className="text-[11px] font-sans text-charcoal/40 hover:text-maroon cursor-pointer"
              >
                Hide email fields ▴
              </button>
            </div>

            {/* Name */}
            <div className="space-y-1">
              <label className="block text-xs font-sans font-medium uppercase tracking-[0.08em] text-charcoal/70">
                Full Name
              </label>
              <input
                type="text"
                value={fullName}
                onChange={(e) => {
                  setFullName(e.target.value);
                  setErrors((prev) => ({ ...prev, fullName: "" }));
                }}
                placeholder="Lady Alexandra"
                className={`
                  w-full px-3 py-2 text-xs font-sans rounded-lg border bg-white text-charcoal
                  placeholder:text-charcoal/35 focus:outline-none transition-all
                  ${
                    errors.fullName
                      ? "border-error bg-error/5 focus:border-error"
                      : "border-border focus:border-maroon"
                  }
                `}
              />
              {errors.fullName && (
                <p className="text-[11px] font-sans text-error">{errors.fullName}</p>
              )}
            </div>

            {/* Email */}
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
                  w-full px-3 py-2 text-xs font-sans rounded-lg border bg-white text-charcoal
                  placeholder:text-charcoal/35 focus:outline-none transition-all
                  ${
                    errors.email
                      ? "border-error bg-error/5 focus:border-error"
                      : "border-border focus:border-maroon"
                  }
                `}
              />
              {errors.email && (
                <p className="text-[11px] font-sans text-error">{errors.email}</p>
              )}
            </div>

            {/* Password */}
            <div className="space-y-1">
              <label className="block text-xs font-sans font-medium uppercase tracking-[0.08em] text-charcoal/70">
                Password
              </label>
              <input
                type="password"
                value={password}
                onChange={(e) => {
                  setPassword(e.target.value);
                  setErrors((prev) => ({ ...prev, password: "" }));
                }}
                placeholder="Min 8 characters"
                className={`
                  w-full px-3 py-2 text-xs font-sans rounded-lg border bg-white text-charcoal
                  placeholder:text-charcoal/35 focus:outline-none transition-all
                  ${
                    errors.password
                      ? "border-error bg-error/5 focus:border-error"
                      : "border-border focus:border-maroon"
                  }
                `}
              />
              {errors.password && (
                <p className="text-[11px] font-sans text-error">{errors.password}</p>
              )}
            </div>

            {/* Confirm Password */}
            <div className="space-y-1">
              <label className="block text-xs font-sans font-medium uppercase tracking-[0.08em] text-charcoal/70">
                Confirm Password
              </label>
              <input
                type="password"
                value={confirmPassword}
                onChange={(e) => {
                  setConfirmPassword(e.target.value);
                  setErrors((prev) => ({ ...prev, confirmPassword: "" }));
                }}
                placeholder="Repeat password"
                className={`
                  w-full px-3 py-2 text-xs font-sans rounded-lg border bg-white text-charcoal
                  placeholder:text-charcoal/35 focus:outline-none transition-all
                  ${
                    errors.confirmPassword
                      ? "border-error bg-error/5 focus:border-error"
                      : "border-border focus:border-maroon"
                  }
                `}
              />
              {errors.confirmPassword && (
                <p className="text-[11px] font-sans text-error">{errors.confirmPassword}</p>
              )}
            </div>

            {/* Terms Checkbox */}
            <div className="space-y-1 pt-1">
              <label className="flex items-start gap-2 cursor-pointer text-xs font-sans text-charcoal/70">
                <input
                  type="checkbox"
                  checked={termsAccepted}
                  onChange={(e) => {
                    setTermsAccepted(e.target.checked);
                    setErrors((prev) => ({ ...prev, terms: "" }));
                  }}
                  className="mt-0.5 rounded-xs border-border text-maroon focus:ring-maroon cursor-pointer"
                />
                <span className="text-[11px]">
                  I agree to the{" "}
                  <a href="/terms" className="text-maroon hover:underline font-medium">
                    Terms
                  </a>{" "}
                  &{" "}
                  <a href="/privacy" className="text-maroon hover:underline font-medium">
                    Privacy Policy
                  </a>
                  .
                </span>
              </label>
              {errors.terms && (
                <p className="text-[11px] font-sans text-error">{errors.terms}</p>
              )}
            </div>

            {/* Submit Email Register */}
            <Button
              type="submit"
              variant="secondary"
              className="w-full !py-2.5 !text-xs !mt-2"
              disabled={isSubmitting}
            >
              {isSubmitting ? "Creating Account..." : "Create Account with Email →"}
            </Button>
          </form>
        )}
      </div>
    </AuthCard>
  );
}
