<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card--title">
                <span class="me-1">{{ post ? 'Edit' : 'Create' }}</span>
                <span>Post</span>
            </h3>
        </div>

        <div class="de-card de-card__body">
            <el-form class="de-form row" label-position="top" @submit.prevent="onSubmit">
                <FormUpload v-model="formData.image"
                type="posts" :filename="post?.data.slug"
                :preview="post?.data.thumb"
                :error="errors['image'] ? errors['image'][0] : null" />

                <el-form-item class="col-lg-6" label="Post Title" :error="errors['title'] ? errors['title'][0] : null">
                    <el-input v-model="formData.title" placeholder="Post title here" />
                </el-form-item>

                <el-form-item class="col-lg-6" label="Post Slug" :error="errors['slug'] ? errors['slug'][0] : null">
                    <el-input v-model="formData.slug" placeholder="Post title here" />
                </el-form-item>

                <el-form-item class="col-lg-6" label="Select Category"
                    :error="errors['category_id'] ? errors['category_id'][0] : null">
                    <el-select v-model="formData.category_id" :filterable="true">
                        <el-option v-for="(c, i) in categories?.data" :key="i" :label="c.name" :value="c.id" />
                    </el-select>
                </el-form-item>

                <el-form-item class="col-lg-6" label="Choose Tags">
                    <el-select v-model="formData.tag_ids" :multiple="true" :filterable="true">
                        <el-option v-for="(t, i) in tags?.data" :key="i" :label="t.name" :value="t.id" />
                    </el-select>
                </el-form-item>

                <el-form-item label="Excerpt" :error="errors['excerpt'] ? errors['excerpt'][0] : null">
                    <el-input type="textarea" rows="4" v-model="formData.excerpt" placeholder="Post title here" />
                </el-form-item>

                <el-form-item label="Content">
                    <CKEditor :editor="ckEditor" v-model="formData.content" />
                </el-form-item>

                <div class="form-group">
                    <button type="submit" :class="['btn btn-lg btn-primary', loading ? 'de-submit--loading' : '']">
                        <span>{{ post ? 'Edit ' : 'Create ' }}Post</span>
                        <font-awesome-icon :icon="loading ? 'spinner' : 'arrow-right-long'" />
                    </button>
                </div>
            </el-form>
        </div>
    </admin-layout>
</template>

<script lang="ts">
import { PropType, ref, watch } from 'vue';
import { BlogCategory, BlogTag, Post, Resource } from '@/core/type';
import { slugify } from '@/core/helper';
import { RoutePath } from '@/core/route-path';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from "@ckeditor/ckeditor5-vue";
import FormUpload from '@/components/FormUpload.vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';


export default {
    name: 'PostForm',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        categories: Object as PropType<Resource<BlogCategory[]>>,
        tags: Object as PropType<Resource<BlogTag[]>>,
        post: Object as PropType<Resource<Post>>,
    },
    components: { CKEditor: CKEditor.component, FormUpload },
    setup: (props) => {
        const loading = ref(false);
        const errors = ref<any>([]);
        const ckEditor = ref(ClassicEditor);
        const formData = ref<Post>({});

        watch(() => formData.value.title, () => {
            formData.value.slug = formData.value.title ? slugify(formData.value.title) : '';
        });

        watch(() => props.post?.data, () => {
            if (props.post) {
                formData.value = props.post.data;
                formData.value.content = formData.value.content ?? '';
            }
        }, { immediate: true });

        const onSubmit = async () => {
            try {
                loading.value = true;
                errors.value = [];

                const res = props.post ?
                await axios.put(`${RoutePath.blog.posts}/${props.post?.data.id}`, formData.value) :
                await axios.post(`${RoutePath.blog.posts}`, formData.value, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    }
                });
                
                router.get(RoutePath.blog.posts);
            } catch (error: any) {
                console.error(error.message);
                console.error(error.response.data);
                errors.value = error.response.data.errors ?? [];
                loading.value = false;
            }
        }

        return {
            loading,
            errors,
            ckEditor,
            formData,
            onSubmit,
        }
    }
}
</script>