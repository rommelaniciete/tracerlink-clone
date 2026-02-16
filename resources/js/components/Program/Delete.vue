<script setup lang="ts">
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Button } from '../ui/button';
import { useForm } from '@inertiajs/vue3';
import program from '@/routes/program';
import { AlertCircle, Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';
import { toast } from 'vue-sonner';
import type { Program } from '@/types';

type Props = {
    programData: Program;
};

const props = defineProps<Props>();

const form = useForm({});

const submit = () => {
    form.delete(program.destroy(props.programData.id).url, {
        onSuccess: () => {
            closeModal.value = false;
            toast.success('Program deleted successfully!')
        },
    });
};

const closeModal = ref(false);
</script>

<template>
    <Dialog v-model:open="closeModal">
        <DialogTrigger as-child>
            <Button size="sm" variant="destructive">Delete</Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <form @submit.prevent="submit" class="space-y-5">
                <DialogHeader>
                    <DialogTitle>Delete Program</DialogTitle>
                    <DialogDescription>
                        Are you sure you want to delete this program? This action cannot be undone.
                    </DialogDescription>
                </DialogHeader>

                <div class="rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-200/10 dark:bg-red-700/10">
                    <div class="flex gap-3">
                        <AlertCircle class="h-5 w-5 text-red-600 dark:text-red-500 flex-shrink-0 mt-0.5" />
                        <div>
                            <p class="text-sm font-medium text-red-800 dark:text-red-300">
                                {{ programData.name }}
                            </p>
                            <p class="text-sm text-red-700 dark:text-red-400 mt-1">
                                This will permanently delete this program and all associated data.
                            </p>
                        </div>
                    </div>
                </div>

                <DialogFooter>
                    <DialogClose as-child>
                        <Button variant="outline"> Cancel </Button>
                    </DialogClose>
                    <Button type="submit" variant="destructive"> Delete </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
