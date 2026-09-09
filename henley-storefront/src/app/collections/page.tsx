import { Suspense } from "react";
import { ProductListingPage } from "@/components";
import { COLLECTIONS } from "@/data/catalog";

export const metadata = {
  title: "Curated Collections — Henley",
  description: "Discover our meticulously crafted blends, designed to restore balance and elevate your daily rituals.",
};

type Props = {
  searchParams: Promise<{ [key: string]: string | string[] | undefined }>;
};

export default async function CollectionsPage({ searchParams }: Props) {
  const resolved = await searchParams;
  const cat = typeof resolved?.cat === "string" ? resolved.cat : undefined;
  const collection = cat ? COLLECTIONS.find((c) => c.slug === cat) : undefined;

  return (
    <ProductListingPage
      key={cat || "all"}
      variant="category"
      activeCollectionSlug={cat}
      title={collection ? collection.name : "Curated Collections"}
      description={
        collection
          ? collection.description
          : "Discover our 5 botanical collections: single-estate teas, rare whole spices, stoneground grains, cooking essentials, and pure cocoa."
      }
      breadcrumbs={
        collection
          ? [
              { label: "Home", href: "/" },
              { label: "Collections", href: "/collections" },
              { label: collection.name },
            ]
          : [
              { label: "Home", href: "/" },
              { label: "Collections" },
            ]
      }
    />
  );
}
