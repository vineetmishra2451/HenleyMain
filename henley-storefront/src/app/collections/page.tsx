import { ProductListingPage } from "@/components";

export const metadata = {
  title: "Curated Collections — Henley",
  description: "Discover our meticulously crafted blends, designed to restore balance and elevate your daily rituals.",
};

export default function CollectionsPage() {
  return <ProductListingPage variant="category" title="Curated Collections" />;
}
