<template>
    <div class="modal fade" id="de--category" tabindex="-1" aria-hidden="true" ref="modalRef">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{{ data ? 'Edit' : 'Create' }} Category</h2>

                    <button class="btn btn-icon" @click="onClose">
                        <font-awesome-icon icon="close" />
                    </button>
                </div>

                <div class="modal-body">
                    <el-form class="de-form" label-position="top" @submit.prevent="onSubmit">
                        <el-form-item label="Name" :error="errors['name'] ? errors['name'][0] : null">
                            <el-input v-model="formData.name" placeholder="Business Blog" />
                        </el-form-item>
                        <el-form-item label="Slug" :error="errors['slug'] ? errors['slug'][0] : null">
                            <el-input v-model="formData.slug" placeholder="business-blog" />
                        </el-form-item>
                        <el-form-item label="Parent Category" :error="errors['parent'] ? errors['parent'][0] : null">
                            <el-select v-model="formData.parent" :filterable="true">
                                <el-option v-for="c in categories" :label="c.name" :value="c.id" />
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Description">
                            <el-input type="textarea" rows="4" v-model="formData.desc" placeholder="Business blogs are related to corporate agencies, industries, and other companies." />
                        </el-form-item>
                        
                        <button type="submit" :class="['btn btn-lg btn-primary de-submit', loading ? 'de-submit--loading' : '']">
                            <span>{{ data ? 'Edit' : 'Create' }} Category</span>
                            <font-awesome-icon :icon="loading ? 'spinner' : 'arrow-right-long'" />
                        </button>
                    </el-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { clearForm, slugify } from '@/core/helper';
import { BlogCategory } from '@/core/type';
import { PropType, ref, watch } from 'vue';

export default {
    name: "CategoryModal",
    props: {
        categories: Array as PropType<BlogCategory[]>,
        data: Object as PropType<BlogCategory | null>,
        loading: {type: Boolean, default: false},
        submitForm: {type: Function, default: () => {}},
        closeModal: {type: Function, default: () => {}},
        setModalRef: {type: Function, default: () => {}},
        errors: { type: Object as PropType<any>, default: []},
    },
    setup: (props, ctx) => {
        const modalRef = ref<HTMLElement | null>(null);
        const formData = ref<any>({
            icon: null,
            name: null,
            slug: null,
            desc: null,
            parent: null,
        });

        watch(
            () => modalRef.value,
            () => props.setModalRef(modalRef.value)
        );

        watch(
            () => props.data,
            () => formData.value = props.data ? {...props.data} : clearForm(formData.value)
        );

        watch(
            () => formData.value.name,
            () => {
                if (!props.data) formData.value.slug = formData.value.name ? slugify(formData.value.name) : null
            }
        );

        const onClose = () => {
            formData.value = clearForm(formData.value);
            props.closeModal();
        }

        const onSubmit = () => props.submitForm(formData.value, props.data !== null);

        return {
            modalRef,
            formData,
            onSubmit,
            onClose,
        }
    }
}
</script>
