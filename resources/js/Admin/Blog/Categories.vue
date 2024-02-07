<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card__header--title">{{ showTrashed ? 'Trashed ' : '' }} Categories</h3>

            <div class="de-card__actions">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#de--category">Create
                    Category</button>
            </div>
        </div>

        <div class="de-card de-card__info">
            <button :class="['btn btn-sm', showTrashed ? 'btn-secondary' : 'btn-outline-secondary']"
                @click="showTrashed = !showTrashed">Show {{ showTrashed ? 'Active' : 'Trashed' }}</button>
        </div>

        <div class="de-card de-card__body">
            <DeDatatable :header="tableHead" :data="showTrashed ? trashedCategories.data : categories.data">
                <template v-slot:actions="{ data: item }">
                    <button v-if="!showTrashed" class="btn btn-icon btn-sm btn-outline-secondary me-2">
                        <font-awesome-icon icon="pen-to-square" />
                    </button>
                    <button v-if="!showTrashed" class="btn btn-icon btn-sm btn-outline-danger" @click="onDelete(item.id)">
                        <font-awesome-icon icon="trash" />
                    </button>
                    <button v-if="showTrashed" class="btn btn-icon btn-sm btn-outline-success me-2"
                        @click="onRestore(item.id)">
                        <font-awesome-icon icon="arrow-rotate-left" />
                    </button>
                    <button v-if="showTrashed" class="btn btn-icon btn-sm btn-danger" @click="onPermanent(item.id)">
                        <font-awesome-icon icon="trash-can" />
                    </button>
                </template>
            </DeDatatable>
        </div>
    </admin-layout>

    <CategoryModal :categories="categories.data" @create="onCreate" />
</template>

<script lang="ts">
import { PropType, ref } from 'vue';
import { DeTableHead } from '@/core/type';
import { ElMessageBox } from 'element-plus';
import CategoryModal from '@/components/modals/blog/CategoryModal.vue';
import axios from 'axios';

export default {
    name: 'Categories',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        categories: Object as PropType<any>,
        trashedCategories: Object as PropType<any>,
    },
    components: { CategoryModal },
    setup: (props) => {
        const showTrashed = ref(false);
        const tableHead = ref<DeTableHead[]>([
            { label: "ID", name: "id", sort: true },
            { label: "Name", name: "name", sort: true },
            { label: "Slug", name: "slug", sort: false },
            { label: "Parent Category", name: "parent_category.name", sort: false },
            { label: "Actions", name: "actions", sort: false, class: 'text-end', },
        ]);

        const onCreate = (item: any) => {
            props.categories.data.unshift(item);
        }

        const onDelete = (id: number) => {
            ElMessageBox.confirm(
                'Are you sure! you want to delete this item?',
                'Confirm delete?',
                {
                    type: 'warning',
                    confirmButtonText: 'Yes Delete',
                    confirmButtonClass: 'btn btn-danger',
                    cancelButtonClass: 'btn btn-secondary',
                    cancelButtonText: 'Cancel',
                }
            ).then(() => {
                const rowIndex = props.categories.data.findIndex((c: { id: number }) => c.id === id);
                axios.delete(`/admin/blog/categories/${id}`);

                props.trashedCategories.data.push(props.categories.data[rowIndex]);
                props.categories.data.splice(rowIndex, 1);
            }).catch(() => {});
        }

        const onRestore = (id: number) => {
            const rowIndex = props.trashedCategories.data.findIndex((c: { id: number }) => c.id === id);
            axios.put(`/admin/blog/categories/${id}`);

            props.categories.data.unshift(props.trashedCategories.data[rowIndex]);
            props.trashedCategories.data.splice(rowIndex, 1);
        }

        const onPermanent = (id: number) => {
            ElMessageBox.confirm(
                'Are you sure! you want to delete this item, this cannot be undo?',
                'Confirm delete?',
                {
                    type: 'warning',
                    confirmButtonText: 'Yes Delete',
                    confirmButtonClass: 'btn btn-danger',
                    cancelButtonClass: 'btn btn-secondary',
                    cancelButtonText: 'Cancel',
                }
            ).then(() => {
                const rowIndex = props.trashedCategories.data.findIndex( (c: {id: number}) => c.id === id);
                axios.delete(`/admin/blog/categories/${id}/permanent`).then(res => {
                    console.log(res.data);
                });

                props.trashedCategories.data.splice(rowIndex, 1);
            }).catch(() => {});
        }

        return {
            showTrashed,
            tableHead,
            onCreate,
            onDelete,
            onRestore,
            onPermanent,
        }
    }
}
</script>