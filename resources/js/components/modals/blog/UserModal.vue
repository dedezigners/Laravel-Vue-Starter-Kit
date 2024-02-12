<template>
    <div class="modal fade" id="de--user" tabindex="-1" aria-hidden="true" ref="modalRef">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{{ data ? 'Edit' : 'Create' }} User</h2>

                    <button class="btn btn-icon" @click="onClose">
                        <font-awesome-icon icon="close" />
                    </button>
                </div>

                <div class="modal-body">
                    <el-form class="de-form" label-position="top" @submit.prevent="onSubmit">
                        <FormUpload v-model="formData.image"
                        type="users" :filename="data?.username"
                        :preview="data?.thumb"
                        :error="errors['image'] ? errors['image'][0] : null" />

                        <el-form-item label="Name" :error="errors['name'] ? errors['name'][0] : null">
                            <el-input v-model="formData.name" placeholder="Yousaf Ali" />
                        </el-form-item>
                        <el-form-item label="Email" :error="errors['email'] ? errors['email'][0] : null">
                            <el-input v-model="formData.email" placeholder="yousaf@domain.com" />
                        </el-form-item>
                        <el-form-item label="Username" :error="errors['username'] ? errors['username'][0] : null">
                            <el-input v-model="formData.username" placeholder="yousaf-ali" />
                        </el-form-item>
                        <el-form-item :label="data ? 'Change Password' : 'Password'" :error="errors['password'] ? errors['password'][0] : null">
                            <el-input type="password" v-model="formData.password" placeholder="******" />
                        </el-form-item>
                        <el-form-item label="Select Role" :error="errors['role'] ? errors['role'][0] : null">
                            <el-select v-model="formData.role">
                                <el-option label="Admin" value="admin" />
                                <el-option label="User" value="user" />
                            </el-select>
                        </el-form-item>
                        
                        <button type="submit" :disabled="loading"
                        :class="['btn btn-lg btn-primary de-form__submit', loading ? 'de-form__submit--loading' : '']">
                            <span>{{ data ? 'Edit' : 'Create' }} User</span>
                            <font-awesome-icon :icon="loading ? 'spinner' : 'arrow-right-long'" />
                        </button>
                    </el-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { User } from '@/core/type';
import { PropType, ref, watch } from 'vue';
import { clearForm } from '@/core/helper';
import FormUpload from '@/components/FormUpload.vue';

export default {
    name: "UserModal",
    props: {
        data: Object as PropType<User>,
        loading: {type: Boolean, default: false},
        submitForm: {type: Function, default: () => {}},
        closeModal: {type: Function, default: () => {}},
        setModalRef: {type: Function, default: () => {}},
        errors: { type: Object as PropType<any>, default: []},
    },
    components: { FormUpload },
    setup: (props, ctx) => {
        const modalRef = ref<HTMLElement | null>(null);
        const formData = ref<User>({});

        watch(
            () => modalRef.value,
            () => props.setModalRef(modalRef.value)
        );

        watch(
            () => props.data,
            () => formData.value = props.data ? {...props.data} : clearForm(formData.value)
        );

        const onClose = () => {
            formData.value = clearForm(formData.value);
            props.closeModal();
        }

        const onSubmit = async () => {
            const res = await props.submitForm(formData.value, props.data !== null);
            if (res) formData.value = clearForm(formData.value);
        }

        return {
            modalRef,
            formData,
            onSubmit,
            onClose,
        }
    }
}
</script>
