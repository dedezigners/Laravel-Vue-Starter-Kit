<template>
    <div class="de-datatable">
        <DeTable :header="header" :data="data">
            <template v-for="(_, name) in $slots" v-slot:[name]="{ data: item }">
                <slot :name="name" :data="item" />
            </template>
        </DeTable>
    </div>
</template>

<script lang="ts">
import { DeTableHead } from '@/core/type';
import DeTable from './DeTable.vue';
import { PropType } from 'vue';

export default {
    name: "DeDatatable",
    components: { DeTable, },
    props: {
        header: { type: Array as PropType<DeTableHead[]>, required: true },
        data: { type: Array as PropType<any>, default: () => [] },
        isLoading: { type: Boolean, default: false },
        itemsPerPage: { type: Number, default: 20 },
        emptyTableText: { type: String, default: "No Data!" },
        currentPage: { type: Number, default: 1 },
    },
    emits: [],
    setup: (props, { emit }) => {}
}
</script>
