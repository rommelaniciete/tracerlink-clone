<script setup lang="ts">
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Program } from '@/types';
import { Button } from '../ui/button';
import Edit from './Edit.vue';
import Delete from './Delete.vue';

defineProps<{
    programs: {
        data: Program[];
        links: any[];
    };
}>();
</script>
<template>
    <Table>
        <TableCaption>A list of your recent programs.</TableCaption>
        <TableHeader>
            <TableRow>
                <TableHead>#</TableHead>
                <TableHead>Program Name</TableHead>
                <TableHead class="m-4 text-right">Actions</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow
                v-for="(programItem, index) in programs.data"
                :key="programItem.id"
            >
                <TableCell class="font-medium"> {{ index + 1 }}</TableCell>
                <TableCell>{{ programItem.name }}</TableCell>
                <TableCell class="space-x-2 text-right">
                    <Edit :program-data="programItem" />
                    <Delete :program-data="programItem" />
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>
