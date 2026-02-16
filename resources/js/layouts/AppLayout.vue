<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Toaster } from '@/components/ui/sonner';
import type { AppPageProps, BreadcrumbItem } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import { computed, ref, watch } from 'vue';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage<AppPageProps>();
const lastSuccessMessage = ref<string | null>(null);

const flashSuccess = computed(() => {
    const flash = page.props.flash as { success?: string } | undefined;
    return flash?.success ?? null;
});

watch(
    flashSuccess,
    (message) => {
        if (!message || message === lastSuccessMessage.value) return;
        toast.success(message);
        lastSuccessMessage.value = message;
    },
    { immediate: true },
);
</script>

<template>
    <Toaster rich-colors close-button position="top-right" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
</template>
