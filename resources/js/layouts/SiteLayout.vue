<script setup lang="ts">
import SiteFooter from '@/components/site/SiteFooter.vue';
import SiteHeader from '@/components/site/SiteHeader.vue';
</script>

<template>
    <div
        class="flex min-h-screen flex-col bg-white text-slate-900 [color-scheme:light]"
    >
        <a
            href="#main"
            class="sr-only z-50 rounded-md bg-brand-600 px-4 py-2 text-sm font-semibold text-white focus:not-sr-only focus:fixed focus:top-3 focus:left-3"
        >
            Skip to content
        </a>
        <SiteHeader />
        <main id="main" class="flex-1">
            <slot />
        </main>
        <SiteFooter />
    </div>
</template>
