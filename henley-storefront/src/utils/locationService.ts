/**
 * Henley Botanical Reserve - Location & Delivery Service
 * Manages PIN code validation, service tier resolution,
 * backend cross-checking, and persistent browser storage.
 */

export interface LocationServiceResult {
  serviceable: boolean;
  pincode: string;
  city: string | null;
  state: string | null;
  zone: string;
  deliveryEstimate: string;
  estimatedDays: number;
  expressAvailable: boolean;
  codAvailable: boolean;
  message: string;
}

const STORAGE_KEY = "henley_delivery_location";
const PROMPTED_SESSION_KEY = "henley_location_prompted_session";

export const POPULAR_METROS = [
  { city: "Mumbai", pincode: "400050", state: "Maharashtra" },
  { city: "New Delhi", pincode: "110001", state: "Delhi" },
  { city: "Bengaluru", pincode: "560001", state: "Karnataka" },
  { city: "Kolkata", pincode: "700019", state: "West Bengal" },
  { city: "Chennai", pincode: "600028", state: "Tamil Nadu" },
  { city: "Hyderabad", pincode: "500034", state: "Telangana" },
  { city: "Pune", pincode: "411001", state: "Maharashtra" },
  { city: "Jaipur", pincode: "302001", state: "Rajasthan" },
];

/**
 * Cross-checks PIN code with backend API (/api/check-pincode) with
 * built-in intelligent fallback to support offline / static dev.
 */
export async function checkPincodeAvailability(pincode: string): Promise<LocationServiceResult> {
  const cleanPin = pincode.trim();

  // Basic 6-digit regex check
  if (!/^[1-9][0-9]{5}$/.test(cleanPin)) {
    return {
      serviceable: false,
      pincode: cleanPin,
      city: null,
      state: null,
      zone: "invalid",
      deliveryEstimate: "",
      estimatedDays: 0,
      expressAvailable: false,
      codAvailable: false,
      message: "Please enter a valid 6-digit Indian postal PIN code.",
    };
  }

  // Attempt backend API call to cross-check with database & admin blocked pincodes
  try {
    const res = await fetch(`http://localhost/api/check-pincode?pincode=${cleanPin}`, {
      headers: { Accept: "application/json" },
    });
    if (res.ok) {
      const data = await res.json();
      return {
        serviceable: data.serviceable,
        pincode: data.pincode,
        city: data.city,
        state: data.state,
        zone: data.zone,
        deliveryEstimate: data.delivery_estimate,
        estimatedDays: data.estimated_days,
        expressAvailable: data.express_available,
        codAvailable: data.cod_available,
        message: data.message,
      };
    }
  } catch {
    // Graceful fallback to client-side zone computation if backend is unreachable
  }

  return resolveLocalPincode(cleanPin);
}

/**
 * Local fallback calculation matching backend rules.
 */
function resolveLocalPincode(pincode: string): LocationServiceResult {
  const prefix = pincode.substring(0, 3);
  const prefixMap: Record<string, { city: string; state: string; zone: string; days: number; express: boolean }> = {
    "400": { city: "Mumbai", state: "Maharashtra", zone: "metro", days: 1, express: true },
    "401": { city: "Thane", state: "Maharashtra", zone: "metro", days: 2, express: true },
    "411": { city: "Pune", state: "Maharashtra", zone: "metro", days: 2, express: true },
    "110": { city: "New Delhi", state: "Delhi", zone: "metro", days: 2, express: true },
    "122": { city: "Gurugram", state: "Haryana", zone: "metro", days: 2, express: true },
    "201": { city: "Noida", state: "Uttar Pradesh", zone: "metro", days: 2, express: true },
    "560": { city: "Bengaluru", state: "Karnataka", zone: "metro", days: 2, express: true },
    "500": { city: "Hyderabad", state: "Telangana", zone: "metro", days: 2, express: true },
    "600": { city: "Chennai", state: "Tamil Nadu", zone: "metro", days: 2, express: true },
    "700": { city: "Kolkata", state: "West Bengal", zone: "metro", days: 2, express: true },
    "380": { city: "Ahmedabad", state: "Gujarat", zone: "metro", days: 2, express: true },
    "160": { city: "Chandigarh", state: "Punjab", zone: "metro", days: 2, express: true },
    "302": { city: "Jaipur", state: "Rajasthan", zone: "tier2", days: 3, express: false },
    "734": { city: "Siliguri / Darjeeling", state: "West Bengal", zone: "tier2", days: 2, express: true },
    "682": { city: "Kochi", state: "Kerala", zone: "tier2", days: 3, express: false },
    "685": { city: "Munnar", state: "Kerala", zone: "tier2", days: 3, express: false },
    "641": { city: "Coimbatore", state: "Tamil Nadu", zone: "tier2", days: 3, express: false },
  };

  const match = prefixMap[prefix];
  const city = match ? match.city : "Regional Hub";
  const state = match ? match.state : "India";
  const zone = match ? match.zone : "standard";
  const days = match ? match.days : 4;
  const express = match ? match.express : false;

  const targetDate = new Date();
  targetDate.setDate(targetDate.getDate() + days);
  const options: Intl.DateTimeFormatOptions = { weekday: "long", month: "short", day: "numeric" };
  const formattedDate = targetDate.toLocaleDateString("en-IN", options);

  return {
    serviceable: true,
    pincode,
    city,
    state,
    zone,
    deliveryEstimate: `Estimated delivery by ${formattedDate}`,
    estimatedDays: days,
    expressAvailable: express,
    codAvailable: true,
    message: `Service confirmed for ${city}, ${state} (${pincode}).`,
  };
}

/**
 * Retrieve saved location from browser localStorage.
 */
export function getSavedLocation(): LocationServiceResult | null {
  if (typeof window === "undefined") return null;
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return null;
    return JSON.parse(raw);
  } catch {
    return null;
  }
}

/**
 * Persist saved location and broadcast to all storefront components.
 */
export function setSavedLocation(location: LocationServiceResult): void {
  if (typeof window === "undefined") return;
  try {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(location));
    window.dispatchEvent(new CustomEvent("henley-location-changed", { detail: location }));
  } catch {
    // Ignore localStorage write error
  }
}

/**
 * Check if the user has already been prompted for location in the current session.
 */
export function hasBeenPromptedForLocation(): boolean {
  if (typeof window === "undefined") return true;
  return sessionStorage.getItem(PROMPTED_SESSION_KEY) === "true";
}

/**
 * Mark location prompt as shown for this browser session.
 */
export function markLocationAsPrompted(): void {
  if (typeof window === "undefined") return;
  sessionStorage.setItem(PROMPTED_SESSION_KEY, "true");
}

/**
 * Attempt to autodetect user location using HTML5 Geolocation.
 */
export async function detectBrowserLocation(): Promise<LocationServiceResult> {
  return new Promise((resolve) => {
    if (typeof window === "undefined" || !navigator.geolocation) {
      resolve(resolveLocalPincode("400050"));
      return;
    }

    navigator.geolocation.getCurrentPosition(
      async (pos) => {
        const lat = pos.coords.latitude;
        const lon = pos.coords.longitude;

        let resolvedPin = "400050"; // default Mumbai

        if (lat > 28.3 && lat < 28.9 && lon > 76.8 && lon < 77.5) {
          resolvedPin = "110001"; // Delhi
        } else if (lat > 12.8 && lat < 13.2 && lon > 77.4 && lon < 77.8) {
          resolvedPin = "560001"; // Bengaluru
        } else if (lat > 22.4 && lat < 22.7 && lon > 88.2 && lon < 88.5) {
          resolvedPin = "700019"; // Kolkata
        } else if (lat > 12.9 && lat < 13.2 && lon > 80.1 && lon < 80.4) {
          resolvedPin = "600028"; // Chennai
        } else if (lat > 17.2 && lat < 17.6 && lon > 78.3 && lon < 78.6) {
          resolvedPin = "500034"; // Hyderabad
        } else if (lat > 18.4 && lat < 18.7 && lon > 73.7 && lon < 74.0) {
          resolvedPin = "411001"; // Pune
        }

        const result = await checkPincodeAvailability(resolvedPin);
        resolve(result);
      },
      () => {
        // Fallback to Mumbai 400050 on permission denied or error
        resolve(resolveLocalPincode("400050"));
      },
      { timeout: 8000 }
    );
  });
}
