<template>
    <div class="de-breadcrumb">
        <h4 class="de-breadcrumb--title">Dashboard</h4>
        <ul class="de-breadcrumb--list">
            <li class="de-breadcrumb--item"><Link href="/admin">Home</Link></li>
            <li class="de-breadcrumb--item active"><span>Dashboard</span></li>
        </ul>
    </div>
</template>

<script lang="ts">
export default {
    name: "DeBreadcrumb",
    setup: () => {}
}
</script>