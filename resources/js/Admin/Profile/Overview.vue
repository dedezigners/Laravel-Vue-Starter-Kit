<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <ProfileHead :user="user.data" />

        <div class="de-card">
            <div class="de-card__header de-card__header--b-btm">
                <h3 class="de-card--title">Profile Details</h3>
            </div>
            <div class="de-card__body">
                <ul class="list">
                    <li>
                        .de-detail
                    </li>
                </ul>
            </div>
        </div>
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