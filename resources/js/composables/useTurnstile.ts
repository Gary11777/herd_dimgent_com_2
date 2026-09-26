import type { Ref } from 'vue';
import { onBeforeUnmount, onMounted, ref } from 'vue';

type TurnstileRenderOptions = {
    sitekey: string;
    action?: string;
    execution?: 'render' | 'execute';
    appearance?: 'always' | 'execute' | 'interaction-only';
    callback?: (token: string) => void;
    'error-callback'?: (code: string) => boolean | void;
    'expired-callback'?: () => void;
    'timeout-callback'?: () => void;
};

type TurnstileApi = {
    render: (
        container: HTMLElement | string,
        options: TurnstileRenderOptions,
    ) => string | undefined;
    execute: (widgetId: string) => void;
    reset: (widgetId: string) => void;
    remove: (widgetId: string) => void;
    getResponse: (widgetId: string) => string | undefined;
};

declare global {
    interface Window {
        turnstile?: TurnstileApi;
    }
}

const SCRIPT_SRC =
    'https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit';

let scriptPromise: Promise<void> | null = null;

function loadScript(): Promise<void> {
    if (window.turnstile) {
        return Promise.resolve();
    }

    scriptPromise ??= new Promise<void>((resolve, reject) => {
        const script = document.createElement('script');
        script.src = SCRIPT_SRC;
        script.async = true;
        script.onload = () => resolve();
        script.onerror = () => {
            scriptPromise = null;
            script.remove();
            reject(new Error('Failed to load Cloudflare Turnstile.'));
        };
        document.head.appendChild(script);
    });

    return scriptPromise;
}

const FAILED_MESSAGE =
    'The security check could not be completed. Please refresh the page and try again.';

/**
 * Renders an invisible Cloudflare Turnstile widget into `container` and
 * exposes `getToken()`, which runs the challenge on demand (e.g. on submit).
 */
export function useTurnstile(
    container: Ref<HTMLElement | null>,
    siteKey: string | null | undefined,
    action = 'contact',
) {
    const ready = ref(false);
    const loadError = ref<string | null>(null);

    let widgetId: string | undefined;
    let unmounted = false;
    let pending: {
        resolve: (token: string) => void;
        reject: (error: Error) => void;
    } | null = null;

    function settle(token: string | null) {
        if (!pending) {
            return;
        }

        if (token) {
            pending.resolve(token);
        } else {
            pending.reject(new Error(FAILED_MESSAGE));
        }

        pending = null;
    }

    onMounted(async () => {
        if (!siteKey) {
            loadError.value = 'The security check is not configured.';

            return;
        }

        try {
            await loadScript();
        } catch {
            loadError.value =
                'The security check could not be loaded. Please disable content blockers for this site and refresh the page.';

            return;
        }

        if (unmounted || !container.value || !window.turnstile) {
            return;
        }

        widgetId = window.turnstile.render(container.value, {
            sitekey: siteKey,
            action,
            execution: 'execute',
            appearance: 'interaction-only',
            callback: (token) => settle(token),
            'error-callback': () => {
                settle(null);

                return true;
            },
            'timeout-callback': () => settle(null),
        });

        ready.value = widgetId !== undefined;
    });

    onBeforeUnmount(() => {
        unmounted = true;
        settle(null);

        if (widgetId && window.turnstile) {
            window.turnstile.remove(widgetId);
        }
    });

    function getToken(): Promise<string> {
        const turnstile = window.turnstile;

        if (!turnstile || !widgetId) {
            return Promise.reject(
                new Error(
                    loadError.value ??
                        'The security check is still loading. Please try again in a moment.',
                ),
            );
        }

        settle(null);

        const id = widgetId;

        return new Promise<string>((resolve, reject) => {
            pending = { resolve, reject };

            if (turnstile.getResponse(id)) {
                turnstile.reset(id);
            }

            turnstile.execute(id);
        });
    }

    return { ready, loadError, getToken };
}
