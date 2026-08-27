import React from "react";

/**
 * <Button />
 *
 * Core button primitive with three variants:
 * - primary: filled maroon pill, all-caps label (e.g. "ADD TO RITUAL")
 * - secondary: outline pill with maroon border
 * - ghost: text-only with hover underline
 *
 * All variants use full-round border radius (999px pill shape).
 */

type ButtonVariant = "primary" | "secondary" | "ghost";

interface ButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  variant?: ButtonVariant;
  children: React.ReactNode;
}

const baseClasses = `
  inline-flex items-center justify-center gap-2
  font-sans font-medium text-sm tracking-[0.1em] uppercase
  transition-all duration-300 ease-[cubic-bezier(0.25,1,0.5,1)]
  cursor-pointer select-none
  disabled:opacity-50 disabled:cursor-not-allowed
  focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-maroon
`;

const variantClasses: Record<ButtonVariant, string> = {
  primary: `
    bg-maroon text-ivory
    px-8 py-3.5
    rounded-full
    hover:bg-maroon-dark active:bg-maroon-dark
    hover:shadow-card
  `,
  secondary: `
    bg-transparent text-maroon
    px-8 py-3.5
    rounded-full
    border border-maroon
    hover:bg-maroon hover:text-ivory
    active:bg-maroon-dark active:text-ivory
  `,
  ghost: `
    bg-transparent text-charcoal
    px-4 py-2
    rounded-full
    hover:text-maroon
    underline-offset-4 hover:underline
  `,
};

export default function Button({
  variant = "primary",
  children,
  className = "",
  ...props
}: ButtonProps) {
  return (
    <button
      className={`${baseClasses} ${variantClasses[variant]} ${className}`}
      {...props}
    >
      {children}
    </button>
  );
}
