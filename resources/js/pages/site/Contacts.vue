<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import {
    CircleAlert,
    CircleCheck,
    Loader2,
    Mail,
    MapPin,
    Send,
    ShieldCheck,
} from '@lucide/vue';
import { computed, nextTick, ref } from 'vue';
import FormField from '@/components/site/FormField.vue';
import PageHero from '@/components/site/PageHero.vue';
import { useTurnstile } from '@/composables/useTurnstile';
import { company } from '@/lib/site';
import { store } from '@/routes/contacts';

const props = defineProps<{
    turnstileSiteKey: string | null;
    formToken: string;
}>();

const contactEmail = company.email;

const MESSAGE_MAX = 5000;

const form = useForm({
    name: '',
    email: '',
    phone: '',
    company: '',
    subject: '',
    message: '',
    website: '',
    form_token: props.formToken,
    turnstile_token: '',
});

const turnstileContainer = ref<HTMLElement | null>(null);
const { getToken, loadError } = useTurnstile(
    turnstileContainer,
    props.turnstileSiteKey,
);

const formCard = ref<HTMLElement | null>(null);
const submitting = ref(false);
const sentTo = ref<string | null>(null);

const errors = computed(() => form.errors as Partial<Record<string, string>>);

const busy = computed(() => submitting.value || form.processing);

function inputClass(field: keyof typeof form.errors) {
    return [
        'block w-full rounded-lg border-0 bg-white px-3.5 py-2.5 text-slate-900 shadow-soft ring-1 ring-inset placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:outline-none sm:text-sm sm:leading-6',
        form.errors[field]
            ? 'ring-red-300 focus:ring-red-500'
            : 'ring-slate-300 focus:ring-brand-600',
    ];
}

async function submit() {
    if (busy.value) {
        return;
    }

    submitting.value = true;
    form.clearErrors();

    try {
        form.turnstile_token = await getToken();
    } catch (error) {
        form.setError(
            'turnstile_token',
            error instanceof Error ? error.message : String(error),
        );
        submitting.value = false;

        return;
    }

    const email = form.email;

    form.post(store.url(), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: async () => {
            sentTo.value = email;
            form.reset();
            await nextTick();
            formCard.value?.scrollIntoView({
                behavior: 'smooth',
                block: 'center',
            });
        },
        onFinish: () => {
            form.turnstile_token = '';
            submitting.value = false;
        },
    });
}

function sendAnother() {
    sentTo.value = null;
}
</script>

<template>
    <Head title="Contacts">
        <meta
            head-key="description"
            name="description"
            content="Contact Dimgent Technologies about custom electronic device development or the Garand 101 magnetometer."
        />
    </Head>

    <PageHero
        eyebrow="Contacts"
        title="Let's talk about your project"
        description="For more information, email us directly or use the form below. Tell us what you need, whether it's a complete device or a single phase of development."
    />

    <section class="px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-12 lg:gap-12">
            <!-- Contact details -->
            <aside class="space-y-6 lg:col-span-4">
                <a
                    :href="`mailto:${contactEmail}`"
                    class="group flex items-start gap-4 rounded-2xl bg-white p-6 shadow-card ring-1 ring-slate-200 transition hover:ring-brand-300"
                >
                    <span
                        class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-600 text-white"
                    >
                        <Mail class="size-5" />
                    </span>
                    <span>
                        <span class="block text-sm text-slate-500"
                            >Email us</span
                        >
                        <span
                            class="mt-0.5 block font-semibold break-all text-slate-900 group-hover:text-brand-700"
                        >
                            {{ contactEmail }}
                        </span>
                    </span>
                </a>

                <div
                    class="flex items-start gap-4 rounded-2xl bg-white p-6 shadow-card ring-1 ring-slate-200"
                >
                    <span
                        class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-slate-900 text-white"
                    >
                        <MapPin class="size-5" />
                    </span>
                    <span>
                        <span class="block text-sm text-slate-500">
                            Development center
                        </span>
                        <span class="mt-0.5 block font-semibold text-slate-900">
                            {{ company.location }}
                        </span>
                    </span>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200">
                    <h2 class="font-semibold text-slate-900">
                        Helpful details to include
                    </h2>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        <li
                            v-for="tip in [
                                'What the device should do and where it will be used',
                                'Full-cycle development or specific phases only',
                                'Any existing specification, schematics or prototypes',
                                'Expected quantities and your preferred timeline',
                            ]"
                            :key="tip"
                            class="flex items-start gap-2.5"
                        >
                            <CircleCheck
                                class="mt-0.5 size-4 shrink-0 text-brand-600"
                            />
                            {{ tip }}
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Form -->
            <div class="lg:col-span-8">
                <div
                    ref="formCard"
                    class="scroll-mt-24 rounded-2xl bg-white shadow-lifted ring-1 ring-slate-200"
                >
                    <div
                        v-if="sentTo"
                        class="flex flex-col items-center px-6 py-16 text-center sm:px-12"
                        role="status"
                    >
                        <span
                            class="flex size-14 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 ring-8 ring-emerald-50/50"
                        >
                            <CircleCheck class="size-7" />
                        </span>
                        <h2
                            class="mt-6 text-2xl font-bold tracking-tight text-slate-900"
                        >
                            Thank you, your message has been sent
                        </h2>
                        <p class="mt-3 max-w-md leading-7 text-slate-600">
                            We'll get back to you at
                            <span class="font-medium text-slate-900">{{
                                sentTo
                            }}</span>
                            as soon as possible.
                        </p>
                        <button
                            type="button"
                            class="mt-8 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-slate-800 shadow-soft ring-1 ring-slate-200 transition hover:bg-slate-50"
                            @click="sendAnother"
                        >
                            Send another message
                        </button>
                    </div>

                    <form
                        v-else
                        class="p-6 sm:p-10"
                        novalidate
                        @submit.prevent="submit"
                    >
                        <div class="border-b border-slate-100 pb-6">
                            <h2
                                class="text-xl font-semibold tracking-tight text-slate-900"
                            >
                                Send us a message
                            </h2>
                            <p class="mt-1 text-sm text-slate-500">
                                You can contact us using the form below.
                            </p>
                        </div>

                        <div
                            v-if="errors.form"
                            class="mt-6 flex items-start gap-3 rounded-lg bg-red-50 p-4 text-sm text-red-800 ring-1 ring-red-200"
                            role="alert"
                        >
                            <CircleAlert class="mt-0.5 size-4 shrink-0" />
                            <p>
                                {{ errors.form }}
                                <a
                                    :href="`mailto:${contactEmail}`"
                                    class="font-semibold underline"
                                >
                                    {{ contactEmail }}
                                </a>
                            </p>
                        </div>

                        <div class="mt-6 grid gap-6 sm:grid-cols-2">
                            <FormField
                                id="name"
                                label="Full name"
                                :error="form.errors.name"
                            >
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    autocomplete="name"
                                    maxlength="100"
                                    required
                                    :class="inputClass('name')"
                                    :aria-invalid="!!form.errors.name"
                                    :aria-describedby="
                                        form.errors.name
                                            ? 'name-error'
                                            : undefined
                                    "
                                />
                            </FormField>

                            <FormField
                                id="email"
                                label="Email"
                                :error="form.errors.email"
                            >
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    autocomplete="email"
                                    maxlength="254"
                                    required
                                    :class="inputClass('email')"
                                    :aria-invalid="!!form.errors.email"
                                    :aria-describedby="
                                        form.errors.email
                                            ? 'email-error'
                                            : undefined
                                    "
                                />
                            </FormField>

                            <FormField
                                id="phone"
                                label="Phone"
                                optional
                                :error="form.errors.phone"
                            >
                                <input
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    name="phone"
                                    autocomplete="tel"
                                    maxlength="40"
                                    :class="inputClass('phone')"
                                    :aria-invalid="!!form.errors.phone"
                                />
                            </FormField>

                            <FormField
                                id="company"
                                label="Company"
                                optional
                                :error="form.errors.company"
                            >
                                <input
                                    id="company"
                                    v-model="form.company"
                                    type="text"
                                    name="company"
                                    autocomplete="organization"
                                    maxlength="150"
                                    :class="inputClass('company')"
                                    :aria-invalid="!!form.errors.company"
                                />
                            </FormField>

                            <FormField
                                id="subject"
                                label="Subject"
                                class="sm:col-span-2"
                                :error="form.errors.subject"
                            >
                                <input
                                    id="subject"
                                    v-model="form.subject"
                                    type="text"
                                    name="subject"
                                    maxlength="150"
                                    required
                                    placeholder="e.g. Development of a remote sensor module"
                                    :class="inputClass('subject')"
                                    :aria-invalid="!!form.errors.subject"
                                />
                            </FormField>

                            <FormField
                                id="message"
                                label="Message"
                                class="sm:col-span-2"
                                :hint="`${form.message.length} / ${MESSAGE_MAX}`"
                                :error="form.errors.message"
                            >
                                <textarea
                                    id="message"
                                    v-model="form.message"
                                    name="message"
                                    rows="6"
                                    :maxlength="MESSAGE_MAX"
                                    required
                                    placeholder="Tell us about your device, its purpose and what help you need."
                                    :class="inputClass('message')"
                                    :aria-invalid="!!form.errors.message"
                                />
                            </FormField>
                        </div>

                        <!-- Honeypot: hidden from people, tempting for bots -->
                        <div
                            class="absolute -left-[9999px] h-px w-px overflow-hidden"
                            aria-hidden="true"
                        >
                            <label for="website">Website</label>
                            <input
                                id="website"
                                v-model="form.website"
                                type="text"
                                name="website"
                                tabindex="-1"
                                autocomplete="off"
                            />
                        </div>

                        <div
                            ref="turnstileContainer"
                            class="mt-6 empty:hidden"
                        />

                        <p
                            v-if="form.errors.turnstile_token || loadError"
                            class="mt-6 flex items-start gap-2 text-sm text-red-600"
                            role="alert"
                        >
                            <CircleAlert class="mt-0.5 size-4 shrink-0" />
                            {{ form.errors.turnstile_token ?? loadError }}
                        </p>

                        <div
                            class="mt-8 flex flex-col-reverse gap-4 border-t border-slate-100 pt-6 sm:flex-row sm:items-center sm:justify-between"
                        >
                            <p
                                class="flex items-center gap-2 text-xs text-slate-500"
                            >
                                <ShieldCheck class="size-4 text-slate-400" />
                                Protected by Cloudflare Turnstile. Your details
                                are only used to reply to you.
                            </p>
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-brand-700 focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-60"
                                :disabled="busy"
                            >
                                <Loader2
                                    v-if="busy"
                                    class="size-4 animate-spin"
                                />
                                <Send v-else class="size-4" />
                                {{ busy ? 'Sending…' : 'Send message' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
