<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowRight,
    Box,
    CircleCheck,
    CircuitBoard,
    Code,
    FileText,
    FlaskConical,
    Layers,
    Puzzle,
    ShieldCheck,
    Timer,
    Wallet,
    Workflow,
} from '@lucide/vue';
import ButtonLink from '@/components/site/ButtonLink.vue';
import CtaBanner from '@/components/site/CtaBanner.vue';
import SectionHeading from '@/components/site/SectionHeading.vue';
import StatsGrid from '@/components/site/StatsGrid.vue';
import { company } from '@/lib/site';
import { contacts, products, services } from '@/routes';

const serviceModes = [
    {
        icon: Workflow,
        title: 'Full-cycle development',
        description:
            'We take your device from the first concept and technical specification all the way to a tested, finished product.',
        points: [
            'Specification & component selection',
            'Hardware, software and housing',
            'Test models, testing & certification prep',
        ],
    },
    {
        icon: Puzzle,
        title: 'Individual development phases',
        description:
            'Need help with one part of the job? We can complete specialised phases or finish a project that has already been started.',
        points: [
            'Circuit design or PCB layouts only',
            'Embedded software development',
            'Completion of unfinished projects',
        ],
    },
];

const areas = [
    {
        icon: FileText,
        title: 'Technical specification',
        description:
            'Preparing and approving the specification for the device you need.',
    },
    {
        icon: CircuitBoard,
        title: 'Electric circuits',
        description:
            'Analog and digital circuit design with careful component selection.',
    },
    {
        icon: Code,
        title: 'Software',
        description:
            'Firmware for microcontrollers plus user-facing software and interfaces.',
    },
    {
        icon: Layers,
        title: 'PCB layouts',
        description:
            'Printed circuit board drawings ready for manufacturing and assembly.',
    },
    {
        icon: Box,
        title: 'Housing design',
        description:
            'Structural plans and design of the product casing and mechanics.',
    },
    {
        icon: FlaskConical,
        title: 'Test models & prototyping',
        description:
            'Assembly, fitting, programming, debugging and testing of prototypes.',
    },
];

const reasons = [
    {
        icon: Wallet,
        title: 'Cost effective',
        description:
            'Minimal component count and a careful balance between cost and quality.',
    },
    {
        icon: Timer,
        title: 'Short turn-around',
        description:
            'We only take on projects up to our capacity, so each one gets full focus.',
    },
    {
        icon: ShieldCheck,
        title: 'Guaranteed quality',
        description:
            'Every device is assembled and tested in our laboratory before delivery.',
    },
];
</script>

<template>
    <Head title="Electronics Development">
        <meta
            head-key="description"
            name="description"
            content="Dimgent Technologies develops custom electronic devices: full-cycle development from concept to finished product, or individual phases like circuits, software and PCB layouts."
        />
    </Head>

    <!-- Hero -->
    <section class="relative isolate overflow-hidden px-4 sm:px-6 lg:px-8">
        <div
            class="bg-grid absolute inset-0 -z-10 [mask-image:radial-gradient(ellipse_at_top_right,black_20%,transparent_70%)]"
            aria-hidden="true"
        />
        <div
            class="mx-auto grid max-w-7xl items-center gap-12 pt-14 pb-20 sm:pt-20 lg:grid-cols-2 lg:gap-8 lg:pt-24 lg:pb-28"
        >
            <div>
                <p
                    class="inline-flex items-center gap-2 rounded-full bg-brand-50 px-3 py-1 text-sm font-medium text-brand-700 ring-1 ring-brand-100"
                >
                    <span class="size-1.5 rounded-full bg-brand-500" />
                    {{ company.tagline }} · {{ company.location }}
                </p>
                <h1
                    class="mt-6 text-4xl font-bold tracking-tight text-balance text-slate-900 sm:text-5xl lg:text-6xl"
                >
                    Custom electronic devices,
                    <span class="text-brand-600">
                        from concept to finished product.
                    </span>
                </h1>
                <p
                    class="mt-6 max-w-xl text-lg leading-8 text-pretty text-slate-600"
                >
                    Dimgent Technologies is a group of engineers, designers and
                    programmers who have been creating electronic devices for
                    more than twenty years.
                </p>
                <div class="mt-10 flex flex-wrap gap-3">
                    <ButtonLink :href="contacts()" size="lg">
                        Start a project
                        <ArrowRight class="size-4" />
                    </ButtonLink>
                    <ButtonLink
                        :href="services()"
                        variant="secondary"
                        size="lg"
                    >
                        Explore services
                    </ButtonLink>
                </div>
                <ul
                    class="mt-10 flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-600"
                >
                    <li
                        v-for="item in [
                            '50+ projects delivered',
                            '20+ years of experience',
                            'Tested in our lab',
                        ]"
                        :key="item"
                        class="flex items-center gap-2"
                    >
                        <CircleCheck class="size-4 text-brand-600" />
                        {{ item }}
                    </li>
                </ul>
            </div>

            <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                <div
                    class="absolute inset-6 -z-10 rounded-full bg-brand-200/60 blur-3xl"
                    aria-hidden="true"
                />
                <div
                    class="overflow-hidden rounded-3xl bg-white p-6 shadow-lifted ring-1 ring-slate-200 sm:p-10"
                >
                    <img
                        src="/images/garand101/main.jpg"
                        alt="Garand 101 fluxgate magnetometer-gradiometer"
                        width="1200"
                        height="1200"
                        class="aspect-square w-full object-contain"
                        fetchpriority="high"
                    />
                </div>
                <Link
                    :href="products()"
                    class="group absolute -bottom-6 left-4 flex items-center gap-4 rounded-2xl bg-white p-4 pr-5 shadow-lifted ring-1 ring-slate-200 transition hover:ring-brand-300 sm:left-8"
                >
                    <span
                        class="flex size-11 items-center justify-center rounded-xl bg-brand-600 text-sm font-bold text-white"
                    >
                        G1
                    </span>
                    <span>
                        <span
                            class="block text-xs font-medium tracking-wide text-slate-500 uppercase"
                        >
                            Our product
                        </span>
                        <span
                            class="flex items-center gap-1 text-sm font-semibold text-slate-900"
                        >
                            Garand 101 magnetometer
                            <ArrowRight
                                class="size-4 text-brand-600 transition group-hover:translate-x-0.5"
                            />
                        </span>
                    </span>
                </Link>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <StatsGrid />
        </div>
    </section>

    <!-- Two ways to work -->
    <section class="px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="What we do"
                title="Two ways we can help"
                description="Whether you need a complete device or support on a specific stage, we adapt to the scope of your project."
            />
            <div class="mt-12 grid gap-6 lg:grid-cols-2">
                <article
                    v-for="mode in serviceModes"
                    :key="mode.title"
                    class="rounded-2xl bg-white p-8 shadow-card ring-1 ring-slate-200"
                >
                    <div
                        class="flex size-12 items-center justify-center rounded-xl bg-brand-50 text-brand-600 ring-1 ring-brand-100"
                    >
                        <component :is="mode.icon" class="size-6" />
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        {{ mode.title }}
                    </h3>
                    <p class="mt-3 leading-7 text-slate-600">
                        {{ mode.description }}
                    </p>
                    <ul class="mt-6 space-y-3 border-t border-slate-100 pt-6">
                        <li
                            v-for="point in mode.points"
                            :key="point"
                            class="flex items-start gap-3 text-sm text-slate-700"
                        >
                            <CircleCheck
                                class="mt-0.5 size-4 shrink-0 text-brand-600"
                            />
                            {{ point }}
                        </li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <!-- Development areas -->
    <section class="bg-slate-50 px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="Development areas"
                title="Every stage of electronic device development"
                description="Our specialists cover the full range of disciplines needed to turn an idea into working hardware."
                align="center"
            />
            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="area in areas"
                    :key="area.title"
                    class="group rounded-2xl bg-white p-6 shadow-soft ring-1 ring-slate-200 transition hover:-translate-y-0.5 hover:shadow-card"
                >
                    <div
                        class="flex size-10 items-center justify-center rounded-lg bg-slate-900 text-white transition group-hover:bg-brand-600"
                    >
                        <component :is="area.icon" class="size-5" />
                    </div>
                    <h3 class="mt-5 font-semibold text-slate-900">
                        {{ area.title }}
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        {{ area.description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured product -->
    <section class="px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div
            class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2 lg:gap-16"
        >
            <div class="grid grid-cols-2 gap-4">
                <img
                    src="/images/garand101/field-3.jpg"
                    alt="Garand 101 in use during a field survey"
                    width="750"
                    height="1000"
                    loading="lazy"
                    class="aspect-[3/4] w-full rounded-2xl object-cover shadow-card"
                />
                <img
                    src="/images/garand101/field-5.jpg"
                    alt="Garand 101 display showing a magnetic anomaly"
                    width="750"
                    height="1000"
                    loading="lazy"
                    class="mt-10 aspect-[3/4] w-full rounded-2xl object-cover shadow-card"
                />
            </div>
            <div>
                <SectionHeading
                    eyebrow="Featured product"
                    title="Garand 101 magnetometer-gradiometer"
                    description="A high-resolution fluxgate magnetometer that detects ferromagnetic objects such as iron, steel and nickel. Lightweight, reliable and designed for one-person operation."
                />
                <dl class="mt-8 grid grid-cols-2 gap-6">
                    <div
                        v-for="item in [
                            ['Fully digital', 'Improved noise stability'],
                            ['Plug & play', 'Ready to use out of the box'],
                            ['Low power', 'Longer operating time'],
                            ['Lightweight', 'Built for one person'],
                        ]"
                        :key="item[0]"
                        class="border-l-2 border-brand-500 pl-4"
                    >
                        <dt class="font-semibold text-slate-900">
                            {{ item[0] }}
                        </dt>
                        <dd class="mt-1 text-sm text-slate-600">
                            {{ item[1] }}
                        </dd>
                    </div>
                </dl>
                <div class="mt-10">
                    <ButtonLink :href="products()">
                        Discover Garand 101
                        <ArrowRight class="size-4" />
                    </ButtonLink>
                </div>
            </div>
        </div>
    </section>

    <!-- Why us -->
    <section class="bg-slate-950 px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="Why Dimgent"
                title="Engineering you can rely on"
                description="Our clients from other countries often come back with new orders once they have evaluated the quality of the finished product."
                tone="dark"
            />
            <div class="mt-14 grid gap-10 md:grid-cols-3">
                <div v-for="reason in reasons" :key="reason.title">
                    <div
                        class="flex size-11 items-center justify-center rounded-xl bg-brand-500/10 text-brand-300 ring-1 ring-brand-400/20"
                    >
                        <component :is="reason.icon" class="size-5" />
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-white">
                        {{ reason.title }}
                    </h3>
                    <p class="mt-2 leading-7 text-slate-400">
                        {{ reason.description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <CtaBanner />
</template>
