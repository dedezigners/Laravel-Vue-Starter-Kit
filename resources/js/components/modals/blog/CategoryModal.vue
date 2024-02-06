<template>
    <div class="modal fade" id="de--category" tabindex="-1" aria-hidden="true" ref="modalRef">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Create Category</h2>

                    <button class="btn btn-icon" @click="closeModal">
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
                        <el-form-item label="Parent Category">
                            <el-select v-model="formData.parent">
                                <el-option v-for="c in categories" :label="c.name" :value="c.id" />
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Description">
                            <el-input type="textarea" rows="4" v-model="formData.desc" placeholder="Business blogs are related to corporate agencies, industries, and other companies." />
                        </el-form-item>
                        
                        <button type="submit" class="btn btn-lg btn-primary de-submit">
                            <span>Create Category</span>
                            <font-awesome-icon icon="arrow-right-long" />
                        </button>
                    </el-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { hideModal } from '@/core/helper';
import axios from 'axios';
import { PropType, ref } from 'vue';

export default {
    name: "CategoryModal",
    props: {
        categories: Array as PropType<any>,
        data: Object as PropType<any>,
    },
    emits: ['create', 'edit'],
    setup: (props, { emit }) => {
        const modalRef = ref<HTMLElement | null>(null);
        const loading = ref(false);
        const errors = ref<any>([]);
        const formData = ref({
            icon: '',
            name: '',
            slug: '',
            desc: '',
            parent: '',
        });

        const closeModal = () => hideModal(modalRef.value);

        const onSubmit = () => {
            loading.value = true;
            axios.post('/admin/blog/categories', formData.value).then(res => {
                console.log(res);
            }).catch(e => {
                console.error(e.response.data);
                errors.value = e.response.data.errors ?? [];
                loading.value = false;
            });
        }

        return {
            modalRef,
            loading,
            formData,
            errors,
            closeModal,
            onSubmit,
        }
    }
}
</script>
