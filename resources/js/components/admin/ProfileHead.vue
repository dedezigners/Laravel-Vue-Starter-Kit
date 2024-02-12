<template>
    <div class="de-card de-card__header">
        <div class="de-card__profile">
            <figure class="de-profile de-profile--xl">
                <img v-if="user.preview" :src="user?.preview" :alt="user.name" class="de-profile--image">
                <span v-else class="de-profile--name">{{ user.name?.substring(0, 2) }}</span>
            </figure>
            <div class="de-card__profile--content">
                <h4>{{ user.name }}</h4>

                <ul class="de-card__profile--info">
                    <li v-if="user.username">
                        <font-awesome-icon icon="user" />
                        <span>{{ user.username }}</span>
                    </li>
                    <li v-if="user.email">
                        <font-awesome-icon icon="envelope" />
                        <span>{{ user.email }}</span>
                    </li>
                    <li v-if="user.country">
                        <font-awesome-icon icon="location-dot" />
                        <span>{{ user.country }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <ul class="de-card de-card__navigation">
        <li><Link :class="['btn btn-text', type === 'overview' ? 'active' : '']" href="/admin/profile/overview">Overview</Link></li>
        <li><Link :class="['btn btn-text', type === 'edit' ? 'active' : '']" href="/admin/profile/edit">Edit</Link></li>
        <li><Link :class="['btn btn-text', type === 'change-password' ? 'active' : '']" href="/admin/profile/change-password">Change Password</Link></li>
    </ul>
</template>

<script lang="ts">
import { User } from '@/core/type';
import { PropType } from 'vue';

export default {
    name: "ProfileHead",
    props: {
        user: {
            type: Object as PropType<User>,
            required: true,
        },
        type: {
            type: String as PropType<"overview" | "edit" | "change-password">,
            default: "overview"
        }
    },
    setup: (props) => {
        console.log();
        
    }
}
</script>
