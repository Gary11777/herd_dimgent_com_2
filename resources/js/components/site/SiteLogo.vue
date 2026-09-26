<script setup lang="ts">
withDefaults(defineProps<{ variant?: 'dark' | 'light' }>(), {
    variant: 'dark',
});
</script>

<template>
    <img
        src="/images/logo.png"
        alt="Dimgent Technologies"
        width="270"
        height="40"
        class="h-7 w-auto sm:h-8"
        :class="variant === 'dark' ? 'opacity-90 brightness-0' : ''"
    />
</template>
