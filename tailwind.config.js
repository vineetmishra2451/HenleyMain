/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './app/Filament/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        canvas: {
          DEFAULT: '#FBF9F6',
          base: '#FBF9F6',
        },
        surface: {
          DEFAULT: '#F5F3EF',
          raised: '#F5F3EF',
          card: '#FFFFFF',
          dark: '#1D1714',
        },
        border: {
          DEFAULT: '#E5DFD6',
          neutral: '#E5DFD6',
          gold: '#B08B4F',
          error: '#E53E3E',
        },
        content: {
          primary: '#231C18',
          secondary: '#6E635B',
          muted: '#8E8278',
          inverse: '#FBF9F6',
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
        alert: {
          error: '#9B2C2C',
          errorSurface: '#FFF5F5',
        }
      },
      fontFamily: {
        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
        sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
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
        'card-hover': '0 10px 30px -4px rgba(35, 28, 24, 0.07)',
      },
      transitionTimingFunction: {
        'henley': 'cubic-bezier(0.25, 1, 0.5, 1)',
      }
    },
  },
  plugins: [],
}
