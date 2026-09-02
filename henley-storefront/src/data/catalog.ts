export interface Collection {
  id: string;
  name: string;
  slug: string;
  productCount: number;
  description: string;
  image?: string;
  badge?: "organic" | "bestseller" | "sale" | "lowstock";
  badgeLabel?: string;
}

export interface ProductItem {
  id: string;
  name: string;
  subtitle: string;
  collection: "Tea" | "Herbs & Spices" | "Flours & Grains" | "Cooking Essentials" | "Cocoa";
  collectionSlug: string;
  price: string;
  compareAt?: string;
  numericPrice: number;
  rating: number;
  reviewCount: number;
  image?: string;
  badge?: "organic" | "bestseller" | "sale" | "lowstock";
  badgeLabel?: string;
  benefits: string[];
  weights: string[];
  description: string;
}

export const COLLECTIONS: Collection[] = [
  {
    id: "col-tea",
    name: "Tea",
    slug: "tea",
    productCount: 2,
    image: "/pimages/tea.jpg",
    description: "Single-estate Himalayan orthodox teas and ancestral herbal infusions sealed in bone-white cloches.",
    badge: "bestseller",
    badgeLabel: "Signature",
  },
  {
    id: "col-herbs-spices",
    name: "Herbs & Spices",
    slug: "herbs-spices",
    productCount: 12,
    image: "/pimages/cardamom.jpg",
    description: "Rare single-origin whole spices, hand-harvested botanicals, and sun-dried culinary aromatics.",
    badge: "organic",
    badgeLabel: "100% Organic",
  },
  {
    id: "col-flours-grains",
    name: "Flours & Grains",
    slug: "flours-grains",
    productCount: 4,
    image: "/pimages/besan.jpg",
    description: "Slow-milled ancient stoneground flours, unbleached heirloom wheat, and pure pulse flours.",
  },
  {
    id: "col-cooking-essentials",
    name: "Cooking Essentials",
    slug: "cooking-essentials",
    productCount: 3,
    image: "/pimages/sugarjpg.jpg",
    description: "Unrefined mineral-rich sugars and naturally extracted heirloom starches for intentional cooking.",
  },
  {
    id: "col-cocoa",
    name: "Cocoa",
    slug: "cocoa",
    productCount: 1,
    image: "/pimages/cocoa.jpg",
    description: "Single-estate pure Dutch cocoa powder cold-pressed from heirloom Criollo cacao beans.",
    badge: "sale",
    badgeLabel: "Limited",
  },
];

export const PRODUCTS: ProductItem[] = [
  // ── 1. TEA (2 Products) ──────────────────────────────────
  {
    id: "tea-herb-spice",
    name: "Herb & Spice Tea",
    subtitle: "Sacred Himalayan Botanical & Whole Warming Spice Infusion",
    collection: "Tea",
    collectionSlug: "tea",
    price: "₹1,299",
    compareAt: "₹1,499",
    numericPrice: 1299,
    rating: 5,
    reviewCount: 164,
    image: "/pimages/tea.jpg",
    badge: "bestseller",
    badgeLabel: "Bestseller",
    benefits: ["Immunity", "Digestion", "Calm", "Relaxation"],
    weights: ["100g Cloche Jar", "250g Refill", "50g Discovery"],
    description: "An ancient restorative tisane blending mountain holy basil (tulsi), crushed green cardamom pods, cassia bark, and dried wild ginger roots.",
  },
  {
    id: "tea-pure-natural",
    name: "Pure & Natural Tea",
    subtitle: "High-Altitude Single-Estate Orthodox Whole Leaf Green Tea",
    collection: "Tea",
    collectionSlug: "tea",
    price: "₹1,699",
    numericPrice: 1699,
    rating: 5,
    reviewCount: 128,
    image: "/pimages/6.jpg",
    badge: "organic",
    badgeLabel: "Single Estate",
    benefits: ["Antioxidants", "Energy", "Focus", "Metabolism"],
    weights: ["100g Cloche Jar", "250g Refill"],
    description: "Hand-plucked first flush leaves from mist-shrouded Himalayan gardens. Steamed in small brass pans to preserve delicate sweet floral notes.",
  },

  // ── 2. HERBS & SPICES (12 Products) ──────────────────────
  {
    id: "spice-coriander",
    name: "Coriander",
    subtitle: "Sun-Dried Malabar Whole Golden Coriander Seeds",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹499",
    numericPrice: 499,
    rating: 4.5,
    reviewCount: 89,
    image: "/pimages/coriander.jpg",
    benefits: ["Digestion", "Cooling", "Immunity"],
    weights: ["150g Jar", "300g Pouch"],
    description: "Harvested at peak morning aroma. Citrusy, sweet, and lightly toasted on low-heat stone hearths before airtight sealing.",
  },
  {
    id: "spice-red-chilli",
    name: "Red Chilli",
    subtitle: "Sun-Cured Guntur Whole Dried Crimson Chillies",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹599",
    numericPrice: 599,
    rating: 5,
    reviewCount: 145,
    image: "/pimages/redchilli.jpg",
    badge: "organic",
    badgeLabel: "Sun Cured",
    benefits: ["Metabolism", "Circulation", "Warmth"],
    weights: ["150g Jar", "300g Pouch"],
    description: "Vibrant crimson pods grown without synthetic pesticides. Slow dried under southern sun for robust warmth and complex smoky sweetness.",
  },
  {
    id: "spice-turmeric",
    name: "Turmeric",
    subtitle: "High-Curcumin Pure Lakadong Heritage Turmeric Root",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹799",
    compareAt: "₹999",
    numericPrice: 799,
    rating: 5,
    reviewCount: 240,
    image: "/pimages/turmeric.jpg",
    badge: "bestseller",
    badgeLabel: "9% Curcumin",
    benefits: ["Anti-inflammatory", "Immunity", "Radiance", "Joints"],
    weights: ["150g Jar", "350g Refill", "75g Discovery"],
    description: "Grown in the mineral-dense soils of Jaintia Hills, Meghalaya. Contains up to 9% natural curcumin for unmatched bioactive vitality.",
  },
  {
    id: "spice-cumin",
    name: "Cumin",
    subtitle: "Hand-Harvested Whole Rajasthani Cumin Seeds",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹549",
    numericPrice: 549,
    rating: 4.5,
    reviewCount: 96,
    image: "/pimages/cumin.jpg",
    benefits: ["Digestion", "Iron", "Metabolism"],
    weights: ["150g Jar", "300g Pouch"],
    description: "Intensely earthy and warm aromatic seeds hand-sifted to eliminate chaff and sealed in UV-blocking glass.",
  },
  {
    id: "spice-black-pepper",
    name: "Black Pepper",
    subtitle: "Tellicherry Extra Bold Whole Peppercorns",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹899",
    compareAt: "₹1,099",
    numericPrice: 899,
    rating: 5,
    reviewCount: 142,
    image: "/pimages/blackoeooer.jpg",
    badge: "bestseller",
    badgeLabel: "Extra Bold",
    benefits: ["Digestion", "Nutrient Absorption", "Respiratory"],
    weights: ["150g Jar", "300g Pouch"],
    description: "Vine-ripened in the dense canopy of Wayanad, Kerala. Unusually large 4.25mm berries bursting with pungent piperine and citrus nuance.",
  },
  {
    id: "spice-cardamom",
    name: "Cardamom",
    subtitle: "High-Elevation Idukki Jumbo Green Cardamom Pods",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹1,499",
    compareAt: "₹1,799",
    numericPrice: 1499,
    rating: 5,
    reviewCount: 198,
    image: "/pimages/cardamom.jpg",
    badge: "organic",
    badgeLabel: "Grade A",
    benefits: ["Calm", "Freshness", "Digestion", "Aroma"],
    weights: ["100g Jar", "250g Tin", "50g Discovery"],
    description: "8mm+ emerald pods plucked from misty Kerala hillsides. Retains resinous, sweet floral essential oils that release instantly upon crushing.",
  },
  {
    id: "spice-cloves",
    name: "Cloves",
    subtitle: "Handpicked Zanzibar-Lineage Whole Head Cloves",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹849",
    numericPrice: 849,
    rating: 4.5,
    reviewCount: 78,
    image: "/pimages/18.jpg",
    benefits: ["Oral Health", "Immunity", "Warmth"],
    weights: ["100g Jar", "200g Pouch"],
    description: "Unopened flower buds rich in natural eugenol oil. Clean, spicy-sweet profile with intense numbing warmth.",
  },
  {
    id: "spice-fennel",
    name: "Fennel",
    subtitle: "Sweet Lucknow Tiny Green Whole Fennel Seeds",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹499",
    numericPrice: 499,
    rating: 4.5,
    reviewCount: 64,
    image: "/pimages/fennel.jpg",
    benefits: ["Digestion", "Breath", "Relaxation"],
    weights: ["150g Jar", "300g Pouch"],
    description: "Naturally sweet and cooling aniseed aromatics harvested in early spring. Ideal for post-meal digestive infusions.",
  },
  {
    id: "spice-saffron",
    name: "Saffron",
    subtitle: "Grade A1 Super Negin Kashmiri Mogra Saffron Filaments",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹2,499",
    compareAt: "₹2,999",
    numericPrice: 2499,
    rating: 5,
    reviewCount: 310,
    image: "/pimages/saffron.jpg",
    badge: "bestseller",
    badgeLabel: "Kashmiri Mogra",
    benefits: ["Mood", "Skin Radiance", "Antioxidants", "Sleep"],
    weights: ["2g Glass Well", "5g Porcelain Jar", "10g Reserve Tin"],
    description: "The crown jewel of botanicals. Deep crimson stigmas hand-culled from purple crocus flowers in Pampore, Kashmir. Rich in crocin and safranal.",
  },
  {
    id: "spice-star-anise",
    name: "Star Anise",
    subtitle: "Wild-Harvested Whole Eight-Point Star Anise",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹699",
    numericPrice: 699,
    rating: 4.5,
    reviewCount: 52,
    image: "/pimages/staranise.jpg",
    benefits: ["Immunity", "Digestion", "Calm"],
    weights: ["100g Jar", "250g Pouch"],
    description: "Intact symmetrical stars sourced from native mountain evergreen trees. Liquorice notes essential for slow broth broths and spiced teas.",
  },
  {
    id: "spice-cinnamon",
    name: "Cinnamon",
    subtitle: "Pure Ceylon Alba Grade Thin-Quill Cinnamon Sticks",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹999",
    compareAt: "₹1,199",
    numericPrice: 999,
    rating: 5,
    reviewCount: 167,
    image: "/pimages/cinnamon.jpg",
    badge: "organic",
    badgeLabel: "True Ceylon",
    benefits: ["Blood Sugar", "Metabolism", "Heart", "Warmth"],
    weights: ["100g Jar", "250g Tin"],
    description: "True Ceylon cinnamon quills hand-rolled from ultra-thin inner bark layers. Naturally low coumarin with delicate woody sweet aroma.",
  },
  {
    id: "spice-fenugreek",
    name: "Fenugreek",
    subtitle: "Golden Whole Methi Seeds with Maple Nuances",
    collection: "Herbs & Spices",
    collectionSlug: "herbs-spices",
    price: "₹399",
    numericPrice: 399,
    rating: 4.5,
    reviewCount: 43,
    image: "/pimages/fnugreek.jpg",
    benefits: ["Digestion", "Lactation", "Metabolism"],
    weights: ["150g Jar", "350g Pouch"],
    description: "Nutritious golden angular seeds prized for centuries in Ayurvedic preparations for digestive equilibrium.",
  },

  // ── 3. FLOURS & GRAINS (4 Products) ──────────────────────
  {
    id: "grain-wheat",
    name: "Wheat",
    subtitle: "Single-Variety 100% Whole Sharbati Wheat Flour",
    collection: "Flours & Grains",
    collectionSlug: "flours-grains",
    price: "₹699",
    numericPrice: 699,
    rating: 4.5,
    reviewCount: 88,
    image: "/pimages/wheat.jpg",
    badge: "organic",
    badgeLabel: "Stoneground",
    benefits: ["Energy", "Fiber", "Heart"],
    weights: ["1kg Bag", "2.5kg Sack", "5kg Reserve"],
    description: "Unbleached, whole-kernel grain milled on natural emery stones at low RPM to keep the nutrient-dense wheatgerm alive.",
  },
  {
    id: "grain-besan",
    name: "Besan",
    subtitle: "Artisanal Chana Dal Slow-Ground Chickpea Flour",
    collection: "Flours & Grains",
    collectionSlug: "flours-grains",
    price: "₹599",
    numericPrice: 599,
    rating: 5,
    reviewCount: 112,
    image: "/pimages/besan.jpg",
    benefits: ["Protein", "Gluten-Free", "Digestion"],
    weights: ["500g Jar", "1kg Pouch", "2kg Sack"],
    description: "Naturally gluten-free pulse flour with a sweet nutty aroma. Milled from sun-dried desi brown chickpeas.",
  },
  {
    id: "grain-maida",
    name: "Maida",
    subtitle: "Unbleached Fine Heirloom Wheat Pastry Flour",
    collection: "Flours & Grains",
    collectionSlug: "flours-grains",
    price: "₹499",
    numericPrice: 499,
    rating: 4.5,
    reviewCount: 65,
    image: "/pimages/maida.jpg",
    benefits: ["Baking", "Texture"],
    weights: ["1kg Bag", "2kg Sack"],
    description: "Traditional unbleached fine flour free of chemical ripening agents, benzoyl peroxide, or synthetic additives.",
  },
  {
    id: "grain-corn",
    name: "Corn",
    subtitle: "Non-GMO Stoneground Pure Yellow Maize Flour",
    collection: "Flours & Grains",
    collectionSlug: "flours-grains",
    price: "₹549",
    numericPrice: 549,
    rating: 4.5,
    reviewCount: 49,
    image: "/pimages/corn.jpg",
    benefits: ["Gluten-Free", "Fiber", "Eye Health"],
    weights: ["1kg Bag", "2kg Sack"],
    description: "Sun-ripened open-pollinated yellow heirloom maize slowly pulverized on cold water-driven mill stones.",
  },

  // ── 4. COOKING ESSENTIALS (3 Products) ───────────────────
  {
    id: "ess-sugar",
    name: "Sugar",
    subtitle: "Unrefined Native Cane Khandsari Crystal Sugar",
    collection: "Cooking Essentials",
    collectionSlug: "cooking-essentials",
    price: "₹599",
    compareAt: "₹699",
    numericPrice: 599,
    rating: 5,
    reviewCount: 132,
    image: "/pimages/sugarjpg.jpg",
    badge: "organic",
    badgeLabel: "Unrefined",
    benefits: ["Minerals", "Natural Energy"],
    weights: ["500g Jar", "1kg Pouch", "2.5kg Tin"],
    description: "Pressed from organic mountain sugarcane juice without sulfur clarification. Golden crystals rich in molasses minerals.",
  },
  {
    id: "ess-sago",
    name: "Sago",
    subtitle: "Wild Tapioca Root Translucent Pearls",
    collection: "Cooking Essentials",
    collectionSlug: "cooking-essentials",
    price: "₹449",
    numericPrice: 449,
    rating: 4.5,
    reviewCount: 57,
    image: "/pimages/sago.jpg",
    benefits: ["Energy", "Digestion"],
    weights: ["500g Jar", "1kg Pouch"],
    description: "Tender, translucent pearls processed from premium cassava roots for comforting light puddings and savory dishes.",
  },
  {
    id: "ess-tapioca",
    name: "Tapioca",
    subtitle: "Artisanal Fine Native Cassava Starch",
    collection: "Cooking Essentials",
    collectionSlug: "cooking-essentials",
    price: "₹499",
    numericPrice: 499,
    rating: 4.5,
    reviewCount: 41,
    image: "/pimages/2.jpg",
    benefits: ["Digestion", "Gluten-Free"],
    weights: ["500g Jar", "1kg Pouch"],
    description: "Ultra-fine gluten-free thickening starch washed in mountain spring water and naturally sun-dried.",
  },

  // ── 5. COCOA (1 Product) ─────────────────────────────────
  {
    id: "cocoa-pure",
    name: "Cocoa",
    subtitle: "Single-Estate 100% Pure Dutch Cocoa Powder",
    collection: "Cocoa",
    collectionSlug: "cocoa",
    price: "₹1,299",
    compareAt: "₹1,499",
    numericPrice: 1299,
    rating: 5,
    reviewCount: 188,
    image: "/pimages/cocoa.jpg",
    badge: "bestseller",
    badgeLabel: "Reserve",
    benefits: ["Energy", "Focus", "Antioxidants", "Relaxation"],
    weights: ["200g Cloche Jar", "500g Refill"],
    description: "Cold-pressed from shade-grown heirloom Criollo cacao beans. Deep mahogany hue with velvety bittersweet nuance.",
  },
];

export function getProductSlug(p: ProductItem | { id: string; name: string }): string {
  return p.id;
}

export function findProductBySlug(slug: string): ProductItem | undefined {
  if (!slug) return PRODUCTS[0];
  const clean = slug.toLowerCase().trim();

  // 1. Direct ID match (e.g. "tea-herb-spice", "spice-saffron")
  const byId = PRODUCTS.find((p) => p.id.toLowerCase() === clean);
  if (byId) return byId;

  // 2. ID without prefix match (e.g. "herb-spice", "saffron")
  const byIdStripped = PRODUCTS.find(
    (p) => p.id.replace(/^(tea|spice|grain|ess|cocoa)-/, "").toLowerCase() === clean
  );
  if (byIdStripped) return byIdStripped;

  // 3. Name slug match (e.g. "herb-spice-tea", "black-pepper", "saffron")
  const byNameSlug = PRODUCTS.find(
    (p) => p.name.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/^-|-$/g, "") === clean
  );
  if (byNameSlug) return byNameSlug;

  // 4. Case-insensitive substring match
  const byNameFuzzy = PRODUCTS.find(
    (p) => p.name.toLowerCase().includes(clean) || clean.includes(p.name.toLowerCase())
  );
  if (byNameFuzzy) return byNameFuzzy;

  return PRODUCTS[0];
}

export function getAllProductSlugs(): string[] {
  return PRODUCTS.map((p) => p.id);
}
