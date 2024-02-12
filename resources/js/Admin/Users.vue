<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card--title">
                <span v-if="showTrashed" class="me-1">Trashed</span>
                <span>Users</span>
            </h3>

            <div class="de-card__actions">
                <button class="btn btn-primary" ref="modalButtonRef"
                @click="editData = null"
                data-bs-toggle="modal" data-bs-target="#de--user">
                Create User</button>
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

    <DeModal :categories="activeData"
    :loading="loading" :errors="errors" :data="editData"
    :close-modal="closeModal" :submit-form="onSubmit" :set-modal-ref="setModalRef" />
</template>

<script lang="ts">
import { PropType, ref } from 'vue';
import { useCrud } from '@/core/crud';
import { RoutePath } from '@/core/route-path';
import { DeTableHead, Post, Resource } from '@/core/type';
import DeModal from '@/components/modals/blog/UserModal.vue';

export default {
    name: 'Users',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        users: Object as PropType<Resource<Post[]>>,
        trashedUsers: Object as PropType<Resource<Post[]>>,
    },
    components: { DeModal },
    setup: (props) => {
        const tableHead = ref<DeTableHead[]>([
            { label: "ID", name: "id", sort: true },
            { label: "Name", name: "name", sort: true },
            { label: "Username", name: "username", sort: true },
            { label: "Email", name: "email", sort: true },
            { label: "Role", name: "role", sort: false },
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
        } = useCrud(RoutePath.users, props.users?.data, props.trashedUsers?.data, 'username');
        

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