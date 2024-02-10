<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card--title">
                <span v-if="showTrashed" class="me-1">Trashed</span>
                <span>Tags</span>
            </h3>

            <div class="de-card__actions">
                <button class="btn btn-primary" ref="modalButtonRef"
                @click="editData = null"
                data-bs-toggle="modal" data-bs-target="#de--tag">
                Create Tag</button>
            </div>
        </div>

        <ul class="de-card de-card__navigation">
            <li class="ms-auto">
                <button :class="['btn btn-text', showTrashed ? 'active' : '']"
                @click="showTrashed = !showTrashed">
                    Show {{ showTrashed ? 'Active' : 'Trashed' }}
                </button>
            </li>
        </ul>

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

    <DeModal :loading="loading" :errors="errors" :data="editData"
    :close-modal="closeModal" :submit-form="onSubmit" :set-modal-ref="setModalRef" />
</template>

<script lang="ts">
import { PropType, ref } from 'vue';
import { BlogTag, DeTableHead, Resource } from '@/core/type';
import DeModal from '@/components/modals/blog/TagModal.vue';
import { useCrud } from '@/core/crud';
import { RoutePath } from '@/core/route-path';

export default {
    name: 'BlogTags',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        tags: Object as PropType<Resource<BlogTag[]>>,
        trashedTags: Object as PropType<Resource<BlogTag[]>>,
    },
    components: { DeModal },
    setup: (props) => {
        const tableHead = ref<DeTableHead[]>([
            { label: "ID", name: "id", sort: true },
            { label: "Name", name: "name", sort: true },
            { label: "Slug", name: "slug", sort: false },
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
            onDelete,
            onRestore,
            onPermanent,
        } = useCrud(RoutePath.blog.tags, props.tags?.data, props.trashedTags?.data);

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
            onDelete,
            onRestore,
            onPermanent,
        }
    }
}
</script>