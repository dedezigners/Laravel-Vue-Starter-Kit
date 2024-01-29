<template>
    <div class="de-app">
        <header class="de-app__header">
            <div class="container">
                <div class="de-app__header-inner">
                    <Link class="de-app__header-brand" href="/">
                        <img class="de-app__header-brand--logo" src="/assets/images/logo/dede.svg" alt="DeDe">
                    </Link>
                    <nav class="de-app__header-nav">
                        <ul class="de-app__header-nav--list">
                            <li class="de-app__header-nav--list-item">
                                <Link class="de-app__header-nav--link" href="/login">Login</Link>
                            </li>
                            <li class="de-app__header-nav--list-item">
                                <Link class="de-app__header-nav--link" href="/register">Register</Link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <div class="de-app__content">
            <slot></slot>
        </div>
        <footer class="de-app__footer">
            <div class="container">
                <div class="de-app__footer-copyright">
                    <p>2024 &copy; <a href="http://dedezigners.com" target="_blank">DeDezigners</a></p>
                    <ul class="de-app__footer--list">
                        <li><a href="#!">About</a></li>
                        <li><a href="#!">Privacy</a></li>
                        <li><a href="#!">Terms</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</template>

<script lang="ts">
export default {
    name: "App",
    setup: () => {}
}
</script>
