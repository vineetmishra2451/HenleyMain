"use client";

import React from "react";
import { CartProvider, Header, Footer, CartDrawer } from "@/components";

/**
 * LayoutShell — Client component wrapper for the root layout.
 *
 * Wraps all pages with CartProvider (shared state), Header, Footer,
 * and CartDrawer. Separated from layout.tsx so the root layout
 * can remain a server component and export metadata.
 */
export function LayoutShell({ children }: { children: React.ReactNode }) {
  return (
    <CartProvider>
      <Header />
      <main className="flex-1 pb-16 lg:pb-0">{children}</main>
      <Footer />
      <CartDrawer />
    </CartProvider>
  );
}
