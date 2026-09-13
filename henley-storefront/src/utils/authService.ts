/**
 * Henley Botanical Reserve - Customer Auth & Session Service
 */

export interface AuthUser {
  id: string;
  name: string;
  email: string;
  phone: string;
  tier: string;
  memberSince: string;
  walletBalance: number;
  referralCode: string;
}

const AUTH_USER_KEY = "henley_auth_user";

export const DEFAULT_DEMO_USER: AuthUser = {
  id: "usr-8819",
  name: "Ananya Singhal",
  email: "collector@henleytea.com",
  phone: "+91 98200 11223",
  tier: "Grand Patron Reserve",
  memberSince: "2026",
  walletBalance: 1200,
  referralCode: "HENLEY-ANANYA",
};

/**
 * Get current authenticated user from localStorage.
 */
export function getAuthenticatedUser(): AuthUser | null {
  if (typeof window === "undefined") return null;
  try {
    const raw = localStorage.getItem(AUTH_USER_KEY);
    if (!raw) return null;
    return JSON.parse(raw);
  } catch {
    return null;
  }
}

/**
 * Log in user and persist session.
 */
export function loginUser(user: Partial<AuthUser> = {}): AuthUser {
  const fullUser: AuthUser = {
    ...DEFAULT_DEMO_USER,
    ...user,
  };

  if (typeof window !== "undefined") {
    localStorage.setItem(AUTH_USER_KEY, JSON.stringify(fullUser));
    window.dispatchEvent(new CustomEvent("henley-auth-changed", { detail: fullUser }));
  }

  return fullUser;
}

/**
 * Log out user and clear session.
 */
export function logoutUser(): void {
  if (typeof window !== "undefined") {
    localStorage.removeItem(AUTH_USER_KEY);
    window.dispatchEvent(new CustomEvent("henley-auth-changed", { detail: null }));
  }
}
