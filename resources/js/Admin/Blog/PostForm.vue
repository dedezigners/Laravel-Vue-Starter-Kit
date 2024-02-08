<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card__header--title">Create Post</h3>
        </div>
    </admin-layout>
</template>

<script lang="ts">
import { Post, Resource } from '@/core/type';
import { PropType } from 'vue';

export default {
    name: 'PostForm',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        post: Object as PropType<Resource<Post>>,
    },
    setup: (props) => {}
}
</script>