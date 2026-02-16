<script setup lang="ts">
import Create from '@/components/Program/Create.vue'; 
import Table from '@/components/Program/Table.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Program } from '@/types';

defineProps<{
    programs: Program[];
}>();

</script>

<template>
    <AppLayout>
        <div class="flex flex-1 flex-col gap-4 p-4">
            <section class="flex justify-end">
                <Create/>
            </section>

            <section>
                <Table :programs="programs"/>
            </section>
        </div>
    </AppLayout>
</template>
