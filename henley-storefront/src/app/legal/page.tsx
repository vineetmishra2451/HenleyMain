import { LegalPageTemplate, LONG_LEGAL_SECTIONS } from "@/components";

export const metadata = {
  title: "Legal Policies & Terms — Henley Botanical Reserve",
  description: "Governance, privacy, delivery terms, and member rights at Henley.",
};

export default function LegalRoute() {
  return (
    <LegalPageTemplate
      title="Terms & Conditions"
      lastUpdated="August 28, 2026"
      description="These terms delineate the purchase, reservation, and fulfillment standards for all Henley botanical reserves."
      sections={LONG_LEGAL_SECTIONS}
      activeDocument="terms"
    />
  );
}
