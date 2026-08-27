"use client";

import React, { createContext, useContext, useState, useCallback } from "react";

/* ================================================================
   Cart Context
   ================================================================
   Shares cart open/close state + placeholder line items between
   the Header (cart icon trigger) and the CartDrawer.
   ================================================================ */

export interface CartLineItem {
  id: string;
  name: string;
  variant: string;
  price: string;
  quantity: number;
}

interface CartContextValue {
  isOpen: boolean;
  open: () => void;
  close: () => void;
  toggle: () => void;
  items: CartLineItem[];
  itemCount: number;
  subtotal: string;
  updateQuantity: (id: string, quantity: number) => void;
  removeItem: (id: string) => void;
}

const CartContext = createContext<CartContextValue | null>(null);

export function useCart() {
  const ctx = useContext(CartContext);
  if (!ctx) throw new Error("useCart must be used within <CartProvider>");
  return ctx;
}

// Placeholder line items for preview
const PLACEHOLDER_ITEMS: CartLineItem[] = [
  {
    id: "1",
    name: "Saffron",
    variant: "5g Porcelain Jar",
    price: "₹2,499",
    quantity: 1,
  },
  {
    id: "2",
    name: "Herb & Spice Tea",
    variant: "100g Jar",
    price: "₹1,299",
    quantity: 2,
  },
  {
    id: "3",
    name: "Cardamom",
    variant: "100g Jar",
    price: "₹1,499",
    quantity: 1,
  },
];

export function CartProvider({ children }: { children: React.ReactNode }) {
  const [isOpen, setIsOpen] = useState(false);
  const [items, setItems] = useState<CartLineItem[]>(PLACEHOLDER_ITEMS);

  const open = useCallback(() => setIsOpen(true), []);
  const close = useCallback(() => setIsOpen(false), []);
  const toggle = useCallback(() => setIsOpen((v) => !v), []);

  const updateQuantity = useCallback((id: string, quantity: number) => {
    if (quantity < 1) return;
    setItems((prev) =>
      prev.map((item) => (item.id === id ? { ...item, quantity } : item))
    );
  }, []);

  const removeItem = useCallback((id: string) => {
    setItems((prev) => prev.filter((item) => item.id !== id));
  }, []);

  const itemCount = items.reduce((sum, item) => sum + item.quantity, 0);

  // Subtotal calculation in INR
  const numericSubtotal = items.reduce((sum, item) => {
    const price = parseFloat(item.price.replace(/[^\d.]/g, "")) || 0;
    return sum + price * item.quantity;
  }, 0);

  const subtotal = "₹" + numericSubtotal.toLocaleString("en-IN");

  return (
    <CartContext.Provider
      value={{ isOpen, open, close, toggle, items, itemCount, subtotal, updateQuantity, removeItem }}
    >
      {children}
    </CartContext.Provider>
  );
}
