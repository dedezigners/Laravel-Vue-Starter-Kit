<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card--title">
                <span v-if="showTrashed" class="me-1">Trashed</span>
                <span>Posts</span>
            </h3>

            <div class="de-card__actions">
                <Link class="btn btn-primary" href="/admin/blog/posts/create">Create Post</Link>
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
                
                <template v-slot:thumb="{ data: item }">
                    <img :src="item.thumb" :alt="item.title">
                </template>
                <template v-slot:tags="{ data: item }">
                    <span v-if="!item.tags.length">&mdash;</span>
                    <span v-for="tag in item.tags" class="badge bg-secondary rounded-0 me-2">{{ tag.name }}</span>
                </template>

                <template v-slot:actions="{ data: item }">
                    <Link v-if="!showTrashed" :href="`/admin/blog/posts/${item.id}/edit`"
                    class="btn btn-icon btn-sm btn-outline-secondary me-2">
                        <font-awesome-icon icon="pen-to-square" />
                    </Link>
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
</template>

<script lang="ts">
import { PropType, ref } from 'vue';
import { DeTableHead, Post, Resource } from '@/core/type';
import { useCrud } from '@/core/crud';
import { RoutePath } from '@/core/route-path';

export default {
    name: 'BlogPosts',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        posts: Object as PropType<Resource<Post[]>>,
        trashedPosts: Object as PropType<Resource<Post[]>>,
    },
    setup: (props) => {
        const tableHead = ref<DeTableHead[]>([
            { label: "ID", name: "id", sort: true },
            { label: "Image", name: "thumb", sort: false },
            { label: "Title", name: "title", sort: true },
            { label: "Slug", name: "slug", sort: false },
            { label: "Category", name: "category.name", sort: true },
            { label: "Tags", name: "tags", sort: true },
            { label: "Actions", name: "actions", sort: false, class: 'text-end', },
        ]);

        const {
            activeData,
            trashedData,
            showTrashed,
            onDelete,
            onRestore,
            onPermanent,
        } = useCrud(RoutePath.blog.posts, props.posts?.data, props.trashedPosts?.data, "post");

        return {
            activeData,
            trashedData,
            showTrashed,
            tableHead,
            onDelete,
            onRestore,
            onPermanent,
        }
    }
}
</script>