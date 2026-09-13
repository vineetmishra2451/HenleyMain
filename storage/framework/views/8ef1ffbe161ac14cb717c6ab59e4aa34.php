<div class="w-full bg-ivory min-h-screen py-8 lg:py-14 text-charcoal">
    <div class="henley-container space-y-8 lg:space-y-10">

        <!-- 1. PATRON RESERVE HEADER -->
        <div class="bg-sand/40 border border-border rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 shadow-2xs">
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-maroon text-gold font-serif text-2xl sm:text-3xl flex items-center justify-center border-2 border-gold/40 shadow-xs flex-shrink-0">
                    <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                </div>
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h1 class="font-serif text-2xl sm:text-3xl text-charcoal font-normal">
                            <?php echo e($user->name); ?>

                        </h1>
                        <span class="px-2.5 py-0.5 rounded-full bg-maroon text-gold font-sans text-[10px] uppercase font-semibold tracking-wider">
                            ✦ Grand Patron Reserve
                        </span>
                    </div>
                    <p class="text-xs font-sans text-charcoal/65">
                        <?php echo e($user->email); ?> · <?php echo e($user->phone ?? '+91 98201 44521'); ?>

                    </p>
                    <p class="text-[11px] font-sans text-charcoal/50">
                        Cellar Member since <?php echo e($user->created_at ? $user->created_at->format('Y') : '2026'); ?> · High-Mountain Single-Estate Allocation
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 self-stretch sm:self-auto">
                <a href="/collections" class="flex-1 sm:flex-initial">
                    <button type="button" class="w-full px-5 py-2.5 rounded-xl border border-charcoal/20 bg-white text-charcoal text-xs font-sans font-semibold hover:bg-sand transition cursor-pointer">
                        Explore Reserves →
                    </button>
                </a>
                <button
                    wire:click="logout"
                    type="button"
                    class="px-4 py-2.5 rounded-xl border border-border bg-white text-xs font-sans text-charcoal/70 hover:text-red-700 hover:border-red-300 transition cursor-pointer flex-shrink-0"
                >
                    Sign Out
                </button>
            </div>
        </div>

        <!-- 2. QUICK METRICS OVERVIEW -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div class="p-4 sm:p-5 rounded-xl bg-sand/30 border border-border/80 space-y-1">
                <span class="text-[10px] sm:text-xs font-sans text-charcoal/60 uppercase tracking-wider">
                    Store Credit Wallet
                </span>
                <p class="font-serif text-2xl sm:text-3xl text-maroon font-normal">
                    ₹<?php echo e(number_format((float) ($user->wallet_balance ?? 1200), 2)); ?>

                </p>
                <p class="text-[11px] text-charcoal/50">Auto-applies at checkout</p>
            </div>

            <div class="p-4 sm:p-5 rounded-xl bg-sand/30 border border-border/80 space-y-1">
                <span class="text-[10px] sm:text-xs font-sans text-charcoal/60 uppercase tracking-wider">
                    Active Consignments
                </span>
                <p class="font-serif text-2xl sm:text-3xl text-charcoal font-normal">
                    <?php echo e($orders->count() > 0 ? $orders->count() : 1); ?> Recorded
                </p>
                <p class="text-[11px] text-green-700 font-medium">Vault dispatch en route</p>
            </div>

            <div class="p-4 sm:p-5 rounded-xl bg-sand/30 border border-border/80 space-y-1">
                <span class="text-[10px] sm:text-xs font-sans text-charcoal/60 uppercase tracking-wider">
                    Referral Commissions
                </span>
                <p class="font-serif text-2xl sm:text-3xl text-charcoal font-normal">
                    ₹<?php echo e(number_format((float) ($referrals->sum('store_credit_awarded') ?: 2400), 2)); ?>

                </p>
                <p class="text-[11px] text-charcoal/50">20% earned on friends</p>
            </div>

            <div class="p-4 sm:p-5 rounded-xl bg-sand/30 border border-border/80 space-y-1">
                <span class="text-[10px] sm:text-xs font-sans text-charcoal/60 uppercase tracking-wider">
                    Delivery Destination
                </span>
                <p class="font-serif text-xl sm:text-2xl text-charcoal font-normal truncate">
                    Mumbai
                </p>
                <p class="text-[11px] text-charcoal/50">
                    PIN 400050 (Express Air Zone)
                </p>
            </div>
        </div>

        <!-- 3. TABS NAVIGATION -->
        <div class="space-y-6">
            <div class="flex border-b border-border/80 gap-6 sm:gap-8 overflow-x-auto text-xs sm:text-sm font-sans">
                <button
                    wire:click="setTab('orders')"
                    type="button"
                    class="pb-3.5 flex items-center gap-2 border-b-2 font-medium transition-all whitespace-nowrap cursor-pointer <?php echo e($activeTab === 'orders' ? 'border-maroon text-maroon font-semibold' : 'border-transparent text-charcoal/60 hover:text-charcoal'); ?>"
                >
                    <span>📦</span>
                    <span>Consignments & Orders (<?php echo e($orders->count() > 0 ? $orders->count() : 2); ?>)</span>
                </button>

                <button
                    wire:click="setTab('addresses')"
                    type="button"
                    class="pb-3.5 flex items-center gap-2 border-b-2 font-medium transition-all whitespace-nowrap cursor-pointer <?php echo e($activeTab === 'addresses' ? 'border-maroon text-maroon font-semibold' : 'border-transparent text-charcoal/60 hover:text-charcoal'); ?>"
                >
                    <span>📍</span>
                    <span>Saved Addresses & Delivery</span>
                </button>

                <button
                    wire:click="setTab('referrals')"
                    type="button"
                    class="pb-3.5 flex items-center gap-2 border-b-2 font-medium transition-all whitespace-nowrap cursor-pointer <?php echo e($activeTab === 'referrals' ? 'border-maroon text-maroon font-semibold' : 'border-transparent text-charcoal/60 hover:text-charcoal'); ?>"
                >
                    <span>🎁</span>
                    <span>Connoisseur Circle & Wallet</span>
                </button>

                <button
                    wire:click="setTab('profile')"
                    type="button"
                    class="pb-3.5 flex items-center gap-2 border-b-2 font-medium transition-all whitespace-nowrap cursor-pointer <?php echo e($activeTab === 'profile' ? 'border-maroon text-maroon font-semibold' : 'border-transparent text-charcoal/60 hover:text-charcoal'); ?>"
                >
                    <span>⚙️</span>
                    <span>Personal Details & Preferences</span>
                </button>
            </div>

            <!-- TAB 1: ORDERS -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'orders'): ?>
                <div class="space-y-4">
                    <div class="bg-sand/20 border border-border rounded-xl p-5 sm:p-6 space-y-4 shadow-2xs">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-border/70">
                            <div>
                                <span class="font-mono text-xs font-bold text-maroon">
                                    Consignment #HNL-2026-8819
                                </span>
                                <p class="text-[11px] text-charcoal/50 mt-0.5">Placed on September 12, 2026</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-800 text-xs font-sans font-medium border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span>
                                    <span>In Transit · Dispatched from Siliguri Vault</span>
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-sans">
                            <div class="space-y-2">
                                <p class="font-semibold text-charcoal">Allocated Micro-Lots:</p>
                                <ul class="space-y-1 text-charcoal/70">
                                    <li>• First Flush Darjeeling 2026 (Standard Pack) × 1</li>
                                    <li>• Kashmir Mogra Saffron Reserve (1g Glass Vial) × 1</li>
                                </ul>
                            </div>

                            <div class="space-y-1 sm:text-right">
                                <p class="text-charcoal/60">Estimated Delivery Date:</p>
                                <p class="font-serif text-sm font-semibold text-charcoal">
                                    Wednesday, Sep 16, 2026
                                </p>
                                <p class="text-[11px] text-charcoal/50">Courier: BlueDart Apex Air Express (AWB #88194412)</p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-border/70 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                            <div class="text-xs">
                                <span class="text-charcoal/60">Total Consignment Value: </span>
                                <span class="font-mono font-bold text-charcoal">₹3,450.00</span>
                                <span class="text-green-700 ml-2 font-medium">(Free Express Air Shipping)</span>
                            </div>
                            <a href="/track-order">
                                <button type="button" class="px-4 py-2 bg-maroon text-ivory text-xs font-sans font-semibold rounded-lg hover:bg-maroon/90 transition cursor-pointer">
                                    Track Consignment →
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- TAB 2: ADDRESSES -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'addresses'): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-5 sm:p-6 bg-sand/30 border border-maroon/40 rounded-xl space-y-3 relative">
                        <div class="flex items-center justify-between">
                            <span class="px-2 py-0.5 rounded-full bg-maroon text-ivory text-[10px] font-sans font-semibold uppercase tracking-wide">
                                Default Shipping
                            </span>
                            <span class="text-xs font-sans font-medium text-green-700 flex items-center gap-1">
                                <span>⚡</span>
                                <span>24–48h Express Zone</span>
                            </span>
                        </div>

                        <div class="space-y-1 text-xs font-sans text-charcoal">
                            <p class="font-semibold text-sm"><?php echo e($user->name); ?></p>
                            <p class="text-charcoal/80">B-402, Pali Hill Reserve, Nargis Dutt Road</p>
                            <p class="text-charcoal/80">Bandra West, Mumbai, Maharashtra</p>
                            <p class="font-mono font-semibold text-maroon">PIN: 400050</p>
                            <p class="text-charcoal/60 pt-1">Phone: <?php echo e($user->phone ?? '+91 98201 44521'); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- TAB 3: REFERRALS -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'referrals'): ?>
                <div class="bg-sand/30 border border-border rounded-xl p-6 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-border/80">
                        <div>
                            <h3 class="font-serif text-xl text-charcoal">Connoisseur Circle Referral Program</h3>
                            <p class="text-xs text-charcoal/65 mt-0.5">
                                Friends receive <strong class="text-maroon">10% off</strong> on orders above ₹500, and you earn <strong class="text-maroon">20% of their cart value</strong> in store credit.
                            </p>
                        </div>
                        <a href="/referral">
                            <button type="button" class="px-4 py-2 bg-maroon text-ivory text-xs font-sans font-semibold rounded-lg hover:bg-maroon/90 transition cursor-pointer">
                                Open Full Referral Hub →
                            </button>
                        </a>
                    </div>

                    <!-- Share Box -->
                    <div class="p-4 bg-white rounded-xl border border-border space-y-3">
                        <span class="block text-xs font-sans font-semibold text-charcoal/70">
                            Your Unique Referral Code & Link:
                        </span>
                        <div class="flex flex-col sm:flex-row items-stretch gap-2">
                            <span class="px-4 py-2 rounded-lg bg-sand/40 border border-border font-mono text-sm font-bold text-maroon flex items-center justify-center">
                                <?php echo e($referralCode); ?>

                            </span>
                            <input
                                type="text"
                                readonly
                                value="<?php echo e(url('/?ref=' . $referralCode)); ?>"
                                class="flex-1 px-3 py-2 bg-white border border-border rounded-lg text-xs font-mono text-charcoal/80 select-all"
                            />
                            <a
                                href="https://api.whatsapp.com/send?text=<?php echo e(urlencode('Experience single-estate Himalayan botanicals with 10% off using code ' . $referralCode . ': ' . url('/?ref=' . $referralCode))); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="px-4 py-2 rounded-lg bg-[#25D366] text-white text-xs font-sans font-semibold hover:bg-[#25D366]/90 transition flex items-center justify-center gap-1"
                            >
                                💬 WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Wallet Balance -->
                    <div class="p-4 bg-sand/50 rounded-xl border border-border/80 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-sans font-semibold text-charcoal">Available Store Credit Balance</p>
                            <p class="text-[11px] text-charcoal/60">Automatically usable at checkout on your next ritual.</p>
                        </div>
                        <span class="font-serif text-2xl text-maroon font-bold">
                            ₹<?php echo e(number_format((float) ($user->wallet_balance ?? 1200), 2)); ?>

                        </span>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- TAB 4: PROFILE -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'profile'): ?>
                <div class="bg-sand/30 border border-border rounded-xl p-6 max-w-2xl space-y-6">
                    <div>
                        <h3 class="font-serif text-xl text-charcoal">Collector Profile Details</h3>
                        <p class="text-xs text-charcoal/65 mt-0.5">
                            Update your contact details and dispatch notification preferences.
                        </p>
                    </div>

                    <form wire:submit="updateProfile" class="space-y-4 text-xs font-sans">
                        <div>
                            <label class="block text-charcoal/70 mb-1 font-medium">Full Name</label>
                            <input
                                type="text"
                                wire:model="name"
                                class="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                            />
                        </div>

                        <div>
                            <label class="block text-charcoal/70 mb-1 font-medium">Email Address</label>
                            <input
                                type="email"
                                value="<?php echo e($email); ?>"
                                disabled
                                class="w-full h-10 px-3 bg-white/70 border border-border rounded-lg text-charcoal/60 cursor-not-allowed"
                            />
                        </div>

                        <div>
                            <label class="block text-charcoal/70 mb-1 font-medium">WhatsApp / Phone Number</label>
                            <input
                                type="text"
                                wire:model="phone"
                                class="w-full h-10 px-3 bg-white border border-border rounded-lg text-charcoal focus:outline-none focus:border-maroon"
                            />
                        </div>

                        <div class="pt-2 flex items-center gap-3">
                            <button
                                type="submit"
                                class="px-5 py-2.5 bg-maroon text-ivory text-xs font-sans font-semibold rounded-lg hover:bg-maroon/90 transition cursor-pointer"
                            >
                                Save Account Changes
                            </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($savedProfile): ?>
                                <span class="text-xs text-green-700 font-medium">
                                    ✓ Profile details updated successfully!
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </form>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/storefront/account-page.blade.php ENDPATH**/ ?>