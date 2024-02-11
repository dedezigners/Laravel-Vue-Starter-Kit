<template>
    <footer class="footer">
        <div class="container">
            <div class="footer-copyright">
                <p>{{ currentYear }} &copy; <a href="http://dedezigners.com" target="_blank">DeDezigners</a></p>
                <ul class="footer--list">
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
