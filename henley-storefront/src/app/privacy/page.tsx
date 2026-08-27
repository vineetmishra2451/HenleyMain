import { LegalPageTemplate, LONG_LEGAL_SECTIONS } from "@/components";

export const metadata = {
  title: "Privacy Policy — Henley Botanical Reserve",
  description: "Our standards regarding member data confidentiality, encrypted authentication, and privacy.",
};

const PRIVACY_SECTIONS = [
  {
    id: "priv-1",
    number: "1.0",
    title: "Philosophy of Member Confidentiality",
    paragraphs: [
      "Henley treats member data with the same uncompromising purity we demand of our botanical harvests. We collect only information strictly necessary to process allocations and manage your member ritual.",
    ],
  },
  {
    id: "priv-2",
    number: "2.0",
    title: "Information Collected & WhatsApp Verification",
    paragraphs: [
      "We collect contact names, shipping addresses, email addresses, and verified mobile numbers used for WhatsApp passwordless authentication.",
      "We do not store plain-text payment credentials or unauthorized telemetry data.",
    ],
  },
  {
    id: "priv-3",
    number: "3.0",
    title: "Purpose of Data Processing",
    paragraphs: [
      "Your data is used solely to fulfill consignments, transmit harvest reservation alerts, and provide concierge customer support.",
    ],
  },
  {
    id: "priv-4",
    number: "4.0",
    title: "No Third-Party Advertising Monetization",
    paragraphs: [
      "Henley does not sell, license, rent, or trade member data with third-party marketing networks or data brokers under any circumstance.",
    ],
  },
  {
    id: "priv-5",
    number: "5.0",
    title: "Payment Processing & PCI-DSS Encryption",
    paragraphs: [
      "All card transactions are processed directly via certified PCI-DSS Level 1 payment vaults. No cardholder data is retained on our local application servers.",
    ],
  },
  {
    id: "priv-6",
    number: "6.0",
    title: "Cookies & Local Storage Preferences",
    paragraphs: [
      "We utilize essential session tokens and local storage strictly to preserve your cart contents, currency preferences, and active authentication state.",
    ],
  },
  {
    id: "priv-7",
    number: "7.0",
    title: "Data Retention & Archival Policies",
    paragraphs: [
      "Account records are maintained throughout the life of your membership. You may request total erasure of non-tax transaction history at any time.",
    ],
  },
  {
    id: "priv-8",
    number: "8.0",
    title: "Member Rights (GDPR / CCPA / International)",
    paragraphs: [
      "Members have the right to request full export of their personal data, correct inaccurate details, or object to processing by writing to concierge.",
    ],
  },
  {
    id: "priv-9",
    number: "9.0",
    title: "International Data Transfers & Safeguards",
    paragraphs: [
      "Data transferred internationally for carrier tracking and dispatch is protected by standard contractual clauses and end-to-end encryption protocols.",
    ],
  },
  {
    id: "priv-10",
    number: "10.0",
    title: "Contacting the Data Protection Officer",
    paragraphs: [
      "For privacy inquiries or deletion requests, contact our Data Protection Officer at privacy@henleybotanicals.com or write to our London flagship.",
    ],
  },
];

export default function PrivacyRoute() {
  return (
    <LegalPageTemplate
      title="Privacy Policy"
      lastUpdated="August 28, 2026"
      description="Our commitment to safeguarding member confidentiality, personal details, and encrypted authentication."
      sections={PRIVACY_SECTIONS}
      activeDocument="privacy"
    />
  );
}
