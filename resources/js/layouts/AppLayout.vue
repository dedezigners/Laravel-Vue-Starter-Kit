<template>
    <slot></slot>
</template>

<script lang="ts">
export default {
    name: "App",
    setup: () => {}
}
</script>

<style lang="scss">
// Plugins
@import "bootstrap/scss/bootstrap";
@import "element-plus/dist/index.css";
// DeStyles
@import '../assets/sass/app.scss';
</style>