<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card__header--title">Blog Posts</h3>
            
            <div class="de-card__actions">
                <Link class="btn btn-primary-outline" href="/admin/blog/posts/create">Create Post</Link>
            </div>
        </div>
    </admin-layout>
</template>

<script lang="ts">
import { PropType } from 'vue';

export default {
    name: 'Posts',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
    },
    setup: (props) => {}
}
</script>