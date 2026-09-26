<script setup lang="ts">
import { ChevronLeft, ChevronRight, Expand, X } from '@lucide/vue';
import { computed, onBeforeUnmount, ref, watch } from 'vue';
import type { GalleryImage } from '@/lib/site';

const props = defineProps<{ images: GalleryImage[] }>();

const activeIndex = ref<number | null>(null);
const active = computed(() =>
    activeIndex.value === null ? null : props.images[activeIndex.value],
);

function open(index: number) {
    activeIndex.value = index;
}

function close() {
    activeIndex.value = null;
}

function step(delta: number) {
    if (activeIndex.value === null) {
        return;
    }

    const count = props.images.length;
    activeIndex.value = (activeIndex.value + delta + count) % count;
}

function onKeydown(event: KeyboardEvent) {
    if (event.key === 'Escape') {
        close();
    } else if (event.key === 'ArrowRight') {
        step(1);
    } else if (event.key === 'ArrowLeft') {
        step(-1);
    }
}

watch(activeIndex, (index, previous) => {
    if (index !== null && previous === null) {
        window.addEventListener('keydown', onKeydown);
        document.body.style.overflow = 'hidden';
    } else if (index === null) {
        window.removeEventListener('keydown', onKeydown);
        document.body.style.overflow = '';
    }
});

onBeforeUnmount(() => {
    window.removeEventListener('keydown', onKeydown);
    document.body.style.overflow = '';
});
</script>

<template>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        <button
            v-for="(image, index) in images"
            :key="image.src"
            type="button"
            class="group relative overflow-hidden rounded-xl bg-slate-100 shadow-soft ring-1 ring-slate-200 focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:outline-none"
            :class="index === 0 ? 'col-span-2 row-span-2' : ''"
            @click="open(index)"
        >
            <img
                :src="image.src"
                :alt="image.alt"
                :width="image.width"
                :height="image.height"
                loading="lazy"
                class="h-full w-full transition duration-500 group-hover:scale-105"
                :class="
                    index === 0
                        ? 'bg-white object-contain p-6 sm:p-10'
                        : 'aspect-[3/4] object-cover'
                "
            />
            <span
                class="absolute inset-0 flex items-end bg-gradient-to-t from-slate-950/70 via-slate-950/0 to-transparent p-4 opacity-0 transition group-hover:opacity-100 group-focus-visible:opacity-100"
            >
                <span
                    class="flex w-full items-center justify-between gap-2 text-left text-sm font-medium text-white"
                >
                    {{ image.caption ?? image.alt }}
                    <Expand class="size-4 shrink-0" />
                </span>
            </span>
        </button>
    </div>

    <Teleport to="body">
        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0"
            leave-active-class="transition duration-150 ease-in"
            leave-to-class="opacity-0"
        >
            <div
                v-if="active"
                class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/90 p-4 backdrop-blur-sm sm:p-8"
                role="dialog"
                aria-modal="true"
                :aria-label="active.alt"
                @click.self="close"
            >
                <button
                    type="button"
                    class="absolute top-4 right-4 inline-flex size-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20"
                    @click="close"
                >
                    <span class="sr-only">Close</span>
                    <X class="size-6" />
                </button>

                <button
                    type="button"
                    class="absolute left-2 inline-flex size-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 sm:left-6"
                    @click="step(-1)"
                >
                    <span class="sr-only">Previous image</span>
                    <ChevronLeft class="size-6" />
                </button>

                <figure class="flex max-h-full max-w-5xl flex-col items-center">
                    <img
                        :key="active.src"
                        :src="active.src"
                        :alt="active.alt"
                        class="max-h-[80vh] w-auto rounded-lg bg-white object-contain shadow-2xl"
                    />
                    <figcaption class="mt-4 text-center text-sm text-slate-300">
                        {{ active.caption ?? active.alt }}
                        <span class="ml-2 text-slate-500">
                            {{ (activeIndex ?? 0) + 1 }} / {{ images.length }}
                        </span>
                    </figcaption>
                </figure>

                <button
                    type="button"
                    class="absolute right-2 inline-flex size-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 sm:right-6"
                    @click="step(1)"
                >
                    <span class="sr-only">Next image</span>
                    <ChevronRight class="size-6" />
                </button>
            </div>
        </Transition>
    </Teleport>
</template>
