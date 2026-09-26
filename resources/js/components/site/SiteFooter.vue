<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Mail, MapPin } from '@lucide/vue';
import SiteLogo from '@/components/site/SiteLogo.vue';
import { company, navigation } from '@/lib/site';

const year = new Date().getFullYear();
</script>

<template>
    <footer class="bg-slate-950 px-4 text-slate-400 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl pt-16 pb-10">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <SiteLogo variant="light" />
                    <p class="mt-5 max-w-sm text-sm leading-6">
                        A group of specialists developing custom electronic
                        devices, from technical specification and circuit design
                        to tested, production-ready hardware.
                    </p>
                </div>

                <div class="lg:col-span-3">
                    <h2
                        class="text-xs font-semibold tracking-wider text-slate-200 uppercase"
                    >
                        Navigation
                    </h2>
                    <ul class="mt-4 grid grid-cols-2 gap-x-6 gap-y-3 text-sm">
                        <li v-for="item in navigation" :key="item.label">
                            <Link
                                :href="item.href"
                                class="transition-colors hover:text-white"
                            >
                                {{ item.label }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <div class="lg:col-span-4">
                    <h2
                        class="text-xs font-semibold tracking-wider text-slate-200 uppercase"
                    >
                        Get in touch
                    </h2>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li class="flex items-center gap-3">
                            <Mail class="size-4 shrink-0 text-brand-400" />
                            <a
                                :href="`mailto:${company.email}`"
                                class="transition-colors hover:text-white"
                            >
                                {{ company.email }}
                            </a>
                        </li>
                        <li class="flex items-center gap-3">
                            <MapPin class="size-4 shrink-0 text-brand-400" />
                            <span>
                                Development center: {{ company.location }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="mt-14 flex flex-col gap-2 border-t border-white/10 pt-8 text-xs sm:flex-row sm:items-center sm:justify-between"
            >
                <p>
                    &copy; {{ year }} {{ company.name }}. All rights reserved.
                </p>
                <p>{{ company.tagline }} · {{ company.location }}</p>
            </div>
        </div>
    </footer>
</template>
