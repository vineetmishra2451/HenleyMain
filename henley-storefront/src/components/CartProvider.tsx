"use client";

import React, { createContext, useContext, useState, useCallback, useEffect } from "react";

/* ================================================================
   CART PROVIDER (<CartProvider />)
   ================================================================
   Production-ready Shopping Cart Context:
   - Clean empty state initialization (no phantom/dummy items)
   - Synchronized with browser localStorage (henley_cart_v2)
   - Immutable state management for add/update/remove/clear
   - Precise itemKey derivation to prevent item collisions or drops
   - Auto-computes item count and Indian Rupee (₹) subtotals
   ================================================================ */

export interface CartLineItem {
  id: string;
  name: string;
  variant: string;
  price: string;
  quantity: number;
}

export interface AddItemPayload {
  id?: string;
  name: string;
  variant?: string;
  price: string;
  quantity?: number;
}

interface CartContextValue {
  isOpen: boolean;
  open: () => void;
  close: () => void;
  toggle: () => void;
  items: CartLineItem[];
  itemCount: number;
  subtotal: string;
  numericSubtotal: number;
  addItem: (item: AddItemPayload) => void;
  updateQuantity: (id: string, quantity: number) => void;
  removeItem: (id: string) => void;
  clearCart: () => void;
}

const CartContext = createContext<CartContextValue | null>(null);

export function useCart() {
  const ctx = useContext(CartContext);
  if (!ctx) throw new Error("useCart must be used within <CartProvider>");
  return ctx;
}

const STORAGE_KEY = "henley_cart_items_v2";

export function CartProvider({ children }: { children: React.ReactNode }) {
  const [isOpen, setIsOpen] = useState(false);
  const [items, setItems] = useState<CartLineItem[]>([]);
  const [isLoaded, setIsLoaded] = useState(false);

  // 1. Hydrate cart from localStorage on initial mount
  useEffect(() => {
    try {
      const saved = window.localStorage.getItem(STORAGE_KEY);
      if (saved) {
        const parsed = JSON.parse(saved);
        if (Array.isArray(parsed)) {
          setItems(parsed);
        }
      }
    } catch {
      // Storage unavailable or disabled
    }
    setIsLoaded(true);
  }, []);

  // 2. Persist cart changes to localStorage
  useEffect(() => {
    if (!isLoaded) return;
    try {
      window.localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
    } catch {
      // Storage quota or disabled
    }
  }, [items, isLoaded]);

  const open = useCallback(() => setIsOpen(true), []);
  const close = useCallback(() => setIsOpen(false), []);
  const toggle = useCallback(() => setIsOpen((v) => !v), []);

  // Add Item to Cart
  const addItem = useCallback((payload: AddItemPayload) => {
    if (!payload || !payload.name) return;

    const qty = payload.quantity && payload.quantity > 0 ? payload.quantity : 1;
    const variantName = payload.variant || "Standard Pack";
    const baseSlug = (payload.id || payload.name)
      .toLowerCase()
      .replace(/[^a-z0-9]+/g, "-")
      .replace(/^-|-$/g, "");
    
    // Stable composite ID per product variant
    const lineItemId = `${baseSlug}__${variantName.toLowerCase().replace(/[^a-z0-9]+/g, "-")}`;

    setItems((prevItems) => {
      const existingIdx = prevItems.findIndex(
        (item) =>
          item.id === lineItemId ||
          (item.name.toLowerCase() === payload.name.toLowerCase() && item.variant === variantName)
      );

      if (existingIdx > -1) {
        // Increment quantity for existing item
        return prevItems.map((item, idx) => {
          if (idx === existingIdx) {
            return {
              ...item,
              quantity: item.quantity + qty,
              price: payload.price || item.price,
            };
          }
          return item;
        });
      }

      // Add as new line item
      const newItem: CartLineItem = {
        id: lineItemId,
        name: payload.name,
        variant: variantName,
        price: payload.price,
        quantity: qty,
      };

      return [...prevItems, newItem];
    });

    // Open cart drawer immediately
    setIsOpen(true);
  }, []);

  // Update Item Quantity
  const updateQuantity = useCallback((id: string, quantity: number) => {
    setItems((prevItems) => {
      if (quantity <= 0) {
        return prevItems.filter((item) => item.id !== id);
      }
      return prevItems.map((item) =>
        item.id === id ? { ...item, quantity } : item
      );
    });
  }, []);

  // Remove Item
  const removeItem = useCallback((id: string) => {
    setItems((prevItems) => prevItems.filter((item) => item.id !== id));
  }, []);

  // Clear Cart
  const clearCart = useCallback(() => {
    setItems([]);
  }, []);

  // Aggregate count & subtotal
  const itemCount = items.reduce((sum, item) => sum + (item.quantity || 0), 0);

  const numericSubtotal = items.reduce((sum, item) => {
    const unit = parseFloat(item.price.replace(/[^\d.]/g, "")) || 0;
    return sum + unit * (item.quantity || 0);
  }, 0);

  const subtotal = "₹" + numericSubtotal.toLocaleString("en-IN");

  return (
    <CartContext.Provider
      value={{
        isOpen,
        open,
        close,
        toggle,
        items,
        itemCount,
        subtotal,
        numericSubtotal,
        addItem,
        updateQuantity,
        removeItem,
        clearCart,
      }}
    >
      {children}
    </CartContext.Provider>
  );
}
