<script setup lang="ts">
defineProps<{
    eyebrow: string;
    title: string;
    description?: string;
}>();
</script>

<template>
    <section
        class="relative isolate overflow-hidden bg-slate-950 px-4 sm:px-6 lg:px-8"
    >
        <div
            class="bg-grid-dark absolute inset-0 -z-10 [mask-image:radial-gradient(ellipse_at_top,black_30%,transparent_75%)]"
            aria-hidden="true"
        />
        <div
            class="absolute -top-40 left-1/2 -z-10 h-80 w-[48rem] -translate-x-1/2 rounded-full bg-brand-600/30 blur-3xl"
            aria-hidden="true"
        />
        <div class="mx-auto max-w-7xl py-20 sm:py-24">
            <div class="max-w-3xl">
                <p
                    class="inline-flex items-center gap-2 rounded-full bg-white/5 px-3 py-1 text-sm font-medium text-brand-200 ring-1 ring-white/10"
                >
                    <span class="size-1.5 rounded-full bg-brand-400" />
                    {{ eyebrow }}
                </p>
                <h1
                    class="mt-6 text-4xl font-bold tracking-tight text-balance text-white sm:text-5xl"
                >
                    {{ title }}
                </h1>
                <p
                    v-if="description"
                    class="mt-6 max-w-2xl text-lg leading-8 text-pretty text-slate-300"
                >
                    {{ description }}
                </p>
                <div v-if="$slots.default" class="mt-8">
                    <slot />
                </div>
            </div>
        </div>
    </section>
</template>
