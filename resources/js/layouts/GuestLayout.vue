<template>
    <div class="de-auth">
        <slot></slot>
    </div>
</template>

<script lang="ts">
export default {
    name: "GuestLayout",
    setup: () => {}
}
</script>

<style lang="scss">
// Plugins
@import "bootstrap/scss/bootstrap";
@import "element-plus/dist/index.css";
// DeStyles
@import '../assets/sass/guest.scss';
</style>
