import { ProductListingPage } from "@/components";

export const metadata = {
  title: "Shop All Teas & Botanical Blends — Henley",
  description: "Explore our complete apothecary of rare single-estate teas and organic infusions.",
};

export default function ShopPage() {
  return <ProductListingPage variant="all" title="Shop All" />;
}
