import { LegalPageTemplate, LONG_LEGAL_SECTIONS } from "@/components";

export const metadata = {
  title: "Terms & Conditions — Henley Botanical Reserve",
  description: "Terms governing the purchase and reservation of botanical goods from Henley.",
};

export default function TermsRoute() {
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
