import { ProductListingPage } from "@/components";

export const metadata = {
  title: "Search Catalog — Henley Botanical Reserve",
  description: "Search our complete botanical collection of teas, rare whole spices, and culinary pantry essentials.",
};

type Props = {
  searchParams: Promise<{ [key: string]: string | string[] | undefined }>;
};

export default async function SearchPage({ searchParams }: Props) {
  const resolved = await searchParams;
  const q = typeof resolved?.q === "string" ? resolved.q : "";

  return (
    <ProductListingPage
      key={q || "all"}
      variant="search"
      searchQuery={q}
      title={q ? `Search Results for "${q}"` : "Search Our Sanctuary"}
      description={
        q
          ? `Showing matching botanical harvests and reserves for "${q}".`
          : "Explore all single-origin teas, rare spices, and pantry essentials."
      }
      breadcrumbs={[
        { label: "Home", href: "/" },
        { label: "Search" },
        ...(q ? [{ label: `"${q}"` }] : []),
      ]}
    />
  );
}
