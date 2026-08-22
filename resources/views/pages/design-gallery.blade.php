<x-layouts.design title="Henley — Living Component Gallery & Design System">
    <div class="min-h-screen bg-canvas text-primary flex">
        <!-- Sticky Left Sidebar Index (Desktop) -->
        <aside class="hidden lg:block w-72 h-screen sticky top-0 overflow-y-auto border-r border-hairline bg-surface-raised/60 p-6 z-30">
            <div class="space-y-6">
                <!-- Brand Masthead -->
                <div class="pb-6 border-b border-hairline">
                    <span class="font-serif text-2xl font-normal tracking-tight text-primary">HENLEY</span>
                    <div class="mt-1">
                        <x-eyebrow variant="accent" class="text-[10px]">Living Design System</x-eyebrow>
                    </div>
                </div>

                <!-- Navigation Index -->
                <nav class="space-y-1 text-xs uppercase tracking-[0.14em] font-medium" aria-label="Component sections">
                    <a href="#foundations" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">01. Foundations</a>
                    <a href="#typography" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">02. Typography</a>
                    <a href="#actions" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">03. Actions & Buttons</a>
                    <a href="#forms" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">04. Form Controls</a>
                    <a href="#layout" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">05. Layout & Dividers</a>
                    <a href="#content" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">06. Editorial Content</a>
                    <a href="#commerce" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">07. Commerce Elements</a>
                    <a href="#feedback" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">08. Overlays & Feedback</a>
                    <a href="#navigation" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">09. Navigation & Disclosure</a>
                    <a href="#media" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">10. Media & Apothecary Arch</a>
                    <a href="#icons" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">11. Line Iconography</a>
                </nav>

                <!-- Environment & Accessibility Badges -->
                <div class="pt-6 border-t border-hairline space-y-2">
                    <div class="flex items-center justify-between text-caption text-secondary">
                        <span>Environment</span>
                        <x-badge variant="sage">{{ app()->environment() }}</x-badge>
                    </div>
                    <div class="flex items-center justify-between text-caption text-secondary">
                        <span>WCAG 2.1</span>
                        <x-badge variant="gold">Level AA / AAA</x-badge>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 w-full overflow-x-hidden">
            <!-- Header Bar -->
            <header class="border-b border-hairline bg-surface-raised/40 px-6 sm:px-12 py-6 sticky top-0 z-20 backdrop-blur-md flex items-center justify-between">
                <div>
                    <h1 class="font-serif text-display-3 font-normal text-primary">Henley Design System</h1>
                    <p class="font-sans text-caption text-secondary mt-0.5">Semantic tokens, atomic components, and living visual standards</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/" class="text-xs uppercase tracking-widest font-semibold text-secondary hover:text-accent transition">
                        Storefront ↗
                    </a>
                </div>
            </header>

            <div class="px-6 sm:px-12 lg:px-16 py-12 max-w-7xl mx-auto space-y-24">

                <!-- ------------------------------------------------------------------- -->
                <!-- 01. FOUNDATIONS                                                     -->
                <!-- ------------------------------------------------------------------- -->
                <section id="foundations" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="01. Brand Foundations"
                        title="Semantic Color Roles & Surface Hierarchy"
                        description="Henley rejects stark cold grays and synthetic shadows. Depth is created via warm paper transitions and calibrated contrast ratios."
                        align="left"
                    />

                    <!-- Color Swatches Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- Canvas Base -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3 shadow-none">
                            <div class="h-16 w-full rounded-lg bg-canvas border border-hairline"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Canvas Base</span>
                                <span class="text-caption text-secondary">bg-canvas • #FBF9F6</span>
                                <span class="text-[11px] text-accent block mt-1">15.98:1 AAA vs Primary</span>
                            </div>
                        </div>

                        <!-- Raised Surface -->
                        <div class="p-4 rounded-xl border border-hairline bg-surface-raised space-y-3">
                            <div class="h-16 w-full rounded-lg bg-surface-raised border border-hairline"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Surface Raised</span>
                                <span class="text-caption text-secondary">bg-surface-raised • #F5F3EF</span>
                                <span class="text-[11px] text-accent block mt-1">15.15:1 AAA vs Primary</span>
                            </div>
                        </div>

                        <!-- Accent Oxblood -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-accent"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Oxblood (Primary Action)</span>
                                <span class="text-caption text-secondary">bg-accent • #5C2225</span>
                                <span class="text-[11px] text-accent block mt-1">12.28:1 AAA vs White</span>
                            </div>
                        </div>

                        <!-- Saffron -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-saffron"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Saffron (Product Star)</span>
                                <span class="text-caption text-secondary">bg-saffron • #A6332F</span>
                                <span class="text-[11px] text-accent block mt-1">6.37:1 AA vs Canvas</span>
                            </div>
                        </div>

                        <!-- Antique Gold -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-gold"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Antique Gold (Foil Only)</span>
                                <span class="text-caption text-secondary">border-gold • #B08B4F</span>
                                <span class="text-[11px] text-accent block mt-1">3.00:1 UI AA Non-Text</span>
                            </div>
                        </div>

                        <!-- Sage -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-sage"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Sage (Botanical & Stock)</span>
                                <span class="text-caption text-secondary">bg-sage • #7F8A6E</span>
                                <span class="text-[11px] text-accent block mt-1">8.12:1 AAA (text over pill)</span>
                            </div>
                        </div>

                        <!-- Hairline Neutral -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-hairline"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Hairline Neutral</span>
                                <span class="text-caption text-secondary">border-hairline • #E5DFD6</span>
                                <span class="text-[11px] text-secondary block mt-1">Structural 1px separator</span>
                            </div>
                        </div>

                        <!-- Surface Dark -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-surface-dark"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Surface Dark</span>
                                <span class="text-caption text-secondary">bg-surface-dark • #1D1714</span>
                                <span class="text-[11px] text-accent block mt-1">High contrast sections</span>
                            </div>
                        </div>
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 02. TYPOGRAPHY                                                      -->
                <!-- ------------------------------------------------------------------- -->
                <section id="typography" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="02. Typographic Scale"
                        title="Display Serif & Grotesque Pairing"
                        description="Self-hosted Cormorant Garamond provides fragrance-house editorial refinement, balanced by Plus Jakarta Sans for precision UI controls."
                        align="left"
                    />

                    <div class="space-y-6 rounded-2xl border border-hairline bg-surface-raised p-6 sm:p-10 divide-y divide-hairline">
                        <div class="pb-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Display Hero (56px / 3.5rem)</span>
                            <div class="font-serif text-display-hero text-primary leading-tight">
                                Pure leaf. Pure intent.
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Display 1 (42px / 2.625rem)</span>
                            <div class="font-serif text-display-1 text-primary leading-tight">
                                First Flush Darjeeling — Castleton Lot 04
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Display 2 (32px / 2.0rem)</span>
                            <div class="font-serif text-display-2 text-primary">
                                The Unhurried Ritual of Single-Estate Botanicals
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Display 3 (24px / 1.5rem)</span>
                            <div class="font-serif text-display-3 text-primary">
                                Imperial Silver Needle White Tea
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Price Hero & Price Card</span>
                            <div class="flex items-center gap-8">
                                <div>
                                    <span class="text-[11px] text-secondary block">Hero Price:</span>
                                    <x-commerce.price price="3800" compare-at-price="4200" size="hero" />
                                </div>
                                <div>
                                    <span class="text-[11px] text-secondary block">Card Price:</span>
                                    <x-commerce.price price="1450" size="card" />
                                </div>
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Body Lead & Standard Body (18px & 16px)</span>
                            <p class="text-body-lead text-secondary mb-2">
                                Hand-harvested during the first seventy-two hours of Himalayan spring thaw at an elevation of 1,800 meters.
                            </p>
                            <p class="text-body text-primary">
                                Every batch is packed within 24 hours of firing into porcelain cloche jars, protecting volatile monoterpenes and floral muscatel esters.
                            </p>
                        </div>

                        <div class="pt-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Eyebrow & Badge</span>
                            <div class="flex items-center gap-4">
                                <x-eyebrow variant="accent">Single Estate • Spring 2026</x-eyebrow>
                                <x-badge variant="sage">100% Biodynamic</x-badge>
                                <x-badge variant="gold">Bestseller</x-badge>
                                <x-badge variant="saffron">Limited Harvest</x-badge>
                            </div>
                        </div>
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 03. ACTIONS & BUTTONS                                               -->
                <!-- ------------------------------------------------------------------- -->
                <section id="actions" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="03. Interactive Controls"
                        title="Actions, Buttons & Tactile States"
                        description="Buttons use oxblood fills, hairline outlines, and responsive hover transitions with a signature 3px trailing arrow motion."
                        align="left"
                    />

                    <!-- Variants & Sizes Grid -->
                    <div class="p-6 sm:p-10 rounded-2xl border border-hairline bg-surface-raised space-y-8">
                        <!-- Primary Buttons with Trailing Arrow -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-4">Primary Variant (Oxblood Fill)</span>
                            <div class="flex flex-wrap items-center gap-4">
                                <x-button variant="primary" size="lg" trailing-arrow>Add to Ritual</x-button>
                                <x-button variant="primary" size="md" trailing-arrow>Explore Harvest</x-button>
                                <x-button variant="primary" size="sm" trailing-arrow>Quick Add</x-button>
                                <x-button variant="primary" size="md" loading>Processing</x-button>
                                <x-button variant="primary" size="md" disabled>Sold Out</x-button>
                            </div>
                        </div>

                        <!-- Secondary Buttons -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-4">Secondary Variant (Hairline Outline)</span>
                            <div class="flex flex-wrap items-center gap-4">
                                <x-button variant="secondary" size="lg">View Tasting Notes</x-button>
                                <x-button variant="secondary" size="md">Filter Catalog</x-button>
                                <x-button variant="secondary" size="sm">Select Size</x-button>
                                <x-button variant="secondary" size="md" disabled>Unavailable</x-button>
                            </div>
                        </div>

                        <!-- Ghost & Destructive -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-4">Ghost & Destructive</span>
                            <div class="flex flex-wrap items-center gap-4">
                                <x-button variant="ghost" size="md">Clear All Filters</x-button>
                                <x-button variant="destructive" size="md">Remove Item</x-button>
                                <x-link-button href="#foundations" variant="secondary" size="sm" trailing-arrow>Back to Top</x-link-button>
                            </div>
                        </div>

                        <!-- Icon Buttons -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-4">Icon Buttons</span>
                            <div class="flex items-center gap-4">
                                <x-icon-button label="Add to Wishlist" variant="secondary" size="md">
                                    <x-icons.heart class="w-4 h-4" />
                                </x-icon-button>
                                <x-icon-button label="Shopping Bag" variant="primary" size="md">
                                    <x-icons.bag class="w-4 h-4" />
                                </x-icon-button>
                                <x-icon-button label="Search" variant="ghost" size="md">
                                    <x-icons.search class="w-4 h-4" />
                                </x-icon-button>
                                <x-icon-button label="Filter" variant="secondary" size="sm">
                                    <x-icons.filter class="w-3.5 h-3.5" />
                                </x-icon-button>
                            </div>
                        </div>
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 04. FORM CONTROLS                                                   -->
                <!-- ------------------------------------------------------------------- -->
                <section id="forms" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="04. Forms & Input Wells"
                        title="Calibrated Form Architecture"
                        description="Form inputs utilize high-contrast pure white wells against the warm paper canvas, with saffron error announcements."
                        align="left"
                    />

                    <div class="p-6 sm:p-10 rounded-2xl border border-hairline bg-surface-raised space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-form.input
                                name="full_name"
                                label="Full Name"
                                placeholder="Lady Margaret Henley"
                                hint="As you would like it inscribed on certificate"
                                required
                            />

                            <x-form.input
                                name="email_error"
                                label="Email Address"
                                value="invalid-email-format"
                                error="Please enter a valid email address."
                                required
                            />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-form.select
                                name="flush_season"
                                label="Harvest Season"
                                :options="[
                                    'first_flush' => 'First Flush (Early Spring)',
                                    'second_flush' => 'Second Flush (Muscatel Summer)',
                                    'autumnal' => 'Autumnal Harvest (Rich & Roasted)'
                                ]"
                            />

                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-[0.14em] text-primary mb-1.5">Search Catalogue</label>
                                <x-form.search-input value="Darjeeling Spring" />
                            </div>
                        </div>

                        <x-form.textarea
                            name="gift_note"
                            label="Apothecary Gift Inscription"
                            placeholder="Add a personalized calligraphy message to accompany your gift cloche..."
                            rows="3"
                        />

                        <!-- Variant Radio Cards -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-3">Variant Selector (Radio Cards)</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <x-form.radio-card
                                    name="packaging_variant"
                                    value="jar_100g"
                                    title="100g Porcelain Cloche Jar"
                                    subtitle="Hermetically sealed with nitrogen cloche"
                                    price="₹1,850"
                                    badge="Signature"
                                    checked
                                />

                                <x-form.radio-card
                                    name="packaging_variant"
                                    value="pouch_250g"
                                    title="250g Biodegradable Refill Pouch"
                                    subtitle="Eco-friendly UV-shielded botanical pouch"
                                    price="₹3,200"
                                />
                            </div>
                        </div>

                        <!-- Checkbox & Quantity Stepper -->
                        <div class="flex flex-wrap items-center justify-between gap-6 pt-4 border-t border-hairline">
                            <div class="space-y-3">
                                <x-form.checkbox
                                    name="gift_wrap"
                                    label="Include handmade Japanese mulberry gift wrap (+₹250)"
                                    hint="Wrapped by hand with antique gold sealing wax"
                                    checked
                                />

                                <x-form.checkbox
                                    name="newsletter"
                                    label="Notify me when limited seasonal harvests drop"
                                />
                            </div>

                            <div>
                                <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-2">Quantity Stepper</span>
                                <x-form.quantity-stepper name="qty" value="2" min="1" max="10" />
                            </div>
                        </div>
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 05. LAYOUT & DIVIDERS                                               -->
                <!-- ------------------------------------------------------------------- -->
                <section id="layout" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="05. Structural Layout"
                        title="Dividers & Section Wrappers"
                        description="1px structural hairlines and gold foil rules with central diamond accents create ceremonial pacing between content chapters."
                        align="left"
                    />

                    <div class="space-y-6">
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-2">Standard Hairline Divider</span>
                            <x-divider variant="hairline" />
                        </div>

                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-2">Antique Gold Foil Rule (with Center Diamond)</span>
                            <x-divider variant="gold" ornament />
                        </div>
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 06. EDITORIAL CONTENT                                               -->
                <!-- ------------------------------------------------------------------- -->
                <section id="content" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="06. Editorial Voice"
                        title="Prose, Blockquotes & Fact Strips"
                        description="Designed for long-form origin essays, botanical monographs, and master grower quotes."
                        align="left"
                    />

                    <div class="space-y-8">
                        <x-blockquote author="Dr. Arthur Henley" title="Botanical Founder, 1892">
                            Tea is not merely a beverage; it is fifteen unhurried minutes stolen from the frantic churn of the world.
                        </x-blockquote>

                        <x-stat-strip :stats="[
                            ['value' => '1,850m', 'label' => 'Elevation', 'caption' => 'Misty Himalayan slopes'],
                            ['value' => '72 hrs', 'label' => 'Flush Window', 'caption' => 'First spring budburst'],
                            ['value' => '100%', 'label' => 'Single Estate', 'caption' => 'Zero blended filler leaves'],
                            ['value' => '0%', 'label' => 'Additives', 'caption' => 'Pure unadulterated terroir'],
                        ]" />
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 07. COMMERCE ELEMENTS                                               -->
                <!-- ------------------------------------------------------------------- -->
                <section id="commerce" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="07. Commerce Components"
                        title="Product Cards, Ratings & Trust Badges"
                        description="Atomic building blocks for catalogue grids, collection showcases, and product detail displays."
                        align="left"
                    />

                    <!-- Product Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <x-commerce.product-card
                            title="Castleton First Flush Darjeeling"
                            subtitle="Lot 04 • Single Estate Orthodox"
                            price="1850"
                            compare-at-price="2100"
                            rating="5.0"
                            rating-count="38"
                            badge="Spring 2026"
                            badge-variant="gold"
                        />

                        <x-commerce.product-card
                            title="Malabar Forest Cardamom Pods"
                            subtitle="Extra Bold 8mm • Wayanad Terroir"
                            price="950"
                            rating="4.8"
                            rating-count="19"
                            badge="100% Organic"
                            badge-variant="sage"
                        />

                        <x-commerce.product-card
                            title="Wild Saffron Threads (Kashmir)"
                            subtitle="Grade A1 Mogra • Pampore Valley"
                            price="3400"
                            compare-at-price="3800"
                            rating="4.9"
                            rating-count="42"
                            badge="Limited Reserve"
                            badge-variant="saffron"
                        />
                    </div>

                    <!-- Stock Indicators -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised space-y-3">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Live Stock States</span>
                        <div class="flex flex-wrap items-center gap-8">
                            <x-commerce.stock-indicator status="in_stock" />
                            <x-commerce.stock-indicator status="low_stock" quantity="4" />
                            <x-commerce.stock-indicator status="out_of_stock" />
                        </div>
                    </div>

                    <!-- Trust Badge Strip -->
                    <x-commerce.trust-badge-strip />
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 08. OVERLAYS & FEEDBACK                                             -->
                <!-- ------------------------------------------------------------------- -->
                <section id="feedback" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="08. Feedback & Overlays"
                        title="Alerts, Skeletons, Modals & Slide-over Drawers"
                        description="Accessible dialogs, slide-over carts, and feedback banners tuned to brand colors."
                        align="left"
                    />

                    <!-- Alerts Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-alert tone="success" title="Harvest Verified">
                            Castleton Estate Lot 04 certified 100% biodynamic by the Himalayan Tea Board.
                        </x-alert>

                        <x-alert tone="warning" title="Seasonal Allocation">
                            Only 14 units remaining of this spring harvest allocation.
                        </x-alert>

                        <x-alert tone="error" title="Payment Verification Error">
                            Your card issuer requested additional 3D-Secure verification.
                        </x-alert>

                        <x-alert tone="info" title="Complimentary Shipping">
                            Add ₹250 more to unlock complimentary express air courier.
                        </x-alert>
                    </div>

                    <!-- Interactive Modals & Drawers Trigger Buttons -->
                    <div class="p-6 sm:p-10 rounded-2xl border border-hairline bg-surface-raised space-y-4">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Interactive Overlays Demo</span>
                        <div class="flex flex-wrap items-center gap-4">
                            <x-button
                                variant="primary"
                                x-data
                                x-on:click="$dispatch('open-modal', 'tasting-notes-modal')"
                            >
                                Open Tasting Notes Modal
                            </x-button>

                            <x-button
                                variant="secondary"
                                x-data
                                x-on:click="$dispatch('open-drawer', 'cart-drawer-demo')"
                            >
                                Open Cart Slide-Over Drawer
                            </x-button>
                        </div>
                    </div>

                    <!-- Skeleton Loaders -->
                    <div class="p-6 rounded-2xl border border-hairline bg-surface-raised space-y-4">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Skeleton Loading States</span>
                        <div class="space-y-3 max-w-md">
                            <x-skeleton width="w-3/4" height="h-6" />
                            <x-skeleton width="w-full" height="h-4" />
                            <x-skeleton width="w-5/6" height="h-4" />
                        </div>
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 09. NAVIGATION & DISCLOSURE                                         -->
                <!-- ------------------------------------------------------------------- -->
                <section id="navigation" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="09. Navigation & Disclosure"
                        title="Breadcrumbs, Pagination, Tabs & Accordions"
                        description="Smooth accordions and tab bars with keyboard accessibility."
                        align="left"
                    />

                    <!-- Breadcrumbs -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised space-y-2">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Breadcrumbs</span>
                        <x-breadcrumb :items="[
                            ['label' => 'Single-Estate Teas', 'href' => '#'],
                            ['label' => 'Himalayan Harvests', 'href' => '#'],
                            ['label' => 'Castleton First Flush Darjeeling 2026']
                        ]" />
                    </div>

                    <!-- Tabs Component -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised space-y-4">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Tabbed Content</span>
                        <x-tabs :tabs="[
                            ['id' => 'notes', 'label' => 'Tasting Notes'],
                            ['id' => 'terroir', 'label' => 'Estate & Terroir'],
                            ['id' => 'brewing', 'label' => 'Steeping Ritual'],
                        ]">
                            <div x-show="activeTab === 'notes'" class="text-body text-secondary space-y-2">
                                <p>Delicate notes of Muscatel grape, white peach blossom, and freshly cut Himalayan pine. Pale amber liquor with an effervescent floral finish.</p>
                            </div>
                            <div x-show="activeTab === 'terroir'" class="text-body text-secondary space-y-2" style="display: none;">
                                <p>Plucked at Castleton Estate, Kurseong South, at an elevation of 1,800m. Sandy loam soil enriched with oak leaf compost.</p>
                            </div>
                            <div x-show="activeTab === 'brewing'" class="text-body text-secondary space-y-2" style="display: none;">
                                <p>Infuse 2.5g in 200ml of mineral spring water at 85°C for exactly 3 minutes. Strain through porcelain filter.</p>
                            </div>
                        </x-tabs>
                    </div>

                    <!-- Accordion Component -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised space-y-4">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Accordion (Single or Multiple Open)</span>
                        <x-accordion type="single">
                            <x-accordion-item title="How should I store my loose-leaf tea?">
                                Keep the porcelain cloche jar sealed tightly in a cool, dry pantry away from direct sunlight and pungent spices.
                            </x-accordion-item>

                            <x-accordion-item title="What is the difference between First Flush and Second Flush?">
                                First flush is harvested during early spring, resulting in light, brisk, floral liquors. Second flush leaves are harvested in summer and yield rich, amber cups with deep muscatel character.
                            </x-accordion-item>

                            <x-accordion-item title="Are your teas certified organic?">
                                All our grower estates operate strictly under biodynamic standards with zero synthetic pesticides or artificial aroma sprays.
                            </x-accordion-item>
                        </x-accordion>
                    </div>

                    <!-- Pagination -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised">
                        <x-pagination current-page="2" total-pages="5" />
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 10. MEDIA & APOTHECARY ARCH                                         -->
                <!-- ------------------------------------------------------------------- -->
                <section id="media" class="scroll-mt-24 space-y-8">
                    <x-section-heading
                        eyebrow="10. Signature Geometry"
                        title="The Signature Apothecary Arch Frame"
                        description="Derived directly from the arched window of the bone-white cloche cylinder packaging. Used with restraint on hero portals."
                        align="left"
                    />

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                        <div class="space-y-3 text-center">
                            <x-arch-frame variant="default" aspect="aspect-[3/4]">
                                <div class="h-full w-full flex flex-col items-center justify-center p-6 bg-surface-raised/80 text-center space-y-2">
                                    <x-icons.package class="w-12 h-12 text-gold stroke-[1]" />
                                    <span class="font-serif text-lg text-primary">Standard Arch</span>
                                    <span class="text-caption text-secondary">Apothecary Portal</span>
                                </div>
                            </x-arch-frame>
                            <span class="text-caption text-secondary font-medium">Standard Arch Window</span>
                        </div>

                        <div class="space-y-3 text-center">
                            <x-arch-frame variant="gold-rim" aspect="aspect-[3/4]">
                                <div class="h-full w-full flex flex-col items-center justify-center p-6 bg-surface-raised/80 text-center space-y-2">
                                    <x-icons.leaf class="w-12 h-12 text-gold stroke-[1]" />
                                    <span class="font-serif text-lg text-primary">Gold Rimmed</span>
                                    <span class="text-caption text-secondary">Foil Accent Border</span>
                                </div>
                            </x-arch-frame>
                            <span class="text-caption text-secondary font-medium">Gold Foil Rim Arch</span>
                        </div>

                        <div class="space-y-3 text-center">
                            <x-arch-frame variant="subtle" aspect="aspect-[3/4]">
                                <div class="h-full w-full flex flex-col items-center justify-center p-6 bg-surface-raised/40 text-center space-y-2">
                                    <x-icons.sparkles class="w-12 h-12 text-gold stroke-[1]" />
                                    <span class="font-serif text-lg text-primary">Subtle Tint</span>
                                    <span class="text-caption text-secondary">Architectural Niche</span>
                                </div>
                            </x-arch-frame>
                            <span class="text-caption text-secondary font-medium">Subtle Editorial Niche</span>
                        </div>
                    </div>
                </section>

                <x-divider variant="hairline" />

                <!-- ------------------------------------------------------------------- -->
                <!-- 11. LINE ICONOGRAPHY                                                -->
                <!-- ------------------------------------------------------------------- -->
                <section id="icons" class="scroll-mt-24 space-y-8 pb-20">
                    <x-section-heading
                        eyebrow="11. Line Iconography"
                        title="Bespoke Vector Line Icons"
                        description="Single stroke-width vector line icons matching the delicate fragrance-house aesthetic."
                        align="left"
                    />

                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4 p-6 sm:p-10 rounded-2xl border border-hairline bg-surface-raised">
                        @php
                        $iconList = [
                            ['name' => 'arrow-right', 'comp' => 'icons.arrow-right'],
                            ['name' => 'arrow-left', 'comp' => 'icons.arrow-left'],
                            ['name' => 'chevron-down', 'comp' => 'icons.chevron-down'],
                            ['name' => 'chevron-right', 'comp' => 'icons.chevron-right'],
                            ['name' => 'chevron-up', 'comp' => 'icons.chevron-up'],
                            ['name' => 'check', 'comp' => 'icons.check'],
                            ['name' => 'close', 'comp' => 'icons.close'],
                            ['name' => 'search', 'comp' => 'icons.search'],
                            ['name' => 'bag', 'comp' => 'icons.bag'],
                            ['name' => 'heart', 'comp' => 'icons.heart'],
                            ['name' => 'user', 'comp' => 'icons.user'],
                            ['name' => 'leaf', 'comp' => 'icons.leaf'],
                            ['name' => 'filter', 'comp' => 'icons.filter'],
                            ['name' => 'plus', 'comp' => 'icons.plus'],
                            ['name' => 'minus', 'comp' => 'icons.minus'],
                            ['name' => 'shield-check', 'comp' => 'icons.shield-check'],
                            ['name' => 'truck', 'comp' => 'icons.truck'],
                            ['name' => 'sparkles', 'comp' => 'icons.sparkles'],
                            ['name' => 'menu', 'comp' => 'icons.menu'],
                            ['name' => 'package', 'comp' => 'icons.package'],
                            ['name' => 'clock', 'comp' => 'icons.clock'],
                            ['name' => 'info', 'comp' => 'icons.info'],
                            ['name' => 'alert-circle', 'comp' => 'icons.alert-circle'],
                            ['name' => 'check-circle', 'comp' => 'icons.check-circle'],
                        ];
                        @endphp

                        @foreach ($iconList as $icon)
                            <div class="flex flex-col items-center justify-center p-3 rounded-lg border border-hairline bg-surface-card hover:border-accent transition group">
                                <div class="text-secondary group-hover:text-accent transition">
                                    <x-dynamic-component :component="$icon['comp']" class="w-5 h-5" />
                                </div>
                                <span class="text-[10px] text-muted font-sans mt-2 text-center truncate w-full">
                                    {{ $icon['name'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </section>

            </div>
        </main>
    </div>

    <!-- Interactive Modal Instance for Demo -->
    <x-modal name="tasting-notes-modal" title="Castleton First Flush — Terroir Profile" max-width="md">
        <div class="space-y-4 text-body text-secondary">
            <p>Harvested exclusively from the highest south-facing slopes of Kurseong Valley at 1,850m elevation during the 2026 spring budburst.</p>
            <div class="p-4 rounded-xl bg-surface-raised border border-hairline space-y-1">
                <span class="text-xs uppercase tracking-widest font-semibold text-primary block">Aroma Compounds:</span>
                <p class="text-caption text-secondary">Linalool, geraniol, and methyl salicylate yielding crisp peach floral bouquet.</p>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-hairline">
                <x-button variant="secondary" size="sm" x-on:click="$dispatch('close-modal', 'tasting-notes-modal')">Close</x-button>
                <x-button variant="primary" size="sm" trailing-arrow>Add to Basket</x-button>
            </div>
        </div>
    </x-modal>

    <!-- Interactive Drawer Instance for Demo -->
    <x-drawer name="cart-drawer-demo" title="Your Ritual Basket (1)" max-width="md">
        <div class="space-y-6">
            <!-- Basket Item -->
            <div class="flex items-start gap-4 pb-6 border-b border-hairline">
                <div class="w-16 h-16 rounded-lg bg-surface-raised flex items-center justify-center text-muted">
                    <x-icons.package class="w-8 h-8" />
                </div>
                <div class="flex-1 space-y-1">
                    <h4 class="font-serif text-lg text-primary">Castleton First Flush 2026</h4>
                    <p class="text-caption text-secondary">100g Porcelain Cloche Jar</p>
                    <div class="flex items-center justify-between pt-2">
                        <x-form.quantity-stepper name="drawer_qty" value="1" min="1" max="5" />
                        <span class="font-serif text-lg text-primary">₹1,850</span>
                    </div>
                </div>
            </div>

            <x-alert tone="info">
                You are ₹150 away from complimentary express courier delivery.
            </x-alert>
        </div>

        <x-slot:footer>
            <div class="space-y-4">
                <div class="flex items-center justify-between text-ui text-primary font-medium">
                    <span>Estimated Subtotal</span>
                    <span class="font-serif text-xl">₹1,850</span>
                </div>
                <x-button variant="primary" size="lg" class="w-full" trailing-arrow>
                    Proceed to Checkout
                </x-button>
            </div>
        </x-slot:footer>
    </x-drawer>
</x-layouts.design>
