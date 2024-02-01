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
                        <button class="btn btn-icon">
                            <font-awesome-icon icon="search" />
                        </button>
                    </li>
                    <li>
                        <figure class="de-profile">
                            <span class="de-profile--name">AT</span>
                        </figure>

                        <div class="dropdown">
                            <div class="dropdown-item">
                                <figure class="de-profile de-profile--lg">
                                    <img src="/assets/images/profile.jpeg" alt="Profile Image" class="de-profile--image">
                                </figure>
                                <div class="de-about">
                                    <h5>Atif Ibrahim</h5>
                                    <span>Admin</span>
                                </div>
                            </div>
                            <div class="dropdown-item dropdown-item--seprator"></div>
                            <div class="dropdown-item">
                                <Link class="dropdown-item--link">My Profile</Link>
                            </div>
                            <div class="dropdown-item">
                                <Link class="dropdown-item--link">Change Password</Link>
                            </div>
                            <div class="dropdown-item dropdown-item--seprator"></div>
                            <div class="dropdown-item">
                                <button class="dropdown-item--link">Sign Out</button>
                            </div>
                        </div>
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