/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './app/Filament/**/*.php',
    './app/Livewire/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        // Base canvas & surfaces
        canvas: '#FBF9F6',
        page: '#FBF9F6',
        surface: {
          DEFAULT: '#FBF9F6',
          raised: '#F5F3EF',
          card: '#FFFFFF',
          dark: '#1D1714',
        },
        // Typography colors
        primary: '#231C18',
        secondary: '#6E635B',
        muted: '#8E8278',
        inverse: '#FBF9F6',
        // Hairline borders
        hairline: {
          DEFAULT: '#E5DFD6',
          neutral: '#E5DFD6',
          gold: '#B08B4F',
        },
        border: {
          DEFAULT: '#E5DFD6',
          hairline: '#E5DFD6',
          gold: '#B08B4F',
          error: '#9B2C2C',
        },
        // Brand accents
        accent: {
          DEFAULT: '#5C2225', // Henley Oxblood
          hover: '#4A1B1D',
          deep: '#3E1517',
        },
        oxblood: {
          DEFAULT: '#5C2225',
          hover: '#4A1B1D',
          deep: '#3E1517',
        },
        saffron: {
          DEFAULT: '#A6332F',
          surface: '#FAECEB',
          text: '#8E2824',
        },
        gold: {
          DEFAULT: '#B08B4F',
          surface: '#F7F3E8',
          text: '#755A25',
        },
        sage: {
          DEFAULT: '#7F8A6E',
          surface: '#E8ECE3',
          text: '#3B4833',
        },
        error: {
          DEFAULT: '#9B2C2C',
          surface: '#FFF5F5',
        },
      },
      fontFamily: {
        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
        sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
      },
      fontSize: {
        'display-hero': ['3.5rem', { lineHeight: '1.08', letterSpacing: '-0.025em' }],
        'display-hero-mobile': ['2.375rem', { lineHeight: '1.12', letterSpacing: '-0.02em' }],
        'display-1': ['2.625rem', { lineHeight: '1.12', letterSpacing: '-0.02em' }],
        'display-1-mobile': ['2.0rem', { lineHeight: '1.15', letterSpacing: '-0.015em' }],
        'display-2': ['2.0rem', { lineHeight: '1.18', letterSpacing: '-0.015em' }],
        'display-2-mobile': ['1.625rem', { lineHeight: '1.20', letterSpacing: '-0.01em' }],
        'display-3': ['1.5rem', { lineHeight: '1.24', letterSpacing: '-0.01em' }],
        'price-hero': ['2.0rem', { lineHeight: '1.10', letterSpacing: '-0.01em' }],
        'price-card': ['1.25rem', { lineHeight: '1.20', letterSpacing: '0em' }],
        'body-lead': ['1.125rem', { lineHeight: '1.60', letterSpacing: '-0.005em' }],
        'body': ['1.0rem', { lineHeight: '1.65', letterSpacing: '0em' }],
        'ui': ['0.9375rem', { lineHeight: '1.40', letterSpacing: '+0.01em' }],
        'eyebrow': ['0.75rem', { lineHeight: '1.30', letterSpacing: '+0.18em' }],
        'caption': ['0.8125rem', { lineHeight: '1.45', letterSpacing: '+0.01em' }],
        'badge': ['0.6875rem', { lineHeight: '1.20', letterSpacing: '+0.12em' }],
      },
      borderRadius: {
        'sm': '4px',
        'md': '8px',
        'lg': '12px',
        'xl': '16px',
        'arch': '9999px 9999px 0 0',
        'full': '9999px',
      },
      boxShadow: {
        'subtle': '0 4px 20px -2px rgba(35, 28, 24, 0.04)',
        'hover': '0 10px 30px -4px rgba(35, 28, 24, 0.07)',
        'card-hover': '0 10px 30px -4px rgba(35, 28, 24, 0.07)',
      },
      transitionTimingFunction: {
        'henley': 'cubic-bezier(0.25, 1, 0.5, 1)',
      },
      transitionDuration: {
        'fast': '250ms',
        'normal': '350ms',
        'slow': '500ms',
      },
      maxWidth: {
        'content': '1280px',
        'prose': '65ch',
      }
    },
  },
  plugins: [],
}
