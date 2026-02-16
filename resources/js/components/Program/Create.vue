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
import { Input } from '../ui/input';
import { Label } from '../ui/label';
import { useForm } from '@inertiajs/vue3';
import program from '@/routes/program';
import { AlertCircle } from 'lucide-vue-next';
import { ref } from 'vue';
import { toast } from 'vue-sonner';

const form = useForm({
    name: '',
});

const submit = () => {
    form.post(program.store().url, {
        onSuccess: () => {
            form.reset();
            closeModal.value = false;
            toast.success('Program created successfully!')
        },
    });
};

const closeModal = ref(false);
</script>

<template>
    <Dialog v-model:open="closeModal">
        <DialogTrigger as-child>
            <Button> Create Program </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <form @submit.prevent="submit" class="space-y-5">
                <DialogHeader>
                    <DialogTitle>Create Program</DialogTitle>
                    <DialogDescription>
                        Make changes to your program here. Click save when
                        you're done.
                    </DialogDescription>
                </DialogHeader>

                <div class="grid gap-4">
                    <div class="grid gap-3">
                        <Label for="name-1">Program Name</Label>
                        <Input
                            v-model="form.name"
                            type="text"
                            placeholder="e.g. Information Technology"
                        />

                        <div v-if="form.errors.name">
                            <p
                                class="item-center flex gap-2 p-1 text-sm text-red-600"
                            >
                                <AlertCircle class="h-4 w-4" />{{
                                    form.errors.name
                                }}
                            </p>
                        </div>
                    </div>
                </div>
                <DialogFooter>
                    <DialogClose as-child>
                        <Button variant="outline"> Cancel </Button>
                    </DialogClose>
                    <Button type="submit"> Save changes </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
