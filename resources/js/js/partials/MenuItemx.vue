<template>
    <div
        v-if=" typeof item.functions !== 'undefined' && item.functions.length> 0 &&can(item.gate)"
         data-kt-menu-trigger="click"
        class="menu-item menu-accordion ms-2"
    >
        <span class="menu-link">
            <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
            </span>
            <span class="menu-title">{{ item.caption }}</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            <MenuItemx v-for="f in item.functions" :item="f" ></MenuItemx>
        </div>
    </div>

    <router-link v-else-if="can(item.gate)" class="menu-link ms-2" :to="item.url"  :key="item.url">
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        <span   class="menu-title">{{ item.caption }}</span>
    </router-link>

</template>

<script>
export default {
    name: "MenuItemx",
    props: ["item"]
}
</script>

]
