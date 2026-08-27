import { ProductDetailPage } from "@/components";
import { PRODUCTS, findProductBySlug } from "@/data/catalog";

export async function generateStaticParams() {
  return PRODUCTS.map((p) => ({
    slug: p.id,
  }));
}

export async function generateMetadata({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  const product = findProductBySlug(slug);

  if (!product) {
    return {
      title: "Botanical Reserve — Henley",
      description: "Artisanal organic botanicals and single-origin whole spices from Henley.",
    };
  }

  return {
    title: `${product.name} — ${product.collection} | Henley Botanical Reserve`,
    description: `${product.subtitle}. ${product.description}`,
  };
}

export default async function DynamicProductPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  return <ProductDetailPage slug={slug} />;
}
