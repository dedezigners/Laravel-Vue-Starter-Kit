<template>
    <div class="de-footer">
        <p class="de-footer__copyright">&copy; {{ currentYear }} &mdash; Design &amp; Developed by <a href="http://dedezigners.com">DeDezigners</a></p>
        <ul class="de-footer--list">
            <li><a href="http://dedezigners.com/about" target="_blank">About</a></li>
        </ul>
    </div>
</template>

<script lang="ts">
export default {
    name: "DeFooter",
    setup: () => {
        const currentYear = new Date().getFullYear();

        return {
            currentYear,
        }
    }
}
</script>