<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {
    Check,
    Code,
    MapPin,
    PenTool,
    Sparkles,
    Users,
    Cpu,
} from '@lucide/vue';
import CtaBanner from '@/components/site/CtaBanner.vue';
import PageHero from '@/components/site/PageHero.vue';
import SectionHeading from '@/components/site/SectionHeading.vue';
import StatsGrid from '@/components/site/StatsGrid.vue';
import { company, highlights, offerings } from '@/lib/site';

const team = [
    {
        icon: Cpu,
        title: 'Engineers',
        description: 'Circuit design, analog and digital electronics.',
    },
    {
        icon: PenTool,
        title: 'Designers',
        description: 'PCB layouts, housings and product design.',
    },
    {
        icon: Code,
        title: 'Programmers',
        description: 'Firmware and software for microcontrollers.',
    },
];

const aims = [
    'We want our clients to be fully satisfied with the results of our work.',
    'We work with our clients until the product is exactly the one they want it to be.',
    'We offer ideas for changes and improvements to make the product even better.',
];

const expertise = [
    'Devices and embedded systems using microcontrollers and microprocessors',
    'Analog electronic devices',
    'Digital electronic devices: logical systems, programmable logic matrices, embedded systems',
    'Telemechanics (telemetry and remote control) over infra-red and radio channels, using Wi-Fi, Bluetooth, GSM and non-standard protocols',
    'Systems to digitise analog and speech signals',
    'Software for various microcontrollers',
    'Designs for printed circuit boards',
    'Signal monitors for three-phase power circuits',
    'Magnetic ferroprobe gauges (gradiometers) and electronic soil probes',
    'Robotics',
    'Automated systems to measure microchips and hardware devices',
];
</script>

<template>
    <Head title="About Us">
        <meta
            head-key="description"
            name="description"
            content="Dimgent Technologies is a group of engineers, designers and programmers in Minsk, Belarus, developing custom electronic devices for more than twenty years."
        />
    </Head>

    <PageHero
        eyebrow="About us"
        title="A group of specialists in electronic device development"
        :description="`Dimgent Technologies develops customised electronic devices. Our development center is located in ${company.location}.`"
    />

    <!-- Intro -->
    <section class="px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-7">
                <SectionHeading
                    eyebrow="Who we are"
                    title="Twenty years of building electronics"
                />
                <div class="mt-6 space-y-5 text-lg leading-8 text-slate-600">
                    <p>
                        Our specialists have been creating electronic devices
                        for more than twenty years. Over this time we have
                        developed, or taken part in the development of, more
                        than 50 projects.
                    </p>
                    <p>
                        We offer a comprehensive approach to the projects we
                        work on: full-cycle development from concept to finished
                        product, or separate phases such as developing the
                        electric circuits of a device, software, or printed
                        circuit board drawings.
                    </p>
                    <p>
                        We are happy to work on both large and small projects,
                        for big or small enterprises. The main reasons to choose
                        us are
                        <span class="font-semibold text-slate-900">
                            cost-effectiveness, quick turn-around times and high
                            quality.
                        </span>
                    </p>
                </div>
            </div>

            <aside class="space-y-6 lg:col-span-5">
                <div
                    class="rounded-2xl bg-white p-6 shadow-card ring-1 ring-slate-200"
                >
                    <div class="flex items-center gap-3">
                        <Users class="size-5 text-brand-600" />
                        <h3 class="font-semibold text-slate-900">
                            Our team includes
                        </h3>
                    </div>
                    <ul class="mt-5 divide-y divide-slate-100">
                        <li
                            v-for="member in team"
                            :key="member.title"
                            class="flex items-center gap-4 py-4 first:pt-0 last:pb-0"
                        >
                            <span
                                class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-brand-50 text-brand-600"
                            >
                                <component :is="member.icon" class="size-5" />
                            </span>
                            <div>
                                <p class="font-medium text-slate-900">
                                    {{ member.title }}
                                </p>
                                <p class="text-sm text-slate-500">
                                    {{ member.description }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div
                    class="flex items-center gap-4 rounded-2xl bg-slate-900 p-6 text-white shadow-card"
                >
                    <span
                        class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-brand-500"
                    >
                        <MapPin class="size-6" />
                    </span>
                    <div>
                        <p class="text-sm text-slate-400">Development center</p>
                        <p class="text-lg font-semibold">
                            {{ company.location }}
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <section class="px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <StatsGrid />
        </div>
    </section>

    <!-- Expertise -->
    <section class="px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <SectionHeading
                eyebrow="Expertise"
                title="Areas of experience"
                description="We have experience across electronic device development, software development and circuitry design, including the development and manufacture of:"
            />
            <ul class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <li
                    v-for="item in expertise"
                    :key="item"
                    class="flex items-start gap-3 rounded-xl bg-slate-50 p-5 text-slate-700 ring-1 ring-slate-200/70"
                >
                    <span
                        class="flex size-6 shrink-0 items-center justify-center rounded-full bg-brand-600 text-white"
                    >
                        <Check class="size-3.5" stroke-width="3" />
                    </span>
                    <span class="leading-6">{{ item }}</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- Aim + what we offer -->
    <section class="bg-slate-950 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-3">
            <div>
                <Sparkles class="size-7 text-brand-400" />
                <h2 class="mt-4 text-2xl font-bold tracking-tight text-white">
                    Our aim
                </h2>
                <ul class="mt-6 space-y-4">
                    <li
                        v-for="aim in aims"
                        :key="aim"
                        class="flex items-start gap-3 leading-7 text-slate-300"
                    >
                        <Check class="mt-1 size-4 shrink-0 text-brand-400" />
                        {{ aim }}
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">
                    We can provide
                </h2>
                <ul class="mt-6 space-y-4">
                    <li
                        v-for="item in offerings"
                        :key="item"
                        class="flex items-start gap-3 leading-7 text-slate-300"
                    >
                        <Check class="mt-1 size-4 shrink-0 text-brand-400" />
                        {{ item }}
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">
                    Dimgent Technologies is
                </h2>
                <ul class="mt-6 space-y-4">
                    <li
                        v-for="item in highlights"
                        :key="item"
                        class="flex items-start gap-3 leading-7 text-slate-300"
                    >
                        <Check class="mt-1 size-4 shrink-0 text-brand-400" />
                        {{ item }}
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <CtaBanner />
</template>
