<template>
    <footer class="de-footer">
        <div class="container">
            <div class="de-footer-copyright">
                <p>{{ currentYear }} &copy; <a href="http://dedezigners.com" target="_blank">DeDezigners</a></p>
                <ul class="de-footer--list">
                    <li><a href="http://dedezigners.com/about" target="_blank">About Us</a></li>
                </ul>
            </div>
        </div>
    </footer>
</template>

<script lang="ts">
export default {
    name: "AppFooter",
    setup: () => {
        const currentYear = new Date().getFullYear();

        return {
            currentYear,
        }
    }
}
</script>
