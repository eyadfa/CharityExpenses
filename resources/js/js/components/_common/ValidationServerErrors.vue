<template>
    <p v-for="e in errors">
        <el-alert :closable="false"  v-for="c in e" show-icon :title="c" type="error"></el-alert>
    </p>

</template>

<script>
export default {
    name: "ValidationServerErrors",
    props: {
        errors: {
            required:true,
            default:{}
        },
    },
}
</script>


