<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="row">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="de-card de-card__flush">
                    <font-awesome-icon class="bg-dark" icon="user-group" />
                    <div class="de-card__flush--info">
                        <h4>Users</h4>
                        <h2>{{ userCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="de-card de-card__flush">
                    <font-awesome-icon class="bg-primary" icon="newspaper" />
                    <div class="de-card__flush--info">
                        <h4>Posts</h4>
                        <h2>{{ postCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="de-card de-card__flush">
                    <font-awesome-icon class="bg-info" icon="layer-group" />
                    <div class="de-card__flush--info">
                        <h4>Categories</h4>
                        <h2>{{ categoryCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="de-card de-card__flush">
                    <font-awesome-icon class="bg-warning" icon="tags" />
                    <div class="de-card__flush--info">
                        <h4>Tags</h4>
                        <h2>{{ tagCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script lang="ts">
import { PropType } from 'vue';

export default {
    name: 'Dashboard',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        userCount: Number,
        categoryCount: Number,
        tagCount: Number,
        postCount: Number,
    },
    setup: (props) => {}
}
</script>