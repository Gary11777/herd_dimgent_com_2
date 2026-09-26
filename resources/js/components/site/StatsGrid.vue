<script setup lang="ts">
import { stats } from '@/lib/site';
</script>

<template>
    <dl
        class="grid grid-cols-2 gap-px overflow-hidden rounded-2xl bg-slate-200 shadow-card ring-1 ring-slate-200 lg:grid-cols-4"
    >
        <div
            v-for="stat in stats"
            :key="stat.label"
            class="flex flex-col gap-1 bg-white px-6 py-8 text-center"
        >
            <dt class="order-2 text-sm font-medium text-slate-500">
                {{ stat.label }}
            </dt>
            <dd
                class="order-1 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl"
            >
                {{ stat.value }}
            </dd>
        </div>
    </dl>
</template>
