"use client";

import React, { useState, useEffect } from "react";
import {
  checkPincodeAvailability,
  detectBrowserLocation,
  setSavedLocation,
  getSavedLocation,
  markLocationAsPrompted,
  POPULAR_METROS,
  LocationServiceResult,
} from "@/utils/locationService";

interface LocationPromptModalProps {
  isOpen: boolean;
  onClose: () => void;
  initialMessage?: string;
}

export default function LocationPromptModal({
  isOpen,
  onClose,
  initialMessage,
}: LocationPromptModalProps) {
  const [pincodeInput, setPincodeInput] = useState("");
  const [isDetecting, setIsDetecting] = useState(false);
  const [isChecking, setIsChecking] = useState(false);
  const [result, setResult] = useState<LocationServiceResult | null>(null);
  const [errorMsg, setErrorMsg] = useState<string | null>(null);

  useEffect(() => {
    if (isOpen) {
      const saved = getSavedLocation();
      if (saved) {
        setPincodeInput(saved.pincode);
        setResult(saved);
      }
      markLocationAsPrompted();
    }
  }, [isOpen]);

  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if (e.key === "Escape" && isOpen) {
        onClose();
      }
    };
    window.addEventListener("keydown", handleKeyDown);
    return () => window.removeEventListener("keydown", handleKeyDown);
  }, [isOpen, onClose]);

  if (!isOpen) return null;

  const handleVerify = async (pin: string) => {
    setErrorMsg(null);
    setIsChecking(true);
    try {
      const res = await checkPincodeAvailability(pin);
      setResult(res);
      if (!res.serviceable) {
        setErrorMsg(res.message);
      }
    } catch {
      setErrorMsg("Unable to verify postal coordinates. Please try again.");
    } finally {
      setIsChecking(false);
    }
  };

  const handleDetect = async () => {
    setErrorMsg(null);
    setIsDetecting(true);
    try {
      const detected = await detectBrowserLocation();
      setPincodeInput(detected.pincode);
      setResult(detected);
      if (!detected.serviceable) {
        setErrorMsg(detected.message);
      }
    } catch {
      setErrorMsg("Location detection unavailable. Please enter your 6-digit PIN code.");
    } finally {
      setIsDetecting(false);
    }
  };

  const handleConfirm = () => {
    if (result && result.serviceable) {
      setSavedLocation(result);
      onClose();
    }
  };

  const handleSelectMetro = (pin: string) => {
    setPincodeInput(pin);
    handleVerify(pin);
  };

  return (
    <div
      role="dialog"
      aria-modal="true"
      aria-label="Delivery Location Selector"
      className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-charcoal/60 backdrop-blur-sm animate-fade-in"
    >
      <div
        className="relative w-full max-w-lg bg-ivory border border-border rounded-2xl shadow-2xl overflow-hidden p-6 sm:p-8 space-y-6"
        onClick={(e) => e.stopPropagation()}
      >
        {/* Close Button */}
        <button
          onClick={onClose}
          aria-label="Close location selector"
          className="absolute top-4 right-4 p-2 rounded-full text-charcoal/50 hover:text-charcoal hover:bg-sand/60 transition cursor-pointer"
        >
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </button>

        {/* Title */}
        <div className="space-y-1">
          <div className="flex items-center gap-2 text-gold">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            <span className="text-[11px] font-sans uppercase tracking-widest font-semibold">
              Botanical Delivery Logistics
            </span>
          </div>
          <h3 className="font-serif text-2xl text-charcoal font-normal">
            Choose Delivery Destination
          </h3>
          <p className="text-xs text-charcoal/65 leading-relaxed">
            {initialMessage ||
              "Confirm your postal area to unlock regional harvest allocations, express air courier timelines, and Cash on Delivery availability."}
          </p>
        </div>

        {/* Geolocation Button */}
        <div>
          <button
            type="button"
            onClick={handleDetect}
            disabled={isDetecting}
            className="w-full flex items-center justify-center gap-2.5 py-3 px-4 rounded-xl border border-maroon/30 bg-sand/30 hover:bg-sand hover:border-maroon text-maroon text-xs font-sans font-semibold transition cursor-pointer"
          >
            {isDetecting ? (
              <span className="inline-block w-4 h-4 border-2 border-maroon border-t-transparent rounded-full animate-spin" />
            ) : (
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <polygon points="3 11 22 2 13 21 11 13 3 11" />
              </svg>
            )}
            <span>{isDetecting ? "Detecting Coordinates..." : "Use Current Location (GPS Auto-detect)"}</span>
          </button>
        </div>

        {/* Divider */}
        <div className="relative flex py-1 items-center">
          <div className="flex-grow border-t border-border/80" />
          <span className="flex-shrink mx-3 text-[10px] font-sans uppercase tracking-widest text-charcoal/40">
            or enter postal code
          </span>
          <div className="flex-grow border-t border-border/80" />
        </div>

        {/* PIN Input Row */}
        <form
          onSubmit={(e) => {
            e.preventDefault();
            if (pincodeInput) handleVerify(pincodeInput);
          }}
          className="flex items-stretch gap-2"
        >
          <div className="relative flex-1">
            <input
              type="text"
              inputMode="numeric"
              maxLength={6}
              value={pincodeInput}
              onChange={(e) => setPincodeInput(e.target.value.replace(/[^0-9]/g, ""))}
              placeholder="Enter 6-digit PIN code (e.g. 400050)"
              className="w-full h-11 px-3.5 bg-white border border-border rounded-xl text-sm font-sans text-charcoal placeholder:text-charcoal/40 focus:outline-none focus:border-maroon focus:ring-1 focus:ring-maroon"
            />
          </div>
          <button
            type="submit"
            disabled={isChecking || pincodeInput.length !== 6}
            className="px-5 h-11 bg-maroon text-ivory rounded-xl text-xs font-sans font-semibold tracking-wide hover:bg-maroon/90 disabled:opacity-50 transition cursor-pointer flex items-center justify-center min-w-[80px]"
          >
            {isChecking ? "Checking..." : "Verify"}
          </button>
        </form>

        {/* Popular Metro Quick Select */}
        <div className="space-y-2">
          <span className="block text-[11px] font-sans font-semibold uppercase tracking-wider text-charcoal/55">
            Popular Terroir Hubs:
          </span>
          <div className="flex flex-wrap gap-2">
            {POPULAR_METROS.map((metro) => (
              <button
                key={metro.pincode}
                type="button"
                onClick={() => handleSelectMetro(metro.pincode)}
                className={`
                  text-xs px-3 py-1.5 rounded-full border transition cursor-pointer font-sans
                  ${
                    pincodeInput === metro.pincode
                      ? "bg-maroon text-ivory border-maroon"
                      : "bg-sand/30 border-border/80 text-charcoal/70 hover:bg-sand hover:border-charcoal/40"
                  }
                `}
              >
                {metro.city} <span className="opacity-60 text-[10px]">({metro.pincode})</span>
              </button>
            ))}
          </div>
        </div>

        {/* Service Availability Feedback Card */}
        {result && (
          <div
            className={`
              p-4 rounded-xl border transition-all text-xs font-sans space-y-2.5
              ${
                result.serviceable
                  ? "bg-success/10 border-success/30 text-charcoal"
                  : "bg-danger/10 border-danger/30 text-charcoal"
              }
            `}
          >
            <div className="flex items-center justify-between font-semibold">
              <span className="flex items-center gap-1.5">
                {result.serviceable ? (
                  <span className="text-success font-bold text-sm">✓ Service Confirmed</span>
                ) : (
                  <span className="text-danger font-bold text-sm">✕ Service Restricted</span>
                )}
              </span>
              <span className="font-mono text-[11px] text-charcoal/60">PIN {result.pincode}</span>
            </div>

            <p className="text-xs text-charcoal/80 leading-relaxed">
              {result.message}
            </p>

            {result.serviceable && (
              <div className="pt-2 border-t border-charcoal/10 grid grid-cols-2 gap-2 text-[11px]">
                <div className="flex items-center gap-1.5 text-charcoal/75">
                  <span className="text-maroon font-bold">⚡</span>
                  <span>{result.expressAvailable ? "24–48h Air Courier" : "3–5 Days Overland"}</span>
                </div>
                <div className="flex items-center gap-1.5 text-charcoal/75">
                  <span className="text-maroon font-bold">💵</span>
                  <span>{result.codAvailable ? "Cash on Delivery Eligible" : "Prepaid Only"}</span>
                </div>
                <div className="flex items-center gap-1.5 text-charcoal/75 col-span-2">
                  <span className="text-gold font-bold">📦</span>
                  <span>{result.deliveryEstimate}</span>
                </div>
              </div>
            )}
          </div>
        )}

        {/* Error Banner */}
        {errorMsg && !result && (
          <div className="p-3 bg-danger/10 border border-danger/30 rounded-xl text-xs text-danger font-sans">
            {errorMsg}
          </div>
        )}

        {/* Footer Actions */}
        <div className="pt-2 flex items-center justify-end gap-3">
          <button
            type="button"
            onClick={onClose}
            className="px-4 py-2 text-xs font-sans text-charcoal/60 hover:text-charcoal cursor-pointer"
          >
            Dismiss
          </button>
          <button
            type="button"
            disabled={!result || !result.serviceable}
            onClick={handleConfirm}
            className="px-6 py-2.5 rounded-xl bg-maroon text-ivory text-xs font-sans font-semibold tracking-wide hover:bg-maroon/90 disabled:opacity-40 transition cursor-pointer shadow-xs"
          >
            Save & Continue Browsing
          </button>
        </div>
      </div>
    </div>
  );
}
