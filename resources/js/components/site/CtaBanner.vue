<script setup lang="ts">
import { ArrowRight } from '@lucide/vue';
import ButtonLink from '@/components/site/ButtonLink.vue';
import { contacts, services } from '@/routes';

withDefaults(
    defineProps<{
        title?: string;
        description?: string;
    }>(),
    {
        title: 'Have an electronic device in mind?',
        description:
            'Tell us about your idea. We can take it from specification to a tested finished product, or help with any single phase of development.',
    },
);
</script>

<template>
    <section class="px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div
            class="relative isolate mx-auto max-w-7xl overflow-hidden rounded-3xl bg-brand-700 px-6 py-14 shadow-lifted sm:px-12 sm:py-16 lg:flex lg:items-center lg:justify-between lg:gap-12 lg:px-16"
        >
            <div
                class="bg-grid-dark absolute inset-0 -z-10 opacity-60"
                aria-hidden="true"
            />
            <div
                class="absolute -right-24 -bottom-32 -z-10 size-96 rounded-full bg-brand-400/40 blur-3xl"
                aria-hidden="true"
            />
            <div class="max-w-2xl">
                <h2
                    class="text-3xl font-bold tracking-tight text-balance text-white sm:text-4xl"
                >
                    {{ title }}
                </h2>
                <p class="mt-4 text-lg leading-8 text-brand-100">
                    {{ description }}
                </p>
            </div>
            <div class="mt-10 flex shrink-0 flex-wrap gap-3 lg:mt-0">
                <ButtonLink :href="contacts()" variant="light" size="lg">
                    Contact us
                    <ArrowRight class="size-4" />
                </ButtonLink>
                <ButtonLink
                    :href="services()"
                    variant="outline-light"
                    size="lg"
                >
                    Our services
                </ButtonLink>
            </div>
        </div>
    </section>
</template>
