<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {
    ArrowRight,
    Award,
    BadgeDollarSign,
    Camera,
    CircleCheck,
    Cpu,
    Globe,
    Handshake,
    LifeBuoy,
    ShieldCheck,
    Target,
    Timer,
    Trophy,
} from '@lucide/vue';
import ButtonLink from '@/components/site/ButtonLink.vue';
import CtaBanner from '@/components/site/CtaBanner.vue';
import PageHero from '@/components/site/PageHero.vue';
import SectionHeading from '@/components/site/SectionHeading.vue';
import { highlights, offerings } from '@/lib/site';
import { contacts } from '@/routes';

const phases = [
    {
        title: 'Technical specification',
        description:
            'Preparation and approval of the technical specification for the electronic device you need.',
    },
    {
        title: 'Component selection',
        description:
            'Selection of electronic components, mechanical parts and bundles for the device.',
    },
    {
        title: 'Electric circuits',
        description:
            'Development of the electric circuits as part of the technical documentation.',
    },
    {
        title: 'Software development',
        description:
            'Embedded firmware and any supporting software the device requires.',
    },
    {
        title: 'PCB drawings',
        description: 'Development of printed circuit board drawings.',
    },
    {
        title: 'Casing design',
        description: 'Structural plans and design of the product casing.',
    },
    {
        title: 'Assembly mock-ups',
        description:
            'Mock-ups of individual assemblies within the product needed to validate the intended task.',
    },
    {
        title: 'Final documentation & HMI',
        description:
            'Final technical and user documentation, product software and the man-machine interface design.',
    },
    {
        title: 'Test models & testing',
        description:
            'Production of test models: assembly, fitting, programming and debugging, followed by testing.',
    },
    {
        title: 'Certification preparation',
        description:
            'Preparing the product and documentation for certification.',
    },
    {
        title: 'Technical support',
        description: 'Ongoing support from our team of developers.',
    },
];

const advantages = [
    {
        icon: BadgeDollarSign,
        title: 'Cost',
        description: 'Cost-effective, high-quality services.',
    },
    {
        icon: Timer,
        title: 'Speed',
        description:
            'We only take projects up to our handling capacity, so we can concentrate on each one.',
    },
    {
        icon: Cpu,
        title: 'Efficiency',
        description:
            'A library of standard design elements helps keep development costs down.',
    },
    {
        icon: LifeBuoy,
        title: 'Support',
        description:
            'Every project receives ongoing support from our team of developers.',
    },
    {
        icon: ShieldCheck,
        title: 'Reliability',
        description:
            'All products are assembled and tested in our laboratory before delivery to your address.',
    },
    {
        icon: Award,
        title: 'Experience',
        description:
            'Our specialists have been creating electronic devices for more than twenty years.',
    },
    {
        icon: Trophy,
        title: 'Guaranteed success',
        description:
            'Thanks to our extensive experience we have a 100% success rate in product design.',
    },
    {
        icon: Target,
        title: 'Our aim',
        description:
            'We want every client to be fully satisfied with the results of our work.',
    },
];
</script>

<template>
    <Head title="Services">
        <meta
            head-key="description"
            name="description"
            content="Customised development of electronic devices: full-cycle development from mock-up to finished product, or individual phases such as specification, circuits, software, PCB and casing design."
        />
    </Head>

    <PageHero
        eyebrow="Services"
        title="Customised development of electronic devices"
        description="We offer full-cycle development of electronic devices, from mock-up to finished product, or, if required, we can complete just the individual phases you need."
    >
        <div class="flex flex-wrap gap-3">
            <ButtonLink :href="contacts()" variant="light" size="lg">
                Discuss your project
                <ArrowRight class="size-4" />
            </ButtonLink>
        </div>
    </PageHero>

    <!-- Development process -->
    <section class="px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-28">
                    <SectionHeading
                        eyebrow="Development process"
                        title="From specification to support"
                        description="A complete development cycle, broken into clear phases. Pick the whole process or only the stages you need."
                    />
                    <div
                        class="mt-8 space-y-3 rounded-2xl bg-slate-50 p-6 text-sm leading-6 text-slate-600 ring-1 ring-slate-200"
                    >
                        <p class="flex gap-3">
                            <span class="font-semibold text-brand-600">*</span>
                            Some development phases may be skipped as required.
                        </p>
                        <p class="flex gap-3">
                            <span class="font-semibold text-brand-600">*</span>
                            Additional development phases may also be included
                            if required.
                        </p>
                    </div>
                </div>
            </div>

            <ol class="relative lg:col-span-8">
                <li
                    v-for="(phase, index) in phases"
                    :key="phase.title"
                    class="relative flex gap-6 pb-10 last:pb-0"
                >
                    <div
                        v-if="index < phases.length - 1"
                        class="absolute top-12 bottom-0 left-6 w-px bg-slate-200"
                        aria-hidden="true"
                    />
                    <span
                        class="relative flex size-12 shrink-0 items-center justify-center rounded-full bg-white text-sm font-bold text-brand-600 tabular-nums shadow-soft ring-1 ring-slate-200"
                    >
                        {{ String(index + 1).padStart(2, '0') }}
                    </span>
                    <div class="pt-2.5">
                        <h3 class="font-semibold text-slate-900">
                            {{ phase.title }}
                        </h3>
                        <p class="mt-1.5 leading-7 text-slate-600">
                            {{ phase.description }}
                        </p>
                    </div>
                </li>
            </ol>
        </div>
    </section>

    <!-- Advantages -->
    <section class="bg-slate-50 px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="Advantages"
                title="What you gain by working with us"
                description="When you order electronic equipment development from Dimgent Technologies you obtain the following advantages."
                align="center"
            />
            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    v-for="advantage in advantages"
                    :key="advantage.title"
                    class="rounded-2xl bg-white p-6 shadow-soft ring-1 ring-slate-200"
                >
                    <div
                        class="flex size-10 items-center justify-center rounded-lg bg-brand-50 text-brand-600 ring-1 ring-brand-100"
                    >
                        <component :is="advantage.icon" class="size-5" />
                    </div>
                    <h3 class="mt-5 font-semibold text-slate-900">
                        {{ advantage.title }}
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        {{ advantage.description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Commitment + offerings -->
    <section class="px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-3">
            <div
                class="rounded-2xl bg-white p-8 shadow-card ring-1 ring-slate-200 lg:col-span-2"
            >
                <div class="flex items-center gap-3">
                    <Handshake class="size-6 text-brand-600" />
                    <h2
                        class="text-2xl font-bold tracking-tight text-slate-900"
                    >
                        We work with you until it's right
                    </h2>
                </div>
                <p class="mt-4 max-w-2xl leading-7 text-slate-600">
                    We work with our clients until the product is exactly the
                    one they want it to be. We also offer ideas for changes and
                    improvements to the product being developed, to improve its
                    functionality and efficiency.
                </p>
                <p class="mt-4 max-w-2xl leading-7 text-slate-600">
                    <span class="font-semibold text-slate-900">Briefly:</span>
                    we ensure our devices are cost-effective by using the
                    minimum possible number of components, carefully selected to
                    balance cost-effectiveness and high quality.
                </p>

                <h3
                    class="mt-10 text-sm font-semibold tracking-wide text-slate-500 uppercase"
                >
                    We can provide
                </h3>
                <ul class="mt-4 grid gap-3">
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
                    <li class="flex items-start gap-3 text-slate-700">
                        <CircleCheck
                            class="mt-0.5 size-5 shrink-0 text-brand-600"
                        />
                        Programming of industrial controllers and
                        microcontrollers.
                    </li>
                </ul>
            </div>

            <div class="rounded-2xl bg-slate-900 p-8 text-white shadow-card">
                <p class="text-sm font-semibold text-brand-300">
                    Dimgent Technologies is
                </p>
                <ul class="mt-6 space-y-4">
                    <li
                        v-for="item in highlights"
                        :key="item"
                        class="flex items-start gap-3 text-slate-200"
                    >
                        <CircleCheck
                            class="mt-0.5 size-5 shrink-0 text-brand-400"
                        />
                        {{ item }}
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Distance -->
    <section class="bg-slate-950 px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
        <div
            class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2 lg:gap-16"
        >
            <div>
                <SectionHeading
                    eyebrow="Working remotely"
                    title="Is distance a problem? Of course not."
                    tone="dark"
                />
                <div class="mt-6 space-y-4 text-lg leading-8 text-slate-300">
                    <p>
                        Most of our clients from other countries outsource
                        device development to keep costs down. Some were
                        concerned that the work is carried out far away, but
                        once they received the finished product and evaluated
                        its quality, they often placed more orders.
                    </p>
                    <p>The Internet brings us nearer than ever before.</p>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <Globe class="size-7 text-brand-400" />
                    <h3 class="mt-4 font-semibold text-white">
                        International clients
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-slate-400">
                        We deliver tested devices to clients in other countries
                        who return with new projects.
                    </p>
                </div>
                <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <Camera class="size-7 text-brand-400" />
                    <h3 class="mt-4 font-semibold text-white">
                        Transparent progress
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-slate-400">
                        If you wish, we keep you updated on the progress of the
                        work with photos and video.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <CtaBanner />
</template>
