<template>
    <slot></slot>
</template>

<script lang="ts">
export default {
    name: "Admin",
    setup: () => {}
}
</script>

<style lang="scss">
// Plugins
@import "bootstrap/scss/bootstrap";
@import "element-plus/dist/index.css";
// DeStyles
@import '../assets/sass/admin.scss';
</style>
