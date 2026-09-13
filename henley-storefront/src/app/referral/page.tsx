"use client";

import React, { useState, useEffect } from "react";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import Button from "@/components/Button";
import {
  getUserReferralCode,
  setUserReferralCode,
  getWalletBalance,
  getWalletTransactions,
  WalletTransaction,
} from "@/utils/referralService";

export default function ReferralPage() {
  const [code, setCode] = useState("HENLEY-ANANYA");
  const [isEditingCode, setIsEditingCode] = useState(false);
  const [editedCode, setEditedCode] = useState("");
  const [copied, setCopied] = useState(false);
  const [walletBalance, setWalletBalance] = useState(1200);
  const [transactions, setTransactions] = useState<WalletTransaction[]>([]);

  useEffect(() => {
    const savedCode = getUserReferralCode();
    setCode(savedCode);
    setEditedCode(savedCode);
    setWalletBalance(getWalletBalance());
    setTransactions(getWalletTransactions());
  }, []);

  const shareUrl = typeof window !== "undefined"
    ? `${window.location.origin}/?ref=${code}`
    : `https://henleytea.com/?ref=${code}`;

  const handleCopyLink = () => {
    if (typeof navigator !== "undefined" && navigator.clipboard) {
      navigator.clipboard.writeText(shareUrl);
      setCopied(true);
      setTimeout(() => setCopied(false), 2500);
    }
  };

  const handleSaveCustomCode = (e: React.FormEvent) => {
    e.preventDefault();
    if (editedCode) {
      const updated = setUserReferralCode(editedCode);
      setCode(updated);
      setIsEditingCode(false);
    }
  };

  const whatsappMessage = encodeURIComponent(
    `Experience single-estate Himalayan teas and rare spices at Henley Botanical Reserve. Use my exclusive code "${code}" for flat 10% off your first ritual order above ₹500: ${shareUrl}`
  );

  const emailSubject = encodeURIComponent("An Exclusive Botanical Invitation to Henley");
  const emailBody = encodeURIComponent(
    `I would love to invite you to discover Henley Botanical Reserve. They craft single-estate orthodox teas and single-origin whole spices.\n\nUse my invite code ${code} for 10% off your first order above ₹500:\n${shareUrl}\n\nWarm regards.`
  );

  const twitterMessage = encodeURIComponent(
    `Exploring rare single-estate Himalayan teas and spices with @HenleyBotanicals. Enjoy 10% off your first order with my code ${code}: ${shareUrl}`
  );

  return (
    <div className="min-h-screen bg-ivory text-charcoal flex flex-col justify-between">
      <Header activePath="/referral" />

      <main className="henley-container py-12 lg:py-16 space-y-12">
        {/* ── 1. HERO SECTION ─────────────────────────────────── */}
        <div className="max-w-3xl mx-auto text-center space-y-4">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sand border border-border text-gold text-xs font-sans font-semibold tracking-widest uppercase">
            <span>✦ Connoisseur Circle Referral Ritual</span>
          </div>
          <h1 className="font-serif text-3xl sm:text-5xl text-charcoal font-normal leading-tight">
            Share the Botanical Ritual
          </h1>
          <p className="text-sm sm:text-base text-charcoal/70 max-w-xl mx-auto leading-relaxed">
            Invite fellow connoisseurs to experience single-estate mountain harvests. They receive{" "}
            <span className="font-semibold text-maroon">flat 10% off</span> on orders above ₹500, and you receive{" "}
            <span className="font-semibold text-maroon">20% of their cart value</span> as store credit in your wallet.
          </p>
        </div>

        {/* ── 2. REFERRAL CODE & SHARING BOX ─────────────────── */}
        <div className="max-w-2xl mx-auto bg-sand/40 border border-border rounded-2xl p-6 sm:p-8 space-y-6 shadow-xs">
          <div className="flex items-center justify-between pb-4 border-b border-border/70">
            <div>
              <p className="text-eyebrow text-gold uppercase tracking-wider text-[11px]">Your Personal Reserve Code</p>
              <h2 className="font-mono text-2xl font-bold text-maroon tracking-wider mt-0.5">
                {code}
              </h2>
            </div>

            <button
              type="button"
              onClick={() => setIsEditingCode(!isEditingCode)}
              className="text-xs font-sans font-medium text-charcoal/60 hover:text-maroon underline cursor-pointer"
            >
              {isEditingCode ? "Cancel" : "Customize Code"}
            </button>
          </div>

          {/* Custom Code Editor */}
          {isEditingCode && (
            <form onSubmit={handleSaveCustomCode} className="flex gap-2 p-3 bg-white/70 border border-border rounded-xl">
              <input
                type="text"
                value={editedCode}
                onChange={(e) => setEditedCode(e.target.value.toUpperCase())}
                placeholder="Enter custom code"
                className="flex-1 px-3 py-1.5 text-xs font-mono uppercase bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
              />
              <button
                type="submit"
                className="px-4 py-1.5 bg-maroon text-ivory text-xs font-sans font-semibold rounded-lg hover:bg-maroon/90 transition cursor-pointer"
              >
                Save
              </button>
            </form>
          )}

          {/* Share Link Row */}
          <div className="space-y-2">
            <label className="block text-xs font-sans text-charcoal/70 font-medium">
              Shareable Invitation Link
            </label>
            <div className="flex items-stretch gap-2">
              <input
                type="text"
                readOnly
                value={shareUrl}
                className="flex-1 px-3.5 py-2.5 bg-white border border-border rounded-xl text-xs font-mono text-charcoal/80 select-all"
              />
              <button
                type="button"
                onClick={handleCopyLink}
                className="px-5 py-2.5 bg-maroon text-ivory rounded-xl text-xs font-sans font-semibold tracking-wide hover:bg-maroon/90 transition cursor-pointer flex items-center gap-1.5 flex-shrink-0"
              >
                {copied ? (
                  <>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                      <path d="M20 6L9 17l-5-5" />
                    </svg>
                    <span>Copied!</span>
                  </>
                ) : (
                  <>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <rect x="9" y="9" width="13" height="13" rx="2" ry="2" />
                      <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                    </svg>
                    <span>Copy Link</span>
                  </>
                )}
              </button>
            </div>
          </div>

          {/* 1-Click Share Triggers */}
          <div className="space-y-2 pt-2">
            <span className="block text-[11px] font-sans font-semibold uppercase tracking-wider text-charcoal/55">
              Instant Share Channels:
            </span>
            <div className="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
              <a
                href={`https://api.whatsapp.com/send?text=${whatsappMessage}`}
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-center justify-center gap-2 p-2.5 bg-white border border-[#25D366]/40 hover:border-[#25D366] hover:bg-[#25D366]/10 rounded-xl text-xs font-sans font-medium text-charcoal transition"
              >
                <span className="text-[#25D366] font-bold text-sm">💬</span>
                <span>WhatsApp</span>
              </a>

              <a
                href={`mailto:?subject=${emailSubject}&body=${emailBody}`}
                className="flex items-center justify-center gap-2 p-2.5 bg-white border border-border hover:border-maroon/40 hover:bg-sand/30 rounded-xl text-xs font-sans font-medium text-charcoal transition"
              >
                <span className="text-maroon font-bold text-sm">✉️</span>
                <span>Email Invite</span>
              </a>

              <a
                href={`https://twitter.com/intent/tweet?text=${twitterMessage}`}
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-center justify-center gap-2 p-2.5 bg-white border border-border hover:border-charcoal hover:bg-sand/30 rounded-xl text-xs font-sans font-medium text-charcoal transition"
              >
                <span className="text-charcoal font-bold text-sm">𝕏</span>
                <span>Post on X</span>
              </a>
            </div>
          </div>
        </div>

        {/* ── 3. WALLET & REWARDS DASHBOARD ─────────────────── */}
        <div className="max-w-4xl mx-auto space-y-6">
          <div className="border-b border-border/80 pb-4">
            <p className="text-eyebrow text-gold uppercase tracking-wider text-xs">Customer Portal</p>
            <h2 className="font-serif text-2xl sm:text-3xl text-charcoal">Your Store Credit Wallet</h2>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div className="p-6 bg-sand/60 border border-border rounded-xl space-y-2">
              <span className="text-xs font-sans text-charcoal/60 uppercase tracking-wider">Available Store Credit</span>
              <p className="font-serif text-3xl sm:text-4xl text-maroon font-normal">
                ₹{walletBalance.toLocaleString("en-IN")}
              </p>
              <p className="text-[11px] text-charcoal/50">Auto-applies at checkout towards any reserve.</p>
            </div>

            <div className="p-6 bg-sand/40 border border-border rounded-xl space-y-2">
              <span className="text-xs font-sans text-charcoal/60 uppercase tracking-wider">Total Rewards Earned</span>
              <p className="font-serif text-3xl sm:text-4xl text-charcoal font-normal">
                ₹2,400
              </p>
              <p className="text-[11px] text-charcoal/50">20% commission on invited connoisseurs.</p>
            </div>

            <div className="p-6 bg-sand/40 border border-border rounded-xl space-y-2">
              <span className="text-xs font-sans text-charcoal/60 uppercase tracking-wider">Friends Introduced</span>
              <p className="font-serif text-3xl sm:text-4xl text-charcoal font-normal">
                4 Connoisseurs
              </p>
              <p className="text-[11px] text-charcoal/50">Enjoyed 10% welcome discount.</p>
            </div>
          </div>

          {/* Transactions Ledger */}
          <div className="bg-sand/30 border border-border rounded-xl p-6 space-y-4">
            <h3 className="font-serif text-lg text-charcoal">Recent Wallet Transactions</h3>
            <div className="divide-y divide-border/60 text-xs font-sans">
              {transactions.length === 0 ? (
                <p className="py-4 text-charcoal/50">No transactions recorded yet.</p>
              ) : (
                transactions.map((tx) => (
                  <div key={tx.id} className="py-3 flex items-center justify-between">
                    <div>
                      <p className="font-medium text-charcoal">{tx.description}</p>
                      <span className="text-[11px] text-charcoal/45">{tx.date}</span>
                    </div>
                    <div className="text-right">
                      <span className="font-mono font-bold text-success">
                        +₹{tx.amount.toLocaleString("en-IN")}
                      </span>
                      <p className="text-[10px] text-charcoal/40 font-mono">
                        Balance: ₹{tx.balanceAfter.toLocaleString("en-IN")}
                      </p>
                    </div>
                  </div>
                ))
              )}
            </div>
          </div>
        </div>

        {/* ── 4. HOW IT WORKS 3-STEP GUIDE ──────────────────── */}
        <div className="max-w-4xl mx-auto pt-8 border-t border-border/80">
          <div className="text-center max-w-xl mx-auto mb-10 space-y-2">
            <p className="text-eyebrow text-gold uppercase tracking-wider text-xs">Simplicity & Integrity</p>
            <h2 className="font-serif text-2xl sm:text-3xl text-charcoal">How the Connoisseur Circle Works</h2>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 text-center sm:text-left">
            <div className="p-6 bg-sand/30 border border-border rounded-xl space-y-3">
              <span className="w-8 h-8 rounded-full bg-maroon text-ivory font-serif flex items-center justify-center text-sm font-semibold mx-auto sm:mx-0">
                1
              </span>
              <h3 className="font-serif text-lg text-charcoal">Share Your Custom Code</h3>
              <p className="text-xs text-charcoal/70 leading-relaxed">
                Send your unique invitation code or WhatsApp link to friends, family, and fellow tea or spice enthusiasts.
              </p>
            </div>

            <div className="p-6 bg-sand/30 border border-border rounded-xl space-y-3">
              <span className="w-8 h-8 rounded-full bg-maroon text-ivory font-serif flex items-center justify-center text-sm font-semibold mx-auto sm:mx-0">
                2
              </span>
              <h3 className="font-serif text-lg text-charcoal">They Enjoy 10% Off</h3>
              <p className="text-xs text-charcoal/70 leading-relaxed">
                On their first ritual order above ₹500, they receive flat 10% off their entire harvest allocation at checkout.
              </p>
            </div>

            <div className="p-6 bg-sand/30 border border-border rounded-xl space-y-3">
              <span className="w-8 h-8 rounded-full bg-maroon text-ivory font-serif flex items-center justify-center text-sm font-semibold mx-auto sm:mx-0">
                3
              </span>
              <h3 className="font-serif text-lg text-charcoal">You Earn 20% in Credit</h3>
              <p className="text-xs text-charcoal/70 leading-relaxed">
                Upon order confirmation, 20% of their total cart value is credited straight into your wallet for your next reserve.
              </p>
            </div>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
}
