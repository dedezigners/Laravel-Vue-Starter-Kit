<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <ProfileHead :user="user.data" />

        <div class="de-card">
            <div class="de-card__header de-card__header--b-btm">
                <h3 class="de-card--title">Profile Details</h3>
            </div>
            <div class="de-card__body">
                <div class="profile-detail">
                    <div class="profile-detail__title">Name</div>
                    <div class="profile-detail__desc">{{ user.data.name }}</div>
                </div>
                <div class="profile-detail">
                    <div class="profile-detail__title">Email</div>
                    <div class="profile-detail__desc">{{ user.data.email }}</div>
                </div>
                <div class="profile-detail">
                    <div class="profile-detail__title">Username</div>
                    <div class="profile-detail__desc">{{ user.data.username }}</div>
                </div>
                <div class="profile-detail">
                    <div class="profile-detail__title">Phone</div>
                    <div class="profile-detail__desc">{{ user.data.phone ?? '&mdash;' }}</div>
                </div>
                <div class="profile-detail">
                    <div class="profile-detail__title">Company</div>
                    <div class="profile-detail__desc">{{ user.data.phone ?? '&mdash;' }}</div>
                </div>
                <div class="profile-detail">
                    <div class="profile-detail__title">Country</div>
                    <div class="profile-detail__desc">{{ user.data.location ?? '&mdash;' }}</div>
                </div>
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