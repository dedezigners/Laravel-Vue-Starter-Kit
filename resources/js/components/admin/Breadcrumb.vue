<template>
    <div class="de-breadcrumb">
        <h4 class="de-breadcrumb--title">{{ title ?? pageTitle }}</h4>
        <ul class="de-breadcrumb--list">
            <li class="de-breadcrumb--item"><Link href="/admin">Home</Link></li>
            <li class="de-breadcrumb--item" v-for="(b, index) in splitPath" :key="index">{{ b }}</li>
            <li class="de-breadcrumb--item">{{ title ?? pageTitle }}</li>
        </ul>
    </div>
</template>

<script lang="ts">
import { router } from '@inertiajs/vue3';
import { PropType } from 'vue';

export default {
    name: "DeBreadcrumb",
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
    },
    setup: () => {
        // @ts-ignore
        const pagePath = router.page.url;
        const splitPath: any = pagePath.split('/');
        splitPath.splice(0, 2);
        
        const pageTitle = splitPath.pop();
        
        return {
            pageTitle,
            splitPath,
        }
    }
}
</script>@/core/sidebarMenu