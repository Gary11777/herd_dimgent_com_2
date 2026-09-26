<script setup lang="ts">
withDefaults(
    defineProps<{
        eyebrow?: string;
        title: string;
        description?: string;
        align?: 'left' | 'center';
        tone?: 'light' | 'dark';
    }>(),
    {
        eyebrow: undefined,
        description: undefined,
        align: 'left',
        tone: 'light',
    },
);
</script>

<template>
    <div
        class="max-w-2xl"
        :class="align === 'center' ? 'mx-auto text-center' : ''"
    >
        <p
            v-if="eyebrow"
            class="text-sm font-semibold tracking-wide"
            :class="tone === 'dark' ? 'text-brand-300' : 'text-brand-600'"
        >
            {{ eyebrow }}
        </p>
        <h2
            class="mt-2 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
            :class="tone === 'dark' ? 'text-white' : 'text-slate-900'"
        >
            {{ title }}
        </h2>
        <p
            v-if="description"
            class="mt-4 text-lg leading-8 text-pretty"
            :class="tone === 'dark' ? 'text-slate-300' : 'text-slate-600'"
        >
            {{ description }}
        </p>
    </div>
</template>
