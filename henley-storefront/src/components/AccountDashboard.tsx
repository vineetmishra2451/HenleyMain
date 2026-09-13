"use client";

import React, { useState, useEffect } from "react";
import Button from "./Button";
import LocationPromptModal from "./LocationPromptModal";
import { AuthUser, logoutUser } from "@/utils/authService";
import { getSavedLocation, LocationServiceResult } from "@/utils/locationService";
import { getWalletBalance, getUserReferralCode } from "@/utils/referralService";

interface AccountDashboardProps {
  user: AuthUser;
  onLogout?: () => void;
}

export default function AccountDashboard({ user, onLogout }: AccountDashboardProps) {
  const [activeTab, setActiveTab] = useState<"orders" | "addresses" | "referrals" | "profile">("orders");
  const [savedLocation, setSavedLocation] = useState<LocationServiceResult | null>(null);
  const [locationModalOpen, setLocationModalOpen] = useState(false);
  const [copiedCode, setCopiedCode] = useState(false);
  const [walletBalance, setWalletBalance] = useState(user.walletBalance || 1200);

  // Profile Form State
  const [fullName, setFullName] = useState(user.name);
  const [phone, setPhone] = useState(user.phone);
  const [profileSaved, setProfileSaved] = useState(false);

  useEffect(() => {
    setSavedLocation(getSavedLocation());
    setWalletBalance(getWalletBalance());
  }, []);

  const referralCode = getUserReferralCode() || user.referralCode || "HENLEY-ANANYA";
  const shareUrl = typeof window !== "undefined"
    ? `${window.location.origin}/?ref=${referralCode}`
    : `https://henleytea.com/?ref=${referralCode}`;

  const handleCopy = () => {
    if (typeof navigator !== "undefined" && navigator.clipboard) {
      navigator.clipboard.writeText(shareUrl);
      setCopiedCode(true);
      setTimeout(() => setCopiedCode(false), 2000);
    }
  };

  const handleSignOut = () => {
    logoutUser();
    if (onLogout) {
      onLogout();
    } else {
      window.location.reload();
    }
  };

  const handleSaveProfile = (e: React.FormEvent) => {
    e.preventDefault();
    setProfileSaved(true);
    setTimeout(() => setProfileSaved(false), 3000);
  };

  return (
    <div className="w-full bg-ivory text-charcoal py-8 lg:py-14">
      <div className="henley-container space-y-10">
        {/* ── 1. PATRON HEADER ───────────────────────────────── */}
        <div className="bg-sand/50 border border-border rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 shadow-2xs">
          <div className="flex items-center gap-4 sm:gap-5">
            <div className="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-maroon text-gold font-serif text-2xl sm:text-3xl flex items-center justify-center border-2 border-gold/40 shadow-xs flex-shrink-0">
              {fullName
                .split(" ")
                .map((n) => n[0])
                .join("")
                .slice(0, 2)
                .toUpperCase() || "H"}
            </div>
            <div className="space-y-1">
              <div className="flex flex-wrap items-center gap-2">
                <h1 className="font-serif text-2xl sm:text-3xl text-charcoal font-normal">
                  {fullName}
                </h1>
                <span className="px-2.5 py-0.5 rounded-full bg-maroon text-gold font-sans text-[10px] uppercase font-semibold tracking-wider">
                  ✦ {user.tier || "Grand Patron Reserve"}
                </span>
              </div>
              <p className="text-xs font-sans text-charcoal/65">
                {user.email} · {phone}
              </p>
              <p className="text-[11px] font-sans text-charcoal/50">
                Cellar Member since {user.memberSince || "2026"} · High-Mountain Single-Estate Allocation
              </p>
            </div>
          </div>

          <div className="flex items-center gap-3 self-stretch sm:self-auto">
            <a href="/shop" className="flex-1 sm:flex-initial">
              <Button variant="secondary" className="w-full !h-10 !text-xs">
                Explore Reserves →
              </Button>
            </a>
            <button
              onClick={handleSignOut}
              className="px-4 h-10 rounded-xl border border-border bg-white text-xs font-sans text-charcoal/70 hover:text-danger hover:border-danger/40 transition cursor-pointer flex-shrink-0"
              aria-label="Sign out of account"
            >
              Sign Out
            </button>
          </div>
        </div>

        {/* ── 2. QUICK METRICS OVERVIEW ───────────────────────── */}
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
          <div className="p-4 sm:p-5 rounded-xl bg-sand/30 border border-border/80 space-y-1">
            <span className="text-[10px] sm:text-xs font-sans text-charcoal/60 uppercase tracking-wider">
              Store Credit Wallet
            </span>
            <p className="font-serif text-2xl sm:text-3xl text-maroon font-normal">
              ₹{walletBalance.toLocaleString("en-IN")}
            </p>
            <p className="text-[11px] text-charcoal/50">Auto-applies at checkout</p>
          </div>

          <div className="p-4 sm:p-5 rounded-xl bg-sand/30 border border-border/80 space-y-1">
            <span className="text-[10px] sm:text-xs font-sans text-charcoal/60 uppercase tracking-wider">
              Active Consignments
            </span>
            <p className="font-serif text-2xl sm:text-3xl text-charcoal font-normal">
              1 In Transit
            </p>
            <p className="text-[11px] text-success font-medium">Vault dispatch en route</p>
          </div>

          <div className="p-4 sm:p-5 rounded-xl bg-sand/30 border border-border/80 space-y-1">
            <span className="text-[10px] sm:text-xs font-sans text-charcoal/60 uppercase tracking-wider">
              Referral Commissions
            </span>
            <p className="font-serif text-2xl sm:text-3xl text-charcoal font-normal">
              ₹2,400
            </p>
            <p className="text-[11px] text-charcoal/50">20% earned on friends</p>
          </div>

          <div className="p-4 sm:p-5 rounded-xl bg-sand/30 border border-border/80 space-y-1">
            <span className="text-[10px] sm:text-xs font-sans text-charcoal/60 uppercase tracking-wider">
              Delivery Destination
            </span>
            <p className="font-serif text-xl sm:text-2xl text-charcoal font-normal truncate">
              {savedLocation ? `${savedLocation.city}` : "Mumbai"}
            </p>
            <p className="text-[11px] text-charcoal/50">
              PIN {savedLocation ? savedLocation.pincode : "400050"} (Express Air)
            </p>
          </div>
        </div>

        {/* ── 3. TABS NAVIGATION ─────────────────────────────── */}
        <div className="space-y-6">
          <div className="flex border-b border-border/80 gap-6 sm:gap-8 overflow-x-auto text-xs sm:text-sm font-sans">
            {[
              { id: "orders", label: "Consignments & Orders (2)", icon: "📦" },
              { id: "addresses", label: "Saved Addresses & Delivery", icon: "📍" },
              { id: "referrals", label: "Connoisseur Circle & Wallet", icon: "🎁" },
              { id: "profile", label: "Personal Details & Preferences", icon: "⚙️" },
            ].map((tab) => (
              <button
                key={tab.id}
                type="button"
                onClick={() => setActiveTab(tab.id as any)}
                className={`
                  pb-3.5 flex items-center gap-2 border-b-2 font-medium transition-all whitespace-nowrap cursor-pointer
                  ${
                    activeTab === tab.id
                      ? "border-maroon text-maroon font-semibold"
                      : "border-transparent text-charcoal/60 hover:text-charcoal"
                  }
                `}
              >
                <span>{tab.icon}</span>
                <span>{tab.label}</span>
              </button>
            ))}
          </div>

          {/* ── TAB 1: ORDERS ─────────────────────────────────── */}
          {activeTab === "orders" && (
            <div className="space-y-4">
              {/* Order 1: Active In Transit */}
              <div className="bg-sand/20 border border-border rounded-xl p-5 sm:p-6 space-y-4 shadow-2xs">
                <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-border/70">
                  <div>
                    <span className="font-mono text-xs font-bold text-maroon">
                      Consignment #HNL-2026-8819
                    </span>
                    <p className="text-[11px] text-charcoal/50 mt-0.5">Placed on September 12, 2026</p>
                  </div>
                  <div className="flex items-center gap-2">
                    <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-success/15 text-success text-xs font-sans font-medium">
                      <span className="w-1.5 h-1.5 rounded-full bg-success animate-pulse" />
                      <span>In Transit · Dispatched from Siliguri Vault</span>
                    </span>
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-sans">
                  <div className="space-y-2">
                    <p className="font-semibold text-charcoal">Allocated Micro-Lots:</p>
                    <ul className="space-y-1 text-charcoal/70">
                      <li>• First Flush Darjeeling 2026 (Standard Pack) × 1</li>
                      <li>• Kashmir Mogra Saffron Reserve (1g Glass Vial) × 1</li>
                    </ul>
                  </div>

                  <div className="space-y-1 sm:text-right">
                    <p className="text-charcoal/60">Estimated Delivery Date:</p>
                    <p className="font-serif text-sm font-semibold text-charcoal">
                      Wednesday, Sep 16, 2026
                    </p>
                    <p className="text-[11px] text-charcoal/50">Courier: BlueDart Apex Air Express (AWB #88194412)</p>
                  </div>
                </div>

                <div className="pt-3 border-t border-border/70 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                  <div className="text-xs">
                    <span className="text-charcoal/60">Total Consignment Value: </span>
                    <span className="font-mono font-bold text-charcoal">₹3,450.00</span>
                    <span className="text-success ml-2 font-medium">(Free Express Air Shipping)</span>
                  </div>
                  <div className="flex items-center gap-2.5 w-full sm:w-auto">
                    <a href="/track-order" className="flex-1 sm:flex-initial">
                      <Button variant="primary" className="!h-9 !text-xs w-full">
                        Track Consignment →
                      </Button>
                    </a>
                  </div>
                </div>
              </div>

              {/* Order 2: Delivered */}
              <div className="bg-sand/20 border border-border rounded-xl p-5 sm:p-6 space-y-4 shadow-2xs">
                <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-border/70">
                  <div>
                    <span className="font-mono text-xs font-bold text-charcoal">
                      Consignment #HNL-2026-7412
                    </span>
                    <p className="text-[11px] text-charcoal/50 mt-0.5">Placed on August 24, 2026</p>
                  </div>
                  <div>
                    <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sand text-charcoal/70 text-xs font-sans font-medium">
                      <span>✓ Delivered · Hand-packed in Bone Porcelain Cloche</span>
                    </span>
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-sans">
                  <div className="space-y-2">
                    <p className="font-semibold text-charcoal">Allocated Micro-Lots:</p>
                    <ul className="space-y-1 text-charcoal/70">
                      <li>• Silver Needle White Tea (Standard Pack) × 2</li>
                    </ul>
                  </div>

                  <div className="space-y-1 sm:text-right">
                    <p className="text-charcoal/60">Delivered To:</p>
                    <p className="text-xs text-charcoal">
                      B-402, Pali Hill Reserve, Bandra West, Mumbai (400050)
                    </p>
                  </div>
                </div>

                <div className="pt-3 border-t border-border/70 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                  <div className="text-xs">
                    <span className="text-charcoal/60">Total Paid: </span>
                    <span className="font-mono font-bold text-charcoal">₹2,800.00</span>
                  </div>
                  <a href="/shop" className="w-full sm:w-auto">
                    <Button variant="secondary" className="!h-9 !text-xs w-full">
                      Reorder Reserve
                    </Button>
                  </a>
                </div>
              </div>
            </div>
          )}

          {/* ── TAB 2: SAVED ADDRESSES ───────────────────────── */}
          {activeTab === "addresses" && (
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {/* Primary Address */}
              <div className="p-5 sm:p-6 bg-sand/30 border border-maroon/40 rounded-xl space-y-3 relative">
                <div className="flex items-center justify-between">
                  <span className="px-2 py-0.5 rounded-full bg-maroon text-ivory text-[10px] font-sans font-semibold uppercase tracking-wide">
                    Default Shipping
                  </span>
                  <span className="text-xs font-sans font-medium text-success flex items-center gap-1">
                    <span>⚡</span>
                    <span>24–48h Express Zone</span>
                  </span>
                </div>

                <div className="space-y-1 text-xs font-sans text-charcoal">
                  <p className="font-semibold text-sm">{fullName}</p>
                  <p className="text-charcoal/80">B-402, Pali Hill Reserve, Nargis Dutt Road</p>
                  <p className="text-charcoal/80">Bandra West, Mumbai, Maharashtra</p>
                  <p className="font-mono font-semibold text-maroon">PIN: 400050</p>
                  <p className="text-charcoal/60 pt-1">Phone: {phone}</p>
                </div>

                <div className="pt-3 border-t border-border/60 flex items-center gap-2">
                  <button
                    type="button"
                    onClick={() => setLocationModalOpen(true)}
                    className="px-3 py-1.5 rounded-lg bg-white border border-border text-xs font-sans font-semibold text-maroon hover:bg-sand transition cursor-pointer"
                  >
                    Change Delivery PIN / Area
                  </button>
                </div>
              </div>

              {/* Secondary Address */}
              <div className="p-5 sm:p-6 bg-sand/20 border border-border rounded-xl space-y-3">
                <div className="flex items-center justify-between">
                  <span className="text-xs font-sans text-charcoal/50 uppercase tracking-wider font-semibold">
                    Secondary Residence
                  </span>
                  <span className="text-xs font-sans text-charcoal/60">Tier 1 Hub</span>
                </div>

                <div className="space-y-1 text-xs font-sans text-charcoal">
                  <p className="font-semibold text-sm">{fullName}</p>
                  <p className="text-charcoal/80">Penthouse 3, Koregaon Park North</p>
                  <p className="text-charcoal/80">Pune, Maharashtra</p>
                  <p className="font-mono font-semibold text-charcoal">PIN: 411001</p>
                  <p className="text-charcoal/60 pt-1">Phone: {phone}</p>
                </div>

                <div className="pt-3 border-t border-border/60">
                  <button
                    type="button"
                    onClick={() => setLocationModalOpen(true)}
                    className="px-3 py-1.5 rounded-lg bg-white border border-border text-xs font-sans text-charcoal/70 hover:text-charcoal hover:bg-sand transition cursor-pointer"
                  >
                    Check Service Availability
                  </button>
                </div>
              </div>
            </div>
          )}

          {/* ── TAB 3: REFERRALS & WALLET ───────────────────── */}
          {activeTab === "referrals" && (
            <div className="bg-sand/30 border border-border rounded-xl p-6 space-y-6">
              <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-border/80">
                <div>
                  <h3 className="font-serif text-xl text-charcoal">Connoisseur Circle Referral Program</h3>
                  <p className="text-xs text-charcoal/65 mt-0.5">
                    Friends receive <strong className="text-maroon">10% off</strong> on orders above ₹500, and you earn <strong className="text-maroon">20% of their cart value</strong> in store credit.
                  </p>
                </div>
                <a href="/referral">
                  <Button variant="primary" className="!h-9 !text-xs whitespace-nowrap">
                    Open Full Referral Hub →
                  </Button>
                </a>
              </div>

              {/* Share Box */}
              <div className="p-4 bg-white rounded-xl border border-border space-y-3">
                <span className="block text-xs font-sans font-semibold text-charcoal/70">
                  Your Unique Referral Code & Link:
                </span>
                <div className="flex flex-col sm:flex-row items-stretch gap-2">
                  <span className="px-4 py-2 rounded-lg bg-sand/40 border border-border font-mono text-sm font-bold text-maroon flex items-center justify-center">
                    {referralCode}
                  </span>
                  <input
                    type="text"
                    readOnly
                    value={shareUrl}
                    className="flex-1 px-3 py-2 bg-white border border-border rounded-lg text-xs font-mono text-charcoal/80 select-all"
                  />
                  <button
                    type="button"
                    onClick={handleCopy}
                    className="px-4 py-2 rounded-lg bg-maroon text-ivory text-xs font-sans font-semibold hover:bg-maroon/90 transition cursor-pointer flex items-center justify-center gap-1"
                  >
                    {copiedCode ? "Copied!" : "Copy Link"}
                  </button>
                  <a
                    href={`https://api.whatsapp.com/send?text=${encodeURIComponent(`Experience single-estate Himalayan teas and rare spices at Henley. Use code "${referralCode}" for 10% off: ${shareUrl}`)}`}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="px-4 py-2 rounded-lg bg-[#25D366] text-white text-xs font-sans font-semibold hover:bg-[#25D366]/90 transition flex items-center justify-center gap-1"
                  >
                    💬 WhatsApp
                  </a>
                </div>
              </div>

              {/* Wallet Summary */}
              <div className="p-4 bg-sand/50 rounded-xl border border-border/80 flex items-center justify-between">
                <div>
                  <p className="text-xs font-sans font-semibold text-charcoal">Available Store Credit Balance</p>
                  <p className="text-[11px] text-charcoal/60">Automatically usable at checkout on your next ritual.</p>
                </div>
                <span className="font-serif text-2xl text-maroon font-bold">
                  ₹{walletBalance.toLocaleString("en-IN")}
                </span>
              </div>
            </div>
          )}

          {/* ── TAB 4: PROFILE & PREFERENCES ─────────────────── */}
          {activeTab === "profile" && (
            <div className="bg-sand/30 border border-border rounded-xl p-6 max-w-2xl space-y-6">
              <div>
                <h3 className="font-serif text-xl text-charcoal">Collector Profile Details</h3>
                <p className="text-xs text-charcoal/65 mt-0.5">
                  Update your contact details and dispatch notification preferences.
                </p>
              </div>

              <form onSubmit={handleSaveProfile} className="space-y-4 text-xs font-sans">
                <div>
                  <label className="block text-charcoal/70 mb-1 font-medium">Full Name</label>
                  <input
                    type="text"
                    value={fullName}
                    onChange={(e) => setFullName(e.target.value)}
                    className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                  />
                </div>

                <div>
                  <label className="block text-charcoal/70 mb-1 font-medium">Email Address</label>
                  <input
                    type="email"
                    defaultValue={user.email}
                    disabled
                    className="w-full h-10 px-3 bg-white/70 border border-border rounded-lg text-charcoal/60 cursor-not-allowed"
                  />
                  <span className="text-[10px] text-charcoal/40 mt-0.5 block">
                    Contact concierge to update verified account email.
                  </span>
                </div>

                <div>
                  <label className="block text-charcoal/70 mb-1 font-medium">WhatsApp / Phone Number</label>
                  <input
                    type="text"
                    value={phone}
                    onChange={(e) => setPhone(e.target.value)}
                    className="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                  />
                </div>

                <div className="pt-2">
                  <Button variant="primary" type="submit" className="!h-10 !text-xs">
                    Save Account Changes
                  </Button>
                  {profileSaved && (
                    <span className="ml-3 text-xs text-success font-medium">
                      ✓ Profile details updated successfully!
                    </span>
                  )}
                </div>
              </form>
            </div>
          )}
        </div>
      </div>

      {/* Location Modal for Changing PIN */}
      <LocationPromptModal
        isOpen={locationModalOpen}
        onClose={() => {
          setLocationModalOpen(false);
          setSavedLocation(getSavedLocation());
        }}
      />
    </div>
  );
}
