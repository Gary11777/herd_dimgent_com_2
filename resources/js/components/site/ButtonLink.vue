<script setup lang="ts">
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { cn } from '@/lib/utils';

const props = withDefaults(
    defineProps<{
        href: NonNullable<InertiaLinkProps['href']>;
        variant?: 'primary' | 'secondary' | 'light' | 'outline-light';
        size?: 'md' | 'lg';
        external?: boolean;
        download?: boolean;
        class?: string;
    }>(),
    {
        variant: 'primary',
        size: 'md',
        external: false,
        download: false,
        class: undefined,
    },
);

const classes = computed(() =>
    cn(
        'inline-flex items-center justify-center gap-2 rounded-lg font-semibold transition focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none',
        props.size === 'lg' ? 'px-5 py-3 text-base' : 'px-4 py-2.5 text-sm',
        {
            primary:
                'bg-brand-600 text-white shadow-soft hover:bg-brand-700 focus-visible:ring-brand-500',
            secondary:
                'bg-white text-slate-800 shadow-soft ring-1 ring-slate-200 hover:bg-slate-50 hover:ring-slate-300 focus-visible:ring-brand-500',
            light: 'bg-white text-slate-900 shadow-soft hover:bg-brand-50 focus-visible:ring-white focus-visible:ring-offset-slate-900',
            'outline-light':
                'text-white ring-1 ring-white/25 hover:bg-white/10 focus-visible:ring-white focus-visible:ring-offset-slate-900',
        }[props.variant],
        props.class,
    ),
);

const url = computed(() =>
    typeof props.href === 'string' ? props.href : props.href.url,
);
</script>

<template>
    <a
        v-if="external || download"
        :href="url"
        :class="classes"
        :download="download || undefined"
        :target="external ? '_blank' : undefined"
        :rel="external ? 'noopener noreferrer' : undefined"
    >
        <slot />
    </a>
    <Link v-else :href="href" :class="classes">
        <slot />
    </Link>
</template>
