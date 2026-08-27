import { ProductDetailPage } from "@/components";

export async function generateMetadata({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  const title = slug
    .split("-")
    .map((w) => w.charAt(0).toUpperCase() + w.slice(1))
    .join(" ");

  return {
    title: `${title} — Henley Apothecary`,
    description: `Hand-blended artisanal botanical tea and whole herbs from Henley.`,
  };
}

export default function DynamicProductPage() {
  return <ProductDetailPage />;
}
