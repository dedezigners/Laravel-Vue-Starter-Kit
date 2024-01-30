<template>
    <div class="de-header">
        <div class="container-fluid">
            <div class="de-header--content">
                <button class="btn btn-icon d-lg-none" @click="$emit('show-sidebar')">
                    <font-awesome-icon icon="bars" />
                </button>
                <div class="de-header--brand d-lg-none">
                    <img class="de-header--brand-image" src="/assets/images/logo/dede.svg" alt="DeDe">
                </div>
                <ul class="de-header--list">
                    <li>
                        <button class="btn btn-icon">
                            <font-awesome-icon icon="search" />
                        </button>
                    </li>
                    <li v-if="false">
                        <figure class="de-profile">
                            <img class="de-profile--image" src="/assets/images/profile.jpeg" alt="Profile Image">
                        </figure>
                    </li>
                    <li>
                        <figure class="de-profile">
                            <span class="de-profile--name">AT</span>
                        </figure>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    name: "DeHeader",
    emits: ['show-sidebar'],
    components: {},
    setup: () => { }
}
</script>