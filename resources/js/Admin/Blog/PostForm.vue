<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <div class="de-card de-card__header">
            <h3 class="de-card__header--title">Create Post</h3>
        </div>

        <div class="de-card de-card__body">
            <el-form class="de-form row" label-position="top">
                <el-form-item class="col-lg-6" label="Post Title">
                    <el-input v-model="formData.title" placeholder="Post title here" />
                </el-form-item>
                
                <el-form-item class="col-lg-6" label="Post Slug">
                    <el-input v-model="formData.title" placeholder="Post title here" />
                </el-form-item>
                
                <el-form-item class="col-lg-6" label="Select Category">
                    <el-select v-model="formData.category_id" :filterable="true">
                        <el-option v-for="(c, i) in categories?.data" :key="i" :label="c.name" :value="c.id" />
                    </el-select>
                </el-form-item>
                
                <el-form-item class="col-lg-6" label="Choose Tags">
                    <el-select v-model="formData.tag_ids" :multiple="true" :filterable="true">
                        <el-option v-for="(t, i) in tags?.data" :key="i" :label="t.name" :value="t.id" />
                    </el-select>
                </el-form-item>
                
                <el-form-item label="Excerpt">
                    <el-input type="textarea" rows="4" v-model="formData.title" placeholder="Post title here" />
                </el-form-item>
                
                <el-form-item label="Content">
                    <CKEditor :editor="ckEditor" v-model="formData.content" />
                </el-form-item>

                <div class="form-group">
                    <button type="submit" :class="['btn btn-lg btn-primary', loading ? 'de-submit--loading' : '']">
                        <span>{{ post ? 'Edit' : 'Create' }} Post</span>
                        <font-awesome-icon :icon="loading ? 'spinner' : 'arrow-right-long'" />
                    </button>
                </div>
            </el-form>
        </div>
    </admin-layout>
</template>

<script lang="ts">
import { PropType, ref } from 'vue';
import { BlogCategory, BlogTag, Post, Resource } from '@/core/type';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from "@ckeditor/ckeditor5-vue";

export default {
    name: 'PostForm',
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        categories: Object as PropType<Resource<BlogCategory[]>>,
        tags: Object as PropType<Resource<BlogTag[]>>,
        post: Object as PropType<Resource<Post>>,
    },
    components: { CKEditor: CKEditor.component },
    setup: (props) => {
        const loading = ref(false);
        const ckEditor = ref(ClassicEditor);
        const formData = ref<Post>({});

        return {
            loading,
            ckEditor,
            formData,
        }
    }
}
</script>