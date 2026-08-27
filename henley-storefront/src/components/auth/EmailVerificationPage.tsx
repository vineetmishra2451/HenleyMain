"use client";

import React, { useState, useEffect } from "react";
import AuthCard from "./AuthCard";
import Button from "../Button";

/* ================================================================
   EMAIL VERIFICATION SCREEN (<EmailVerificationPage />)
   ================================================================
   - Only reached via the secondary email path
   - Centered state, envelope icon roundel, serif heading
   - Instruction referencing entered email
   - "Resend Email" ghost button with cooldown
   - "Change Email" link
   ================================================================ */

export interface EmailVerificationPageProps {
  email?: string;
}

export default function EmailVerificationPage({
  email = "alexandra@botanical.com",
}: EmailVerificationPageProps) {
  const [countdown, setCountdown] = useState(60);
  const [canResend, setCanResend] = useState(false);
  const [resendNotification, setResendNotification] = useState("");

  useEffect(() => {
    let timer: NodeJS.Timeout;
    if (countdown > 0) {
      timer = setInterval(() => {
        setCountdown((prev) => {
          if (prev <= 1) {
            setCanResend(true);
            return 0;
          }
          return prev - 1;
        });
      }, 1000);
    }
    return () => clearInterval(timer);
  }, [countdown]);

  const handleResend = () => {
    if (!canResend) return;
    setCountdown(60);
    setCanResend(false);
    setResendNotification("A new verification link has been dispatched to your inbox.");
    setTimeout(() => setResendNotification(""), 4000);
  };

  return (
    <AuthCard
      eyebrow="Account Activation"
      title="Verify Your Email"
      subtitle="We have dispatched a confidential activation link to your inbox."
      activeScreen="verify-email"
      footer={
        <p className="text-charcoal/60">
          Need assistance?{" "}
          <a href="/contact" className="text-maroon font-semibold hover:underline">
            Contact Concierge
          </a>
        </p>
      }
    >
      <div className="text-center py-2 space-y-5">
        {/* Envelope Icon Roundel */}
        <div className="w-16 h-16 mx-auto rounded-full bg-sand border-2 border-border/80 flex items-center justify-center text-gold shadow-subtle">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
            <polyline points="22,6 12,13 2,6" />
          </svg>
        </div>

        {/* Dynamic Email Box */}
        <div className="p-3.5 bg-white/80 rounded-xl border border-border space-y-1">
          <p className="text-xs font-sans text-charcoal/60">Activation link sent to:</p>
          <p className="text-sm font-sans font-semibold text-charcoal truncate">
            {email}
          </p>
        </div>

        <p className="text-xs font-sans text-charcoal/60 max-w-xs mx-auto leading-relaxed">
          Please check your inbox (and spam folder) and tap the link to confirm your membership.
        </p>

        {resendNotification && (
          <div className="p-2.5 bg-success/10 border border-success/30 rounded-lg text-xs font-sans text-success">
            {resendNotification}
          </div>
        )}

        {/* Actions */}
        <div className="space-y-3 pt-2">
          {/* Resend Email button with cooldown */}
          <Button
            variant="ghost"
            className="w-full !border !border-border !py-2.5 !text-xs"
            disabled={!canResend}
            onClick={handleResend}
          >
            {canResend ? (
              "Resend Email Link"
            ) : (
              <span>Resend Email (Cooldown 00:{countdown < 10 ? `0${countdown}` : countdown})</span>
            )}
          </Button>

          {/* Change Email link */}
          <a
            href="/register"
            className="block text-xs font-sans text-charcoal/60 hover:text-maroon underline underline-offset-2 transition-colors"
          >
            ← Change email address
          </a>
        </div>
      </div>
    </AuthCard>
  );
}
