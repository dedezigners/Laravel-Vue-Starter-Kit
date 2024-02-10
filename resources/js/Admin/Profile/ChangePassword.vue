<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <ProfileHead :user="user.data" type="change-password" />
    </admin-layout>
</template>

<script lang="ts">
import { Resource, User } from '@/core/type';
import { PropType } from 'vue';
import ProfileHead from '@/components/admin/ProfileHead.vue';

export default {
    name: 'ProfileOverview',
    components: { ProfileHead },
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        user: {
            type: Object as PropType<Resource<User>>,
            required: true,
        },
    },
    setup: (props) => {}
}
</script>