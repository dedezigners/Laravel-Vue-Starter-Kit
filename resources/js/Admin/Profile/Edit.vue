<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <ProfileHead :user="user.data" type="edit" :countries="countries" />

        <div class="de-card">
            <div class="de-card__header de-card__header--b-btm">
                <h3 class="de-card--title">Edit Profile</h3>
            </div>
            <div class="de-card__body">
                <el-form class="de-form el-form--label-left" label-width="250px" @submit.prevent="onSubmit">
                    <el-form-item label="Avatar">
                        <FormUpload v-model="formData.image"
                        type="users" :filename="formData.username"
                        :preview="formData.thumb"
                        :error="errors['image'] ? errors['image'][0] : null" />
                    </el-form-item>

                    <el-form-item label="Name" :error="errors['name'] ? errors['name'][0] : null">
                        <el-input v-model="formData.name" placeholder="Yousaf Ali" />
                    </el-form-item>
                    <el-form-item label="Email" :error="errors['email'] ? errors['email'][0] : null">
                        <el-input v-model="formData.email" placeholder="yousaf@domain.com" />
                    </el-form-item>
                    <el-form-item label="Username" :error="errors['username'] ? errors['username'][0] : null">
                        <el-input v-model="formData.username" placeholder="yousaf-ali" />
                    </el-form-item>
                    <el-form-item label="Phone" :error="errors['phone'] ? errors['phone'][0] : null">
                        <el-input v-model="formData.phone" placeholder="302-xxx-xxx" />
                    </el-form-item>
                    <el-form-item label="Comapny" :error="errors['company'] ? errors['company'][0] : null">
                        <el-input v-model="formData.company" placeholder="DeDezigners" />
                    </el-form-item>
                    <el-form-item label="Country" :error="errors['country'] ? errors['country'][0] : null">
                        <el-select v-model="formData.country" placeholder="Select your country" :filterable="true">
                            <el-option v-for="(c, i) in countries" :key="i" :label="c.name" :value="c.code" />
                        </el-select>
                    </el-form-item>

                    <button type="submit" :disabled="loading"
                    :class="['btn btn-lg btn-primary de-form__submit', loading ? 'de-form__submit--loading' : '']">
                        <span>Edit Profile</span>
                        <font-awesome-icon :icon="loading ? 'spinner' : 'arrow-right-long'" />
                    </button>
                </el-form>
            </div>
        </div>
    </admin-layout>
</template>

<script lang="ts">
import { Country, Resource, User } from '@/core/type';
import { PropType, ref } from 'vue';
import ProfileHead from '@/components/admin/ProfileHead.vue';
import FormUpload from '@/components/FormUpload.vue';
import axios from 'axios';

export default {
    name: 'ProfileEdit',
    components: { ProfileHead, FormUpload },
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        countries: Array as PropType<Country[]>,
        user: {
            type: Object as PropType<Resource<User>>,
            required: true,
        },
    },
    setup: (props) => {
        const loading = ref(false);
        const formData = ref<User>({...props.user.data});
        const errors = ref<any>([]);

        const onSubmit = () => {
            loading.value = true;
            errors.value = [];
            
            axios.put(`/profile/update/${props.user.data.username}`, formData.value).then(res => {
                loading.value = false;
            }).catch(error => {
                console.error(error.message);
                console.error(error.response.data);
                errors.value = error.response.data.errors ?? [];
                loading.value = false;
            });
        }
        
        return {
            loading,
            errors,
            formData,
            onSubmit,
        }
    }
}
</script>