<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { CircleCheck, HeartPulse, House, Network, Wrench } from '@lucide/vue';
import CtaBanner from '@/components/site/CtaBanner.vue';
import PageHero from '@/components/site/PageHero.vue';
import SectionHeading from '@/components/site/SectionHeading.vue';
import StatsGrid from '@/components/site/StatsGrid.vue';
import { highlights, offerings } from '@/lib/site';

const categories = [
    {
        icon: Network,
        title: 'Systems',
        description: 'Control and testing systems for businesses and industry.',
        items: [
            'Control rooms using public telephone networks, GSM connections and radio channels with frequencies up to 900 MHz, used for elevators, communal services (hydraulic lifting systems, engineering communications) and water intake systems.',
            'Automated microelectronic circuit testers and electronic board testing.',
        ],
    },
    {
        icon: Wrench,
        title: 'Tools',
        description: 'Measurement and testing instruments for professionals.',
        items: [
            'Testers for microelectronic circuits and electronic boards.',
            'Tools for archaeological and geological use: gradiometers and electronic probes.',
            'Remote-reading gauges to collect information from sensors.',
        ],
    },
    {
        icon: House,
        title: 'Everyday technology',
        description: 'Consumer devices that make daily life easier.',
        items: [
            'Wireless headphones for the hard of hearing and older people.',
            'Dimmers with remote control for lighting.',
            'Radio extenders for electronic sensors, and remote controls for garage gates, blinds and more.',
        ],
    },
    {
        icon: HeartPulse,
        title: 'Medical devices',
        description: 'Health monitoring equipment.',
        items: ['Blood pressure and pulse meters.'],
    },
];
</script>

<template>
    <Head title="Projects">
        <meta
            head-key="description"
            name="description"
            content="Selected projects by Dimgent Technologies: control systems, circuit testers, archaeological and geological tools, everyday consumer electronics and medical devices."
        />
    </Head>

    <PageHero
        eyebrow="Projects"
        title="More than 50 devices designed and delivered"
        description="From industrial control rooms to medical meters, our portfolio spans systems, professional tools, everyday technology and medical devices."
    />

    <section class="px-4 pt-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <StatsGrid />
        </div>
    </section>

    <section class="px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="Portfolio"
                title="What we have built"
                description="A selection of the areas we have developed devices for."
            />
            <div class="mt-12 grid gap-6 lg:grid-cols-2">
                <article
                    v-for="category in categories"
                    :key="category.title"
                    class="flex flex-col rounded-2xl bg-white shadow-card ring-1 ring-slate-200"
                >
                    <header
                        class="flex items-center gap-4 border-b border-slate-100 p-6"
                    >
                        <span
                            class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-brand-600 text-white shadow-soft"
                        >
                            <component :is="category.icon" class="size-6" />
                        </span>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">
                                {{ category.title }}
                            </h3>
                            <p class="text-sm text-slate-500">
                                {{ category.description }}
                            </p>
                        </div>
                    </header>
                    <ul class="space-y-4 p-6">
                        <li
                            v-for="item in category.items"
                            :key="item"
                            class="flex items-start gap-3 leading-7 text-slate-700"
                        >
                            <span
                                class="mt-2.5 size-1.5 shrink-0 rounded-full bg-brand-500"
                                aria-hidden="true"
                            />
                            {{ item }}
                        </li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-2">
            <div
                class="rounded-2xl bg-white p-8 shadow-soft ring-1 ring-slate-200"
            >
                <h2 class="text-xl font-bold tracking-tight text-slate-900">
                    We can provide
                </h2>
                <ul class="mt-6 space-y-4">
                    <li
                        v-for="item in offerings"
                        :key="item"
                        class="flex items-start gap-3 text-slate-700"
                    >
                        <CircleCheck
                            class="mt-0.5 size-5 shrink-0 text-brand-600"
                        />
                        {{ item }}
                    </li>
                </ul>
            </div>
            <div
                class="rounded-2xl bg-white p-8 shadow-soft ring-1 ring-slate-200"
            >
                <h2 class="text-xl font-bold tracking-tight text-slate-900">
                    Dimgent Technologies is
                </h2>
                <ul class="mt-6 grid gap-4 sm:grid-cols-2">
                    <li
                        v-for="item in highlights"
                        :key="item"
                        class="flex items-start gap-3 text-slate-700"
                    >
                        <CircleCheck
                            class="mt-0.5 size-5 shrink-0 text-brand-600"
                        />
                        {{ item }}
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <CtaBanner
        title="Your project could be next"
        description="Tell us what you need to build. We are happy to work on both large and small projects, for big or small enterprises."
    />
</template>
