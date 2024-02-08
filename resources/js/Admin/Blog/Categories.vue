<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card__header--title">{{ showTrashed ? 'Trashed ' : '' }}Categories</h3>

            <div class="de-card__actions">
                <button class="btn btn-primary" ref="modalButtonRef"
                @click="editData = null"
                data-bs-toggle="modal" data-bs-target="#de--category">
                Create Category</button>
            </div>
        </div>

        <div class="de-card de-card__info">
            <button :class="['btn btn-sm', showTrashed ? 'btn-secondary' : 'btn-outline-secondary']"
            @click="showTrashed = !showTrashed">
                Show {{ showTrashed ? 'Active' : 'Trashed' }}
            </button>
        </div>

        <div class="de-card de-card__table">
            <DeDatatable :header="tableHead" :data="showTrashed ? trashedData : activeData">
                <template v-slot:actions="{ data: item }">
                    <button v-if="!showTrashed" class="btn btn-icon btn-sm btn-outline-secondary me-2" @click="onEditSelect(item.id)">
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

    <CategoryModal :categories="activeData"
    :loading="loading" :errors="errors" :data="editData"
    :close-modal="closeModal" :submit-form="onSubmit" :set-modal-ref="setModalRef" />
</template>

<script lang="ts">
import { PropType, ref } from 'vue';
import { BlogCategory, DeTableHead, Resource } from '@/core/type';
import CategoryModal from '@/components/modals/blog/CategoryModal.vue';
import { useCrud } from '@/core/crud';
import { RoutePath } from '@/core/route-path';

export default {
    name: 'BlogCategories',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        categories: Object as PropType<Resource<BlogCategory[]>>,
        trashedCategories: Object as PropType<Resource<BlogCategory[]>>,
    },
    components: { CategoryModal },
    setup: (props) => {
        const tableHead = ref<DeTableHead[]>([
            { label: "ID", name: "id", sort: true },
            { label: "Name", name: "name", sort: true },
            { label: "Slug", name: "slug", sort: false },
            { label: "Parent Category", name: "parent_category.name", sort: false },
            { label: "Actions", name: "actions", sort: false, class: 'text-end', },
        ]);

        const {
            loading,
            errors,
            activeData,
            trashedData,
            showTrashed,
            editData,
            modalButtonRef,
            closeModal,
            onSubmit,
            setModalRef,
            onEditSelect,
            onCreate,
            onEdit,
            onDelete,
            onRestore,
            onPermanent,
        } = useCrud(RoutePath.blog.categories, props.categories?.data, props.trashedCategories?.data);

        return {
            loading,
            errors,
            activeData,
            trashedData,
            showTrashed,
            editData,
            tableHead,
            modalButtonRef,
            closeModal,
            onSubmit,
            setModalRef,
            onEditSelect,
            onCreate,
            onEdit,
            onDelete,
            onRestore,
            onPermanent,
        }
    }
}
</script>