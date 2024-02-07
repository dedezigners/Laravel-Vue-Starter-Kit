<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <template v-for="(column, i) in header" :key="i">
                        <th :class="column.class" :style="{
                            cursor: column.sort ? 'pointer' : 'auto',
                        }">
                            {{ column.label }}
                            <font-awesome-icon v-if="column.sort" icon="arrow-down-long" />
                        </th>
                    </template>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!data.length">
                    <td :colspan="header.length" class="text-center">{{ emptyTableText }}</td>
                </tr>
                <template v-for="(dt, i) in data" :key="i">
                    <tr>
                        <template v-for="(c, j) in header" :key="j">
                            <td :class="[c.class, c.name === 'actions' ? 'td--actions' : '']">
                                <slot :name="c.name" :data="dt">{{ tableData(dt, c.name) ?? '&mdash;' }}</slot>
                            </td>
                        </template>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { DeTableHead } from '@/core/type';
import { PropType } from 'vue';

export default {
    name: "DeTable",
    props: {
        header: { type: Array as PropType<DeTableHead[]>, required: true },
        data: { type: Array as PropType<any>, default: () => [] },
        emptyTableText: { type: String, default: "No Data!" },
    },
    emits: [],
    setup: (props, { emit }) => {
        const tableData = (data: any, columnName: string) => {
            const hasDot = columnName.includes('.');
            if (hasDot) {
                const splitColumnName = columnName.split('.');
                const hasColumnData = data[splitColumnName[0]];
                return hasColumnData ? data[splitColumnName[0]][splitColumnName[1]] : null;
            }
            
            return data[columnName];
        }

        return {
            tableData,
        }
    }
}
</script>