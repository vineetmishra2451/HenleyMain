"use client";

import React, { useState } from "react";
import AuthCard from "./AuthCard";
import Button from "../Button";

/* ================================================================
   FORGOT PASSWORD SCREEN (<ForgotPasswordPage />)
   ================================================================
   - Single email field + primary "Send Reset Link"
   - Link back to Login
   ================================================================ */

export default function ForgotPasswordPage() {
  const [email, setEmail] = useState("");
  const [error, setError] = useState("");
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [isSent, setIsSent] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!email || !/\S+@\S+\.\S+/.test(email)) {
      setError("Please enter a valid account email address.");
      return;
    }

    setError("");
    setIsSubmitting(true);

    setTimeout(() => {
      setIsSubmitting(false);
      setIsSent(true);
    }, 700);
  };

  return (
    <AuthCard
      eyebrow="Account Recovery"
      title="Reset Password"
      subtitle={
        isSent
          ? "Check your inbox for password reset instructions."
          : "Enter the email associated with your Henley account to receive a secure recovery link."
      }
      activeScreen="forgot-password"
      footer={
        <p className="text-charcoal/60">
          Remember your credentials?{" "}
          <a href="/login" className="text-maroon font-semibold hover:underline">
            Back to Sign In
          </a>
        </p>
      }
    >
      {isSent ? (
        <div className="text-center py-4 space-y-4 animate-fade-in">
          <div className="w-12 h-12 mx-auto rounded-full bg-success/15 text-success flex items-center justify-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
              <polyline points="20 6 9 17 4 12" />
            </svg>
          </div>
          <div className="p-3 bg-white/80 rounded-lg border border-border text-xs font-sans text-charcoal">
            Recovery link sent to <span className="font-semibold text-charcoal">{email}</span>
          </div>
          <p className="text-xs font-sans text-charcoal/60">
            If an account exists under this email, you will receive a reset link within a few minutes.
          </p>
          <div className="space-y-2 pt-2">
            <Button
              variant="primary"
              className="w-full !text-xs"
              onClick={() => (window.location.href = `/reset-password?email=${encodeURIComponent(email)}`)}
            >
              Simulate Resetting Password →
            </Button>
            <Button
              variant="ghost"
              className="w-full !border !border-border !text-xs"
              onClick={() => setIsSent(false)}
            >
              Try Another Email
            </Button>
          </div>
        </div>
      ) : (
        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="space-y-1.5">
            <label className="block text-xs font-sans font-semibold uppercase tracking-[0.1em] text-charcoal/70">
              Account Email Address
            </label>
            <input
              type="email"
              value={email}
              onChange={(e) => {
                setEmail(e.target.value);
                setError("");
              }}
              placeholder="alexandra@botanical.com"
              className={`
                w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border bg-white text-charcoal
                placeholder:text-charcoal/35 focus:outline-none transition-all
                ${
                  error
                    ? "border-error bg-error/5 focus:border-error"
                    : "border-border focus:border-maroon focus:ring-1 focus:ring-maroon/20"
                }
              `}
            />
            {error && <p className="text-[11px] font-sans text-error">{error}</p>}
          </div>

          <Button
            type="submit"
            variant="primary"
            className="w-full !h-12 !text-xs !tracking-wider flex items-center justify-center gap-2"
            disabled={isSubmitting}
          >
            {isSubmitting ? "Dispatching link..." : "Send Reset Link →"}
          </Button>

          <div className="text-center pt-1">
            <a
              href="/login"
              className="text-xs font-sans text-charcoal/60 hover:text-maroon underline transition-colors"
            >
              ← Back to Log In
            </a>
          </div>
        </form>
      )}
    </AuthCard>
  );
}
