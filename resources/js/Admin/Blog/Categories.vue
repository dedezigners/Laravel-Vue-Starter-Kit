<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card__header--title">Categories</h3>
            
            <div class="de-card__actions">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#de--category">Create Category</button>
            </div>
        </div>
    </admin-layout>

    <CategoryModal />
</template>

<script lang="ts">
import { PropType } from 'vue';
import CategoryModal from '@/components/modals/blog/CategoryModal.vue';

export default {
    name: 'Categories',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
    },
    components: { CategoryModal },
    setup: (props) => {}
}
</script>