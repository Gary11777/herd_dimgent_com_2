<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {
    ArrowRight,
    BatteryFull,
    Download,
    ExternalLink,
    Feather,
    FileText,
    HardHat,
    Landmark,
    Leaf,
    Mountain,
    Search,
    Shield,
    Wrench,
} from '@lucide/vue';
import ButtonLink from '@/components/site/ButtonLink.vue';
import CtaBanner from '@/components/site/CtaBanner.vue';
import ImageGallery from '@/components/site/ImageGallery.vue';
import SectionHeading from '@/components/site/SectionHeading.vue';
import type { GalleryImage } from '@/lib/site';
import { contacts } from '@/routes';

const presentationUrl = '/downloads/garand-101-product-presentation.pdf';

const targetAreas = [
    { icon: Landmark, label: 'Archaeological research' },
    { icon: Leaf, label: 'Environmental monitoring' },
    { icon: Search, label: 'Forensic investigations' },
    { icon: Mountain, label: 'Geological studies' },
    { icon: HardHat, label: 'Civil engineering' },
    { icon: Shield, label: 'Peace-time military applications' },
];

const technology = [
    {
        icon: BatteryFull,
        title: 'Lower energy consumption',
        description:
            'The new measurement method needs less power, which increases operating time in the field.',
    },
    {
        icon: Feather,
        title: 'Reduced device weight',
        description:
            'A lighter instrument that one person can carry and operate comfortably all day.',
    },
    {
        icon: Wrench,
        title: 'Simpler construction',
        description:
            'Fewer parts make the device easier to build and to maintain over its lifetime.',
    },
];

const advantages = [
    {
        title: 'Innovative measurement technology',
        description: 'A new approach to measuring the magnetic field.',
    },
    {
        title: 'Fully digital device',
        description: 'Improved noise stability during operation.',
    },
    {
        title: 'User-friendly visualisation',
        description: 'A clear interface that makes object detection easy.',
    },
    {
        title: 'Reliable and robust design',
        description: 'Built to withstand real-world field conditions.',
    },
    {
        title: 'Expanded detection area',
        description: 'Thanks to optimised design solutions.',
    },
    {
        title: 'Plug-and-play operation',
        description: 'Switch on and start surveying, no complex setup.',
    },
    {
        title: 'Affordable price',
        description: 'Professional capability at a lower cost.',
    },
];

const gallery: GalleryImage[] = [
    {
        src: '/images/garand101/main.jpg',
        alt: 'Garand 101 magnetometer-gradiometer',
        caption: 'Garand 101 magnetometer-gradiometer',
        width: 1200,
        height: 1200,
    },
    {
        src: '/images/garand101/field-1.jpg',
        alt: 'Operator surveying with Garand 101',
        caption: 'One-person operation in the field',
        width: 750,
        height: 1000,
    },
    {
        src: '/images/garand101/display.jpg',
        alt: 'Garand 101 display with a spike on the graph',
        caption: 'A spike on the graph indicates a detected object',
        width: 568,
        height: 730,
    },
    {
        src: '/images/garand101/field-3.jpg',
        alt: 'Garand 101 display during a survey',
        caption: 'Live magnetic field readout',
        width: 750,
        height: 1000,
    },
    {
        src: '/images/garand101/field-2.jpg',
        alt: 'Garand 101 held vertically over the ground',
        caption: 'Compact, balanced design',
        width: 750,
        height: 1000,
    },
    {
        src: '/images/garand101/field-4.jpg',
        alt: 'Carrying the Garand 101',
        caption: 'Lightweight and easy to carry',
        width: 750,
        height: 1000,
    },
    {
        src: '/images/garand101/field-5.jpg',
        alt: 'Garand 101 display close-up',
        caption: 'Readings displayed in nanotesla',
        width: 750,
        height: 1000,
    },
    {
        src: '/images/garand101/field-6.jpg',
        alt: 'Garand 101 in use on grassland',
        caption: 'Surveying open terrain',
        width: 750,
        height: 1000,
    },
    {
        src: '/images/garand101/case.jpg',
        alt: 'Garand 101 in its carrying case',
        caption: 'Supplied with a padded carrying case',
        width: 1000,
        height: 750,
    },
];
</script>

<template>
    <Head title="Garand 101 Magnetometer-Gradiometer">
        <meta
            head-key="description"
            name="description"
            content="Garand 101 is a high-resolution fluxgate magnetometer-gradiometer for detecting ferromagnetic objects. Lightweight, reliable, low-cost and designed for one-person operation."
        />
    </Head>

    <!-- Product hero -->
    <section
        class="relative isolate overflow-hidden bg-slate-50 px-4 sm:px-6 lg:px-8"
    >
        <div
            class="bg-grid absolute inset-0 -z-10 [mask-image:radial-gradient(ellipse_at_center,black_20%,transparent_70%)]"
            aria-hidden="true"
        />
        <div
            class="mx-auto grid max-w-7xl items-center gap-12 py-16 sm:py-20 lg:grid-cols-12 lg:gap-8 lg:py-24"
        >
            <div class="lg:col-span-6">
                <p
                    class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1 text-sm font-medium text-brand-700 shadow-soft ring-1 ring-slate-200"
                >
                    <span class="size-1.5 rounded-full bg-brand-500" />
                    Our product
                </p>
                <h1
                    class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl"
                >
                    Garand 101
                </h1>
                <p class="mt-3 text-xl font-medium text-brand-700 sm:text-2xl">
                    A high-resolution fluxgate magnetometer-gradiometer
                </p>
                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                    Garand 101 measures disruptions in the Earth's magnetic
                    field caused by ferromagnetic objects, providing reliable
                    detection of metals such as iron, steel and nickel.
                </p>

                <blockquote
                    class="mt-8 border-l-4 border-brand-500 pl-5 text-lg font-medium text-slate-800 italic"
                >
                    &ldquo;Magnetic detection can be easy and convenient!&rdquo;
                </blockquote>

                <div class="mt-10 flex flex-wrap gap-3">
                    <ButtonLink :href="contacts()" size="lg">
                        Request information
                        <ArrowRight class="size-4" />
                    </ButtonLink>
                    <ButtonLink
                        :href="presentationUrl"
                        variant="secondary"
                        size="lg"
                        download
                    >
                        <Download class="size-4" />
                        Presentation (PDF)
                    </ButtonLink>
                </div>
            </div>

            <div class="lg:col-span-6">
                <div class="relative mx-auto max-w-lg lg:max-w-none">
                    <div
                        class="absolute inset-10 -z-10 rounded-full bg-brand-300/40 blur-3xl"
                        aria-hidden="true"
                    />
                    <div
                        class="rounded-3xl bg-white p-6 shadow-lifted ring-1 ring-slate-200 sm:p-10"
                    >
                        <img
                            src="/images/garand101/main.jpg"
                            alt="Garand 101 fluxgate magnetometer-gradiometer"
                            width="1200"
                            height="1200"
                            fetchpriority="high"
                            class="aspect-square w-full object-contain"
                        />
                    </div>
                    <div
                        class="absolute right-4 -bottom-5 rounded-xl bg-slate-900 px-4 py-3 text-white shadow-lifted sm:right-8"
                    >
                        <p class="text-xs text-slate-400">Detects</p>
                        <p class="text-sm font-semibold">
                            Iron · Steel · Nickel
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview -->
    <section class="px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <SectionHeading
                    eyebrow="Overview"
                    title="Built for one-person operation"
                    description="Lightweight, user-friendly, reliable and low-cost. Garand 101 makes professional magnetic surveying accessible to a single operator."
                />
            </div>
            <div class="lg:col-span-7">
                <h3
                    class="text-sm font-semibold tracking-wide text-slate-500 uppercase"
                >
                    Target areas
                </h3>
                <ul class="mt-5 grid gap-4 sm:grid-cols-2">
                    <li
                        v-for="area in targetAreas"
                        :key="area.label"
                        class="flex items-center gap-4 rounded-xl bg-white p-4 shadow-soft ring-1 ring-slate-200"
                    >
                        <span
                            class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-brand-50 text-brand-600"
                        >
                            <component :is="area.icon" class="size-5" />
                        </span>
                        <span class="font-medium text-slate-800">
                            {{ area.label }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Key technology -->
    <section class="bg-slate-950 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="Key technology"
                title="A new way to measure the magnetic field"
                description="Garand 101 implements a new magnetic field measurement technology that improves the instrument on every practical front."
                tone="dark"
            />
            <div class="mt-14 grid gap-6 md:grid-cols-3">
                <div
                    v-for="item in technology"
                    :key="item.title"
                    class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10"
                >
                    <div
                        class="flex size-11 items-center justify-center rounded-xl bg-brand-500 text-white"
                    >
                        <component :is="item.icon" class="size-5" />
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-white">
                        {{ item.title }}
                    </h3>
                    <p class="mt-2 leading-7 text-slate-400">
                        {{ item.description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages -->
    <section class="px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="Advantages"
                title="Why Garand 101 stands out"
                description="Seven reasons it outperforms other magnetometers in its class."
                align="center"
            />
            <ol class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <li
                    v-for="(advantage, index) in advantages"
                    :key="advantage.title"
                    class="rounded-2xl bg-white p-6 shadow-soft ring-1 ring-slate-200"
                >
                    <span class="text-sm font-bold text-brand-600 tabular-nums">
                        {{ String(index + 1).padStart(2, '0') }}
                    </span>
                    <h3 class="mt-3 font-semibold text-slate-900">
                        {{ advantage.title }}
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        {{ advantage.description }}
                    </p>
                </li>
                <li
                    class="flex flex-col justify-between rounded-2xl bg-brand-600 p-6 text-white shadow-card"
                >
                    <p class="font-semibold">
                        Want to see it in action or get a quote?
                    </p>
                    <ButtonLink
                        :href="contacts()"
                        variant="light"
                        class="mt-6 self-start"
                    >
                        Contact us
                        <ArrowRight class="size-4" />
                    </ButtonLink>
                </li>
            </ol>
        </div>
    </section>

    <!-- Gallery -->
    <section class="bg-slate-50 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="Gallery"
                title="Garand 101 in the field"
                description="Click any photo to view it in full size."
            />
            <div class="mt-12">
                <ImageGallery :images="gallery" />
            </div>
        </div>
    </section>

    <!-- Documentation -->
    <section class="px-4 pt-20 sm:px-6 sm:pt-24 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-6 md:grid-cols-2">
            <a
                :href="presentationUrl"
                download
                class="group flex items-start gap-5 rounded-2xl bg-white p-6 shadow-card ring-1 ring-slate-200 transition hover:ring-brand-300"
            >
                <span
                    class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600"
                >
                    <FileText class="size-6" />
                </span>
                <span class="flex-1">
                    <span class="block text-sm font-medium text-slate-500">
                        Documentation · PDF
                    </span>
                    <span
                        class="mt-1 block text-lg font-semibold text-slate-900"
                    >
                        Product Presentation of Garand 101
                    </span>
                    <span
                        class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600"
                    >
                        <Download class="size-4" />
                        Download presentation
                    </span>
                </span>
            </a>
            <a
                href="http://www.gradiometr.com"
                target="_blank"
                rel="noopener noreferrer"
                class="group flex items-start gap-5 rounded-2xl bg-white p-6 shadow-card ring-1 ring-slate-200 transition hover:ring-brand-300"
            >
                <span
                    class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600"
                >
                    <ExternalLink class="size-6" />
                </span>
                <span class="flex-1">
                    <span class="block text-sm font-medium text-slate-500">
                        More information
                    </span>
                    <span
                        class="mt-1 block text-lg font-semibold text-slate-900"
                    >
                        www.gradiometr.com
                    </span>
                    <span
                        class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600"
                    >
                        Visit the product website
                        <ArrowRight
                            class="size-4 transition group-hover:translate-x-0.5"
                        />
                    </span>
                </span>
            </a>
        </div>
    </section>

    <CtaBanner
        title="Interested in Garand 101?"
        description="Get in touch for pricing, availability or a demonstration. We are also happy to discuss custom instruments built for your application."
    />
</template>
