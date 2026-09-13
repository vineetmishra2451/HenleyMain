/**
 * Henley Botanical Reserve - Customer Referral & Wallet Service
 *
 * Rules:
 * - Referee receives flat 10% off on their first order above ₹500.
 * - Referrer receives 20% of the cart value as store credit in their wallet.
 */

export interface ReferralValidationResult {
  valid: boolean;
  code: string;
  discountPercent: number;
  discountAmount: number;
  referrerCreditPercent: number;
  referrerCreditAmount: number;
  referrerName: string | null;
  message: string;
}

export interface WalletTransaction {
  id: string;
  type: "credit" | "debit";
  amount: number;
  balanceAfter: number;
  description: string;
  date: string;
}

const REFERRAL_COOKIE_KEY = "henley_active_referral_code";
const CUSTOM_CODE_KEY = "henley_user_custom_referral_code";
const WALLET_BALANCE_KEY = "henley_user_wallet_balance";
const WALLET_TRANSACTIONS_KEY = "henley_user_wallet_transactions";

/**
 * Capture referral code from URL search param ?ref=...
 */
export function captureReferralCodeFromUrl(): string | null {
  if (typeof window === "undefined") return null;

  const urlParams = new URLSearchParams(window.location.search);
  const refCode = urlParams.get("ref");

  if (refCode) {
    const clean = refCode.trim().toUpperCase();
    localStorage.setItem(REFERRAL_COOKIE_KEY, clean);
    return clean;
  }

  return localStorage.getItem(REFERRAL_COOKIE_KEY);
}

/**
 * Get the active referral code being used for checkout discount.
 */
export function getActiveReferralCode(): string | null {
  if (typeof window === "undefined") return null;
  return localStorage.getItem(REFERRAL_COOKIE_KEY);
}

/**
 * Clear applied referral code after order completion.
 */
export function clearActiveReferralCode(): void {
  if (typeof window === "undefined") return;
  localStorage.removeItem(REFERRAL_COOKIE_KEY);
}

/**
 * Get or initialize user's custom sharing code (default: HENLEY-ANANYA).
 */
export function getUserReferralCode(): string {
  if (typeof window === "undefined") return "HENLEY-ANANYA";
  const stored = localStorage.getItem(CUSTOM_CODE_KEY);
  if (stored) return stored;

  const defaultCode = "HENLEY-ANANYA";
  localStorage.setItem(CUSTOM_CODE_KEY, defaultCode);
  return defaultCode;
}

/**
 * Update user's custom sharing code.
 */
export function setUserReferralCode(newCode: string): string {
  const clean = newCode.trim().toUpperCase().replace(/[^A-Z0-9-]/g, "");
  if (typeof window !== "undefined" && clean) {
    localStorage.setItem(CUSTOM_CODE_KEY, clean);
  }
  return clean || "HENLEY-ANANYA";
}

/**
 * Validate a referral code against current cart subtotal.
 * Referee receives flat 10% off on orders above ₹500.
 */
export async function validateReferralCode(
  code: string,
  cartTotal: number
): Promise<ReferralValidationResult> {
  const cleanCode = code.trim().toUpperCase();

  if (!cleanCode) {
    return {
      valid: false,
      code: "",
      discountPercent: 0,
      discountAmount: 0,
      referrerCreditPercent: 0,
      referrerCreditAmount: 0,
      referrerName: null,
      message: "Please enter a referral code.",
    };
  }

  // Attempt backend verification
  try {
    const res = await fetch(
      `http://localhost/api/referral/validate?code=${encodeURIComponent(cleanCode)}&amount=${cartTotal}`,
      { headers: { Accept: "application/json" } }
    );
    if (res.ok) {
      const data = await res.json();
      return {
        valid: data.valid,
        code: data.code,
        discountPercent: data.discount_percent,
        discountAmount: data.discount_amount,
        referrerCreditPercent: data.referrer_credit_percent,
        referrerCreditAmount: data.referrer_credit_amount,
        referrerName: data.referrer_name,
        message: data.message,
      };
    }
  } catch {
    // Graceful fallback to client-side validation logic
  }

  // Fallback verification for demo / offline
  const validCodes = ["HENLEY-ANANYA", "HENLEY-ANANYA-88", "HENLEY-PATRON", "HENLEY-WELCOME"];
  const isValid = validCodes.includes(cleanCode) || cleanCode.startsWith("HENLEY-");

  if (!isValid) {
    return {
      valid: false,
      code: cleanCode,
      discountPercent: 0,
      discountAmount: 0,
      referrerCreditPercent: 0,
      referrerCreditAmount: 0,
      referrerName: null,
      message: `Referral code '${cleanCode}' is invalid or expired.`,
    };
  }

  if (cartTotal <= 500) {
    return {
      valid: false,
      code: cleanCode,
      discountPercent: 10,
      discountAmount: 0,
      referrerCreditPercent: 20,
      referrerCreditAmount: 0,
      referrerName: "Ananya Singhal",
      message: "Referral discount requires an order above ₹500. Add more botanical reserves to qualify.",
    };
  }

  const discountAmount = Math.round(cartTotal * 0.10);
  const referrerCreditAmount = Math.round(cartTotal * 0.20);

  return {
    valid: true,
    code: cleanCode,
    discountPercent: 10,
    discountAmount,
    referrerCreditPercent: 20,
    referrerCreditAmount,
    referrerName: "Ananya Singhal",
    message: `Referral code applied: 10% off (-₹${discountAmount}) courtesy of Ananya Singhal.`,
  };
}

/**
 * Retrieve current customer wallet store credit balance.
 */
export function getWalletBalance(): number {
  if (typeof window === "undefined") return 1200;
  const stored = localStorage.getItem(WALLET_BALANCE_KEY);
  if (stored !== null) {
    return parseFloat(stored) || 0;
  }
  // Initialize sample demo customer wallet balance with ₹1,200
  localStorage.setItem(WALLET_BALANCE_KEY, "1200.00");
  return 1200;
}

/**
 * Deduct from customer wallet when using credits at checkout.
 */
export function deductWalletCredit(amount: number, description: string): number {
  const current = getWalletBalance();
  const next = Math.max(0, current - amount);

  if (typeof window !== "undefined") {
    localStorage.setItem(WALLET_BALANCE_KEY, next.toFixed(2));
    appendWalletTransaction({
      id: `wt-${Date.now()}`,
      type: "debit",
      amount,
      balanceAfter: next,
      description,
      date: new Date().toLocaleDateString("en-IN", { month: "short", day: "numeric", year: "numeric" }),
    });
  }

  return next;
}

/**
 * Add store credit to customer wallet (e.g. 20% referral bonus).
 */
export function addWalletCredit(amount: number, description: string): number {
  const current = getWalletBalance();
  const next = current + amount;

  if (typeof window !== "undefined") {
    localStorage.setItem(WALLET_BALANCE_KEY, next.toFixed(2));
    appendWalletTransaction({
      id: `wt-${Date.now()}`,
      type: "credit",
      amount,
      balanceAfter: next,
      description,
      date: new Date().toLocaleDateString("en-IN", { month: "short", day: "numeric", year: "numeric" }),
    });
  }

  return next;
}

/**
 * Retrieve customer wallet transactions ledger.
 */
export function getWalletTransactions(): WalletTransaction[] {
  if (typeof window === "undefined") return [];
  try {
    const raw = localStorage.getItem(WALLET_TRANSACTIONS_KEY);
    if (!raw) {
      const initial: WalletTransaction[] = [
        {
          id: "wt-init-1",
          type: "credit",
          amount: 600,
          balanceAfter: 1200,
          description: "Referral Bonus (20% of Rohan Mehra's First Ritual ₹3,000)",
          date: "Sep 08, 2026",
        },
        {
          id: "wt-init-2",
          type: "credit",
          amount: 600,
          balanceAfter: 600,
          description: "Referral Bonus (20% of Devika Sen's First Ritual ₹3,000)",
          date: "Aug 29, 2026",
        },
      ];
      localStorage.setItem(WALLET_TRANSACTIONS_KEY, JSON.stringify(initial));
      return initial;
    }
    return JSON.parse(raw);
  } catch {
    return [];
  }
}

function appendWalletTransaction(tx: WalletTransaction): void {
  const list = getWalletTransactions();
  list.unshift(tx);
  localStorage.setItem(WALLET_TRANSACTIONS_KEY, JSON.stringify(list.slice(0, 20)));
}
