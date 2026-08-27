import { LegalPageTemplate, SHORT_LEGAL_SECTIONS } from "@/components";

export const metadata = {
  title: "Shipping & Delivery Policy — Henley Botanical Reserve",
  description: "Details regarding our carbon-neutral packaging, shipping windows, and complimentary thresholds.",
};

export default function ShippingRoute() {
  return (
    <LegalPageTemplate
      title="Shipping & Delivery Policy"
      lastUpdated="August 28, 2026"
      description="Guidelines covering temperature-controlled dispatch, carbon-neutral shipping, and international delivery."
      sections={SHORT_LEGAL_SECTIONS}
      activeDocument="shipping"
    />
  );
}
