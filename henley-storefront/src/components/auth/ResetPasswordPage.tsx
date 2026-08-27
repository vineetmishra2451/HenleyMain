"use client";

import React, { useState } from "react";
import AuthCard from "./AuthCard";
import Button from "../Button";

/* ================================================================
   RESET PASSWORD SCREEN (<ResetPasswordPage />)
   ================================================================
   - New password + Confirm password fields
   - Primary "Reset Password" button
   - Success state leading back to Login
   ================================================================ */

export default function ResetPasswordPage() {
  const [newPassword, setNewPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [errors, setErrors] = useState<{ [key: string]: string }>({});
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [isSuccess, setIsSuccess] = useState(false);

  const handleReset = (e: React.FormEvent) => {
    e.preventDefault();
    const newErrors: { [key: string]: string } = {};

    if (!newPassword || newPassword.length < 8) {
      newErrors.newPassword = "Password must contain at least 8 characters.";
    }
    if (newPassword !== confirmPassword) {
      newErrors.confirmPassword = "Passwords do not match.";
    }

    if (Object.keys(newErrors).length > 0) {
      setErrors(newErrors);
      return;
    }

    setErrors({});
    setIsSubmitting(true);

    setTimeout(() => {
      setIsSubmitting(false);
      setIsSuccess(true);
    }, 700);
  };

  return (
    <AuthCard
      eyebrow="Security & Credentials"
      title="Create New Password"
      subtitle={
        isSuccess
          ? "Your credentials have been securely updated."
          : "Please choose a strong password with at least 8 characters."
      }
      activeScreen="reset-password"
      footer={
        <p className="text-charcoal/60">
          Need help?{" "}
          <a href="/contact" className="text-maroon font-semibold hover:underline">
            Contact Support
          </a>
        </p>
      }
    >
      {isSuccess ? (
        <div className="text-center py-4 space-y-4 animate-fade-in">
          <div className="w-12 h-12 mx-auto rounded-full bg-success/15 text-success flex items-center justify-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
              <polyline points="20 6 9 17 4 12" />
            </svg>
          </div>
          <h3 className="font-serif text-xl text-charcoal">
            Password Updated
          </h3>
          <p className="text-xs font-sans text-charcoal/60 max-w-xs mx-auto">
            You can now sign in using your new credentials.
          </p>
          <Button
            variant="primary"
            className="w-full !mt-4"
            onClick={() => (window.location.href = "/login")}
          >
            Log In to Your Account →
          </Button>
        </div>
      ) : (
        <form onSubmit={handleReset} className="space-y-4">
          {/* New Password */}
          <div className="space-y-1.5">
            <label className="block text-xs font-sans font-semibold uppercase tracking-[0.1em] text-charcoal/70">
              New Password
            </label>
            <input
              type="password"
              value={newPassword}
              onChange={(e) => {
                setNewPassword(e.target.value);
                setErrors((prev) => ({ ...prev, newPassword: "" }));
              }}
              placeholder="At least 8 characters"
              className={`
                w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border bg-white text-charcoal
                placeholder:text-charcoal/35 focus:outline-none transition-all
                ${
                  errors.newPassword
                    ? "border-error bg-error/5 focus:border-error"
                    : "border-border focus:border-maroon focus:ring-1 focus:ring-maroon/20"
                }
              `}
            />
            {errors.newPassword && (
              <p className="text-[11px] font-sans text-error">{errors.newPassword}</p>
            )}
          </div>

          {/* Confirm Password */}
          <div className="space-y-1.5">
            <label className="block text-xs font-sans font-semibold uppercase tracking-[0.1em] text-charcoal/70">
              Confirm New Password
            </label>
            <input
              type="password"
              value={confirmPassword}
              onChange={(e) => {
                setConfirmPassword(e.target.value);
                setErrors((prev) => ({ ...prev, confirmPassword: "" }));
              }}
              placeholder="Repeat new password"
              className={`
                w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border bg-white text-charcoal
                placeholder:text-charcoal/35 focus:outline-none transition-all
                ${
                  errors.confirmPassword
                    ? "border-error bg-error/5 focus:border-error"
                    : "border-border focus:border-maroon focus:ring-1 focus:ring-maroon/20"
                }
              `}
            />
            {errors.confirmPassword && (
              <p className="text-[11px] font-sans text-error">{errors.confirmPassword}</p>
            )}
          </div>

          {/* Password guidelines */}
          <div className="p-3 bg-white/80 rounded-lg border border-border/70 text-[11px] font-sans text-charcoal/60 space-y-1">
            <p className="font-medium text-charcoal/80">Security Requirements:</p>
            <ul className="list-disc list-inside space-y-0.5 text-charcoal/60">
              <li className={newPassword.length >= 8 ? "text-success font-medium" : ""}>
                Minimum 8 characters
              </li>
              <li className={newPassword && newPassword === confirmPassword ? "text-success font-medium" : ""}>
                Passwords must match
              </li>
            </ul>
          </div>

          <Button
            type="submit"
            variant="primary"
            className="w-full !h-12 !text-xs !tracking-wider flex items-center justify-center gap-2"
            disabled={isSubmitting}
          >
            {isSubmitting ? "Updating credentials..." : "Reset Password →"}
          </Button>

          <div className="text-center pt-1">
            <a
              href="/login"
              className="text-xs font-sans text-charcoal/60 hover:text-maroon underline transition-colors"
            >
              ← Cancel and Return to Sign In
            </a>
          </div>
        </form>
      )}
    </AuthCard>
  );
}
