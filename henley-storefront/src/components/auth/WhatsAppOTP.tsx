"use client";

import React, { useState, useEffect, useRef } from "react";
import Button from "../Button";

/* ================================================================
   SHARED WHATSAPP OTP COMPONENT (<WhatsAppOTP />)
   ================================================================
   Used by both Login and Register as the default primary auth path:
   - Step 1: Phone entry (+ Country code selector, optional Name & Terms for Register)
   - Step 2: 6-digit segmented OTP input, WhatsApp confirmation, 30s countdown, change number
   ================================================================ */

export interface WhatsAppOTPProps {
  mode: "login" | "register";
  onSuccess?: (data: { phone: string; name?: string }) => void;
}

const COUNTRY_CODES = [
  { code: "+91", flag: "🇮🇳", country: "India" },
  { code: "+1", flag: "🇺🇸", country: "US/CA" },
  { code: "+44", flag: "🇬🇧", country: "UK" },
  { code: "+971", flag: "🇦🇪", country: "UAE" },
  { code: "+61", flag: "🇦🇺", country: "AU" },
  { code: "+65", flag: "🇸🇬", country: "SG" },
  { code: "+49", flag: "🇩🇪", country: "DE" },
  { code: "+33", flag: "🇫🇷", country: "FR" },
];

export default function WhatsAppOTP({ mode, onSuccess }: WhatsAppOTPProps) {
  // Step State: 'phone' | 'otp' | 'verified'
  const [step, setStep] = useState<"phone" | "otp" | "verified">("phone");

  // Form Fields (Default to India +91)
  const [fullName, setFullName] = useState("");
  const [countryCode, setCountryCode] = useState("+91");
  const [phone, setPhone] = useState("");
  const [termsAccepted, setTermsAccepted] = useState(false);

  // OTP Fields (6 digits)
  const [otpDigits, setOtpDigits] = useState<string[]>(["", "", "", "", "", ""]);
  const otpInputRefs = useRef<(HTMLInputElement | null)[]>([]);

  // Errors & Loading
  const [errors, setErrors] = useState<{ [key: string]: string }>({});
  const [isSubmitting, setIsSubmitting] = useState(false);

  // 30-second Resend Timer
  const [countdown, setCountdown] = useState(30);
  const [canResend, setCanResend] = useState(false);

  // Resend Timer Effect
  useEffect(() => {
    let timer: NodeJS.Timeout;
    if (step === "otp" && countdown > 0) {
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
  }, [step, countdown]);

  // Handle Send Code (Step 1)
  const handleSendCode = (e: React.FormEvent) => {
    e.preventDefault();
    const newErrors: { [key: string]: string } = {};

    if (mode === "register" && !fullName.trim()) {
      newErrors.fullName = "Full name is required.";
    }

    const cleanPhone = phone.replace(/\D/g, "");
    if (!cleanPhone || cleanPhone.length < 7) {
      newErrors.phone = "Please enter a valid mobile phone number.";
    }

    if (mode === "register" && !termsAccepted) {
      newErrors.terms = "You must agree to the Terms of Service & Privacy Policy.";
    }

    if (Object.keys(newErrors).length > 0) {
      setErrors(newErrors);
      return;
    }

    setErrors({});
    setIsSubmitting(true);

    // Simulate WhatsApp API Dispatch
    setTimeout(() => {
      setIsSubmitting(false);
      setStep("otp");
      setCountdown(30);
      setCanResend(false);
      setOtpDigits(["", "", "", "", "", ""]);
      // Auto focus first OTP input
      setTimeout(() => otpInputRefs.current[0]?.focus(), 100);
    }, 600);
  };

  // Handle OTP digit change
  const handleOtpChange = (index: number, value: string) => {
    if (value.length > 1) {
      // Paste handling
      const digits = value.replace(/\D/g, "").slice(0, 6).split("");
      const newDigits = [...otpDigits];
      digits.forEach((d, i) => {
        if (i < 6) newDigits[i] = d;
      });
      setOtpDigits(newDigits);
      const nextFocus = Math.min(digits.length, 5);
      otpInputRefs.current[nextFocus]?.focus();
      return;
    }

    const newDigits = [...otpDigits];
    newDigits[index] = value;
    setOtpDigits(newDigits);
    setErrors((prev) => ({ ...prev, otp: "" }));

    // Advance focus if digit was entered
    if (value && index < 5) {
      otpInputRefs.current[index + 1]?.focus();
    }
  };

  // Handle Backspace in OTP
  const handleKeyDown = (index: number, e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === "Backspace" && !otpDigits[index] && index > 0) {
      otpInputRefs.current[index - 1]?.focus();
    }
  };

  // Handle Resend Code
  const handleResend = () => {
    if (!canResend) return;
    setCountdown(30);
    setCanResend(false);
    setErrors((prev) => ({ ...prev, otp: "" }));
    setOtpDigits(["", "", "", "", "", ""]);
    otpInputRefs.current[0]?.focus();
  };

  // Handle OTP Verification (Step 2)
  const handleVerifyOtp = (e: React.FormEvent) => {
    e.preventDefault();
    const enteredCode = otpDigits.join("");

    if (enteredCode.length < 6) {
      setErrors({ otp: "Please enter the full 6-digit code sent to your WhatsApp." });
      return;
    }

    // Validation testing check: if code is '000000', simulate invalid/expired code
    if (enteredCode === "000000") {
      setErrors({ otp: "Invalid or expired verification code. Please try again." });
      return;
    }

    setIsSubmitting(true);
    setTimeout(() => {
      setIsSubmitting(false);
      setStep("verified");
      if (onSuccess) {
        onSuccess({ phone: `${countryCode} ${phone}`, name: fullName });
      }
    }, 800);
  };

  const formattedCountdown = `00:${countdown < 10 ? `0${countdown}` : countdown}`;

  // ════════════════════════════════════════════════════════════
  // 3. SUCCESS / VERIFIED STATE
  // ════════════════════════════════════════════════════════════
  if (step === "verified") {
    return (
      <div className="text-center py-6 space-y-4 animate-fade-in">
        <div className="w-14 h-14 mx-auto rounded-full bg-success/15 text-success flex items-center justify-center border border-success/30">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round">
            <polyline points="20 6 9 17 4 12" />
          </svg>
        </div>
        <div className="space-y-1">
          <h3 className="font-serif text-xl text-charcoal">
            {mode === "login" ? "Welcome Back" : "Account Created"}
          </h3>
          <p className="text-xs font-sans text-charcoal/60 max-w-xs mx-auto">
            {mode === "login"
              ? `You have successfully signed in with ${countryCode} ${phone}.`
              : `Welcome to Henley, ${fullName || "connoisseur"}! Your botanical ritual begins now.`}
          </p>
        </div>
        <Button
          variant="primary"
          className="w-full !mt-6"
          onClick={() => (window.location.href = "/collections")}
        >
          Explore Collections →
        </Button>
      </div>
    );
  }

  // ════════════════════════════════════════════════════════════
  // 2. STEP 2: 6-DIGIT SEGMENTED OTP VERIFICATION
  // ════════════════════════════════════════════════════════════
  if (step === "otp") {
    return (
      <form onSubmit={handleVerifyOtp} className="space-y-5">
        {/* WhatsApp Notification Banner */}
        <div className="p-3.5 bg-[#25D366]/10 border border-[#25D366]/30 rounded-xl flex items-start gap-3">
          <div className="w-8 h-8 rounded-full bg-[#25D366] text-white flex items-center justify-center flex-shrink-0 shadow-xs">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2zm0 18.12c-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.136 8.136 0 01-1.25-4.35c0-4.52 3.68-8.2 8.2-8.2 2.19 0 4.25.85 5.8 2.4 1.55 1.55 2.4 3.61 2.4 5.8 0 4.52-3.68 8.21-8.16 8.21zm4.49-6.16c-.25-.12-1.47-.72-1.7-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.23.25-.87.85-.87 2.07 0 1.22.89 2.4 1.01 2.56.12.17 1.75 2.67 4.23 3.75.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.47-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.07-.12-.23-.19-.48-.31z" />
            </svg>
          </div>
          <div className="space-y-0.5 min-w-0">
            <p className="text-xs font-sans font-medium text-charcoal">
              We sent a 6-digit code via WhatsApp
            </p>
            <p className="text-[11px] font-sans text-charcoal/60 truncate">
              Sent to <span className="font-semibold text-charcoal">{countryCode} {phone}</span>
            </p>
          </div>
        </div>

        {/* 6-Digit Segmented OTP Input */}
        <div className="space-y-2">
          <label className="block text-center text-xs font-sans font-medium uppercase tracking-[0.1em] text-charcoal/70">
            Enter Verification Code
          </label>

          <div className="flex items-center justify-between gap-2 sm:gap-2.5">
            {otpDigits.map((digit, idx) => (
              <input
                key={idx}
                ref={(el) => {
                  otpInputRefs.current[idx] = el;
                }}
                type="text"
                inputMode="numeric"
                pattern="[0-9]*"
                maxLength={1}
                value={digit}
                onChange={(e) => handleOtpChange(idx, e.target.value)}
                onKeyDown={(e) => handleKeyDown(idx, e)}
                className={`
                  w-11 h-13 sm:w-12 sm:h-14 text-center text-xl font-mono font-semibold rounded-lg border
                  bg-white text-charcoal transition-all focus:outline-none
                  ${
                    errors.otp
                      ? "border-error text-error bg-error/5 focus:border-error focus:ring-1 focus:ring-error"
                      : digit
                      ? "border-maroon ring-1 ring-maroon/30 shadow-xs"
                      : "border-border focus:border-maroon focus:ring-2 focus:ring-maroon/20"
                  }
                `}
                aria-label={`Digit ${idx + 1}`}
              />
            ))}
          </div>

          {errors.otp && (
            <p className="text-center text-xs font-sans text-error pt-1 animate-shake">
              {errors.otp}
            </p>
          )}

          <p className="text-[11px] text-center text-charcoal/40 font-mono">
            (Hint: try entering any 6 digits, or &quot;000000&quot; to test invalid error state)
          </p>
        </div>

        {/* Resend Timer & Change Number */}
        <div className="flex items-center justify-between text-xs font-sans pt-1">
          <button
            type="button"
            onClick={() => setStep("phone")}
            className="text-charcoal/60 hover:text-maroon transition-colors underline cursor-pointer"
          >
            ← Change number
          </button>

          {canResend ? (
            <button
              type="button"
              onClick={handleResend}
              className="text-maroon font-medium hover:underline cursor-pointer"
            >
              Resend code via WhatsApp
            </button>
          ) : (
            <span className="text-charcoal/45 font-mono">
              Resend in {formattedCountdown}
            </span>
          )}
        </div>

        {/* Verify Action Button */}
        <Button
          type="submit"
          variant="primary"
          className="w-full !h-12 !text-xs !tracking-wider flex items-center justify-center gap-2"
          disabled={isSubmitting}
        >
          {isSubmitting ? (
            <span>Verifying code...</span>
          ) : mode === "login" ? (
            "Verify & Log In →"
          ) : (
            "Verify & Create Account →"
          )}
        </Button>
      </form>
    );
  }

  // ════════════════════════════════════════════════════════════
  // 1. STEP 1: PHONE & DETAILS ENTRY (Default Path)
  // ════════════════════════════════════════════════════════════
  return (
    <form onSubmit={handleSendCode} className="space-y-4">
      {/* Name Field (for Register mode) */}
      {mode === "register" && (
        <div className="space-y-1.5">
          <label className="block text-xs font-sans font-semibold uppercase tracking-[0.1em] text-charcoal/70">
            Full Name
          </label>
          <input
            type="text"
            value={fullName}
            onChange={(e) => {
              setFullName(e.target.value);
              setErrors((prev) => ({ ...prev, fullName: "" }));
            }}
            placeholder="e.g. Lady Alexandra"
            className={`
              w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border bg-white text-charcoal
              placeholder:text-charcoal/35 focus:outline-none transition-all
              ${
                errors.fullName
                  ? "border-error bg-error/5 focus:border-error"
                  : "border-border focus:border-maroon focus:ring-1 focus:ring-maroon/20"
              }
            `}
          />
          {errors.fullName && (
            <p className="text-[11px] font-sans text-error">{errors.fullName}</p>
          )}
        </div>
      )}

      {/* Phone Number with Country Code Picker */}
      <div className="space-y-1.5">
        <label className="block text-xs font-sans font-semibold uppercase tracking-[0.1em] text-charcoal/70">
          WhatsApp Phone Number
        </label>
        <div className="flex gap-2">
          {/* Country Code dropdown */}
          <select
            value={countryCode}
            onChange={(e) => setCountryCode(e.target.value)}
            aria-label="Country calling code"
            className="
              w-24 sm:w-28 px-2.5 py-2.5 text-xs font-sans rounded-lg border border-border
              bg-white text-charcoal focus:outline-none focus:border-maroon cursor-pointer
            "
          >
            {COUNTRY_CODES.map((c) => (
              <option key={c.code} value={c.code}>
                {c.flag} {c.code} ({c.country})
              </option>
            ))}
          </select>

          {/* Phone Input */}
          <input
            type="tel"
            value={phone}
            onChange={(e) => {
              setPhone(e.target.value);
              setErrors((prev) => ({ ...prev, phone: "" }));
            }}
            placeholder="98765-43210"
            className={`
              flex-1 px-3.5 py-2.5 text-xs font-sans rounded-lg border bg-white text-charcoal
              placeholder:text-charcoal/35 focus:outline-none transition-all
              ${
                errors.phone
                  ? "border-error bg-error/5 focus:border-error"
                  : "border-border focus:border-maroon focus:ring-1 focus:ring-maroon/20"
              }
            `}
          />
        </div>
        {errors.phone && (
          <p className="text-[11px] font-sans text-error">{errors.phone}</p>
        )}
      </div>

      {/* Terms Checkbox (for Register mode) */}
      {mode === "register" && (
        <div className="space-y-1 pt-1">
          <label className="flex items-start gap-2.5 cursor-pointer text-xs font-sans text-charcoal/70 leading-normal">
            <input
              type="checkbox"
              checked={termsAccepted}
              onChange={(e) => {
                setTermsAccepted(e.target.checked);
                setErrors((prev) => ({ ...prev, terms: "" }));
              }}
              className="mt-0.5 rounded-xs border-border text-maroon focus:ring-maroon cursor-pointer"
            />
            <span>
              I agree to the{" "}
              <a href="/terms" className="text-maroon hover:underline font-medium">
                Terms of Service
              </a>{" "}
              and{" "}
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
      )}

      {/* Send WhatsApp Code Action */}
      <Button
        type="submit"
        variant="primary"
        className="w-full !h-12 !text-xs !tracking-wider flex items-center justify-center gap-2"
        disabled={isSubmitting}
      >
        {isSubmitting ? (
          <span>Dispatching code...</span>
        ) : (
          <>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2zm0 18.12c-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.136 8.136 0 01-1.25-4.35c0-4.52 3.68-8.2 8.2-8.2 2.19 0 4.25.85 5.8 2.4 1.55 1.55 2.4 3.61 2.4 5.8 0 4.52-3.68 8.21-8.16 8.21zm4.49-6.16c-.25-.12-1.47-.72-1.7-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.23.25-.87.85-.87 2.07 0 1.22.89 2.4 1.01 2.56.12.17 1.75 2.67 4.23 3.75.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.47-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.07-.12-.23-.19-.48-.31z" />
            </svg>
            <span>Send Code via WhatsApp</span>
          </>
        )}
      </Button>
    </form>
  );
}
