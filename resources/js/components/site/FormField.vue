<script setup lang="ts">
defineProps<{
    id: string;
    label: string;
    error?: string;
    optional?: boolean;
    hint?: string;
}>();
</script>

<template>
    <div>
        <div class="flex items-baseline justify-between gap-4">
            <label :for="id" class="text-sm font-medium text-slate-900">
                {{ label }}
            </label>
            <span v-if="optional" class="text-xs text-slate-400">Optional</span>
            <span v-else-if="hint" class="text-xs text-slate-400">
                {{ hint }}
            </span>
        </div>
        <div class="mt-2">
            <slot />
        </div>
        <p
            v-if="error"
            :id="`${id}-error`"
            class="mt-2 text-sm text-red-600"
            role="alert"
        >
            {{ error }}
        </p>
    </div>
</template>
