<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { ArrowRight, Menu, X } from '@lucide/vue';
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';
import SiteLogo from '@/components/site/SiteLogo.vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { contacts, home } from '@/routes';
import { navigation } from '@/lib/site';

const { isCurrentUrl } = useCurrentUrl();

const mobileOpen = ref(false);
const scrolled = ref(false);

function onScroll() {
    scrolled.value = window.scrollY > 8;
}

function onKeydown(event: KeyboardEvent) {
    if (event.key === 'Escape') {
        mobileOpen.value = false;
    }
}

let removeNavigateListener: (() => void) | undefined;

onMounted(() => {
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('keydown', onKeydown);
    removeNavigateListener = router.on('navigate', () => {
        mobileOpen.value = false;
    });
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', onScroll);
    window.removeEventListener('keydown', onKeydown);
    removeNavigateListener?.();
    document.body.style.overflow = '';
});

watch(mobileOpen, (open) => {
    document.body.style.overflow = open ? 'hidden' : '';
});
</script>

<template>
    <header
        class="sticky top-0 z-40 border-b transition-colors duration-200"
        :class="
            scrolled || mobileOpen
                ? 'border-slate-200/80 bg-white/90 backdrop-blur-md'
                : 'border-transparent bg-white'
        "
    >
        <div class="px-4 sm:px-6 lg:px-8">
            <div
                class="mx-auto flex h-16 max-w-7xl items-center justify-between lg:h-18"
            >
                <Link
                    :href="home()"
                    class="-m-1.5 rounded-md p-1.5 focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:outline-none"
                >
                    <SiteLogo />
                </Link>

                <nav
                    class="hidden items-center gap-1 lg:flex"
                    aria-label="Main"
                >
                    <Link
                        v-for="item in navigation"
                        :key="item.label"
                        :href="item.href"
                        class="rounded-md px-3 py-2 text-sm font-medium transition-colors focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:outline-none"
                        :class="
                            isCurrentUrl(item.href)
                                ? 'bg-brand-50 text-brand-700'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'
                        "
                        :aria-current="
                            isCurrentUrl(item.href) ? 'page' : undefined
                        "
                    >
                        {{ item.label }}
                    </Link>
                </nav>

                <div class="flex items-center gap-2">
                    <Link
                        :href="contacts()"
                        class="hidden items-center gap-1.5 rounded-lg bg-brand-600 px-4 py-2 text-sm font-semibold text-white shadow-soft transition hover:bg-brand-700 focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 focus-visible:outline-none sm:inline-flex"
                    >
                        Start a project
                        <ArrowRight class="size-4" />
                    </Link>

                    <button
                        type="button"
                        class="-mr-2 inline-flex size-10 items-center justify-center rounded-lg text-slate-700 transition hover:bg-slate-100 focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:outline-none lg:hidden"
                        :aria-expanded="mobileOpen"
                        aria-controls="mobile-menu"
                        @click="mobileOpen = !mobileOpen"
                    >
                        <span class="sr-only">
                            {{ mobileOpen ? 'Close menu' : 'Open menu' }}
                        </span>
                        <X v-if="mobileOpen" class="size-6" />
                        <Menu v-else class="size-6" />
                    </button>
                </div>
            </div>
        </div>

        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-2"
            leave-active-class="transition duration-150 ease-in"
            leave-to-class="opacity-0 -translate-y-2"
        >
            <div
                v-if="mobileOpen"
                id="mobile-menu"
                class="absolute inset-x-0 top-full h-[calc(100dvh-4rem)] overflow-y-auto border-t border-slate-100 bg-white lg:hidden"
            >
                <nav
                    class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-6 sm:px-6"
                    aria-label="Mobile"
                >
                    <Link
                        v-for="item in navigation"
                        :key="item.label"
                        :href="item.href"
                        class="rounded-lg px-4 py-3 text-base font-medium transition-colors"
                        :class="
                            isCurrentUrl(item.href)
                                ? 'bg-brand-50 text-brand-700'
                                : 'text-slate-700 hover:bg-slate-50'
                        "
                    >
                        {{ item.label }}
                    </Link>

                    <Link
                        :href="contacts()"
                        class="mt-4 inline-flex items-center justify-center gap-2 rounded-lg bg-brand-600 px-4 py-3 text-base font-semibold text-white shadow-soft transition hover:bg-brand-700"
                    >
                        Start a project
                        <ArrowRight class="size-4" />
                    </Link>
                </nav>
            </div>
        </Transition>
    </header>
</template>
