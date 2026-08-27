"use client";

import React, { useState } from "react";
import PlaceholderImage from "../PlaceholderImage";
import Button from "../Button";

/* ================================================================
   CONTACT US (<ContactPage />)
   ================================================================
   Two-column layout:
   - Left: Contact form (Name, Email, Subject, Message, primary Send CTA)
   - Right: Contact details card (Address, Email, Phone) + 16:9 Map placeholder
   ================================================================ */

export default function ContactPage() {
  const [fullName, setFullName] = useState("");
  const [email, setEmail] = useState("");
  const [subject, setSubject] = useState("Orders & Inquiries");
  const [message, setMessage] = useState("");
  const [errors, setErrors] = useState<{ [key: string]: string }>({});
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [isSubmitted, setIsSubmitted] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const newErrors: { [key: string]: string } = {};

    if (!fullName.trim()) newErrors.fullName = "Please enter your name.";
    if (!email || !/\S+@\S+\.\S+/.test(email)) newErrors.email = "Please enter a valid email address.";
    if (!message.trim() || message.length < 10) newErrors.message = "Please enter a message of at least 10 characters.";

    if (Object.keys(newErrors).length > 0) {
      setErrors(newErrors);
      return;
    }

    setErrors({});
    setIsSubmitting(true);

    setTimeout(() => {
      setIsSubmitting(false);
      setIsSubmitted(true);
      setFullName("");
      setEmail("");
      setMessage("");
    }, 700);
  };

  return (
    <div className="bg-ivory min-h-screen">
      {/* ── Breadcrumb ────────────────────────────────────────── */}
      <div className="henley-container pt-6 pb-2">
        <nav
          aria-label="Breadcrumbs"
          className="flex items-center gap-2 text-xs font-sans text-charcoal/50"
        >
          <a href="/" className="hover:text-maroon transition-colors">
            Home
          </a>
          <span className="text-charcoal/30">/</span>
          <span className="text-charcoal font-medium">Contact Us</span>
        </nav>
      </div>

      {/* ── Header ────────────────────────────────────────────── */}
      <header className="henley-container py-8 lg:py-12 border-b border-border/80 text-center max-w-2xl mx-auto space-y-2">
        <p className="text-eyebrow text-gold font-medium tracking-[0.14em]">
          Concierge & Inquiries
        </p>
        <h1 className="font-serif text-3xl sm:text-4xl text-charcoal font-normal">
          We Welcome Your Message
        </h1>
        <p className="text-xs sm:text-sm text-charcoal/65 leading-relaxed">
          Whether inquiring about private reserves, wholesale partnerships, or brewing guidance, our apothecary team is at your service.
        </p>
      </header>

      {/* ── Two-Column Layout ─────────────────────────────────── */}
      <div className="henley-container py-10 lg:py-16">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-start">
          {/* ════════════════════════════════════════════════════
              LEFT COLUMN: CONTACT FORM (7 Cols)
             ════════════════════════════════════════════════════ */}
          <div className="lg:col-span-7 bg-white rounded-2xl border border-border p-6 sm:p-10 shadow-subtle space-y-6">
            <div>
              <h2 className="font-serif text-2xl text-charcoal mb-1">
                Send an Inquiry
              </h2>
              <p className="text-xs font-sans text-charcoal/60">
                Responses are dispatched within 24 business hours.
              </p>
            </div>

            {isSubmitted ? (
              <div className="p-6 bg-success/10 border border-success/30 rounded-xl text-center space-y-3 animate-fade-in">
                <div className="w-12 h-12 mx-auto rounded-full bg-success/20 text-success flex items-center justify-center">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                    <polyline points="20 6 9 17 4 12" />
                  </svg>
                </div>
                <h3 className="font-serif text-lg text-charcoal">
                  Message Received
                </h3>
                <p className="text-xs font-sans text-charcoal/70 max-w-sm mx-auto">
                  Thank you for writing to Henley. Our apothecary concierge has received your request and will respond shortly.
                </p>
                <Button
                  variant="secondary"
                  className="!text-xs !py-2"
                  onClick={() => setIsSubmitted(false)}
                >
                  Send Another Message
                </Button>
              </div>
            ) : (
              <form onSubmit={handleSubmit} className="space-y-4">
                {/* Full Name */}
                <div className="space-y-1">
                  <label className="block text-xs font-sans font-semibold uppercase tracking-[0.08em] text-charcoal/70">
                    Your Name
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

                {/* Email */}
                <div className="space-y-1">
                  <label className="block text-xs font-sans font-semibold uppercase tracking-[0.08em] text-charcoal/70">
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

                {/* Subject Selector */}
                <div className="space-y-1">
                  <label className="block text-xs font-sans font-semibold uppercase tracking-[0.08em] text-charcoal/70">
                    Topic of Inquiry
                  </label>
                  <select
                    value={subject}
                    onChange={(e) => setSubject(e.target.value)}
                    className="w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border border-border bg-white text-charcoal focus:outline-none focus:border-maroon cursor-pointer"
                  >
                    <option value="Orders & Inquiries">Orders & Shipping Inquiries</option>
                    <option value="Product Guidance">Botanical & Culinary Guidance</option>
                    <option value="Private Reserve Sourcing">Private Reserve & Saffron Orders</option>
                    <option value="Wholesale & Press">Hospitality & Wholesale Partnerships</option>
                  </select>
                </div>

                {/* Message */}
                <div className="space-y-1">
                  <label className="block text-xs font-sans font-semibold uppercase tracking-[0.08em] text-charcoal/70">
                    Your Message
                  </label>
                  <textarea
                    rows={5}
                    value={message}
                    onChange={(e) => {
                      setMessage(e.target.value);
                      setErrors((prev) => ({ ...prev, message: "" }));
                    }}
                    placeholder="Please share how we may assist your botanical journey..."
                    className={`
                      w-full px-3.5 py-2.5 text-xs font-sans rounded-lg border bg-white text-charcoal
                      placeholder:text-charcoal/35 focus:outline-none transition-all resize-y
                      ${
                        errors.message
                          ? "border-error bg-error/5 focus:border-error"
                          : "border-border focus:border-maroon focus:ring-1 focus:ring-maroon/20"
                      }
                    `}
                  />
                  {errors.message && (
                    <p className="text-[11px] font-sans text-error">{errors.message}</p>
                  )}
                </div>

                {/* Submit Button */}
                <Button
                  type="submit"
                  variant="primary"
                  className="w-full !h-12 !text-xs !tracking-wider flex items-center justify-center gap-2"
                  disabled={isSubmitting}
                >
                  {isSubmitting ? "Transmitting message..." : "Send Message →"}
                </Button>
              </form>
            )}
          </div>

          {/* ════════════════════════════════════════════════════
              RIGHT COLUMN: CONTACT DETAILS & MAP (5 Cols)
             ════════════════════════════════════════════════════ */}
          <div className="lg:col-span-5 space-y-6">
            {/* Details Card */}
            <div className="bg-sand/60 rounded-2xl border border-border p-6 sm:p-8 space-y-6 shadow-subtle">
              <h2 className="font-serif text-xl text-charcoal pb-3 border-b border-border">
                Flagship Apothecary
              </h2>

              <div className="space-y-4 text-xs font-sans">
                {/* Address */}
                <div className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-full bg-white border border-border flex items-center justify-center text-maroon flex-shrink-0">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                  </div>
                  <div>
                    <p className="font-semibold text-charcoal">Henley Sanctuary & Tasting Room</p>
                    <p className="text-charcoal/60 leading-relaxed">
                      44 Botanical Way, St. James&apos;s<br />
                      London SW1A 1HA, United Kingdom
                    </p>
                  </div>
                </div>

                {/* Email */}
                <div className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-full bg-white border border-border flex items-center justify-center text-maroon flex-shrink-0">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                      <polyline points="22,6 12,13 2,6" />
                    </svg>
                  </div>
                  <div>
                    <p className="font-semibold text-charcoal">Concierge Direct</p>
                    <p className="text-charcoal/60">concierge@henleybotanicals.com</p>
                  </div>
                </div>

                {/* Phone */}
                <div className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-full bg-white border border-border flex items-center justify-center text-maroon flex-shrink-0">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                  </div>
                  <div>
                    <p className="font-semibold text-charcoal">Apothecary Desk</p>
                    <p className="text-charcoal/60">+44 (0) 20 7946 0912</p>
                  </div>
                </div>

                {/* Hours */}
                <div className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-full bg-white border border-border flex items-center justify-center text-maroon flex-shrink-0">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12 6 12 12 16 14" />
                    </svg>
                  </div>
                  <div>
                    <p className="font-semibold text-charcoal">Tasting Room Hours</p>
                    <p className="text-charcoal/60">
                      Tuesday – Saturday: 10:00 – 18:30<br />
                      Sunday – Monday: Private Appointments
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {/* 16:9 Map Placeholder */}
            <div className="rounded-2xl overflow-hidden border border-border shadow-subtle">
              <PlaceholderImage
                aspect="16:9"
                label="Map — Flagship Apothecary SW1A London"
                className="w-full"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
