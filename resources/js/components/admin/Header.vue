<template>
    <div class="de-header">
        <div class="container-fluid">
            <div class="de-header--content">
                <button class="btn btn-icon d-lg-none" @click="$emit('show-sidebar')">
                    <font-awesome-icon icon="bars" />
                </button>
                <Link href="/admin" class="de-header--brand d-lg-none">
                    <img class="de-header--brand-image" src="/assets/images/logo/dede.svg" alt="DeDe">
                </Link>
                <ul class="de-header--list">
                    <li>
                        <figure class="de-profile">
                            <img v-if="authStore.user?.image" :src="authStore.user?.image" :alt="authStore.user?.name" class="de-profile--image">
                            <span v-else class="de-profile--name">{{ authStore.user?.name.substring(0, 2) }}</span>
                        </figure>

                        <div class="dropdown">
                            <div class="dropdown-item">
                                <figure class="de-profile de-profile--lg">
                                    <img v-if="authStore.user?.image" :src="authStore.user?.image" :alt="authStore.user?.name" class="de-profile--image">
                                    <span v-else class="de-profile--name">{{ authStore.user?.name.substring(0, 2) }}</span>
                                </figure>
                                <div class="de-about">
                                    <h5>{{ authStore.user?.name }}</h5>
                                    <span>{{ authStore.user?.role.toUpperCase() }}</span>
                                </div>
                            </div>
                            <div class="dropdown-item dropdown-item--seprator"></div>
                            <div class="dropdown-item">
                                <Link href="/admin/profile/overview" class="dropdown-item--link">My Profile</Link>
                            </div>
                            <div class="dropdown-item">
                                <Link href="/admin/profile/edit" class="dropdown-item--link">Edit Profile</Link>
                            </div>
                            <div class="dropdown-item">
                                <Link href="/admin/profile/change-password" class="dropdown-item--link">Change Password</Link>
                            </div>
                            <div class="dropdown-item dropdown-item--seprator"></div>
                            <div class="dropdown-item">
                                <Link href="/logout" class="dropdown-item--link">Sign Out</Link>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { useAuthStore } from '@/store/auth';

export default {
    name: "DeHeader",
    emits: ['show-sidebar'],
    components: {},
    setup: () => {
        const authStore = useAuthStore();

        return {
            authStore,
        }
    }
}
</script>